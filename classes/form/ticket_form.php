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

namespace local_helpdesk\form;

use local_helpdesk\model\category;
use local_helpdesk\model\ticket;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/formslib.php");

/**
 * Class ticket_form
 *
 * @package local_helpdesk\form
 */
class ticket_form extends \moodleform {

    /**
     * Function definition
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    protected function definition() {
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

        $categories = category::get_all();
        $categoryoptions = ["" => "..:: " . get_string("select") . " ::.."];
        /** @var category $category */
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

        if ($this->_customdata["ticket"]) {
            $this->add_action_buttons(true, get_string("editticket", "local_helpdesk"));
        } else {
            $this->add_action_buttons(true, get_string("createticket", "local_helpdesk"));
        }
    }
}
