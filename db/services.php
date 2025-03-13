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
 * service file
 *
 * @package   local_helpdesk
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    "local_helpdesk_ticket_column" => [
        "classpath" => "local/helpdesk/classes/external/ticket.php",
        "classname" => "\\local_helpdesk\\external\\ticket",
        "methodname" => "column",
        "description" => "Saves the column of the ticket",
        "type" => "write",
        "ajax" => true,
        "capabilities" => "local/helpdesk:ticketmanage",
    ],
    "local_helpdesk_geniai_tickets" => [
        "classpath" => "local/helpdesk/classes/external/geniai.php",
        "classname" => "\\local_helpdesk\\external\\geniai",
        "methodname" => "tickets",
        "description" => "get the completions tickets of the geniai",
        "type" => "read",
        "ajax" => true,
        "capabilities" => "local/helpdesk:ticketmanage",
    ],
    "local_helpdesk_geniai_knowledgebase" => [
        "classpath" => "local/helpdesk/classes/external/geniai.php",
        "classname" => "\\local_helpdesk\\external\\geniai",
        "methodname" => "knowledgebase",
        "description" => "get the completions knowledgebase of the geniai",
        "type" => "read",
        "ajax" => true,
        "capabilities" => "local/helpdesk:knowledgebase_manage",
    ],
];
