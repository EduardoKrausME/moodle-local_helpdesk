<?php
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
