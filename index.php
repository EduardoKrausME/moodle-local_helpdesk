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
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_helpdesk\form\ticket_controller;
use local_helpdesk\model\category;
use local_helpdesk\model\category_users;
use local_helpdesk\model\ticket;

require_once(__DIR__ . "/../../config.php");

global $DB, $OUTPUT, $PAGE, $USER;

$action = optional_param("action", "", PARAM_ALPHA);
$ticketid = optional_param("id", false, PARAM_INT);

$findpriority = optional_param("find_priority", false, PARAM_TEXT);
$findstatus = optional_param("find_status", false, PARAM_TEXT);
$findcategory = optional_param("find_category", false, PARAM_INT);
$courseid = optional_param("courseid", false, PARAM_INT);
$finduser = optional_param("find_user", false, PARAM_INT);

if ($courseid) {
    $context = context_course::instance($courseid);
    require_login($courseid, false);
} else {
    $context = context_system::instance();
    require_login(null, false);
}
$PAGE->set_context($context);
$PAGE->set_url("/local/helpdesk/index.php");
$PAGE->set_title(get_string("tickets", "local_helpdesk"));
$PAGE->set_heading(get_string("tickets", "local_helpdesk"));
$PAGE->set_secondary_navigation(false);

$hasticketview = $hasticketmanage = has_capability("local/helpdesk:ticketmanage", $context);
$hascategorymanage = has_capability("local/helpdesk:categorymanage", $context);
if (!$hasticketview) {
    $hasticketview = has_capability("local/helpdesk:view", $context);
}

require_capability("local/helpdesk:view", $context);

$PAGE->navbar->add(get_string("tickets", "local_helpdesk"),
    new moodle_url("/local/helpdesk/"));

// Categories.
$categoryoptions = [];
if ($hasticketmanage) {
    $categorys = category::get_all(null, null, "name ASC");
    /** @var category $category */
    foreach ($categorys as $category) {

        $option = [
            "key" => $category->get_id(),
            "label" => $category->get_name(),
            "selected" => $findcategory == $category->get_id() ? "selected" : "",
        ];

        if ($hascategorymanage) {
            $categoryoptions[] = $option;
        } else {
            if (category_users::get_all(null, ["categoryid" => $category->get_id(), "userid" => $USER->id])) {
                $categoryoptions[] = $option;
            }
        }
    }
} else {
    $categorys = category::get_all(null, null, "name ASC");
    /** @var category $category */
    foreach ($categorys as $category) {
        $categoryoptions[] = [
            "key" => $category->get_id(),
            "label" => $category->get_name(),
            "selected" => $findcategory == $category->get_id() ? "selected" : "",
        ];
    }
}

if (count($categoryoptions) == 0 && $hascategorymanage) {
    redirect("/local/helpdesk/categories.php?actionform=add",
        get_string("createcategoryfirst", "local_helpdesk"), null, "warning");
}

$coursefullname = get_string("findcourse", "local_helpdesk");
if ($courseid) {
    $course = $DB->get_record("course", ["id" => $courseid]);
    $coursefullname = $course->fullname;
}
$userfullname = get_string("finduser", "local_helpdesk");
if ($finduser) {
    $user = $DB->get_record("user", ["id" => $finduser]);
    $userfullname = fullname($user);
}

$templatecontext = [
    "status_options" => ticket::get_status_options($findstatus),
    "priority_options" => ticket::get_priority_options($findpriority),
    "category_options" => $categoryoptions,
    "find_course" => \local_helpdesk\util\filter::create_filter_course($coursefullname, $courseid),
    "find_user" => $hasticketmanage ? \local_helpdesk\util\filter::create_filter_user($userfullname, $finduser) : "",
    "tickets" => [],

    "courseid" => $courseid,

    "has_manage" => $hasticketmanage,
    "has_categorymanage" => $hascategorymanage,
    "has_siteconfig" => has_capability("moodle/site:config", $context),
];

if ($action == "add") {
    $controller = new ticket_controller();
    $controller->insert_ticket();
} else if ($action == "edit" && $ticketid && $hasticketmanage) {
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
        $params[] = "status NOT IN('resolved','closed')";
    }
    if ($findcategory) {
        $params["categoryid"] = $findcategory;
    }
    if ($courseid) {
        $params["courseid"] = $courseid;
    }

    if (!$hasticketmanage) {
        $params["userid"] = $USER->id;
    } else if ($finduser) {
        $params["userid"] = $finduser;
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
if ($hasticketmanage) {
    $templatecontexttop = [
        "all_open_tickets" => $DB->get_field_select("local_helpdesk_ticket",
            "COUNT(*)", "status NOT IN('closed','resolved')"),
        "unanswered_tickets" => $DB->get_field_select("local_helpdesk_ticket",
            "COUNT(*)", "status NOT IN('open')"),
        "completed_tickets" => $DB->get_field_select("local_helpdesk_ticket",
            "COUNT(*)", "status IN('closed','resolved')"),
        "urgent_tickets" => $DB->get_field_select("local_helpdesk_ticket",
            "COUNT(*)", "status NOT IN('closed','resolved') AND priority IN('urgent','high')"),
    ];
    echo $OUTPUT->render_from_template("local_helpdesk/index-top", $templatecontexttop);
}
echo $OUTPUT->render_from_template("local_helpdesk/index", $templatecontext);
echo $OUTPUT->footer();
