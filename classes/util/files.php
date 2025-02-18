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
 * file files
 *
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_khelpdesk\util;

use context_system;
use moodle_url;

/**
 * Class files
 *
 * @package local_khelpdesk\model
 */
class files {
    /**
     * Function all
     *
     * @param string $filearea
     * @param int $itemid
     *
     * @return array
     * @throws \dml_exception
     */
    public static function all($filearea, $itemid) {
        global $DB;

        $context = context_system::instance();

        $returnfiles = [];
        $sql = "
            SELECT *
              FROM {files}
             WHERE component   = 'local_khelpdesk'
               AND filearea    = :filearea
               AND itemid      = :itemid
               AND filename LIKE '__%'";
        $files = $DB->get_records_sql($sql, ["filearea" => $filearea, "itemid" => $itemid]);
        foreach ($files as $file) {
            $path = implode("/", [
                $context->id,
                "local_khelpdesk",
                $filearea,
                $file->itemid,
                $file->filename,
            ]);
            $filemustache = [
                "fullurl" => moodle_url::make_file_url("/pluginfile.php", "/{$path}", false)->out(),
                "filename" => $file->filename,
                "mimetype" => $file->mimetype,
            ];
            $returnfiles[] = $filemustache;
        }

        return $returnfiles;
    }
}
