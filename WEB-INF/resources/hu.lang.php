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

$i18n_language_name = "Hungarian";
$i18n_float_delimiter = ".";

$i18n_month = array ('január', 'február', 'március', 'április', 'május', 'június', 'július', 'augusztus', 'szeptember', 'október', 'november', 'december');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('vasárnap', 'hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat');
$i18n_week_sn = array ("v","h","k","sz","cs","p","sz");

//format d/m
$i18n_holidays = array("01/01","02/01", "15/03", "12/04", "13/04", "01/05", "31/05", "01/06", "20/08", "21/08", "23/10", "01/11", "24/12", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'bejelentkezés',
"menu.logout" => 'kijelentkezés',
"menu.feedback"  => 'megjegyzés',
"menu.help" => 'segítség',
"menu.register" => 'új vezetői jogosultság létrehozása',
"menu.edprof" => 'profil szerkesztése',
"menu.mytime" => 'munkaidő',
"menu.report" => 'riportok',
"menu.project" => 'projektek',
"menu.activity" => 'tevékenységek',
"menu.people" => 'munkatársak',
"menu.profile" => 'csoportok',
"menu.migration" => 'az adatok exportálása',
"menu.clients" => 'ügyfelek',
"menu.services" => 'jelszó változtatás',
// Note to translators: the string is missing and must be added and translated // "menu.admin" => 'admin',

// error strings
"errors.db_error" => 'adatbázis hiba',
"errors.wrong" => 'hibás \'{0}\' mező tartalma',
"errors.empty" => 'a \'{0}\' mező üres',
"errors.compare" => 'A \'{0}\' mező tartalma nem egyezik meg a \'{1}\' mező tartalmával!',
"errors.wr_interval" => 'hibás időszak megadás',
"errors.wr_project" => 'válassz projektet',
"errors.wr_activity" => 'válassz tevékenységet',
"errors.wr_auth" => 'hibás bejelentkezési adatok',
"errors.del_nothing" => 'nincs mit törölni',
"errors.reg_error" => "nem lehet létrehozni új dolgozót",
"errors.prof_error" => "nem lehet megváltoztatni a profil tartalmá",
"errors.no_user" => "nincs ilyen nevű dolgozó",
"errors.mt_del_no" => 'nem lehet törölni a bejegyzett munkaidőt',
"errors.mt_del_no_conf" => 'nem lett törölve a bejegyzés',
"errors.mt_insert" => 'hiba az időpont beszúrás során',
"errors.user_exist" => 'ilyen e-mail címmel már van definiálva valaki',
"errors.user_notexists" => 'nincs ilyen nevű felhasználó',
"errors.user_update" => "nem lehet megváltoztatni a felhasználó adatait",
"errors.user_delete" => "nem lehet törölni a felhasználó adatait",
"errors.project_exist" => 'ilyen nevű projekt már létezik',
"errors.project_notexists" => 'nincs ilyen nevű projekt',
"errors.project_update" => "nem lehet megváltoztatni a projekt nevét",
"errors.project_add" => 'nem lehet hozzáadni új projektet',
"errors.project_nodel" => 'nem lehet törölni a projektet',
"errors.activity_add" => 'nem lehet hozzáadni új tevékenységet',
"errors.activity_exist" => 'ilyen névvel már van definiálva tevékenység',
"errors.activity_update" => "nem lehet megváltoztatni a tevékenység nevét",
"errors.activity_nodel" => 'nem lehet törölni a tevékenységet',
"errors.activity_notexists" => 'nincs ilyen tevékenység',
"errors.report_period" => 'a megadott időszak nem valós',
"errors.search_by_login" => 'nincs ilyen e-mail címmel definiált felhasználó',
"errors.multiteam_mode" => 'nem lehet létrehozni több felhasználót',
"errors.upload" => 'file feltöltési hiba',
"errors.client_nodel" => 'nem lehet törölni az ügyfelet',
"errors.client_notexists" => 'nincs ilyen nevű ügyfél',
"errors.ie_sameusers" => 'több e-mail cím is definiálva van az adatbázisban',
// Note to translators: the strings below are missing and must be added and translated 
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'bejelentkezés',
"button.now" => 'most',
"button.behalf_set" => 'beállítás',
"button.save" => 'mentés',
"button.delete" => 'törlés',
"button.cancel" => 'vissza',
"button.submit" => 'mentés',
"button.ppl_add" => 'új felhasználó felvétele',
"button.proj_add" => 'új projekt felvétele',
"button.act_add" => 'új tevékenyég felvétele',
"button.add" => 'hozzáadás',
"button.generate" => 'generálás',
"button.sendpwd" => 'mehet',
"button.send" => 'küld',
"button.sendbyemail" => 'küldés e-mail-ben',
"button.asnew" => 'mentés újként',
"button.profile_add" => 'új csoport létrehozása',
"button.export" => 'csoportok exportálása',
"button.import" => 'csoportok importálása',
"button.apply" => 'alkalmaz',
"button.clnt_add" => 'új ügyfél hozzáadása',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'előre definiált riport formátum',
"form.filter.filter_new" => 'mentsük el ezt a riport formátumot',
// Note to translators: the string below is missing and must be added and translated
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'bejelentkezés',
// Note to translators: "form.login.login" => 'e-mail cím', // email has been changed to login
"form.login.password" => 'jelszó',

// password reminder form attributes
"form.fpass.title" => 'a jelszó alap állapotra állítása',
// Note to translators: "form.fpass.login" => 'e-mail cím', // email has been changed to login
"form.fpass.send_pass_str" => 'jelszó alap állapotra állítása megkezdve',
"form.fpass.send_pass_subj" => 'A jelszó alap állapotra állítása a Anuko TimeTracker-ben',
// Note to translators: the string below must be translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "a jelszót a megváltoztatásához írja be és mentse el",

// administrator form
"form.admin.title" => 'Adminisztrátor',
"form.admin.duty_text" => 'új csoport létrehozása egy csoport-vezetői jogosultsággal.<br>a csoport adatokat importálhatjuk XML-ből (csak az e-mail címek ne ütközzenek).',
"form.admin.password" => 'jelszó',
"form.admin.password_confirm" => 'jelszó elfogadása',
"form.admin.change_pass" => 'az adminisztrátori jelszó megváltoztatása',
"form.admin.profile.title" => 'csoportok',
"form.admin.profile.noprofiles" => 'az adatbázis üres. lépj be adminisztrátorként és hozz létre egyet.',
"form.admin.profile.comment" => 'csoport törlése',
"form.admin.profile.th.id" => 'azonosító',
"form.admin.profile.th.name" => 'név',
"form.admin.profile.th.edit" => 'szerkesztés',
"form.admin.profile.th.del" => 'törlés',
"form.admin.profile.th.active" => 'aktív',
// Note to translators: the strings below are missing and must be added and translated 
// "form.admin.lock.period" => 'lock interval in days',
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'munkaidőm',
"form.mytime.edit_title" => 'szerkesztés',
"form.mytime.del_str" => 'törlés',
"form.mytime.time_form" => ' (óó:pp)',
"form.mytime.date" => 'dátum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tevékenység',
"form.mytime.start" => 'kezdete',
"form.mytime.finish" => 'vége',
"form.mytime.duration" => 'hossz',
"form.mytime.note" => 'megjegyzés',
"form.mytime.behalf" => 'napi tevékenység lista, munkatárs:',
"form.mytime.daily" => 'napi munka',
"form.mytime.total" => 'összesített óraszám: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'tevékenység',
"form.mytime.th.start" => 'kezdete',
"form.mytime.th.finish" => 'vége',
"form.mytime.th.duration" => 'hossz',
"form.mytime.th.note" => 'megjegyzés',
"form.mytime.th.edit" => 'szerkesztés',
"form.mytime.th.delete" => 'törlés',
"form.mytime.del_yes" => 'a bejegyzés törölve',
"form.mytime.no_finished_rec" => 'csak az munka kezdete lett megjelölve, ha később visszalépsz a rendszerbe beállíthatod a vég-időpontot...',
// Note to translators: the strings below are missing and must be added and translated 
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'új vezetői jogosultság létrehozása',
"form.profile.prof_str" => 'profil szerkesztése',
"form.profile.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.profile.login" => 'login',
"form.profile.pas1" => 'jelszó',
"form.profile.pas2" => 'jelszó megerősítése',
"form.profile.comp" => 'cég név',
"form.profile.www" => 'a cég WEB oldala',
"form.profile.curr" => 'pénznem',
// Note to translators: the strings below are missing and must be added and translated 
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
"form.people.ppl_str" => 'munkatársak',
"form.people.createu_str" => 'új munkatárs hozzáadása',
"form.people.edit_str" => 'munkatárs adatainak szerkesztése',
"form.people.del_str" => 'munkatárs adatainak törlése',
"form.people.th.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.th.login" => 'login',
"form.people.th.role" => 'szerepkör',
"form.people.th.edit" => 'szerkesztés',
"form.people.th.del" => 'törlés',
"form.people.th.status" => 'státusz',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'tarifa',
"form.people.manager" => 'vezető',
"form.people.comanager" => 'helyettes',
"form.people.empl" => 'dolgozó',
"form.people.name" => 'név',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.login" => 'login',
"form.people.pas1" => 'jelszó',
"form.people.pas2" => 'jelszó megerősítése',
"form.people.rate" => 'általános óradíj',
"form.people.comanager" => 'helyettes',
"form.people.projects" => 'projektek',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projektek',
"form.project.edit_str" => 'projekt adatainak szerkesztése',
"form.project.add_str" => 'új projekt hozzáadása',
"form.project.del_str" => 'projekt törlése',
"form.project.th.name" => 'név',
"form.project.th.edit" => 'szerkesztés',
"form.project.th.del" => 'törlés',
"form.project.name" => 'név',

// activities form attributes
"form.activity.act_title" => 'tevékenységek',
"form.activity.add_title" => 'új tevékenyég felvétele',
"form.activity.edit_str" => 'tevékenység szerkesztése',
"form.activity.del_str" => 'tevékenység törlése',
"form.activity.name" => 'név',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'név',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'szerkesztés',
"form.activity.th.del" => 'törlés',

// report attributes
"form.report.title" => 'riportok',
"form.report.from" => 'kezdő időpont',
"form.report.to" => 'vég időpont',
"form.report.groupby_user" => 'személyek szerint',
"form.report.groupby_project" => 'projektek szerint',
"form.report.groupby_activity" => 'tevékenységek szerint',
"form.report.duration" => 'időtartam',
"form.report.start" => 'kezdet',
"form.report.activity" => 'tevékenység',
"form.report.show_idle" => 'az üres időszakok megjelenítése',
"form.report.finish" => 'befejezés',
"form.report.note" => 'megjegyzés',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'csak a teljes óraszám',
"form.report.total" => 'összesített óraszám',
"form.report.th.empllist" => 'dolgozó',
"form.report.th.date" => 'dátum',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'tevékenység',
"form.report.th.start" => 'elkezdve',
"form.report.th.finish" => 'befejezve',
"form.report.th.duration" => 'időtartam',
"form.report.th.note" => 'megjegyzés',

// mail form attributes
"form.mail.from" => 'feladó',
"form.mail.to" => 'címzett',
"form.mail.cc" => 'másolatot kap',
"form.mail.subject" => 'tárgy',
"form.mail.comment" => 'megjegyzés',
"form.mail.above" => 'küldjük el ezt a riportot e-mail-ben...',
// Note to translators: the string below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>az üzenet elküldve</b>',

// invoice attributes
"form.invoice.title" => 'számla',
"form.invoice.caption" => 'Számla',
"form.invoice.above" => 'a számlához tartozó adatok',
"form.invoice.select_cust" => 'válassz ügyfelet',
"form.invoice.fillform" => 'töltsd ki a mezőket',
"form.invoice.date" => 'Dátum',
"form.invoice.number" => 'számla azonosító száma',
"form.invoice.tax" => 'adó',
"form.invoice.discount" => 'kedvezmény',
"form.invoice.daily_subtotals" => 'napi részösszeg',
"form.invoice.yourcoo" => 'az ön neve<br> és címe',
"form.invoice.custcoo" => 'az ügyfél nevebr> és címe',
"form.invoice.comment" => 'megjegyzés ',
"form.invoice.th.username" => 'személy',
"form.invoice.th.time" => 'óra',
"form.invoice.th.rate" => 'tarifa',
"form.invoice.th.summ" => 'darab',
"form.invoice.subtotal" => 'részösszeg',
"form.invoice.total" => 'összesen',
"form.invoice.customer" => 'Ügyfél',
"form.invoice.period" => 'Számlázási időszak',
"form.invoice.mailinv_above" => 'küldjük el ezt a számlát e-mail-en',
"form.invoice.sending_str" => '<b>a számla elküldve</b>',

"form.migration.zip" => 'tömörítés',
"form.migration.file" => 'válassz file-nevet',
"form.migration.import.title" => 'adatok importálása',
"form.migration.import.success" => 'az importálás sikeresen véget ért',
"form.migration.import.text" => 'csoport adatok importja XML file-ból',
"form.migration.export.title" => 'az adatok exportálása',
"form.migration.export.success" => 'az exportálás sikeres volt',
"form.migration.export.text" => 'kimentheted az összes felvitt csoport adatait egy XML file-ba, ami megkönnyíti a TimeTracker szerverek közötti adatátvitelt...',
// Note to translators: the strings below are missing and must be added and translated 
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title"=> 'ügyfelek',
"form.client.add_title" => 'új ügyfél hozzáadása',
"form.client.edit_title" => 'ügyfél adatainak szerkesztése',
"form.client.del_title" => 'ügyfél törlése',
"form.client.th.name" => 'név',
"form.client.th.edit" => 'szerkesztés',
"form.client.th.del" => 'törlés',
"form.client.name" => 'név',
"form.client.tax" => 'adó',
"form.client.discount" => 'kedvezmény',
"form.client.daily_subtotals" => 'napi részösszeg',
"form.client.yourcoo" => 'az Ön neve<br> és számlázási címe',
"form.client.custcoo" => 'cím',
"form.client.comment" => 'megjegyzés ',

// miscellaneous strings
"forward.forgot_password" => 'elfelejtetted a jelszót?',
"forward.edit" => 'szerkesztés',
"forward.delete" => 'törlés',
"forward.sendbyemail" => 'küldés e-mail-ben',
"forward.tocsvfile" => 'az adatok exportálása CSV file-ba',
// Note to translators: the string below is missing and must be added and translated 
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'számla készítés',
"forward.change" => 'ügyfelek adatainak beállítása',
// Note to translators: the string below is missing and must be added and translated 
// "forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- válassz projektet ---',
"controls.select.activity" => '--- válassz tevékenységet ---',
"controls.select.client" => '--- válassz ügyfelet ---',
"controls.project_bind" => '--- összes ---',
"controls.all" => '--- összes ---',
"controls.notbind" => '--- nincs ---',
"controls.per_tm" => 'ebben a hónapban',
"controls.per_lm" => 'múlt hónapban',
"controls.per_tw" => 'ezen a héten',
"controls.per_lw" => 'múlt héten',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- válassz időszakot ---',
"controls.sel_groupby" => '--- csoportosítás nélkül ---',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be added and translated 
// "label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>helyett %s</b>',
"label.pminfo" => ' (vezető)',
"label.pcminfo" => ' (helyettes)',
"label.painfo" => ' (adminisztrátor)',
"label.time_noentry" => 'nincs bejegyzés',
"label.today" => 'ma',
"label.req_fields" => '* kötelezően kitöltendő mezők',
"label.sel_project" => 'válassz projektet',
"label.sel_activity" => 'válassz tevékenységet',
"label.sel_tp" => 'jelölj meg egy időszakot',
"label.set_tp" => '... vagy állíts be konkrét dátumot',
"label.fields" => 'csak a kijelölt mezők fognak szerepelni a riportban',
"label.group_title" => 'csoportosítva',
// Note to translators: the string below is missing and must be added and translated 
// "label.include_title" => 'include records',
"label.inv_str" => 'számla',
"label.set_empl" => 'válassz dolgozót',
"label.sel_all" => 'mindenkit kijelöl',
"label.sel_none" => 'senkit nem jelöl ki',
"label.or" => 'vagy',
"label.disable" => 'tiltva',
"label.enable" => 'engedélyezve',
"label.filter" => 'szűrés',
// Note to translators: the strings below are missing and must be added and translated 
//"label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>