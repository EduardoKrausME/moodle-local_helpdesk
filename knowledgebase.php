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
 * knowledgebase file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_helpdesk\form\knowledgebase_controller;
use local_helpdesk\model\category;
use local_helpdesk\model\knowledgebase;

require_once("../../config.php");
require_once("lib.php");

if (false) {
    require_login();
}

$id = optional_param("id", 0, PARAM_INT);

if ($id) {
    $knowledgebase = knowledgebase::get_by_id($id);
    if (!$knowledgebase) {
        throw new \moodle_exception("knowledgebase_articlenotfound", "local_helpdesk");
    }
} else {
    $knowledgebase = new knowledgebase(["id" => 0, "title" => ""]);
}

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url("/local/helpdesk/knowledgebase.php", ["id" => $knowledgebase->get_id()]);
$PAGE->set_title(format_string($knowledgebase->get_title()));
$PAGE->set_heading(get_string("pluginname", "local_helpdesk"));

$PAGE->navbar->add(get_string("knowledgebase_name", "local_helpdesk"),
    new moodle_url("/local/helpdesk/"));

$hasview = $hasknowledgebasemanage = has_capability("local/helpdesk:knowledgebase_manage", $context);
if (!$hasview) {
    $hasview = has_capability("local/helpdesk:knowledgebase_view", $context);
}

// Add HelpDesk secondary nav.
if ($hasknowledgebasemanage) {
    local_helpdesk_set_secondarynav();
} else {
    $PAGE->set_secondary_navigation(false);
}

if ($hasknowledgebasemanage) {
    if (optional_param("action", false, PARAM_TEXT) == "add") {
        $controller = new knowledgebase_controller();
        $controller->insert_knowledgebase();
    }
    if (optional_param("action", false, PARAM_TEXT) == "edit" && $knowledgebase->get_id()) {
        $controller = new knowledgebase_controller();
        $controller->update_knowledgebase($knowledgebase);
    }
    if (optional_param("action", false, PARAM_TEXT) == "delete" && $knowledgebase->get_id()) {

        $PAGE->set_title(get_string("knowledgebase_delete", "local_helpdesk"));
        $PAGE->set_heading(get_string("knowledgebase_delete", "local_helpdesk"));

        $PAGE->navbar->add(get_string("knowledgebase_delete", "local_helpdesk"));

        if (optional_param("confirm", "", PARAM_TEXT) == md5($knowledgebase->get_id() . sesskey())) {
            require_sesskey();

            $knowledgebase->delete();

            redirect(new moodle_url("/local/helpdesk/knowledgebase.php"),
                get_string("knowledgebase_delete_success", "local_helpdesk"), null,
                \core\output\notification::NOTIFY_SUCCESS);
        }

        echo $OUTPUT->header();

        $cancelurl = new moodle_url("/local/helpdesk/knowledgebase.php");
        $continueurl = new moodle_url("/local/helpdesk/knowledgebase.php",
            [
                "id" => $knowledgebase->get_id(),
                "action" => "delete",
                "confirm" => md5($knowledgebase->get_id() . sesskey()),
                "sesskey" => sesskey(),
            ]);
        $continuebutton = new \single_button($continueurl, get_string("delete"), "post", "danger");
        echo $OUTPUT->confirm(
            get_string("knowledgebase_delete_confirm", "local_helpdesk", $knowledgebase->get_title()),
            $continuebutton,
            $cancelurl);

        echo $OUTPUT->footer();
        die;
    }
    if (optional_param("action", false, PARAM_TEXT) == "import") {
        $path = __DIR__ . "/db/knowledgebases/{$CFG->lang}.json";
        if (file_exists($path)) {
            $categorys = json_decode(file_get_contents($path));

            foreach ($categorys as $createid => $category) {
                if ($createid == required_param("createid", PARAM_INT)) {
                    $category->createdat = time();
                    $knowledgebases = $category->knowledgebases;
                    unset($category->knowledgebases);

                    $category->id = $DB->insert_record("local_helpdesk_category", $category);

                    foreach ($knowledgebases as $knowledgebase) {
                        $knowledgebase->categoryid = $category->id;
                        $knowledgebase->userid = $USER->id;
                        $knowledgebase->createdat = time();
                        $knowledgebase->updatedat = time();
                        $knowledgebase->description = str_replace("{moodlename}", $SITE->fullname, $knowledgebase->description);
                        $knowledgebase->description = str_replace("{moodleurl}", $CFG->wwwroot, $knowledgebase->description);

                        $DB->insert_record("local_helpdesk_knowledgebase", $knowledgebase);
                    }
                }
            }
        }

        redirect(new moodle_url("/local/helpdesk/knowledgebase.php"), get_string("categoryadded", "local_helpdesk"));
    }
}

if ($id) {
    $PAGE->navbar->add($knowledgebase->get_category()->get_name());
    $PAGE->navbar->add($knowledgebase->get_title());

    echo $OUTPUT->header();

    $templatecontext = [
        "has_manage" => $hasknowledgebasemanage,
        "has_delete" => has_capability("local/helpdesk:knowledgebase_delete", $context),
        "id" => $knowledgebase->get_id(),
        "title" => $knowledgebase->get_title(),
        "category_name" => $knowledgebase->get_category()->get_name(),
        "content" => $knowledgebase->get_description(),
    ];
    echo $OUTPUT->render_from_template("local_helpdesk/knowledgebase_view", $templatecontext);
    echo $OUTPUT->footer();
} else {
    echo $OUTPUT->header();

    $templatecontext = [
        "categorys" => [],
        "has_manage" => $hasknowledgebasemanage,
    ];

    $categoryid = optional_param("cat", false, PARAM_INT);
    if ($categoryid) {
        $categorys = category::get_all(null, ["id" => $categoryid], "name ASC");
    } else {
        $categorys = category::get_all(null, [], "name ASC");
    }
    /** @var category $category */
    foreach ($categorys as $category) {
        $knowledgebases = knowledgebase::get_all(null, ["categoryid" => $category->get_id()], "title ASC");
        if ($knowledgebases || $hasknowledgebasemanage) {
            $cat = [
                "name" => $category->get_name(),
                "categoryid" => $category->get_id(),
                "knowledgebases" => [],
            ];
            /** @var knowledgebase $knowledgebase */
            foreach ($knowledgebases as $knowledgebase) {
                $cat["knowledgebases"][] = [
                    "id" => $knowledgebase->get_id(),
                    "title" => $knowledgebase->get_title(),
                ];
            }
            $templatecontext["categorys"][] = $cat;
        }
    }

    $path = __DIR__ . "/db/knowledgebases/{$CFG->lang}.json";
    if (file_exists($path)) {
        $categorys = json_decode(file_get_contents($path));

        $templatecontext["sugestion"] = [];

        /** @var object $category */
        foreach ($categorys as $createid => $category) {
            $cat = $DB->get_record("local_helpdesk_category", ["name" => $category->name]);
            if (!$cat) {
                $category->createid = $createid;

                /** @var object $knowledgebase */
                foreach ($category->knowledgebases as &$knowledgebase) {
                    $knowledgebase->description = str_replace("{moodlename}", $SITE->fullname, $knowledgebase->description);
                    $knowledgebase->description = str_replace("{moodleurl}", $CFG->wwwroot, $knowledgebase->description);
                }

                $templatecontext["sugestion"][] = $category;
            }
        }

        $templatecontext["has_sugestion"] = count($templatecontext["sugestion"]);
    }

    echo $OUTPUT->render_from_template("local_helpdesk/knowledgebase", $templatecontext);

    echo $OUTPUT->footer();
}
