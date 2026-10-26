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
 * Tests for read-only ticket access.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use advanced_testcase;
use context_system;
use local_helpdesk\model\ticket;

/**
 * Read-only permission regression tests.
 *
 * @covers \local_helpdesk\access
 * @covers \local_helpdesk\menu
 */
final class viewall_access_test extends advanced_testcase {
    /**
     * Viewall-only roles can read other tickets but cannot write.
     */
    public function test_viewall_does_not_imply_writing(): void {
        $this->resetAfterTest();
        $context = context_system::instance();
        $viewer = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();
        assign_capability("local/helpdesk:viewall", CAP_ALLOW, $roleid, $context->id);
        role_assign($roleid, $viewer->id, $context->id);
        $this->setUser($viewer);

        $ticket = new ticket(["userid" => $viewer->id + 1, "courseid" => 0]);
        $this->assertTrue(access::can_view_all($context));
        $this->assertTrue(access::can_view_ticket($ticket, $context));
        $this->assertFalse(access::can_create($context));
        $this->assertFalse(access::can_reply($ticket, $context));
        $this->assertFalse(has_capability("local/helpdesk:ticketmanage", $context));

        $definition = menu::get_definition($context);
        $this->assertSame("local/helpdesk:viewall", $definition["items"][0]["capability"]);
        $this->assertCount(1, $definition["items"][0]["children"]);
    }

    /**
     * Ordinary view capability keeps ownership restrictions.
     */
    public function test_owner_view_does_not_grant_access_to_other_tickets(): void {
        $this->resetAfterTest();
        $context = context_system::instance();
        $owner = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();
        assign_capability("local/helpdesk:view", CAP_ALLOW, $roleid, $context->id);
        role_assign($roleid, $owner->id, $context->id);
        $this->setUser($owner);

        $mine = new ticket(["userid" => $owner->id, "courseid" => 0]);
        $other = new ticket(["userid" => $owner->id + 1, "courseid" => 0]);
        $this->assertFalse(access::can_view_all($context));
        $this->assertTrue(access::can_create($context));
        $this->assertTrue(access::can_view_ticket($mine, $context));
        $this->assertTrue(access::can_reply($mine, $context));
        $this->assertFalse(access::can_view_ticket($other, $context));
        $this->assertFalse(access::can_reply($other, $context));
    }

    /**
     * Existing agent access remains available.
     */
    public function test_support_access_is_not_reduced(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        $context = context_system::instance();
        $ticket = new ticket(["userid" => 123456, "courseid" => 0]);
        $this->assertTrue(access::can_view_all($context));
        $this->assertTrue(access::can_view_ticket($ticket, $context));
        $this->assertTrue(access::can_create($context));
        $this->assertTrue(access::can_reply($ticket, $context));
    }
}
