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

use local_helpdesk\model\ticket;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/formslib.php");

/**
 * Class response_form
 *
 * @package local_helpdesk\form
 */
class response_form extends \moodleform {
    /**
     * Function definition
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    protected function definition() {
        global $OUTPUT, $PAGE, $CFG;

        $mform = $this->_form;

        $mform->addElement("hidden", "id");
        $mform->setType("id", PARAM_INT);

        $mform->addElement("hidden", "idkey");
        $mform->setType("idkey", PARAM_INT);

        $mform->addElement("editor", "message", get_string("ticketmessage", "local_helpdesk"), null, [
            "maxfiles" => 0,
            "maxbytes" => 0,
        ]);
        $mform->setType("message", PARAM_RAW);
        $mform->addRule("message", null, "required");

        if ($this->_customdata["hasticketmanage"]) {
            $apikey = get_config("local_geniai", "apikey");
            if (isset($apikey[5])) {
                /** @var ticket $ticket */
                $ticket = $this->_customdata["ticket"];
                $button = $OUTPUT->render_from_template("local_helpdesk/response-form-ia", [
                    "ticketid" => $ticket->get_id(),
                ]);
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
        }

        $mform->addElement("filemanager", "attachment", get_string("attachment", "local_helpdesk"), null, [
            "maxfiles" => 5,
            "subdirs" => 0,
            "accepted_types" => "*",
            "maxbytes" => 0,
        ]);

        $itens = [
            $mform->createElement("submit", "submitbutton", get_string("ticketresponse", "local_helpdesk")),
            $mform->createElement("submit", "resolvedbutton", get_string("ticketresponseandresolved", "local_helpdesk")),
            $mform->createElement("submit", "closebutton", get_string("ticketresponseandclose", "local_helpdesk")),
            $mform->createElement("cancel"),
        ];
        $mform->addGroup($itens, "buttonar", "", [" "], true);
        $mform->closeHeaderBefore("buttonar");
    }
}
