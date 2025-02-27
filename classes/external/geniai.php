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
     * Function completions_parameters
     *
     * @return external_function_parameters
     */
    public static function completions_parameters() {
        return new external_function_parameters([
            "ticketid" => new external_value(PARAM_INT, "Ticket ID"),
            "message" => new external_value(PARAM_TEXT, "The original"),
        ]);
    }

    /**
     * Function completions_is_allowed_from_ajax
     *
     * @return bool
     */
    public static function completions_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Function completions_returns
     *
     * @return external_single_structure
     */
    public static function completions_returns() {
        return new external_single_structure([
            "success" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
            "error" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Function completions
     *
     * @param int $ticketid
     * @param string $message
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function completions($tickeid, $message) {
        global $USER, $SESSION;

        $params = self::validate_parameters(self::completions_parameters(), [
            "ticketid" => $tickeid,
            "message" => $message,
        ]);
        $context = \context_system::instance();
        require_capability("local/helpdesk:ticketmanage", $context);
        self::validate_context($context);

        $ticket = \local_helpdesk\model\ticket::get_by_id($params["ticketid"]);

        $params = [
            "ticketid" => $ticket->get_id(),
            "type" => "message",
        ];
        $responses = response::get_all(null, $params);
        $responses = array_slice($responses, -3);

        $userfullname = fullname($ticket->get_user());
        $ticketmessage = strip_tags($ticket->get_message());
        $ticketmessage = str_replace('"', "'", $ticketmessage);
        $userlang = isset($SESSION->lang) ? $SESSION->lang : $USER->lang;
        $params["message"] = str_replace('"', "'", $params["message"]);

        if (count($responses) == 0) {
            if (isset($params["message"][10])) {
                $messages = [
                    [
                        "role" => "system",
                        "content" => get_string("geniai_prompt_1", "local_helpdesk",
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
                        "content" => get_string("geniai_prompt_1", "local_helpdesk",
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
                    "content" => get_string("geniai_prompt_3", "local_helpdesk",
                        [
                            "message" => $params["message"],
                            "userlang" => $userlang,
                        ]),
                ];
            } else {
                $messages[] = [
                    "role" => "system",
                    "content" => get_string("geniai_prompt_4", "local_helpdesk",
                        [
                            "message" => $params["message"],
                            "userlang" => $userlang,
                        ]),
                ];
            }
        }

        $gpt = api::chat_completions($messages);

        if (isset($gpt["choices"][0]["message"])) {

            $parsemarkdown = new parse_markdown();

            $content = $gpt["choices"][0]["message"]["content"];
            $content = $parsemarkdown->markdown_text($content);

            return [
                "success" => $content,
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
