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

use local_khelpdesk\form\response_controller;
use local_khelpdesk\model\category;
use local_khelpdesk\model\response;
use local_khelpdesk\model\ticket;
use local_khelpdesk\util\files;

require_once(__DIR__ . "/../../config.php");

global $DB, $OUTPUT, $PAGE, $USER;

$ticketid = optional_param("id", false, PARAM_INT);

$ticket = ticket::get_by_id($ticketid);

if ($ticket->get_courseid()) {
    $context = context_course::instance($ticket->get_courseid());
    require_login($ticket->get_courseid(), false);
} else {
    $context = context_system::instance();
    require_login();
}
$PAGE->set_context($context);
$PAGE->set_url("/local/helpdesk/ticket.php?id={$ticketid}");
$PAGE->set_title($ticket->get_subject());
$PAGE->set_heading($ticket->get_subject());
$PAGE->set_secondary_navigation(false);

if ($USER->id != $ticket->get_userid()) {
    require_capability("local/helpdesk:manage", $context);
} else {
    require_capability("local/helpdesk:view", $context);
}

$hasview = $hasmanage = has_capability("local/helpdesk:manage", $context);
if (!$hasview) {
    $hasview = has_capability("local/helpdesk:view", $context);
}

$PAGE->navbar->add(get_string("tickets", "local_khelpdesk"),
    new moodle_url("/local/helpdesk/"));
$PAGE->navbar->add($ticket->get_subject(),
    new moodle_url("/local/helpdesk/ticket.php?id={$ticketid}"));

// Categorys.
$categorys = category::get_all(null, null, "name ASC");
$categoryoptions = [];
/** @var category $category */
foreach ($categorys as $category) {
    $categoryoptions[] = [
        "key" => $category->get_id(),
        "lang" => $category->get_name(),
        "selected" => $ticket->get_categoryid() == $category->get_id() ? "selected" : "",
    ];
}

$templatecontext = [
    "status_options" => [
        [
            "key" => "open",
            "lang" => get_string("status_open", "local_khelpdesk"),
            "selected" => $ticket->get_status() == "open" ? "selected" : "",
        ], [
            "key" => "progress",
            "lang" => get_string("status_progress", "local_khelpdesk"),
            "selected" => $ticket->get_status() == "progress" ? "selected" : "",
        ], [
            "key" => "resolved",
            "lang" => get_string("status_resolved", "local_khelpdesk"),
            "selected" => $ticket->get_status() == "resolved" ? "selected" : "",
        ], [
            "key" => "closed",
            "lang" => get_string("status_closed", "local_khelpdesk"),
            "selected" => $ticket->get_status() == "closed" ? "selected" : "",
        ],
    ],
    "priority_options" => [
        [
            "key" => "low",
            "lang" => get_string("priority_low", "local_khelpdesk"),
            "selected" => $ticket->get_priority() == "low" ? "selected" : "",
        ], [
            "key" => "medium",
            "lang" => get_string("priority_medium", "local_khelpdesk"),
            "selected" => $ticket->get_priority() == "medium" ? "selected" : "",
        ], [
            "key" => "high",
            "lang" => get_string("priority_high", "local_khelpdesk"),
            "selected" => $ticket->get_priority() == "high" ? "selected" : "",
        ], [
            "key" => "urgent",
            "lang" => get_string("priority_urgent", "local_khelpdesk"),
            "selected" => $ticket->get_priority() == "urgent" ? "selected" : "",
        ],
    ],
    "category_options" => $categoryoptions,
    "user" => $ticket->get_user(),
    "user_fullname" => fullname($ticket->get_user()),
    "user_picture" => (new user_picture($ticket->get_user()))->get_url($PAGE),

    "id" => $ticket->get_id(),
    "idkey" => $ticket->get_idkey(),
    "subject" => $ticket->get_subject(),
    "status" => $ticket->get_status(),
    "status_translated" => $ticket->get_status_translated(),
    "priority" => $ticket->get_priority(),
    "priority_translated" => $ticket->get_priority_translated(),
    "category" => $ticket->get_categoryid(),
    "category_translate" => $ticket->get_category()->get_name(),
    "createdat" => userdate($ticket->get_createdat()),
    "description" => $ticket->get_description(),

    "hasmanage" => $hasmanage,

    "responses" => [],
    "allfiles" => [],
];

$files = files::all("ticket", $ticket->get_id());
$templatecontext["ticketfiles_count"] = count($files);
$templatecontext["ticketfiles"] = $files;
$templatecontext["allfiles"] = $files;

$responses = response::get_all(null, ["ticketid" => $ticket->get_id()], "createdat ASC");
/** @var response $response */
foreach ($responses as $response) {

    $responsefiles = files::all("response", $response->get_id());
    $templatecontext["allfiles"] = array_merge($templatecontext["allfiles"], $responsefiles);

    $templatecontext["responses"][] = [
        "user" => $response->get_user(),
        "user_fullname" => fullname($response->get_user()),
        "user_picture" => (new user_picture($response->get_user()))->get_url($PAGE),

        "message" => $response->get_message(),
        "createdat" => userdate($response->get_createdat()),

        "responsefiles_count" => count($responsefiles),
        "responsefiles" => $responsefiles,

        "has_message" => $response->get_type() == response::TYPE_MESSAGE,
        "has_status" => $response->get_type() == response::TYPE_STATUS,
        "has_info" => $response->get_type() == response::TYPE_INFO,
    ];
}

$templatecontext["allfiles_count"] = count($templatecontext["allfiles"]);


echo $OUTPUT->header();
echo $OUTPUT->render_from_template("local_khelpdesk/ticket", $templatecontext);

echo \html_writer::start_tag("div", ["class" => "row response-message"]);
echo \html_writer::start_tag("div", ["class" => "col-md-7 col-lg-8 col-xxl-9"]);

$responsecontroller = new response_controller();
$responsecontroller->insert_response($ticket);

echo \html_writer::end_tag("div");
echo \html_writer::end_tag("div");

echo $OUTPUT->footer();
