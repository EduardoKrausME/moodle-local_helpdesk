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
 * Privacy Subsystem implementation for local_helpdesk.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\task;

use local_helpdesk\model\ticket;

/**
 * Class close_tickets
 *
 * @package local_helpdesk\task
 */
class close_tickets extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for the task (shown to admins)
     *
     * @return string
     */
    public function get_name() {
        return "Close tickets that are complete and unanswered for 48 hours";
    }

    /**
     * Do the job.
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {
        global $DB;

        $sql = "
            SELECT DISTINCT t.id
              FROM {local_helpdesk_ticket}   t
              JOIN {local_helpdesk_response} r ON t.id = r.ticketid
             WHERE t.status = 'closed'
               AND (:time - r.ticketid) >= 172800";
        $tickets = $DB->get_records_sql($sql, ["time" => time()]);
        foreach ($tickets as $ticket) {
            $ticket = ticket::get_by_id($ticket->id);
            $ticket->change_status(ticket::STATUS_RESOLVED);
        }
    }
}
