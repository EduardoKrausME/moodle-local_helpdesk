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

use local_khelpdesk\form\category_controller;
use local_khelpdesk\model\category;

require_once(__DIR__ . "/../../config.php");
require_once($CFG->libdir . "/adminlib.php");

global $DB, $OUTPUT, $PAGE, $USER;

require_admin();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url("/local/helpdesk/categories.php");
$PAGE->set_title(get_string("categories", "local_khelpdesk"));
$PAGE->set_heading(get_string("categories", "local_khelpdesk"));

$PAGE->navbar->add(get_string("tickets", "local_khelpdesk"),
    new moodle_url("/local/helpdesk/"));
$PAGE->navbar->add(get_string("categories", "local_khelpdesk"),
    new moodle_url("/local/helpdesk/categories.php"));

$templatecontext = new stdClass();
$templatecontext->categories = [];
$templatecontext->addcategoryurl = new moodle_url("/local/helpdesk/categories.php", ["action" => "add"]);

$action = optional_param("action", "", PARAM_ALPHA);
$categoryid = optional_param("id", 0, PARAM_INT);

if ($action == "add") {

    $PAGE->navbar->add(get_string("createcategory", "local_khelpdesk"));

    $controller = new category_controller();
    $controller->insert_category();
} else if ($action == "edit" && $categoryid > 0) {

    $category = category::get_by_id($categoryid);

    $PAGE->navbar->add($category->get_name());
    $PAGE->navbar->add(get_string("createcategory", "local_khelpdesk"));

    $controller = new category_controller();
    $controller->update_category($categoryid);
} else if ($action == "delete" && $categoryid > 0) {

    $category = category::get_by_id($categoryid);

    $PAGE->navbar->add(get_string("deletecategory", "local_khelpdesk"));

    $ticket = $DB->get_records("local_khelpdesk_ticket", ["id" => $category->get_id()], "", "subject", 0, 1);
    if ($ticket) {
        redirect(new moodle_url("/local/helpdesk/categories.php"),
            get_string("deletecategoryusedata", "local_khelpdesk"), null,
            \core\output\notification::NOTIFY_ERROR);
    }

    if (optional_param("confirm", "", PARAM_TEXT) == md5($category->get_id() . sesskey())) {
        require_sesskey();

        $category->delete();

        redirect(new moodle_url("/local/helpdesk/categories.php"),
            get_string("deletesuccesscategory", "local_khelpdesk"), null,
            \core\output\notification::NOTIFY_SUCCESS);
    }

    echo $OUTPUT->header();

    $cancelurl = new moodle_url("/local/helpdesk/categories.php");
    $continueurl = new moodle_url("/local/helpdesk/categories.php",
        [
            "id" => $category->get_id(),
            "action" => "delete",
            "confirm" => md5($category->get_id() . sesskey()),
            "sesskey" => sesskey(),
        ]);
    $continuebutton = new \single_button($continueurl, get_string("delete"), "post", "danger");
    echo $OUTPUT->confirm(
        get_string("confirmdeletecategory", "local_khelpdesk", $category->get_name()),
        $continuebutton,
        $cancelurl);

    echo $OUTPUT->footer();
    die;
} else {
    $categories = category::get_all();

    foreach ($categories as $category) {
        $templatecontext->categories[] = [
            "id" => $category->id,
            "name" => $category->name,
            "description" => $category->description,
        ];
    }
}

echo $OUTPUT->header();
echo $OUTPUT->render_from_template("local_khelpdesk/categories", $templatecontext);
echo $OUTPUT->footer();
