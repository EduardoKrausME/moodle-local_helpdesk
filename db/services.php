<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

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
    "local_helpdesk_geniai_tickets" => [
        "classpath" => "local/helpdesk/classes/external/geniai.php",
        "classname" => "\\local_helpdesk\\external\\geniai",
        "methodname" => "tickets",
        "description" => "get the completions tickets of the geniai",
        "type" => "read",
        "ajax" => true,
        "capabilities" => "local/helpdesk:ticketmanage",
    ],
];
