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
 * filter_course.js
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/modal_factory"], function($, ModalFactory) {
    /**
     * Renders courses returned by the Dashboard 3.x endpoint.
     *
     * @param {jQuery} tbody Table body.
     * @param {Array} courses Courses returned by the endpoint.
     */
    function renderCourses(tbody, courses) {
        tbody.empty();

        courses.forEach(function(course) {
            $("<tr>")
                .data("course", course)
                .append($("<td>").text(course.id))
                .append($("<td>").text(course.fullname))
                .append($("<td>").text(course.shortname))
                .append($("<td>").text(course.category))
                .appendTo(tbody);
        });
    }

    /**
     * Loads matching courses from the Dashboard 3.x search endpoint.
     *
     * @param {String} url Endpoint URL.
     * @param {String} sesskey Moodle session key.
     * @param {String} query Search text.
     * @param {jQuery} tbody Table body.
     */
    function searchCourses(url, sesskey, query, tbody) {
        if (query.trim().length < 2) {
            tbody.empty();
            return;
        }

        $.post(url, {
            q: query,
            sesskey: sesskey
        }).done(function(response) {
            renderCourses(tbody, response.courses || []);
        }).fail(function() {
            tbody.empty();
        });
    }

    return {
        /**
         * Initializes the Helpdesk course picker.
         */
        init: function() {
            var modalInstance = null;
            var chartCourse = $("#chart-course-button-open");
            chartCourse.show();

            chartCourse.find(".badge").on("click", function() {
                chartCourse.find(".badge").hide();
                $("[name=courseid]").val(0);
                chartCourse.find(".select").text(chartCourse.attr("data-defaultfullname"));
            });

            chartCourse.find(".select").on("click", function() {
                if (modalInstance) {
                    modalInstance.show();
                    return;
                }

                var source = $("#chart-course-datatable-select");
                var url = source.attr("data-urlajax");
                var sesskey = source.attr("data-sesskey");

                ModalFactory.create({
                    type: ModalFactory.types.DEFAULT,
                    title: source.attr("title"),
                    body: source.html()
                }).then(function(modal) {
                    if (!modal.root) {
                        modal.root = modal._root;
                    }

                    modalInstance = modal;
                    modal.show();
                    modal.root.find(".modal-dialog").addClass("modal-xl kopere-dashboard-modal");

                    var input = modal.root.find(".course-search");
                    var tbody = modal.root.find("#datatable_course_select tbody");
                    var timer = null;

                    input.on("input", function() {
                        clearTimeout(timer);
                        var query = $(this).val();
                        timer = setTimeout(function() {
                            searchCourses(url, sesskey, query, tbody);
                        }, 250);
                    });

                    tbody.on("click", "tr", function() {
                        var course = $(this).data("course");
                        if (!course) {
                            return;
                        }

                        chartCourse.find(".select").text(course.fullname);
                        $("[name=courseid]").val(course.id);
                        chartCourse.find(".badge").show();
                        modal.hide();
                    });

                    setTimeout(function() {
                        input.trigger("focus");
                    }, 100);
                });
            });
        }
    };
});
