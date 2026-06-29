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

$string['addcategory'] = 'Додати Нова Категорія';
$string['addticket'] = 'Додати Звернення';
$string['attachment'] = 'Вкладення';
$string['avg_closing_time'] = 'Середнє Закрито';
$string['avg_first_response_time'] = 'Середнє відповідь';
$string['cancel'] = 'Скасувати';
$string['categories'] = 'Категорії Звернення';
$string['categorieslist'] = 'Список Категорії';
$string['category'] = 'Категорія';
$string['category_role_description'] = 'Спеціальна роль для керування доступом користувачів до управління зверненнями.';
$string['category_users_all'] = 'Усі користувачі Moodle';
$string['category_users_info'] = 'Спочатку збережіть категорію перед редагуванням користувачів.';
$string['category_users_responses'] = 'Користувачі, які відповідають на цю категорію';
$string['category_users_title'] = 'Визначає користувачів із дозволом відповідати та отримувати електронні листи про нові звернення';
$string['categoryadded'] = 'Категорія успішно додана';
$string['categorycreated'] = 'Категорія успішно створена';
$string['categorydeleted'] = 'Категорія успішно видалена';
$string['categorydescription'] = 'Категорія Опис';
$string['categoryname'] = 'Категорія Назва';
$string['categorynotfound'] = 'Категорія не знайдена';
$string['categoryupdated'] = 'Категорія успішно оновлена';
$string['comments'] = 'Коментарі';
$string['confirmdelete'] = 'Ви впевнені, що хочете видалити цю категорію?';
$string['confirmdeletecategory'] = 'Ви впевнені, що хочете видалити цю категорію?';
$string['confirmdeleteticket'] = 'Ви впевнені, що хочете назавжди видалити звернення "{$a}"? Усі відповіді та вкладення, пов’язані з цим зверненням, також буде видалено.';
$string['createcategory'] = 'Створити Категорія';
$string['createcategoryfirst'] = 'Створити Категорія';
$string['createticket'] = 'Створити Звернення';
$string['deletecategory'] = 'Видалити Категорія';
$string['deletecategoryusedata'] = 'Ця категорія містить дані';
$string['deletesuccesscategory'] = 'Категорія успішно видалена';
$string['deletesuccessticket'] = 'Звернення успішно видалена.';
$string['deleteticket'] = 'Видалити Звернення';
$string['description'] = 'Опис';
$string['editcategory'] = 'Редагувати Категорія';
$string['editticket'] = 'Редагувати Звернення';
$string['error:emptyname'] = 'Назва категорії не може бути порожньою';
$string['erroraddcategory'] = 'Помилка Додати Категорія';
$string['errordeletecategory'] = 'Помилка Видалити Категорія';
$string['errorinsertingcategory'] = 'Помилка Додати Категорія';
$string['errorinsertingticket'] = 'Помилка Звернення';
$string['errorupdatecategory'] = 'Помилка Оновити Категорія';
$string['errorupdatingcategory'] = 'Помилка Оновити Категорія';
$string['errorupdatingticket'] = 'Помилка Оновити Звернення';
$string['exportstatusfilter'] = 'Експортувати Статус';
$string['exporttickets'] = 'Експортувати Звернення';
$string['findcourse'] = 'Вибрати Курс';
$string['findticket'] = 'Шукати Тема текст';
$string['finduser'] = 'Вибрати Користувач';
$string['geniai_btn_knowledgebase_create'] = 'Створити базу знань за допомогою ШІ';
$string['geniai_btn_response_create'] = 'Створити відповідь за допомогою ШІ';
$string['geniai_create_knowledgebase_desc'] = 'Детально опишіть вміст, який потрібно згенерувати. GeniAI використає цю інформацію для створення точного й релевантного тексту для бази знань.';
$string['geniai_create_knowledgebase_message'] = 'Створіть повідомлення на основі тексту вище.';
$string['geniai_create_response_desc'] = 'Опишіть, що потрібно згенерувати. GeniAI використає всі розмови як основу для створення відповіді, але вам потрібно визначити, які дані слід написати.';
$string['geniai_create_response_message'] = 'Створіть повідомлення на основі тексту вище.';
$string['geniai_knowledgebase_prompt'] = 'Ви — чат-бот для створення баз знань Moodle. Створюйте зрозумілий, структурований і професійний контент від першої особи.\\n\\nСтворіть статтю бази знань про:\\nНазва Moodle: "{$a->site_fullname}"\\nURL Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nПоверніть відповідь лише мовою "{$a->userlang}", без заголовків і тільки в MARKDOWN.';
$string['geniai_like_message'] = 'Сподобалося повідомлення? Натисніть тут, щоб закрити та надіслати його до редактора.';
$string['geniai_missing'] = 'Встановіть і налаштуйте плагін <a href="{$a}" target="_blank">GenIA</a>, щоб увімкнути відповіді на основі ШІ.';
$string['geniai_ticket_prompt_1'] = 'Ви — чат-бот, який пропонує зрозумілі й дружні відповіді на звернення Moodle від першої особи.\\n\\nЗапитання користувача {$a->userfullname}: "{$a->userticket}"\\n\\nСтворити відповідь використовуючи інструкції від підтримки:\\n"{$a->message}"\\n\\nПоверніть відповідь лише мовою "{$a->userlang}" і тільки в MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Ви — чат-бот, який пропонує зрозумілі й дружні відповіді на звернення Moodle від першої особи.\\n\\nСтворити відповідь:\\n\\nЗапитання користувача {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Ви — чат-бот, який пропонує зрозумілі й дружні відповіді на звернення Moodle від першої особи.\\n\\nСтворити відповідь на основі цієї історії використовуючи інструкції від підтримки:\\n"{$a->message}"\\n\\nПоверніть відповідь лише мовою "{$a->userlang}" і тільки в MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Ви — чат-бот, який пропонує зрозумілі й дружні відповіді на звернення Moodle від першої особи.\\n\\nСтворити відповідь на основі цієї історії.\\n\\nПоверніть відповідь лише мовою "{$a->userlang}" і тільки в MARKDOWN.';
$string['geniai_title'] = 'Штучний інтелект';
$string['helpdesk:categorydelete'] = 'Дозволяє видаляти категорії.';
$string['helpdesk:categorymanage'] = 'Дозволяє керувати категоріями Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Видаляти статті в базі знань.';
$string['helpdesk:knowledgebase_manage'] = 'Керувати статтями в базі знань.';
$string['helpdesk:knowledgebase_view'] = 'Переглядати статті в базі знань.';
$string['helpdesk:ticketmanage'] = 'Дозволяє керувати Helpdesk, зокрема відповідати на звернення та закривати їх.';
$string['helpdesk:view'] = 'Дозволяє переглядати звернення Helpdesk і створювати їх для себе.';
$string['helpdesk_manage_users'] = 'Переглянути користувачів із дозволом керувати цією категорією ролі';
$string['index_top_all_open_tickets'] = 'All Відкрито Звернення';
$string['index_top_completed_tickets'] = 'Завершені Звернення';
$string['index_top_unanswered_tickets'] = 'Без відповіді Звернення';
$string['index_top_urgent_tickets'] = 'Терміновий Звернення';
$string['integracaoroot'] = 'Інтеграція';
$string['invalidpriority'] = 'Вибрано недійсний пріоритет.';
$string['knowledgebase_addnew'] = 'Додати Нова База знань';
$string['knowledgebase_articlenotfound'] = 'База знань не знайдена';
$string['knowledgebase_category'] = 'Категорія';
$string['knowledgebase_create'] = 'Створити База знань';
$string['knowledgebase_delete'] = 'Видалити База знань';
$string['knowledgebase_delete_confirm'] = 'Ви впевнені, що хочете видалити базу знань <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'База знань успішно видалена';
$string['knowledgebase_description'] = 'Вміст бази знань';
$string['knowledgebase_edit'] = 'Редагувати База знань';
$string['knowledgebase_name'] = 'База знань';
$string['knowledgebase_prompt_short'] = 'Промпт занадто короткий';
$string['knowledgebase_title'] = 'Заголовок знання';
$string['knowledgebase_update'] = 'Оновити';
$string['lognewcategory'] = 'Категорія changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Пріоритет changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Статус changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Змін не внесено!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Звернення <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Вітаємо {[to.fullname]},</p>\\n<p>{[from.fullname]} Створити Звернення #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>З повагою,<br>\\nКоманда підтримки</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Звернення: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Звернення <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Вітаємо {[to.fullname]},</p>\\n<p>Команда підтримки: Оновити.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Переглянути Звернення #{[event.tiketidlink]}.</p>\\n<p>З повагою,<br>\\nКоманда підтримки</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Звернення <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Вітаємо {[to.fullname]},</p>\\n<p>Команда підтримки: Повідомлення</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Переглянути Звернення #{[event.tiketidlink]}.</p>\\n<p>З повагою,<br>\\nКоманда підтримки</p>';
$string['markticketasclosed'] = 'Звернення Закрито';
$string['markticketasresolved'] = 'Звернення Вирішено';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Пріоритет';
$string['priority_high'] = 'Високий';
$string['priority_low'] = 'Низький';
$string['priority_medium'] = 'Середній';
$string['priority_urgent'] = 'Терміновий';
$string['privacy:metadata:category_user_userid'] = 'ID Користувач - Категорія.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Користувачі - Категорії Звернення.';
$string['privacy:metadata:local_helpdesk_response'] = 'відповіді - Звернення.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Звернення - Користувач, Категорія, Статус.';
$string['privacy:metadata:response_userid'] = 'ID Користувач - відповідь Звернення.';
$string['privacy:metadata:ticket_userid'] = 'ID Користувач - Звернення.';
$string['replytoticket'] = 'відповідь Звернення';
$string['report_assignment_reports_page_description'] = 'Звіт: Звернення / Користувачі.';
$string['report_assignment_reports_page_title'] = 'Звіти - призначення';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Звернення Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Категорії Терміновий';
$string['report_category_reports_page_description'] = 'Звіт: Категорії Звернення.';
$string['report_category_reports_page_title'] = 'Звіти Категорії';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Середнє відповідь';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Усього Звернення';
$string['report_general_reports_page_title'] = 'Звіти';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Звернення Створити Період';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Дата створення';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Усього Звернення';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Звернення Вирішено Період';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Період';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Усього Вирішено Звернення';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Середнє відповіді';
$string['report_response_reports_page_description'] = 'Звіт: відповіді Звернення.';
$string['report_response_reports_page_title'] = 'Звіти відповіді';
$string['report_status_priority_reports_page_description'] = 'Звіт: Статус Пріоритет Звернення.';
$string['report_status_priority_reports_page_title'] = 'Звіти Статус Пріоритет';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Пріоритет distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Звернення Статус';
$string['report_tickets_reports_page_description'] = 'Звіт: Звернення Відкрито / Закрито.';
$string['report_tickets_reports_page_title'] = 'Звернення';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Користувач';
$string['report_user_reports_page_description'] = 'Звіт: Користувачі Звернення.';
$string['report_user_reports_page_title'] = 'Звіти Користувачі';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Користувачі Звернення Відкрито';
$string['savecategory'] = 'Зберегти Категорія';
$string['savechanges'] = 'Зберегти зміни';
$string['setting_course'] = 'Показувати лише всередині курсу';
$string['setting_knowledgebase_menu_description'] = 'Увімкніть цей параметр, щоб показувати посилання на базу знань у навігаційному меню.';
$string['setting_knowledgebase_menu_title'] = 'Display База знань in Menu';
$string['setting_menu_description'] = 'Виберіть, чи показувати меню HelpDesk у системному меню у верхній частині Moodle.';
$string['setting_menu_title'] = 'Показувати в меню';
$string['setting_none'] = 'Не показувати';
$string['setting_system'] = 'Показувати в усій системі';
$string['status'] = 'Статус';
$string['status_all'] = 'Усі Звернення';
$string['status_closed'] = 'Закрито';
$string['status_open'] = 'Відкрито';
$string['status_progress'] = 'В роботі';
$string['status_resolved'] = 'Вирішено';
$string['subject'] = 'Тема';
$string['ticketcategory'] = 'Звернення Категорія';
$string['ticketcategoryshort'] = 'Категорія';
$string['ticketclosed'] = 'Звернення закрито.';
$string['ticketcreated'] = 'Звернення успішно створена';
$string['ticketcreatedat'] = 'Дата створення';
$string['ticketdescription'] = 'Звернення Опис';
$string['ticketid'] = 'Звернення';
$string['ticketmessage'] = 'Повідомлення';
$string['ticketnotfound'] = 'Звернення не знайдена';
$string['ticketpriority'] = 'Звернення Пріоритет';
$string['ticketpriorityhigh'] = 'Високий';
$string['ticketprioritylow'] = 'Низький';
$string['ticketprioritymedium'] = 'Середній';
$string['ticketpriorityshort'] = 'Пріоритет';
$string['ticketpriorityurgent'] = 'Терміновий';
$string['ticketresponse'] = 'відповідь Звернення';
$string['ticketresponseandclose'] = 'відповідь Звернення Закрито';
$string['ticketresponseandresolved'] = 'відповідь Звернення Вирішено';
$string['tickets'] = 'Усі Звернення';
$string['ticketslist'] = 'Список Звернення';
$string['ticketstatus'] = 'Звернення Статус';
$string['ticketstatusclosed'] = 'Закрито';
$string['ticketstatusinprogress'] = 'В роботі';
$string['ticketstatusnotclosed'] = 'Усі except Закрито';
$string['ticketstatusopen'] = 'Відкрито';
$string['ticketstatusresolved'] = 'Вирішено';
$string['ticketstatusshort'] = 'Статус';
$string['ticketsubject'] = 'Звернення Тема';
$string['ticketupdated'] = 'Звернення успішно оновлена';
$string['updatecategory'] = 'Оновити Категорія';
$string['userid'] = 'ID Користувач';
$string['viewticket'] = 'Переглянути Звернення';
