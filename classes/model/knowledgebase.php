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
 * Class knowledgebase
 *
 * @package local_helpdesk\model
 */
class knowledgebase {

    /** @var int */
    protected $id;
    /** @var string */
    protected $title;
    /** @var string */
    protected $description;
    /** @var int */
    protected $categoryid;
    /** @var int */
    protected $userid;
    /** @var int */
    protected $createdat;
    /** @var int */
    protected $updatedat;

    /**
     * knowledgebase constructor.
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
     * @param int $knowledgebaseid
     *
     * @return knowledgebase|null
     * @throws \dml_exception
     */
    public static function get_by_id($knowledgebaseid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_knowledgebase", ["id" => $knowledgebaseid]);

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
        return model_base::get_all("local_helpdesk_knowledgebase", self::class, $wheres, $params, $order);
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
            return $DB->update_record("local_helpdesk_knowledgebase", get_object_vars($this));
        } else {
            return $this->id = $DB->insert_record("local_helpdesk_knowledgebase", get_object_vars($this));
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

        require_capability("local/helpdesk:knowledgebase_delete", context_system::instance());

        return $DB->delete_records("local_helpdesk_knowledgebase", ["id" => $this->id]);
    }

    /**
     * Function get_id
     *
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Function set_id
     *
     * @param int $id
     */
    public function set_id(int $id) {
        $this->id = $id;
    }

    /**
     * Function get_title
     *
     * @return string
     */
    public function get_title() {
        return $this->title;
    }

    /**
     * Function set_title
     *
     * @param string $title
     */
    public function set_title(string $title) {
        $this->title = $title;
    }

    /**
     * Function get_description
     *
     * @return string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Function set_description
     *
     * @param string $description
     */
    public function set_description(string $description) {
        $this->description = $description;
    }

    /**
     * Function get_categoryid
     *
     * @return int
     */
    public function get_categoryid() {
        return $this->categoryid;
    }

    /**
     * Function set_categoryid
     *
     * @param int $categoryid
     */
    public function set_categoryid(int $categoryid) {
        $this->categoryid = $categoryid;
    }

    /** @var category */
    private $category;

    /**
     * Function get_category
     *
     * @return category
     * @throws \dml_exception
     */
    public function get_category() {
        global $DB;

        if ($this->category) {
            return $this->category;
        }

        $this->category = new category(
            $DB->get_record("local_helpdesk_category", ["id" => $this->get_categoryid()])
        );
        return $this->category;
    }

    /**
     * Function get_userid
     *
     * @return int
     */
    public function get_userid() {
        return $this->userid;
    }

    /**
     * Function set_userid
     *
     * @param int $userid
     */
    public function set_userid(int $userid) {
        $this->userid = $userid;
    }

    /**
     * Function get_createdat
     *
     * @return int
     */
    public function get_createdat() {
        return $this->createdat;
    }

    /**
     * Function set_createdat
     *
     * @param int $createdat
     */
    public function set_createdat(int $createdat) {
        $this->createdat = $createdat;
    }

    /**
     * Function get_updatedat
     *
     * @return int
     */
    public function get_updatedat() {
        return $this->updatedat;
    }

    /**
     * Function set_updatedat
     *
     * @param int $updatedat
     */
    public function set_updatedat(int $updatedat) {
        $this->updatedat = $updatedat;
    }
}
