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
 * lib file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core\navigation\views\secondary;

/**
 * Add a single Helpdesk link for learners in the regular Moodle navigation.
 *
 * Support agents use the Kopere Dashboard menu instead.
 *
 * @param global_navigation $nav Moodle navigation.
 * @return void
 */
function local_helpdesk_extend_navigation(global_navigation $nav) {
    global $COURSE, $SITE;

    if (!isloggedin() || isguestuser()) {
        return;
    }

    $context = context_system::instance();
    if ((!has_capability("local/helpdesk:view", $context)
            && !has_capability("local/helpdesk:viewall", $context))
        || has_capability("local/helpdesk:ticketmanage", $context)) {
        return;
    }

    $setting = get_config("local_helpdesk", "menu");
    if ($setting === "none") {
        return;
    }

    $incourse = isset($COURSE->id) && $COURSE->id != $SITE->id;
    if (($setting === "course" || $setting === false) && !$incourse) {
        return;
    }

    $params = $incourse ? ["courseid" => $COURSE->id] : [];
    $nav->add(
        get_string("pluginname", "local_helpdesk"),
        new moodle_url("/local/helpdesk/index.php", $params),
        navigation_node::TYPE_CUSTOM,
        null,
        "helpdesk_menu"
    );
}

/**
 * Serve the files from the helpdesk file areas
 *
 * @param stdClass $course    the course object
 * @param stdClass $cm        the course module object
 * @param context $context    the context
 * @param string $filearea    the name of the file area
 * @param array $args         extra arguments (itemid, path)
 * @param bool $forcedownload whether or not force download
 * @param array $options      additional options affecting the file serving
 * @return bool false if the file not found, just send the file otherwise and do not return anything
 * @throws coding_exception
 * @throws moodle_exception
 * @throws require_login_exception
 */
function local_helpdesk_pluginfile($course, $cm, context $context, $filearea, $args, $forcedownload, array $options = []) {
    global $DB;

    require_login($course, true, $cm);

    if ($context->contextlevel !== CONTEXT_SYSTEM
        || !in_array($filearea, ["ticket", "response"], true)) {
        return false;
    }

    $itemid = (int)array_shift($args);
    if (!$itemid) {
        return false;
    }

    // Authorise the specific ticket, not just the Helpdesk file area.
    if ($filearea === "ticket") {
        $ticketrecord = $DB->get_record("local_helpdesk_ticket", ["id" => $itemid]);
    } else {
        $response = \local_helpdesk\model\response::get_by_id($itemid);
        $ticketrecord = $response
            ? $DB->get_record("local_helpdesk_ticket", ["id" => $response->get_ticketid()])
            : null;
    }
    $ticket = $ticketrecord ? new \local_helpdesk\model\ticket($ticketrecord) : null;
    if (!$ticket) {
        return false;
    }
    $ticketcontext = $ticket->get_courseid()
        ? context_course::instance($ticket->get_courseid())
        : context_system::instance();
    if (!\local_helpdesk\access::can_view_ticket($ticket, $ticketcontext)) {
        return false;
    }

    // Extract the filename / filepath from the $args array.
    $filename = array_pop($args); // The last item in the $args array.
    if (!$args) {
        // Variable $args is empty => the path is "/".
        $filepath = "/";
    } else {
        // Variable $args contains elements of the filepath.
        $filepath = "/" . implode("/", $args) . "/";
    }

    // Retrieve the file from the Files API.
    $fs = get_file_storage();
    $file = $fs->get_file($context->id, "local_helpdesk", $filearea, $itemid, $filepath, $filename);
    if ($file) {
        send_stored_file($file, 86400, 0, $forcedownload, $options);
        return true;
    }
    return false;
}

/**
 * Function local_helpdesk_set_secondarynav
 *
 * @throws \core\exception\moodle_exception
 * @throws coding_exception
 * @throws dml_exception
 */
function local_helpdesk_set_secondarynav() {
    global $PAGE;

    if (\local_helpdesk\output\page::uses_dashboard()) {
        return;
    }

    $PAGE->set_secondarynav(local_helpdesk_get_navigation());
    $PAGE->set_secondary_navigation(true);
    $PAGE->set_secondary_active_tab("helpdesk");
}

/**
 * Builds a secondary navigation for all admin screens
 *
 * @return secondary
 * @throws \core\exception\moodle_exception
 * @throws coding_exception
 * @throws dml_exception
 */
function local_helpdesk_get_navigation() {
    global $PAGE;

    $nav = new secondary($PAGE);

    $surl = new moodle_url("/local/helpdesk/", []);
    $nav->add_node($nav::create(get_string("tickets", "local_helpdesk"), $surl));

    $surl = new moodle_url("/local/helpdesk/categories.php", []);
    $nav->add_node($nav::create(get_string("categories", "local_helpdesk"), $surl));

    $surl = new moodle_url("/local/helpdesk/knowledgebase.php", []);
    $nav->add_node($nav::create(get_string("knowledgebase_name", "local_helpdesk"), $surl));

    if (has_capability("local/kopere_dashboard:view", context_system::instance())) {
        $surl = new moodle_url("/local/helpdesk/report.php");
        $nav->add_node($nav::create(get_string("report_general_reports_page_title", "local_helpdesk"), $surl));
    }

    return $nav;
}
