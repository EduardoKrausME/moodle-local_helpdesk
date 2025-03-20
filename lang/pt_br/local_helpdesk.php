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
 * phpcs:disable
 *
 * file
 *
 * @package   local_helpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addcategory'] = 'Adicionar Nova Categoria';
$string['addticket'] = 'Adicionar Chamado';
$string['attachment'] = 'Anexos';
$string['cancel'] = 'Cancelar';
$string['categories'] = 'Categorias de Chamados';
$string['categorieslist'] = 'Lista de Categorias';
$string['category'] = 'Categoria';
$string['category_role_description'] = 'Função específica para controlar o acesso do usuário à gestão de chamados.';
$string['category_users_all'] = 'Todos os usuários do Moodle';
$string['category_users_info'] = 'Primeiro, salve a categoria antes de editar os usuários.';
$string['category_users_responses'] = 'Usuários que respondem a esta categoria';
$string['category_users_title'] = 'Define os usuários com permissão para responder e que receberão um e-mail sobre novos chamados';
$string['categoryadded'] = 'Categoria adicionada com sucesso';
$string['categorycreated'] = 'Categoria criada com sucesso';
$string['categorydeleted'] = 'Categoria excluída com sucesso';
$string['categorydescription'] = 'Descrição da Categoria';
$string['categoryname'] = 'Nome da Categoria';
$string['categorynotfound'] = 'Categoria não encontrada';
$string['categoryupdated'] = 'Categoria atualizada com sucesso';
$string['comments'] = 'Comentários';
$string['confirmdelete'] = 'Tem certeza de que deseja excluir esta categoria?';
$string['confirmdeletecategory'] = 'Tem certeza de que deseja excluir esta categoria?';
$string['createcategory'] = 'Criar Categoria';
$string['createcategoryfirst'] = 'Primeiro, crie uma categoria';
$string['createticket'] = 'Criar Chamado';
$string['deletecategory'] = 'Excluir Categoria';
$string['deletecategoryusedata'] = 'Esta categoria possui dados';
$string['deletesuccesscategory'] = 'Categoria excluída com sucesso';
$string['description'] = 'Descrição';
$string['editcategory'] = 'Editar Categoria';
$string['editticket'] = 'Editar Chamado';
$string['error:emptyname'] = 'O nome da categoria não pode estar vazio';
$string['erroraddcategory'] = 'Erro ao adicionar categoria';
$string['errordeletecategory'] = 'Erro ao excluir categoria';
$string['errorinsertingcategory'] = 'Erro ao adicionar categoria';
$string['errorinsertingticket'] = 'Erro ao inserir chamado';
$string['errorupdatecategory'] = 'Erro ao atualizar categoria';
$string['errorupdatingcategory'] = 'Erro ao atualizar categoria';
$string['errorupdatingticket'] = 'Erro ao atualizar chamado';
$string['findcourse'] = 'Selecionar um Curso';
$string['finduser'] = 'Selecionar um Usuário';
$string['geniai_btn_response_create'] = 'Criar uma resposta com IA';
$string['geniai_create_response_desc'] = 'Descreva o que deseja gerar. O GeniAI usará todas as conversas como base para criar uma resposta, mas você precisa definir quais dados deseja escrever.';
$string['geniai_create_response_message'] = 'Criar uma mensagem com base no texto acima.';
$string['geniai_like_message'] = 'Gostou da mensagem? Clique aqui para fechar e enviá-la ao Editor.';
$string['geniai_missing'] = 'Instale e configure o plugin <a href="{$a}" target="_blank">GenIA</a> para habilitar respostas com IA.';

$string['geniai_ticket_prompt_1'] = 'Você é um chatbot que sugere respostas para tickets do Moodle a fim de resolver problemas de cursos ou da plataforma de forma alegre, envolvente e na primeira pessoa.
Você adora responder com mensagens inspiradoras, evitando listas e fornecendo explicações detalhadas, sempre muito atento aos detalhes.

Pergunta do usuário {$a->userfullname}: "{$a->userticket}"

Agora, crie uma resposta explicando como resolver o seguinte problema usando as instruções fornecidas pelo Suporte:
"{$a->message}"

Retorne apenas no idioma "{$a->userlang}" e somente no formato MARKDOWN.';

$string['geniai_ticket_prompt_2'] = 'Você é um chatbot que sugere respostas para tickets do Moodle a fim de resolver problemas de cursos ou da plataforma de forma alegre, envolvente e na primeira pessoa.
Você adora responder com mensagens inspiradoras, evitando listas e fornecendo explicações detalhadas, sempre muito atento aos detalhes.

Agora, crie uma resposta explicando como resolver o seguinte problema:

Pergunta do usuário {$a->userfullname}: "{$a->userticket}"';

$string['geniai_ticket_prompt_3'] = 'Você é um chatbot que sugere respostas para tickets do Moodle a fim de resolver problemas de cursos ou da plataforma de forma alegre, envolvente e na primeira pessoa.
Você adora responder com mensagens inspiradoras, evitando listas e fornecendo explicações detalhadas, sempre muito atento aos detalhes.

Agora, com base neste histórico, crie uma resposta usando as instruções fornecidas pelo Suporte:
"{$a->message}"

Retorne apenas no idioma "{$a->userlang}" e somente no formato MARKDOWN.';

$string['geniai_ticket_prompt_4'] = 'Você é um chatbot que sugere respostas para tickets do Moodle a fim de resolver problemas de cursos ou da plataforma de forma alegre, envolvente e na primeira pessoa.
Você adora responder com mensagens inspiradoras, evitando listas e fornecendo explicações detalhadas, sempre muito atento aos detalhes.

Agora, com base neste histórico, crie uma resposta e retorne apenas no idioma "{$a->userlang}" e somente no formato MARKDOWN.';

$string['geniai_title'] = 'Inteligência Artificial';
$string['helpdesk:categorydelete'] = 'Permite excluir categorias.';
$string['helpdesk:categorymanage'] = 'Permite gerenciar as categorias do Helpdesk.';
$string['helpdesk:ticketmanage'] = 'Permite gerenciar o Helpdesk, incluindo responder e fechar tickets.';
$string['helpdesk:view'] = 'Permite visualizar tickets do Helpdesk e criar novos para si mesmo.';
$string['helpdesk_manage_users'] = 'Visualizar usuários com permissão para gerenciar esta categoria de função';
$string['index_top_all_open_tickets'] = 'Todos os Tickets Abertos';
$string['index_top_completed_tickets'] = 'Tickets Concluídos';
$string['index_top_unanswered_tickets'] = 'Tickets Sem Resposta';
$string['index_top_urgent_tickets'] = 'Tickets Urgentes';
$string['integracaoroot'] = 'Integração';
$string['invalidpriority'] = 'Prioridade inválida selecionada.';
$string['lognewcategory'] = 'Categoria alterada para <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Prioridade alterada para <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Status alterado para <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Nenhuma alteração realizada!';

$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Prezado(a) {[to.fullname]},</p>
<p>{[from.fullname]} criou o ticket #{[event.tiketidlink]}:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>Atenciosamente,<br>
Equipe de Suporte</p>';

$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';

$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Prezado(a) {[to.fullname]},</p>
<p>Nossa equipe revisou seu caso e adicionou novas informações:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>Por favor, acesse o ticket #{[event.tiketidlink]} para visualizar a atualização e fornecer mais detalhes, se necessário. Estamos disponíveis para continuar ajudando e resolver sua solicitação o mais rápido possível.</p>
<p>Atenciosamente,<br>
Equipe de Suporte</p>';

$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Prezado(a) {[to.fullname]},</p>
<p>Recebemos sua solicitação:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>Se ainda não o fez, você pode adicionar mais detalhes ao seu ticket #{[event.tiketidlink]}, como logs, mensagens de erro, capturas de tela, descrições passo a passo ou etapas de reprodução que possam ajudar o agente de suporte a auxiliá-lo(a) de forma mais eficaz.</p>
<p>Nossa equipe está analisando o seu problema e seguirá com os próximos passos conforme necessário. Agradecemos sua paciência e compreensão.</p>
<p>Atenciosamente,<br>
Equipe de Suporte</p>';

$string['markticketasclosed'] = 'Marcar Ticket como Fechado';
$string['markticketasresolved'] = 'Marcar Ticket como Resolvido';
$string['openuserby'] = 'Aberto por';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Prioridade';
$string['priority_high'] = 'Alta';
$string['priority_low'] = 'Baixa';
$string['priority_medium'] = 'Média';
$string['priority_urgent'] = 'Urgente';
$string['privacy:metadata:category_user_userid'] = 'Identificador único do usuário atribuído a uma categoria específica dentro do sistema de suporte.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Informações sobre usuários atribuídos a categorias de tickets para fins organizacionais e de gestão.';
$string['privacy:metadata:local_helpdesk_response'] = 'Informações sobre as respostas fornecidas aos tickets, incluindo o conteúdo da resposta e o usuário responsável por ela.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Informações sobre os tickets criados no sistema, incluindo dados do usuário, categoria, status e histórico de respostas.';
$string['privacy:metadata:response_userid'] = 'Identificador único do usuário que forneceu uma resposta a um ticket dentro do sistema de suporte.';
$string['privacy:metadata:ticket_userid'] = 'Identificador único do usuário que criou ou gerenciou um ticket no sistema de suporte.';
$string['replytoticket'] = 'Responder ao ticket';
$string['report_assignment_reports_page_description'] = 'Relatório sobre a distribuição de tickets e desempenho dos agentes atribuídos.';
$string['report_assignment_reports_page_title'] = 'Relatórios de Atribuição';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets por Agente';
$string['report_category_reports_avg_resolution_time_by_category_cat_title'] = 'Tempo Médio de Resolução por Categoria';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Categorias Mais Demandadas';
$string['report_category_reports_page_description'] = 'Relatório sobre categorias de tickets, ajudando a identificar as áreas de suporte mais frequentes e problemas comuns.';
$string['report_category_reports_page_title'] = 'Relatórios de Categoria';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Tempo médio de resposta';
$string['report_general_reports_avg_resolution_time_cat_title'] = 'Tempo Médio de Resolução';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total de tickets';
$string['report_general_reports_avg_time_first_response_avg_response_time'] = 'Tempo médio';
$string['report_general_reports_avg_time_first_response_cat_title'] = 'Tempo médio entre a criação do ticket e a primeira resposta';
$string['report_general_reports_page_description'] = 'Relatório geral sobre tickets abertos e fechados, fornecendo uma visão geral do desempenho do sistema de atendimento ao cliente.';
$string['report_general_reports_page_title'] = 'Relatórios Gerais';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Criados por Período';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Data de criação';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total de tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Resolvidos por Período';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Período';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total de tickets resolvidos';
$string['report_response_reports_avg_responses_per_ticket_cat_title'] = 'Média de Respostas por Ticket';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Média de respostas';
$string['report_response_reports_page_description'] = 'Relatório sobre respostas fornecidas aos tickets, incluindo tempo de resposta e interações dos agentes.';
$string['report_response_reports_page_title'] = 'Relatórios de Respostas';
$string['report_status_priority_reports_page_description'] = 'Relatório sobre status e prioridade dos tickets, incluindo dados sobre tickets abertos, em andamento, resolvidos e fechados.';
$string['report_status_priority_reports_page_title'] = 'Relatórios de Status e Prioridade';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Distribuição de Prioridade';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets por Status';
$string['report_user_reports_avg_response_time_by_user_cat_title'] = 'Tempo Médio de Resposta por Usuário';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID do Usuário';
$string['report_user_reports_page_description'] = 'Relatório sobre os usuários que criaram mais tickets, incluindo dados sobre o número de tickets e tempo de resposta associado.';
$string['report_user_reports_page_title'] = 'Relatórios de Usuário';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Usuários com Mais Tickets Abertos';
$string['report_user_reports_users_with_most_tickets_open_userid'] = 'ID do Usuário';
$string['savechanges'] = 'Salvar Alterações';
$string['setting_course'] = 'Mostrar apenas dentro do curso';
$string['setting_menu_description'] = 'Selecione se deseja exibir o menu do HelpDesk no menu superior do Moodle.';
$string['setting_menu_title'] = 'Mostrar no menu';
$string['setting_none'] = 'Não mostrar';
$string['setting_system'] = 'Mostrar em todo o sistema';
$string['status'] = 'Status';
$string['status_closed'] = 'Fechado';
$string['status_open'] = 'Aberto';
$string['status_progress'] = 'Em Andamento';
$string['status_resolved'] = 'Resolvido';
$string['subject'] = 'Assunto';
$string['ticketcategory'] = 'Categoria do Ticket';
$string['ticketclosed'] = 'O ticket está fechado.';
$string['ticketcreated'] = 'Ticket criado com sucesso';
$string['ticketcreatedat'] = 'Criado em';
$string['ticketdescription'] = 'Descrição Detalhada do Ticket';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Mensagem';
$string['ticketnotfound'] = 'Ticket não encontrado';
$string['ticketpriority'] = 'Prioridade do Ticket';
$string['ticketpriorityhigh'] = 'Alta';
$string['ticketprioritylow'] = 'Baixa';
$string['ticketprioritymedium'] = 'Média';
$string['ticketpriorityurgent'] = 'Urgente';
$string['ticketresponse'] = 'Responder ao ticket';
$string['ticketresponseandclose'] = 'Responder ao ticket e fechar';
$string['ticketresponseandresolved'] = 'Responder ao ticket e marcar como resolvido';
$string['tickets'] = 'Todos os Tickets';
$string['ticketslist'] = 'Lista de Tickets';
$string['ticketstatus'] = 'Status do Ticket';
$string['ticketstatusclosed'] = 'Fechado';
$string['ticketstatusinprogress'] = 'Em Andamento';
$string['ticketstatusnotclosed'] = 'Todos, exceto Fechado';
$string['ticketstatusopen'] = 'Aberto';
$string['ticketstatusresolved'] = 'Resolvido';
$string['ticketsubject'] = 'Assunto do Ticket';
$string['ticketupdated'] = 'Ticket atualizado com sucesso';
$string['updatecategory'] = 'Atualizar Categoria';
$string['userid'] = 'ID do Usuário';
$string['viewticket'] = 'Visualizar Ticket';


$string['geniai_btn_knowledgebase_create'] = 'Criar uma base de conhecimento com IA';
$string['geniai_create_knowledgebase_desc'] = 'Descreva detalhadamente o conteúdo que deseja gerar. O GeniAI usará essas informações para criar um texto preciso e relevante para sua base de conhecimento.';
$string['geniai_create_knowledgebase_message'] = 'Crie uma mensagem com base no texto acima.';
$string['knowledgebase_name'] = 'Base de conhecimento';
$string['knowledgebase_title'] = 'Título do conhecimento';
$string['knowledgebase_description'] = 'Conteúdo do conhecimento';
$string['knowledgebase_articlenotfound'] = 'Base não encontrado';
$string['knowledgebase_update'] = 'Atualizar';
$string['knowledgebase_category'] = 'Categoria';
$string['knowledgebase_create'] = 'Criar base de conhecimento';
$string['knowledgebase_edit'] = 'Editar base de conhecimento';
$string['knowledgebase_prompt_short'] = 'Prompt too short';
$string['knowledgebase_addnew'] = 'Adicionar nova base de conhecimento';
$string['knowledgebase_delete'] = 'Excluir Base de conhecimento';
$string['knowledgebase_delete_success'] = 'Base de conhecimento excluído com sucesso';
$string['knowledgebase_delete_confirm'] = 'Deseja mesmo excluir a Base de conhecimento <strong>{$a}</strong>';
