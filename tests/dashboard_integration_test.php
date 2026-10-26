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
 * Helpdesk dashboard integration tests.
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk;

use advanced_testcase;
use context_system;
use local_helpdesk\output\page;

/**
 * Verify support menu registration and capabilities for different roles.
 *
 * @covers \local_helpdesk\menu
 * @covers \local_helpdesk\capabilities_provider
 * @covers \local_helpdesk\output\page
 */
final class dashboard_integration_test extends advanced_testcase {
    /**
     * Agents can use the shell; students cannot.
     */
    public function test_dashboard_layout_requires_agent_and_dashboard_permissions(): void {
        $this->resetAfterTest();
        $context = context_system::instance();
        $this->setAdminUser();
        $this->assertTrue(page::uses_dashboard($context));
        $user = $this->getDataGenerator()->create_user();
        $roleid = $this->getDataGenerator()->create_role();
        assign_capability("local/helpdesk:view", CAP_ALLOW, $roleid, $context->id);
        role_assign($roleid, $user->id, $context->id);
        $this->setUser($user);
        $this->assertFalse(page::uses_dashboard($context));

        // The Dashboard sidebar should expose Helpdesk even on reportcard/my.php.
        set_config("menu", "course", "local_helpdesk");
        $definition = menu::get_definition($context);
        $this->assertSame("local/helpdesk:view", $definition["items"][0]["capability"]);
        $this->assertSame([], $definition["items"][0]["children"]);
        $this->assertSame("/local/helpdesk/index.php", $definition["items"][0]["url"]->get_path());

        set_config("menu", "none", "local_helpdesk");
        $this->assertSame([], menu::get_definition($context));
    }

    /**
     * The staff menu is available to admins.
     */
    public function test_admin_menu_definition(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
        $definition = menu::get_definition(context_system::instance());
        $this->assertSame("tools", $definition["category"]);
        $this->assertSame("local/helpdesk:ticketmanage", $definition["items"][0]["capability"]);
        $this->assertNotEmpty($definition["items"][0]["children"]);
        $settings = array_filter($definition["items"][0]["children"], static function(array $child): bool {
            return $child["url"]->get_path() === "/admin/settings.php";
        });
        $this->assertCount(1, $settings);
        $setting = reset($settings);
        $this->assertSame("moodle/site:config", $setting["capability"]);
        $this->assertSame("local_helpdesk", $setting["url"]->get_param("section"));
    }

    /**
     * Render staff content in the standard Kopere Dashboard card without escaping HTML.
     */
    public function test_dashboard_card_wraps_helpdesk_content(): void {
        global $OUTPUT;

        $this->resetAfterTest();
        $this->setAdminUser();

        $content = '<form action="/local/helpdesk/index.php"><input name="subject"></form>';
        $html = $OUTPUT->render_from_template("local_helpdesk/dashboard_card", [
            "content" => $content,
        ]);

        $this->assertStringContainsString('class="kopere_dashboard-card"', $html);
        $this->assertStringContainsString($content, $html);
        $this->assertSame(1, substr_count($html, 'class="kopere_dashboard-card"'));
    }

    /**
     * All registered Helpdesk capabilities are exposed without duplicates.
     */
    public function test_capabilities_provider(): void {
        $definitions = capabilities_provider::get_capabilities();
        $this->assertEqualsCanonicalizing([
            "local/helpdesk:view",
            "local/helpdesk:viewall",
            "local/helpdesk:ticketmanage",
            "local/helpdesk:categorymanage",
            "local/helpdesk:categorydelete",
        ], array_keys($definitions));
    }
}
