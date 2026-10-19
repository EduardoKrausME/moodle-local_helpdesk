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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Helpdesk layout selector.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\output;

use context;
use context_system;
use local_kopere_dashboard\output\layout;

/**
 * Keep Helpdesk forms unchanged while rendering staff pages in Kopere Dashboard.
 */
class page {
    /**
     * @param context|null $context Page context.
     * @return bool
     */
    public static function uses_dashboard(?context $context = null): bool {
        global $PAGE;

        $context = $context ?? $PAGE->context;
        return class_exists(layout::class)
            && has_capability("local/helpdesk:ticketmanage", $context)
            && has_capability("local/kopere_dashboard:view", context_system::instance());
    }

    /**
     * @return void
     */
    public static function start(): void {
        global $PAGE;
        if (self::uses_dashboard()) {
            $PAGE->add_body_class("local-kopere_dashboard");
            $PAGE->add_body_class("kopere-helpdesk");
            ob_start();
        }
    }

    /**
     * @return void
     */
    public static function header(): void {
        global $OUTPUT;
        if (!self::uses_dashboard()) {
            echo $OUTPUT->header();
        }
    }

    /**
     * @return void
     */
    public static function finish(): void {
        global $PAGE, $OUTPUT;
        if (self::uses_dashboard()) {
            $content = ob_get_clean();
            layout::page_render($PAGE->context, $content, true, "kopere-helpdesk-page");
            return;
        }
        echo $OUTPUT->footer();
    }
}
