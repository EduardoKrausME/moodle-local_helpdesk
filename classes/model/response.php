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
 * Class response
 *
 * @package local_helpdesk\model
 */
class response {

    /** @var string */
    const TYPE_MESSAGE = "message";
    /** @var string */
    const TYPE_STATUS = "status";
    /** @var string */
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

    /**
     * response constructor.
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
     * @param int $responseid
     *
     * @return response|null
     * @throws \dml_exception
     */
    public static function get_by_id($responseid) {
        global $DB;
        $record = $DB->get_record("local_helpdesk_response", ["id" => $responseid]);

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
        return model_base::get_all("local_helpdesk_response", self::class, $wheres, $params, $order);
    }

    /**
     * Function save
     *
     * @param ticket $ticket
     *
     * @return bool|int
     * @throws \dml_exception
     * @throws \coding_exception
     */
    public function save($ticket) {
        global $DB;

        if ($this->id) {
            return $DB->update_record("local_helpdesk_response", get_object_vars($this));
        } else {
            if (!$ticket->get_answeredat()) {
                $DB->set_field("local_helpdesk_ticket", "answeredat", time(), ["id" => $ticket->get_id()]);
            }

            if ($this->type == self::TYPE_STATUS && !$ticket->get_closedat()) {
                if (strpos($this->message, get_string("status_resolved", "local_helpdesk"))) {
                    $DB->set_field("local_helpdesk_ticket", "closedat", time(), ["id" => $ticket->get_id()]);
                } else if (strpos($this->message, get_string("status_closed", "local_helpdesk"))) {
                    $DB->set_field("local_helpdesk_ticket", "closedat", time(), ["id" => $ticket->get_id()]);
                }
            }

            return $this->id = $DB->insert_record("local_helpdesk_response", get_object_vars($this));
        }
    }

    /**
     * Function create_status
     *
     * @param ticket $ticket
     * @param string $message
     *
     * @throws \dml_exception
     * @throws \coding_exception
     */
    public static function create_status(ticket $ticket, $message) {
        global $USER;

        $response = new response([
            "ticketid" => $ticket->get_id(),
            "message" => $message,
            "type" => self::TYPE_STATUS,
            "userid" => $USER->id,
            "createdat" => time(),
        ]);
        $response->save($ticket);
    }

    /**
     * Function create_info
     *
     * @param ticket $ticket
     * @param string $message
     *
     * @throws \dml_exception
     * @throws \coding_exception
     */
    public static function create_info(ticket $ticket, $message) {
        global $USER;

        $response = new response([
            "ticketid" => $ticket->get_id(),
            "message" => $message,
            "type" => self::TYPE_INFO,
            "userid" => $USER->id,
            "createdat" => time(),
        ]);
        $response->save($ticket);
    }


    /**
     * Function delete
     *
     * @return bool
     * @throws \dml_exception
     */
    public function delete() {
        global $DB;
        return $DB->delete_records("local_helpdesk_response", ["id" => $this->id]);
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
     * Function get_ticketid
     *
     * @return mixed
     */
    public function get_ticketid() {
        return $this->ticketid;
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
     * Function get_type
     *
     * @return string
     */
    public function get_type() {
        return $this->type;
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
     * Function get_createdat
     *
     * @return mixed
     */
    public function get_createdat() {
        return $this->createdat;
    }

    // Setters.

    /**
     * Function set_ticketid
     *
     * @param int $ticketid
     */
    public function set_ticketid($ticketid) {
        $this->ticketid = $ticketid;
    }

    /**
     * Function set_userid
     *
     * @param int $userid
     */
    public function set_userid($userid) {
        $this->userid = $userid;
        $this->user = null;
    }

    /**
     * Function set_type
     *
     * @param string $type
     */
    public function set_type($type) {
        $this->type = $type;
    }

    /**
     * Function set_message
     *
     * @param string $message
     */
    public function set_message($message) {
        $this->message = $message;
    }
}
