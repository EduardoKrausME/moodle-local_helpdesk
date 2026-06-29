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

$string['addcategory'] = 'Aggiungi Nuova Categoria';
$string['addticket'] = 'Aggiungi Ticket';
$string['attachment'] = 'Allegati';
$string['avg_closing_time'] = 'Media Chiuso';
$string['avg_first_response_time'] = 'Media risposta';
$string['cancel'] = 'Annulla';
$string['categories'] = 'Categorie Ticket';
$string['categorieslist'] = 'Elenco Categorie';
$string['category'] = 'Categoria';
$string['category_role_description'] = 'Ruolo specifico per controllare l’accesso degli utenti alla gestione dei ticket.';
$string['category_users_all'] = 'Tutti gli utenti Moodle';
$string['category_users_info'] = 'Salva prima la categoria prima di modificare gli utenti.';
$string['category_users_responses'] = 'Utenti che rispondono a questa categoria';
$string['category_users_title'] = 'Definisce gli utenti autorizzati a rispondere e che riceveranno un’email sui nuovi ticket';
$string['categoryadded'] = 'Categoria aggiunta con successo';
$string['categorycreated'] = 'Categoria creata con successo';
$string['categorydeleted'] = 'Categoria eliminata con successo';
$string['categorydescription'] = 'Categoria Descrizione';
$string['categoryname'] = 'Categoria Nome';
$string['categorynotfound'] = 'Categoria non trovata';
$string['categoryupdated'] = 'Categoria aggiornata con successo';
$string['comments'] = 'Commenti';
$string['confirmdelete'] = 'Sei sicuro di voler eliminare questa categoria?';
$string['confirmdeletecategory'] = 'Sei sicuro di voler eliminare questa categoria?';
$string['confirmdeleteticket'] = 'Sei sicuro di voler eliminare definitivamente il ticket "{$a}"? Anche tutte le risposte e gli allegati relativi a questo ticket saranno eliminati.';
$string['createcategory'] = 'Crea Categoria';
$string['createcategoryfirst'] = 'Crea Categoria';
$string['createticket'] = 'Crea Ticket';
$string['deletecategory'] = 'Elimina Categoria';
$string['deletecategoryusedata'] = 'Questa categoria contiene dati';
$string['deletesuccesscategory'] = 'Categoria eliminata con successo';
$string['deletesuccessticket'] = 'Ticket eliminata con successo.';
$string['deleteticket'] = 'Elimina Ticket';
$string['description'] = 'Descrizione';
$string['editcategory'] = 'Modifica Categoria';
$string['editticket'] = 'Modifica Ticket';
$string['error:emptyname'] = 'Il nome della categoria non può essere vuoto';
$string['erroraddcategory'] = 'Errore durante Aggiungi Categoria';
$string['errordeletecategory'] = 'Errore durante Elimina Categoria';
$string['errorinsertingcategory'] = 'Errore durante Aggiungi Categoria';
$string['errorinsertingticket'] = 'Errore durante Ticket';
$string['errorupdatecategory'] = 'Errore durante Aggiorna Categoria';
$string['errorupdatingcategory'] = 'Errore durante Aggiorna Categoria';
$string['errorupdatingticket'] = 'Errore durante Aggiorna Ticket';
$string['exportstatusfilter'] = 'Esporta Stato';
$string['exporttickets'] = 'Esporta Ticket';
$string['findcourse'] = 'Seleziona Corso';
$string['findticket'] = 'Cerca Oggetto testo';
$string['finduser'] = 'Seleziona Utente';
$string['geniai_btn_knowledgebase_create'] = 'Crea una base di conoscenza con IA';
$string['geniai_btn_response_create'] = 'Crea una risposta con IA';
$string['geniai_create_knowledgebase_desc'] = 'Descrivi in dettaglio il contenuto che desideri generare. GeniAI userà queste informazioni per creare un testo accurato e pertinente per la base di conoscenza.';
$string['geniai_create_knowledgebase_message'] = 'Crea un messaggio basato sul testo sopra.';
$string['geniai_create_response_desc'] = 'Descrivi ciò che desideri generare. GeniAI userà tutte le conversazioni come base per creare una risposta, ma devi definire quali dati vuoi scrivere.';
$string['geniai_create_response_message'] = 'Crea un messaggio basato sul testo sopra.';
$string['geniai_knowledgebase_prompt'] = 'Sei un chatbot specializzato in basi di conoscenza per Moodle. Genera contenuti chiari, strutturati e professionali in prima persona.\\n\\nOra crea un articolo su:\\nNome Moodle: "{$a->site_fullname}"\\nURL Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nRestituisci solo nella lingua "{$a->userlang}", senza titoli, e solo in MARKDOWN.';
$string['geniai_like_message'] = 'Ti è piaciuto il messaggio? Clicca qui per chiudere e inviarlo all’Editor.';
$string['geniai_missing'] = 'Installa e configura il plugin <a href="{$a}" target="_blank">GenIA</a> per abilitare le risposte basate su IA.';
$string['geniai_ticket_prompt_1'] = 'Sei un chatbot che suggerisce risposte chiare, cordiali e in prima persona ai ticket Moodle.\\n\\nDomanda dell’utente {$a->userfullname}: "{$a->userticket}"\\n\\nCrea risposta usando le istruzioni fornite dal supporto:\\n"{$a->message}"\\n\\nRestituisci solo nella lingua "{$a->userlang}" e solo in MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Sei un chatbot che suggerisce risposte chiare, cordiali e in prima persona ai ticket Moodle.\\n\\nCrea risposta:\\n\\nDomanda dell’utente {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Sei un chatbot che suggerisce risposte chiare, cordiali e in prima persona ai ticket Moodle.\\n\\nCrea risposta sulla base di questa cronologia usando le istruzioni fornite dal supporto:\\n"{$a->message}"\\n\\nRestituisci solo nella lingua "{$a->userlang}" e solo in MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Sei un chatbot che suggerisce risposte chiare, cordiali e in prima persona ai ticket Moodle.\\n\\nCrea risposta sulla base di questa cronologia.\\n\\nRestituisci solo nella lingua "{$a->userlang}" e solo in MARKDOWN.';
$string['geniai_title'] = 'Intelligenza artificiale';
$string['helpdesk:categorydelete'] = 'Consente di eliminare categorie.';
$string['helpdesk:categorymanage'] = 'Consente di gestire le categorie dell’Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Eliminare articoli nella base di conoscenza.';
$string['helpdesk:knowledgebase_manage'] = 'Gestire articoli nella base di conoscenza.';
$string['helpdesk:knowledgebase_view'] = 'Visualizzare articoli nella base di conoscenza.';
$string['helpdesk:ticketmanage'] = 'Consente di gestire l’Helpdesk, incluse le risposte e la chiusura dei ticket.';
$string['helpdesk:view'] = 'Consente di visualizzare i ticket dell’Helpdesk e crearli per sé.';
$string['helpdesk_manage_users'] = 'Visualizza gli utenti con autorizzazione a gestire questa categoria di ruolo';
$string['index_top_all_open_tickets'] = 'All Aperto Ticket';
$string['index_top_completed_tickets'] = 'Completati Ticket';
$string['index_top_unanswered_tickets'] = 'Senza risposta Ticket';
$string['index_top_urgent_tickets'] = 'Urgente Ticket';
$string['integracaoroot'] = 'Integrazione';
$string['invalidpriority'] = 'Priorità selezionata non valida.';
$string['knowledgebase_addnew'] = 'Aggiungi Nuova Base di conoscenza';
$string['knowledgebase_articlenotfound'] = 'Base di conoscenza non trovata';
$string['knowledgebase_category'] = 'Categoria';
$string['knowledgebase_create'] = 'Crea Base di conoscenza';
$string['knowledgebase_delete'] = 'Elimina Base di conoscenza';
$string['knowledgebase_delete_confirm'] = 'Sei sicuro di voler eliminare la base di conoscenza <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'Base di conoscenza eliminata con successo';
$string['knowledgebase_description'] = 'Contenuto della base di conoscenza';
$string['knowledgebase_edit'] = 'Modifica Base di conoscenza';
$string['knowledgebase_name'] = 'Base di conoscenza';
$string['knowledgebase_prompt_short'] = 'Prompt troppo breve';
$string['knowledgebase_title'] = 'Titolo della conoscenza';
$string['knowledgebase_update'] = 'Aggiorna';
$string['lognewcategory'] = 'Categoria changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Priorità changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Stato changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Nessuna modifica effettuata!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Gentile {[to.fullname]},</p>\\n<p>{[from.fullname]} Crea Ticket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Cordiali saluti,<br>\\nTeam di supporto</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Gentile {[to.fullname]},</p>\\n<p>Team di supporto: Aggiorna.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Visualizza Ticket #{[event.tiketidlink]}.</p>\\n<p>Cordiali saluti,<br>\\nTeam di supporto</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Gentile {[to.fullname]},</p>\\n<p>Team di supporto: Messaggio</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Visualizza Ticket #{[event.tiketidlink]}.</p>\\n<p>Cordiali saluti,<br>\\nTeam di supporto</p>';
$string['markticketasclosed'] = 'Ticket Chiuso';
$string['markticketasresolved'] = 'Ticket Risolto';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Priorità';
$string['priority_high'] = 'Alta';
$string['priority_low'] = 'Bassa';
$string['priority_medium'] = 'Media';
$string['priority_urgent'] = 'Urgente';
$string['privacy:metadata:category_user_userid'] = 'ID Utente - Categoria.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Utenti - Categorie Ticket.';
$string['privacy:metadata:local_helpdesk_response'] = 'risposte - Ticket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Ticket - Utente, Categoria, Stato.';
$string['privacy:metadata:response_userid'] = 'ID Utente - risposta Ticket.';
$string['privacy:metadata:ticket_userid'] = 'ID Utente - Ticket.';
$string['replytoticket'] = 'risposta Ticket';
$string['report_assignment_reports_page_description'] = 'Report: Ticket / Utenti.';
$string['report_assignment_reports_page_title'] = 'Report - assegnazione';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Ticket Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Categorie Urgente';
$string['report_category_reports_page_description'] = 'Report: Categorie Ticket.';
$string['report_category_reports_page_title'] = 'Report Categorie';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Media risposta';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Totale Ticket';
$string['report_general_reports_page_title'] = 'Report';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Ticket Crea Periodo';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Data di creazione';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Totale Ticket';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Ticket Risolto Periodo';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Periodo';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Totale Risolto Ticket';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Media risposte';
$string['report_response_reports_page_description'] = 'Report: risposte Ticket.';
$string['report_response_reports_page_title'] = 'Report risposte';
$string['report_status_priority_reports_page_description'] = 'Report: Stato Priorità Ticket.';
$string['report_status_priority_reports_page_title'] = 'Report Stato Priorità';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Priorità distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Ticket Stato';
$string['report_tickets_reports_page_description'] = 'Report: Ticket Aperto / Chiuso.';
$string['report_tickets_reports_page_title'] = 'Ticket';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Utente';
$string['report_user_reports_page_description'] = 'Report: Utenti Ticket.';
$string['report_user_reports_page_title'] = 'Report Utenti';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Utenti Ticket Aperto';
$string['savecategory'] = 'Salva Categoria';
$string['savechanges'] = 'Salva modifiche';
$string['setting_course'] = 'Mostra solo all’interno del corso';
$string['setting_knowledgebase_menu_description'] = 'Abilita questa opzione per mostrare il link alla base di conoscenza nel menu di navigazione.';
$string['setting_knowledgebase_menu_title'] = 'Display Base di conoscenza in Menu';
$string['setting_menu_description'] = 'Seleziona se mostrare il menu HelpDesk nel menu di sistema nella parte superiore di Moodle.';
$string['setting_menu_title'] = 'Mostra nel menu';
$string['setting_none'] = 'Non mostrare';
$string['setting_system'] = 'Mostra in tutto il sistema';
$string['status'] = 'Stato';
$string['status_all'] = 'Tutti Ticket';
$string['status_closed'] = 'Chiuso';
$string['status_open'] = 'Aperto';
$string['status_progress'] = 'In corso';
$string['status_resolved'] = 'Risolto';
$string['subject'] = 'Oggetto';
$string['ticketcategory'] = 'Ticket Categoria';
$string['ticketcategoryshort'] = 'Categoria';
$string['ticketclosed'] = 'Il ticket è chiuso.';
$string['ticketcreated'] = 'Ticket creata con successo';
$string['ticketcreatedat'] = 'Data di creazione';
$string['ticketdescription'] = 'Ticket Descrizione';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Messaggio';
$string['ticketnotfound'] = 'Ticket non trovata';
$string['ticketpriority'] = 'Ticket Priorità';
$string['ticketpriorityhigh'] = 'Alta';
$string['ticketprioritylow'] = 'Bassa';
$string['ticketprioritymedium'] = 'Media';
$string['ticketpriorityshort'] = 'Priorità';
$string['ticketpriorityurgent'] = 'Urgente';
$string['ticketresponse'] = 'risposta Ticket';
$string['ticketresponseandclose'] = 'risposta Ticket Chiuso';
$string['ticketresponseandresolved'] = 'risposta Ticket Risolto';
$string['tickets'] = 'Tutti Ticket';
$string['ticketslist'] = 'Elenco Ticket';
$string['ticketstatus'] = 'Ticket Stato';
$string['ticketstatusclosed'] = 'Chiuso';
$string['ticketstatusinprogress'] = 'In corso';
$string['ticketstatusnotclosed'] = 'Tutti except Chiuso';
$string['ticketstatusopen'] = 'Aperto';
$string['ticketstatusresolved'] = 'Risolto';
$string['ticketstatusshort'] = 'Stato';
$string['ticketsubject'] = 'Ticket Oggetto';
$string['ticketupdated'] = 'Ticket aggiornata con successo';
$string['updatecategory'] = 'Aggiorna Categoria';
$string['userid'] = 'ID Utente';
$string['viewticket'] = 'Visualizza Ticket';
