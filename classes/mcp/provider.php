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
 * Auto-discovered MCP provider for Helpdesk.
 *
 * @package local_helpdesk
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_helpdesk\mcp;

use local_mcp\extension\read_provider_interface;
use local_mcp\extension\write_provider_interface;

/**
 * Loaded by local_mcp from classes/mcp/provider.php when both plugins are installed.
 * The integration is optional; no hard dependency on local_mcp is required.
 */
final class provider implements read_provider_interface, write_provider_interface {
    /**
     * get_read_tools
     *
     * @return read_tool[]
     */
    public function get_read_tools(): array {
        return [
            new read_tool('list_tickets'),
            new read_tool('get_ticket'),
            new read_tool('list_categories'),
            new read_tool('ticket_stats'),
        ];
    }

    /**
     * get_write_tools
     *
     * @return write_tool[]
     */
    public function get_write_tools(): array {
        return [
            new write_tool('create_ticket'),
            new write_tool('reply_ticket'),
            new write_tool('update_ticket'),
        ];
    }
}
