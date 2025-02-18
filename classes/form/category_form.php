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

namespace local_khelpdesk\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/formslib.php");

/**
 * Class category_form
 *
 * @package local_khelpdesk\form
 */
class category_form extends \moodleform {

    /**
     * Define a estrutura do formulário.
     *
     * @throws \coding_exception
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);

        $mform->addElement("hidden", "action");
        $mform->setType("action", PARAM_TEXT);

        $mform->addElement("text", "name", get_string("categoryname", "local_khelpdesk"), ["size" => "50"]);
        $mform->setType("name", PARAM_TEXT);
        $mform->addRule("name", null, "required", null, "client");

        $mform->addElement("textarea", "description", get_string("categorydescription", "local_khelpdesk"));
        $mform->setType("description", PARAM_TEXT);

        $this->add_action_buttons(true, get_string("createcategory", "local_khelpdesk"));
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
            $errors["name"] = get_string("error:emptyname", "local_khelpdesk");
        }

        return $errors;
    }
}
