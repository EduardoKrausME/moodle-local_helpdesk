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
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\external;

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_helpdesk\model\response;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->libdir}/externallib.php");

/**
 * Class ticket
 *
 * @package local_helpdesk\external
 */
class ticket extends external_api {

    /**
     * Function column_parameters
     *
     * @return external_function_parameters
     */
    public static function column_parameters() {
        return new external_function_parameters([
            "idkey" => new external_value(PARAM_TEXT, "The idkey"),
            "column" => new external_value(PARAM_TEXT, "The column"),
            "value" => new external_value(PARAM_TEXT, "The value"),
        ]);
    }

    /**
     * Function column_is_allowed_from_ajax
     *
     * @return bool
     */
    public static function column_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Function column_returns
     *
     * @return external_single_structure
     */
    public static function column_returns() {
        return new external_single_structure([
            "status" => new external_value(PARAM_RAW, "Status", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Function column
     *
     * @param string $idkey
     * @param string $column
     * @param string $value
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function column($idkey, $column, $value) {
        $params = self::validate_parameters(self::column_parameters(), [
            "idkey" => $idkey,
            "column" => $column,
            "value" => $value,
        ]);
        $context = \context_system::instance();
        require_capability("local/helpdesk:ticketmanage", $context);
        self::validate_context($context);

        $ticket = \local_helpdesk\model\ticket::get_by_id($params["idkey"]);

        switch ($params["column"]) {
            case "status":
                if ($params["value"] != $ticket->get_status()) {
                    $ticket->change_status($params["value"]);
                    $savestatus = get_string("lognewstatus", "local_helpdesk", $ticket->get_status_translated());
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;
            case "priority":
                if ($params["value"] != $ticket->get_priority()) {
                    $ticket->change_priority($params["value"]);
                    $savestatus = get_string("lognewpriority", "local_helpdesk", $ticket->get_priority_translated());
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;
            case "category":
                if ($params["value"] != $ticket->get_categoryid()) {

                    $ticket->set_categoryid($params["value"]);
                    $ticket->save();

                    $category = $ticket->get_category();
                    $savestatus = get_string("lognewcategory", "local_helpdesk", $category->get_name());
                    response::create_status($ticket, $savestatus);
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;
            default:
                return ["status" => "NO"];
        }

        return [
            "status" => $savestatus,
        ];
    }
}
