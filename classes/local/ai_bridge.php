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
 * Optional AI Bridge integration availability.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\local;

defined('MOODLE_INTERNAL') || die();

/**
 * Checks whether a supported AI Bridge installation is available.
 */
final class ai_bridge {
    /**
     * Whether AI Bridge is installed and its API can be autoloaded.
     *
     * @return bool
     */
    public static function is_available(): bool {
        return (int) get_config("local_ai_bridge", "version") >= 2026093001
            && class_exists(\local_ai_bridge\api::class);
    }
}
