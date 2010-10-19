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

$i18n_language_name = "Czech";
$i18n_float_delimiter = ".";

$i18n_month = array ('leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
$i18n_week_sn = array ("ne","po","út","st","čt","pá","so");

//format d/m
$i18n_holidays = array("01/01", "13/04", "01/05", "08/05", "05/07", "06/07", "28/09", "28/10", "17/11", "24/12", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'přihlásit',
"menu.logout" => 'odhlásit',
"menu.feedback" => 'váš názor',
"menu.help" => 'pomoc',
"menu.register" => 'vytvořit nový účet vedoucího',
"menu.edprof" => 'upravit profil',
"menu.mytime" => 'záznam práce',
"menu.report" => 'sestavy',
"menu.project" => 'projekty',
"menu.activity" => 'činnosti',
"menu.people" => 'pracovníci',
"menu.profile" => 'týmy',
"menu.migration" => 'export dat',
"menu.clients" => 'zákazníci',
"menu.services" => 'změna hesla',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'chyba databáze',
"errors.wrong" => 'nesprávná \'{0}\' data',
"errors.empty" => 'pole \'{0}\' je prázdné',
"errors.compare" => 'pole \'{0}\' neodpovídá poli \'{1}\'',
"errors.wr_interval" => 'nevhodný interval',
"errors.wr_project" => 'výběr projektu',
"errors.wr_activity" => 'výběr činnosti',
"errors.wr_auth" => 'nesprávné jméno nebo heslo',
"errors.del_nothing" => 'nejsou žádná data ke smazání',
"errors.reg_error" => "nelze vytvořit nového uživatele",
"errors.prof_error" => "nelze změnit profil",
"errors.no_user" => "uživatel neexistuje",
"errors.mt_del_no" => 'nelze smazat časový záznam',
"errors.mt_del_no_conf" => 'časový záznam nebyl smazán',
"errors.mt_insert" => 'chyba při vkládání časového záznamu',
"errors.user_exist" => 'uživatel s tímto e-mailem již existuje',
"errors.user_notexists" => 'uživatel neexistuje',
"errors.user_update" => "nelze změnit uživatelské údaje",
"errors.user_delete" => "nelze smazat uživatelská data",
"errors.project_exist" => 'projekt tohoto jména již existuje',
"errors.project_notexists" => 'projekt neexistuje',
"errors.project_update" => "nelze změnit jméno projektu",
"errors.project_add" => 'nelze založit nový projekt',
"errors.project_nodel" => 'nelze odstranit projekt',
"errors.activity_add" => 'nelze přidat novou činnost',
"errors.activity_exist" => 'činnost tohoto jména již existuje',
"errors.activity_update" => "nelze změnit název činnosti",
"errors.activity_nodel" => 'nelze odstranit činnost',
"errors.activity_notexists" => 'činnost neexistuje',
"errors.report_period" => 'neplatné období',
"errors.search_by_login" => 'uživatel s tímto e-mailem neexistuje',
"errors.multiteam_mode" => 'nemůžete vytvářet více účtů',
"errors.upload" => 'chyba přenosu souboru',
"errors.client_nodel" => 'nelze odstranit zákazníka',
"errors.client_notexists" => 'zákazník neexistuje',
"errors.ie_sameusers" => 'jeden nebo více e-mailů je již v databázi',
"errors.period_lock" => 'nemohu přidat záznam. období již bylo uzamčeno',
// Note to translators: the 2 strings below are missing in the translation and must be added
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'přihlásit',
"button.now" => 'teď',
"button.behalf_set" => 'nastavit',
"button.save" => 'uložit',
"button.delete" => 'smazat',
"button.cancel" => 'zrušit',
"button.submit" => 'uložit',
"button.ppl_add" => 'přidat uživatele',
"button.proj_add" => 'přidat projekt',
"button.act_add" => 'přidat činnost',
"button.add" => 'přidat',
"button.generate" => 'vytvořit',
"button.sendpwd" => 'přejít',
"button.send" => 'poslat',
"button.sendbyemail" => 'poslat e-mailem',
"button.asnew" => 'uložit jako nový',
"button.profile_add" => 'vytvořit nový tým',
"button.export" => 'exportovat tým',
"button.import" => 'importovat tým',
"button.apply" => 'provést',
"button.clnt_add" => 'přidat nového zákazníka',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'oblíbená sestava',
"form.filter.filter_new" => 'uložit jako oblíbenou sestavu',
"form.filter.filter_confirm_delete" => 'opravdu chceš vymazat tuto položku z oblíbených?',

// login form attributes
"form.login.title" => 'přihlásit',
"form.login.login" => 'přihlásit',
"form.login.password" => 'heslo',

// password reminder form attributes
"form.fpass.title" => 'resetovat heslo',
"form.fpass.login" => 'přihlásit',
"form.fpass.send_pass_str" => 'zaslán požadavek k vymazání hesla',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker požadavek na vymazání hesla',
"form.fpass.send_pass_body" => "Vážený uživateli,\n\nNěkdo, asi Vy, požaduje vymazat Vaše Anuko Time Tracker heslo. Prosím navštivte následující odkaz k potvrzení prováděné změny.\n\n%s\n\nVývoj Anuko Time Tracker je podporován firmou ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "pro změnu hesla jej napište a zvolte uložit",

// administrator form
"form.admin.title" => 'administrator',
"form.admin.duty_text" => 'vytvořit nový tým prostřednictvím účtu týmového manažera.<br>můžete také importovat týmová data z xml souboru z jiného time tracker serveru (nejsou povoleny shody e-mailových adres!).',
"form.admin.password" => 'heslo',
"form.admin.password_confirm" => 'potvrdit heslo',
"form.admin.change_pass" => 'změna hesla účtu administrator',
"form.admin.profile.title" => 'týmy',
"form.admin.profile.noprofiles" => 'vaše databáze je prázdná. přihlašte se jako admin a vytvořte nový tým.',
"form.admin.profile.comment" => 'smazat tým',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'jméno',
"form.admin.profile.th.edit" => 'upravit',
"form.admin.profile.th.del" => 'smazat',
"form.admin.profile.th.active" => 'aktovní',
"form.admin.lock.period" => 'období uzamčení ve dnech',
// Note to translators: the 6 strings below are missing in the translation and must be added
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'můj deník',
"form.mytime.edit_title" => 'upravit časový záznam',
"form.mytime.del_str" => 'smazat časový záznam',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'datum',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'činnost',
"form.mytime.start" => 'začátek',
"form.mytime.finish" => 'konec',
"form.mytime.duration" => 'trvání',
"form.mytime.note" => 'poznámka',
"form.mytime.behalf" => 'denní práce pracovníka',
"form.mytime.daily" => 'denní práce',
"form.mytime.total" => 'součet hodin: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'činnost',
"form.mytime.th.start" => 'začátek',
"form.mytime.th.finish" => 'konec',
"form.mytime.th.duration" => 'trvání',
"form.mytime.th.note" => 'poznámka',
"form.mytime.th.edit" => 'upravit',
"form.mytime.th.delete" => 'odstranit',
"form.mytime.del_yes" => 'časový záznam úspěšně odstraněn',
"form.mytime.no_finished_rec" => 'záznam byl uložen pouze s časem zahájení. není to chyba. můžete se odhlásit, potřebujete-li.',
"form.mytime.billable" => 'k fakturaci',
"form.mytime.warn_tozero_rec" => 'tento záznam musí být smazán, neboť období je uzamčeno',
// Note to translators: the string below is missing in the translation and must be added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'vytvořit nový manažerský účet',
"form.profile.prof_str" => 'upravit profil',
"form.profile.name" => 'jméno',
"form.profile.login" => 'přihlásit',
"form.profile.pas1" => 'heslo',
"form.profile.pas2" => 'potvrdit heslo',
"form.profile.comp" => 'firma',
"form.profile.www" => 'firemní www stránky',
"form.profile.curr" => 'měna',
"form.profile.showchart" => 'zobrazuj grafy',
"form.profile.lang" => 'jazyk',
"form.profile.lang_set_as_default" => 'nastavit jako předvolený jazyk',
"form.profile.lang_set_to_all" => 'nastavit všem členům týmu',
"form.profile.lang_allow_user_change" => 'povolit pracovníkům měnit jazyk',
// Note to translators: the 6 strings below are missing in the translation and must be added
// "form.profile.custom_date_format" => "date format",
// "form.profile.custom_time_format" => "time format",
// "form.profile.default_format" => "(default)",
// "form.profile.start_week" => "first day of week",
// "form.profile.hide_world_clock" => "hide world clock",
// "form.profile.email" => "email",

// people form attributes
"form.people.ppl_str" => 'pracovnící',
"form.people.createu_str" => 'vytváření nového uživatele',
"form.people.edit_str" => 'nastavení uživatele',
"form.people.del_str" => 'smazat uživatele',
"form.people.th.name" => 'jméno',
"form.people.th.login" => 'přihlásit',
"form.people.th.role" => 'role',
"form.people.th.edit" => 'upravit',
"form.people.th.del" => 'smazat',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'sazba',
"form.people.manager" => 'manažer',
"form.people.comanager" => 'spolumanažer',
"form.people.empl" => 'uživatel',
"form.people.name" => 'jméno',
"form.people.login" => 'přihlásit',
"form.people.pas1" => 'heslo',
"form.people.pas2" => 'potvrdit heslo',
"form.people.rate" => 'hodinová sazba',
"form.people.comanager" => 'spolumanažer',
"form.people.projects" => 'projekty',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projekty',
"form.project.edit_str" => 'upravit projekt',
"form.project.add_str" => 'pridat nový projekt',
"form.project.del_str" => 'smazat projekt',
"form.project.th.name" => 'jméno',
"form.project.th.edit" => 'upravit',
"form.project.th.del" => 'smazat',
"form.project.name" => 'Název',

// activities form attributes
"form.activity.act_title" => 'činnosti',
"form.activity.add_title" => 'přidat činnost',
"form.activity.edit_str" => 'upravit činnost',
"form.activity.del_str" => 'smazat činnost',
"form.activity.name" => 'název činnosti',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'jméno',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'upravit',
"form.activity.th.del" => 'smazat',

// report attributes
"form.report.title" => 'sestavy',
"form.report.from" => 'počáteční datum',
"form.report.to" => 'koncové datum',
"form.report.groupby_user" => 'uživatel',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'činnost',
"form.report.duration" => 'trvání',
"form.report.start" => 'počátek',
"form.report.activity" => 'činnost',
"form.report.show_idle" => 'ukázat nečinné',
"form.report.finish" => 'konec',
"form.report.note" => 'poznámka',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'pouze součty',
"form.report.total" => 'součty hodin',
"form.report.th.empllist" => 'uzivatel',
"form.report.th.date" => 'datum',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'činnost',
"form.report.th.start" => 'počátek',
"form.report.th.finish" => 'konec',
"form.report.th.duration" => 'trvání',
"form.report.th.note" => 'poznámka',

// mail form attributes
"form.mail.from" => 'od',
"form.mail.to" => 'komu',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'předmět',
"form.mail.comment" => 'komentář',
"form.mail.above" => 'poslat sestavu e-mailem',
"form.mail.footer_str" => 'Anuko Time Tracker je podporován firmou <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>zpráva odeslána</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'fakturační informace',
"form.invoice.select_cust" => 'výběr firmy',
"form.invoice.fillform" => 'vyplňte pole',
"form.invoice.date" => 'datum',
"form.invoice.number" => 'faktura číslo',
"form.invoice.tax" => 'DPH',
"form.invoice.discount" => 'sleva',
"form.invoice.daily_subtotals" => 'denní součty',
"form.invoice.yourcoo" => 'vaše jméno<br> adresa',
"form.invoice.custcoo" => 'zákazník<br> adresa',
"form.invoice.comment" => 'komentář ',
"form.invoice.th.username" => 'osoba',
"form.invoice.th.time" => 'hodin',
"form.invoice.th.rate" => 'sazba',
"form.invoice.th.summ" => 'množství',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.total" => 'celkem',
"form.invoice.customer" => 'zákazník',
"form.invoice.period" => 'účetní období',
"form.invoice.mailinv_above" => 'poslat fakturu e-mailem',
"form.invoice.sending_str" => '<b>faktura odeslána</b>',

"form.migration.zip" => 'komprese',
"form.migration.file" => 'výběr souboru',
"form.migration.import.title" => 'importovat data',
"form.migration.import.success" => 'import byl úspěšně dokončen',
"form.migration.import.text" => 'importovat týmová data z xml souboru',
"form.migration.export.title" => 'exportovat data',
"form.migration.export.success" => 'export byl úspěšně dokončen',
"form.migration.export.text" => 'můžete exportova týmová data do xml souboru. může se to hodit pro přesun na jiný server.',
// Note to translators: the string below is missing in the translation and must be added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'zákazníci',
"form.client.add_title" => 'přidat zákazníka',
"form.client.edit_title" => 'upravit zákazníka',
"form.client.del_title" => 'smazat zákazníka',
"form.client.th.name" => 'jméno',
"form.client.th.edit" => 'upravit',
"form.client.th.del" => 'smazat',
"form.client.name" => 'jméno',
"form.client.tax" => 'DPH',
"form.client.discount" => 'sleva',
"form.client.daily_subtotals" => 'denní součty',
"form.client.yourcoo" => 'vaše jméno<br> a adresa pro fakturaci',
"form.client.custcoo" => 'adresa',
"form.client.comment" => 'poznámka ',

// miscellaneous strings
"forward.forgot_password" => 'zapomenuté heslo?',
"forward.edit" => 'upravit',
"forward.delete" => 'smazat',
"forward.sendbyemail" => 'poslat e-mailem',
"forward.tocsvfile" => 'exportovat data do .csv souboru',
"forward.toxmlfile" => 'exportovat data do .xml souboru',
"forward.geninvoice" => 'vytvořit fakturu',
"forward.change" => 'upravit zákazníky',
// Note to translators: the string below must be translated
// "forward.lockpage" => 'interval to lock time entries from modifications', 

// strings inside contols on forms
"controls.select.project" => '--- výběr projektu ---',
"controls.select.activity" => '--- výběr činnosti ---',
"controls.select.client" => '--- výběr zákazníka ---',
"controls.project_bind" => '--- všechny ---',
"controls.all" => '--- vše ---',
"controls.notbind" => '--- nic ---',
"controls.per_tm" => 'tento měsíc',
"controls.per_lm" => 'minulý měsíc',
"controls.per_tw" => 'tento týden',
"controls.per_lw" => 'minulý týden',
"controls.per_td" => 'dnes',
"controls.per_at" => 'od počátku',
"controls.per_ty" => 'letos',
"controls.sel_period" => '--- výběr období ---',
"controls.sel_groupby" => '--- vše dohromady ---',
"controls.inc_billable" => 'k fakturaci',
"controls.inc_nbillable" => 'mimo fakturaci',
// Note to translators: the string below must be translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'činnosti uživatele',
"label.chart.title2" => 'projekty uživatele',
"label.chart.period" => 'přehled za období',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
// Note to translators: the string below must be translated
// "label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (manažer)',
"label.pcminfo" => ' (co-manažer)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'žádné záznamy',
"label.today" => 'dnes',
"label.req_fields" => '* nutno vyplnit',
"label.sel_project" => 'výběr projektu',
"label.sel_activity" => 'výběr činnosti',
"label.sel_tp" => 'výberte období',
"label.set_tp" => 'nebo určete dny',
"label.fields" => 'zobrazit pole',
"label.group_title" => 'seskupit podle',
"label.include_title" => 'včetně záznamů',
"label.inv_str" => 'faktura',
"label.set_empl" => 'výběr uživatelů',
"label.sel_all" => 'vybrat všechno',
"label.sel_none" => 'zrušit výběr',
"label.or" => 'nebo',
"label.disable" => 'zakázat',
"label.enable" => 'povolit',
"label.filter" => 'filtr',
"label.timeweek" => 'celkem za týden',
"label.hrs" => 'hodin'
// Note to translators: the 3 strings below are missing in the translation and must be added
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>