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
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_khelpdesk\external;

use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_khelpdesk\model\category;
use local_khelpdesk\model\response;
use local_kbi\local\util\details_util;
use local_kbi\local\vo\local_kbi_block;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->libdir}/externallib.php");

/**
 * Class ticket
 *
 * @package local_khelpdesk\external
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
     * @param $elements
     *
     * @return array
     * @throws \Exception
     */
    public static function column($idkey, $column, $value) {
        $params = self::validate_parameters(self::column_parameters(), [
            "idkey" => $idkey,
            "column" => $column,
            "value" => $value,
        ]);
        $context = \context_system::instance();
        require_capability("local/helpdesk:manage", $context);
        self::validate_context($context);

        $ticket = \local_khelpdesk\model\ticket::get_by_id($params["idkey"]);

        switch ($params["column"]) {
            case "status":
                if ($params["value"] != $ticket->get_status()) {
                    $ticket->set_status($params["value"]);
                    $ticket->save();

                    $status = \local_khelpdesk\model\ticket::status_translated($params["value"]);
                    $savestatus = get_string("lognewstatus", "local_khelpdesk", $status);
                    response::create_status($ticket, $savestatus);
                } else {
                    $savestatus = get_string("lognowupdate", "local_khelpdesk");
                }
                break;
            case "priority":
                if ($params["value"] != $ticket->get_priority()) {
                    $ticket->set_priority($params["value"]);
                    $ticket->save();

                    $priority = \local_khelpdesk\model\ticket::priority_translated($params["value"]);
                    $savestatus = get_string("lognewpriority", "local_khelpdesk", $priority);
                    response::create_status($ticket, $savestatus);
                } else {
                    $savestatus = get_string("lognowupdate", "local_khelpdesk");
                }
                break;
            case "category":
                if ($params["value"] != $ticket->get_categoryid()) {

                    $ticket->set_categoryid($params["value"]);
                    $ticket->save();

                    $category = $ticket->get_category();
                    $savestatus = get_string("lognewcategory", "local_khelpdesk", $category->get_name());
                    response::create_status($ticket, $savestatus);
                } else {
                    $savestatus = get_string("lognowupdate", "local_khelpdesk");
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
