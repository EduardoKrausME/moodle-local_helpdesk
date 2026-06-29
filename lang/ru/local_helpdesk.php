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

$string['addcategory'] = 'Добавить Новая Категория';
$string['addticket'] = 'Добавить Заявка';
$string['attachment'] = 'Вложения';
$string['avg_closing_time'] = 'Среднее Закрыта';
$string['avg_first_response_time'] = 'Среднее ответ';
$string['cancel'] = 'Отмена';
$string['categories'] = 'Категории Заявки';
$string['categorieslist'] = 'Список Категории';
$string['category'] = 'Категория';
$string['category_role_description'] = 'Специальная роль для управления доступом пользователей к управлению заявками.';
$string['category_users_all'] = 'Все пользователи Moodle';
$string['category_users_info'] = 'Сначала сохраните категорию перед редактированием пользователей.';
$string['category_users_responses'] = 'Пользователи, отвечающие на эту категорию';
$string['category_users_title'] = 'Определяет пользователей с правом отвечать и получать письма о новых заявках';
$string['categoryadded'] = 'Категория успешно добавлена';
$string['categorycreated'] = 'Категория успешно создана';
$string['categorydeleted'] = 'Категория успешно удалена';
$string['categorydescription'] = 'Категория Описание';
$string['categoryname'] = 'Категория Название';
$string['categorynotfound'] = 'Категория не найдена';
$string['categoryupdated'] = 'Категория успешно обновлена';
$string['comments'] = 'Комментарии';
$string['confirmdelete'] = 'Вы уверены, что хотите удалить эту категорию?';
$string['confirmdeletecategory'] = 'Вы уверены, что хотите удалить эту категорию?';
$string['confirmdeleteticket'] = 'Вы уверены, что хотите навсегда удалить заявку "{$a}"? Все ответы и вложения, связанные с этой заявкой, также будут удалены.';
$string['createcategory'] = 'Создать Категория';
$string['createcategoryfirst'] = 'Создать Категория';
$string['createticket'] = 'Создать Заявка';
$string['deletecategory'] = 'Удалить Категория';
$string['deletecategoryusedata'] = 'Эта категория содержит данные';
$string['deletesuccesscategory'] = 'Категория успешно удалена';
$string['deletesuccessticket'] = 'Заявка успешно удалена.';
$string['deleteticket'] = 'Удалить Заявка';
$string['description'] = 'Описание';
$string['editcategory'] = 'Редактировать Категория';
$string['editticket'] = 'Редактировать Заявка';
$string['error:emptyname'] = 'Название категории не может быть пустым';
$string['erroraddcategory'] = 'Ошибка Добавить Категория';
$string['errordeletecategory'] = 'Ошибка Удалить Категория';
$string['errorinsertingcategory'] = 'Ошибка Добавить Категория';
$string['errorinsertingticket'] = 'Ошибка Заявка';
$string['errorupdatecategory'] = 'Ошибка Обновить Категория';
$string['errorupdatingcategory'] = 'Ошибка Обновить Категория';
$string['errorupdatingticket'] = 'Ошибка Обновить Заявка';
$string['exportstatusfilter'] = 'Экспортировать Статус';
$string['exporttickets'] = 'Экспортировать Заявки';
$string['findcourse'] = 'Выбрать Курс';
$string['findticket'] = 'Искать Тема текст';
$string['finduser'] = 'Выбрать Пользователь';
$string['geniai_btn_knowledgebase_create'] = 'Создать базу знаний с помощью ИИ';
$string['geniai_btn_response_create'] = 'Создать ответ с помощью ИИ';
$string['geniai_create_knowledgebase_desc'] = 'Подробно опишите содержимое, которое вы хотите сгенерировать. GeniAI использует эту информацию для создания точного и релевантного текста для базы знаний.';
$string['geniai_create_knowledgebase_message'] = 'Создайте сообщение на основе текста выше.';
$string['geniai_create_response_desc'] = 'Опишите, что вы хотите сгенерировать. GeniAI использует все разговоры как основу для создания ответа, но вам нужно определить, какие данные следует написать.';
$string['geniai_create_response_message'] = 'Создайте сообщение на основе текста выше.';
$string['geniai_knowledgebase_prompt'] = 'Вы — чат-бот для создания баз знаний Moodle. Создавайте понятный, структурированный и профессиональный контент от первого лица.\\n\\nСоздайте статью базы знаний о:\\nНазвание Moodle: "{$a->site_fullname}"\\nURL Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nВерните ответ только на языке "{$a->userlang}", без заголовков и только в MARKDOWN.';
$string['geniai_like_message'] = 'Понравилось сообщение? Нажмите здесь, чтобы закрыть и отправить его в редактор.';
$string['geniai_missing'] = 'Установите и настройте плагин <a href="{$a}" target="_blank">GenIA</a>, чтобы включить ответы на основе ИИ.';
$string['geniai_ticket_prompt_1'] = 'Вы — чат-бот, предлагающий понятные и дружелюбные ответы на заявки Moodle от первого лица.\\n\\nВопрос пользователя {$a->userfullname}: "{$a->userticket}"\\n\\nСоздать ответ используя инструкции, предоставленные службой поддержки:\\n"{$a->message}"\\n\\nВерните ответ только на языке "{$a->userlang}" и только в MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Вы — чат-бот, предлагающий понятные и дружелюбные ответы на заявки Moodle от первого лица.\\n\\nСоздать ответ:\\n\\nВопрос пользователя {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Вы — чат-бот, предлагающий понятные и дружелюбные ответы на заявки Moodle от первого лица.\\n\\nСоздать ответ на основе этой истории используя инструкции, предоставленные службой поддержки:\\n"{$a->message}"\\n\\nВерните ответ только на языке "{$a->userlang}" и только в MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Вы — чат-бот, предлагающий понятные и дружелюбные ответы на заявки Moodle от первого лица.\\n\\nСоздать ответ на основе этой истории.\\n\\nВерните ответ только на языке "{$a->userlang}" и только в MARKDOWN.';
$string['geniai_title'] = 'Искусственный интеллект';
$string['helpdesk:categorydelete'] = 'Разрешает удалять категории.';
$string['helpdesk:categorymanage'] = 'Разрешает управлять категориями Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Удалять статьи в базе знаний.';
$string['helpdesk:knowledgebase_manage'] = 'Управлять статьями в базе знаний.';
$string['helpdesk:knowledgebase_view'] = 'Просматривать статьи в базе знаний.';
$string['helpdesk:ticketmanage'] = 'Разрешает управлять Helpdesk, включая ответы и закрытие заявок.';
$string['helpdesk:view'] = 'Разрешает просматривать заявки Helpdesk и создавать их для себя.';
$string['helpdesk_manage_users'] = 'Просмотреть пользователей с правом управления этой категорией роли';
$string['index_top_all_open_tickets'] = 'All Открыта Заявки';
$string['index_top_completed_tickets'] = 'Завершенные Заявки';
$string['index_top_unanswered_tickets'] = 'Без ответа Заявки';
$string['index_top_urgent_tickets'] = 'Срочный Заявки';
$string['integracaoroot'] = 'Интеграция';
$string['invalidpriority'] = 'Выбран недопустимый приоритет.';
$string['knowledgebase_addnew'] = 'Добавить Новая База знаний';
$string['knowledgebase_articlenotfound'] = 'База знаний не найдена';
$string['knowledgebase_category'] = 'Категория';
$string['knowledgebase_create'] = 'Создать База знаний';
$string['knowledgebase_delete'] = 'Удалить База знаний';
$string['knowledgebase_delete_confirm'] = 'Вы уверены, что хотите удалить базу знаний <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'База знаний успешно удалена';
$string['knowledgebase_description'] = 'Содержимое базы знаний';
$string['knowledgebase_edit'] = 'Редактировать База знаний';
$string['knowledgebase_name'] = 'База знаний';
$string['knowledgebase_prompt_short'] = 'Промпт слишком короткий';
$string['knowledgebase_title'] = 'Заголовок знания';
$string['knowledgebase_update'] = 'Обновить';
$string['lognewcategory'] = 'Категория changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Приоритет changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Статус changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Изменения не внесены!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Заявка <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Здравствуйте {[to.fullname]},</p>\\n<p>{[from.fullname]} Создать Заявка #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>С уважением,<br>\\nКоманда поддержки</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Заявка: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Заявка <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Здравствуйте {[to.fullname]},</p>\\n<p>Команда поддержки: Обновить.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Просмотреть Заявка #{[event.tiketidlink]}.</p>\\n<p>С уважением,<br>\\nКоманда поддержки</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Заявка <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Здравствуйте {[to.fullname]},</p>\\n<p>Команда поддержки: Сообщение</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Просмотреть Заявка #{[event.tiketidlink]}.</p>\\n<p>С уважением,<br>\\nКоманда поддержки</p>';
$string['markticketasclosed'] = 'Заявка Закрыта';
$string['markticketasresolved'] = 'Заявка Решена';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Приоритет';
$string['priority_high'] = 'Высокий';
$string['priority_low'] = 'Низкий';
$string['priority_medium'] = 'Средний';
$string['priority_urgent'] = 'Срочный';
$string['privacy:metadata:category_user_userid'] = 'ID Пользователь - Категория.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Пользователи - Категории Заявка.';
$string['privacy:metadata:local_helpdesk_response'] = 'ответы - Заявка.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Заявки - Пользователь, Категория, Статус.';
$string['privacy:metadata:response_userid'] = 'ID Пользователь - ответ Заявка.';
$string['privacy:metadata:ticket_userid'] = 'ID Пользователь - Заявка.';
$string['replytoticket'] = 'ответ Заявка';
$string['report_assignment_reports_page_description'] = 'Отчет: Заявки / Пользователи.';
$string['report_assignment_reports_page_title'] = 'Отчеты - назначения';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Заявки Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Категории Срочный';
$string['report_category_reports_page_description'] = 'Отчет: Категории Заявка.';
$string['report_category_reports_page_title'] = 'Отчеты Категории';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Среднее ответ';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Всего Заявки';
$string['report_general_reports_page_title'] = 'Отчеты';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Заявки Создать Период';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Дата создания';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Всего Заявки';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Заявки Решена Период';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Период';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Всего Решена Заявки';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Среднее ответы';
$string['report_response_reports_page_description'] = 'Отчет: ответы Заявка.';
$string['report_response_reports_page_title'] = 'Отчеты ответы';
$string['report_status_priority_reports_page_description'] = 'Отчет: Статус Приоритет Заявка.';
$string['report_status_priority_reports_page_title'] = 'Отчеты Статус Приоритет';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Приоритет distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Заявки Статус';
$string['report_tickets_reports_page_description'] = 'Отчет: Заявки Открыта / Закрыта.';
$string['report_tickets_reports_page_title'] = 'Заявки';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Пользователь';
$string['report_user_reports_page_description'] = 'Отчет: Пользователи Заявки.';
$string['report_user_reports_page_title'] = 'Отчеты Пользователи';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Пользователи Заявки Открыта';
$string['savecategory'] = 'Сохранить Категория';
$string['savechanges'] = 'Сохранить изменения';
$string['setting_course'] = 'Показывать только внутри курса';
$string['setting_knowledgebase_menu_description'] = 'Включите эту опцию, чтобы отображать ссылку на базу знаний в меню навигации.';
$string['setting_knowledgebase_menu_title'] = 'Display База знаний in Menu';
$string['setting_menu_description'] = 'Выберите, показывать ли меню HelpDesk в системном меню в верхней части Moodle.';
$string['setting_menu_title'] = 'Показывать в меню';
$string['setting_none'] = 'Не показывать';
$string['setting_system'] = 'Показывать во всей системе';
$string['status'] = 'Статус';
$string['status_all'] = 'Все Заявки';
$string['status_closed'] = 'Закрыта';
$string['status_open'] = 'Открыта';
$string['status_progress'] = 'В работе';
$string['status_resolved'] = 'Решена';
$string['subject'] = 'Тема';
$string['ticketcategory'] = 'Заявка Категория';
$string['ticketcategoryshort'] = 'Категория';
$string['ticketclosed'] = 'Заявка закрыта.';
$string['ticketcreated'] = 'Заявка успешно создана';
$string['ticketcreatedat'] = 'Дата создания';
$string['ticketdescription'] = 'Заявка Описание';
$string['ticketid'] = 'Заявка';
$string['ticketmessage'] = 'Сообщение';
$string['ticketnotfound'] = 'Заявка не найдена';
$string['ticketpriority'] = 'Заявка Приоритет';
$string['ticketpriorityhigh'] = 'Высокий';
$string['ticketprioritylow'] = 'Низкий';
$string['ticketprioritymedium'] = 'Средний';
$string['ticketpriorityshort'] = 'Приоритет';
$string['ticketpriorityurgent'] = 'Срочный';
$string['ticketresponse'] = 'ответ Заявка';
$string['ticketresponseandclose'] = 'ответ Заявка Закрыта';
$string['ticketresponseandresolved'] = 'ответ Заявка Решена';
$string['tickets'] = 'Все Заявки';
$string['ticketslist'] = 'Список Заявки';
$string['ticketstatus'] = 'Заявка Статус';
$string['ticketstatusclosed'] = 'Закрыта';
$string['ticketstatusinprogress'] = 'В работе';
$string['ticketstatusnotclosed'] = 'Все except Закрыта';
$string['ticketstatusopen'] = 'Открыта';
$string['ticketstatusresolved'] = 'Решена';
$string['ticketstatusshort'] = 'Статус';
$string['ticketsubject'] = 'Заявка Тема';
$string['ticketupdated'] = 'Заявка успешно обновлена';
$string['updatecategory'] = 'Обновить Категория';
$string['userid'] = 'ID Пользователь';
$string['viewticket'] = 'Просмотреть Заявка';
