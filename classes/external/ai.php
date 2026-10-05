<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * AI-assisted Helpdesk external functions.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\external;

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_ai_bridge\api as ai_bridge_api;
use local_helpdesk\model\response;
use Throwable;

defined('MOODLE_INTERNAL') || die;

global $CFG;
require_once("{$CFG->libdir}/externallib.php");

/**
 * AI-assisted Helpdesk endpoints.
 *
 * AI provider selection, model routing, credits and fallback are delegated to local_ai_bridge.
 *
 * @package local_helpdesk\external
 */
class ai extends external_api {
    /** AI Bridge purpose used by Helpdesk. */
    private const PURPOSE = 'helpdesk';

    /**
     * Ticket response generation parameters.
     *
     * @return external_function_parameters
     */
    public static function tickets_parameters() {
        return new external_function_parameters([
            "ticketid" => new external_value(PARAM_INT, "Ticket ID"),
            "message" => new external_value(PARAM_TEXT, "Support instructions"),
        ]);
    }

    /**
     * Allow ticket generation from AJAX.
     *
     * @return bool
     */
    public static function tickets_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Ticket response generation return structure.
     *
     * @return external_single_structure
     */
    public static function tickets_returns() {
        return new external_single_structure([
            "success" => new external_value(PARAM_RAW, "Generated response", VALUE_OPTIONAL),
            "error" => new external_value(PARAM_RAW, "Error message", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Generate a suggested ticket response through AI Bridge.
     *
     * @param int $ticketid Ticket ID.
     * @param string $message Optional support instructions.
     * @return array
     */
    public static function tickets($ticketid, $message) {
        global $SESSION, $USER;

        $params = self::validate_parameters(self::tickets_parameters(), [
            "ticketid" => $ticketid,
            "message" => $message,
        ]);

        $context = \context_system::instance();
        require_capability("local/helpdesk:ticketmanage", $context);
        self::validate_context($context);

        $ticket = \local_helpdesk\model\ticket::get_by_id($params["ticketid"]);
        $responses = response::get_all(null, [
            "ticketid" => $ticket->get_id(),
            "type" => "message",
        ]);
        $responses = array_slice($responses, -3);

        $userfullname = fullname($ticket->get_user());
        $ticketmessage = trim(strip_tags($ticket->get_description()));
        $userlang = $SESSION->lang ?? $USER->lang;
        $instructions = trim($params["message"]);

        if (!$responses) {
            $promptkey = \core_text::strlen($instructions) > 10
                ? "geniai_ticket_prompt_1"
                : "geniai_ticket_prompt_2";
            $promptdata = [
                "userfullname" => $userfullname,
                "userticket" => "# {$ticket->get_subject()}\n\n{$ticketmessage}",
                "message" => $instructions,
                "userlang" => $userlang,
            ];
            $messages = [[
                "role" => "user",
                "content" => get_string($promptkey, "local_helpdesk", $promptdata),
            ]];
        } else {
            $messages = [[
                "role" => "user",
                "content" => "# {$ticket->get_subject()}\n\n{$ticketmessage}",
            ]];

            /** @var response $response */
            foreach ($responses as $response) {
                $messages[] = [
                    "role" => $response->get_userid() == $ticket->get_userid() ? "user" : "assistant",
                    "content" => trim(strip_tags($response->get_message())),
                ];
            }

            $promptkey = \core_text::strlen($instructions) > 10
                ? "geniai_ticket_prompt_3"
                : "geniai_ticket_prompt_4";
            $messages[] = [
                "role" => "user",
                "content" => get_string($promptkey, "local_helpdesk", [
                    "message" => $instructions,
                    "userlang" => $userlang,
                ]),
            ];
        }

        try {
            $result = ai_bridge_api::generate(self::PURPOSE, $messages);
            $html = self::markdown_to_html($result->text, $context);
            $html = preg_replace('/<h\d.*?>(.*?)<\/h\d>/s', '<p><strong>$1</strong></p>', $html) ?? $html;

            return [
                "success" => $html,
                "error" => false,
            ];
        } catch (Throwable $e) {
            return [
                "success" => false,
                "error" => s($e->getMessage()),
            ];
        }
    }

    /**
     * Knowledge-base generation parameters.
     *
     * @return external_function_parameters
     */
    public static function knowledgebase_parameters() {
        return new external_function_parameters([
            "message" => new external_value(PARAM_TEXT, "Knowledge-base instructions"),
        ]);
    }

    /**
     * Allow knowledge-base generation from AJAX.
     *
     * @return bool
     */
    public static function knowledgebase_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Knowledge-base generation return structure.
     *
     * @return external_single_structure
     */
    public static function knowledgebase_returns() {
        return new external_single_structure([
            "raw" => new external_value(PARAM_RAW, "Raw Markdown", VALUE_OPTIONAL),
            "success" => new external_value(PARAM_RAW, "Generated content", VALUE_OPTIONAL),
            "error" => new external_value(PARAM_RAW, "Error message", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Generate knowledge-base content through AI Bridge.
     *
     * @param string $message Instructions for the content.
     * @return array
     */
    public static function knowledgebase($message) {
        global $CFG, $SESSION, $SITE, $USER;

        $params = self::validate_parameters(self::knowledgebase_parameters(), [
            "message" => $message,
        ]);

        $context = \context_system::instance();
        require_capability("local/helpdesk:knowledgebase_manage", $context);
        self::validate_context($context);

        $instructions = trim($params["message"]);
        if (\core_text::strlen($instructions) <= 10) {
            return [
                "success" => false,
                "error" => get_string("knowledgebase_prompt_short", "local_helpdesk"),
            ];
        }

        $userlang = $SESSION->lang ?? $USER->lang;
        $messages = [[
            "role" => "user",
            "content" => get_string("geniai_knowledgebase_prompt", "local_helpdesk", [
                "site_fullname" => $SITE->fullname,
                "site_url" => $CFG->wwwroot,
                "message" => $instructions,
                "userlang" => $userlang,
            ]),
        ]];

        try {
            $result = ai_bridge_api::generate(self::PURPOSE, $messages);
            return [
                "success" => self::markdown_to_html($result->text, $context),
                "raw" => $result->text,
                "error" => false,
            ];
        } catch (Throwable $e) {
            return [
                "success" => false,
                "error" => s($e->getMessage()),
            ];
        }
    }

    /**
     * Convert AI Markdown to Moodle-safe HTML.
     *
     * @param string $content Markdown content.
     * @param \context $context Moodle context.
     * @return string
     */
    private static function markdown_to_html(string $content, \context $context): string {
        return format_text($content, FORMAT_MARKDOWN, [
            "context" => $context,
            "filter" => false,
            "para" => false,
        ]);
    }
}
