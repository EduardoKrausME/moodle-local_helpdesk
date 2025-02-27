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

use context_system;
use local_helpdesk\model\category;

defined('MOODLE_INTERNAL') || die();

require_once("{$CFG->libdir}/formslib.php");

/**
 * Class category_form
 *
 * @package local_helpdesk\form
 */
class category_form extends \moodleform {

    /**
     * Define a estrutura do formulário.
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function definition() {
        global $OUTPUT;

        $mform = $this->_form;

        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);

        $mform->addElement("hidden", "actionform");
        $mform->setType("actionform", PARAM_TEXT);

        $mform->addElement("text", "name", get_string("categoryname", "local_helpdesk"), ["size" => "50"]);
        $mform->setType("name", PARAM_TEXT);
        $mform->addRule("name", null, "required");

        $mform->addElement("textarea", "description", get_string("categorydescription", "local_helpdesk"));
        $mform->setType("description", PARAM_TEXT);

        if (isset($this->_customdata["id"])) {
            /** @var category $category */
            $category = $this->_customdata["category"];

            $data = ["categoryid" => $this->_customdata["id"]];
            $templatecontext = [
                "existinguserselector" => (new category_existing_selector("removeselect", $data))->display(true),
                "potentialuserselector" => (new category_candidate_selector("addselect", $data))->display(true),
                "contextid" => context_system::instance()->id,
                "roleid" => $category->get_role_id(),
            ];
            $html = $OUTPUT->render_from_template("local_helpdesk/category-users", $templatecontext);
            $mform->addElement("html", $html);
        } else {
            $message = get_string("category_users_info", "local_helpdesk");
            global $PAGE;
            $html = $PAGE->get_renderer("core")->render(new \core\output\notification($message, "info"));
            $mform->addElement("html", $html);
        }

        if (isset($this->_customdata["id"])) {
            $this->add_action_buttons(true, get_string("createcategory", "local_helpdesk"));
        } else {
            $this->add_action_buttons(true, get_string("editticket", "local_helpdesk"));
        }
    }

    /**
     * Validação personalizada do formulário, se necessário.
     *
     * @param array $data
     * @param array $files
     *
     * @return array
     * @throws \coding_exception
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty($data["name"])) {
            $errors["name"] = get_string("error:emptyname", "local_helpdesk");
        }

        return $errors;
    }
}
