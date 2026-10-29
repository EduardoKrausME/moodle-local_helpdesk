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
 * Navigation visibility regression tests.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use advanced_testcase;
use context_course;
use core\hook\navigation\primary_extend;
use core\navigation\views\primary;
use moodle_page;
use moodle_url;
use navigation_node;

/**
 * Verify that each menu configuration is respected by Moodle's top navigation.
 *
 * @covers \local_helpdesk\navigation
 */
final class navigation_test extends advanced_testcase {
    /**
     * Set a fresh Moodle page in the requested location.
     *
     * @param \stdClass|null $course Course to navigate to, or null for site home.
     * @return void
     */
    private function setup_page(?\stdClass $course = null): void {
        global $PAGE;

        $PAGE = new moodle_page();
        if ($course) {
            $PAGE->set_url(new moodle_url('/course/view.php', ['id' => $course->id]));
            $PAGE->set_course($course);
            $PAGE->set_context(context_course::instance($course->id));
        } else {
            $PAGE->set_url(new moodle_url('/'));
        }
    }

    /**
     * Retrieve the Helpdesk node from a fresh primary navigation view.
     *
     * @return navigation_node|null
     */
    private function get_helpdesk_node(): ?navigation_node {
        global $PAGE;

        $primary = new primary($PAGE);
        $hook = new primary_extend($primary);
        navigation::extend_primary($hook);
        navigation::extend_primary($hook);
        $this->assertLessThanOrEqual(1, count($primary->get_children_key_list()));
        return $primary->find('helpdesk_menu', navigation_node::TYPE_CUSTOM) ?: null;
    }

    /**
     * The none option takes precedence on every page, even for admins.
     */
    public function test_none_hides_menu_everywhere(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        $course = $this->getDataGenerator()->create_course();
        set_config('menu', 'none', 'local_helpdesk');

        $this->setup_page();
        $this->assertNull($this->get_helpdesk_node());
        $this->setup_page($course);
        $this->assertNull($this->get_helpdesk_node());
    }

    /**
     * The course option renders a course-aware URL only within a course.
     */
    public function test_course_only_link(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        $course = $this->getDataGenerator()->create_course();
        set_config('menu', 'course', 'local_helpdesk');

        $this->setup_page();
        $this->assertNull($this->get_helpdesk_node());

        $this->setup_page($course);
        $node = $this->get_helpdesk_node();
        $this->assertNotNull($node);
        $this->assertSame((int)$course->id, (int)$node->action->get_param('courseid'));
    }

    /**
     * System option must include the site home as well as course pages.
     */
    public function test_system_link_everywhere(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        $course = $this->getDataGenerator()->create_course();
        set_config('menu', 'system', 'local_helpdesk');

        $this->setup_page();
        $node = $this->get_helpdesk_node();
        $this->assertNotNull($node);
        $this->assertNull($node->action->get_param('courseid'));

        $this->setup_page($course);
        $node = $this->get_helpdesk_node();
        $this->assertNotNull($node);
        $this->assertSame((int)$course->id, (int)$node->action->get_param('courseid'));
    }

    /**
     * Ordinary logged-in users retain the Helpdesk link after Dashboard integration.
     */
    public function test_regular_user_sees_system_menu(): void {
        $this->resetAfterTest();
        $this->setUser($this->getDataGenerator()->create_user());
        set_config('menu', 'system', 'local_helpdesk');
        $this->setup_page();
        $this->assertNotNull($this->get_helpdesk_node());
    }

    /**
     * Visitors and guest accounts cannot see the helpdesk navigation.
     */
    public function test_guests_cannot_see_menu(): void {
        $this->resetAfterTest();
        set_config('menu', 'system', 'local_helpdesk');
        $this->setGuestUser();
        $this->setup_page();
        $this->assertNull($this->get_helpdesk_node());
    }

    /**
     * Invalid values must not create an unexpectedly site-wide menu.
     */
    public function test_unrecognised_setting_hides_menu(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        set_config('menu', 'unexpected', 'local_helpdesk');
        $this->setup_page();
        $this->assertNull($this->get_helpdesk_node());
    }
}
