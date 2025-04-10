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
 * reports files
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_helpdesk\util;

use dml_exception;
use local_kopere_bi\local\util\install_for_file;

/**
 * Class reports
 *
 * @package local_helpdesk\util
 */
class reports {
    /**
     * Function check_instaled
     *
     * @throws dml_exception
     */
    public static function check_instaled() {
        global $DB;

        if (!$DB->record_exists("local_kopere_bi_cat", ["refkey" => "local_helpdesk"])) {
            self::install();
        }
    }

    /**
     * Function install
     */
    public static function install() {
        global $CFG;

        // Install reports pages.
        $pagefiles = glob("{$CFG->dirroot}/local/helpdesk/db/files/page-*.json");
        foreach ($pagefiles as $pagefile) {
            try {
                install_for_file::page_file($pagefile);
            } catch (dml_exception $e) { // phpcs:disable
            }
        }
    }
}