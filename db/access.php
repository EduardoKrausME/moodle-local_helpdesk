<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * access file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = [
    "local/helpdesk:view" => [
        "captype" => "write",
        "contextlevel" => CONTEXT_SYSTEM,
        "archetypes" => [
            "user" => CAP_ALLOW,
            "student" => CAP_ALLOW,
        ],
    ],
    "local/helpdesk:ticketmanage" => [
        "captype" => "write",
        "contextlevel" => CONTEXT_SYSTEM,
        "archetypes" => [
            "teacher" => CAP_ALLOW,
            "editingteacher" => CAP_ALLOW,
            "coursecreator" => CAP_ALLOW,
            "manager" => CAP_ALLOW,
        ],
    ],
    "local/helpdesk:categorymanage" => [
        "captype" => "write",
        "contextlevel" => CONTEXT_SYSTEM,
        "archetypes" => [
            "editingteacher" => CAP_ALLOW,
            "coursecreator" => CAP_ALLOW,
            "manager" => CAP_ALLOW,
        ],
    ],
    "local/helpdesk:categorydelete" => [
        "captype" => "write",
        "contextlevel" => CONTEXT_SYSTEM,
        "archetypes" => [
            "editingteacher" => CAP_ALLOW,
            "coursecreator" => CAP_ALLOW,
            "manager" => CAP_ALLOW,
        ],
    ],
];
