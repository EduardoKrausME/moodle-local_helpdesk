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

$string['addcategory'] = 'Ajouter Nouvelle Catégorie';
$string['addticket'] = 'Ajouter Ticket';
$string['attachment'] = 'Pièces jointes';
$string['avg_closing_time'] = 'Moyenne Fermé';
$string['avg_first_response_time'] = 'Moyenne réponse';
$string['cancel'] = 'Annuler';
$string['categories'] = 'Catégories Tickets';
$string['categorieslist'] = 'Liste Catégories';
$string['category'] = 'Catégorie';
$string['category_role_description'] = 'Rôle spécifique pour contrôler l’accès des utilisateurs à la gestion des tickets.';
$string['category_users_all'] = 'Tous les utilisateurs Moodle';
$string['category_users_info'] = 'Enregistrez d’abord la catégorie avant de modifier les utilisateurs.';
$string['category_users_responses'] = 'Utilisateurs qui répondent à cette catégorie';
$string['category_users_title'] = 'Définit les utilisateurs autorisés à répondre et qui recevront un e-mail concernant les nouveaux tickets';
$string['categoryadded'] = 'Catégorie ajoutée avec succès';
$string['categorycreated'] = 'Catégorie créée avec succès';
$string['categorydeleted'] = 'Catégorie supprimée avec succès';
$string['categorydescription'] = 'Catégorie Description';
$string['categoryname'] = 'Catégorie Nom';
$string['categorynotfound'] = 'Catégorie introuvable';
$string['categoryupdated'] = 'Catégorie mise à jour avec succès';
$string['comments'] = 'Commentaires';
$string['confirmdelete'] = 'Voulez-vous vraiment supprimer cette catégorie ?';
$string['confirmdeletecategory'] = 'Voulez-vous vraiment supprimer cette catégorie ?';
$string['confirmdeleteticket'] = 'Voulez-vous vraiment supprimer définitivement le ticket "{$a}" ? Toutes les réponses et pièces jointes liées à ce ticket seront également supprimées.';
$string['createcategory'] = 'Créer Catégorie';
$string['createcategoryfirst'] = 'Créer Catégorie';
$string['createticket'] = 'Créer Ticket';
$string['deletecategory'] = 'Supprimer Catégorie';
$string['deletecategoryusedata'] = 'Cette catégorie contient des données';
$string['deletesuccesscategory'] = 'Catégorie supprimée avec succès';
$string['deletesuccessticket'] = 'Ticket supprimée avec succès.';
$string['deleteticket'] = 'Supprimer Ticket';
$string['description'] = 'Description';
$string['editcategory'] = 'Modifier Catégorie';
$string['editticket'] = 'Modifier Ticket';
$string['error:emptyname'] = 'Le nom de la catégorie ne peut pas être vide';
$string['erroraddcategory'] = 'Erreur lors de Ajouter Catégorie';
$string['errordeletecategory'] = 'Erreur lors de Supprimer Catégorie';
$string['errorinsertingcategory'] = 'Erreur lors de Ajouter Catégorie';
$string['errorinsertingticket'] = 'Erreur lors de Ticket';
$string['errorupdatecategory'] = 'Erreur lors de Mettre à jour Catégorie';
$string['errorupdatingcategory'] = 'Erreur lors de Mettre à jour Catégorie';
$string['errorupdatingticket'] = 'Erreur lors de Mettre à jour Ticket';
$string['exportstatusfilter'] = 'Exporter Statut';
$string['exporttickets'] = 'Exporter Tickets';
$string['findcourse'] = 'Sélectionner Cours';
$string['findticket'] = 'Rechercher Sujet texte';
$string['finduser'] = 'Sélectionner Utilisateur';
$string['geniai_btn_knowledgebase_create'] = 'Créer une base de connaissances avec l’IA';
$string['geniai_btn_response_create'] = 'Créer une réponse avec l’IA';
$string['geniai_create_knowledgebase_desc'] = 'Décrivez en détail le contenu que vous souhaitez générer. GeniAI utilisera ces informations pour créer un texte précis et pertinent pour la base de connaissances.';
$string['geniai_create_knowledgebase_message'] = 'Créez un message basé sur le texte ci-dessus.';
$string['geniai_create_response_desc'] = 'Décrivez ce que vous souhaitez générer. GeniAI utilisera toutes les conversations comme base pour créer une réponse, mais vous devez définir les données à rédiger.';
$string['geniai_create_response_message'] = 'Créez un message basé sur le texte ci-dessus.';
$string['geniai_knowledgebase_prompt'] = 'Vous êtes un chatbot spécialisé dans les bases de connaissances Moodle. Générez un contenu clair, structuré et professionnel à la première personne.\\n\\nCréez maintenant un article sur :\\nNom Moodle : "{$a->site_fullname}"\\nURL Moodle : "{$a->site_url}"\\n"{$a->message}"\\n\\nRépondez uniquement dans la langue "{$a->userlang}", sans titres, et uniquement en MARKDOWN.';
$string['geniai_like_message'] = 'Vous aimez le message ? Cliquez ici pour fermer et l’envoyer à l’éditeur.';
$string['geniai_missing'] = 'Installez et configurez le plugin <a href="{$a}" target="_blank">GenIA</a> pour activer les réponses assistées par IA.';
$string['geniai_ticket_prompt_1'] = 'Vous êtes un chatbot qui suggère des réponses claires, chaleureuses et à la première personne aux tickets Moodle.\\n\\nQuestion de l’utilisateur {$a->userfullname} : "{$a->userticket}"\\n\\nCréer réponse à l’aide des instructions fournies par le support:\\n"{$a->message}"\\n\\nRépondez uniquement dans la langue "{$a->userlang}" et uniquement en MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Vous êtes un chatbot qui suggère des réponses claires, chaleureuses et à la première personne aux tickets Moodle.\\n\\nCréer réponse:\\n\\nQuestion de l’utilisateur {$a->userfullname} : "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Vous êtes un chatbot qui suggère des réponses claires, chaleureuses et à la première personne aux tickets Moodle.\\n\\nCréer réponse sur la base de cet historique à l’aide des instructions fournies par le support:\\n"{$a->message}"\\n\\nRépondez uniquement dans la langue "{$a->userlang}" et uniquement en MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Vous êtes un chatbot qui suggère des réponses claires, chaleureuses et à la première personne aux tickets Moodle.\\n\\nCréer réponse sur la base de cet historique.\\n\\nRépondez uniquement dans la langue "{$a->userlang}" et uniquement en MARKDOWN.';
$string['geniai_title'] = 'Intelligence artificielle';
$string['helpdesk:categorydelete'] = 'Permet de supprimer des catégories.';
$string['helpdesk:categorymanage'] = 'Permet de gérer les catégories du Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Supprimer des articles dans la base de connaissances.';
$string['helpdesk:knowledgebase_manage'] = 'Gérer des articles dans la base de connaissances.';
$string['helpdesk:knowledgebase_view'] = 'Voir des articles dans la base de connaissances.';
$string['helpdesk:ticketmanage'] = 'Permet de gérer le Helpdesk, y compris répondre aux tickets et les fermer.';
$string['helpdesk:view'] = 'Permet de voir les tickets du Helpdesk et d’en créer pour soi-même.';
$string['helpdesk_manage_users'] = 'Voir les utilisateurs autorisés à gérer cette catégorie de rôle';
$string['index_top_all_open_tickets'] = 'All Ouvert Tickets';
$string['index_top_completed_tickets'] = 'Terminés Tickets';
$string['index_top_unanswered_tickets'] = 'Sans réponse Tickets';
$string['index_top_urgent_tickets'] = 'Urgente Tickets';
$string['integracaoroot'] = 'Intégration';
$string['invalidpriority'] = 'Priorité sélectionnée non valide.';
$string['knowledgebase_addnew'] = 'Ajouter Nouvelle Base de connaissances';
$string['knowledgebase_articlenotfound'] = 'Base de connaissances introuvable';
$string['knowledgebase_category'] = 'Catégorie';
$string['knowledgebase_create'] = 'Créer Base de connaissances';
$string['knowledgebase_delete'] = 'Supprimer Base de connaissances';
$string['knowledgebase_delete_confirm'] = 'Voulez-vous vraiment supprimer la base de connaissances <strong>{$a}</strong> ?';
$string['knowledgebase_delete_success'] = 'Base de connaissances supprimée avec succès';
$string['knowledgebase_description'] = 'Contenu de la base de connaissances';
$string['knowledgebase_edit'] = 'Modifier Base de connaissances';
$string['knowledgebase_name'] = 'Base de connaissances';
$string['knowledgebase_prompt_short'] = 'Prompt trop court';
$string['knowledgebase_title'] = 'Titre de connaissance';
$string['knowledgebase_update'] = 'Mettre à jour';
$string['lognewcategory'] = 'Catégorie changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Priorité changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Statut changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Aucune modification effectuée !';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Bonjour {[to.fullname]},</p>\\n<p>{[from.fullname]} Créer Ticket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Cordialement,<br>\\nÉquipe support</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Bonjour {[to.fullname]},</p>\\n<p>Équipe support: Mettre à jour.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Voir Ticket #{[event.tiketidlink]}.</p>\\n<p>Cordialement,<br>\\nÉquipe support</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Bonjour {[to.fullname]},</p>\\n<p>Équipe support: Message</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Voir Ticket #{[event.tiketidlink]}.</p>\\n<p>Cordialement,<br>\\nÉquipe support</p>';
$string['markticketasclosed'] = 'Ticket Fermé';
$string['markticketasresolved'] = 'Ticket Résolu';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Priorité';
$string['priority_high'] = 'Élevée';
$string['priority_low'] = 'Faible';
$string['priority_medium'] = 'Moyenne';
$string['priority_urgent'] = 'Urgente';
$string['privacy:metadata:category_user_userid'] = 'ID Utilisateur - Catégorie.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Utilisateurs - Catégories Ticket.';
$string['privacy:metadata:local_helpdesk_response'] = 'réponses - Ticket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Tickets - Utilisateur, Catégorie, Statut.';
$string['privacy:metadata:response_userid'] = 'ID Utilisateur - réponse Ticket.';
$string['privacy:metadata:ticket_userid'] = 'ID Utilisateur - Ticket.';
$string['replytoticket'] = 'réponse Ticket';
$string['report_assignment_reports_page_description'] = 'Rapport: Tickets / Utilisateurs.';
$string['report_assignment_reports_page_title'] = 'Rapports - affectation';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Catégories Urgente';
$string['report_category_reports_page_description'] = 'Rapport: Catégories Ticket.';
$string['report_category_reports_page_title'] = 'Rapports Catégories';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Moyenne réponse';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total Tickets';
$string['report_general_reports_page_title'] = 'Rapports';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Créer Période';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Date de création';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total Tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Résolu Période';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Période';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total Résolu Tickets';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Moyenne réponses';
$string['report_response_reports_page_description'] = 'Rapport: réponses Ticket.';
$string['report_response_reports_page_title'] = 'Rapports réponses';
$string['report_status_priority_reports_page_description'] = 'Rapport: Statut Priorité Ticket.';
$string['report_status_priority_reports_page_title'] = 'Rapports Statut Priorité';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Priorité distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets Statut';
$string['report_tickets_reports_page_description'] = 'Rapport: Tickets Ouvert / Fermé.';
$string['report_tickets_reports_page_title'] = 'Tickets';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Utilisateur';
$string['report_user_reports_page_description'] = 'Rapport: Utilisateurs Tickets.';
$string['report_user_reports_page_title'] = 'Rapports Utilisateurs';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Utilisateurs Tickets Ouvert';
$string['savecategory'] = 'Enregistrer Catégorie';
$string['savechanges'] = 'Enregistrer modifications';
$string['setting_course'] = 'Afficher uniquement dans le cours';
$string['setting_knowledgebase_menu_description'] = 'Activez cette option pour afficher le lien vers la base de connaissances dans le menu de navigation.';
$string['setting_knowledgebase_menu_title'] = 'Display Base de connaissances in Menu';
$string['setting_menu_description'] = 'Sélectionnez si le menu HelpDesk doit être affiché dans le menu système en haut de Moodle.';
$string['setting_menu_title'] = 'Afficher dans le menu';
$string['setting_none'] = 'Ne pas afficher';
$string['setting_system'] = 'Afficher dans tout le système';
$string['status'] = 'Statut';
$string['status_all'] = 'Tous Tickets';
$string['status_closed'] = 'Fermé';
$string['status_open'] = 'Ouvert';
$string['status_progress'] = 'En cours';
$string['status_resolved'] = 'Résolu';
$string['subject'] = 'Sujet';
$string['ticketcategory'] = 'Ticket Catégorie';
$string['ticketcategoryshort'] = 'Catégorie';
$string['ticketclosed'] = 'Le ticket est fermé.';
$string['ticketcreated'] = 'Ticket créée avec succès';
$string['ticketcreatedat'] = 'Date de création';
$string['ticketdescription'] = 'Ticket Description';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Message';
$string['ticketnotfound'] = 'Ticket introuvable';
$string['ticketpriority'] = 'Ticket Priorité';
$string['ticketpriorityhigh'] = 'Élevée';
$string['ticketprioritylow'] = 'Faible';
$string['ticketprioritymedium'] = 'Moyenne';
$string['ticketpriorityshort'] = 'Priorité';
$string['ticketpriorityurgent'] = 'Urgente';
$string['ticketresponse'] = 'réponse Ticket';
$string['ticketresponseandclose'] = 'réponse Ticket Fermé';
$string['ticketresponseandresolved'] = 'réponse Ticket Résolu';
$string['tickets'] = 'Tous Tickets';
$string['ticketslist'] = 'Liste Tickets';
$string['ticketstatus'] = 'Ticket Statut';
$string['ticketstatusclosed'] = 'Fermé';
$string['ticketstatusinprogress'] = 'En cours';
$string['ticketstatusnotclosed'] = 'Tous except Fermé';
$string['ticketstatusopen'] = 'Ouvert';
$string['ticketstatusresolved'] = 'Résolu';
$string['ticketstatusshort'] = 'Statut';
$string['ticketsubject'] = 'Ticket Sujet';
$string['ticketupdated'] = 'Ticket mise à jour avec succès';
$string['updatecategory'] = 'Mettre à jour Catégorie';
$string['userid'] = 'ID Utilisateur';
$string['viewticket'] = 'Voir Ticket';
