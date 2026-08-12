<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Helpdesk ticket model.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\model;

/**
 * Ticket model.
 */
class ticket {

    const PRIORITY_LOW = "low";
    const PRIORITY_MEDIUM = "medium";
    const PRIORITY_HIGH = "high";
    const PRIORITY_URGENT = "urgent";

    const STATUS_OPEN = "open";
    const STATUS_PROGRESS = "progress";
    const STATUS_RESOLVED = "resolved";
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
    protected $resolvedat;
    /** @var int */
    protected $closedat;
    /** @var int */
    protected $remindedat;

    /** @var category|null */
    private $category;
    /** @var \stdClass|null */
    private $user;

    /**
     * Constructor.
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
     * Get ticket using the numeric database id or the public idkey.
     *
     * @param string|int $ticketid
     * @return ticket|null
     */
    public static function get_by_id($ticketid) {
        global $DB;

        if ($ticketid > 10000000) {
            $record = $DB->get_record("local_helpdesk_ticket", ["idkey" => $ticketid]);
        } else {
            $record = $DB->get_record("local_helpdesk_ticket", ["id" => $ticketid]);
        }

        return $record ? new self($record) : null;
    }

    /**
     * Get all tickets.
     *
     * @param array|string|null $wheres
     * @param array $params
     * @param string|null $order
     * @return array
     */
    public static function get_all($wheres = null, $params = [], $order = null) {
        return model_base::get_all("local_helpdesk_ticket", self::class, $wheres, $params, $order);
    }

    /**
     * Convert the model to a database record without cached relationship properties.
     *
     * @return \stdClass
     */
    private function to_record() {
        return (object)[
            "id" => $this->id,
            "idkey" => $this->idkey,
            "categoryid" => $this->categoryid,
            "userid" => $this->userid,
            "courseid" => $this->courseid,
            "subject" => $this->subject,
            "description" => $this->description,
            "status" => $this->status,
            "priority" => $this->priority,
            "createdat" => $this->createdat,
            "updatedat" => $this->updatedat,
            "answeredat" => $this->answeredat,
            "resolvedat" => $this->resolvedat,
            "closedat" => $this->closedat,
            "remindedat" => $this->remindedat,
        ];
    }

    /**
     * Save ticket.
     *
     * @return bool|int
     */
    public function save() {
        global $DB, $USER;

        if (!$this->userid) {
            $this->userid = $USER->id;
        }

        if ($this->id) {
            return $DB->update_record("local_helpdesk_ticket", $this->to_record());
        }

        $this->idkey = date("Ym") . substr("" . time(), -6);
        $this->answeredat = (int)($this->answeredat ?? 0);
        $this->resolvedat = (int)($this->resolvedat ?? 0);
        $this->closedat = (int)($this->closedat ?? 0);
        $this->remindedat = (int)($this->remindedat ?? 0);

        $record = $this->to_record();
        unset($record->id);
        $this->id = $DB->insert_record("local_helpdesk_ticket", $record);
        return $this->id;
    }

    /**
     * Delete ticket, responses and attached files.
     *
     * @return bool
     */
    public function delete() {
        global $DB;

        $context = \context_system::instance();
        $fs = get_file_storage();

        $responses = $DB->get_records("local_helpdesk_response", ["ticketid" => $this->id], "", "id");
        foreach ($responses as $response) {
            $fs->delete_area_files($context->id, "local_helpdesk", "response", $response->id);
        }

        $fs->delete_area_files($context->id, "local_helpdesk", "ticket", $this->id);
        $DB->delete_records("local_helpdesk_response", ["ticketid" => $this->id]);
        return $DB->delete_records("local_helpdesk_ticket", ["id" => $this->id]);
    }

    public function get_id() {
        return $this->id;
    }

    public function get_idkey() {
        return $this->idkey;
    }

    public function get_categoryid() {
        return $this->categoryid;
    }

    public function get_category() {
        global $DB;

        if ($this->category) {
            return $this->category;
        }

        $record = $DB->get_record("local_helpdesk_category", ["id" => $this->get_categoryid()], "*", MUST_EXIST);
        $this->category = new category($record);
        return $this->category;
    }

    public function get_userid() {
        return $this->userid;
    }

    public function get_user() {
        global $DB;

        if ($this->user) {
            return $this->user;
        }

        if ((int)$this->userid === 0) {
            $this->user = (object)[
                "id" => 0,
                "firstname" => get_string("coresystem"),
                "lastname" => "",
                "email" => "",
            ];
            return $this->user;
        }

        $this->user = $DB->get_record("user", ["id" => $this->userid], "*", MUST_EXIST);
        return $this->user;
    }

    public function get_courseid() {
        return $this->courseid;
    }

    public function get_subject() {
        return $this->subject;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_status() {
        return $this->status;
    }

    public function has_closed() {
        return $this->get_status() === self::STATUS_CLOSED;
    }

    public static function get_status_options($selected, $addall = false) {
        $status = [
            ["key" => self::STATUS_OPEN, "label" => get_string("status_open", "local_helpdesk"),
                "selected" => $selected === self::STATUS_OPEN ? "selected" : ""],
            ["key" => self::STATUS_PROGRESS, "label" => get_string("status_progress", "local_helpdesk"),
                "selected" => $selected === self::STATUS_PROGRESS ? "selected" : ""],
            ["key" => self::STATUS_RESOLVED, "label" => get_string("status_resolved", "local_helpdesk"),
                "selected" => $selected === self::STATUS_RESOLVED ? "selected" : ""],
            ["key" => self::STATUS_CLOSED, "label" => get_string("status_closed", "local_helpdesk"),
                "selected" => $selected === self::STATUS_CLOSED ? "selected" : ""],
        ];

        if ($addall) {
            $status[] = [
                "key" => "all",
                "label" => get_string("status_all", "local_helpdesk"),
                "selected" => $selected === "all" ? "selected" : "",
            ];
        }

        return $status;
    }

    public function get_status_translated() {
        return self::status_translated($this->status);
    }

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

    public function get_priority() {
        return $this->priority;
    }

    public static function get_priority_options($selected) {
        return [
            ["key" => self::PRIORITY_LOW, "label" => get_string("priority_low", "local_helpdesk"),
                "selected" => $selected === self::PRIORITY_LOW ? "selected" : ""],
            ["key" => self::PRIORITY_MEDIUM, "label" => get_string("priority_medium", "local_helpdesk"),
                "selected" => $selected === self::PRIORITY_MEDIUM ? "selected" : ""],
            ["key" => self::PRIORITY_HIGH, "label" => get_string("priority_high", "local_helpdesk"),
                "selected" => $selected === self::PRIORITY_HIGH ? "selected" : ""],
            ["key" => self::PRIORITY_URGENT, "label" => get_string("priority_urgent", "local_helpdesk"),
                "selected" => $selected === self::PRIORITY_URGENT ? "selected" : ""],
        ];
    }

    public function get_priority_translated() {
        return self::priority_translated($this->priority);
    }

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

    public function get_createdat() {
        return $this->createdat;
    }

    public function get_updatedat() {
        return $this->updatedat;
    }

    public function get_answeredat() {
        return (int)$this->answeredat;
    }

    public function get_resolvedat() {
        return (int)$this->resolvedat;
    }

    public function get_closedat() {
        return (int)$this->closedat;
    }

    public function get_remindedat() {
        return (int)$this->remindedat;
    }

    public function set_categoryid($categoryid) {
        $this->categoryid = $categoryid;
        $this->category = null;
    }

    public function set_userid($userid) {
        $this->userid = $userid;
        $this->user = null;
    }

    public function set_subject($subject) {
        $this->subject = $subject;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function set_status($status) {
        $this->status = $status;
    }

    /**
     * Change status and maintain status timestamps in one place.
     *
     * @param string $newstatus
     * @return bool
     */
    public function change_status($newstatus) {
        $validstatuses = [self::STATUS_OPEN, self::STATUS_PROGRESS, self::STATUS_RESOLVED, self::STATUS_CLOSED];
        if (!in_array($newstatus, $validstatuses, true)) {
            throw new \invalid_parameter_exception("Invalid ticket status");
        }

        if ($this->get_status() === $newstatus) {
            return false;
        }

        $now = time();
        $this->set_status($newstatus);
        $this->set_updatedat($now);

        switch ($newstatus) {
            case self::STATUS_OPEN:
            case self::STATUS_PROGRESS:
                $this->resolvedat = 0;
                $this->closedat = 0;
                break;

            case self::STATUS_RESOLVED:
                $this->resolvedat = $now;
                $this->closedat = 0;
                break;

            case self::STATUS_CLOSED:
                $this->closedat = $now;
                break;
        }

        $this->save();

        $status = self::status_translated($newstatus);
        $savestatus = get_string("lognewstatus", "local_helpdesk", $status);
        response::create_status($this, $savestatus);
        return true;
    }

    public function set_priority($priority) {
        $this->priority = $priority;
    }

    public function change_priority($newpriority) {
        $validpriorities = [self::PRIORITY_LOW, self::PRIORITY_MEDIUM, self::PRIORITY_HIGH, self::PRIORITY_URGENT];
        if (!in_array($newpriority, $validpriorities, true)) {
            throw new \invalid_parameter_exception("Invalid ticket priority");
        }

        if ($this->get_priority() === $newpriority) {
            return false;
        }

        $this->set_priority($newpriority);
        $this->set_updatedat(time());
        $this->save();

        $priority = self::priority_translated($newpriority);
        $savestatus = get_string("lognewpriority", "local_helpdesk", $priority);
        response::create_status($this, $savestatus);
        return true;
    }

    public function set_updatedat($updatedat) {
        $this->updatedat = $updatedat;
    }

    public function set_answeredat($answeredat) {
        $this->answeredat = $answeredat;
    }

    public function set_resolvedat($resolvedat) {
        $this->resolvedat = $resolvedat;
    }

    public function set_closedat($closedat) {
        $this->closedat = $closedat;
    }

    public function set_remindedat($remindedat) {
        $this->remindedat = $remindedat;
    }
}
