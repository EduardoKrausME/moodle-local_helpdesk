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
use local_helpdesk\model\response;
use local_helpdesk\model\ticket;
use local_helpdesk\util\files;
use local_kopere_dashboard\vo\local_kopere_dashboard_event;

defined('MOODLE_INTERNAL') || die();

require_once("{$CFG->dirroot}/local/kopere_dashboard/autoload.php");

/**
 * Class ticket_mail
 *
 * @package local_helpdesk\mail
 */
class ticket_mail {

    /**
     * Function send
     *
     * @param ticket $ticket
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function send_ticket(ticket $ticket) {
        global $OUTPUT, $CFG;

        $sendevents = new send_message();

        $files = files::all("ticket", $ticket->get_id());
        $event = (object)[
            "categoryname" => $ticket->get_category()->get_name(),
            "categorylink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/?find_category={$ticket->get_categoryid()}",
                    "text" => $ticket->get_category()->get_name(),
                ]),
            "subjectname" => $ticket->get_subject(),
            "subjectlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                    "text" => $ticket->get_subject(),
                ]),
            "helpdesk" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/",
                    "text" => get_string("pluginname", "local_helpdesk"),
                ]),
            "tiketidname" => $ticket->get_idkey(),
            "tiketidlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                    "text" => $ticket->get_idkey(),
                ]),
            "text" => $ticket->get_description(),
            "attachment" => $OUTPUT->render_from_template("local_helpdesk/mail-attachment",
                [
                    "responsefiles_count" => count($files),
                    "responsefiles" => $files,
                ]),
        ];
        $sendevents->set_event($event);

        $kopereevent = new local_kopere_dashboard_event();
        $kopereevent->userfrom = "admin";
        $kopereevent->subject = get_string("mailticket_subject", "local_helpdesk");

        // To Category Users.
        $kopereevent->message = get_string("mailticket_create_message", "local_helpdesk");
        $sendevents->set_local_kopere_dashboard_event($kopereevent);

        $categoryusers = category_users::get_all(null, ["categoryid" => $ticket->get_categoryid()]);
        $sendevents->send_mail($ticket, $categoryusers);

        // To Creator User.
        $kopereevent->message = get_string("mailticket_user_message", "local_helpdesk");
        $sendevents->set_local_kopere_dashboard_event($kopereevent);

        $categoryusers = [new category_users(["userid" => $ticket->get_userid()])];
        $sendevents->send_mail($ticket, $categoryusers);
    }

    /**
     * Function send_response
     *
     * @param ticket $ticket
     * @param response $response
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function send_response(ticket $ticket, response $response) {
        global $OUTPUT, $CFG;

        $sendevents = new send_message();

        $files = files::all("response", $response->get_id());
        $event = (object)[
            "categoryname" => $ticket->get_category()->get_name(),
            "categorylink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/?find_category={$ticket->get_categoryid()}",
                    "text" => $ticket->get_category()->get_name(),
                ]),
            "subjectname" => $ticket->get_subject(),
            "subjectlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                    "text" => $ticket->get_subject(),
                ]),
            "helpdesk" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/",
                    "text" => get_string("pluginname", "local_helpdesk"),
                ]),
            "tiketidname" => $ticket->get_idkey(),
            "tiketidlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link",
                [
                    "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                    "text" => $ticket->get_idkey(),
                ]),
            "text" => $response->get_message(),
            "attachment" => $OUTPUT->render_from_template("local_helpdesk/mail-attachment",
                [
                    "responsefiles_count" => count($files),
                    "responsefiles" => $files,
                ]),
        ];
        $sendevents->set_event($event);

        $kopereevent = new local_kopere_dashboard_event();
        $kopereevent->userfrom = "admin";
        $kopereevent->subject = "Re: " . get_string("mailticket_subject", "local_helpdesk");

        // To Category Users.
        $kopereevent->message = get_string("mailticket_create_message", "local_helpdesk");
        $sendevents->set_local_kopere_dashboard_event($kopereevent);

        $categoryusers = category_users::get_all(null, ["categoryid" => $ticket->get_categoryid()]);
        $sendevents->send_mail($ticket, $categoryusers);

        // To Creator User.
        $kopereevent->message = get_string("mailticket_user_message", "local_helpdesk");
        $sendevents->set_local_kopere_dashboard_event($kopereevent);

        $categoryusers = [new category_users(["userid" => $ticket->get_userid()])];
        $sendevents->send_mail($ticket, $categoryusers);
    }
}
