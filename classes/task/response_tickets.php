<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Remind support about tickets unanswered for more than three days.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\task;

use local_helpdesk\mail\ticket_mail;
use local_helpdesk\model\ticket;

/**
 * Sends a single reminder to the category support users for an unanswered ticket.
 */
class response_tickets extends \core\task\scheduled_task {

    public function get_name() {
        return "Send email when a Ticket has been unanswered for more than 3 days";
    }

    public function execute() {
        global $DB;

        $cutoff = time() - (3 * DAYSECS);
        $sql = "
            SELECT id
              FROM {local_helpdesk_ticket}
             WHERE status IN (:openstatus, :progressstatus)
               AND createdat <= :cutoff
               AND (answeredat IS NULL OR answeredat = 0)
               AND (remindedat IS NULL OR remindedat = 0)
          ORDER BY createdat ASC";

        $records = $DB->get_records_sql($sql, [
            "openstatus" => ticket::STATUS_OPEN,
            "progressstatus" => ticket::STATUS_PROGRESS,
            "cutoff" => $cutoff,
        ]);

        $mail = new ticket_mail();
        foreach ($records as $record) {
            $ticket = ticket::get_by_id($record->id);
            if (!$ticket || $ticket->get_answeredat() || $ticket->get_remindedat()) {
                continue;
            }

            try {
                $mail->send_unanswered_reminder($ticket);
                $ticket->set_remindedat(time());
                $ticket->set_updatedat(time());
                $ticket->save();
            } catch (\Throwable $e) {
                mtrace("Helpdesk reminder failed for ticket {$record->id}: {$e->getMessage()}");
            }
        }
    }
}
