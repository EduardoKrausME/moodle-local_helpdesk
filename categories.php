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
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_helpdesk\form\category_controller;
use local_helpdesk\model\category;

require_once(__DIR__ . "/../../config.php");
require_once("{$CFG->libdir}/adminlib.php");
require_once(__DIR__ . "/lib.php");

global $DB, $OUTPUT, $PAGE, $USER;

require_admin();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url("/local/helpdesk/categories.php"));

$PAGE->navbar->add(get_string("tickets", "local_helpdesk"), new moodle_url("/local/helpdesk/"));
$PAGE->navbar->add(get_string("categories", "local_helpdesk"), new moodle_url("/local/helpdesk/categories.php"));

require_login(null, false);
require_capability("local/helpdesk:ticketmanage", $context);

// Add HelpDesk secondary nav.
local_helpdesk_set_secondarynav();

$templatecontext = [
    "categories" => [],
    "has_categorydelete" => has_capability("local/helpdesk:categorydelete", $context),
];

$actionform = optional_param("actionform", "", PARAM_ALPHA);
$categoryid = optional_param("id", 0, PARAM_INT);

if ($actionform == "add") {
    $PAGE->navbar->add(get_string("createcategory", "local_helpdesk"));

    $PAGE->set_title(get_string("createcategory", "local_helpdesk"));
    $PAGE->set_heading(get_string("createcategory", "local_helpdesk"));

    $controller = new category_controller();
    $controller->insert_category();
} else if ($actionform == "edit" && $categoryid > 0) {

    $category = category::get_by_id($categoryid);

    $PAGE->navbar->add(get_string("editcategory", "local_helpdesk"));
    $PAGE->navbar->add($category->get_name());

    $PAGE->set_title(get_string("editcategory", "local_helpdesk"));
    $PAGE->set_heading(get_string("editcategory", "local_helpdesk"));

    $controller = new category_controller();
    $controller->update_category($category);

} else if ($actionform == "delete" && $categoryid > 0) {

    $category = category::get_by_id($categoryid);

    $PAGE->set_title(get_string("deletecategory", "local_helpdesk"));
    $PAGE->set_heading(get_string("deletecategory", "local_helpdesk"));

    $PAGE->navbar->add(get_string("deletecategory", "local_helpdesk"));

    $ticket = $DB->get_records("local_helpdesk_ticket", ["categoryid" => $category->get_id()], "", "subject", 0, 1);
    if ($ticket) {
        redirect(new moodle_url("/local/helpdesk/categories.php"),
            get_string("deletecategoryusedata", "local_helpdesk"), null,
            \core\output\notification::NOTIFY_ERROR);
    }
    $ticket = $DB->get_records("local_helpdesk_knowledgebase", ["categoryid" => $category->get_id()], "", "title", 0, 1);
    if ($ticket) {
        redirect(new moodle_url("/local/helpdesk/knowledgebase.php"),
            get_string("deletecategoryusedata", "local_helpdesk"), null,
            \core\output\notification::NOTIFY_ERROR);
    }

    if (optional_param("confirm", "", PARAM_TEXT) == md5($category->get_id() . sesskey())) {
        require_sesskey();

        $category->delete();

        redirect(new moodle_url("/local/helpdesk/categories.php"),
            get_string("deletesuccesscategory", "local_helpdesk"), null,
            \core\output\notification::NOTIFY_SUCCESS);
    }

    echo $OUTPUT->header();

    $cancelurl = new moodle_url("/local/helpdesk/categories.php");
    $continueurl = new moodle_url("/local/helpdesk/categories.php",
        [
            "id" => $category->get_id(),
            "actionform" => "delete",
            "confirm" => md5($category->get_id() . sesskey()),
            "sesskey" => sesskey(),
        ]);
    $continuebutton = new \single_button($continueurl, get_string("delete"), "post", "danger");
    echo $OUTPUT->confirm(
        get_string("confirmdeletecategory", "local_helpdesk", $category->get_name()),
        $continuebutton,
        $cancelurl);

    echo $OUTPUT->footer();
    die;
} else {
    $categories = category::get_all();

    $PAGE->set_title(get_string("categories", "local_helpdesk"));
    $PAGE->set_heading(get_string("categories", "local_helpdesk"));

    /** @var category $category */
    foreach ($categories as $category) {
        $templatecontext["categories"][] = [
            "id" => $category->get_id(),
            "name" => $category->get_name(),
            "description" => $category->get_description(),
        ];
    }
}

echo $OUTPUT->header();
echo $OUTPUT->render_from_template("local_helpdesk/categories", $templatecontext);
echo $OUTPUT->footer();
