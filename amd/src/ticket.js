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
 * ticket file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/ajax", "core/notification", "jqueryui"], function($, Ajax, Notification, ui) {
    return {
        init: function() {
            $("#profile-tabs").tabs();

            $("#response-message-open").click(function() {
                $("#response-message-area").html("");
                $(".response-message").show(300);
                $(".response-message").appendTo("#response-message-area");
            });

            $("#response-message-resolved").click(function() {
                $("#response-message-area").hide(300);
                location.href = "?id={{idkey}}&newstatus=resolved";
            });
            $("#response-message-closed").click(function() {
                $("#response-message-area").hide(300);
                location.href = "?id={{idkey}}&newstatus=closed";
            });

            $("#id_buttonar_resolvedbutton").removeClass("btn-primary").addClass("btn-info");
            $("#id_buttonar_closebutton").removeClass("btn-primary").addClass("btn-danger");

            $("#changue_status,#changue_priority,#changue_category").on("change", function() {
                var value = $(this).val();

                Ajax.call([{
                    methodname: "local_helpdesk_ticket_column",
                    args: {
                        idkey: "{{{idkey}}}",
                        column: $(this).attr("data-column"),
                        value: value,
                    }
                }])[0].then(function(data) {
                    $("#local_helpdesk_ticket_column").show(200).html(data.status);
                    setTimeout(function() {
                        $("#local_helpdesk_ticket_column").show(200);
                    }, 2000);

                    return data;
                }).catch(Notification.exception);
            });
        }
    }
});
