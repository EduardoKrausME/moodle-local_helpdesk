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

namespace local_khelpdesk\util;

/**
 * Class filter
 *
 * @package   local_khelpdesk
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter {

    /**
     * Function load_kopere
     *
     */
    private static function load_kopere() {
        global $CFG;

        static $loadkopere = false;

        if (!$loadkopere) {
            $loadkopere = true;

            require_once "{$CFG->dirroot}/local/kdashboard/autoload.php";
            get_klang();
        }
    }

    /**
     * Function create_filter_course
     *
     * @param $coursefullname
     * @param $courseid
     *
     * @return mixed
     */
    public static function create_filter_course($coursefullname, $courseid) {
        global $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "course_fullname" => $coursefullname,
            "course_id" => $courseid,
            "url_ajax" => local_kdashboard_makeurl("courses", "load_all_courses", [], "view-ajax"),
        ];
        $PAGE->requires->js_call_amd("local_khelpdesk/filter_course", "init");
        return $OUTPUT->render_from_template('local_khelpdesk/filter-course', $data);
    }

    /**
     * Function create_filter_user
     *
     * @param $userfullname
     * @param $userid
     *
     * @return mixed
     */
    public static function create_filter_user($userfullname, $userid) {
        global $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "user_fullname" => $userfullname,
            "user_id" => $userid,
            "url_ajax" => local_kdashboard_makeurl("users", "load_all_users", [], "view-ajax"),
        ];
        $PAGE->requires->js_call_amd("local_khelpdesk/filter_user", "init");
        return $OUTPUT->render_from_template('local_khelpdesk/filter-user', $data);
    }
}
