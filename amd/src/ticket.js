// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * ticket file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", "core/ajax", "core/notification", "jqueryui"], function($, Ajax, Notification, ui) {
    return {
        init: function(idkey) {
            $("#profile-tabs").show(300).tabs();
            $("#area-resonse").show(300);

            $("#response-message-open").click(function() {
                $("#response-message-area").hide(300);
                $(".response-message").show(300);
            });

            $("#id_buttonar_resolvedbutton").removeClass("btn-primary").addClass("btn-info");
            $("#id_buttonar_closebutton").removeClass("btn-primary").addClass("btn-danger");

            $("#changue_status,#changue_priority,#changue_category").on("change", function() {
                var value = $(this).val();

                Ajax.call([{
                    methodname: "local_helpdesk_ticket_column",
                    args: {
                        idkey: idkey,
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
    };
});
