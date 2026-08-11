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
 * filter_user.js
 *
 * @package   local_helpdesk
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/modal_factory"], function($, ModalFactory) {
    /**
     * Renders the rows returned by the Dashboard 3.x users endpoint.
     *
     * @param {jQuery} tbody Table body.
     * @param {Array} users Users returned by the endpoint.
     */
    function renderUsers(tbody, users) {
        tbody.empty();

        users.forEach(function(user) {
            $("<tr>")
                .data("user", user)
                .append($("<td>").text(user.id))
                .append($("<td>").text(user.name))
                .append($("<td>").text(user.username))
                .append($("<td>").text(user.email))
                .appendTo(tbody);
        });
    }

    /**
     * Loads matching users from the Dashboard 3.x search endpoint.
     *
     * @param {String} url Endpoint URL.
     * @param {String} sesskey Moodle session key.
     * @param {String} query Search text.
     * @param {jQuery} tbody Table body.
     */
    function searchUsers(url, sesskey, query, tbody) {
        if (query.trim().length < 2) {
            tbody.empty();
            return;
        }

        $.post(url, {
            q: query,
            sesskey: sesskey
        }).done(function(response) {
            renderUsers(tbody, response.users || []);
        }).fail(function() {
            tbody.empty();
        });
    }

    return {
        /**
         * Initializes the Helpdesk user picker.
         */
        init: function() {
            var chartUser = $("#chart-user-button-open");
            chartUser.show();

            chartUser.find(".badge").on("click", function() {
                chartUser.find(".badge").hide();
                $("[name=find_user]").val(0);
                chartUser.find(".select").text(chartUser.attr("data-defaultfullname"));
            });

            chartUser.find(".select").on("click", function() {
                if (window.data_user_block_select && window.data_user_block_select !== "wait") {
                    window.data_user_block_select.show();
                    return;
                }

                window.data_user_block_select = "wait";

                var source = $("#chart-user-datatable-select");
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

                    window.data_user_block_select = modal;
                    modal.show();
                    modal.root.find(".modal-dialog").addClass("modal-xl kopere-dashboard-modal");

                    var input = modal.root.find(".user-search");
                    var tbody = modal.root.find("#datatable_user_select tbody");
                    var timer = null;

                    input.on("input", function() {
                        clearTimeout(timer);
                        var query = $(this).val();
                        timer = setTimeout(function() {
                            searchUsers(url, sesskey, query, tbody);
                        }, 250);
                    });

                    tbody.on("click", "tr", function() {
                        var user = $(this).data("user");
                        if (!user) {
                            return;
                        }

                        chartUser.find(".select").text(user.name);
                        $("[name=find_user]").val(user.id);
                        chartUser.find(".badge").show();
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
