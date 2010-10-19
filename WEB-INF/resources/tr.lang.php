<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (http://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors: Igor Melnik
// +----------------------------------------------------------------------+

$i18n_language_name = "Turkish";
$i18n_float_delimiter = ".";

$i18n_month = array ('ocak', 'şubat', 'mart', 'nisan', 'mayis', 'haziran', 'temmuz', 'ağustos', 'eylük', 'ekim', 'kasım', 'aralık');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('pazar', 'pazartesi', 'salı', 'çarşamba', 'perşembe', 'cuma', 'cumartesi');
$i18n_week_sn = array ("p","pt","s","ç","p","c","ct");

//format d/m
$i18n_holidays    = array("01/01","23/04", "01/05", "19/05", "30/08", "20/09", "21/09", "22/09", "29/10", "27/11", "28/11", "29/11", "30/11");

$i18n_key_words = array(

// menu entries
"menu.login" => 'giriş',
"menu.logout" => 'çıkış',
"menu.feedback" => 'geri bildirim',
"menu.help" => 'yardım',
"menu.register" => 'yeni yönetici hesabı yarat',
"menu.edprof" => 'profili düzenle',
"menu.mytime" => 'zamanım',
"menu.report" => 'raporlar',
"menu.project" => 'projeler',
"menu.activity" => 'faaliyetler',
"menu.people" => 'insanlar',
"menu.profile" => 'ekipler',
"menu.migration" => 'dışarı aktar',
"menu.clients" => 'müşteriler',
"menu.services" => 'parola değiştir',
"menu.admin" => 'yönetici',

// error strings
"errors.db_error" => 'veritabanı hatası',
"errors.wrong" => 'hatalı veri \'{0}\'',
"errors.empty" => 'alan \'{0}\' boştur',
"errors.compare" => 'alan \'{0}\'  \'{1}\' alanıyla aynı değildir',
"errors.wr_interval" => 'hatalı aralık',
"errors.wr_project" => 'proje seç',
"errors.wr_activity" => 'faaliyet seç',
"errors.wr_auth" => 'hatalı kullanıcı adı veya parola',
"errors.del_nothing" => 'silinecek veri yok',
"errors.reg_error" => "yeni kullanıcı yaratılamıyor",
"errors.prof_error" => "profil değiştirilemiyor",
"errors.no_user" => "belirttiğiniz kullanıcı yok",
"errors.mt_del_no" => 'zaman kaydı silinemedi',
"errors.mt_del_no_conf" => 'zaman kaydı silinmedi',
"errors.mt_insert" => 'zaman ekleme hatası',
"errors.user_exist" => 'bu e-posta adresini kullanan kullanıcı zaten vardır',
"errors.user_notexists" => 'kullanıcı bulunmuyor',
"errors.user_update" => "kullanıcı bilgisi değiştirilemiyor",
"errors.user_delete" => "kullanıcı bilgisi silinemiyor",
"errors.project_exist" => 'bu isimde proje zaten vardır',
"errors.project_notexists" => 'proje bulunmuyor',
"errors.project_update" => "proje ismi değiştirilemiyor",
"errors.project_add" => 'yeni proje eklenemiyor',
"errors.project_nodel" => 'proje silinemiyor',
"errors.activity_add" => 'yeni faaliyet eklenemiyor',
"errors.activity_exist" => 'bu isimli faaliyet zaten vardır',
"errors.activity_update" => "faaliyet ismi değiştirilemiyor",
"errors.activity_nodel" => 'faaliyet silinemiyor',
"errors.activity_notexists" => 'faaliyet bulunmuyor',
"errors.report_period" => 'hatalı dönem bilgisi',
"errors.search_by_login" => 'bu e-posta adresini kullanan kullanıcı yoktur',
"errors.multiteam_mode" => 'daha fazla hesap yaratamıyorsunuz',
"errors.upload" => 'dosya yükleme hatası',
"errors.client_nodel" => 'müşteri silinemiyor',
"errors.client_notexists" => 'müşteri bulunmuyor',
"errors.ie_sameusers" => 'bir ya da birden fazla e-posta zaten veritabanında bulundu',
"errors.period_lock" => 'kayıt eklenemiyor. dönem kilitli',
// Note to translators: the strings below are missing and must be translated and added
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'giriş',
"button.now" => 'şimdi',
"button.behalf_set" => 'ayarla',
"button.save" => 'kaydet',
"button.delete" => 'sil',
"button.cancel" => 'iptal',
"button.submit" => 'gönder',
"button.ppl_add" => 'yeni kullanıcı ekle',
"button.proj_add" => 'yeni proje ekle',
"button.act_add" => 'yeni faaliyet ekle',
"button.add" => 'ekle',
"button.generate" => 'yarat',
"button.sendpwd" => 'git',
"button.send" => 'gönder',
"button.sendbyemail" => 'e-posta ile gönder',
"button.asnew" => 'yeni olarak kaydet',
"button.profile_add" => 'yeni ekip yarat',
"button.export" => 'ekibi dılarıya aktar',
"button.import" => 'ekibi içeri aktar',
"button.apply" => 'uygula',
"button.clnt_add" => 'yeni müşteri ekle',

"form.filter.project" => 'proje',
"form.filter.filter" => 'sık kullanılan rapor',
"form.filter.filter_new" => 'sık kullanılan olarak kaydet',
// Note to translators: the string below is missing and must be translated and added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'giriş',
// Note to translators: "form.login.login" => 'e-posta', // e-mail has been changed to login
"form.login.password" => 'parola',

// password reminder form attributes
"form.fpass.title" => 'parolayı sıfırla',
// Note to translators: "form.fpass.login" => 'e-posta', // e-mail has been changed to login
"form.fpass.send_pass_str" => 'parola sıfırlama talebi yollandı',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker parola sıfırlama talebi',
"form.fpass.send_pass_body" => "Sayın Kullanıcı,\n\nBirisi, muhtemelen siz, Anuko Time Tracker parolanızın sıfırlanmasını istedi. Parolanızı sıfırlamak isterseniz lütfen bu bağlantıyı takip edin.\n\n%s\n\nAnuko Time Trackerin geliştirilmesi ZoneTick (http://zonetick.com) sponsorluğunda yapılmaktadır.\n\n",
"form.fpass.reset_comment" => "parolanızı sıfırlamak için lütfen parolanızı yazın ve kaydedin",

// administrator form
"form.admin.title" => 'yönetici',
"form.admin.duty_text" => 'yeni bir ekip yönetimi hesabı yaratarak yeni bir ekibi yaratın.<br>ayrıca başka bir Anuko Time Tracker sunucusundan ekip bilgilerini bir xml dosyasından aktarabilirsiniz (e-posta çakışmalarına izin verilmemekte).',
"form.admin.password" => 'parola',
"form.admin.password_confirm" => 'parolayı onayla',
"form.admin.change_pass" => 'yönetici hesabın parolasını değiştir',
"form.admin.profile.title" => 'ekipler',
"form.admin.profile.noprofiles" => 'veritabanınız boş. yeni bir ekip yaratmak için yönetici olarak giriş yapın.',
"form.admin.profile.comment" => 'ekibi sil',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'isim',
"form.admin.profile.th.edit" => 'düzenle',
"form.admin.profile.th.del" => 'sil',
"form.admin.profile.th.active" => 'aktif',
"form.admin.lock.period" => 'günler olarak kilit aralığı',
// Note to translators: the strings below are missing and must be translated and added
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'zamanım',
"form.mytime.edit_title" => 'zaman kaydını düzenliyor',
"form.mytime.del_str" => 'zaman kaydını siliyor',
"form.mytime.time_form" => ' (ss:dd)',
"form.mytime.date" => 'tarih',
"form.mytime.project" => 'proje',
"form.mytime.activity" => 'faaliyet',
"form.mytime.start" => 'başlat',
"form.mytime.finish" => 'tamamla',
"form.mytime.duration" => 'süre',
"form.mytime.note" => 'not',
"form.mytime.behalf" => 'kişiye yönelik günlük çalışma',
"form.mytime.daily" => 'günlük çalışma',
"form.mytime.total" => 'toplam saat: ',
"form.mytime.th.project" => 'proje',
"form.mytime.th.activity" => 'faaliyet',
"form.mytime.th.start" => 'başlat',
"form.mytime.th.finish" => 'tamamla',
"form.mytime.th.duration" => 'süre',
"form.mytime.th.note" => 'not',
"form.mytime.th.edit" => 'düzenle',
"form.mytime.th.delete" => 'sil',
"form.mytime.del_yes" => 'zaman kaydı başarıyla silindi',
"form.mytime.no_finished_rec" => 'bu kayıt sadece başlangıç zamanıyla silindi. bu hata değildir. gerekirse çıkış yapın.',
"form.mytime.billable" => 'faturalandırılabilir',
"form.mytime.warn_tozero_rec" => 'bu zaman kaydı silinmeli çünkü zaman aralığı kilitli',
// Note to translators: the string below is missing and must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'yeni yönetici hesabı yarat',
"form.profile.prof_str" => 'profili düzenliyor',
"form.profile.name" => 'isim',
// Note to translators: "form.profile.login" => 'e-posta', // email has been changed to login
"form.profile.pas1" => 'parola',
"form.profile.pas2" => 'parolayı tekrala',
"form.profile.comp" => 'şirket',
"form.profile.www" => 'şirket web sitesi',
"form.profile.curr" => 'para birimi',
// Note to translators: the string below is missing and must be translated and added
// "form.profile.showchart" => 'show pie charts',
// "form.profile.lang" => 'language',
// "form.profile.lang_set_as_default" => 'set as team default language',
// "form.profile.lang_set_to_all" => 'set to all users of my team',
// "form.profile.lang_allow_user_change" => 'allow users to change their language',
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",
// "form.profile.hide_world_clock" => "hide world clock",
// "form.profile.email" => "email",

// people form attributes
"form.people.ppl_str" => 'insanlar',
"form.people.createu_str" => 'yeni kullanıcı yarat',
"form.people.edit_str" => 'kullanıcı düzenleniyor',
"form.people.del_str" => 'kullanıcı siliniyor',
"form.people.th.name" => 'isim',
// Note to translators: "form.people.th.login" => 'e-posta', // email has been changed to login
"form.people.th.role" => 'rol',
"form.people.th.edit" => 'düzenle',
"form.people.th.del" => 'sil',
"form.people.th.status" => 'durum',
"form.people.th.project" => 'proje',
"form.people.th.rate" => 'tarife',
"form.people.manager" => 'yönetici',
"form.people.comanager" => 'yardımcı yönetici',
"form.people.empl" => 'kullanıcı',
"form.people.name" => 'isim',
// Note to translators: "form.people.login" => 'e-posta', // email has been changed to login
"form.people.pas1" => 'parola',
"form.people.pas2" => 'parolayı tekrarla',
"form.people.rate" => 'varsayılan saat ücreti',
"form.people.comanager" => 'yardımcı yönetici',
"form.people.projects" => 'projeler',
"form.people.email" => "e-posta",

// projects form attributes
"form.project.proj_title" => 'projeler',
"form.project.edit_str" => 'proje düzenleniyor',
"form.project.add_str" => 'yeni proje ekleniyor',
"form.project.del_str" => 'proje siliniyor',
"form.project.th.name" => 'isim',
"form.project.th.edit" => 'düzenle',
"form.project.th.del" => 'sil',
"form.project.name" => 'isim',

// activities form attributes
"form.activity.act_title" => 'faaliyetler',
"form.activity.add_title" => 'yeni faaliyetler ekleniyor',
"form.activity.edit_str" => 'faaliyetler düzenleniyor',
"form.activity.del_str" => 'faaliyetler siliniyor',
"form.activity.name" => 'isim',
"form.activity.project" => 'proje',
"form.activity.th.name" => 'isim',
"form.activity.th.project" => 'proje',
"form.activity.th.edit" => 'düzenle',
"form.activity.th.del" => 'sil',

// report attributes
"form.report.title" => 'raporlar',
"form.report.from" => 'başlangıç tarihi',
"form.report.to" => 'son tarihi',
"form.report.groupby_user" => 'kullanıcı',
"form.report.groupby_project" => 'proje',
"form.report.groupby_activity" => 'faaliyet',
"form.report.duration" => 'süre',
"form.report.start" => 'başlangıç',
"form.report.activity" => 'faaliyet',
"form.report.show_idle" => 'durağanı göster',
"form.report.finish" => 'son',
"form.report.note" => 'not',
"form.report.project" => 'proje',
"form.report.totals_only" => 'sadece toplamlar',
"form.report.total" => 'saat toplamı',
"form.report.th.empllist" => 'kullanıcı',
"form.report.th.date" => 'tarih',
"form.report.th.project" => 'proje',
"form.report.th.activity" => 'faaliyet',
"form.report.th.start" => 'başlangıç',
"form.report.th.finish" => 'son',
"form.report.th.duration" => 'süre',
"form.report.th.note" => 'not',

// mail form attributes
"form.mail.from" => 'kimden',
"form.mail.to" => 'kime',
"form.mail.cc" => 'bilgi',
"form.mail.subject" => 'konu',
"form.mail.comment" => 'yorum',
"form.mail.above" => 'bu raporu e-posta ile yolla',
"form.mail.footer_str" => 'Anuko Time Tracker geliştirilmesi <a href="http://zonetick.com">ZoneTick</a> sponsorluğunda yapılmaktadır',
"form.mail.sending_str" => '<b>ileti yollandı</b>',

// invoice attributes
"form.invoice.title" => 'fatura',
"form.invoice.caption" => 'fatura',
"form.invoice.above" => 'fatura için ek bilgi',
"form.invoice.select_cust" => 'müşteri seç',
"form.invoice.fillform" => 'alanları doldur',
"form.invoice.date" => 'tarih',
"form.invoice.number" => 'fatura numarası',
"form.invoice.tax" => 'vergi',
"form.invoice.discount" => 'indirim',
"form.invoice.daily_subtotals" => 'günlük alt toplamları',
"form.invoice.yourcoo" => 'isminiz<br> ve adresiniz',
"form.invoice.custcoo" => 'müşterinin ismi<br> ve adresi',
"form.invoice.comment" => 'yorum ',
"form.invoice.th.username" => 'kişi',
"form.invoice.th.time" => 'saatler',
"form.invoice.th.rate" => 'tarife',
"form.invoice.th.summ" => 'tutar',
"form.invoice.subtotal" => 'alt toplamı',
"form.invoice.total" => 'toplam',
"form.invoice.customer" => 'müşteri',
"form.invoice.period" => 'faturalandırma dönemi',
"form.invoice.mailinv_above" => 'bu faturayı e-posta ile yolla',
"form.invoice.sending_str" => '<b>fatura yollandı</b>',

"form.migration.zip" => 'sıkıştırma',
"form.migration.file" => 'dosya seç',
"form.migration.import.title" => 'veri içe aktar',
"form.migration.import.success" => 'içe aktarma başarıyla tamamlandı',
"form.migration.import.text" => 'ekip bilgileri bir xml dosyasından içe aktar',
"form.migration.export.title" => 'dışarı aktar',
"form.migration.export.success" => 'dışarı aktarma başarıyla tamamlandı',
"form.migration.export.text" => 'tüm ekip bilgilerinizi bir xml dosyasına aktarabilirsiniz. bu, kendi sunucunuza bilgi aktarmak istediğinizde faydalı olabilir.',
// Note to translators: the strings below are missing and must be added and translated
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'müşteriler',
"form.client.add_title" => 'müşteri ekle',
"form.client.edit_title" => 'müşteriyi düzenle',
"form.client.del_title" => 'müşteriyi sil',
"form.client.th.name" => 'isim',
"form.client.th.edit" => 'düzenle',
"form.client.th.del" => 'sil',
"form.client.name" => 'isim',
"form.client.tax" => 'vergi',
"form.client.discount" => 'indirim',
"form.client.daily_subtotals" => 'günlük alt toplamları',
"form.client.yourcoo" => 'faturada isminiz<br> ve adresiniz',
"form.client.custcoo" => 'adres',
"form.client.comment" => 'yorum ',

// miscellaneous strings
"forward.forgot_password" => 'parolanızı unuttunuz mu?',
"forward.edit" => 'düzenle',
"forward.delete" => 'sil',
"forward.sendbyemail" => 'e-posta ile gönder',
"forward.tocsvfile" => 'bilgileri .csv dosyasına aktar',
"forward.toxmlfile" => 'bilgileri .xml dosyasına aktar',
"forward.geninvoice" => 'fatura yarat',
"forward.change" => 'müşterileri düzenle',
"forward.lockpage" => 'zaman girişleri müdahalelerden korumak için zaman aralığı',

// strings inside contols on forms
"controls.select.project" => '--- proje seç ---',
"controls.select.activity" => '--- faaliyet seç ---',
"controls.select.client" => '--- müşteri seç ---',
"controls.project_bind" => '--- tümü ---',
"controls.all" => '--- tümü ---',
"controls.notbind" => '--- hiç ---',
"controls.per_tm" => 'bu ay',
"controls.per_lm" => 'geçen ay',
"controls.per_tw" => 'bu hafta',
"controls.per_lw" => 'geçen hafta',
"controls.per_td" => 'bugün',
"controls.per_at" => 'tüm zamanlar',
// Note to translators: the string below is missing and must be added and translated
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- zaman dönemi seç ---',
"controls.sel_groupby" => '--- gruplama yok ---',
"controls.inc_billable" => 'faturalandırılabilir',
"controls.inc_nbillable" => 'faturalandırılamaz',
// Note to translators: the string below is missing and must be added and translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'kullanıcı için faaliyetler',
// Note to translators: the string below is missing and must be added and translated
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'dönem için grafik',

"label.pinfo" => '%, %',
"label.pinfo2" => '%',
"label.pbehalf_info" => '% % <b>% adına</b>',
"label.pminfo" => ' (yönetici)',
"label.pcminfo" => ' (yardımcı yönetici)',
"label.painfo" => ' (sistem yönetici)',
"label.time_noentry" => 'giriş yok',
"label.today" => 'bugün',
"label.req_fields" => '* zorunlu bilgi',
"label.sel_project" => 'proje seç',
"label.sel_activity" => 'faaliyet seç',
"label.sel_tp" => 'zaman aralığını seç',
"label.set_tp" => 'ya da tarihleri belirle',
"label.fields" => 'alanları göster',
"label.group_title" => 'gruplandırma kıstası',
"label.include_title" => 'kayıtları dahil et',
"label.inv_str" => 'fatura',
"label.set_empl" => 'kullanıcıları seç',
"label.sel_all" => 'tümünü seç',
"label.sel_none" => 'hiçbirini seçme',
"label.or" => 'ya da',
"label.disable" => 'devre dışı bırak',
"label.enable" => 'devreye sok',
"label.filter" => 'filtre',
"label.timeweek" => 'haftalık toplam',
// Note to translators: the strings below are missing and must be added and translated
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>