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
 * Kopere Dashboard menu integration.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use context;
use local_kopere_dashboard\api\subplugin_manager;
use moodle_url;

/**
 * Support menu definition for Kopere Dashboard.
 */
class menu {
    /**
     * Return menu entries for authorised Helpdesk support staff.
     *
     * @param context $context Dashboard context.
     * @return array
     */
    public static function get_definition(context $context): array {
        if (!has_capability("local/helpdesk:ticketmanage", $context)) {
            return [];
        }

        $children = [
            [
                "title" => get_string("tickets", "local_helpdesk"),
                "url" => new moodle_url("/local/helpdesk/index.php"),
                "activeurls" => [
                    new moodle_url("/local/helpdesk/index.php"),
                    new moodle_url("/local/helpdesk/ticket.php"),
                ],
                "icon" => "confirmation_number",
            ],
            [
                "title" => get_string("knowledgebase_name", "local_helpdesk"),
                "url" => new moodle_url("/local/helpdesk/knowledgebase.php"),
                "icon" => "menu_book",
            ],
        ];

        if (has_capability("moodle/site:config", $context)) {
            $children[] = [
                "title" => get_string("categories", "local_helpdesk"),
                "url" => new moodle_url("/local/helpdesk/categories.php"),
                "icon" => "category",
                "capability" => "moodle/site:config",
            ];
        }

        if (has_capability("local/kopere_bi:view", $context)) {
            $children[] = [
                "title" => get_string("report_general_reports_page_title", "local_helpdesk"),
                "url" => new moodle_url("/local/helpdesk/report.php"),
                "icon" => "bar_chart",
                "capability" => "local/kopere_bi:view",
            ];
        }

        return [
            "category" => subplugin_manager::CAT_TOOLS,
            "items" => [
                [
                    "title" => get_string("pluginname", "local_helpdesk"),
                    "url" => new moodle_url("/local/helpdesk/index.php"),
                    "activeurls" => [
                        new moodle_url("/local/helpdesk/index.php"),
                        new moodle_url("/local/helpdesk/ticket.php"),
                        new moodle_url("/local/helpdesk/categories.php"),
                        new moodle_url("/local/helpdesk/knowledgebase.php"),
                    ],
                    "icon" => "support_agent",
                    "capability" => "local/helpdesk:ticketmanage",
                    "children" => $children,
                ],
            ],
        ];
    }
}
