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

use local_khelpdesk\form\ticket_controller;
use local_khelpdesk\model\category;
use local_khelpdesk\model\ticket;

require_once(__DIR__ . "/../../config.php");

global $DB, $OUTPUT, $PAGE, $USER;

$action = optional_param("action", "", PARAM_ALPHA);
$ticketid = optional_param("id", false, PARAM_INT);

$findpriority = optional_param("find_priority", false, PARAM_TEXT);
$findstatus = optional_param("find_status", false, PARAM_TEXT);
$findcategory = optional_param("find_category", false, PARAM_INT);
$findcourse = optional_param("find_course", false, PARAM_INT);
$finduser = optional_param("find_user", false, PARAM_INT);

if ($findcourse) {
    $context = context_course::instance($findcourse);
    require_login($findcourse, false);
} else {
    $context = context_system::instance();
    require_login();
}
$PAGE->set_context($context);
$PAGE->set_url("/local/helpdesk/index.php");
$PAGE->set_title(get_string("tickets", "local_khelpdesk"));
$PAGE->set_heading(get_string("tickets", "local_khelpdesk"));
$PAGE->set_secondary_navigation(false);

$hasview = $hasmanage = has_capability("local/helpdesk:manage", $context);
if (!$hasview) {
    $hasview = has_capability("local/helpdesk:view", $context);
}

$PAGE->navbar->add(get_string("tickets", "local_khelpdesk"),
    new moodle_url("/local/helpdesk/"));

// Categorys.
$categorys = category::get_all(null, null, "name ASC");
$categoryoptions = [];
/** @var category $category */
foreach ($categorys as $category) {
    $categoryoptions[] = [
        "key" => $category->get_id(),
        "lang" => $category->get_name(),
        "selected" => $findcategory == $category->get_id() ? "selected" : "",
    ];
}

$coursefullname = get_string("findcourse", "local_khelpdesk");
if ($findcourse) {
    $course = $DB->get_record("course", ["id" => $findcourse]);
    $coursefullname = $course->fullname;
}
$userfullname = get_string("finduser", "local_khelpdesk");
if ($finduser) {
    $user = $DB->get_record("user", ["id" => $finduser]);
    $userfullname = fullname($user);
}

$templatecontext = [
    "status_options" => [
        [
            "key" => "open",
            "lang" => get_string("status_open", "local_khelpdesk"),
            "selected" => $findstatus == "open" ? "selected" : "",
        ], [
            "key" => "progress",
            "lang" => get_string("status_progress", "local_khelpdesk"),
            "selected" => $findstatus == "progress" ? "selected" : "",
        ], [
            "key" => "resolved",
            "lang" => get_string("status_resolved", "local_khelpdesk"),
            "selected" => $findstatus == "resolved" ? "selected" : "",
        ], [
            "key" => "closed",
            "lang" => get_string("status_closed", "local_khelpdesk"),
            "selected" => $findstatus == "closed" ? "selected" : "",
        ],
    ],
    "priority_options" => [
        [
            "key" => "low",
            "lang" => get_string("priority_low", "local_khelpdesk"),
            "selected" => $findpriority == "low" ? "selected" : "",
        ], [
            "key" => "medium",
            "lang" => get_string("priority_medium", "local_khelpdesk"),
            "selected" => $findpriority == "medium" ? "selected" : "",
        ], [
            "key" => "high",
            "lang" => get_string("priority_high", "local_khelpdesk"),
            "selected" => $findpriority == "high" ? "selected" : "",
        ], [
            "key" => "urgent",
            "lang" => get_string("priority_urgent", "local_khelpdesk"),
            "selected" => $findpriority == "urgent" ? "selected" : "",
        ],
    ],
    "hasmanage" => $hasmanage,
    "category_options" => $categoryoptions,
    "find_course" => \local_khelpdesk\util\filter::create_filter_course($coursefullname, $findcourse),
    "find_user" => \local_khelpdesk\util\filter::create_filter_user($userfullname, $finduser),
    "tickets" => [],
];

if ($action == "add") {
    $controller = new ticket_controller();
    $controller->insert_ticket();
} else if ($action == "edit" && $ticketid && $hasmanage) {
    $controller = new ticket_controller();
    $controller->update_ticket($ticketid);
} else {
    $params = [];
    if ($findpriority) {
        $params["priority"] = $findpriority;
    }
    if ($findstatus) {
        $params["status"] = $findstatus;
    } else {
        $params[] = "status NOT IN('closed')";
    }
    if ($findcategory) {
        $params["categoryid"] = $findcategory;
    }
    if ($findcourse) {
        $params["courseid"] = $findcourse;
    }
    if($finduser){
        $params["userid"] = $finduser;
    }
    if (!$hasmanage) {
        $params["userid"] = $USER->id;
    }

    $order = "
        CASE
            WHEN priority = 'urgent' THEN 1
            WHEN priority = 'high'   THEN 2
            WHEN priority = 'medium' THEN 3
            WHEN priority = 'low'    THEN 4
            ELSE 5
        END,
        CASE
            WHEN status = 'open'     THEN 1
            WHEN status = 'progress' THEN 2
            WHEN status = 'resolved' THEN 3
            WHEN status = 'closed'   THEN 4
            ELSE 5
        END,
        createdat ASC";
    $tickets = ticket::get_all(null, $params, $order);

    /** @var ticket $ticket */
    foreach ($tickets as $ticket) {

        $user = $DB->get_record("user", ["id" => $ticket->get_userid()]);
        $course = $DB->get_record("course", ["id" => $ticket->get_courseid()], "id, fullname");

        $templatecontext["tickets"][] = [
            "user_picture" => (new user_picture($user))->get_url($PAGE),
            "user_fullname" => fullname($user),
            "course_fullname" => $course ? $course->fullname : "",
            "id" => $ticket->get_id(),
            "idkey" => $ticket->get_idkey(),
            "subject" => $ticket->get_subject(),
            "status" => $ticket->get_status(),
            "status_translated" => $ticket->get_status_translated(),
            "priority" => $ticket->get_priority(),
            "priority_translated" => $ticket->get_priority_translated(),
            "category" => $ticket->get_categoryid(),
            "category_translate" => $ticket->get_category()->get_name(),
            "createdat" => userdate($ticket->get_createdat(), get_string("strftimedatetimeshort", "langconfig")),
        ];
    }
}

echo $OUTPUT->header();
echo $OUTPUT->render_from_template("local_khelpdesk/index", $templatecontext);
echo $OUTPUT->footer();
