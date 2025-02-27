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
 * file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\model;

use context_system;

/**
 * Class category
 *
 * @package local_helpdesk\model
 */
class category {
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $description;
    /** @var int */
    protected $createdat;

    /**
     * category constructor.
     *
     * @param array|object $obj
     */
    public function __construct($obj) {
        foreach ($obj as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Function get_by_id
     *
     * @param $categoryid
     *
     * @return category|null
     * @throws \dml_exception
     */
    public static function get_by_id($categoryid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_category", ["id" => $categoryid]);

        if ($record) {
            return new self($record);
        }

        return null;
    }

    /**
     * Function get_all
     *
     * @param array|string $wheres
     * @param array $params
     * @param string $order
     *
     * @return array
     * @throws \dml_exception
     */
    public static function get_all($wheres = null, $params = [], $order = null) {
        return model_base::get_all("local_helpdesk_category", self::class, $wheres, $params, $order);
    }

    /**
     * Function save
     *
     * @return bool|int
     * @throws \dml_exception
     */
    public function save() {
        global $DB;

        if ($this->id) {
            return $DB->update_record("local_helpdesk_category", get_object_vars($this));
        } else {
            return $this->id = $DB->insert_record("local_helpdesk_category", get_object_vars($this));
        }
    }

    /**
     * Function delete
     *
     * @return bool
     * @throws \dml_exception
     */
    public function delete() {
        global $DB;

        require_capability("local/helpdesk:categorydelete", context_system::instance());

        return $DB->delete_records("local_helpdesk_category", ["id" => $this->id]);
    }

    // Getters.

    /**
     * Function get_id
     *
     * @return mixed
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Function create_role
     *
     * @return int
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function get_role_id() {
        global $DB, $USER;

        $rolename = get_string("pluginname", "local_helpdesk");
        $roleshortname = get_string("pluginname", "local_helpdesk");
        $roledescription = get_string("category_role_description", "local_helpdesk");
        $rolearchetype = "";

        $role = $DB->get_record("role", ["shortname" => $roleshortname]);
        if ($role) {
            return $role->id;
        }

        $roleid = create_role($rolename, $roleshortname, $roledescription, $rolearchetype);
        set_role_contextlevels($roleid, [CONTEXT_SYSTEM]);

        $capabilities = [
            "contextid" => context_system::instance()->id,
            "roleid" => $roleid,
            "capability" => "local/helpdesk:ticketmanage",
            "permission" => 1,
            "timemodified" => time(),
            "modifierid" => $USER->id,
        ];
        $DB->insert_record("role_capabilities", $capabilities);
        $capabilities = [
            "contextid" => context_system::instance()->id,
            "roleid" => $roleid,
            "capability" => "local/kopere_dashboard:ajax",
            "permission" => 1,
            "timemodified" => time(),
            "modifierid" => $USER->id,
        ];
        $DB->insert_record("role_capabilities", $capabilities);

        return $roleid;
    }

    /**
     * Function get_name
     *
     * @return mixed
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Function get_description
     *
     * @return mixed
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Function get_createdat
     *
     * @return mixed
     */
    public function get_createdat() {
        return $this->createdat;
    }

    // Setters.

    /**
     * Function set_name
     *
     * @param $name
     */
    public function set_name($name) {
        $this->name = $name;
    }

    /**
     * Function set_description
     *
     * @param $description
     */
    public function set_description($description) {
        $this->description = $description;
    }
}
