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
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_khelpdesk\model;

/**
 * Class ticket
 *
 * @package local_khelpdesk\model
 */
class ticket {

    /** @var string */
    const PRIORITY_LOW = "low";
    /** @var string */
    const PRIORITY_MEDIUM = "medium";
    /** @var string */
    const PRIORITY_HIGH = "high";
    /** @var string */
    const PRIORITY_URGENT = "urgent";

    /** @var string */
    const STATUS_OPEN = "open";
    /** @var string */
    const STATUS_PROGRESS = "progress";
    /** @var string */
    const STATUS_RESOLVED = "resolved";
    /** @var string */
    const STATUS_CLOSED = "closed";

    /** @var int */
    protected $id;
    /** @var string */
    protected $idkey;
    /** @var int */
    protected $categoryid;
    /** @var int */
    protected $userid;
    /** @var int */
    protected $courseid;
    /** @var string */
    protected $subject;
    /** @var string */
    protected $description;
    /** @var string */
    protected $message;
    /** @var string */
    protected $status;
    /** @var string */
    protected $priority;
    /** @var int */
    protected $assignedto;
    /** @var int */
    protected $createdat;
    /** @var int */
    protected $updatedat;

    /**
     * ticket constructor.
     *
     * @param $obj
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
     * @param string $ticketid
     *
     * @return ticket|null
     * @throws \dml_exception
     */
    public static function get_by_id($ticketid) {
        global $DB;

        if ($ticketid > 10000000) {
            $record = $DB->get_record("local_khelpdesk_ticket", ["idkey" => $ticketid]);
        } else {
            $record = $DB->get_record("local_khelpdesk_ticket", ["id" => $ticketid]);
        }

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
        return model_base::get_all("local_khelpdesk_ticket", self::class, $wheres, $params, $order);
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
            return $DB->update_record("local_khelpdesk_ticket", get_object_vars($this));
        } else {
            $this->idkey = substr("0" . time(), -8);
            return $this->id = $DB->insert_record("local_khelpdesk_ticket", get_object_vars($this));
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
        return $DB->delete_records("local_khelpdesk_ticket", ["id" => $this->id]);
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
     * Function get_idkey
     *
     * @return mixed
     */
    public function get_idkey() {
        return $this->idkey;
    }

    /**
     * Function get_categoryid
     *
     * @return mixed
     */
    public function get_categoryid() {
        return $this->categoryid;
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

        $this->category = $DB->get_record("local_khelpdesk_category", ["id" => $this->get_categoryid()]);
        return new category($this->category);
    }

    /**
     * Function get_userid
     *
     * @return mixed
     */
    public function get_userid() {
        return $this->userid;
    }

    /** @var \stdClass */
    private $user;

    /**
     * Function get_user
     *
     * @return \stdClass
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
     * Function get_userid
     *
     * @return mixed
     */
    public function get_courseid() {
        return $this->courseid;
    }

    /**
     * Function get_subject
     *
     * @return mixed
     */
    public function get_subject() {
        return $this->subject;
    }

    /**
     * Function get_subject
     *
     * @param string
     *
     * @return string
     */
    public function get_description() {
        return $this->description;
    }

    /**
     * Function get_message
     *
     * @return mixed
     */
    public function get_message() {
        return $this->message;
    }

    /**
     * Function get_status
     *
     * @return mixed
     */
    public function get_status() {
        return $this->status;
    }

    /**
     * Function get_status_translated
     *
     * @return string
     * @throws \coding_exception
     */
    public function get_status_translated() {
        return self::status_translated($this->status);
    }

    /**
     * Function status_translated
     *
     * @param $status
     *
     * @return string
     * @throws \coding_exception
     */
    public static function status_translated($status) {
        switch ($status) {
            case self::STATUS_OPEN:
                return get_string("status_open", "local_khelpdesk");
            case self::STATUS_PROGRESS:
                return get_string("status_progress", "local_khelpdesk");
            case self::STATUS_RESOLVED:
                return get_string("status_resolved", "local_khelpdesk");
            case self::STATUS_CLOSED:
                return get_string("status_closed", "local_khelpdesk");
            default:
                return $status;
        }
    }

    /**
     * Function get_priority
     *
     * @return mixed
     */
    public function get_priority() {
        return $this->priority;
    }

    /**
     * Function get_priority_translated
     *
     * @return string
     * @throws \coding_exception
     */
    public function get_priority_translated() {
        return self::priority_translated($this->priority);
    }

    /**
     * Function priority_translated
     *
     * @param $priority
     *
     * @return string
     * @throws \coding_exception
     */
    public static function priority_translated($priority) {
        switch ($priority) {
            case self::PRIORITY_LOW:
                return get_string("priority_low", "local_khelpdesk");
            case self::PRIORITY_MEDIUM:
                return get_string("priority_medium", "local_khelpdesk");
            case self::PRIORITY_HIGH:
                return get_string("priority_high", "local_khelpdesk");
            case self::PRIORITY_URGENT:
                return get_string("priority_urgent", "local_khelpdesk");
            default:
                return $priority;
        }
    }

    /**
     * Function set_assignedto
     *
     * @return int
     */
    public function get_assignedto() {
        return $this->assignedto;
    }

    /**
     * Function get_createdat
     *
     * @return mixed
     */
    public function get_createdat() {
        return $this->createdat;
    }

    /**
     * Function get_updatedat
     *
     * @return mixed
     */
    public function get_updatedat() {
        return $this->updatedat;
    }

    // Setters.

    /**
     * Function set_categoryid
     *
     * @param $categoryid
     */
    public function set_categoryid($categoryid) {
        $this->category = null;
        $this->categoryid = $categoryid;
    }

    /**
     * Function set_userid
     *
     * @param $userid
     */
    public function set_userid($userid) {
        $this->userid = $userid;
    }

    /**
     * Function set_subject
     *
     * @param $subject
     */
    public function set_subject($subject) {
        $this->subject = $subject;
    }

    /**
     * Function set_description
     *
     * @param $description
     */
    public function set_description($description) {
        $this->description = $description;
    }

    /**
     * Function set_message
     *
     * @param $message
     */
    public function set_message($message) {
        $this->message = $message;
    }

    /**
     * Function set_status
     *
     * @param $status
     */
    public function set_status($status) {
        $this->status = $status;
    }

    /**
     * Function set_priority
     *
     * @param $priority
     */
    public function set_priority($priority) {
        $this->priority = $priority;
    }

    /**
     * Function set_assignedto
     *
     * @param $assignedto
     */
    public function set_assignedto($assignedto) {
        $this->assignedto = $assignedto;
    }

    /**
     * Function set_updatedat
     *
     * @param $updatedat
     */
    public function set_updatedat($updatedat) {
        $this->updatedat = $updatedat;
    }
}
