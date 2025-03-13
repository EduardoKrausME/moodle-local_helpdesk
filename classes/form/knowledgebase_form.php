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

global $CFG;
require_once("{$CFG->libdir}/formslib.php");

/**
 * Class knowledgebase_form
 *
 * @package local_helpdesk\form
 */
class knowledgebase_form extends \moodleform {
    /**
     * Function definition
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function definition() {
        global $OUTPUT, $CFG, $PAGE;

        $mform = $this->_form;

        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);

        $mform->addElement("hidden", "action");
        $mform->setType("action", PARAM_TEXT);

        // Title field.
        $mform->addElement("text", "title", get_string("knowledgebase_title", "local_helpdesk"));
        $mform->setType("title", PARAM_TEXT);
        $mform->addRule("title", get_string("required"), "required", null, "server");

        // Category selection.
        $options = ["" => "..:: " . get_string("select") . " ::.."] + $this->get_categories();
        $mform->addElement("select", "categoryid", get_string("knowledgebase_category", "local_helpdesk"), $options);
        $mform->setType("categoryid", PARAM_INT);
        $mform->addRule("categoryid", get_string("required"), "required", null, "server");

        // Description field.
        $mform->addElement("editor", "description", get_string("knowledgebase_description", "local_helpdesk"), null, [
            "maxfiles" => 0,
            "maxbytes" => 0,
        ]);
        $mform->setType("description", PARAM_RAW);
        $mform->addRule("description", null, "required");

        // IA.
        $apikey = get_config("local_geniai", "apikey");
        if (isset($apikey[20])) {
            $button = $OUTPUT->render_from_template("local_helpdesk/knowledgebase-form-ia", []);
            $mform->addElement("static", "create_local_geniai", get_string("geniai_title", "local_helpdesk"), $button);
        } else {
            if (file_exists("{$CFG->dirroot}/local/geniai/lib.php")) {
                $link = "{$CFG->wwwroot}/admin/settings.php?section=local_geniai";
            } else {
                $link = "https://moodle.org/plugins/local_geniai";
            }

            $message = get_string("geniai_missing", "local_helpdesk", $link);
            $message = $PAGE->get_renderer("core")->render(new \core\output\notification($message, "warning"));
            $mform->addElement("static", "missing_local_geniai", get_string("geniai_title", "local_helpdesk"), $message);
        }

        // Submit button.
        if (isset($this->_customdata["id"])) {
            $this->add_action_buttons(true, get_string("knowledgebase_edit", "local_helpdesk"));
        } else {
            $this->add_action_buttons(true, get_string("knowledgebase_create", "local_helpdesk"));
        }
    }

    /**
     * Function get_categories
     *
     * @return array
     * @throws \dml_exception
     */
    private function get_categories() {
        global $DB;
        $categories = $DB->get_records_menu("local_helpdesk_category", null, "name", "id, name");
        return $categories ?: [];
    }

    /**
     * Function validation
     *
     * @param array $data
     * @param array $files
     *
     * @return array
     * @throws \coding_exception
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        if (empty(trim($data["title"]))) {
            $errors["title"] = get_string("required");
        }

        if (empty(trim($data["description"]["text"]))) {
            $errors["description"] = get_string("required");
        }

        if (empty($data["categoryid"]) || $data["categoryid"] == 0) {
            $errors["categoryid"] = get_string("required");
        }

        return $errors;
    }
}
