<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Helpdesk response model.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\model;

/**
 * Response model.
 */
class response {

    const TYPE_MESSAGE = "message";
    const TYPE_STATUS = "status";
    const TYPE_INFO = "info";

    /** @var int */
    protected $id;
    /** @var int */
    protected $ticketid;
    /** @var int */
    protected $userid;
    /** @var string */
    protected $type;
    /** @var string */
    protected $message;
    /** @var int */
    protected $createdat;
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

    public static function get_by_id($responseid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_response", ["id" => $responseid]);
        return $record ? new self($record) : null;
    }

    public static function get_all($wheres = null, $params = [], $order = null) {
        return model_base::get_all("local_helpdesk_response", self::class, $wheres, $params, $order);
    }

    /**
     * Save response.
     *
     * Ticket lifecycle timestamps are intentionally not changed here. A response may be a
     * user message, an informational record or a status audit entry. The ticket controller
     * records the first real support answer and ticket::change_status() owns status dates.
     *
     * @param ticket $ticket
     * @return bool|int
     */
    public function save($ticket) {
        global $DB;

        $record = (object)[
            "id" => $this->id,
            "ticketid" => $this->ticketid,
            "userid" => $this->userid,
            "type" => $this->type,
            "message" => $this->message,
            "createdat" => $this->createdat,
        ];

        if ($this->id) {
            return $DB->update_record("local_helpdesk_response", $record);
        }

        unset($record->id);
        $this->id = $DB->insert_record("local_helpdesk_response", $record);
        return $this->id;
    }

    public static function create_status(ticket $ticket, $message) {
        global $USER;

        $response = new self([
            "ticketid" => $ticket->get_id(),
            "message" => $message,
            "type" => self::TYPE_STATUS,
            "userid" => (int)($USER->id ?? 0),
            "createdat" => time(),
        ]);
        $response->save($ticket);
    }

    public static function create_info(ticket $ticket, $message) {
        global $USER;

        $response = new self([
            "ticketid" => $ticket->get_id(),
            "message" => $message,
            "type" => self::TYPE_INFO,
            "userid" => (int)($USER->id ?? 0),
            "createdat" => time(),
        ]);
        $response->save($ticket);
    }

    public function delete() {
        global $DB;
        return $DB->delete_records("local_helpdesk_response", ["id" => $this->id]);
    }

    public function get_id() {
        return $this->id;
    }

    public function get_ticketid() {
        return $this->ticketid;
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

    public function get_type() {
        return $this->type;
    }

    public function get_message() {
        return $this->message;
    }

    public function get_createdat() {
        return $this->createdat;
    }

    public function set_ticketid($ticketid) {
        $this->ticketid = $ticketid;
    }

    public function set_userid($userid) {
        $this->userid = $userid;
        $this->user = null;
    }

    public function set_type($type) {
        $this->type = $type;
    }

    public function set_message($message) {
        $this->message = $message;
    }
}
