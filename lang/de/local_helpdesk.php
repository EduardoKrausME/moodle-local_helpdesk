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
 * Language strings for local_helpdesk.
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addcategory'] = 'Hinzufügen Neue Kategorie';
$string['addticket'] = 'Hinzufügen Ticket';
$string['attachment'] = 'Anhänge';
$string['avg_closing_time'] = 'Durchschnittliche Geschlossen';
$string['avg_first_response_time'] = 'Durchschnittliche Antwort';
$string['cancel'] = 'Abbrechen';
$string['categories'] = 'Kategorien Tickets';
$string['categorieslist'] = 'Liste Kategorien';
$string['category'] = 'Kategorie';
$string['category_role_description'] = 'Spezifische Rolle zur Steuerung des Nutzerzugriffs auf die Ticketverwaltung.';
$string['category_users_all'] = 'Alle Moodle-Nutzer';
$string['category_users_info'] = 'Speichern Sie zuerst die Kategorie, bevor Sie Nutzer bearbeiten.';
$string['category_users_responses'] = 'Nutzer, die auf diese Kategorie antworten';
$string['category_users_title'] = 'Legt fest, welche Nutzer antworten dürfen und eine E-Mail über neue Tickets erhalten';
$string['categoryadded'] = 'Kategorie erfolgreich hinzugefügt';
$string['categorycreated'] = 'Kategorie erfolgreich erstellt';
$string['categorydeleted'] = 'Kategorie erfolgreich gelöscht';
$string['categorydescription'] = 'Kategorie Beschreibung';
$string['categoryname'] = 'Kategorie Name';
$string['categorynotfound'] = 'Kategorie nicht gefunden';
$string['categoryupdated'] = 'Kategorie erfolgreich aktualisiert';
$string['comments'] = 'Kommentare';
$string['confirmdelete'] = 'Möchten Sie diese Kategorie wirklich löschen?';
$string['confirmdeletecategory'] = 'Möchten Sie diese Kategorie wirklich löschen?';
$string['confirmdeleteticket'] = 'Möchten Sie das Ticket "{$a}" wirklich dauerhaft löschen? Alle Antworten und Anhänge zu diesem Ticket werden ebenfalls gelöscht.';
$string['createcategory'] = 'Erstellen Kategorie';
$string['createcategoryfirst'] = 'Erstellen Kategorie';
$string['createticket'] = 'Erstellen Ticket';
$string['deletecategory'] = 'Löschen Kategorie';
$string['deletecategoryusedata'] = 'Diese Kategorie enthält Daten';
$string['deletesuccesscategory'] = 'Kategorie erfolgreich gelöscht';
$string['deletesuccessticket'] = 'Ticket erfolgreich gelöscht.';
$string['deleteticket'] = 'Löschen Ticket';
$string['description'] = 'Beschreibung';
$string['editcategory'] = 'Bearbeiten Kategorie';
$string['editticket'] = 'Bearbeiten Ticket';
$string['error:emptyname'] = 'Der Kategoriename darf nicht leer sein';
$string['erroraddcategory'] = 'Fehler beim Hinzufügen Kategorie';
$string['errordeletecategory'] = 'Fehler beim Löschen Kategorie';
$string['errorinsertingcategory'] = 'Fehler beim Hinzufügen Kategorie';
$string['errorinsertingticket'] = 'Fehler beim Ticket';
$string['errorupdatecategory'] = 'Fehler beim Aktualisieren Kategorie';
$string['errorupdatingcategory'] = 'Fehler beim Aktualisieren Kategorie';
$string['errorupdatingticket'] = 'Fehler beim Aktualisieren Ticket';
$string['exportstatusfilter'] = 'Exportieren Status';
$string['exporttickets'] = 'Exportieren Tickets';
$string['findcourse'] = 'Auswählen Kurs';
$string['findticket'] = 'Suchen Betreff Text';
$string['finduser'] = 'Auswählen Nutzer';
$string['geniai_btn_knowledgebase_create'] = 'Wissensdatenbank mit KI erstellen';
$string['geniai_btn_response_create'] = 'Antwort mit KI erstellen';
$string['geniai_create_knowledgebase_desc'] = 'Beschreiben Sie detailliert den Inhalt, den Sie generieren möchten. GeniAI verwendet diese Informationen, um einen präzisen und relevanten Text für die Wissensdatenbank zu erstellen.';
$string['geniai_create_knowledgebase_message'] = 'Erstelle eine Nachricht auf Basis des obigen Textes.';
$string['geniai_create_response_desc'] = 'Beschreiben Sie, was Sie generieren möchten. GeniAI nutzt alle Gespräche als Grundlage für eine Antwort, Sie müssen jedoch angeben, welche Daten geschrieben werden sollen.';
$string['geniai_create_response_message'] = 'Erstelle eine Nachricht auf Basis des obigen Textes.';
$string['geniai_knowledgebase_prompt'] = 'Du bist ein Chatbot für Moodle-Wissensdatenbanken. Erstelle klare, gut strukturierte und professionelle Inhalte in der Ich-Form.\\n\\nErstelle nun einen Wissensdatenbankartikel zu:\\nMoodle-Name: "{$a->site_fullname}"\\nMoodle-URL: "{$a->site_url}"\\n"{$a->message}"\\n\\nGib die Antwort nur in "{$a->userlang}", ohne Titel und nur als MARKDOWN zurück.';
$string['geniai_like_message'] = 'Gefällt Ihnen die Nachricht? Klicken Sie hier, um zu schließen und sie an den Editor zu senden.';
$string['geniai_missing'] = 'Installieren und konfigurieren Sie das Plugin <a href="{$a}" target="_blank">GenIA</a>, um KI-gestützte Antworten zu aktivieren.';
$string['geniai_ticket_prompt_1'] = 'Du bist ein Chatbot, der klare, freundliche Antworten auf Moodle-Tickets in der Ich-Form vorschlägt.\\n\\nFrage des Nutzers {$a->userfullname}: "{$a->userticket}"\\n\\nErstellen Antwort mit den vom Support bereitgestellten Anweisungen:\\n"{$a->message}"\\n\\nGib die Antwort nur in der Sprache "{$a->userlang}" und ausschließlich in MARKDOWN zurück.';
$string['geniai_ticket_prompt_2'] = 'Du bist ein Chatbot, der klare, freundliche Antworten auf Moodle-Tickets in der Ich-Form vorschlägt.\\n\\nErstellen Antwort:\\n\\nFrage des Nutzers {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Du bist ein Chatbot, der klare, freundliche Antworten auf Moodle-Tickets in der Ich-Form vorschlägt.\\n\\nErstellen Antwort auf Grundlage dieses Verlaufs mit den vom Support bereitgestellten Anweisungen:\\n"{$a->message}"\\n\\nGib die Antwort nur in der Sprache "{$a->userlang}" und ausschließlich in MARKDOWN zurück.';
$string['geniai_ticket_prompt_4'] = 'Du bist ein Chatbot, der klare, freundliche Antworten auf Moodle-Tickets in der Ich-Form vorschlägt.\\n\\nErstellen Antwort auf Grundlage dieses Verlaufs.\\n\\nGib die Antwort nur in der Sprache "{$a->userlang}" und ausschließlich in MARKDOWN zurück.';
$string['geniai_title'] = 'Künstliche Intelligenz';
$string['helpdesk:categorydelete'] = 'Erlaubt das Löschen von Kategorien.';
$string['helpdesk:categorymanage'] = 'Erlaubt das Verwalten der Helpdesk-Kategorien.';
$string['helpdesk:knowledgebase_delete'] = 'Artikel in der Wissensdatenbank löschen.';
$string['helpdesk:knowledgebase_manage'] = 'Artikel in der Wissensdatenbank verwalten.';
$string['helpdesk:knowledgebase_view'] = 'Artikel in der Wissensdatenbank anzeigen.';
$string['helpdesk:ticketmanage'] = 'Erlaubt die Verwaltung des Helpdesks, einschließlich Antworten und Schließen von Tickets.';
$string['helpdesk:view'] = 'Erlaubt das Anzeigen von Helpdesk-Tickets und das Erstellen eigener Tickets.';
$string['helpdesk_manage_users'] = 'Nutzer mit Berechtigung zur Verwaltung dieser Rollenkategorie anzeigen';
$string['index_top_all_open_tickets'] = 'All Offen Tickets';
$string['index_top_completed_tickets'] = 'Abgeschlossen Tickets';
$string['index_top_unanswered_tickets'] = 'Unbeantwortet Tickets';
$string['index_top_urgent_tickets'] = 'Dringend Tickets';
$string['integracaoroot'] = 'Integration';
$string['invalidpriority'] = 'Ungültige Priorität ausgewählt.';
$string['knowledgebase_addnew'] = 'Hinzufügen Neue Wissensdatenbank';
$string['knowledgebase_articlenotfound'] = 'Wissensdatenbank nicht gefunden';
$string['knowledgebase_category'] = 'Kategorie';
$string['knowledgebase_create'] = 'Erstellen Wissensdatenbank';
$string['knowledgebase_delete'] = 'Löschen Wissensdatenbank';
$string['knowledgebase_delete_confirm'] = 'Möchten Sie die Wissensdatenbank <strong>{$a}</strong> wirklich löschen?';
$string['knowledgebase_delete_success'] = 'Wissensdatenbank erfolgreich gelöscht';
$string['knowledgebase_description'] = 'Wissensinhalte';
$string['knowledgebase_edit'] = 'Bearbeiten Wissensdatenbank';
$string['knowledgebase_name'] = 'Wissensdatenbank';
$string['knowledgebase_prompt_short'] = 'Prompt zu kurz';
$string['knowledgebase_title'] = 'Wissenstitel';
$string['knowledgebase_update'] = 'Aktualisieren';
$string['lognewcategory'] = 'Kategorie changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Priorität changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Status changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Keine Änderungen vorgenommen!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Guten Tag {[to.fullname]},</p>\\n<p>{[from.fullname]} Erstellen Ticket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Mit freundlichen Grüßen,<br>\\nSupport-Team</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Guten Tag {[to.fullname]},</p>\\n<p>Support-Team: Aktualisieren.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Anzeigen Ticket #{[event.tiketidlink]}.</p>\\n<p>Mit freundlichen Grüßen,<br>\\nSupport-Team</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Guten Tag {[to.fullname]},</p>\\n<p>Support-Team: Nachricht</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Anzeigen Ticket #{[event.tiketidlink]}.</p>\\n<p>Mit freundlichen Grüßen,<br>\\nSupport-Team</p>';
$string['markticketasclosed'] = 'Ticket Geschlossen';
$string['markticketasresolved'] = 'Ticket Gelöst';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Priorität';
$string['priority_high'] = 'Hoch';
$string['priority_low'] = 'Niedrig';
$string['priority_medium'] = 'Mittel';
$string['priority_urgent'] = 'Dringend';
$string['privacy:metadata:category_user_userid'] = 'ID Nutzer - Kategorie.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Nutzer - Kategorien Ticket.';
$string['privacy:metadata:local_helpdesk_response'] = 'Antworten - Ticket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Tickets - Nutzer, Kategorie, Status.';
$string['privacy:metadata:response_userid'] = 'ID Nutzer - Antwort Ticket.';
$string['privacy:metadata:ticket_userid'] = 'ID Nutzer - Ticket.';
$string['replytoticket'] = 'Antwort Ticket';
$string['report_assignment_reports_page_description'] = 'Bericht: Tickets / Nutzer.';
$string['report_assignment_reports_page_title'] = 'Berichte - Zuweisung';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Kategorien Dringend';
$string['report_category_reports_page_description'] = 'Bericht: Kategorien Ticket.';
$string['report_category_reports_page_title'] = 'Berichte Kategorien';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Durchschnittliche Antwort';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Gesamt Tickets';
$string['report_general_reports_page_title'] = 'Berichte';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Erstellen Zeitraum';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Erstellungsdatum';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Gesamt Tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Gelöst Zeitraum';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Zeitraum';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Gesamt Gelöst Tickets';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Durchschnittliche Antworten';
$string['report_response_reports_page_description'] = 'Bericht: Antworten Ticket.';
$string['report_response_reports_page_title'] = 'Berichte Antworten';
$string['report_status_priority_reports_page_description'] = 'Bericht: Status Priorität Ticket.';
$string['report_status_priority_reports_page_title'] = 'Berichte Status Priorität';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Priorität distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets Status';
$string['report_tickets_reports_page_description'] = 'Bericht: Tickets Offen / Geschlossen.';
$string['report_tickets_reports_page_title'] = 'Tickets';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Nutzer';
$string['report_user_reports_page_description'] = 'Bericht: Nutzer Tickets.';
$string['report_user_reports_page_title'] = 'Berichte Nutzer';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Nutzer Tickets Offen';
$string['savecategory'] = 'Speichern Kategorie';
$string['savechanges'] = 'Speichern Änderungen';
$string['setting_course'] = 'Nur innerhalb des Kurses anzeigen';
$string['setting_knowledgebase_menu_description'] = 'Aktivieren Sie diese Option, um den Link zur Wissensdatenbank im Navigationsmenü anzuzeigen.';
$string['setting_knowledgebase_menu_title'] = 'Display Wissensdatenbank in Menu';
$string['setting_menu_description'] = 'Wählen Sie, ob das HelpDesk-Menü im Systemmenü oben in Moodle angezeigt werden soll.';
$string['setting_menu_title'] = 'Im Menü anzeigen';
$string['setting_none'] = 'Nicht anzeigen';
$string['setting_system'] = 'Im gesamten System anzeigen';
$string['status'] = 'Status';
$string['status_all'] = 'Alle Tickets';
$string['status_closed'] = 'Geschlossen';
$string['status_open'] = 'Offen';
$string['status_progress'] = 'In Bearbeitung';
$string['status_resolved'] = 'Gelöst';
$string['subject'] = 'Betreff';
$string['ticketcategory'] = 'Ticket Kategorie';
$string['ticketcategoryshort'] = 'Kategorie';
$string['ticketclosed'] = 'Das Ticket ist geschlossen.';
$string['ticketcreated'] = 'Ticket erfolgreich erstellt';
$string['ticketcreatedat'] = 'Erstellungsdatum';
$string['ticketdescription'] = 'Ticket Beschreibung';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Nachricht';
$string['ticketnotfound'] = 'Ticket nicht gefunden';
$string['ticketpriority'] = 'Ticket Priorität';
$string['ticketpriorityhigh'] = 'Hoch';
$string['ticketprioritylow'] = 'Niedrig';
$string['ticketprioritymedium'] = 'Mittel';
$string['ticketpriorityshort'] = 'Priorität';
$string['ticketpriorityurgent'] = 'Dringend';
$string['ticketresponse'] = 'Antwort Ticket';
$string['ticketresponseandclose'] = 'Antwort Ticket Geschlossen';
$string['ticketresponseandresolved'] = 'Antwort Ticket Gelöst';
$string['tickets'] = 'Alle Tickets';
$string['ticketslist'] = 'Liste Tickets';
$string['ticketstatus'] = 'Ticket Status';
$string['ticketstatusclosed'] = 'Geschlossen';
$string['ticketstatusinprogress'] = 'In Bearbeitung';
$string['ticketstatusnotclosed'] = 'Alle except Geschlossen';
$string['ticketstatusopen'] = 'Offen';
$string['ticketstatusresolved'] = 'Gelöst';
$string['ticketstatusshort'] = 'Status';
$string['ticketsubject'] = 'Ticket Betreff';
$string['ticketupdated'] = 'Ticket erfolgreich aktualisiert';
$string['updatecategory'] = 'Aktualisieren Kategorie';
$string['userid'] = 'ID Nutzer';
$string['viewticket'] = 'Anzeigen Ticket';
