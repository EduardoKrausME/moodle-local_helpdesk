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

    /**
     * message
     */
    const TYPE_MESSAGE = "message";
    /**
     * status
     */
    const TYPE_STATUS = "status";
    /**
     * info
     */
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

    /**
     * get_by_id
     *
     * @param $responseid
     * @return self|null
     * @throws \dml_exception
     */
    public static function get_by_id($responseid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_response", ["id" => $responseid]);
        return $record ? new self($record) : null;
    }

    /**
     * get_all
     *
     * @param $wheres
     * @param $params
     * @param $order
     * @return array
     * @throws \dml_exception
     */
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

    /**
     * create_status
     *
     * @param ticket $ticket
     * @param $message
     * @return void
     */
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

    /**
     * create_info
     *
     * @param ticket $ticket
     * @param $message
     * @return void
     */
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

    /**
     * delete
     *
     * @return bool
     * @throws \dml_exception
     */
    public function delete() {
        global $DB;
        return $DB->delete_records("local_helpdesk_response", ["id" => $this->id]);
    }

    /**
     * get_id
     *
     * @return int
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * get_ticketid
     *
     * @return int
     */
    public function get_ticketid() {
        return $this->ticketid;
    }

    /**
     * get_userid
     *
     * @return int
     */
    public function get_userid() {
        return $this->userid;
    }

    /**
     * get_user
     *
     * @return false|mixed|object|\stdClass|null
     * @throws \coding_exception
     * @throws \dml_exception
     */
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

    /**
     * get_type
     *
     * @return string
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * get_message
     *
     * @return string
     */
    public function get_message() {
        return $this->message;
    }

    /**
     * get_createdat
     *
     * @return int
     */
    public function get_createdat() {
        return $this->createdat;
    }

    /**
     * set_ticketid
     *
     * @param $ticketid
     * @return void
     */
    public function set_ticketid($ticketid) {
        $this->ticketid = $ticketid;
    }

    /**
     * set_userid
     *
     * @param $userid
     * @return void
     */
    public function set_userid($userid) {
        $this->userid = $userid;
        $this->user = null;
    }

    /**
     * set_type
     *
     * @param $type
     * @return void
     */
    public function set_type($type) {
        $this->type = $type;
    }

    /**
     * set_message
     *
     * @param $message
     * @return void
     */
    public function set_message($message) {
        $this->message = $message;
    }
}
