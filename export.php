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
require_once(__DIR__ . "/lib.php");

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

$filename = 'tickets_export';

$columns = [
    'Full name',
    'Course',
    'Ticket Subject',
    'Ticket Description',
    'Ticket Status',
    'Ticket Priority',
    'Ticket Category',
    'Email'
];

$data = [];
$max_responses = 0;

$params = [];
$wheres = [];

if ($courseid) {
    $wheres[] = "courseid = :courseid";
    $params['courseid'] = $courseid;
}

// Status filtering from checkboxes (default: only 'open').
$allowed_statuses = ['open', 'closed', 'resolved', 'progress'];
$export_statuses = optional_param_array('export_status', ['open'], PARAM_ALPHA);

if (!in_array('all', $export_statuses)) {
    // Keep only valid status values.
    $export_statuses = array_intersect($export_statuses, $allowed_statuses);
    if (empty($export_statuses)) {
        $export_statuses = ['open'];
    }

    // Build IN clause with named params.
    $status_params = [];
    foreach (array_values($export_statuses) as $i => $st) {
        $key = "st{$i}";
        $status_params[$key] = $st;
    }
    $in_placeholders = implode(', ', array_map(function ($k) {
        return ":{$k}";
    }, array_keys($status_params)));
    $wheres[] = "status IN ({$in_placeholders})";
    $params = array_merge($params, $status_params);
}

$tickets = ticket::get_all($wheres ?: null, $params, "createdat DESC");

foreach ($tickets as $ticket) {
    try {
        $category = $ticket->get_category() ? $ticket->get_category()->get_name() : '';
    } catch (\Exception $e) {
        $category = '';
    }

    try {
        $user = $ticket->get_user();
        $user_fullname = $user ? fullname($user) : '';
        $user_email = $user->email ?? '';
    } catch (\Exception $e) {
        $user_fullname = '';
        $user_email = '';
    }

    $course = false;
    if ($ticket->get_courseid()) {
        $course = $DB->get_record('course', ['id' => $ticket->get_courseid()]);
    }
    $course_fullname = $course ? $course->fullname : '';

    // Get responses
    try {
        $responses_text = [];
        $responses = response::get_all(["ticketid = :ticketid"], ["ticketid" => $ticket->get_id()], "createdat ASC");

        if ($responses) {
            foreach ($responses as $resp) {
                try {
                    $resp_user = $resp->get_user();
                    $r_fullname = $resp_user ? fullname($resp_user) : 'Unknown';
                } catch (\Exception $e) {
                    $r_fullname = 'Unknown';
                }

                // Clean up message: decode HTML, strip tags, and flatten all spacing/newlines into a single line
                $message_text = html_entity_decode(strip_tags($resp->get_message()), ENT_QUOTES, 'UTF-8');
                $message_text = trim(preg_replace('/\s+/', ' ', $message_text));

                $responses_text[] = "$r_fullname: " . $message_text;
            }
        }
    } catch (\Exception $e) {
        $responses_text = [];
    }

    // Get ticket description
    $description = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($ticket->get_description()), ENT_QUOTES, 'UTF-8')));

    $row = [
        $user_fullname,
        $course_fullname,
        $ticket->get_subject(),
        $description,
        $ticket->get_status_translated(),
        $ticket->get_priority_translated(),
        $category,
        $user_email
    ];

    // Append each response to its own horizontal column
    foreach ($responses_text as $text) {
        $row[] = $text;
    }

    $data[] = $row;

    // Track highest number of responses to generate headers later
    if (count($responses_text) > $max_responses) {
        $max_responses = count($responses_text);
    }
}

// Dynamically generate column headers for the responses
for ($i = 1; $i <= $max_responses; $i++) {
    $columns[] = 'Response ' . $i;
}

// Pad rows so they all match the column count exactly (Moodle dataformat requires symmetric arrays)
foreach ($data as &$row) {
    while (count($row) < count($columns)) {
        $row[] = '';
    }
}
unset($row);

\core\dataformat::download_data($filename, 'excel', $columns, $data);
die;
