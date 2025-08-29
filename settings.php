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
 * setting file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $settings = new admin_settingpage("local_helpdesk", get_string("pluginname", "local_helpdesk"));
    $ADMIN->add("localplugins", $settings);

    $options = [
        "none" => get_string("setting_none", "local_helpdesk"),
        "course" => get_string("setting_course", "local_helpdesk"),
        "system" => get_string("setting_system", "local_helpdesk"),
    ];
    $name = "local_helpdesk/menu";
    $title = get_string("setting_menu_title", "local_helpdesk");
    $description = get_string("setting_menu_description", "local_helpdesk");
    $setting = new admin_setting_configselect($name, $title, $description, "course", $options);
    $settings->add($setting);

    $options = [
        "none" => get_string("setting_none", "local_helpdesk"),
        "course" => get_string("setting_course", "local_helpdesk"),
        "system" => get_string("setting_system", "local_helpdesk"),
    ];
    $name = "local_helpdesk/knowledgebase_menu";
    $title = get_string("setting_knowledgebase_menu_title", "local_helpdesk");
    $description = get_string("setting_knowledgebase_menu_description", "local_helpdesk");
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);
}
