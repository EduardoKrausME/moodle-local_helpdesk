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
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Function local_khelpdesk_extends_navigation
 *
 * @param global_navigation $nav
 *
 * @throws coding_exception
 * @throws dml_exception
 */
function local_khelpdesk_extends_navigation(global_navigation $nav) {
    local_khelpdesk_extend_navigation($nav);
}


/**
 * Function local_khelpdesk_extend_navigation
 *
 * @param global_navigation $nav
 *
 * @throws coding_exception
 * @throws dml_exception
 */
function local_khelpdesk_extend_navigation(global_navigation $nav) {
    global $PAGE, $COURSE, $SITE, $CFG;

    if (!isloggedin()) {
        return;
    }

    $context = context_system::instance();

    if (!has_capability("local/khelpdesk:view", $context)) {
        return;
    }

    if (!has_capability("local/khelpdesk:ticketmanage", $context)) {
        if (!isset(get_config("local_khelpdesk", "menu")[2])) {
            return;
        } else if (get_config("local_khelpdesk", "menu") == "none") {
            return;
        } else if (get_config("local_khelpdesk", "menu") == "course") {
            if ($COURSE->id == $SITE->id) {
                return;
            }
        }
    }

    $courseid = "";
    if ($COURSE->id != $SITE->id) {
        $courseid = $COURSE->id;
    }

    try {
        $mynode = $PAGE->navigation->find("myprofile", navigation_node::TYPE_ROOTNODE);
        $mynode->collapse = true;
        $mynode->make_inactive();

        $name = get_string("pluginname", "local_khelpdesk");
        if ($courseid) {
            $url = new moodle_url("/local/khelpdesk/?courseid={$courseid}");
        } else {
            $url = new moodle_url("/local/khelpdesk/");
        }
        $nav->add($name, $url);
        $node = $mynode->add($name, $url, 0, null, "khelpdesk_admin", new pix_icon("i/pie_chart", "", "local_khelpdesk"));
        $node->showinflatnavigation = true;

        $CFG->custommenuitems .= "\n-{$name}|{$url}";
    } catch (Exception $e) { // phpcs:disable
    }
}

/**
 * Serve the files from the khelpdesk file areas
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
function local_khelpdesk_pluginfile($course, $cm, context $context, $filearea, $args, $forcedownload, array $options = []) {

    require_login($course, true, $cm);

    if (!has_capability("local/khelpdesk:view", $context)) {
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
    $file = $fs->get_file($context->id, "local_khelpdesk", $filearea, $itemid, $filepath, $filename);
    if ($file) {
        send_stored_file($file, 86400, 0, $forcedownload, $options);
        return true;
    }
    return false;
}
