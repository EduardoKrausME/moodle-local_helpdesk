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
 * Close resolved tickets after 48 hours.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\task;

use local_helpdesk\model\ticket;

/**
 * Automatically closes tickets that have remained resolved for 48 hours.
 */
class close_tickets extends \core\task\scheduled_task {

    public function get_name() {
        return "Close tickets that have been resolved for 48 hours";
    }

    public function execute() {
        global $DB;

        $cutoff = time() - (2 * DAYSECS);
        $records = $DB->get_records_select(
            "local_helpdesk_ticket",
            "status = :status AND resolvedat IS NOT NULL AND resolvedat > 0 AND resolvedat <= :cutoff",
            ["status" => ticket::STATUS_RESOLVED, "cutoff" => $cutoff],
            "resolvedat ASC",
            "id"
        );

        foreach ($records as $record) {
            $ticket = ticket::get_by_id($record->id);
            if (!$ticket || $ticket->get_status() !== ticket::STATUS_RESOLVED) {
                continue;
            }
            $ticket->change_status(ticket::STATUS_CLOSED);
        }
    }
}
