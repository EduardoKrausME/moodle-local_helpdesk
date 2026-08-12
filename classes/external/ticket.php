<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Helpdesk ticket external functions.
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
use local_helpdesk\model\ticket as ticket_model;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->libdir}/externallib.php");

/**
 * Ticket external API.
 */
class ticket extends external_api {

    /**
     * Parameters for column().
     *
     * @return external_function_parameters
     */
    public static function column_parameters() {
        return new external_function_parameters([
            "idkey" => new external_value(PARAM_INT, "The ticket id key"),
            "column" => new external_value(PARAM_ALPHA, "The column"),
            "value" => new external_value(PARAM_TEXT, "The value"),
        ]);
    }

    /**
     * Allow AJAX calls.
     *
     * @return bool
     */
    public static function column_is_allowed_from_ajax() {
        return true;
    }

    /**
     * Return definition.
     *
     * @return external_single_structure
     */
    public static function column_returns() {
        return new external_single_structure([
            "status" => new external_value(PARAM_RAW, "Status"),
        ]);
    }

    /**
     * Update one of the fields supported by the ticket screen.
     *
     * @param int $idkey
     * @param string $column
     * @param string $value
     * @return array
     */
    public static function column($idkey, $column, $value) {
        global $DB;

        $params = self::validate_parameters(self::column_parameters(), [
            "idkey" => $idkey,
            "column" => $column,
            "value" => $value,
        ]);

        $context = \context_system::instance();
        self::validate_context($context);
        require_capability("local/helpdesk:ticketmanage", $context);

        $ticket = ticket_model::get_by_id($params["idkey"]);
        if (!$ticket) {
            throw new \invalid_parameter_exception("Ticket not found");
        }

        switch ($params["column"]) {
            case "status":
                $validstatuses = [
                    ticket_model::STATUS_OPEN,
                    ticket_model::STATUS_PROGRESS,
                    ticket_model::STATUS_RESOLVED,
                    ticket_model::STATUS_CLOSED,
                ];
                if (!in_array($params["value"], $validstatuses, true)) {
                    throw new \invalid_parameter_exception("Invalid ticket status");
                }

                if ($params["value"] !== $ticket->get_status()) {
                    $ticket->change_status($params["value"]);
                    $savestatus = get_string("lognewstatus", "local_helpdesk", $ticket->get_status_translated());
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;

            case "priority":
                $validpriorities = [
                    ticket_model::PRIORITY_LOW,
                    ticket_model::PRIORITY_MEDIUM,
                    ticket_model::PRIORITY_HIGH,
                    ticket_model::PRIORITY_URGENT,
                ];
                if (!in_array($params["value"], $validpriorities, true)) {
                    throw new \invalid_parameter_exception("Invalid ticket priority");
                }

                if ($params["value"] !== $ticket->get_priority()) {
                    $ticket->change_priority($params["value"]);
                    $savestatus = get_string("lognewpriority", "local_helpdesk", $ticket->get_priority_translated());
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;

            case "category":
                if (!preg_match("/^\\d+$/", $params["value"])) {
                    throw new \invalid_parameter_exception("Invalid ticket category");
                }
                $categoryid = (int)$params["value"];
                if (!$categoryid || !$DB->record_exists("local_helpdesk_category", ["id" => $categoryid])) {
                    throw new \invalid_parameter_exception("Invalid ticket category");
                }

                if ((int)$categoryid !== (int)$ticket->get_categoryid()) {
                    $ticket->set_categoryid($categoryid);
                    $ticket->set_updatedat(time());
                    $ticket->save();

                    $category = $ticket->get_category();
                    $savestatus = get_string("lognewcategory", "local_helpdesk", s($category->get_name()));
                    response::create_status($ticket, $savestatus);
                } else {
                    $savestatus = get_string("lognowupdate", "local_helpdesk");
                }
                break;

            default:
                throw new \invalid_parameter_exception("Invalid ticket column");
        }

        return ["status" => $savestatus];
    }
}
