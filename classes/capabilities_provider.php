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
 * Helpdesk permission management integration.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

/**
 * Supplies existing Moodle capabilities to Kopere Dashboard.
 */
class capabilities_provider {
    /**
     * Return the existing Helpdesk capabilities for central permission management.
     *
     * @return array
     */
    public static function get_capabilities(): array {
        $definitions = [];
        foreach (["view", "viewall", "ticketmanage", "categorymanage", "categorydelete"] as $name) {
            $capability = "local/helpdesk:{$name}";
            $description = get_string("helpdesk:{$name}", "local_helpdesk");
            $definitions[$capability] = [
                "name" => $description,
                "description" => $description,
            ];
        }
        return $definitions;
    }
}
