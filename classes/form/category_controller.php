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

use local_khelpdesk\model\category;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/formslib.php");

/**
 * Class category_controller
 *
 * @package local_khelpdesk\form
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

            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else {

            $form->set_data([
                "action" => "add",
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

        $form = new category_form();

        if ($form->is_cancelled()) {
            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else if ($data = $form->get_data()) {
            $category->set_name($data->name);
            $category->set_description($data->description);
            $category->save();
            redirect(new moodle_url("/local/helpdesk/categories.php"));
        } else {

            $form->set_data([
                "id" => $category->get_id(),
                "name" => $category->get_name(),
                "description" => $category->get_description(),
                "action" => "edit",
            ]);
        }

        echo $OUTPUT->header();
        echo $OUTPUT->heading(get_string("updatecategory", "local_khelpdesk"));
        $form->display();
        echo $OUTPUT->footer();
    }
}
