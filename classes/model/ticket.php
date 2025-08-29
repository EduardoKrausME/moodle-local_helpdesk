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
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\model;

/**
 * Class ticket
 *
 * @package local_helpdesk\model
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
    protected $status;
    /** @var string */
    protected $priority;
    /** @var int */
    protected $createdat;
    /** @var int */
    protected $updatedat;
    /** @var int */
    protected $answeredat;
    /** @var int */
    protected $closedat;

    /**
     * ticket constructor.
     *
     * @param object|array $obj
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
            $record = $DB->get_record("local_helpdesk_ticket", ["idkey" => $ticketid]);
        } else {
            $record = $DB->get_record("local_helpdesk_ticket", ["id" => $ticketid]);
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
        return model_base::get_all("local_helpdesk_ticket", self::class, $wheres, $params, $order);
    }

    /**
     * Function save
     *
     * @return bool|int
     * @throws \dml_exception
     */
    public function save() {
        global $DB, $USER;

        if (!$this->userid) {
            $this->userid = $USER->id;
        }

        if ($this->id) {
            return $DB->update_record("local_helpdesk_ticket", get_object_vars($this));
        } else {
            $this->idkey = date("Ym") . substr("" . time(), -6);
            $this->answeredat = 0;
            $this->closedat = 0;
            return $this->id = $DB->insert_record("local_helpdesk_ticket", get_object_vars($this));
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
        return $DB->delete_records("local_helpdesk_ticket", ["id" => $this->id]);
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

        $this->category = new category(
            $DB->get_record("local_helpdesk_category", ["id" => $this->get_categoryid()])
        );
        return $this->category;
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
     * @throws \coding_exception
     */
    public function get_user() {
        if ($this->user) {
            return $this->user;
        }

        if ($this->userid == 0) {
            $this->user = (object)[
                "id" => 0,
                "firstname" => get_string("coresystem"),
                "lastname" => "",
                "email" => "a@a.com",
            ];
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
     * Function get_status
     *
     * @return mixed
     */
    public function get_status() {
        return $this->status;
    }

    /**
     * Function has_closed
     *
     * @return bool
     */
    public function has_closed() {
        if ($this->get_status() == self::STATUS_CLOSED) {
            return true;
        }

        return false;
    }

    /**
     * Function get_status_options
     *
     * @param string $selected
     * @param bool $addall
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_status_options($selected, $addall = false) {
        $status = [
            [
                "key" => "open",
                "label" => get_string("status_open", "local_helpdesk"),
                "selected" => $selected == "open" ? "selected" : "",
            ], [
                "key" => "progress",
                "label" => get_string("status_progress", "local_helpdesk"),
                "selected" => $selected == "progress" ? "selected" : "",
            ], [
                "key" => "resolved",
                "label" => get_string("status_resolved", "local_helpdesk"),
                "selected" => $selected == "resolved" ? "selected" : "",
            ], [
                "key" => "closed",
                "label" => get_string("status_closed", "local_helpdesk"),
                "selected" => $selected == "closed" ? "selected" : "",
            ],
        ];

        if ($addall) {
            $status[] = [
                "key" => "all",
                "label" => get_string("status_all", "local_helpdesk"),
                "selected" => $selected == "all" ? "selected" : "",
            ];
        }

        return $status;
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
     * @param string $status
     *
     * @return string
     * @throws \coding_exception
     */
    public static function status_translated($status) {
        switch ($status) {
            case self::STATUS_OPEN:
                return get_string("status_open", "local_helpdesk");
            case self::STATUS_PROGRESS:
                return get_string("status_progress", "local_helpdesk");
            case self::STATUS_RESOLVED:
                return get_string("status_resolved", "local_helpdesk");
            case self::STATUS_CLOSED:
                return get_string("status_closed", "local_helpdesk");
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
     * Function get_priority_options
     *
     * @param string $selected
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_priority_options($selected) {
        return [
            [
                "key" => "low",
                "label" => get_string("priority_low", "local_helpdesk"),
                "selected" => $selected == "low" ? "selected" : "",
            ], [
                "key" => "medium",
                "label" => get_string("priority_medium", "local_helpdesk"),
                "selected" => $selected == "medium" ? "selected" : "",
            ], [
                "key" => "high",
                "label" => get_string("priority_high", "local_helpdesk"),
                "selected" => $selected == "high" ? "selected" : "",
            ], [
                "key" => "urgent",
                "label" => get_string("priority_urgent", "local_helpdesk"),
                "selected" => $selected == "urgent" ? "selected" : "",
            ],
        ];
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
     * @param string $priority
     *
     * @return string
     * @throws \coding_exception
     */
    public static function priority_translated($priority) {
        switch ($priority) {
            case self::PRIORITY_LOW:
                return get_string("priority_low", "local_helpdesk");
            case self::PRIORITY_MEDIUM:
                return get_string("priority_medium", "local_helpdesk");
            case self::PRIORITY_HIGH:
                return get_string("priority_high", "local_helpdesk");
            case self::PRIORITY_URGENT:
                return get_string("priority_urgent", "local_helpdesk");
            default:
                return $priority;
        }
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

    /**
     * Function get_answeredat
     *
     * @return int
     */
    public function get_answeredat() {
        return $this->answeredat;
    }

    /**
     * Function get_closedat
     *
     * @return int
     */
    public function get_closedat() {
        return $this->closedat;
    }

    // Setters.

    /**
     * Function set_categoryid
     *
     * @param int $categoryid
     */
    public function set_categoryid($categoryid) {
        $this->categoryid = $categoryid;
        $this->category = null;
    }

    /**
     * Function set_userid
     *
     * @param int $userid
     */
    public function set_userid($userid) {
        $this->userid = $userid;
    }

    /**
     * Function set_subject
     *
     * @param string $subject
     */
    public function set_subject($subject) {
        $this->subject = $subject;
    }

    /**
     * Function set_description
     *
     * @param string $description
     */
    public function set_description($description) {
        $this->description = $description;
    }

    /**
     * Function set_status
     *
     * @param string $status
     */
    public function set_status($status) {
        $this->status = $status;
    }

    /**
     * Function change_status
     *
     * @param string $newstatus
     *
     * @return bool
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function change_status($newstatus) {
        if ($this->get_status() == $newstatus) {
            return false;
        }

        $this->set_status($newstatus);
        $this->save();

        $status = self::status_translated($newstatus);
        $savestatus = get_string("lognewstatus", "local_helpdesk", $status);
        response::create_status($this, $savestatus);

        return true;
    }

    /**
     * Function set_priority
     *
     * @param string $priority
     */
    public function set_priority($priority) {
        $this->priority = $priority;
    }

    /**
     * Function change_priority
     *
     * @param string $newpriority
     *
     * @return bool
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function change_priority($newpriority) {
        if ($this->get_priority() == $newpriority) {
            return false;
        }

        $this->set_priority($newpriority);
        $this->save();

        $priority = self::priority_translated($newpriority);
        $savestatus = get_string("lognewpriority", "local_helpdesk", $priority);
        response::create_status($this, $savestatus);

        return true;
    }

    /**
     * Function set_updatedat
     *
     * @param string $updatedat
     */
    public function set_updatedat($updatedat) {
        $this->updatedat = $updatedat;
    }

    /**
     * Function set_answeredat
     *
     * @param $answeredat
     */
    public function set_answeredat($answeredat) {
        $this->answeredat = $answeredat;
    }

    /**
     * Function set_closedat
     *
     * @param $closedat
     */
    public function set_closedat($closedat) {
        $this->closedat = $closedat;
    }
}
