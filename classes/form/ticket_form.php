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
 * ticket_form.php
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\form;

use local_helpdesk\model\category;
use local_helpdesk\model\ticket;
use local_helpdesk\util\filter;

defined('MOODLE_INTERNAL') || die();

require_once("{$CFG->libdir}/formslib.php");

/**
 * Ticket form used to create and edit Helpdesk tickets.
 */
class ticket_form extends \moodleform {

    /**
     * Builds the ticket form.
     *
     * @return void
     */
    protected function definition() {
        global $CFG, $PAGE, $OUTPUT;

        $mform = $this->_form;

        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);
        $mform->addElement("hidden", "courseid");
        $mform->setType("courseid", PARAM_INT);
        $mform->addElement("hidden", "action");
        $mform->setType("action", PARAM_TEXT);

        $mform->addElement("text", "subject", get_string("subject", "local_helpdesk"));
        $mform->setType("subject", PARAM_TEXT);
        $mform->addRule("subject", null, "required");

        if (!empty($this->_customdata["has_ticketmanage"])) {
            filter::load_kopere();

            $data = [
                "user_id" => 0,
                "user_fullname" => get_string("finduser", "local_helpdesk"),
                "url_ajax" => "{$CFG->wwwroot}/local/kopere_dashboard/plugins/users/ajax.php",
                "sesskey" => sesskey(),
                "hide_find_user" => true,
                "hide_openuserby" => true,
            ];

            $PAGE->requires->js_call_amd("local_helpdesk/filter_user", "init");
            $html = $OUTPUT->render_from_template("local_helpdesk/filter-user", $data);

            $mform->addElement("hidden", "find_user");
            $mform->setType("find_user", PARAM_INT);
            $mform->addElement("static", "", get_string("finduser", "local_helpdesk"), $html);
        }

        $categories = category::get_all();
        $categoryoptions = ["" => "..:: " . get_string("select") . " ::.."];
        foreach ($categories as $category) {
            $categoryoptions[$category->get_id()] = $category->get_name();
        }

        $mform->addElement("select", "categoryid", get_string("category", "local_helpdesk"), $categoryoptions);
        $mform->setType("categoryid", PARAM_INT);
        $mform->addRule("categoryid", null, "required");

        $mform->addElement("editor", "description", get_string("ticketdescription", "local_helpdesk"), null, [
            "maxfiles" => 0,
            "maxbytes" => 0,
        ]);
        $mform->setType("description", PARAM_RAW);
        $mform->addRule("description", null, "required");

        $priorityoptions = [
            ticket::PRIORITY_LOW => get_string("ticketprioritylow", "local_helpdesk"),
            ticket::PRIORITY_MEDIUM => get_string("ticketprioritymedium", "local_helpdesk"),
            ticket::PRIORITY_HIGH => get_string("ticketpriorityhigh", "local_helpdesk"),
            ticket::PRIORITY_URGENT => get_string("ticketpriorityurgent", "local_helpdesk"),
        ];
        $mform->addElement("select", "priority", get_string("priority", "local_helpdesk"), $priorityoptions);
        $mform->setType("priority", PARAM_TEXT);
        $mform->addRule("priority", null, "required");

        $mform->addElement("filemanager", "attachment", get_string("attachment", "local_helpdesk"), null, [
            "maxfiles" => 5,
            "subdirs" => 0,
            "accepted_types" => "*",
            "maxbytes" => 0,
        ]);

        if (isset($this->_customdata["ticket"])) {
            $this->add_action_buttons(true, get_string("editticket", "local_helpdesk"));
        } else {
            $this->add_action_buttons(true, get_string("createticket", "local_helpdesk"));
        }
    }

    /**
     * Validates ticket data.
     *
     * @param array $data Form data.
     * @param array $files Uploaded files.
     * @return array Validation errors.
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty(trim($data["subject"]))) {
            $errors["subject"] = get_string("required");
        }
        if (empty($data["categoryid"])) {
            $errors["categoryid"] = get_string("required");
        }
        if (empty(trim($data["description"]["text"]))) {
            $errors["description"] = get_string("required");
        }

        $validpriorities = [
            ticket::PRIORITY_LOW,
            ticket::PRIORITY_MEDIUM,
            ticket::PRIORITY_HIGH,
            ticket::PRIORITY_URGENT,
        ];
        if (!in_array($data["priority"], $validpriorities, true)) {
            $errors["priority"] = get_string("invalidpriority", "local_helpdesk");
        }

        return $errors;
    }
}
