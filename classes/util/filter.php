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
 * filter.php
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\util;

/**
 * Provides reusable course and user picker helpers for Helpdesk pages.
 */
class filter {

    /**
     * Registers the JavaScript language strings used by Kopere Dashboard DataTables.
     *
     * @return void
     */
    public static function load_kopere() {
        static $loaded = false;

        if ($loaded) {
            return;
        }

        $loaded = true;
        \local_kopere_dashboard\html\data_table::lang();
    }

    /**
     * Creates the course selector.
     *
     * @param string $coursefullname Current course name.
     * @param int $courseid Current course ID.
     * @return string
     */
    public static function create_filter_course($coursefullname, $courseid) {
        global $CFG, $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "course_fullname" => $coursefullname,
            "course_id" => $courseid,
            "url_ajax" => false,
            "sesskey" => sesskey(),
        ];

        $context = \context_system::instance();
        if (has_capability("local/helpdesk:ticketmanage", $context)) {
            $data["url_ajax"] = "{$CFG->wwwroot}/local/kopere_dashboard/plugins/courses/ajax.php";
            $PAGE->requires->js_call_amd("local_helpdesk/filter_course", "init");
        }

        return $OUTPUT->render_from_template("local_helpdesk/filter-course", $data);
    }

    /**
     * Creates the user selector.
     *
     * @param string $userfullname Current user name.
     * @param int $userid Current user ID.
     * @return string
     */
    public static function create_filter_user($userfullname, $userid) {
        global $CFG, $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "user_fullname" => $userfullname,
            "user_id" => $userid,
            "url_ajax" => "{$CFG->wwwroot}/local/kopere_dashboard/plugins/users/ajax.php",
            "sesskey" => sesskey(),
        ];

        $PAGE->requires->js_call_amd("local_helpdesk/filter_user", "init");

        return $OUTPUT->render_from_template("local_helpdesk/filter-user", $data);
    }
}
