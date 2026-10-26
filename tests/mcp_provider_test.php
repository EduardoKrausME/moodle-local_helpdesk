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
 * Tests for the optional Helpdesk MCP provider.
 *
 * @package local_helpdesk
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_helpdesk;

use local_helpdesk\mcp\provider;
use local_helpdesk\mcp\read_tool;
use local_helpdesk\mcp\write_tool;
use local_mcp\security\authenticated_identity;

/**
 * MCP auto discovery, schema and ownership security coverage.
 */
final class mcp_provider_test extends \advanced_testcase {
    /**
     * Skip the integration test when local_mcp is absent.
     *
     * @return void Result.
     */
    private function require_mcp(): void {
        if (!interface_exists('\local_mcp\extension\read_provider_interface')) {
            $this->markTestSkipped('Optional local_mcp plugin is not installed.');
        }
    }

    /**
     * Verify provider tools and JSON Schema contracts.
     *
     * @covers \local_helpdesk\mcp\provider
     * @return void Result.
     */
    public function test_discovery_and_schemas(): void {
        $this->require_mcp();
        $provider = new provider();
        $reads = $provider->get_read_tools();
        $writes = $provider->get_write_tools();
        $readnames = array_map(static function($tool): string {
            return $tool->get_name();
        }, $reads);
        $writenames = array_map(static function($tool): string {
            return $tool->get_name();
        }, $writes);
        $this->assertSame([
            'helpdesk_list_tickets', 'helpdesk_get_ticket', 'helpdesk_list_categories',
            'helpdesk_list_articles', 'helpdesk_ticket_stats',
        ], $readnames);
        $this->assertSame([
            'helpdesk_create_ticket', 'helpdesk_reply_ticket',
            'helpdesk_update_ticket', 'helpdesk_create_article',
        ], $writenames);
        foreach (array_merge($reads, $writes) as $tool) {
            $schema = $tool->get_input_schema();
            $issues = [];
            \local_mcp\protocol\tool_schema::normalize($schema, $issues);
            $this->assertSame([], array_filter($issues, static function($issue): bool {
                return !$issue['repaired'];
            }), 'Invalid schema: ' . $tool->get_name());
            $this->assertSame('object', $schema['type']);
            $this->assertFalse($schema['additionalProperties']);
        }
        $this->assertSame('local/helpdesk:ticketmanage', $reads[4]->get_required_capability());
        $this->assertSame('moodle/site:config', $writes[3]->get_required_capability());
    }

    /**
     * Verify that ticket ownership is enforced.
     *
     * @covers \local_helpdesk\mcp\read_tool
     * @return void Result.
     */
    public function test_ticket_reads_do_not_expose_other_users_tickets(): void {
        global $DB;
        $this->require_mcp();
        $this->resetAfterTest();
        $owner = $this->getDataGenerator()->create_user();
        $other = $this->getDataGenerator()->create_user();
        $categoryid = $DB->insert_record('local_helpdesk_category', (object)[
            'name' => 'MCP test', 'description' => '', 'createdat' => time(),
        ]);
        $ticketid = $DB->insert_record('local_helpdesk_ticket', (object)[
            'idkey' => 202610110001, 'categoryid' => $categoryid, 'userid' => $owner->id,
            'courseid' => 0, 'subject' => 'Private ticket', 'description' => 'Private text',
            'status' => 'open', 'priority' => 'medium', 'createdat' => time(),
            'updatedat' => time(), 'answeredat' => 0, 'resolvedat' => 0,
            'closedat' => 0, 'remindedat' => 0,
        ]);
        $read = new read_tool('get_ticket');
        $identity = new authenticated_identity((int)$owner->id, 'manual', ['read']);
        $result = $read->execute(['ticketid' => $ticketid], $identity);
        $this->assertSame('Private ticket', $result['subject']);
        $outsider = new authenticated_identity((int)$other->id, 'manual', ['read']);
        $list = (new read_tool('list_tickets'))->execute([], $outsider);
        $this->assertSame(0, $list['total']);
        $this->expectException(\local_mcp\exception\api_exception::class);
        $read->execute(['ticketid' => $ticketid], $outsider);
    }
    /**
     * Viewall permits reading other people's tickets but not creating new tickets through MCP.
     *
     * @covers \\local_helpdesk\\mcp\\read_tool
     * @covers \\local_helpdesk\\mcp\\write_tool
     */
    public function test_viewall_read_only_mcp_access(): void {
        global $DB;
        $this->require_mcp();
        $this->resetAfterTest();

        $context = \\context_system::instance();
        $viewer = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();
        assign_capability('local/helpdesk:viewall', CAP_ALLOW, $roleid, $context->id);
        role_assign($roleid, $viewer->id, $context->id);

        $owner = $this->getDataGenerator()->create_user();
        $categoryid = $DB->insert_record('local_helpdesk_category', (object)[
            'name' => 'Readonly MCP category', 'description' => '', 'createdat' => time(),
        ]);
        $ticketid = $DB->insert_record('local_helpdesk_ticket', (object)[
            'idkey' => 202610260001, 'categoryid' => $categoryid, 'userid' => $owner->id,
            'courseid' => 0, 'subject' => 'Readonly MCP ticket', 'description' => 'Private text',
            'status' => 'open', 'priority' => 'medium', 'createdat' => time(),
            'updatedat' => time(), 'answeredat' => 0, 'resolvedat' => 0,
            'closedat' => 0, 'remindedat' => 0,
        ]);
        $identity = new authenticated_identity((int)$viewer->id, 'manual', ['read', 'write']);
        $list = (new read_tool('list_tickets'))->execute([], $identity);
        $this->assertSame(1, $list['total']);
        $item = (new read_tool('get_ticket'))->execute(['ticketid' => $ticketid], $identity);
        $this->assertSame('Readonly MCP ticket', $item['subject']);

        $this->expectException(\\local_mcp\\exception\\api_exception::class);
        (new write_tool('create_ticket'))->preview([
            'categoryid' => $categoryid,
            'subject' => 'Must not create',
            'description' => 'Read-only roles cannot create tickets',
        ], $identity);
    }
}
