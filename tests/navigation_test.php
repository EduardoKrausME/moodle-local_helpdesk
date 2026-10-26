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
 * Helpdesk navigation regression tests.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use advanced_testcase;
use context_course;
use context_system;

/**
 * Verify menu visibility across Moodle contexts and settings.
 *
 * @covers \local_helpdesk\navigation
 */
final class navigation_test extends advanced_testcase {
    /**
     * Check the site-wide and course-only top menu policies.
     */
    public function test_primary_menu_respects_location_and_setting(): void {
        global $PAGE, $SITE;

        $this->resetAfterTest();
        $context = context_system::instance();
        $user = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();
        assign_capability("local/helpdesk:view", CAP_ALLOW, $roleid, $context->id);
        role_assign($roleid, $user->id, $context->id);
        $this->setUser($user);

        $PAGE->set_course($SITE);
        $PAGE->set_context($context);

        set_config("menu", "none", "local_helpdesk");
        $this->assertFalse(navigation::should_show());
        set_config("menu", "course", "local_helpdesk");
        $this->assertFalse(navigation::should_show());
        set_config("menu", "system", "local_helpdesk");
        $this->assertTrue(navigation::should_show());
        $this->assertSame("/local/helpdesk/index.php", navigation::get_url()->get_path());

        $course = $this->getDataGenerator()->create_course();
        $PAGE->set_course($course);
        $PAGE->set_context(context_course::instance($course->id));
        set_config("menu", "course", "local_helpdesk");
        $this->assertTrue(navigation::should_show());
        $this->assertSame((string)$course->id, (string)navigation::get_url()->get_param("courseid"));

        set_config("menu", "none", "local_helpdesk");
        $this->assertFalse(navigation::should_show());
    }

    /**
     * Administrators always use the Kopere Dashboard management entry.
     */
    public function test_primary_menu_excludes_site_administrators(): void {
        $this->resetAfterTest();
        $this->setAdminUser();

        set_config("menu", "system", "local_helpdesk");
        $this->assertFalse(navigation::should_show());
    }
}
