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

$string['addcategory'] = 'Pridať Nová Kategória';
$string['addticket'] = 'Pridať Požiadavka';
$string['attachment'] = 'Prílohy';
$string['avg_closing_time'] = 'Priemer Zatvorená';
$string['avg_first_response_time'] = 'Priemer odpoveď';
$string['cancel'] = 'Zrušiť';
$string['categories'] = 'Kategórie Požiadavky';
$string['categorieslist'] = 'Zoznam Kategórie';
$string['category'] = 'Kategória';
$string['category_role_description'] = 'Špecifická rola na riadenie prístupu používateľov k správe požiadaviek.';
$string['category_users_all'] = 'Všetci používatelia Moodle';
$string['category_users_info'] = 'Najprv uložte kategóriu a potom upravujte používateľov.';
$string['category_users_responses'] = 'Používatelia, ktorí odpovedajú na túto kategóriu';
$string['category_users_title'] = 'Definuje používateľov s povolením odpovedať a prijímať e-maily o nových požiadavkách';
$string['categoryadded'] = 'Kategória úspešne pridaná';
$string['categorycreated'] = 'Kategória úspešne vytvorená';
$string['categorydeleted'] = 'Kategória úspešne odstránená';
$string['categorydescription'] = 'Kategória Popis';
$string['categoryname'] = 'Kategória Názov';
$string['categorynotfound'] = 'Kategória nenájdená';
$string['categoryupdated'] = 'Kategória úspešne aktualizovaná';
$string['comments'] = 'Komentáre';
$string['confirmdelete'] = 'Naozaj chcete odstrániť túto kategóriu?';
$string['confirmdeletecategory'] = 'Naozaj chcete odstrániť túto kategóriu?';
$string['confirmdeleteticket'] = 'Naozaj chcete natrvalo odstrániť požiadavku "{$a}"? Všetky odpovede a prílohy súvisiace s touto požiadavkou budú tiež odstránené.';
$string['createcategory'] = 'Vytvoriť Kategória';
$string['createcategoryfirst'] = 'Vytvoriť Kategória';
$string['createticket'] = 'Vytvoriť Požiadavka';
$string['deletecategory'] = 'Odstrániť Kategória';
$string['deletecategoryusedata'] = 'Táto kategória obsahuje údaje';
$string['deletesuccesscategory'] = 'Kategória úspešne odstránená';
$string['deletesuccessticket'] = 'Požiadavka úspešne odstránená.';
$string['deleteticket'] = 'Odstrániť Požiadavka';
$string['description'] = 'Popis';
$string['editcategory'] = 'Upraviť Kategória';
$string['editticket'] = 'Upraviť Požiadavka';
$string['error:emptyname'] = 'Názov kategórie nemôže byť prázdny';
$string['erroraddcategory'] = 'Chyba pri Pridať Kategória';
$string['errordeletecategory'] = 'Chyba pri Odstrániť Kategória';
$string['errorinsertingcategory'] = 'Chyba pri Pridať Kategória';
$string['errorinsertingticket'] = 'Chyba pri Požiadavka';
$string['errorupdatecategory'] = 'Chyba pri Aktualizovať Kategória';
$string['errorupdatingcategory'] = 'Chyba pri Aktualizovať Kategória';
$string['errorupdatingticket'] = 'Chyba pri Aktualizovať Požiadavka';
$string['exportstatusfilter'] = 'Exportovať Stav';
$string['exporttickets'] = 'Exportovať Požiadavky';
$string['findcourse'] = 'Vybrať Kurz';
$string['findticket'] = 'Hľadať Predmet text';
$string['finduser'] = 'Vybrať Používateľ';
$string['geniai_btn_knowledgebase_create'] = 'Vytvoriť znalostnú databázu pomocou AI';
$string['geniai_btn_response_create'] = 'Vytvoriť odpoveď pomocou AI';
$string['geniai_create_knowledgebase_desc'] = 'Podrobne opíšte obsah, ktorý chcete vygenerovať. GeniAI použije tieto informácie na vytvorenie presného a relevantného textu pre znalostnú databázu.';
$string['geniai_create_knowledgebase_message'] = 'Vytvorte správu na základe textu vyššie.';
$string['geniai_create_response_desc'] = 'Opíšte, čo chcete vygenerovať. GeniAI použije všetky konverzácie ako základ na vytvorenie odpovede, ale musíte určiť, ktoré údaje chcete zapísať.';
$string['geniai_create_response_message'] = 'Vytvorte správu na základe textu vyššie.';
$string['geniai_knowledgebase_prompt'] = 'Ste chatbot špecializovaný na znalostné databázy Moodle. Vytvárajte jasný, štruktúrovaný a profesionálny obsah v prvej osobe.\\n\\nVytvorte článok o:\\nNázov Moodle: "{$a->site_fullname}"\\nURL Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nVráťte odpoveď iba v jazyku "{$a->userlang}", bez nadpisov a iba v MARKDOWN.';
$string['geniai_like_message'] = 'Páči sa vám správa? Kliknite sem, zatvorte ju a odošlite do editora.';
$string['geniai_missing'] = 'Nainštalujte a nakonfigurujte plugin <a href="{$a}" target="_blank">GenIA</a>, aby ste povolili odpovede podporované AI.';
$string['geniai_ticket_prompt_1'] = 'Ste chatbot, ktorý navrhuje jasné a priateľské odpovede na požiadavky Moodle v prvej osobe.\\n\\nOtázka používateľa {$a->userfullname}: "{$a->userticket}"\\n\\nVytvoriť odpoveď pomocou pokynov poskytnutých podporou:\\n"{$a->message}"\\n\\nVráťte odpoveď iba v jazyku "{$a->userlang}" a iba v MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Ste chatbot, ktorý navrhuje jasné a priateľské odpovede na požiadavky Moodle v prvej osobe.\\n\\nVytvoriť odpoveď:\\n\\nOtázka používateľa {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Ste chatbot, ktorý navrhuje jasné a priateľské odpovede na požiadavky Moodle v prvej osobe.\\n\\nVytvoriť odpoveď na základe tejto histórie pomocou pokynov poskytnutých podporou:\\n"{$a->message}"\\n\\nVráťte odpoveď iba v jazyku "{$a->userlang}" a iba v MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Ste chatbot, ktorý navrhuje jasné a priateľské odpovede na požiadavky Moodle v prvej osobe.\\n\\nVytvoriť odpoveď na základe tejto histórie.\\n\\nVráťte odpoveď iba v jazyku "{$a->userlang}" a iba v MARKDOWN.';
$string['geniai_title'] = 'Umelá inteligencia';
$string['helpdesk:categorydelete'] = 'Umožňuje odstraňovať kategórie.';
$string['helpdesk:categorymanage'] = 'Umožňuje spravovať kategórie Helpdesku.';
$string['helpdesk:knowledgebase_delete'] = 'Odstraňovať články v znalostnej databáze.';
$string['helpdesk:knowledgebase_manage'] = 'Spravovať články v znalostnej databáze.';
$string['helpdesk:knowledgebase_view'] = 'Zobrazovať články v znalostnej databáze.';
$string['helpdesk:ticketmanage'] = 'Umožňuje spravovať Helpdesk vrátane odpovedania a zatvárania požiadaviek.';
$string['helpdesk:view'] = 'Umožňuje zobrazovať požiadavky Helpdesku a vytvárať ich pre seba.';
$string['helpdesk_manage_users'] = 'Zobraziť používateľov s oprávnením spravovať túto kategóriu roly';
$string['index_top_all_open_tickets'] = 'All Otvorená Požiadavky';
$string['index_top_completed_tickets'] = 'Dokončené Požiadavky';
$string['index_top_unanswered_tickets'] = 'Nezodpovedané Požiadavky';
$string['index_top_urgent_tickets'] = 'Urgentná Požiadavky';
$string['integracaoroot'] = 'Integrácia';
$string['invalidpriority'] = 'Vybraná priorita nie je platná.';
$string['knowledgebase_addnew'] = 'Pridať Nová Znalostná databáza';
$string['knowledgebase_articlenotfound'] = 'Znalostná databáza nenájdená';
$string['knowledgebase_category'] = 'Kategória';
$string['knowledgebase_create'] = 'Vytvoriť Znalostná databáza';
$string['knowledgebase_delete'] = 'Odstrániť Znalostná databáza';
$string['knowledgebase_delete_confirm'] = 'Naozaj chcete odstrániť znalostnú databázu <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'Znalostná databáza úspešne odstránená';
$string['knowledgebase_description'] = 'Obsah znalostnej databázy';
$string['knowledgebase_edit'] = 'Upraviť Znalostná databáza';
$string['knowledgebase_name'] = 'Znalostná databáza';
$string['knowledgebase_prompt_short'] = 'Prompt je príliš krátky';
$string['knowledgebase_title'] = 'Názov znalosti';
$string['knowledgebase_update'] = 'Aktualizovať';
$string['lognewcategory'] = 'Kategória changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Priorita changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Stav changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Neboli vykonané žiadne zmeny!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Požiadavka <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Dobrý deň {[to.fullname]},</p>\\n<p>{[from.fullname]} Vytvoriť Požiadavka #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>S pozdravom,<br>\\nTím podpory</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Požiadavka: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Požiadavka <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Dobrý deň {[to.fullname]},</p>\\n<p>Tím podpory: Aktualizovať.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Zobraziť Požiadavka #{[event.tiketidlink]}.</p>\\n<p>S pozdravom,<br>\\nTím podpory</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Požiadavka <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Dobrý deň {[to.fullname]},</p>\\n<p>Tím podpory: Správa</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Zobraziť Požiadavka #{[event.tiketidlink]}.</p>\\n<p>S pozdravom,<br>\\nTím podpory</p>';
$string['markticketasclosed'] = 'Požiadavka Zatvorená';
$string['markticketasresolved'] = 'Požiadavka Vyriešená';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Priorita';
$string['priority_high'] = 'Vysoká';
$string['priority_low'] = 'Nízka';
$string['priority_medium'] = 'Stredná';
$string['priority_urgent'] = 'Urgentná';
$string['privacy:metadata:category_user_userid'] = 'ID Používateľ - Kategória.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Používatelia - Kategórie Požiadavka.';
$string['privacy:metadata:local_helpdesk_response'] = 'odpovede - Požiadavka.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Požiadavky - Používateľ, Kategória, Stav.';
$string['privacy:metadata:response_userid'] = 'ID Používateľ - odpoveď Požiadavka.';
$string['privacy:metadata:ticket_userid'] = 'ID Používateľ - Požiadavka.';
$string['replytoticket'] = 'odpoveď Požiadavka';
$string['report_assignment_reports_page_description'] = 'Prehľad: Požiadavky / Používatelia.';
$string['report_assignment_reports_page_title'] = 'Prehľady - priradenia';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Požiadavky Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Kategórie Urgentná';
$string['report_category_reports_page_description'] = 'Prehľad: Kategórie Požiadavka.';
$string['report_category_reports_page_title'] = 'Prehľady Kategórie';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Priemer odpoveď';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Celkom Požiadavky';
$string['report_general_reports_page_title'] = 'Prehľady';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Požiadavky Vytvoriť Obdobie';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Dátum vytvorenia';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Celkom Požiadavky';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Požiadavky Vyriešená Obdobie';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Obdobie';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Celkom Vyriešená Požiadavky';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Priemer odpovede';
$string['report_response_reports_page_description'] = 'Prehľad: odpovede Požiadavka.';
$string['report_response_reports_page_title'] = 'Prehľady odpovede';
$string['report_status_priority_reports_page_description'] = 'Prehľad: Stav Priorita Požiadavka.';
$string['report_status_priority_reports_page_title'] = 'Prehľady Stav Priorita';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Priorita distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Požiadavky Stav';
$string['report_tickets_reports_page_description'] = 'Prehľad: Požiadavky Otvorená / Zatvorená.';
$string['report_tickets_reports_page_title'] = 'Požiadavky';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Používateľ';
$string['report_user_reports_page_description'] = 'Prehľad: Používatelia Požiadavky.';
$string['report_user_reports_page_title'] = 'Prehľady Používatelia';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Používatelia Požiadavky Otvorená';
$string['savecategory'] = 'Uložiť Kategória';
$string['savechanges'] = 'Uložiť zmeny';
$string['setting_course'] = 'Zobraziť iba v kurze';
$string['setting_knowledgebase_menu_description'] = 'Povoľte túto možnosť na zobrazenie odkazu na znalostnú databázu v navigačnom menu.';
$string['setting_knowledgebase_menu_title'] = 'Display Znalostná databáza in Menu';
$string['setting_menu_description'] = 'Vyberte, či sa má menu HelpDesk zobrazovať v systémovom menu v hornej časti Moodle.';
$string['setting_menu_title'] = 'Zobraziť v menu';
$string['setting_none'] = 'Nezobrazovať';
$string['setting_system'] = 'Zobraziť v celom systéme';
$string['status'] = 'Stav';
$string['status_all'] = 'Všetky Požiadavky';
$string['status_closed'] = 'Zatvorená';
$string['status_open'] = 'Otvorená';
$string['status_progress'] = 'Prebieha';
$string['status_resolved'] = 'Vyriešená';
$string['subject'] = 'Predmet';
$string['ticketcategory'] = 'Požiadavka Kategória';
$string['ticketcategoryshort'] = 'Kategória';
$string['ticketclosed'] = 'Požiadavka je zatvorená.';
$string['ticketcreated'] = 'Požiadavka úspešne vytvorená';
$string['ticketcreatedat'] = 'Dátum vytvorenia';
$string['ticketdescription'] = 'Požiadavka Popis';
$string['ticketid'] = 'Požiadavka';
$string['ticketmessage'] = 'Správa';
$string['ticketnotfound'] = 'Požiadavka nenájdená';
$string['ticketpriority'] = 'Požiadavka Priorita';
$string['ticketpriorityhigh'] = 'Vysoká';
$string['ticketprioritylow'] = 'Nízka';
$string['ticketprioritymedium'] = 'Stredná';
$string['ticketpriorityshort'] = 'Priorita';
$string['ticketpriorityurgent'] = 'Urgentná';
$string['ticketresponse'] = 'odpoveď Požiadavka';
$string['ticketresponseandclose'] = 'odpoveď Požiadavka Zatvorená';
$string['ticketresponseandresolved'] = 'odpoveď Požiadavka Vyriešená';
$string['tickets'] = 'Všetky Požiadavky';
$string['ticketslist'] = 'Zoznam Požiadavky';
$string['ticketstatus'] = 'Požiadavka Stav';
$string['ticketstatusclosed'] = 'Zatvorená';
$string['ticketstatusinprogress'] = 'Prebieha';
$string['ticketstatusnotclosed'] = 'Všetky except Zatvorená';
$string['ticketstatusopen'] = 'Otvorená';
$string['ticketstatusresolved'] = 'Vyriešená';
$string['ticketstatusshort'] = 'Stav';
$string['ticketsubject'] = 'Požiadavka Predmet';
$string['ticketupdated'] = 'Požiadavka úspešne aktualizovaná';
$string['updatecategory'] = 'Aktualizovať Kategória';
$string['userid'] = 'ID Používateľ';
$string['viewticket'] = 'Zobraziť Požiadavka';
