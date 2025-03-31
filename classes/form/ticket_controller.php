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
 * file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\form;

use context_system;
use local_helpdesk\mail\ticket_mail;
use moodle_url;
use local_helpdesk\model\ticket;

/**
 * Class ticket_controller
 *
 * @package local_helpdesk\form
 */
class ticket_controller {

    /**
     * Exibe o formulário para adicionar um ticket.
     *
     * @throws \moodle_exception
     * @throws \core\exception\moodle_exception
     */
    public function insert_ticket() {
        global $PAGE, $OUTPUT, $USER;

        $hasticketmanage = has_capability("local/helpdesk:ticketmanage", context_system::instance());
        $form = new ticket_form(null, ["has_ticketmanage" => $hasticketmanage]);

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/index.php"));
        } else if ($data = $form->get_data()) {
            $ticket = new ticket([
                "userid" => $data->find_user,
                "courseid" => $data->courseid,
                "categoryid" => $data->categoryid,
                "subject" => $data->subject,
                "description" => $data->description["text"],
                "status" => ticket::STATUS_OPEN,
                "priority" => $data->priority,
                "createdat" => time(),
                "updatedat" => time(),
            ]);
            $ticket->save();

            $context = \context_system::instance();
            if ($data->attachment) {
                $options = [
                    "subdirs" => true,
                    "embed" => true,
                ];
                file_save_draft_area_files($data->attachment, $context->id,
                    "local_helpdesk", "ticket", $ticket->get_id(), $options);
            }

            $mail = new ticket_mail();
            $mail->send_ticket($ticket);

            redirect(new moodle_url("/local/helpdesk/index.php"));
        } else {
            $form->set_data([
                "action" => "add",
                "find_user" => $USER->id,
                "courseid" => optional_param("courseid", 0, PARAM_INT),
            ]);
        }

        $PAGE->set_title(get_string("addticket", "local_helpdesk"));
        $PAGE->set_heading(get_string("addticket", "local_helpdesk"));
        echo $OUTPUT->header();
        $form->display();
        echo $OUTPUT->footer();
        die;
    }

    /**
     * Exibe o formulário para editar um ticket existente.
     *
     * @param string $ticketid
     *
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function update_ticket($ticketid) {
        global $PAGE, $OUTPUT;

        $ticket = ticket::get_by_id($ticketid);

        $form = new ticket_form(null, ["ticket" => $ticket]);

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/index.php"));
        } else if ($data = $form->get_data()) {
            $ticket->set_subject($data->subject);
            $ticket->set_description($data->description["text"]);
            $ticket->set_priority($data->priority);
            $ticket->set_updatedat(time());

            $ticket->save();

            redirect(new moodle_url("/local/helpdesk/index.php"));
        } else {
            $form->set_data([
                "id" => $ticket->get_id(),
                "categoryid" => $ticket->get_categoryid(),
                "subject" => $ticket->get_subject(),
                "description" => [
                    "text" => $ticket->get_description(),
                ],
                "status" => $ticket->get_status(),
                "priority" => $ticket->get_priority(),
                "createdat" => $ticket->get_createdat(),
                "updatedat" => $ticket->get_updatedat(),
                "action" => "edit",
            ]);
        }

        $PAGE->set_title(get_string("editticket", "local_helpdesk"));
        $PAGE->set_heading(get_string("editticket", "local_helpdesk"));
        echo $OUTPUT->header();
        $form->display();
        echo $OUTPUT->footer();
        die;
    }
}
