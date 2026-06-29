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

$string['addcategory'] = 'Añadir Nueva Categoría';
$string['addticket'] = 'Añadir Ticket';
$string['attachment'] = 'Adjuntos';
$string['avg_closing_time'] = 'Promedio Cerrado';
$string['avg_first_response_time'] = 'Promedio respuesta';
$string['cancel'] = 'Cancelar';
$string['categories'] = 'Categorías Tickets';
$string['categorieslist'] = 'Lista Categorías';
$string['category'] = 'Categoría';
$string['category_role_description'] = 'Rol específico para controlar el acceso de los usuarios a la gestión de tickets.';
$string['category_users_all'] = 'Todos los usuarios de Moodle';
$string['category_users_info'] = 'Primero, guarde la categoría antes de editar usuarios.';
$string['category_users_responses'] = 'Usuarios que responden a esta categoría';
$string['category_users_title'] = 'Define los usuarios con permiso para responder y que recibirán un correo sobre nuevos tickets';
$string['categoryadded'] = 'Categoría añadida correctamente';
$string['categorycreated'] = 'Categoría creada correctamente';
$string['categorydeleted'] = 'Categoría eliminada correctamente';
$string['categorydescription'] = 'Categoría Descripción';
$string['categoryname'] = 'Categoría Nombre';
$string['categorynotfound'] = 'Categoría no encontrada';
$string['categoryupdated'] = 'Categoría actualizada correctamente';
$string['comments'] = 'Comentarios';
$string['confirmdelete'] = '¿Seguro que desea eliminar esta categoría?';
$string['confirmdeletecategory'] = '¿Seguro que desea eliminar esta categoría?';
$string['confirmdeleteticket'] = '¿Seguro que desea eliminar permanentemente el ticket "{$a}"? También se eliminarán todas las respuestas y adjuntos relacionados con este ticket.';
$string['createcategory'] = 'Crear Categoría';
$string['createcategoryfirst'] = 'Crear Categoría';
$string['createticket'] = 'Crear Ticket';
$string['deletecategory'] = 'Eliminar Categoría';
$string['deletecategoryusedata'] = 'Esta categoría tiene datos';
$string['deletesuccesscategory'] = 'Categoría eliminada correctamente';
$string['deletesuccessticket'] = 'Ticket eliminada correctamente.';
$string['deleteticket'] = 'Eliminar Ticket';
$string['description'] = 'Descripción';
$string['editcategory'] = 'Editar Categoría';
$string['editticket'] = 'Editar Ticket';
$string['error:emptyname'] = 'El nombre de la categoría no puede estar vacío';
$string['erroraddcategory'] = 'Error al Añadir Categoría';
$string['errordeletecategory'] = 'Error al Eliminar Categoría';
$string['errorinsertingcategory'] = 'Error al Añadir Categoría';
$string['errorinsertingticket'] = 'Error al Ticket';
$string['errorupdatecategory'] = 'Error al Actualizar Categoría';
$string['errorupdatingcategory'] = 'Error al Actualizar Categoría';
$string['errorupdatingticket'] = 'Error al Actualizar Ticket';
$string['exportstatusfilter'] = 'Exportar Estado';
$string['exporttickets'] = 'Exportar Tickets';
$string['findcourse'] = 'Seleccionar Curso';
$string['findticket'] = 'Buscar Asunto texto';
$string['finduser'] = 'Seleccionar Usuario';
$string['geniai_btn_knowledgebase_create'] = 'Crear una base de conocimiento con IA';
$string['geniai_btn_response_create'] = 'Crear una respuesta con IA';
$string['geniai_create_knowledgebase_desc'] = 'Describa con detalle el contenido que desea generar. GeniAI usará esta información para crear un texto preciso y relevante para la base de conocimiento.';
$string['geniai_create_knowledgebase_message'] = 'Crear un mensaje basado en el texto anterior.';
$string['geniai_create_response_desc'] = 'Describa lo que desea generar. GeniAI usará todas las conversaciones como base para crear una respuesta, pero debe definir qué datos desea escribir.';
$string['geniai_create_response_message'] = 'Crear un mensaje basado en el texto anterior.';
$string['geniai_knowledgebase_prompt'] = 'Eres un chatbot especializado en crear bases de conocimiento para Moodle. Genera contenido claro, bien estructurado y profesional en primera persona.\\n\\nAhora, crea un artículo de base de conocimiento sobre:\\nNombre de Moodle: "{$a->site_fullname}"\\nURL de Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nDevuelve solo en el idioma "{$a->userlang}", sin títulos, y únicamente en MARKDOWN.';
$string['geniai_like_message'] = '¿Le gustó el mensaje? Haga clic aquí para cerrar y enviarlo al Editor.';
$string['geniai_missing'] = 'Instale y configure el plugin <a href="{$a}" target="_blank">GenIA</a> para habilitar respuestas con IA.';
$string['geniai_ticket_prompt_1'] = 'Eres un chatbot que sugiere respuestas a tickets de Moodle de forma clara, alegre y en primera persona.\\n\\nPregunta del usuario {$a->userfullname}: "{$a->userticket}"\\n\\nCrear respuesta usando las instrucciones proporcionadas por Soporte:\\n"{$a->message}"\\n\\nDevuelve solo en el idioma "{$a->userlang}" y únicamente en MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Eres un chatbot que sugiere respuestas a tickets de Moodle de forma clara, alegre y en primera persona.\\n\\nCrear respuesta:\\n\\nPregunta del usuario {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Eres un chatbot que sugiere respuestas a tickets de Moodle de forma clara, alegre y en primera persona.\\n\\nCrear respuesta con base en este historial usando las instrucciones proporcionadas por Soporte:\\n"{$a->message}"\\n\\nDevuelve solo en el idioma "{$a->userlang}" y únicamente en MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Eres un chatbot que sugiere respuestas a tickets de Moodle de forma clara, alegre y en primera persona.\\n\\nCrear respuesta con base en este historial.\\n\\nDevuelve solo en el idioma "{$a->userlang}" y únicamente en MARKDOWN.';
$string['geniai_title'] = 'Inteligencia artificial';
$string['helpdesk:categorydelete'] = 'Permite eliminar categorías.';
$string['helpdesk:categorymanage'] = 'Permite gestionar las categorías del Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Eliminar artículos en la base de conocimiento.';
$string['helpdesk:knowledgebase_manage'] = 'Gestionar artículos en la base de conocimiento.';
$string['helpdesk:knowledgebase_view'] = 'Ver artículos en la base de conocimiento.';
$string['helpdesk:ticketmanage'] = 'Permite gestionar el Helpdesk, incluyendo responder y cerrar tickets.';
$string['helpdesk:view'] = 'Permite ver tickets del Helpdesk y crearlos para uno mismo.';
$string['helpdesk_manage_users'] = 'Ver usuarios con permiso para gestionar esta categoría de rol';
$string['index_top_all_open_tickets'] = 'All Abierto Tickets';
$string['index_top_completed_tickets'] = 'Completados Tickets';
$string['index_top_unanswered_tickets'] = 'Sin respuesta Tickets';
$string['index_top_urgent_tickets'] = 'Urgente Tickets';
$string['integracaoroot'] = 'Integración';
$string['invalidpriority'] = 'Prioridad seleccionada no válida.';
$string['knowledgebase_addnew'] = 'Añadir Nueva Base de conocimiento';
$string['knowledgebase_articlenotfound'] = 'Base de conocimiento no encontrada';
$string['knowledgebase_category'] = 'Categoría';
$string['knowledgebase_create'] = 'Crear Base de conocimiento';
$string['knowledgebase_delete'] = 'Eliminar Base de conocimiento';
$string['knowledgebase_delete_confirm'] = '¿Seguro que desea eliminar la base de conocimiento <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'Base de conocimiento eliminada correctamente';
$string['knowledgebase_description'] = 'Contenido de la base de conocimiento';
$string['knowledgebase_edit'] = 'Editar Base de conocimiento';
$string['knowledgebase_name'] = 'Base de conocimiento';
$string['knowledgebase_prompt_short'] = 'Prompt demasiado corto';
$string['knowledgebase_title'] = 'Título de conocimiento';
$string['knowledgebase_update'] = 'Actualizar';
$string['lognewcategory'] = 'Categoría changed a <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Prioridad changed a <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Estado changed a <strong>{$a}</strong>!';
$string['lognowupdate'] = '¡No se realizaron cambios!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Estimado/a {[to.fullname]},</p>\\n<p>{[from.fullname]} Crear Ticket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Saludos cordiales,<br>\\nEquipo de soporte</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Estimado/a {[to.fullname]},</p>\\n<p>Equipo de soporte: Actualizar.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Ver Ticket #{[event.tiketidlink]}.</p>\\n<p>Saludos cordiales,<br>\\nEquipo de soporte</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Estimado/a {[to.fullname]},</p>\\n<p>Equipo de soporte: Mensaje</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Ver Ticket #{[event.tiketidlink]}.</p>\\n<p>Saludos cordiales,<br>\\nEquipo de soporte</p>';
$string['markticketasclosed'] = 'Ticket Cerrado';
$string['markticketasresolved'] = 'Ticket Resuelto';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Prioridad';
$string['priority_high'] = 'Alta';
$string['priority_low'] = 'Baja';
$string['priority_medium'] = 'Media';
$string['priority_urgent'] = 'Urgente';
$string['privacy:metadata:category_user_userid'] = 'ID Usuario - Categoría.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Usuarios - Categorías Ticket.';
$string['privacy:metadata:local_helpdesk_response'] = 'respuestas - Ticket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Tickets - Usuario, Categoría, Estado.';
$string['privacy:metadata:response_userid'] = 'ID Usuario - respuesta Ticket.';
$string['privacy:metadata:ticket_userid'] = 'ID Usuario - Ticket.';
$string['replytoticket'] = 'respuesta Ticket';
$string['report_assignment_reports_page_description'] = 'Informe: Tickets / Usuarios.';
$string['report_assignment_reports_page_title'] = 'Informes - asignación';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets por agente';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Categorías Urgente';
$string['report_category_reports_page_description'] = 'Informe: Categorías Ticket.';
$string['report_category_reports_page_title'] = 'Informes Categorías';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Promedio respuesta';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total Tickets';
$string['report_general_reports_page_title'] = 'Informes generales';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Crear Período';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Fecha de creación';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total Tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Resuelto Período';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Período';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total Resuelto Tickets';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Promedio respuestas';
$string['report_response_reports_page_description'] = 'Informe: respuestas Ticket.';
$string['report_response_reports_page_title'] = 'Informes respuestas';
$string['report_status_priority_reports_page_description'] = 'Informe: Estado Prioridad Ticket.';
$string['report_status_priority_reports_page_title'] = 'Informes Estado Prioridad';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Prioridad distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets Estado';
$string['report_tickets_reports_page_description'] = 'Informe: Tickets Abierto / Cerrado.';
$string['report_tickets_reports_page_title'] = 'Tickets';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Usuario';
$string['report_user_reports_page_description'] = 'Informe: Usuarios Tickets.';
$string['report_user_reports_page_title'] = 'Informes Usuarios';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Usuarios Tickets Abierto';
$string['savecategory'] = 'Guardar Categoría';
$string['savechanges'] = 'Guardar cambios';
$string['setting_course'] = 'Mostrar solo dentro del curso';
$string['setting_knowledgebase_menu_description'] = 'Active esta opción para mostrar el enlace de la base de conocimiento en el menú de navegación.';
$string['setting_knowledgebase_menu_title'] = 'Display Base de conocimiento en Menu';
$string['setting_menu_description'] = 'Seleccione si desea mostrar el menú HelpDesk en el menú del sistema en la parte superior de Moodle.';
$string['setting_menu_title'] = 'Mostrar en el menú';
$string['setting_none'] = 'No mostrar';
$string['setting_system'] = 'Mostrar en todo el sistema';
$string['status'] = 'Estado';
$string['status_all'] = 'Todos Tickets';
$string['status_closed'] = 'Cerrado';
$string['status_open'] = 'Abierto';
$string['status_progress'] = 'En progreso';
$string['status_resolved'] = 'Resuelto';
$string['subject'] = 'Asunto';
$string['ticketcategory'] = 'Ticket Categoría';
$string['ticketcategoryshort'] = 'Categoría';
$string['ticketclosed'] = 'El ticket está cerrado.';
$string['ticketcreated'] = 'Ticket creada correctamente';
$string['ticketcreatedat'] = 'Fecha de creación';
$string['ticketdescription'] = 'Ticket Descripción';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Mensaje';
$string['ticketnotfound'] = 'Ticket no encontrada';
$string['ticketpriority'] = 'Ticket Prioridad';
$string['ticketpriorityhigh'] = 'Alta';
$string['ticketprioritylow'] = 'Baja';
$string['ticketprioritymedium'] = 'Media';
$string['ticketpriorityshort'] = 'Prioridad';
$string['ticketpriorityurgent'] = 'Urgente';
$string['ticketresponse'] = 'respuesta Ticket';
$string['ticketresponseandclose'] = 'respuesta Ticket Cerrado';
$string['ticketresponseandresolved'] = 'respuesta Ticket Resuelto';
$string['tickets'] = 'Todos Tickets';
$string['ticketslist'] = 'Lista Tickets';
$string['ticketstatus'] = 'Ticket Estado';
$string['ticketstatusclosed'] = 'Cerrado';
$string['ticketstatusinprogress'] = 'En progreso';
$string['ticketstatusnotclosed'] = 'Todos except Cerrado';
$string['ticketstatusopen'] = 'Abierto';
$string['ticketstatusresolved'] = 'Resuelto';
$string['ticketstatusshort'] = 'Estado';
$string['ticketsubject'] = 'Ticket Asunto';
$string['ticketupdated'] = 'Ticket actualizada correctamente';
$string['updatecategory'] = 'Actualizar Categoría';
$string['userid'] = 'ID Usuario';
$string['viewticket'] = 'Ver Ticket';
