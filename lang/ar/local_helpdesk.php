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

$string['addcategory'] = 'إضافة جديدة الفئة';
$string['addticket'] = 'إضافة التذكرة';
$string['attachment'] = 'المرفقات';
$string['avg_closing_time'] = 'متوسط مغلقة';
$string['avg_first_response_time'] = 'متوسط رد';
$string['cancel'] = 'إلغاء';
$string['categories'] = 'الفئات التذاكر';
$string['categorieslist'] = 'القائمة الفئات';
$string['category'] = 'الفئة';
$string['category_role_description'] = 'دور محدد للتحكم في وصول المستخدم إلى إدارة التذاكر.';
$string['category_users_all'] = 'جميع مستخدمي Moodle';
$string['category_users_info'] = 'أولاً، احفظ الفئة قبل تحرير المستخدمين.';
$string['category_users_responses'] = 'المستخدمون الذين يردون على هذه الفئة';
$string['category_users_title'] = 'يحدد المستخدمين الذين لديهم إذن بالرد والذين سيتلقون بريدًا إلكترونيًا حول التذاكر الجديدة';
$string['categoryadded'] = 'الفئة تمت إضافتها بنجاح';
$string['categorycreated'] = 'الفئة تم إنشاؤها بنجاح';
$string['categorydeleted'] = 'الفئة تم حذفها بنجاح';
$string['categorydescription'] = 'الفئة الوصف';
$string['categoryname'] = 'الفئة الاسم';
$string['categorynotfound'] = 'الفئة غير موجودة';
$string['categoryupdated'] = 'الفئة تم تحديثها بنجاح';
$string['comments'] = 'التعليقات';
$string['confirmdelete'] = 'هل أنت متأكد من أنك تريد حذف هذه الفئة؟';
$string['confirmdeletecategory'] = 'هل أنت متأكد من أنك تريد حذف هذه الفئة؟';
$string['confirmdeleteticket'] = 'هل أنت متأكد من أنك تريد حذف التذكرة "{$a}" نهائيًا؟ سيتم أيضًا حذف جميع الردود والمرفقات المرتبطة بهذه التذكرة.';
$string['createcategory'] = 'إنشاء الفئة';
$string['createcategoryfirst'] = 'إنشاء الفئة';
$string['createticket'] = 'إنشاء التذكرة';
$string['deletecategory'] = 'حذف الفئة';
$string['deletecategoryusedata'] = 'تحتوي هذه الفئة على بيانات';
$string['deletesuccesscategory'] = 'الفئة تم حذفها بنجاح';
$string['deletesuccessticket'] = 'التذكرة تم حذفها بنجاح.';
$string['deleteticket'] = 'حذف التذكرة';
$string['description'] = 'الوصف';
$string['editcategory'] = 'تحرير الفئة';
$string['editticket'] = 'تحرير التذكرة';
$string['error:emptyname'] = 'لا يمكن أن يكون اسم الفئة فارغًا';
$string['erroraddcategory'] = 'خطأ في إضافة الفئة';
$string['errordeletecategory'] = 'خطأ في حذف الفئة';
$string['errorinsertingcategory'] = 'خطأ في إضافة الفئة';
$string['errorinsertingticket'] = 'خطأ في التذكرة';
$string['errorupdatecategory'] = 'خطأ في تحديث الفئة';
$string['errorupdatingcategory'] = 'خطأ في تحديث الفئة';
$string['errorupdatingticket'] = 'خطأ في تحديث التذكرة';
$string['exportstatusfilter'] = 'تصدير الحالة';
$string['exporttickets'] = 'تصدير التذاكر';
$string['findcourse'] = 'اختيار المقرر';
$string['findticket'] = 'بحث الموضوع النص';
$string['finduser'] = 'اختيار المستخدم';
$string['geniai_btn_knowledgebase_create'] = 'إنشاء قاعدة معرفة بالذكاء الاصطناعي';
$string['geniai_btn_response_create'] = 'إنشاء رد بالذكاء الاصطناعي';
$string['geniai_create_knowledgebase_desc'] = 'صف بالتفصيل المحتوى الذي تريد إنشاءه. سيستخدم GeniAI هذه المعلومات لإنشاء نص دقيق وملائم لقاعدة المعرفة.';
$string['geniai_create_knowledgebase_message'] = 'أنشئ رسالة بناءً على النص أعلاه.';
$string['geniai_create_response_desc'] = 'صف ما تريد إنشاءه. سيستخدم GeniAI كل المحادثات كأساس لإنشاء رد، لكن يجب عليك تحديد البيانات التي تريد كتابتها.';
$string['geniai_create_response_message'] = 'أنشئ رسالة بناءً على النص أعلاه.';
$string['geniai_knowledgebase_prompt'] = 'أنت روبوت محادثة متخصص في إنشاء قواعد معرفة لـ Moodle. أنشئ محتوى واضحًا ومنظمًا ومهنيًا بصيغة المتكلم.\\n\\nأنشئ الآن مقالة حول:\\nاسم Moodle: "{$a->site_fullname}"\\nرابط Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nأعد الإجابة فقط باللغة "{$a->userlang}"، بدون عناوين، وبصيغة MARKDOWN فقط.';
$string['geniai_like_message'] = 'هل أعجبتك الرسالة؟ انقر هنا للإغلاق وإرسالها إلى المحرر.';
$string['geniai_missing'] = 'ثبّت وفعّل إضافة <a href="{$a}" target="_blank">GenIA</a> لتمكين الردود المدعومة بالذكاء الاصطناعي.';
$string['geniai_ticket_prompt_1'] = 'أنت روبوت محادثة يقترح ردودًا واضحة وودودة على تذاكر Moodle بصيغة المتكلم.\\n\\nسؤال المستخدم {$a->userfullname}: "{$a->userticket}"\\n\\nإنشاء رد باستخدام التعليمات المقدمة من الدعم:\\n"{$a->message}"\\n\\nأعد الإجابة فقط باللغة "{$a->userlang}" وبصيغة MARKDOWN فقط.';
$string['geniai_ticket_prompt_2'] = 'أنت روبوت محادثة يقترح ردودًا واضحة وودودة على تذاكر Moodle بصيغة المتكلم.\\n\\nإنشاء رد:\\n\\nسؤال المستخدم {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'أنت روبوت محادثة يقترح ردودًا واضحة وودودة على تذاكر Moodle بصيغة المتكلم.\\n\\nإنشاء رد بناءً على هذا السجل باستخدام التعليمات المقدمة من الدعم:\\n"{$a->message}"\\n\\nأعد الإجابة فقط باللغة "{$a->userlang}" وبصيغة MARKDOWN فقط.';
$string['geniai_ticket_prompt_4'] = 'أنت روبوت محادثة يقترح ردودًا واضحة وودودة على تذاكر Moodle بصيغة المتكلم.\\n\\nإنشاء رد بناءً على هذا السجل.\\n\\nأعد الإجابة فقط باللغة "{$a->userlang}" وبصيغة MARKDOWN فقط.';
$string['geniai_title'] = 'الذكاء الاصطناعي';
$string['helpdesk:categorydelete'] = 'يسمح بحذف الفئات.';
$string['helpdesk:categorymanage'] = 'يسمح بإدارة فئات مكتب المساعدة.';
$string['helpdesk:knowledgebase_delete'] = 'حذف المقالات في قاعدة المعرفة.';
$string['helpdesk:knowledgebase_manage'] = 'إدارة المقالات في قاعدة المعرفة.';
$string['helpdesk:knowledgebase_view'] = 'عرض المقالات في قاعدة المعرفة.';
$string['helpdesk:ticketmanage'] = 'يسمح بإدارة مكتب المساعدة، بما في ذلك الرد على التذاكر وإغلاقها.';
$string['helpdesk:view'] = 'يسمح بعرض تذاكر مكتب المساعدة وإنشائها للنفس.';
$string['helpdesk_manage_users'] = 'عرض المستخدمين الذين لديهم إذن لإدارة فئة هذا الدور';
$string['index_top_all_open_tickets'] = 'All مفتوحة التذاكر';
$string['index_top_completed_tickets'] = 'مكتملة التذاكر';
$string['index_top_unanswered_tickets'] = 'بلا رد التذاكر';
$string['index_top_urgent_tickets'] = 'عاجلة التذاكر';
$string['integracaoroot'] = 'التكامل';
$string['invalidpriority'] = 'الأولوية المحددة غير صالحة.';
$string['knowledgebase_addnew'] = 'إضافة جديدة قاعدة المعرفة';
$string['knowledgebase_articlenotfound'] = 'قاعدة المعرفة غير موجودة';
$string['knowledgebase_category'] = 'الفئة';
$string['knowledgebase_create'] = 'إنشاء قاعدة المعرفة';
$string['knowledgebase_delete'] = 'حذف قاعدة المعرفة';
$string['knowledgebase_delete_confirm'] = 'هل أنت متأكد من أنك تريد حذف قاعدة المعرفة <strong>{$a}</strong>؟';
$string['knowledgebase_delete_success'] = 'قاعدة المعرفة تم حذفها بنجاح';
$string['knowledgebase_description'] = 'محتوى المعرفة';
$string['knowledgebase_edit'] = 'تحرير قاعدة المعرفة';
$string['knowledgebase_name'] = 'قاعدة المعرفة';
$string['knowledgebase_prompt_short'] = 'الموجّه قصير جدًا';
$string['knowledgebase_title'] = 'عنوان المعرفة';
$string['knowledgebase_update'] = 'تحديث';
$string['lognewcategory'] = 'الفئة changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'الأولوية changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'الحالة changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'لم يتم إجراء أي تغييرات!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - التذكرة <strong>#{[event.tiketidlink]}</strong></p>\\n<p>عزيزي/عزيزتي {[to.fullname]},</p>\\n<p>{[from.fullname]} إنشاء التذكرة #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>مع أطيب التحيات,<br>\\nفريق الدعم</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - التذكرة: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - التذكرة <strong>#{[event.tiketidlink]}</strong></p>\\n<p>عزيزي/عزيزتي {[to.fullname]},</p>\\n<p>فريق الدعم: تحديث.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>عرض التذكرة #{[event.tiketidlink]}.</p>\\n<p>مع أطيب التحيات,<br>\\nفريق الدعم</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - التذكرة <strong>#{[event.tiketidlink]}</strong></p>\\n<p>عزيزي/عزيزتي {[to.fullname]},</p>\\n<p>فريق الدعم: الرسالة</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>عرض التذكرة #{[event.tiketidlink]}.</p>\\n<p>مع أطيب التحيات,<br>\\nفريق الدعم</p>';
$string['markticketasclosed'] = 'التذكرة مغلقة';
$string['markticketasresolved'] = 'التذكرة محلولة';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'الأولوية';
$string['priority_high'] = 'عالية';
$string['priority_low'] = 'منخفضة';
$string['priority_medium'] = 'متوسطة';
$string['priority_urgent'] = 'عاجلة';
$string['privacy:metadata:category_user_userid'] = 'المعرّف المستخدم - الفئة.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'المستخدمون - الفئات التذكرة.';
$string['privacy:metadata:local_helpdesk_response'] = 'ردود - التذكرة.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'التذاكر - المستخدم, الفئة, الحالة.';
$string['privacy:metadata:response_userid'] = 'المعرّف المستخدم - رد التذكرة.';
$string['privacy:metadata:ticket_userid'] = 'المعرّف المستخدم - التذكرة.';
$string['replytoticket'] = 'رد التذكرة';
$string['report_assignment_reports_page_description'] = 'تقرير: التذاكر / المستخدمون.';
$string['report_assignment_reports_page_title'] = 'التقارير - التعيين';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'التذاكر Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'الفئات عاجلة';
$string['report_category_reports_page_description'] = 'تقرير: الفئات التذكرة.';
$string['report_category_reports_page_title'] = 'التقارير الفئات';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'متوسط رد';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'إجمالي التذاكر';
$string['report_general_reports_page_title'] = 'التقارير';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'التذاكر إنشاء الفترة';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'تاريخ الإنشاء';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'إجمالي التذاكر';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'التذاكر محلولة الفترة';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'الفترة';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'إجمالي محلولة التذاكر';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'متوسط ردود';
$string['report_response_reports_page_description'] = 'تقرير: ردود التذكرة.';
$string['report_response_reports_page_title'] = 'التقارير ردود';
$string['report_status_priority_reports_page_description'] = 'تقرير: الحالة الأولوية التذكرة.';
$string['report_status_priority_reports_page_title'] = 'التقارير الحالة الأولوية';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'الأولوية distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'التذاكر الحالة';
$string['report_tickets_reports_page_description'] = 'تقرير: التذاكر مفتوحة / مغلقة.';
$string['report_tickets_reports_page_title'] = 'التذاكر';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'المعرّف المستخدم';
$string['report_user_reports_page_description'] = 'تقرير: المستخدمون التذاكر.';
$string['report_user_reports_page_title'] = 'التقارير المستخدمون';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'المستخدمون التذاكر مفتوحة';
$string['savecategory'] = 'حفظ الفئة';
$string['savechanges'] = 'حفظ التغييرات';
$string['setting_course'] = 'إظهار داخل المقرر فقط';
$string['setting_knowledgebase_menu_description'] = 'فعّل هذا الخيار لعرض رابط قاعدة المعرفة في قائمة التنقل.';
$string['setting_knowledgebase_menu_title'] = 'Display قاعدة المعرفة in Menu';
$string['setting_menu_description'] = 'حدد ما إذا كان سيتم عرض قائمة HelpDesk في قائمة النظام أعلى Moodle.';
$string['setting_menu_title'] = 'إظهار في القائمة';
$string['setting_none'] = 'عدم الإظهار';
$string['setting_system'] = 'إظهار في النظام كله';
$string['status'] = 'الحالة';
$string['status_all'] = 'كل التذاكر';
$string['status_closed'] = 'مغلقة';
$string['status_open'] = 'مفتوحة';
$string['status_progress'] = 'قيد المعالجة';
$string['status_resolved'] = 'محلولة';
$string['subject'] = 'الموضوع';
$string['ticketcategory'] = 'التذكرة الفئة';
$string['ticketcategoryshort'] = 'الفئة';
$string['ticketclosed'] = 'التذكرة مغلقة.';
$string['ticketcreated'] = 'التذكرة تم إنشاؤها بنجاح';
$string['ticketcreatedat'] = 'تاريخ الإنشاء';
$string['ticketdescription'] = 'التذكرة الوصف';
$string['ticketid'] = 'التذكرة';
$string['ticketmessage'] = 'الرسالة';
$string['ticketnotfound'] = 'التذكرة غير موجودة';
$string['ticketpriority'] = 'التذكرة الأولوية';
$string['ticketpriorityhigh'] = 'عالية';
$string['ticketprioritylow'] = 'منخفضة';
$string['ticketprioritymedium'] = 'متوسطة';
$string['ticketpriorityshort'] = 'الأولوية';
$string['ticketpriorityurgent'] = 'عاجلة';
$string['ticketresponse'] = 'رد التذكرة';
$string['ticketresponseandclose'] = 'رد التذكرة مغلقة';
$string['ticketresponseandresolved'] = 'رد التذكرة محلولة';
$string['tickets'] = 'كل التذاكر';
$string['ticketslist'] = 'القائمة التذاكر';
$string['ticketstatus'] = 'التذكرة الحالة';
$string['ticketstatusclosed'] = 'مغلقة';
$string['ticketstatusinprogress'] = 'قيد المعالجة';
$string['ticketstatusnotclosed'] = 'كل except مغلقة';
$string['ticketstatusopen'] = 'مفتوحة';
$string['ticketstatusresolved'] = 'محلولة';
$string['ticketstatusshort'] = 'الحالة';
$string['ticketsubject'] = 'التذكرة الموضوع';
$string['ticketupdated'] = 'التذكرة تم تحديثها بنجاح';
$string['updatecategory'] = 'تحديث الفئة';
$string['userid'] = 'المعرّف المستخدم';
$string['viewticket'] = 'عرض التذكرة';
