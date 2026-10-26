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
 * Helpdesk navigation for Moodle's primary navigation and legacy navigation.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use context_course;
use context_system;
use core\hook\navigation\primary_extend;
use moodle_url;
use navigation_node;

/**
 * Controls the public Helpdesk navigation independently of the staff Dashboard menu.
 */
final class navigation {
    /**
     * Whether the top menu should be shown on the current page.
     *
     * @return bool
     */
    public static function should_show(): bool {
        global $PAGE, $SITE;

        // Administrators keep their Helpdesk entry in the Kopere Dashboard.
        if (!isloggedin() || isguestuser() || is_siteadmin()) {
            return false;
        }

        $setting = get_config("local_helpdesk", "menu");
        if ($setting === false || $setting === null || $setting === "") {
            $setting = "course";
        }

        if ($setting !== "course" && $setting !== "system") {
            return false;
        }

        $incourse = isset($PAGE->course->id) && (int)$PAGE->course->id !== (int)$SITE->id;
        if ($setting === "course" && !$incourse) {
            return false;
        }

        $context = $incourse
            ? context_course::instance($PAGE->course->id)
            : context_system::instance();

        return has_capability("local/helpdesk:view", $context)
            || has_capability("local/helpdesk:viewall", $context)
            || has_capability("local/helpdesk:ticketmanage", $context);
    }

    /**
     * Return the Helpdesk URL, scoped to the current course when appropriate.
     *
     * @return moodle_url
     */
    public static function get_url(): moodle_url {
        global $PAGE, $SITE;

        $params = [];
        if (isset($PAGE->course->id) && (int)$PAGE->course->id !== (int)$SITE->id) {
            $params["courseid"] = (int)$PAGE->course->id;
        }

        return new moodle_url("/local/helpdesk/index.php", $params);
    }

    /**
     * Add the Helpdesk item to the Moodle top navigation in Moodle 4.5 and later.
     *
     * @param primary_extend $hook Navigation hook.
     * @return void
     */
    public static function extend_primary_navigation(primary_extend $hook): void {
        if (!self::should_show()) {
            return;
        }

        $primary = $hook->get_primaryview();
        if ($primary->find("helpdesk_primary", null)) {
            return;
        }

        $primary->add(
            get_string("pluginname", "local_helpdesk"),
            self::get_url(),
            navigation_node::TYPE_CUSTOM,
            null,
            "helpdesk_primary"
        );
    }
}
