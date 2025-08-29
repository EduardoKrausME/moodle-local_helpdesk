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
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\form;

use local_helpdesk\model\knowledgebase;
use moodle_url;

/**
 * Class knowledgebase_controller
 *
 * @package local_helpdesk\form
 */
class knowledgebase_controller {
    /**
     * Function insert_knowledgebase
     *
     * @throws \core\exception\moodle_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function insert_knowledgebase() {
        global $OUTPUT, $USER;

        $form = new knowledgebase_form();

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/knowledgebase.php"));
        } else if ($data = $form->get_data()) {

            $knowledgebase = new knowledgebase($data);
            $knowledgebase->set_userid($USER->id);
            $knowledgebase->set_description($data->description["text"]);
            $knowledgebase->set_createdat(time());
            $knowledgebase->set_updatedat(time());
            $knowledgebase->save();

            $data = [
                "id" => $knowledgebase->get_id(),
                "actionform" => "edit",
            ];
            redirect(new moodle_url("/local/helpdesk/knowledgebase.php", $data));
        } else {

            $form->set_data([
                "categoryid" => optional_param("cat", 0, PARAM_INT),
                "action" => "add",
            ]);
        }

        echo $OUTPUT->header();
        $form->display();
        echo $OUTPUT->footer();
        die;
    }

    /**
     * Function update_knowledgebase
     *
     * @param knowledgebase $knowledgebase
     *
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function update_knowledgebase(knowledgebase $knowledgebase) {
        global $OUTPUT;

        $form = new knowledgebase_form(null, ["id" => $knowledgebase->get_id(), "knowledgebase" => $knowledgebase]);

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/knowledgebase.php"));
        } else if ($data = $form->get_data()) {
            $knowledgebase->set_title($data->title);
            $knowledgebase->set_description($data->description["text"]);
            $knowledgebase->set_categoryid($data->categoryid);
            $knowledgebase->set_updatedat(time());
            $knowledgebase->save();

            redirect(new moodle_url("/local/helpdesk/knowledgebase.php"));
        } else {
            $form->set_data([
                "id" => $knowledgebase->get_id(),
                "title" => $knowledgebase->get_title(),
                "userid" => $knowledgebase->get_userid(),
                "description" => [
                    "text" => $knowledgebase->get_description(),
                ],
                "categoryid" => $knowledgebase->get_categoryid(),
                "createdat" => $knowledgebase->get_createdat(),
                "updatedat" => $knowledgebase->get_updatedat(),
                "action" => "edit",
            ]);
        }

        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string("knowledgebase_update", "local_helpdesk"));
        $form->display();
        echo $OUTPUT->footer();
        die;
    }
}
