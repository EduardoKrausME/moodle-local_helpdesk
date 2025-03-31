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

namespace local_helpdesk\util;

use local_kopere_dashboard\util\url_util;

/**
 * Class filter
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter {

    /**
     * Function load_kopere
     *
     */
    public static function load_kopere() {
        global $CFG;

        static $loadkopere = false;

        if (!$loadkopere) {
            $loadkopere = true;

            require_once("{$CFG->dirroot}/local/kopere_dashboard/autoload.php");
            local_kopere_dashboard_lang();
        }
    }

    /**
     * Function create_filter_course
     *
     * @param string $coursefullname
     * @param int $courseid
     *
     * @return mixed
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function create_filter_course($coursefullname, $courseid) {
        global $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "course_fullname" => $coursefullname,
            "course_id" => $courseid,
            "url_ajax" => false,
        ];

        $context = \context_system::instance();
        if (has_capability("local/helpdesk:ticketmanage", $context)) {
            $data["url_ajax"] = url_util::makeurl("courses", "load_all_courses", [], "view-ajax");
            $PAGE->requires->js_call_amd("local_helpdesk/filter_course", "init");
        }

        return $OUTPUT->render_from_template("local_helpdesk/filter-course", $data);
    }

    /**
     * Function create_filter_user
     *
     * @param string $userfullname
     * @param int $userid
     *
     * @return mixed
     */
    public static function create_filter_user($userfullname, $userid) {
        global $OUTPUT, $PAGE;

        self::load_kopere();

        $data = [
            "user_fullname" => $userfullname,
            "user_id" => $userid,
            "url_ajax" => url_util::makeurl("users", "load_all_users", [], "view-ajax"),
        ];
        $PAGE->requires->js_call_amd("local_helpdesk/filter_user", "init");
        return $OUTPUT->render_from_template("local_helpdesk/filter-user", $data);
    }
}
