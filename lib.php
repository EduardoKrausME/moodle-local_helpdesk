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
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_helpdesk\model\category;
use local_helpdesk\model\knowledgebase;

/**
 * Function local_helpdesk_extends_navigation
 *
 * @param global_navigation $nav
 *
 * @throws coding_exception
 * @throws dml_exception
 */
function local_helpdesk_extends_navigation(global_navigation $nav) {
    local_helpdesk_extend_navigation($nav);
}

/**
 * Function local_helpdesk_extend_navigation
 *
 * @param global_navigation $nav
 *
 * @throws coding_exception
 * @throws dml_exception
 */
function local_helpdesk_extend_navigation(global_navigation $nav) {
    global $PAGE, $COURSE, $SITE, $CFG;

    $CFG->custommenuitems = preg_replace('/\n.*\/local\/helpdesk.*/', '', $CFG->custommenuitems);

    $showmenu = true;
    if (!isloggedin()) {
        $showmenu = false;
    }

    $context = context_system::instance();
    if (!has_capability("local/helpdesk:view", $context)) {
        $showmenu = false;
    }

    if (!has_capability("local/helpdesk:ticketmanage", $context)) {
        if (!isset(get_config("local_helpdesk", "menu")[2])) {
            $showmenu = false;
        } else if (get_config("local_helpdesk", "menu") == "none") {
            $showmenu = false;
        } else if (get_config("local_helpdesk", "menu") == "course") {
            if ($COURSE->id == $SITE->id) {
                $showmenu = false;
            }
        }
    }

    if ($showmenu) {
        $courseid = "";
        if ($COURSE->id != $SITE->id) {
            $courseid = $COURSE->id;
        }

        try {
            $mynode = $PAGE->navigation->find("myprofile", navigation_node::TYPE_ROOTNODE);
            $mynode->collapse = true;
            $mynode->make_inactive();

            $name = get_string("pluginname", "local_helpdesk");
            if ($courseid) {
                $url = "{$CFG->wwwroot}/local/helpdesk/?courseid={$courseid}";
            } else {
                $url = "{$CFG->wwwroot}/local/helpdesk/";
            }
            $nav->add($name, new moodle_url($url));
            $node = $mynode->add($name, new moodle_url($url), 0, null, "helpdesk_menu");
            $node->showinflatnavigation = true;
            $name = str_replace(",", "&#44;", $name);
            $CFG->custommenuitems .= "\n{$name}|{$url}";
        } catch (Exception $e) { // phpcs:disable
        }
    }

    // Knowledge base menu.
    try {
        if (get_config("local_helpdesk", "knowledgebase_menu")) {
            $needaddmenu = true;
            $categorys = category::get_all(null, [], "name ASC");
            /** @var category $category */
            foreach ($categorys as $category) {

                $knowledgebases = knowledgebase::get_all(null, ["categoryid" => $category->get_id()], "title ASC");
                if ($knowledgebases) {
                    if ($needaddmenu) {
                        $name = get_string("knowledgebase_name", "local_helpdesk");
                        $url = "{$CFG->wwwroot}/local/helpdesk/knowledgebase.php";
                        $CFG->custommenuitems .= "\n{$name}|{$url}";
                        $needaddmenu = false;
                    }

                    $url = "{$CFG->wwwroot}/local/helpdesk/knowledgebase.php?cat={$category->get_id()}";
                    $CFG->custommenuitems .= "\n-{$category->get_name()}|{$url}";

                    /** @var knowledgebase $knowledgebase */
                    foreach ($knowledgebases as $knowledgebase) {
                        $url = "{$CFG->wwwroot}/local/helpdesk/knowledgebase.php?id={$knowledgebase->get_id()}";
                        $CFG->custommenuitems .= "\n--{$knowledgebase->get_title()}|{$url}";
                    }
                }
            }
        }
    } catch (Exception $e) { // phpcs:disable
    }
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
 *
 * @return bool false if the file not found, just send the file otherwise and do not return anything
 * @throws coding_exception
 * @throws moodle_exception
 * @throws require_login_exception
 */
function local_helpdesk_pluginfile($course, $cm, context $context, $filearea, $args, $forcedownload, array $options = []) {

    require_login($course, true, $cm);

    if (!has_capability("local/helpdesk:view", $context)) {
        return false;
    }

    $itemid = array_shift($args);

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

    $PAGE->set_secondarynav(local_helpdesk_get_navigation());
    $PAGE->set_secondary_navigation(true);
    $PAGE->set_secondary_active_tab("helpdesk");
}

/**
 * Builds a secondary navigation for all admin screens
 *
 * @return \core\navigation\views\secondary
 *
 * @throws \core\exception\moodle_exception
 * @throws coding_exception
 * @throws dml_exception
 */
function local_helpdesk_get_navigation() {
    global $PAGE;

    $nav = new \core\navigation\views\secondary($PAGE);

    $surl = new moodle_url("/local/helpdesk/", []);
    $nav->add_node($nav::create(get_string("tickets", "local_helpdesk"), $surl));

    $surl = new moodle_url("/local/helpdesk/categories.php", []);
    $nav->add_node($nav::create(get_string("categories", "local_helpdesk"), $surl));

    $surl = new moodle_url("/local/helpdesk/knowledgebase.php", []);
    $nav->add_node($nav::create(get_string("knowledgebase_name", "local_helpdesk"), $surl));

    if (has_capability("local/kopere_dashboard:view", context_system::instance())) {
        $surl = new moodle_url("/local/kopere_dashboard/view.php", ["classname" => "bi-dashboard", "method" => "start"]);
        $nav->add_node($nav::create(get_string("report_general_reports_page_title", "local_helpdesk"), $surl));
    }

    return $nav;
}
