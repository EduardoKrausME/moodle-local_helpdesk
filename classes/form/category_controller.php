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
use local_helpdesk\model\category_users;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/formslib.php");

/**
 * Class category_controller
 *
 * @package local_helpdesk\form
 */
class category_controller {

    /**
     * Function insert_category
     *
     * @throws \core\exception\moodle_exception
     * @throws \moodle_exception
     */
    public function insert_category() {
        global $OUTPUT;

        $form = new category_form();

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else if ($data = $form->get_data()) {

            $data->createdat = time();

            $category = new category($data);
            $category->save();

            $data = [
                "id" => $category->get_id(),
                "actionform" => "edit",
            ];
            redirect(new moodle_url("/local/helpdesk/categories.php", $data));
        } else {

            $form->set_data([
                "actionform" => "add",
            ]);
        }

        echo $OUTPUT->header();
        $form->display();
        echo $OUTPUT->footer();
    }

    /**
     * Function update_category
     *
     * @param category $category
     *
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     * @throws \moodle_exception
     */
    public function update_category(category $category) {
        global $OUTPUT;

        $form = new category_form(null, ["id" => $category->get_id(), "category" => $category]);

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else if ($data = $form->get_data()) {
            $category->set_name($data->name);
            $category->set_description($data->description);
            $category->save();

            if ($this->process_users($category)) {
                $data = [
                    "id" => $category->get_id(),
                    "actionform" => "edit",
                ];
                redirect(new moodle_url("/local/helpdesk/categories.php", $data));
            }

            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else {
            $form->set_data([
                "id" => $category->get_id(),
                "name" => $category->get_name(),
                "description" => $category->get_description(),
                "actionform" => "edit",
            ]);
        }

        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string("updatecategory", "local_helpdesk"));
        $form->display();
        echo $OUTPUT->footer();
    }

    /**
     * Function process_users
     *
     * @param category $category
     *
     * @return bool
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private function process_users(category $category) {
        global $DB, $USER;

        $roleid = $category->get_role_id();

        // Process incoming user to the category.
        if (optional_param("add", false, PARAM_BOOL) && confirm_sesskey()) {
            $users = optional_param_array("addselect", [], PARAM_INT);

            foreach ($users as $userid) {

                $categoryusers = new category_users([
                    "categoryid" => $category->get_id(),
                    "userid" => $userid,
                    "createdat" => time(),
                ]);
                $categoryusers->save();

                if ($DB->record_exists("role_assignments", ["roleid" => $roleid, "userid" => $userid])) {
                    continue;
                } else {
                    $roleassignments = [
                        "roleid" => $roleid,
                        "userid" => $userid,
                        "contextid" => context_system::instance()->id,
                        "timemodified" => time(),
                        "modifierid" => $USER->id,
                        "component" => "",
                        "itemid" => "0",
                        "sortorder" => "0",
                    ];
                    $DB->insert_record("role_assignments", $roleassignments);
                }
            }

            return true;
        }

        // Process removing user to the category.
        if (optional_param("remove", false, PARAM_BOOL) && confirm_sesskey()) {

            $users = optional_param_array("removeselect", [], PARAM_INT);

            foreach ($users as $userid) {

                $categoryusers = category_users::get_all(null, ["categoryid" => $category->get_id(), "userid" => $userid]);
                /** @var category_users $categoryuser */
                foreach ($categoryusers as $categoryuser) {
                    $categoryuser->delete();

                    // Validates if there is no other category with this user.
                    $testuser = category_users::get_all(null, ["userid" => $userid]);
                    if (!$testuser) {
                        $roleassignments = [
                            "roleid" => $roleid,
                            "contextid" => context_system::instance()->id,
                            "userid" => $userid,
                        ];
                        $DB->delete_records("role_assignments", $roleassignments);
                    }
                }
            }

            return true;
        }

        return false;
    }
}
