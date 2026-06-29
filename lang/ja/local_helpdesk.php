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

$string['addcategory'] = '追加 新規 カテゴリ';
$string['addticket'] = '追加 チケット';
$string['attachment'] = '添付ファイル';
$string['avg_closing_time'] = '平均 終了';
$string['avg_first_response_time'] = '平均 返信';
$string['cancel'] = 'キャンセル';
$string['categories'] = 'カテゴリ チケット';
$string['categorieslist'] = '一覧 カテゴリ';
$string['category'] = 'カテゴリ';
$string['category_role_description'] = 'チケット管理へのユーザアクセスを制御するための特定のロールです。';
$string['category_users_all'] = 'すべての Moodle ユーザ';
$string['category_users_info'] = 'ユーザを編集する前に、まずカテゴリを保存してください。';
$string['category_users_responses'] = 'このカテゴリに返信するユーザ';
$string['category_users_title'] = '返信権限を持ち、新規チケットについてメールを受け取るユーザを定義します';
$string['categoryadded'] = 'カテゴリ 正常に追加されました';
$string['categorycreated'] = 'カテゴリ 正常に作成されました';
$string['categorydeleted'] = 'カテゴリ 正常に削除されました';
$string['categorydescription'] = 'カテゴリ 説明';
$string['categoryname'] = 'カテゴリ 名称';
$string['categorynotfound'] = 'カテゴリ が見つかりません';
$string['categoryupdated'] = 'カテゴリ 正常に更新されました';
$string['comments'] = 'コメント';
$string['confirmdelete'] = 'このカテゴリを削除してもよろしいですか？';
$string['confirmdeletecategory'] = 'このカテゴリを削除してもよろしいですか？';
$string['confirmdeleteticket'] = 'チケット「{$a}」を完全に削除してもよろしいですか？このチケットに関連するすべての返信と添付ファイルも削除されます。';
$string['createcategory'] = '作成 カテゴリ';
$string['createcategoryfirst'] = '作成 カテゴリ';
$string['createticket'] = '作成 チケット';
$string['deletecategory'] = '削除 カテゴリ';
$string['deletecategoryusedata'] = 'このカテゴリにはデータがあります';
$string['deletesuccesscategory'] = 'カテゴリ 正常に削除されました';
$string['deletesuccessticket'] = 'チケット 正常に削除されました.';
$string['deleteticket'] = '削除 チケット';
$string['description'] = '説明';
$string['editcategory'] = '編集 カテゴリ';
$string['editticket'] = '編集 チケット';
$string['error:emptyname'] = 'カテゴリ名を空にすることはできません';
$string['erroraddcategory'] = 'エラー 追加 カテゴリ';
$string['errordeletecategory'] = 'エラー 削除 カテゴリ';
$string['errorinsertingcategory'] = 'エラー 追加 カテゴリ';
$string['errorinsertingticket'] = 'エラー チケット';
$string['errorupdatecategory'] = 'エラー 更新 カテゴリ';
$string['errorupdatingcategory'] = 'エラー 更新 カテゴリ';
$string['errorupdatingticket'] = 'エラー 更新 チケット';
$string['exportstatusfilter'] = 'エクスポート ステータス';
$string['exporttickets'] = 'エクスポート チケット';
$string['findcourse'] = '選択 コース';
$string['findticket'] = '検索 件名 本文';
$string['finduser'] = '選択 ユーザ';
$string['geniai_btn_knowledgebase_create'] = 'AIでナレッジベースを作成';
$string['geniai_btn_response_create'] = 'AIで返信を作成';
$string['geniai_create_knowledgebase_desc'] = '生成したい内容を詳しく説明してください。GeniAI はこの情報を使用して、ナレッジベース用の正確で関連性の高い文章を作成します。';
$string['geniai_create_knowledgebase_message'] = '上記のテキストに基づいてメッセージを作成してください。';
$string['geniai_create_response_desc'] = '生成したい内容を説明してください。GeniAI はすべての会話を基に返信を作成しますが、書きたい情報を指定する必要があります。';
$string['geniai_create_response_message'] = '上記のテキストに基づいてメッセージを作成してください。';
$string['geniai_knowledgebase_prompt'] = 'あなたは Moodle のナレッジベース作成を専門とするチャットボットです。明確で構成された専門的な一人称の内容を生成してください。\\n\\n次の内容について記事を作成してください:\\nMoodle 名: "{$a->site_fullname}"\\nMoodle URL: "{$a->site_url}"\\n"{$a->message}"\\n\\n"{$a->userlang}" の言語のみ、タイトルなし、MARKDOWN のみで返してください。';
$string['geniai_like_message'] = 'メッセージが気に入りましたか？ここをクリックして閉じ、エディタへ送信します。';
$string['geniai_missing'] = 'AI による返信を有効にするには、<a href="{$a}" target="_blank">GenIA</a> プラグインをインストールして設定してください。';
$string['geniai_ticket_prompt_1'] = 'あなたは Moodle チケットへの返信案を、明確で親しみやすい一人称で作成するチャットボットです。\\n\\n{$a->userfullname} からの質問: "{$a->userticket}"\\n\\n作成 返信 サポートから提供された手順を使用して:\\n"{$a->message}"\\n\\n"{$a->userlang}" の言語のみ、MARKDOWN のみで返してください。';
$string['geniai_ticket_prompt_2'] = 'あなたは Moodle チケットへの返信案を、明確で親しみやすい一人称で作成するチャットボットです。\\n\\n作成 返信:\\n\\n{$a->userfullname} からの質問: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'あなたは Moodle チケットへの返信案を、明確で親しみやすい一人称で作成するチャットボットです。\\n\\n作成 返信 この履歴に基づいて サポートから提供された手順を使用して:\\n"{$a->message}"\\n\\n"{$a->userlang}" の言語のみ、MARKDOWN のみで返してください。';
$string['geniai_ticket_prompt_4'] = 'あなたは Moodle チケットへの返信案を、明確で親しみやすい一人称で作成するチャットボットです。\\n\\n作成 返信 この履歴に基づいて.\\n\\n"{$a->userlang}" の言語のみ、MARKDOWN のみで返してください。';
$string['geniai_title'] = '人工知能';
$string['helpdesk:categorydelete'] = 'カテゴリの削除を許可します。';
$string['helpdesk:categorymanage'] = 'ヘルプデスクカテゴリの管理を許可します。';
$string['helpdesk:knowledgebase_delete'] = 'ナレッジベースの記事を削除します。';
$string['helpdesk:knowledgebase_manage'] = 'ナレッジベースの記事を管理します。';
$string['helpdesk:knowledgebase_view'] = 'ナレッジベースの記事を表示します。';
$string['helpdesk:ticketmanage'] = '返信およびチケット終了を含むヘルプデスクの管理を許可します。';
$string['helpdesk:view'] = 'ヘルプデスクチケットの表示および自分用チケットの作成を許可します。';
$string['helpdesk_manage_users'] = 'このロールカテゴリを管理する権限を持つユーザを表示';
$string['index_top_all_open_tickets'] = 'All オープン チケット';
$string['index_top_completed_tickets'] = '完了 チケット';
$string['index_top_unanswered_tickets'] = '未回答 チケット';
$string['index_top_urgent_tickets'] = '緊急 チケット';
$string['integracaoroot'] = '連携';
$string['invalidpriority'] = '選択された優先度は無効です。';
$string['knowledgebase_addnew'] = '追加 新規 ナレッジベース';
$string['knowledgebase_articlenotfound'] = 'ナレッジベース が見つかりません';
$string['knowledgebase_category'] = 'カテゴリ';
$string['knowledgebase_create'] = '作成 ナレッジベース';
$string['knowledgebase_delete'] = '削除 ナレッジベース';
$string['knowledgebase_delete_confirm'] = 'ナレッジベース <strong>{$a}</strong> を削除してもよろしいですか？';
$string['knowledgebase_delete_success'] = 'ナレッジベース 正常に削除されました';
$string['knowledgebase_description'] = 'ナレッジコンテンツ';
$string['knowledgebase_edit'] = '編集 ナレッジベース';
$string['knowledgebase_name'] = 'ナレッジベース';
$string['knowledgebase_prompt_short'] = 'プロンプトが短すぎます';
$string['knowledgebase_title'] = 'ナレッジタイトル';
$string['knowledgebase_update'] = '更新';
$string['lognewcategory'] = 'カテゴリ changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = '優先度 changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'ステータス changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = '変更はありません！';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - チケット <strong>#{[event.tiketidlink]}</strong></p>\\n<p>こんにちは {[to.fullname]},</p>\\n<p>{[from.fullname]} 作成 チケット #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>よろしくお願いいたします,<br>\\nサポートチーム</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - チケット: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - チケット <strong>#{[event.tiketidlink]}</strong></p>\\n<p>こんにちは {[to.fullname]},</p>\\n<p>サポートチーム: 更新.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>表示 チケット #{[event.tiketidlink]}.</p>\\n<p>よろしくお願いいたします,<br>\\nサポートチーム</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - チケット <strong>#{[event.tiketidlink]}</strong></p>\\n<p>こんにちは {[to.fullname]},</p>\\n<p>サポートチーム: メッセージ</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>表示 チケット #{[event.tiketidlink]}.</p>\\n<p>よろしくお願いいたします,<br>\\nサポートチーム</p>';
$string['markticketasclosed'] = 'チケット 終了';
$string['markticketasresolved'] = 'チケット 解決済み';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = '優先度';
$string['priority_high'] = '高';
$string['priority_low'] = '低';
$string['priority_medium'] = '中';
$string['priority_urgent'] = '緊急';
$string['privacy:metadata:category_user_userid'] = 'ID ユーザ - カテゴリ.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'ユーザ - カテゴリ チケット.';
$string['privacy:metadata:local_helpdesk_response'] = '返信 - チケット.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'チケット - ユーザ, カテゴリ, ステータス.';
$string['privacy:metadata:response_userid'] = 'ID ユーザ - 返信 チケット.';
$string['privacy:metadata:ticket_userid'] = 'ID ユーザ - チケット.';
$string['replytoticket'] = '返信 チケット';
$string['report_assignment_reports_page_description'] = 'レポート: チケット / ユーザ.';
$string['report_assignment_reports_page_title'] = 'レポート - 割り当て';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'チケット Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'カテゴリ 緊急';
$string['report_category_reports_page_description'] = 'レポート: カテゴリ チケット.';
$string['report_category_reports_page_title'] = 'レポート カテゴリ';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = '平均 返信';
$string['report_general_reports_avg_resolution_time_total_tickets'] = '合計 チケット';
$string['report_general_reports_page_title'] = 'レポート';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'チケット 作成 期間';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = '作成日';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = '合計 チケット';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'チケット 解決済み 期間';
$string['report_general_reports_tickets_resolved_by_period_period'] = '期間';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = '合計 解決済み チケット';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = '平均 返信';
$string['report_response_reports_page_description'] = 'レポート: 返信 チケット.';
$string['report_response_reports_page_title'] = 'レポート 返信';
$string['report_status_priority_reports_page_description'] = 'レポート: ステータス 優先度 チケット.';
$string['report_status_priority_reports_page_title'] = 'レポート ステータス 優先度';
$string['report_status_priority_reports_priority_distribution_cat_title'] = '優先度 distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'チケット ステータス';
$string['report_tickets_reports_page_description'] = 'レポート: チケット オープン / 終了.';
$string['report_tickets_reports_page_title'] = 'チケット';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID ユーザ';
$string['report_user_reports_page_description'] = 'レポート: ユーザ チケット.';
$string['report_user_reports_page_title'] = 'レポート ユーザ';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'ユーザ チケット オープン';
$string['savecategory'] = '保存 カテゴリ';
$string['savechanges'] = '保存 変更';
$string['setting_course'] = 'コース内のみ表示';
$string['setting_knowledgebase_menu_description'] = 'このオプションを有効にすると、ナビゲーションメニューにナレッジベースへのリンクが表示されます。';
$string['setting_knowledgebase_menu_title'] = 'Display ナレッジベース in Menu';
$string['setting_menu_description'] = 'Moodle 上部のシステムメニューに HelpDesk メニューを表示するかどうかを選択します。';
$string['setting_menu_title'] = 'メニューに表示';
$string['setting_none'] = '表示しない';
$string['setting_system'] = 'システム全体に表示';
$string['status'] = 'ステータス';
$string['status_all'] = 'すべて チケット';
$string['status_closed'] = '終了';
$string['status_open'] = 'オープン';
$string['status_progress'] = '対応中';
$string['status_resolved'] = '解決済み';
$string['subject'] = '件名';
$string['ticketcategory'] = 'チケット カテゴリ';
$string['ticketcategoryshort'] = 'カテゴリ';
$string['ticketclosed'] = 'チケットは終了しています。';
$string['ticketcreated'] = 'チケット 正常に作成されました';
$string['ticketcreatedat'] = '作成日';
$string['ticketdescription'] = 'チケット 説明';
$string['ticketid'] = 'チケット';
$string['ticketmessage'] = 'メッセージ';
$string['ticketnotfound'] = 'チケット が見つかりません';
$string['ticketpriority'] = 'チケット 優先度';
$string['ticketpriorityhigh'] = '高';
$string['ticketprioritylow'] = '低';
$string['ticketprioritymedium'] = '中';
$string['ticketpriorityshort'] = '優先度';
$string['ticketpriorityurgent'] = '緊急';
$string['ticketresponse'] = '返信 チケット';
$string['ticketresponseandclose'] = '返信 チケット 終了';
$string['ticketresponseandresolved'] = '返信 チケット 解決済み';
$string['tickets'] = 'すべて チケット';
$string['ticketslist'] = '一覧 チケット';
$string['ticketstatus'] = 'チケット ステータス';
$string['ticketstatusclosed'] = '終了';
$string['ticketstatusinprogress'] = '対応中';
$string['ticketstatusnotclosed'] = 'すべて except 終了';
$string['ticketstatusopen'] = 'オープン';
$string['ticketstatusresolved'] = '解決済み';
$string['ticketstatusshort'] = 'ステータス';
$string['ticketsubject'] = 'チケット 件名';
$string['ticketupdated'] = 'チケット 正常に更新されました';
$string['updatecategory'] = '更新 カテゴリ';
$string['userid'] = 'ID ユーザ';
$string['viewticket'] = '表示 チケット';
