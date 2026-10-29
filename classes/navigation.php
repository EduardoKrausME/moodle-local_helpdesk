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
 * Helpdesk navigation links for Moodle's primary and legacy navigation trees.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use context_system;
use core\hook\navigation\primary_extend;
use global_navigation;
use moodle_url;
use navigation_node;

/**
 * Keep the standard Moodle Helpdesk link independent from the staff Dashboard menu.
 */
class navigation {
    /**
     * Return the Helpdesk URL when the current user and page may display the link.
     *
     * @return moodle_url|null
     */
    public static function get_menu_url(): ?moodle_url {
        global $PAGE, $SITE;

        if (!isloggedin() || isguestuser()) {
            return null;
        }

        $systemcontext = context_system::instance();
        if (!has_capability('local/helpdesk:view', $systemcontext)
                && !has_capability('local/helpdesk:viewall', $systemcontext)
                && !has_capability('local/helpdesk:ticketmanage', $systemcontext)) {
            return null;
        }

        $setting = get_config('local_helpdesk', 'menu');
        if ($setting === false) {
            $setting = 'course';
        }
        if ($setting !== 'course' && $setting !== 'system') {
            return null;
        }

        // Course activities have a course too; unrelated site pages must not count as courses.
        $course = $PAGE->course;
        $incourse = !empty($course->id)
            && (int)$course->id !== (int)$SITE->id
            && in_array($PAGE->context->contextlevel, [CONTEXT_COURSE, CONTEXT_MODULE], true);
        if ($setting === 'course' && !$incourse) {
            return null;
        }

        $params = $incourse ? ['courseid' => $course->id] : [];
        return new moodle_url('/local/helpdesk/index.php', $params);
    }

    /**
     * Add Helpdesk to the primary (top-bar) navigation used by modern Moodle themes.
     *
     * @param primary_extend $hook Primary navigation hook.
     * @return void
     */
    public static function extend_primary(primary_extend $hook): void {
        $url = self::get_menu_url();
        if ($url === null) {
            return;
        }

        $nav = $hook->get_primaryview();
        if ($nav->find('helpdesk_menu', navigation_node::TYPE_CUSTOM)) {
            return;
        }
        $nav->add(get_string('pluginname', 'local_helpdesk'), $url,
            navigation_node::TYPE_CUSTOM, null, 'helpdesk_menu');
    }

    /**
     * Retain the Helpdesk link in legacy navigation components.
     *
     * @param global_navigation $nav Legacy navigation tree.
     * @return void
     */
    public static function extend_global(global_navigation $nav): void {
        $url = self::get_menu_url();
        if ($url === null || $nav->find('helpdesk_menu', navigation_node::TYPE_CUSTOM)) {
            return;
        }

        $nav->add(get_string('pluginname', 'local_helpdesk'), $url,
            navigation_node::TYPE_CUSTOM, null, 'helpdesk_menu');
    }
}
