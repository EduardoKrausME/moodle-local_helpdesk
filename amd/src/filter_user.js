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
 * filter_user file
 *
 * @package   local_kbi
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/modal_factory", "local_kdashboard/dataTables_init"], function($, ModalFactory, dataTables_init) {
    return {
        init: function() {
            var data_user_block_select = false;

            var chartUser = $("#chart-user-button-open");
            chartUser.show();
            chartUser.find(".badge").click(function() {
                chartUser.find(".badge").hide();
                chartUser.find("input").val(0);

                console.log(chartUser.attr("data-defaultfullname"));
                chartUser.find(".select").html(chartUser.attr("data-defaultfullname"));
            });
            chartUser.find(".select").click(function() {
                if (data_user_block_select) {
                    data_user_block_select.show();
                } else {

                    ModalFactory.create({
                        type: ModalFactory.types.DEFAULT,
                        title: $("#chart-user-datatable-select").attr("title"),
                        body: $("#chart-user-datatable-select").html(),
                    }).then(function(modal) {
                        if (!modal.root) {
                            modal.root = modal._root;
                        }

                        data_user_block_select = modal;
                        data_user_block_select.show();
                        data_user_block_select.root.addClass("kopere-bi");
                        data_user_block_select.root.find(".modal-dialog")
                            .addClass("modal-xl").addClass("kopere-dashboard-modal");

                        var urlajax = $("#chart-user-datatable-select").attr("data-urlajax");

                        $("#chart-user-datatable-select").remove();

                        dataTables_init.init("datatable_user_select", {
                            autoWidth: false,
                            columns: [
                                {data: "id"},
                                {data: "fullname"},
                                {data: "username"},
                                {data: "email"},
                            ],
                            columnDefs: [
                                {
                                    render: "numberRenderer",
                                    targets: 0,
                                }
                            ],
                            export_title: false,
                            order: [[1, "asc"]],
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: urlajax,
                                type: "POST",
                                dataType: "json",
                            }
                        });

                        $("#datatable_user_select tbody").on("click", "tr", function() {
                            var data = window["datatable_user_select"].row(this).data();

                            $("#chart-user-button-open .select").html(data.fullname);
                            $("#chart-user-button-open input").val(data.id);

                            data_user_block_select.hide();
                            chartUser.find(".badge").show();
                        });
                    });
                }
            });
        }
    };
});
