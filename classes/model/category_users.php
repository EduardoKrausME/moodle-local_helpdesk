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

/**
 * Class category_users
 *
 * @package local_helpdesk\model
 */
class category_users {
    /** @var int */
    protected $id;
    /** @var int */
    protected $categoryid;
    /** @var int */
    protected $userid;
    /** @var int */
    protected $createdat;

    /**
     * category_users constructor.
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
     * @param int $categoryid
     *
     * @return category_users|null
     * @throws \dml_exception
     */
    public static function get_by_id($categoryid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_category_user", ["id" => $categoryid]);

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
        return model_base::get_all("local_helpdesk_category_user", self::class, $wheres, $params, $order);
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
            return $DB->update_record("local_helpdesk_category_user", get_object_vars($this));
        } else {
            return $this->id = $DB->insert_record("local_helpdesk_category_user", get_object_vars($this));
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
        return $DB->delete_records("local_helpdesk_category_user", ["id" => $this->id]);
    }

    // Getters ans setters.

    /**
     * Function get_id
     *
     * @return int
     */
    public function get_id(): int {
        return $this->id;
    }

    /**
     * Function get_categoryid
     *
     * @return int
     */
    public function get_categoryid(): int {
        return $this->categoryid;
    }

    /**
     * Function set_categoryid
     *
     * @param int $categoryid
     */
    public function set_categoryid($categoryid): void {
        $this->categoryid = $categoryid;
    }

    /**
     * Function get_userid
     *
     * @return int
     */
    public function get_userid(): int {
        return $this->userid;
    }

    /** @var \stdClass */
    private $user;

    /**
     * Function get_user
     *
     * @return mixed
     * @throws \dml_exception
     */
    public function get_user() {
        if ($this->user) {
            return $this->user;
        }

        global $DB;

        $this->user = $DB->get_record("user", ["id" => $this->userid]);
        return $this->user;
    }

    /**
     * Function set_userid
     *
     * @param int $userid
     */
    public function set_userid($userid): void {
        $this->userid = $userid;
        $this->user = null;
    }

    /**
     * Function get_createdat
     *
     * @return int
     */
    public function get_createdat(): int {
        return $this->createdat;
    }

    /**
     * Function set_createdat
     *
     * @param string $createdat
     */
    public function set_createdat($createdat): void {
        $this->createdat = $createdat;
    }
}
