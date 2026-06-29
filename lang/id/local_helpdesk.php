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

$string['addcategory'] = 'Tambah Baru Kategori';
$string['addticket'] = 'Tambah Tiket';
$string['attachment'] = 'Lampiran';
$string['avg_closing_time'] = 'Rata-rata Ditutup';
$string['avg_first_response_time'] = 'Rata-rata tanggapan';
$string['cancel'] = 'Batal';
$string['categories'] = 'Kategori Tiket';
$string['categorieslist'] = 'Daftar Kategori';
$string['category'] = 'Kategori';
$string['category_role_description'] = 'Peran khusus untuk mengontrol akses pengguna ke pengelolaan tiket.';
$string['category_users_all'] = 'Semua pengguna Moodle';
$string['category_users_info'] = 'Simpan kategori terlebih dahulu sebelum mengedit pengguna.';
$string['category_users_responses'] = 'Pengguna yang menanggapi kategori ini';
$string['category_users_title'] = 'Menentukan pengguna yang memiliki izin untuk menanggapi dan menerima email tentang tiket baru';
$string['categoryadded'] = 'Kategori berhasil ditambahkan';
$string['categorycreated'] = 'Kategori berhasil dibuat';
$string['categorydeleted'] = 'Kategori berhasil dihapus';
$string['categorydescription'] = 'Kategori Deskripsi';
$string['categoryname'] = 'Kategori Nama';
$string['categorynotfound'] = 'Kategori tidak ditemukan';
$string['categoryupdated'] = 'Kategori berhasil diperbarui';
$string['comments'] = 'Komentar';
$string['confirmdelete'] = 'Apakah Anda yakin ingin menghapus kategori ini?';
$string['confirmdeletecategory'] = 'Apakah Anda yakin ingin menghapus kategori ini?';
$string['confirmdeleteticket'] = 'Apakah Anda yakin ingin menghapus tiket "{$a}" secara permanen? Semua tanggapan dan lampiran terkait tiket ini juga akan dihapus.';
$string['createcategory'] = 'Buat Kategori';
$string['createcategoryfirst'] = 'Buat Kategori';
$string['createticket'] = 'Buat Tiket';
$string['deletecategory'] = 'Hapus Kategori';
$string['deletecategoryusedata'] = 'Kategori ini memiliki data';
$string['deletesuccesscategory'] = 'Kategori berhasil dihapus';
$string['deletesuccessticket'] = 'Tiket berhasil dihapus.';
$string['deleteticket'] = 'Hapus Tiket';
$string['description'] = 'Deskripsi';
$string['editcategory'] = 'Edit Kategori';
$string['editticket'] = 'Edit Tiket';
$string['error:emptyname'] = 'Nama kategori tidak boleh kosong';
$string['erroraddcategory'] = 'Kesalahan saat Tambah Kategori';
$string['errordeletecategory'] = 'Kesalahan saat Hapus Kategori';
$string['errorinsertingcategory'] = 'Kesalahan saat Tambah Kategori';
$string['errorinsertingticket'] = 'Kesalahan saat Tiket';
$string['errorupdatecategory'] = 'Kesalahan saat Perbarui Kategori';
$string['errorupdatingcategory'] = 'Kesalahan saat Perbarui Kategori';
$string['errorupdatingticket'] = 'Kesalahan saat Perbarui Tiket';
$string['exportstatusfilter'] = 'Ekspor Status';
$string['exporttickets'] = 'Ekspor Tiket';
$string['findcourse'] = 'Pilih Kursus';
$string['findticket'] = 'Cari Subjek teks';
$string['finduser'] = 'Pilih Pengguna';
$string['geniai_btn_knowledgebase_create'] = 'Buat basis pengetahuan dengan AI';
$string['geniai_btn_response_create'] = 'Buat tanggapan dengan AI';
$string['geniai_create_knowledgebase_desc'] = 'Jelaskan secara rinci konten yang ingin Anda buat. GeniAI akan menggunakan informasi ini untuk membuat teks yang akurat dan relevan untuk basis pengetahuan.';
$string['geniai_create_knowledgebase_message'] = 'Buat pesan berdasarkan teks di atas.';
$string['geniai_create_response_desc'] = 'Jelaskan apa yang ingin Anda buat. GeniAI akan menggunakan semua percakapan sebagai dasar untuk membuat tanggapan, tetapi Anda perlu menentukan data yang ingin ditulis.';
$string['geniai_create_response_message'] = 'Buat pesan berdasarkan teks di atas.';
$string['geniai_knowledgebase_prompt'] = 'Anda adalah chatbot khusus basis pengetahuan Moodle. Buat konten yang jelas, terstruktur, dan profesional dengan sudut pandang orang pertama.\\n\\nBuat artikel basis pengetahuan tentang:\\nNama Moodle: "{$a->site_fullname}"\\nURL Moodle: "{$a->site_url}"\\n"{$a->message}"\\n\\nKembalikan hanya dalam bahasa "{$a->userlang}", tanpa judul, dan hanya dalam MARKDOWN.';
$string['geniai_like_message'] = 'Suka pesannya? Klik di sini untuk menutup dan mengirimkannya ke Editor.';
$string['geniai_missing'] = 'Instal dan konfigurasikan plugin <a href="{$a}" target="_blank">GenIA</a> untuk mengaktifkan tanggapan bertenaga AI.';
$string['geniai_ticket_prompt_1'] = 'Anda adalah chatbot yang menyarankan tanggapan tiket Moodle dengan jelas, ramah, dan memakai sudut pandang orang pertama.\\n\\nPertanyaan pengguna {$a->userfullname}: "{$a->userticket}"\\n\\nBuat tanggapan menggunakan instruksi yang diberikan oleh Dukungan:\\n"{$a->message}"\\n\\nKembalikan hanya dalam bahasa "{$a->userlang}" dan hanya dalam MARKDOWN.';
$string['geniai_ticket_prompt_2'] = 'Anda adalah chatbot yang menyarankan tanggapan tiket Moodle dengan jelas, ramah, dan memakai sudut pandang orang pertama.\\n\\nBuat tanggapan:\\n\\nPertanyaan pengguna {$a->userfullname}: "{$a->userticket}"';
$string['geniai_ticket_prompt_3'] = 'Anda adalah chatbot yang menyarankan tanggapan tiket Moodle dengan jelas, ramah, dan memakai sudut pandang orang pertama.\\n\\nBuat tanggapan berdasarkan riwayat ini menggunakan instruksi yang diberikan oleh Dukungan:\\n"{$a->message}"\\n\\nKembalikan hanya dalam bahasa "{$a->userlang}" dan hanya dalam MARKDOWN.';
$string['geniai_ticket_prompt_4'] = 'Anda adalah chatbot yang menyarankan tanggapan tiket Moodle dengan jelas, ramah, dan memakai sudut pandang orang pertama.\\n\\nBuat tanggapan berdasarkan riwayat ini.\\n\\nKembalikan hanya dalam bahasa "{$a->userlang}" dan hanya dalam MARKDOWN.';
$string['geniai_title'] = 'Kecerdasan buatan';
$string['helpdesk:categorydelete'] = 'Mengizinkan penghapusan kategori.';
$string['helpdesk:categorymanage'] = 'Mengizinkan pengelolaan kategori Helpdesk.';
$string['helpdesk:knowledgebase_delete'] = 'Menghapus artikel di basis pengetahuan.';
$string['helpdesk:knowledgebase_manage'] = 'Mengelola artikel di basis pengetahuan.';
$string['helpdesk:knowledgebase_view'] = 'Melihat artikel di basis pengetahuan.';
$string['helpdesk:ticketmanage'] = 'Mengizinkan pengelolaan Helpdesk, termasuk menanggapi dan menutup tiket.';
$string['helpdesk:view'] = 'Mengizinkan melihat tiket Helpdesk dan membuat tiket untuk diri sendiri.';
$string['helpdesk_manage_users'] = 'Lihat pengguna dengan izin untuk mengelola kategori peran ini';
$string['index_top_all_open_tickets'] = 'All Terbuka Tiket';
$string['index_top_completed_tickets'] = 'Selesai Tiket';
$string['index_top_unanswered_tickets'] = 'Belum dijawab Tiket';
$string['index_top_urgent_tickets'] = 'Mendesak Tiket';
$string['integracaoroot'] = 'Integrasi';
$string['invalidpriority'] = 'Prioritas yang dipilih tidak valid.';
$string['knowledgebase_addnew'] = 'Tambah Baru Basis pengetahuan';
$string['knowledgebase_articlenotfound'] = 'Basis pengetahuan tidak ditemukan';
$string['knowledgebase_category'] = 'Kategori';
$string['knowledgebase_create'] = 'Buat Basis pengetahuan';
$string['knowledgebase_delete'] = 'Hapus Basis pengetahuan';
$string['knowledgebase_delete_confirm'] = 'Apakah Anda yakin ingin menghapus basis pengetahuan <strong>{$a}</strong>?';
$string['knowledgebase_delete_success'] = 'Basis pengetahuan berhasil dihapus';
$string['knowledgebase_description'] = 'Konten basis pengetahuan';
$string['knowledgebase_edit'] = 'Edit Basis pengetahuan';
$string['knowledgebase_name'] = 'Basis pengetahuan';
$string['knowledgebase_prompt_short'] = 'Prompt terlalu pendek';
$string['knowledgebase_title'] = 'Judul pengetahuan';
$string['knowledgebase_update'] = 'Perbarui';
$string['lognewcategory'] = 'Kategori changed to <strong>{$a}</strong>!';
$string['lognewpriority'] = 'Prioritas changed to <strong>{$a}</strong>!';
$string['lognewstatus'] = 'Status changed to <strong>{$a}</strong>!';
$string['lognowupdate'] = 'Tidak ada perubahan!';
$string['mailticket_create_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Tiket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Yth. {[to.fullname]},</p>\\n<p>{[from.fullname]} Buat Tiket #{[event.tiketidlink]}:</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Salam hormat,<br>\\nTim Dukungan</p>';
$string['mailticket_subject'] = '{[event.subjectname]} - Tiket: #{[event.tiketidname]}';
$string['mailticket_update_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.helpdesk]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Tiket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Yth. {[to.fullname]},</p>\\n<p>Tim Dukungan: Perbarui.</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Lihat Tiket #{[event.tiketidlink]}.</p>\\n<p>Salam hormat,<br>\\nTim Dukungan</p>';
$string['mailticket_user_message'] = '<p><strong>{[moodle.fullname]}</strong> >> <strong>{[event.tiketidlink]}</strong> >> <strong>{[event.categorylink]}</strong> >> <strong>{[event.subjectlink]}</strong> - Tiket <strong>#{[event.tiketidlink]}</strong></p>\\n<p>Yth. {[to.fullname]},</p>\\n<p>Tim Dukungan: Pesan</p>\\n<blockquote style="border-left: 4px solid #9E9E9E;padding-left: 7px;">\\n{[event.text]}\\n{[event.attachment]}\\n</blockquote>\\n<p>Lihat Tiket #{[event.tiketidlink]}.</p>\\n<p>Salam hormat,<br>\\nTim Dukungan</p>';
$string['markticketasclosed'] = 'Tiket Ditutup';
$string['markticketasresolved'] = 'Tiket Terselesaikan';
$string['pluginname'] = 'Helpdesk';
$string['priority'] = 'Prioritas';
$string['priority_high'] = 'Tinggi';
$string['priority_low'] = 'Rendah';
$string['priority_medium'] = 'Sedang';
$string['priority_urgent'] = 'Mendesak';
$string['privacy:metadata:category_user_userid'] = 'ID Pengguna - Kategori.';
$string['privacy:metadata:local_helpdesk_category_user'] = 'Pengguna - Kategori Tiket.';
$string['privacy:metadata:local_helpdesk_response'] = 'tanggapan - Tiket.';
$string['privacy:metadata:local_helpdesk_ticket'] = 'Tiket - Pengguna, Kategori, Status.';
$string['privacy:metadata:response_userid'] = 'ID Pengguna - tanggapan Tiket.';
$string['privacy:metadata:ticket_userid'] = 'ID Pengguna - Tiket.';
$string['replytoticket'] = 'tanggapan Tiket';
$string['report_assignment_reports_page_description'] = 'Laporan: Tiket / Pengguna.';
$string['report_assignment_reports_page_title'] = 'Laporan - penugasan';
$string['report_assignment_reports_tickets_by_agent_cat_title'] = 'Tiket Agent';
$string['report_category_reports_most_demanded_categories_cat_title'] = 'Kategori Mendesak';
$string['report_category_reports_page_description'] = 'Laporan: Kategori Tiket.';
$string['report_category_reports_page_title'] = 'Laporan Kategori';
$string['report_general_reports_avg_resolution_time_avg_resolution_time_hours'] = 'Rata-rata tanggapan';
$string['report_general_reports_avg_resolution_time_total_tickets'] = 'Total Tiket';
$string['report_general_reports_page_title'] = 'Laporan';
$string['report_general_reports_tickets_created_by_period_cat_title'] = 'Tiket Buat Periode';
$string['report_general_reports_tickets_created_by_period_data_criacao'] = 'Tanggal dibuat';
$string['report_general_reports_tickets_created_by_period_total_tickets'] = 'Total Tiket';
$string['report_general_reports_tickets_resolved_by_period_cat_title'] = 'Tiket Terselesaikan Periode';
$string['report_general_reports_tickets_resolved_by_period_period'] = 'Periode';
$string['report_general_reports_tickets_resolved_by_period_total_resolved'] = 'Total Terselesaikan Tiket';
$string['report_response_reports_avg_responses_per_ticket_media_respostas_por_ticket'] = 'Rata-rata tanggapan';
$string['report_response_reports_page_description'] = 'Laporan: tanggapan Tiket.';
$string['report_response_reports_page_title'] = 'Laporan tanggapan';
$string['report_status_priority_reports_page_description'] = 'Laporan: Status Prioritas Tiket.';
$string['report_status_priority_reports_page_title'] = 'Laporan Status Prioritas';
$string['report_status_priority_reports_priority_distribution_cat_title'] = 'Prioritas distribution';
$string['report_status_priority_reports_tickets_by_status_cat_title'] = 'Tiket Status';
$string['report_tickets_reports_page_description'] = 'Laporan: Tiket Terbuka / Ditutup.';
$string['report_tickets_reports_page_title'] = 'Tiket';
$string['report_user_reports_avg_response_time_by_user_userid'] = 'ID Pengguna';
$string['report_user_reports_page_description'] = 'Laporan: Pengguna Tiket.';
$string['report_user_reports_page_title'] = 'Laporan Pengguna';
$string['report_user_reports_users_with_most_tickets_open_cat_title'] = 'Pengguna Tiket Terbuka';
$string['savecategory'] = 'Simpan Kategori';
$string['savechanges'] = 'Simpan perubahan';
$string['setting_course'] = 'Tampilkan hanya di dalam kursus';
$string['setting_knowledgebase_menu_description'] = 'Aktifkan opsi ini untuk menampilkan tautan basis pengetahuan di menu navigasi.';
$string['setting_knowledgebase_menu_title'] = 'Display Basis pengetahuan in Menu';
$string['setting_menu_description'] = 'Pilih apakah menu HelpDesk akan ditampilkan di menu sistem bagian atas Moodle.';
$string['setting_menu_title'] = 'Tampilkan di menu';
$string['setting_none'] = 'Jangan tampilkan';
$string['setting_system'] = 'Tampilkan di seluruh sistem';
$string['status'] = 'Status';
$string['status_all'] = 'Semua Tiket';
$string['status_closed'] = 'Ditutup';
$string['status_open'] = 'Terbuka';
$string['status_progress'] = 'Dalam proses';
$string['status_resolved'] = 'Terselesaikan';
$string['subject'] = 'Subjek';
$string['ticketcategory'] = 'Tiket Kategori';
$string['ticketcategoryshort'] = 'Kategori';
$string['ticketclosed'] = 'Tiket ditutup.';
$string['ticketcreated'] = 'Tiket berhasil dibuat';
$string['ticketcreatedat'] = 'Tanggal dibuat';
$string['ticketdescription'] = 'Tiket Deskripsi';
$string['ticketid'] = 'Tiket';
$string['ticketmessage'] = 'Pesan';
$string['ticketnotfound'] = 'Tiket tidak ditemukan';
$string['ticketpriority'] = 'Tiket Prioritas';
$string['ticketpriorityhigh'] = 'Tinggi';
$string['ticketprioritylow'] = 'Rendah';
$string['ticketprioritymedium'] = 'Sedang';
$string['ticketpriorityshort'] = 'Prioritas';
$string['ticketpriorityurgent'] = 'Mendesak';
$string['ticketresponse'] = 'tanggapan Tiket';
$string['ticketresponseandclose'] = 'tanggapan Tiket Ditutup';
$string['ticketresponseandresolved'] = 'tanggapan Tiket Terselesaikan';
$string['tickets'] = 'Semua Tiket';
$string['ticketslist'] = 'Daftar Tiket';
$string['ticketstatus'] = 'Tiket Status';
$string['ticketstatusclosed'] = 'Ditutup';
$string['ticketstatusinprogress'] = 'Dalam proses';
$string['ticketstatusnotclosed'] = 'Semua except Ditutup';
$string['ticketstatusopen'] = 'Terbuka';
$string['ticketstatusresolved'] = 'Terselesaikan';
$string['ticketstatusshort'] = 'Status';
$string['ticketsubject'] = 'Tiket Subjek';
$string['ticketupdated'] = 'Tiket berhasil diperbarui';
$string['updatecategory'] = 'Perbarui Kategori';
$string['userid'] = 'ID Pengguna';
$string['viewticket'] = 'Lihat Tiket';
