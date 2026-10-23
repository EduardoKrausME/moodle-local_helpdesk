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
 * Tests for Helpdesk notification template initialization.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use advanced_testcase;
use local_helpdesk\mail\send_message;
use local_helpdesk\model\ticket;
use local_kopere_dashboard\output\events\event_info;

/**
 * Test that Helpdesk initializes event templates before substituting tokens.
 *
 * @covers \local_helpdesk\mail\send_message
 */
final class send_message_test extends advanced_testcase {
    /**
     * Both initial delivery and a reused sender should use the active templates.
     */
    public function test_send_mail_initializes_and_refreshes_templates(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        $sender = new class extends send_message {
            /**
             * Expose the processed notification contents for assertions.
             *
             * @return array
             */
            public function processed_templates(): array {
                return [$this->subject, $this->message];
            }
        };

        $sender->set_event((object)[
            "id" => 42,
            "name" => "Printer",
            "other" => [],
        ]);

        $eventinfo = new event_info();
        $eventinfo->subject = "Ticket {[event.id]}";
        $eventinfo->message = "Created {[event.name]}";
        $sender->set_event_info($eventinfo);

        // An empty recipient list lets us exercise the templates without sending notifications.
        $ticket = new ticket(["courseid" => 0]);
        $sender->send_mail($ticket, []);
        $this->assertSame(["Ticket 42", "Created Printer"], $sender->processed_templates());

        $eventinfo->message = "Updated {[event.name]}";
        $sender->send_mail($ticket, []);
        $this->assertSame(["Ticket 42", "Updated Printer"], $sender->processed_templates());
    }
}
