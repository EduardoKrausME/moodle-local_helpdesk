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

namespace local_helpdesk\model;

/**
 * Class model_base
 *
 * @package local_helpdesk\model
 */
class model_base {
    /**
     * Function get_all
     *
     * @param string $table
     * @param string $class
     * @param array|string $wheres
     * @param array $params
     * @param string $order
     *
     * @return array
     * @throws \dml_exception
     */
    public static function get_all($table, $class, $wheres = null, $params = [], $order = null) {
        global $DB;

        $where = "";
        if (is_array($wheres)) {
            $where = "WHERE " . implode(" AND ", $wheres);
        } else if (is_string($wheres)) {
            $where = $wheres;
        } else if ($wheres == null && is_array($params)) {
            $wheres = [];
            foreach ($params as $key => $value) {
                if (is_int($key)) {
                    $wheres[] = $value;
                } else {
                    $wheres[] = "{$key} = :{$key}";
                }
            }
            if (isset($wheres[0])) {
                $where = "WHERE " . implode(" AND ", $wheres);
            }
        }

        $orderby = "";
        if (is_string($order)) {
            $orderby = "ORDER BY {$order}";
        }

        $sql = "
            SELECT *
              FROM {{$table}}
              {$where}
              {$orderby}";

        $rows = $DB->get_records_sql($sql, $params);
        foreach ($rows as $id => $row) {
            $rows[$id] = new $class($row);
        }

        return $rows;
    }
}
