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

use user_selector_base;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . "/user/selector/lib.php");

/**
 * Class category_existing_selector
 *
 * @package local_helpdesk\form
 */
class category_existing_selector extends user_selector_base {
    /** @var int */
    protected $categoryid;

    /**
     * category_existing_selector constructor.
     *
     * @param $name
     * @param $options
     */
    public function __construct($name, $options) {
        $this->categoryid = $options["categoryid"];
        $options["includecustomfields"] = true;
        parent::__construct($name, $options);
    }

    /**
     * Candidate users
     *
     * @param string $search
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function find_users($search) {
        global $DB;

        // By default wherecondition retrieves all users except the deleted, not confirmed and guest.
        list($wherecondition, $params) = $this->search_sql($search, "u");
        $params = array_merge($params, $this->userfieldsparams);

        $params["categoryid"] = $this->categoryid;

        $fields = "SELECT u.id, " . $this->userfieldsselects;
        $countfields = "SELECT COUNT(1)";

        $sql = "  FROM {user} u
                  JOIN {local_helpdesk_category_user} hcu ON ( hcu.userid = u.id AND hcu.categoryid = :categoryid )
                 {$this->userfieldsjoin}
                WHERE {$wherecondition}";

        list($sort, $sortparams) = users_order_by_sql("u", $search, $this->accesscontext, $this->userfieldsmappings);
        $order = " ORDER BY " . $sort;

        if (!$this->is_validating()) {
            $potentialmemberscount = $DB->count_records_sql($countfields . $sql, $params);
            if ($potentialmemberscount > $this->maxusersperpage) {
                return $this->too_many_results($search, $potentialmemberscount);
            }
        }

        $availableusers = $DB->get_records_sql($fields . $sql . $order, array_merge($params, $sortparams));

        if (empty($availableusers)) {
            return [];
        }

        if ($search) {
            $groupname = get_string("currentusersmatching", "cohort", $search);
        } else {
            $groupname = get_string("currentusers", "cohort");
        }

        return [$groupname => $availableusers];
    }

    /**
     * Function get_options
     *
     * @return array
     */
    protected function get_options() {
        $options = parent::get_options();
        $options["categoryid"] = $this->categoryid;
        return $options;
    }
}
