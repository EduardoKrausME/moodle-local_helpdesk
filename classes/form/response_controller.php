<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Helpdesk response controller.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\form;

use local_helpdesk\mail\ticket_mail;
use local_helpdesk\model\response;
use local_helpdesk\model\ticket;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

require_once("{$CFG->libdir}/formslib.php");

/**
 * Response controller.
 */
class response_controller {

    /**
     * Insert a ticket response.
     *
     * @param ticket $ticket
     * @param bool $hasticketmanage
     * @return string
     */
    public function insert_response($ticket, $hasticketmanage) {
        global $USER;

        $form = new response_form(null, ["ticket" => $ticket, "hasticketmanage" => $hasticketmanage]);

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/ticket.php?id={$ticket->get_idkey()}"));
        } else if ($data = $form->get_data()) {
            $now = time();
            $issupportreply = $hasticketmanage && (int)$ticket->get_userid() !== (int)$USER->id;

            // answeredat means the first real message from support, not a user reply or a status log.
            if ($issupportreply && !$ticket->get_answeredat()) {
                $ticket->set_answeredat($now);
                $ticket->set_updatedat($now);
                $ticket->save();
            }

            if ($ticket->get_status() === ticket::STATUS_OPEN && $issupportreply) {
                $ticket->change_status(ticket::STATUS_PROGRESS);
            }

            $response = new response([
                "ticketid" => $ticket->get_id(),
                "message" => $data->message["text"],
                "type" => response::TYPE_MESSAGE,
                "userid" => $USER->id,
                "createdat" => $now,
            ]);
            $response->save($ticket);

            // A normal response is also activity on the ticket.
            $ticket->set_updatedat($now);
            $ticket->save();

            $context = \context_system::instance();
            if ($data->attachment) {
                $options = [
                    "subdirs" => true,
                    "embed" => true,
                ];
                file_save_draft_area_files(
                    $data->attachment,
                    $context->id,
                    "local_helpdesk",
                    "response",
                    $response->get_id(),
                    $options
                );
            }

            $mail = new ticket_mail();
            $mail->send_response($ticket, $response);

            if (isset($data->buttonar["resolvedbutton"])) {
                $ticket->change_status(ticket::STATUS_RESOLVED);
            }
            if (isset($data->buttonar["closebutton"])) {
                $ticket->change_status(ticket::STATUS_CLOSED);
            }

            redirect(new moodle_url("/local/helpdesk/ticket.php?id={$ticket->get_idkey()}"));
        } else {
            $form->set_data([
                "id" => $ticket->get_id(),
                "idkey" => $ticket->get_idkey(),
            ]);
        }

        $form->display();
    }
}
