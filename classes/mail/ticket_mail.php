<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Ticket email notifications.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\mail;

use local_helpdesk\model\category_users;
use local_helpdesk\model\response;
use local_helpdesk\model\ticket;
use local_helpdesk\util\files;
use local_kopere_dashboard\output\events\event_info;

/**
 * Ticket mail service.
 */
class ticket_mail {

    /**
     * Build the common event variables used by helpdesk email templates.
     *
     * @param ticket $ticket
     * @param string $text
     * @param array $attachments
     * @return object
     */
    private function build_event(ticket $ticket, $text, array $attachments) {
        global $OUTPUT, $CFG;

        return (object)[
            "categoryname" => $ticket->get_category()->get_name(),
            "categorylink" => $OUTPUT->render_from_template("local_helpdesk/mail-link", [
                "link" => "{$CFG->wwwroot}/local/helpdesk/?find_category={$ticket->get_categoryid()}",
                "text" => $ticket->get_category()->get_name(),
            ]),
            "subjectname" => $ticket->get_subject(),
            "subjectlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link", [
                "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                "text" => $ticket->get_subject(),
            ]),
            "helpdesk" => $OUTPUT->render_from_template("local_helpdesk/mail-link", [
                "link" => "{$CFG->wwwroot}/local/helpdesk/",
                "text" => get_string("pluginname", "local_helpdesk"),
            ]),
            "tiketidname" => $ticket->get_idkey(),
            "tiketidlink" => $OUTPUT->render_from_template("local_helpdesk/mail-link", [
                "link" => "{$CFG->wwwroot}/local/helpdesk/ticket.php?id={$ticket->get_idkey()}",
                "text" => $ticket->get_idkey(),
            ]),
            "text" => $text,
            "attachment" => $OUTPUT->render_from_template("local_helpdesk/mail-attachment", [
                "responsefiles_count" => count($attachments),
                "responsefiles" => $attachments,
            ]),
        ];
    }

    /**
     * Send new ticket notification.
     *
     * @param ticket $ticket
     */
    public function send_ticket(ticket $ticket) {
        $sendevents = new send_message();
        $files = files::all("ticket", $ticket->get_id());
        $sendevents->set_event($this->build_event($ticket, $ticket->get_description(), $files));

        $kopereevent = new event_info();
        $kopereevent->userfrom = "admin";
        $kopereevent->subject = get_string("mailticket_subject", "local_helpdesk");

        $kopereevent->message = get_string("mailticket_create_message", "local_helpdesk");
        $sendevents->set_event_info($kopereevent);
        $categoryusers = category_users::get_all(null, ["categoryid" => $ticket->get_categoryid()]);
        $sendevents->send_mail($ticket, $categoryusers);

        $kopereevent->message = get_string("mailticket_user_message", "local_helpdesk");
        $sendevents->set_event_info($kopereevent);
        $sendevents->send_mail($ticket, [new category_users(["userid" => $ticket->get_userid()])]);
    }

    /**
     * Send response notification.
     *
     * @param ticket $ticket
     * @param response $response
     */
    public function send_response(ticket $ticket, response $response) {
        $sendevents = new send_message();
        $files = files::all("response", $response->get_id());
        $sendevents->set_event($this->build_event($ticket, $response->get_message(), $files));

        $kopereevent = new event_info();
        $kopereevent->userfrom = "admin";
        $kopereevent->subject = "Re: " . get_string("mailticket_subject", "local_helpdesk");

        $kopereevent->message = get_string("mailticket_update_message", "local_helpdesk");
        $sendevents->set_event_info($kopereevent);
        $categoryusers = category_users::get_all(null, ["categoryid" => $ticket->get_categoryid()]);
        $sendevents->send_mail($ticket, $categoryusers);

        $kopereevent->message = get_string("mailticket_user_message", "local_helpdesk");
        $sendevents->set_event_info($kopereevent);
        $sendevents->send_mail($ticket, [new category_users(["userid" => $ticket->get_userid()])]);
    }

    /**
     * Remind the support users assigned to the ticket category when no support answer
     * has been registered after three days. The ticket owner is not emailed by this task.
     *
     * @param ticket $ticket
     */
    public function send_unanswered_reminder(ticket $ticket) {
        $sendevents = new send_message();
        $files = files::all("ticket", $ticket->get_id());
        $sendevents->set_event($this->build_event($ticket, $ticket->get_description(), $files));

        $kopereevent = new event_info();
        $kopereevent->userfrom = "admin";
        $kopereevent->subject = get_string("mailticket_reminder_subject", "local_helpdesk");
        $kopereevent->message = get_string("mailticket_reminder_message", "local_helpdesk");
        $sendevents->set_event_info($kopereevent);

        $categoryusers = category_users::get_all(null, ["categoryid" => $ticket->get_categoryid()]);
        $sendevents->send_mail($ticket, $categoryusers);
    }
}
