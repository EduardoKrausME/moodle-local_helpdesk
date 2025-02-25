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
 * file
 *
 * @package   local_khelpdesk
 * @copyright 2025 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addcategory'] = 'Add New Category';
$string['addticket'] = 'Add Ticket';
$string['assignedto'] = 'Assigned to';
$string['attachment'] = 'Attachments';
$string['cancel'] = 'Cancel';
$string['categories'] = 'Ticket Categories';
$string['categorieslist'] = 'Category List';
$string['category'] = 'Category';
$string['category_role_description'] = 'Specific role to control user access to Ticket management.';
$string['category_users_all'] = 'All Moodle users';
$string['category_users_info'] = 'First, save the category before editing users.';
$string['category_users_responses'] = 'Users who respond to this category';
$string['category_users_title'] = 'Defines the users with permission to respond and who will receive an email about new tickets';
$string['categoryadded'] = 'Category successfully added';
$string['categorycreated'] = 'Category successfully created';
$string['categorydeleted'] = 'Category successfully deleted';
$string['categorydescription'] = 'Category Description';
$string['categoryname'] = 'Category Name';
$string['categorynotfound'] = 'Category not found';
$string['categoryupdated'] = 'Category successfully updated';
$string['comments'] = 'Comments';
$string['confirmdelete'] = 'Are you sure you want to delete this category?';
$string['confirmdeletecategory'] = 'Are you sure you want to delete this category?';
$string['createcategory'] = 'Create Category';
$string['createcategoryfirst'] = 'First, create a category';
$string['createticket'] = 'Create Ticket';
$string['deletecategory'] = 'Delete Category';
$string['deletecategoryusedata'] = 'This category has tickets';
$string['deletesuccesscategory'] = 'Category successfully deleted';
$string['description'] = 'Description';
$string['editcategory'] = 'Edit Category';
$string['editticket'] = 'Edit Ticket';
$string['error:emptyname'] = 'The category name cannot be empty';
$string['erroraddcategory'] = 'Error adding category';
$string['errordeletecategory'] = 'Error deleting category';
$string['errorinsertingcategory'] = 'Error adding category';
$string['errorinsertingticket'] = 'Error inserting ticket';
$string['errorupdatecategory'] = 'Error updating category';
$string['errorupdatingcategory'] = 'Error updating category';
$string['errorupdatingticket'] = 'Error updating ticket';
$string['findcourse'] = 'Select a Course';
$string['finduser'] = 'Select a User';
$string['geniai_btn_create'] = 'Create a response with AI';
$string['geniai_create_desc'] = 'Describe what you want to generate. GeniAI will use all conversations as a basis to create a response, but you need to define which data you want to write.';
$string['geniai_create_message'] = 'Create a message based on the text above.';
$string['geniai_like_message'] = 'Liked the message? Click here to close and send it to the Editor.';
$string['geniai_missing'] = 'Install and configure the <a href="{$a}" target="_blank">GenIA</a> plugin to enable AI-powered responses.';
$string['geniai_prompt_1'] = 'You are a chatbot that suggests responses to Moodle tickets to solve course or Moodle issues in a cheerful, lively, and first-person manner.
You love responding with inspiring messages, avoiding lists, and providing detailed explanations while being very attentive to details.

User\'s question from {$a->userfullname}: "{$a->userticket}"

Now, create a response explaining how to solve the following issue using the instructions provided by Support:
"{$a->message}"

Return only in the "{$a->userlang}" language and only in MARKDOWN format.';
$string['geniai_prompt_2'] = 'You are a chatbot that suggests responses to Moodle tickets to solve course or Moodle issues in a cheerful, lively, and first-person manner.
You love responding with inspiring messages, avoiding lists, and providing detailed explanations while being very attentive to details.

Now, create a response explaining how to solve the following issue:

User\'s question from {$a->userfullname}: "{$a->userticket}"';
$string['geniai_prompt_3'] = 'You are a chatbot that suggests responses to Moodle tickets to solve course or Moodle issues in a cheerful, lively, and first-person manner.
You love responding with inspiring messages, avoiding lists, and providing detailed explanations while being very attentive to details.

Now, based on this history, create a response using the instructions provided by Support:
"{$a->message}"

Return only in the "{$a->userlang}" language and only in MARKDOWN format.';
$string['geniai_prompt_4'] = 'You are a chatbot that suggests responses to Moodle tickets to solve course or Moodle issues in a cheerful, lively, and first-person manner.
You love responding with inspiring messages, avoiding lists, and providing detailed explanations while being very attentive to details.

Now, based on this history, create a response and return only in the "{$a->userlang}" language and only in MARKDOWN format.';
$string['geniai_title'] = 'Artificial Intelligence';
$string['khelpdesk:categorydelete'] = 'Allows deleting categories.';
$string['khelpdesk:ticketmanage'] = 'Allows managing the khelpdesk, including responding to and closing tickets.';
$string['khelpdesk:view'] = 'Allows viewing khelpdesk tickets and creating them for oneself.';
$string['khelpdesk_manage_users'] = 'View users with permission to manage this role category';
$string['index_top_all_open_tickets'] = 'All Open Tickets';
$string['index_top_completed_tickets'] = 'Completed Tickets';
$string['index_top_unanswered_tickets'] = 'Unanswered Tickets';
$string['index_top_urgent_tickets'] = 'Urgent Tickets';
$string['integracaoroot'] = 'Integration';
$string['lognewcategory'] = 'Category changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Priority changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Status changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'No changes made!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.khelpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Dear {[to.fullname]},</p>
<p>{[from.fullname]} has created ticket #{[event.tiketidlink]}:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>Best regards,<br>
Support Team</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Ticket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.khelpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Dear {[to.fullname]},</p>
<p>Our team has reviewed your case and added new information:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>Please access ticket #{[event.tiketidlink]} to view the update and provide any additional details if necessary. We are available to continue assisting you and resolve your request as quickly as possible.</p>
<p>Best regards,<br>
Support Team</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Ticket <strong>#{[event.tiketidlink]}</strong></p>
<p>Dear {[to.fullname]},</p>
<p>We have received your request:</p>
<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">
{[event.text]}
{[event.attachment]}
</blockquote>
<p>If you haven\'t already, you can add more details to your ticket #{[event.tiketidlink]}, such as logs, error messages, screenshots, step-by-step descriptions, or replication steps that can help the support agent assist you more effectively.</p>
<p>Our team is working on analyzing your issue and will follow up as necessary. We appreciate your patience and understanding.</p>
<p>Best regards,<br>
Support Team</p>';
$string['markticketasclosed'] = 'Mark Ticket as Closed';
$string['markticketasresolved'] = 'Mark Ticket as Resolved';
$string['openuserby'] = 'Opened by';
$string['pluginname'] = 'khelpdesk';
$string['priority'] = 'Priority';
$string['priority_high'] = 'High';
$string['priority_low'] = 'Low';
$string['priority_medium'] = 'Medium';
$string['priority_urgent'] = 'Urgent';
$string['replytoticket'] = 'Reply to ticket';


$string['report_assignment_reports_page_description'] = 'Report on ticket distribution and performance of assigned agents.';
$string['report_assignment_reports_page_title'] = 'Assignment Reports';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tickets by Agent';
$string['report_category_reports_avg_resolution_time_by_category_cat_title'] = 'Average Resolution Time by Category';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Most Demanded Categories';
$string['report_category_reports_page_description'] = 'Report on ticket categories, helping to identify the most frequent support areas and common issues.';
$string['report_category_reports_page_title'] = 'Category Reports';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Average response time';
$string['report_general_reports_avg_resolution_time_cat_title'] = 'Average Resolution Time';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total tickets';
$string['report_general_reports_avg_time_first_response_avg_response_time'] = 'Average time';
$string['report_general_reports_avg_time_first_response_cat_title'] = 'Average time between ticket creation and first response';
$string['report_general_reports_page_description'] = 'General report on open and closed tickets, providing an overview of the customer service system performance.';
$string['report_general_reports_page_title'] = 'General Reports';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tickets Created by Period';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Creation date';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total tickets';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tickets Resolved by Period';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Period';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total resolved tickets';
$string['report_response_reports_avg_responses_per_ticket_cat_title'] = 'Average Responses per Ticket';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Average responses';
$string['report_response_reports_page_description'] = 'Report on responses provided to tickets, including response time and agent interactions.';
$string['report_response_reports_page_title'] = 'Response Reports';
$string['report_status_priority_reports_page_description'] = 'Report on ticket status and priority, including data on open, in-progress, resolved, and closed tickets.';
$string['report_status_priority_reports_page_title'] = 'Status and Priority Reports';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Priority Distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tickets by Status';
$string['report_user_reports_avg_response_time_by_user_cat_title'] = 'Average Response Time per User';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'User ID';
$string['report_user_reports_page_description'] = 'Report on users who created the most tickets, including data on the number of tickets and associated response time.';
$string['report_user_reports_page_title'] = 'User Reports';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Users with Most Opened Tickets';
$string['report_user_reports_users_with_most_tickets_open_userid'] = 'User ID';


$string['savechanges'] = 'Save Changes';
$string['setting_course'] = 'Show only inside the course';
$string['setting_menu_description'] = 'Select whether to show the khelpdesk menu in the system menu at the top of Moodle.';
$string['setting_menu_title'] = 'Show in menu';
$string['setting_none'] = 'Do not show';
$string['setting_system'] = 'Show throughout the system';
$string['status'] = 'Status';
$string['status_closed'] = 'Closed';
$string['status_open'] = 'Open';
$string['status_progress'] = 'In Progress';
$string['status_resolved'] = 'Resolved';
$string['subject'] = 'Subject';
$string['ticketassignedto'] = 'Assign to User';
$string['ticketcategory'] = 'Ticket Category';
$string['ticketclosed'] = 'The ticket is closed.';
$string['ticketcreated'] = 'Ticket successfully created';
$string['ticketcreatedat'] = 'Created at';
$string['ticketdescription'] = 'Detailed Ticket Description';
$string['ticketid'] = 'Ticket';
$string['ticketmessage'] = 'Message';
$string['ticketnotfound'] = 'Ticket not found';
$string['ticketpriority'] = 'Ticket Priority';
$string['ticketpriorityhigh'] = 'High';
$string['ticketprioritylow'] = 'Low';
$string['ticketprioritymedium'] = 'Medium';
$string['ticketpriorityurgent'] = 'Urgent';
$string['ticketresponse'] = 'Reply ticket';
$string['ticketresponseandclose'] = 'Reply ticket and make close';
$string['ticketresponseandresolved'] = 'Reply ticket and make resolved';
$string['tickets'] = 'All Tickets';
$string['ticketslist'] = 'Ticket List';
$string['ticketstatus'] = 'Ticket Status';
$string['ticketstatusclosed'] = 'Closed';
$string['ticketstatusinprogress'] = 'In Progress';
$string['ticketstatusnotclosed'] = 'All except Closed';
$string['ticketstatusopen'] = 'Open';
$string['ticketstatusresolved'] = 'Resolved';
$string['ticketsubject'] = 'Ticket Subject';
$string['ticketupdated'] = 'Ticket successfully updated';
$string['updatecategory'] = 'Update Category';
$string['userid'] = 'User ID';
$string['viewticket'] = 'View Ticket';
