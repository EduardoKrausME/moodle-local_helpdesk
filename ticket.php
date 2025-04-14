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

use core\output\notification;
use local_helpdesk\form\response_controller;
use local_helpdesk\model\category;
use local_helpdesk\model\response;
use local_helpdesk\model\ticket;
use local_helpdesk\util\files;

require_once(__DIR__ . "/../../config.php");
require_once(__DIR__ . "/lib.php");

global $DB, $OUTPUT, $PAGE, $USER;

$ticketid = optional_param("id", false, PARAM_INT);

$ticket = ticket::get_by_id($ticketid);

if (!$ticket) {
    echo $OUTPUT->header();;
    $message = get_string("ticketnotfound", "local_helpdesk");
    echo $PAGE->get_renderer("core")->render(new notification($message, "danger"));
    echo $OUTPUT->footer();
    die;
}

if ($ticket->get_courseid()) {
    $context = context_course::instance($ticket->get_courseid());
    require_login($ticket->get_courseid(), false);
} else {
    $context = context_system::instance();
    require_login();
}
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url("/local/helpdesk/ticket.php?id={$ticketid}"));
$PAGE->set_title($ticket->get_subject());
$PAGE->set_heading($ticket->get_subject());

$PAGE->requires->jquery();
$PAGE->requires->jquery_plugin("ui");
$PAGE->requires->jquery_plugin("ui-css");

if ($USER->id != $ticket->get_userid()) {
    require_capability("local/helpdesk:ticketmanage", $context);
} else {
    require_capability("local/helpdesk:view", $context);
}

$hasview = $hasticketmanage = has_capability("local/helpdesk:ticketmanage", $context);
if (!$hasview) {
    $hasview = has_capability("local/helpdesk:view", $context);
}

// Add HelpDesk secondary nav.
if ($hasticketmanage) {
    local_helpdesk_set_secondarynav();
} else {
    $PAGE->set_secondary_navigation(false);
}

$newstatus = optional_param("newstatus", false, PARAM_TEXT);
if ($newstatus && in_array($newstatus, [ticket::STATUS_CLOSED, ticket::STATUS_RESOLVED])) {
    $ticket->change_status($newstatus);
    redirect(new moodle_url("/local/helpdesk/ticket.php?id={$ticketid}"));
}

$PAGE->navbar->add(get_string("tickets", "local_helpdesk"),
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
        "label" => $category->get_name(),
        "selected" => $ticket->get_categoryid() == $category->get_id() ? "selected" : "",
    ];
}

$templatecontext = [
    "status_options" => ticket::get_status_options($ticket->get_status()),
    "priority_options" => ticket::get_priority_options($ticket->get_priority()),
    "category_options" => $categoryoptions,
    "user" => $ticket->get_user(),
    "user_fullname" => fullname($ticket->get_user()),
    "user_picture" => (new user_picture($ticket->get_user()))->get_url($PAGE),

    "detail" => [
        "list_courses" => \local_kopere_dashboard\profile::list_courses($ticket->get_user()->id),
        "get_user_info" => \local_kopere_dashboard\profile::get_user_info($ticket->get_user()),
    ],

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

    "hasticketmanage" => $hasticketmanage,

    "responses" => [],
    "allfiles" => [],
];

$files = files::all("ticket", $ticket->get_id());
$templatecontext["ticketfiles_count"] = count($files);
$templatecontext["ticketfiles"] = array_values($files);
$templatecontext["allfiles"] = array_values($files);

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
$templatecontext["has_closed"] = $ticket->has_closed();

echo $OUTPUT->header();

echo \html_writer::start_tag("div", ["class" => "ticket-details row"]);
echo \html_writer::start_tag("div", ["class" => "col-md-7 col-lg-8 col-xxl-9"]);

echo $OUTPUT->render_from_template("local_helpdesk/ticket", $templatecontext);

// Closed ticket not answered.
if ($ticket->get_status() != ticket::STATUS_CLOSED) {
    echo \html_writer::start_tag("div", ["class" => "response-message card"]);
    $responsecontroller = new response_controller();
    $responsecontroller->insert_response($ticket, $hasticketmanage);
    echo \html_writer::end_tag("div");
} else {
    $message = get_string("ticketclosed", "local_helpdesk");
    echo $PAGE->get_renderer("core")->render(new notification($message, "success"));
}

echo \html_writer::end_tag("div");
echo $OUTPUT->render_from_template("local_helpdesk/ticket-user", $templatecontext);
echo \html_writer::end_tag("div");

$PAGE->requires->js_call_amd("local_helpdesk/ticket", "init", [$ticket->get_idkey()]);

echo $OUTPUT->footer();
