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
 * ticket file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\mail;

use local_helpdesk\model\category_users;
use local_helpdesk\model\ticket;
use local_kopere_dashboard\output\events\send_events;
use local_kopere_dashboard\util\release;

/**
 * Class send_message
 *
 * @package local_helpdesk\mail
 */
class send_message extends send_events {
    /**
     * Function send
     *
     * @param ticket $ticket
     * @param array $categoryusers
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function send_mail(ticket $ticket, array $categoryusers) {
        global $COURSE, $CFG, $DB, $USER;

        require_once("{$CFG->dirroot}/login/lib.php");

        $this->load_template();

        $this->subject = $this->replace_date($this->subject);
        $this->message = $this->replace_date($this->message);

        $COURSE->wwwroot = $CFG->wwwroot;
        $COURSE->link = "<a href='{$CFG->wwwroot}' target=\"_blank\">{$CFG->wwwroot}</a>";
        $COURSE->url = $CFG->wwwroot;

        // Moodle: {[ moodle.??? ]}.
        $this->subject = $this->replace_tag($this->subject, $COURSE, "moodle");
        $this->message = $this->replace_tag($this->message, $COURSE, "moodle");

        // Events: {[ event.??? ]}.
        $this->subject = $this->replace_tag($this->subject, $this->event, "event");
        $this->message = $this->replace_tag($this->message, $this->event, "event");

        if ($ticket->get_courseid()) {
            $course = $DB->get_record("course", ["id" => $ticket->get_courseid()]);

            $course->link
                = "<a href='{$CFG->wwwroot}/course/view.php?id={$ticket->get_courseid()}'
                      target=\"_blank\">{$CFG->wwwroot}/course/view.php?id={$ticket->get_courseid()}</a>";
            $course->url = "{$CFG->wwwroot}/course/view.php?id={$ticket->get_courseid()}";

            $this->subject = $this->replace_tag($this->subject, $course, "course");
            $this->message = $this->replace_tag($this->message, $course, "course");
        }

        $userfrom = get_admin();
        $userfrom->fullname = fullname($userfrom);
        $this->subject = self::replace_tag_user($this->subject, $userfrom, "from");
        $this->message = self::replace_tag_user($this->message, $userfrom, "from");

        // Admins: {[ admin.??? ]}.
        $this->subject = self::replace_tag_user($this->subject, $userfrom, "admin");
        $this->message = self::replace_tag_user($this->message, $userfrom, "admin");

        $sendedusers = [];

        /** @var category_users $categoryuser */
        foreach ($categoryusers as $categoryuser) {

            if (isset($sendedusers[$categoryuser->get_userid()])) {
                continue;
            }
            $sendedusers[$categoryuser->get_userid()] = true;

            $userto = $categoryuser->get_user();
            $userto->fullname = fullname($userto);

            if (isset($this->event->other["password"])) {
                $userto->password = $this->event->other["password"];
            } else if (strpos($this->message, "{[to.password]}")) {
                $newpassword = $this->login_generate_password($userto);
                $userto->password = "{$CFG->wwwroot}/login/forgot_password.php?token={$newpassword}";
            } else if (isset($USER->tmp_password)) {
                $userto->password = $USER->tmp_password;
            }

            $sendsubject = self::replace_tag_user($this->subject, $userto, "to");
            $htmlmessage = self::replace_tag_user($this->message, $userto, "to");

            $magager = "<a href='{$CFG->wwwroot}/message/notificationpreferences.php'>" .
                string_kopere("notification_manager", "local_kopere_dashboard") . "</a>";
            $htmlmessage = str_replace("{[manager]}", $magager, $htmlmessage);

            $eventdata = new \core\message\message();
            if ($ticket->get_courseid()) {
                $eventdata->courseid = $ticket->get_courseid();
            } else {
                $eventdata->courseid = SITEID;
            }
            $eventdata->modulename = "moodle";
            $eventdata->component = "local_kopere_dashboard";
            $eventdata->name = "kopere_dashboard_messages";
            $eventdata->userfrom = $userfrom;
            $eventdata->userto = $userto;
            $eventdata->subject = $sendsubject;
            $eventdata->fullmessage = html_to_text($htmlmessage);
            $eventdata->fullmessageformat = FORMAT_HTML;
            $eventdata->fullmessagehtml = $htmlmessage;
            $eventdata->smallmessage = "";

            message_send($eventdata);
        }
    }
}
