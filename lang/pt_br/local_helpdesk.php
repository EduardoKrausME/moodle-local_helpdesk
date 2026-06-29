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

$string['addcategory'] = 'Adicionar Nova Categoria';
$string['addticket'] = 'Adicionar Ticket';
$string['attachment'] = 'Anexos';
$string['avg_closing_time'] = 'Média fechamento';
$string['avg_first_response_time'] = 'Média primeira resposta';
$string['cancel'] = 'Cancelar';
$string['categories'] = 'Categorias Tickets';
$string['categorieslist'] = 'Lista Categorias';
$string['category'] = 'Categoria';
$string['category_role_description'] = 'Papel específico para controlar o acesso dos usuários ao gerenciamento de tickets.';
$string['category_users_all'] = 'Todos os usuários do Moodle';
$string['category_users_info'] = 'Primeiro, salve a categoria antes de editar usuários.';
$string['category_users_responses'] = 'Usuários que respondem a esta categoria';
$string['category_users_title'] = 'Define os usuários com permissão para responder e que receberão um e-mail sobre novos tickets';
$string['categoryadded'] = 'Categoria adicionada com sucesso';
$string['categorycreated'] = 'Categoria criada com sucesso';
$string['categorydeleted'] = 'Categoria excluída com sucesso';
$string['categorydescription'] = 'Categoria Descrição';
$string['categoryname'] = 'Categoria Nome';
$string['categorynotfound'] = 'Categoria não encontrada';
$string['categoryupdated'] = 'Categoria atualizada com sucesso';
$string['comments'] = 'Comentários';
$string['confirmdelete'] = 'Tem certeza de que deseja eliminar esta categoria?';
$string['confirmdeletecategory'] = 'Tem certeza de que deseja eliminar esta categoria?';
$string['confirmdeleteticket'] = 'Tem certeza de que deseja excluir permanentemente o ticket "{$a}"? Todas as respostas e anexos relacionados a este ticket também serão excluídos.';
$string['createcategory'] = 'Criar Categoria';
$string['createcategoryfirst'] = 'Criar Categoria';
$string['createticket'] = 'Criar Ticket';
$string['deletecategory'] = 'Excluir Categoria';
$string['deletecategoryusedata'] = 'Esta categoria possui dados';
$string['deletesuccesscategory'] = 'Categoria excluída com sucesso';
$string['deletesuccessticket'] = 'Ticket excluída com sucesso.';
$string['deleteticket'] = 'Excluir Ticket';
$string['description'] = 'Descrição';
$string['editcategory'] = 'Editar Categoria';
$string['editticket'] = 'Editar Ticket';
$string['error:emptyname'] = 'O nome da categoria não pode estar vazio';
$string['erroraddcategory'] = 'Erro ao Adicionar Categoria';
$string['errordeletecategory'] = 'Erro ao Excluir Categoria';
$string['errorinsertingcategory'] = 'Erro ao Adicionar Categoria';
$string['errorinsertingticket'] = 'Erro ao Ticket';
$string['errorupdatecategory'] = 'Erro ao Atualizar Categoria';
$string['errorupdatingcategory'] = 'Erro ao Atualizar Categoria';
$string['errorupdatingticket'] = 'Erro ao Atualizar Ticket';
$string['exportstatusfilter'] = 'Exportar Estado';
$string['exporttickets'] = 'Exportar Tickets';
$string['findcourse'] = 'Selecionar Curso';
$string['findticket'] = 'Pesquisar Assunto texto';
$string['finduser'] = 'Selecionar Usuário';
$string['geniai_btn_knowledgebase_create'] = 'Criar uma base de conhecimento com IA';
$string['geniai_btn_response_create'] = 'Criar uma resposta com IA';
$string['geniai_create_knowledgebase_desc'] = 'Descreva em detalhes o conteúdo que deseja gerar. O GeniAI usará essas informações para criar um texto preciso e relevante para a base de conhecimento.';
$string['geniai_create_knowledgebase_message'] = 'Crie uma mensagem com base no texto acima.';
$string['geniai_create_response_desc'] = 'Descreva o que deseja gerar. O GeniAI usará todas as conversas como base para criar uma resposta, mas você precisa definir quais dados deseja escrever.';
$string['geniai_create_response_message'] = 'Crie uma mensagem com base no texto acima.';
$string['geniai_knowledgebase_prompt'] = 'Você é um chatbot especializado em criar bases de conhecimento para Moodle. Gere conteúdo claro, bem estruturado e profissional em primeira pessoa.\\n\\nAgora, crie um artigo de base de conhecimento sobre:\\nNome do Moodle: "{$a->site_fullname}"\\nURL do Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nRetorne apenas no idioma "{$a->userlang}", sem títulos, e somente em MARKDOWN.';
$string['geniai_like_message'] = 'Gostou da mensagem? Clique aqui para fechar e enviá-la para o Editor.';
$string['geniai_missing'] = 'Instale e configure o plugin <a href="{$a}" target="_blank">GenIA</a> para ativar respostas com IA.';
$string['geniai_ticket_prompt_1'] = 'Você é um chatbot que sugere respostas para tickets do Moodle de forma alegre, clara e em primeira pessoa.\\n\\nPergunta do usuário {$a->userfullname}: "{$a->userticket}"\\n\\nCriar resposta usando as instruções fornecidas pelo Suporte:\\n"{$a->message}"\\n\\nRetorne apenas no idioma "{$a->userlang}" e somente em MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Você é um chatbot que sugere respostas para tickets do Moodle de forma alegre, clara e em primeira pessoa.\\n\\nCriar resposta:\\n\\nPergunta do usuário {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Você é um chatbot que sugere respostas para tickets do Moodle de forma alegre, clara e em primeira pessoa.\\n\\nCriar resposta com base neste histórico usando as instruções fornecidas pelo Suporte:\\n"{$a->message}"\\n\\nRetorne apenas no idioma "{$a->userlang}" e somente em MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Você é um chatbot que sugere respostas para tickets do Moodle de forma alegre, clara e em primeira pessoa.\\n\\nCriar resposta com base neste histórico.\\n\\nRetorne apenas no idioma "{$a->userlang}" e somente em MARKDOWN.';
$string['geniai_title'] = 'Inteligência artificial';
$string['helpdesk:categorydelete'] = 'Permite excluir categorias.';
$string['helpdesk:categorymanage'] = 'Permite gerenciar as categorias do Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Excluir artigos na base de conhecimento.';
$string['helpdesk:knowledgebase_manage'] = 'Gerenciar artigos na base de conhecimento.';
$string['helpdesk:knowledgebase_view'] = 'Ver artigos na base de conhecimento.';
$string['helpdesk:ticketmanage'] = 'Permite gerenciar o Helpdesk, incluindo responder e fechar tickets.';
$string['helpdesk:view'] = 'Permite visualizar tickets do Helpdesk e criá-los para si mesmo.';
$string['helpdesk_manage_users'] = 'Ver usuários com permissão para gerenciar esta categoria de papel';
$string['index_top_all_open_tickets'] = 'All Aberto Tickets';
$string['index_top_completed_tickets'] = 'Concluídos Tickets';
$string['index_top_unanswered_tickets'] = 'Sem resposta Tickets';
$string['index_top_urgent_tickets'] = 'Urgente Tickets';
$string['integracaoroot'] = 'Integração';
$string['invalidpriority'] = 'Prioridade selecionada inválida.';
$string['knowledgebase_addnew'] = 'Adicionar Nova Base de conhecimento';
$string['knowledgebase_articlenotfound'] = 'Base de conhecimento não encontrada';
$string['knowledgebase_category'] = 'Categoria';
$string['knowledgebase_create'] = 'Criar Base de conhecimento';
$string['knowledgebase_delete'] = 'Excluir Base de conhecimento';
$string['knowledgebase_delete_confirm'] = 'Tem certeza de que deseja excluir a base de conhecimento <strong>{$a}</strong>';
$string['knowledgebase_delete_success'] = 'Base de conhecimento excluída com sucesso';
$string['knowledgebase_description'] = 'Conteúdo da base de conhecimento';
$string['knowledgebase_edit'] = 'Editar Base de conhecimento';
$string['knowledgebase_name'] = 'Base de conhecimento';
$string['knowledgebase_prompt_short'] = 'Prompt muito curto';
$string['knowledgebase_title'] = 'Título do conhecimento';
$string['knowledgebase_update'] = 'Atualizar';
$string['lognewcategory'] = 'Categoria changed para <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Prioridade changed para <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Estado changed para <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Nenhuma alteração feita!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Olá {[to.fullname]},</p>\\n<p>{[from.fullname]} Criar Ticket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Atenciosamente,<br>\\nEquipe de suporte</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Olá {[to.fullname]},</p>\\n<p>Equipe de suporte: Atualizar.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Ver Ticket #{[event.tiketidlink]}.</p>\\n<p>Atenciosamente,<br>\\nEquipe de suporte</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Olá {[to.fullname]},</p>\\n<p>Equipe de suporte: Mensagem</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Ver Ticket #{[event.tiketidlink]}.</p>\\n<p>Atenciosamente,<br>\\nEquipe de suporte</p>';
$string['markticketasclosed'] = 'Ticket Fechado';
$string['markticketasresolved'] = 'Ticket Resolvido';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Prioridade';
$string['priority_high'] = 'Alta';
$string['priority_low'] = 'Baixa';
$string['priority_medium'] = 'Média';
$string['priority_urgent'] = 'Urgente';
$string['privacy:metadata:category_user_userid'] = 'ID Usuário - Categoria.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Usuários - Categorias Ticket.';
$string['privacy:metadata:local_helpdesk_response'] = 'respostas - Ticket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Tickets - Usuário, Categoria, Estado.';
$string['privacy:metadata:response_userid'] = 'ID Usuário - resposta Ticket.';
$string['privacy:metadata:ticket_userid'] = 'ID Usuário - Ticket.';
$string['replytoticket'] = 'resposta Ticket';
$string['report_assignment_reports_page_description'] = 'Relatório: Tickets / Usuários.';
$string['report_assignment_reports_page_title'] = 'Relatórios - atribuição';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets por agente';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Categorias Urgente';
$string['report_category_reports_page_description'] = 'Relatório: Categorias Ticket.';
$string['report_category_reports_page_title'] = 'Relatórios Categorias';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Média resposta';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total Tickets';
$string['report_general_reports_page_title'] = 'Relatórios gerais';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Criar Período';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Data de criação';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total Tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Resolvido Período';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Período';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total Resolvido Tickets';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Média respostas';
$string['report_response_reports_page_description'] = 'Relatório: respostas Ticket.';
$string['report_response_reports_page_title'] = 'Relatórios respostas';
$string['report_status_priority_reports_page_description'] = 'Relatório: Estado Prioridade Ticket.';
$string['report_status_priority_reports_page_title'] = 'Relatórios Estado Prioridade';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Prioridade distribuição';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets Estado';
$string['report_tickets_reports_page_description'] = 'Relatório: Tickets Aberto / Fechado.';
$string['report_tickets_reports_page_title'] = 'Tickets';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Usuário';
$string['report_user_reports_page_description'] = 'Relatório: Usuários Tickets.';
$string['report_user_reports_page_title'] = 'Relatórios Usuários';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Usuários Tickets Aberto';
$string['savecategory'] = 'Salvar Categoria';
$string['savechanges'] = 'Salvar alterações';
$string['setting_course'] = 'Mostrar apenas dentro do curso';
$string['setting_knowledgebase_menu_description'] = 'Ative esta opção para mostrar o link da base de conhecimento no menu de navegação.';
$string['setting_knowledgebase_menu_title'] = 'Display Base de conhecimento em Menu';
$string['setting_menu_description'] = 'Selecione se deseja mostrar o menu HelpDesk no menu do sistema no topo do Moodle.';
$string['setting_menu_title'] = 'Mostrar no menu';
$string['setting_none'] = 'Não mostrar';
$string['setting_system'] = 'Mostrar em todo o sistema';
$string['status'] = 'Estado';
$string['status_all'] = 'Todos Tickets';
$string['status_closed'] = 'Fechado';
$string['status_open'] = 'Aberto';
$string['status_progress'] = 'Em progresso';
$string['status_resolved'] = 'Resolvido';
$string['subject'] = 'Assunto';
$string['ticketcategory'] = 'Ticket Categoria';
$string['ticketcategoryshort'] = 'Categoria';
$string['ticketclosed'] = 'O ticket está fechado.';
$string['ticketcreated'] = 'Ticket criada com sucesso';
$string['ticketcreatedat'] = 'Data de criação';
$string['ticketdescription'] = 'Ticket Descrição';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Mensagem';
$string['ticketnotfound'] = 'Ticket não encontrada';
$string['ticketpriority'] = 'Ticket Prioridade';
$string['ticketpriorityhigh'] = 'Alta';
$string['ticketprioritylow'] = 'Baixa';
$string['ticketprioritymedium'] = 'Média';
$string['ticketpriorityshort'] = 'Prioridade';
$string['ticketpriorityurgent'] = 'Urgente';
$string['ticketresponse'] = 'resposta Ticket';
$string['ticketresponseandclose'] = 'resposta Ticket Fechado';
$string['ticketresponseandresolved'] = 'resposta Ticket Resolvido';
$string['tickets'] = 'Todos Tickets';
$string['ticketslist'] = 'Lista Tickets';
$string['ticketstatus'] = 'Ticket Estado';
$string['ticketstatusclosed'] = 'Fechado';
$string['ticketstatusinprogress'] = 'Em progresso';
$string['ticketstatusnotclosed'] = 'Todos exceto Fechado';
$string['ticketstatusopen'] = 'Aberto';
$string['ticketstatusresolved'] = 'Resolvido';
$string['ticketstatusshort'] = 'Estado';
$string['ticketsubject'] = 'Ticket Assunto';
$string['ticketupdated'] = 'Ticket atualizada com sucesso';
$string['updatecategory'] = 'Atualizar Categoria';
$string['userid'] = 'ID Usuário';
$string['viewticket'] = 'Ver Ticket';
