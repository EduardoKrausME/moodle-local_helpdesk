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

    if ($oldversion < 2025040800) {
        // Add 'answeredat' to 'local_helpdesk_ticket'.
        $table = new xmldb_table("local_helpdesk_ticket");
        $field = new xmldb_field("answeredat", XMLDB_TYPE_INTEGER, "20", null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Add 'closedat' to 'local_helpdesk_ticket'.
        $field = new xmldb_field("closedat", XMLDB_TYPE_INTEGER, "20", null, null, null, null);
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $tickets = $DB->get_records("local_helpdesk_ticket", null, "", "id");

        foreach ($tickets as $ticket) {
            // Get the first response from the local_helpdesk_response table.
            $response = $DB->get_record_sql("
                    SELECT *
                      FROM {local_helpdesk_response}
                     WHERE ticketid = {$ticket->id}
                       AND type     = 'message'
                  ORDER BY id ASC
                     LIMIT 1");

            if ($response) {
                // Updates the 'answeredat' field in the corresponding ticket.
                $DB->set_field("local_helpdesk_ticket", "answeredat", $response->createdat, ["id" => $ticket->id]);
            }

            // Pega o primeiro status na tabela local_helpdesk_response.
            $statusresolved = get_string("status_resolved", "local_helpdesk");
            $statusclosed = get_string("status_closed", "local_helpdesk");
            $response = $DB->get_record_sql("
                    SELECT *
                      FROM {local_helpdesk_response}
                     WHERE ticketid   = {$ticket->id}
                       AND type       = 'status'
                       AND (
                                message LIKE '%{$statusresolved}%'
                             OR message LIKE '%{$statusclosed}%'
                           )
                  ORDER BY id ASC
                     LIMIT 1");
            if ($response) {
                // Updates the 'answeredat' field in the corresponding ticket.
                $DB->set_field("local_helpdesk_ticket", "closedat", $response->createdat, ["id" => $ticket->id]);
            }

        }

        // Save upgrade step.
        upgrade_plugin_savepoint(true, 2025040800, "local", "helpdesk");
    }

    if ($oldversion < 2025040803) {

        // Delete olds reports 'local_helpdesk'.
        $pages = $DB->get_records("local_kopere_bi_page", ["refkey" => "local_helpdesk"]);
        foreach ($pages as $page) {
            $blocks = $DB->get_records("local_kopere_bi_block", ["page_id" => $page->id]);
            foreach ($blocks as $block) {
                $DB->delete_records("local_kopere_bi_block", ["id" => $block->id]);
                $DB->delete_records("local_kopere_bi_element", ["block_id" => $block->id]);
            }

            $DB->delete_records("local_kopere_bi_page", ["id" => $page->id]);
        }
        $DB->delete_records("local_kopere_bi_cat", ["refkey" => "local_helpdesk"]);

        \local_helpdesk\util\reports::install();

        upgrade_plugin_savepoint(true, 2025040803, "local", "helpdesk");
    }

    return true;
}
