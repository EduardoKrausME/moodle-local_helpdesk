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
 * file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\external;

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_geniai\external\api;
use local_geniai\local\markdown\parse_markdown;
use local_helpdesk\model\response;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->libdir}/externallib.php");

/**
 * Class geniai
 *
 * @package local_helpdesk\external
 */
class geniai extends external_api {

    /**
     * Function tickets_parameters
     *
     * @return external_function_parameters
     */
    public static function tickets_parameters() {
        return new external_function_parameters([
            "ticketid" => new external_value(PARAM_INT, "Ticket ID"),
            "message" => new external_value(PARAM_TEXT, "The original"),
        ]);
    }

    /**
     * Function tickets_is_allowed_from_ajax
     *
     * @return bool
     */
    public static function tickets_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Function tickets_returns
     *
     * @return external_single_structure
     */
    public static function tickets_returns() {
        return new external_single_structure([
            "success" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
            "error" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Function tickets
     *
     * @param int $tickeid
     * @param string $message
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function tickets($tickeid, $message) {
        global $USER, $SESSION;

        $params = self::validate_parameters(self::tickets_parameters(), [
            "ticketid" => $tickeid,
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
        $ticketmessage = strip_tags($ticket->get_description());
        $ticketmessage = str_replace('"', "'", $ticketmessage);
        $userlang = isset($SESSION->lang) ? $SESSION->lang : $USER->lang;
        $params["message"] = str_replace('"', "'", $params["message"]);

        if (count($responses) == 0) {
            if (isset($params["message"][10])) {
                $messages = [
                    [
                        "role" => "system",
                        "content" => get_string("geniai_ticket_prompt_1", "local_helpdesk",
                            [
                                "userfullname" => $userfullname,
                                "userticket" => "# {$ticket->get_subject()}\n\n{$ticketmessage}",
                                "message" => $params["message"],
                                "userlang" => $userlang,
                            ]),
                    ],
                ];
            } else {
                $messages = [
                    [
                        "role" => "system",
                        "content" => get_string("geniai_ticket_prompt_1", "local_helpdesk",
                            [
                                "userfullname" => $userfullname,
                                "userticket" => "# {$ticket->get_subject()}\n\n{$ticketmessage}",
                            ]),
                    ],
                ];
            }
        } else {
            $messages = [
                [
                    "role" => "user",
                    "content" => "# {$ticket->get_subject()}\n\n{$ticketmessage}",
                ],
            ];

            /** @var response $response */
            foreach ($responses as $response) {
                $messages[] = [
                    "role" => $response->get_userid() == $ticket->get_userid() ? "user" : "assistant",
                    "content" => strip_tags($response->get_message()),
                ];
            }

            if (isset($params["message"][10])) {
                $messages[] = [
                    "role" => "system",
                    "content" => get_string("geniai_ticket_prompt_3", "local_helpdesk",
                        [
                            "message" => $params["message"],
                            "userlang" => $userlang,
                        ]),
                ];
            } else {
                $messages[] = [
                    "role" => "system",
                    "content" => get_string("geniai_ticket_prompt_4", "local_helpdesk",
                        [
                            "message" => $params["message"],
                            "userlang" => $userlang,
                        ]),
                ];
            }
        }

        $gpt = api::chat_completions($messages, true, "gpt-4o-mini");

        if (isset($gpt["choices"][0]["message"])) {

            $parsemarkdown = new parse_markdown();

            $content = $gpt["choices"][0]["message"]["content"];
            $html = $parsemarkdown->markdown_text($content);
            $html = preg_replace('/<h\d.*?>(.*?)<\/h\d>/s', '<p><strong>$1</strong></p>', $html);

            return [
                "success" => $html,
                "error" => false,
            ];
        } else {
            return [
                "success" => false,
                "error" => (string)$gpt["error"]["message"],
            ];
        }
    }

    // Knowledge base.

    /**
     * Function knowledgebase_parameters
     *
     * @return external_function_parameters
     */
    public static function knowledgebase_parameters() {
        return new external_function_parameters([
            "message" => new external_value(PARAM_TEXT, "The original"),
        ]);
    }

    /**
     * Function knowledgebase_is_allowed_from_ajax
     *
     * @return bool
     */
    public static function knowledgebase_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Function knowledgebase_returns
     *
     * @return external_single_structure
     */
    public static function knowledgebase_returns() {
        return new external_single_structure([
            "raw" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
            "success" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
            "error" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Function knowledgebase
     *
     * @param string $message
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function knowledgebase($message) {
        global $USER, $SESSION, $SITE, $CFG;

        $params = self::validate_parameters(self::knowledgebase_parameters(), [
            "message" => $message,
        ]);
        $context = \context_system::instance();
        require_capability("local/helpdesk:knowledgebase_manage", $context);
        self::validate_context($context);

        $userlang = isset($SESSION->lang) ? $SESSION->lang : $USER->lang;
        $params["message"] = str_replace('"', "'", $params["message"]);

        if (isset($params["message"][10])) {
            $messages = [
                [
                    "role" => "system",
                    "content" => get_string("geniai_knowledgebase_prompt", "local_helpdesk",
                        [
                            "site_fullname" => $SITE->fullname,
                            "site_url" => $CFG->wwwroot,
                            "message" => $params["message"],
                            "userlang" => $userlang,
                        ]),
                ],
            ];
        } else {
            return [
                "success" => false,
                "error" => get_string("knowledgebase_prompt_short", "local_helpdesk"),
            ];
        }

        $gpt = api::chat_completions($messages, true);
        if (isset($gpt["choices"][0]["message"])) {

            $parsemarkdown = new parse_markdown();

            $content = $gpt["choices"][0]["message"]["content"];
            $content = $parsemarkdown->markdown_text($content);

            return [
                "success" => $content,
                "raw" => $gpt["choices"][0]["message"]["content"],
                "error" => false,
            ];
        } else {
            return [
                "success" => false,
                "error" => (string)$gpt["error"]["message"],
            ];
        }
    }
}
