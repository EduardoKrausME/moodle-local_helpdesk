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
 * upgrade file
 *
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_kbi\local\util\install_for_file;

/**
 * Function xmldb_local_khelpdesk_upgrade
 *
 * @param $oldversion
 *
 * @return bool
 *
 * @throws dml_exception
 * @throws downgrade_exception
 * @throws moodle_exception
 * @throws upgrade_exception
 */
function xmldb_local_khelpdesk_upgrade($oldversion) {
    if ($oldversion < 2025022500) {
        // Load report pages.
        $pagefiles = glob(__DIR__ . "/files/page-*.json");
        foreach ($pagefiles as $pagefile) {
            install_for_file::page_file($pagefile);
        }

        upgrade_plugin_savepoint(true, 2025022500, "local", "khelpdesk");
    }

    return true;
}
