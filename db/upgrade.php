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
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_kopere_bi\local\util\install_for_file;

/**
 * Function xmldb_local_helpdesk_upgrade
 *
 * @param int $oldversion
 *
 * @return bool
 *
 * @throws dml_exception
 * @throws downgrade_exception
 * @throws moodle_exception
 * @throws upgrade_exception
 */
function xmldb_local_helpdesk_upgrade($oldversion) {
    if ($oldversion < 2025022500) {
        // Load report pages.
        $pagefiles = glob(__DIR__ . "/files/page-*.json");
        foreach ($pagefiles as $pagefile) {
            install_for_file::page_file($pagefile);
        }

        upgrade_plugin_savepoint(true, 2025022500, "local", "helpdesk");
    }

    global $DB;
    $dbman = $DB->get_manager();
    if ($oldversion < 2025031301) {
        // Define table local_helpdesk_knowledgebase.
        $table = new xmldb_table("local_helpdesk_knowledgebase");

        // Adding fields to table local_helpdesk_knowledgebase.
        $table->add_field("id", XMLDB_TYPE_INTEGER, 10, null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field("title", XMLDB_TYPE_CHAR, 255, null, XMLDB_NOTNULL, null, null);
        $table->add_field("description", XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field("categoryid", XMLDB_TYPE_INTEGER, 10, null, null, null, null);
        $table->add_field("userid", XMLDB_TYPE_INTEGER, 10, null, XMLDB_NOTNULL, null, null);
        $table->add_field("createdat", XMLDB_TYPE_INTEGER, 20, null, XMLDB_NOTNULL, null, null);
        $table->add_field("updatedat", XMLDB_TYPE_INTEGER, 20, null, null, null, null);

        // Adding keys to table local_helpdesk_knowledgebase.
        $table->add_key("primary", XMLDB_KEY_PRIMARY, ["id"]);

        // Conditionally launch create table for local_helpdesk_knowledgebase.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Save upgrade step.
        upgrade_plugin_savepoint(true, 2025031301, "local", "helpdesk");
    }

    return true;
}
