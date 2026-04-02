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
 * setting file
 *
 * @package   local_helpdesk
 * @copyright 2026 Smartlearn-edu {@link https://github.com/Smartlearn-edu}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . "/../../config.php");

use core\dataformat;
use local_helpdesk\model\ticket;
use local_helpdesk\model\response;

global $DB, $PAGE, $USER;

$courseid = optional_param("courseid", false, PARAM_INT);
if ($courseid) {
    $context = context_course::instance($courseid);
    require_login($courseid, false);
} else {
    $context = context_system::instance();
    require_login(null, false);
}

require_capability("local/helpdesk:ticketmanage", $context);

$filename = "tickets_export";
$columns = [
    get_string("fullname"),
    get_string("course"),
    get_string("subject", "local_helpdesk"),
    get_string("description", "local_helpdesk"),
    get_string("status", "local_helpdesk"),
    get_string("ticketpriorityshort", "local_helpdesk"),
    get_string("category", "local_helpdesk"),
    get_string("email"),
];

$data = [];
$maxresponses = 0;

$params = [];
$wheres = [];

if ($courseid) {
    $wheres[] = "courseid = :courseid";
    $params["courseid"] = $courseid;
}

// Status filtering from checkboxes (default: only "open").
$allowedstatuses = ["open", "closed", "resolved", "progress"];
$exportstatuses = optional_param_array("export_status", ["open"], PARAM_ALPHA);

if (!in_array("all", $exportstatuses)) {
    // Keep only valid status values.
    $exportstatuses = array_intersect($exportstatuses, $allowedstatuses);
    if (empty($exportstatuses)) {
        $exportstatuses = ["open"];
    }

    // Build IN clause with named params.
    $statusparams = [];
    foreach (array_values($exportstatuses) as $i => $st) {
        $key = "st{$i}";
        $statusparams[$key] = $st;
    }
    $inplaceholders = implode(", ", array_map(function($k) {
        return ":{$k}";
    }, array_keys($statusparams)));
    $wheres[] = "status IN ({$inplaceholders})";
    $params = array_merge($params, $statusparams);
}

$tickets = ticket::get_all($wheres ?: null, $params, "createdat DESC");

foreach ($tickets as $ticket) {
    try {
        $category = $ticket->get_category() ? $ticket->get_category()->get_name() : "";
    } catch (Exception $e) {
        $category = "";
    }

    try {
        $user = $ticket->get_user();
        $userfullname = $user ? fullname($user) : "";
        $useremail = $user->email ?? "";
    } catch (Exception $e) {
        $userfullname = "";
        $useremail = "";
    }

    $course = false;
    if ($ticket->get_courseid()) {
        $course = $DB->get_record("course", ["id" => $ticket->get_courseid()]);
    }
    $coursefullname = $course ? $course->fullname : "";

    // Get responses
    try {
        $responsestext = [];
        $responses = response::get_all(["ticketid = :ticketid"], ["ticketid" => $ticket->get_id()], "createdat ASC");

        if ($responses) {
            foreach ($responses as $resp) {
                try {
                    $respuser = $resp->get_user();
                    $rfullname = $respuser ? fullname($respuser) : "Unknown";
                } catch (Exception $e) {
                    $rfullname = "Unknown";
                }

                // Clean up message: decode HTML, strip tags, and flatten all spacing/newlines into a single line
                $messagetext = html_entity_decode(strip_tags($resp->get_message()), ENT_QUOTES, "UTF-8");
                $messagetext = trim(preg_replace('/\s+/', " ", $messagetext));

                $responsestext[] = "{$rfullname}: {$messagetext}";
            }
        }
    } catch (Exception $e) {
        $responsestext = [];
    }

    // Get ticket description
    $description = trim(
        preg_replace(
            '/\s+/', " ",
            html_entity_decode(strip_tags($ticket->get_description()), ENT_QUOTES, "UTF-8")
        )
    );

    $row = [
        $userfullname,
        $coursefullname,
        $ticket->get_subject(),
        $description,
        $ticket->get_status_translated(),
        $ticket->get_priority_translated(),
        $category,
        $useremail,
    ];

    // Append each response to its own horizontal column
    foreach ($responsestext as $text) {
        $row[] = $text;
    }

    $data[] = $row;

    // Track highest number of responses to generate headers later
    if (count($responsestext) > $maxresponses) {
        $maxresponses = count($responsestext);
    }
}

// Dynamically generate column headers for the responses
for ($i = 1; $i <= $maxresponses; $i++) {
    $columns[] = "Response {$i}";
}

// Pad rows so they all match the column count exactly (Moodle dataformat requires symmetric arrays)
foreach ($data as &$row) {
    while (count($row) < count($columns)) {
        $row[] = "";
    }
}
unset($row);

dataformat::download_data($filename, "excel", $columns, $data);
die;
