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
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
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
    "local_helpdesk_ai_tickets" => [
        "classpath" => "local/helpdesk/classes/external/ai.php",
        "classname" => "\\local_helpdesk\\external\\ai",
        "methodname" => "tickets",
        "description" => "Generate a suggested ticket response through AI Bridge",
        "type" => "read",
        "ajax" => true,
        "capabilities" => "local/helpdesk:ticketmanage",
    ],
    "local_helpdesk_ai_knowledgebase" => [
        "classpath" => "local/helpdesk/classes/external/ai.php",
        "classname" => "\\local_helpdesk\\external\\ai",
        "methodname" => "knowledgebase",
        "description" => "Generate knowledge-base content through AI Bridge",
        "type" => "read",
        "ajax" => true,
        "capabilities" => "local/helpdesk:knowledgebase_manage",
    ],];
