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

$i18n_language_name = "Danish";
$i18n_float_delimiter = ".";

$i18n_month = array ('januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag');
$i18n_week_sn = array ("sø","ma","ti","on","to","fr","lø");

//format d/m
$i18n_holidays = array("01/01", "09/04", "10/04", "12/04", "13/04", "08/05", "21/05", "31/05", "01/06", "05/06", "24/12", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'login',
"menu.logout" => 'logout',
"menu.feedback" => 'send din mening',
"menu.help" => 'hjælp',
"menu.register" => 'lav en ny manager konto',
"menu.edprof" => 'rediger profil',
"menu.mytime" => 'min tid',
"menu.report" => 'rapporter',
"menu.project" => 'projekter',
"menu.activity" => 'aktiviteter',
"menu.people" => 'brugere',
"menu.profile" => 'teams',
"menu.migration" => 'exporter data',
"menu.clients" => 'kunder',
// A note to translators: the 2 strings below are missing in the translation and must be added
// "menu.services" => 'options',
// "menu.admin" => 'admin',

// error strings
"errors.db_error" => 'database fejl',
"errors.wrong" => 'forkert \'{0}\' data',
"errors.empty" => 'felt \'{0}\' er tom',
"errors.compare" => 'felt \'{0}\' er ikke lig med \'{1}\'',
"errors.wr_interval" => 'forkert interval',
"errors.wr_project" => 'vælg projekt',
"errors.wr_activity" => 'vælg aktivitet',
"errors.wr_auth" => 'forkert login eller password',
"errors.del_nothing" => 'ikke noget at slette',
"errors.reg_error" => "kunne ikke danne ny bruger",
"errors.prof_error" => "kunne ikke skifte profil",
"errors.no_user" => "der er ikke en sеdan bruger",
"errors.mt_del_no" => 'kunne ikke slette tids registrering',
"errors.mt_del_no_conf" => 'tidsregistrering kunne ikke slettes',
"errors.mt_insert" => 'tidsregistrering blev ikke gemt',
// Note to translators: "errors.user_exist" => 'der eksitrerer en bruger med denne e-mail adresse', // e-mail must be changed to login.
"errors.user_notexists" => 'bruger eksisterer ikke',
"errors.user_update" => "kunne ikke ændrer bruger data",
"errors.user_delete" => "kunne ikke slettet bruger data",
"errors.project_exist" => 'der eksiterer allerede et projekt med det navn',
"errors.project_notexists" => 'projekt eksiterer ikke',
"errors.project_update" => "kunne ikke ændrer projekt navn",
"errors.project_add" => 'kunne ikke tilføje nyt projekt',
"errors.project_nodel"=> 'kunne ikke slettet projekt',
"errors.activity_add" => 'kunne ikke tilføje ny aktivitet',
"errors.activity_exist" => 'aktivitet med det navn eksisterer allerede',
"errors.activity_update" => "kunne ikke ændrer aktivitetsnavn",
"errors.activity_nodel" => 'kunne ikke slettet aktivitet',
"errors.activity_notexists" => 'aktivitet eksisterer ikke',
"errors.report_period" => 'forkert periode',
"errors.search_by_login" => 'ingen bruger med denne login',
"errors.multiteam_mode" => 'du kan ikke lave flere bruger konti',
"errors.upload" => 'fil upload problem',
"errors.client_nodel" => 'kunne ikke slette kunde',
"errors.client_notexists" => 'kunde eksisterer ikke',
"errors.ie_sameusers" => 'en eller flere emails er allerede i databasen',
// Note to translators: the 3 strings below are missing in the translation and must be added
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'login',
"button.now" => 'nu',
"button.behalf_set" => 'sæt',
"button.save" => 'gem',
"button.delete" => 'slet',
"button.cancel" => 'fortryd',
"button.submit" => 'gem',
"button.ppl_add" => 'tilføj bruger',
"button.proj_add" => 'tilføj project',
"button.act_add" => 'tilføj aktivitet',
"button.add" => 'tilføj',
"button.generate" => 'dan',
"button.sendpwd" => 'gе til',
// Note to translators: the strings below must be translated
// "button.send" => 'send',
// "button.sendbyemail" => 'send som e-mail',
"button.asnew" => 'gem som ny',
"button.profile_add" => 'lav et nyt team',
"button.export" => 'exporter team',
"button.import" => 'importer team',
"button.apply" => 'gem',
"button.clnt_add" => 'tilføj kunde',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'favorit rapport',
"form.filter.filter_new" => 'gem som favorit',
// Note to translators: the string below is missing in the translation and must be added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',
"form.login.password" => 'adgangskode',

// password reminder form attributes
"form.fpass.title" => 'nulstil adgangskode',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'ønske om ny adgangskode sendt',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker adgangskode nulstil ',
// Note to translators: the string below is incompletely translated and must be corrected
// "form.fpass.send_pass_body" => "Kære bruger,\n\n Nogen, sikkert dig, Bad om at fе din adgangskode nulstille. Følg dette link hvis du ønsker din adgangskode nulstillet.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "for at nulstille din adgangskode, tast det og klik gem",

// administrator form
"form.admin.title" => 'administrator',
// Note to translators: "form.admin.duty_text" => 'Lav et nyt team, ved at lave en team manager konto.<br>Du kan ogsе importerer fra en xml fil fra en anden Anuko Time Tracker server (no login collisions are allowed).', // the phrase in brackets must be translated
"form.admin.password" => 'adgangskode',
"form.admin.password_confirm" => 'gentag adgangskode',
"form.admin.change_pass" => 'skift adgagnskode pе administrator konto',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'din database er tom, login som administrator og lav et nyt team',
"form.admin.profile.comment" => 'slet team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'navn',
"form.admin.profile.th.edit" => 'rediger',
"form.admin.profile.th.del" => 'slet',
"form.admin.profile.th.active" => 'aktive',
// Note to translators: the 7 strings below are missing in the translation and must be added
// "form.admin.lock.period" => 'lock interval in days',
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'min tid',
"form.mytime.edit_title" => 'rediger tids post',
"form.mytime.del_str" => 'slet tids post',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'dato',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'aktivitet',
"form.mytime.start" => 'start',
"form.mytime.finish" => 'slut',
"form.mytime.duration" => 'varighed',
"form.mytime.note" => 'notat',
"form.mytime.behalf" => 'dagligt arbejde for',
"form.mytime.daily" => 'dagligt arbejde',
"form.mytime.total" => 'timer i alt: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'aktivitet',
"form.mytime.th.start" => 'start',
"form.mytime.th.finish" => 'slut',
"form.mytime.th.duration" => 'varighed',
"form.mytime.th.note" => 'notat',
"form.mytime.th.edit" => 'rediger',
"form.mytime.th.delete" => 'slet',
"form.mytime.del_yes" => 'tids post slettet',
"form.mytime.no_finished_rec" => 'denne post er gemt med kun en start tid. Det er ikke nødvendigvis en fejl. Du kan nu logge af.',
// Note to translators: the 3 strings below are missing in the translation and need to be added
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'Dan ny manager konot',
"form.profile.prof_str" => 'rediger profil',
"form.profile.name" => 'navn',
"form.profile.login" => 'login', 
"form.profile.pas1" => 'adgangskode',
"form.profile.pas2" => 'gentag adgangskode',
"form.profile.comp" => 'Firma',
"form.profile.www" => 'Firma hjemmeside',
"form.profile.curr" => 'møntfod',
// Note to translators: the 11 strings below are missing in the translation and need to be added
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
"form.people.ppl_str" => 'Brugere',
"form.people.createu_str" => 'Dan ny bruger',
"form.people.edit_str" => 'reidger bruger',
"form.people.del_str" => 'slet bruger',
"form.people.th.name" => 'navn',
"form.people.th.login" => 'login', 
"form.people.th.role" => 'rolle',
"form.people.th.edit" => 'rediger',
"form.people.th.del" => 'slet',
"form.people.th.status" => 'status',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'rate',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'bruger',
"form.people.name" => 'navn',
"form.people.login" => 'login', 
"form.people.pas1" => 'adgangskode',
"form.people.pas2" => 'gentag adgangskode',
"form.people.rate" => 'standard tidsfaktor',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projekter',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projekter',
"form.project.edit_str" => 'rediger projekter',
"form.project.add_str" => 'tilføj projekt', 
"form.project.del_str" => 'slet projekt',
"form.project.th.name" => 'navn',
"form.project.th.edit" => 'rediger',
"form.project.th.del" => 'slet',
"form.project.name" => 'navn',

// activities form attributes
"form.activity.act_title" => 'aktiviteter',
"form.activity.add_title" => 'tilføj ny aktivitet', 
"form.activity.edit_str" => 'rediger aktivitet',
"form.activity.del_str" => 'slet aktivitet',
"form.activity.name" => 'navn',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'navn',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'rediger',
"form.activity.th.del" => 'slet',

// report attributes
"form.report.title" => 'rapport',
"form.report.from" => 'start dato',
"form.report.to"=> 'slut dato',
"form.report.groupby_user" => 'bruger',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varighed',
"form.report.start" => 'start',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'hvis ledig tid',
"form.report.finish" => 'slut',
"form.report.note" => 'notat',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'kun totaler',
"form.report.total" => 'timer totalt',
"form.report.th.empllist" => 'bruger',
"form.report.th.date" => 'dato',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'slut',
"form.report.th.duration" => 'varighed',
"form.report.th.note" => 'notat',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'emne',
"form.mail.comment" => 'komment',
"form.mail.above" => 'send denne rapport pr. email',
// Note to transaltors: "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>', // the string must be translated
"form.mail.sending_str" => '<b>mail sendt</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'Yderligere information for faktura',
"form.invoice.select_cust" => 'vælg kunde', 
"form.invoice.fillform" => 'udfyld felterne',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'faktura nummer',
"form.invoice.tax" => 'skat',
"form.invoice.discount" => 'rabat',
"form.invoice.daily_subtotals" => 'daglig mellemregninger',
"form.invoice.yourcoo" => 'Dit navn<br> og adresse',
"form.invoice.custcoo" => 'Kunde navn<br> og adresse',
"form.invoice.comment" => 'kommentar',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'rate',
"form.invoice.th.summ" => 'beløb', 
"form.invoice.subtotal" => 'subtotal',
"form.invoice.total" => 'total',
"form.invoice.customer" => 'kunde',
"form.invoice.period" => 'faktura periode',
"form.invoice.mailinv_above" => 'send denne faktura pr. e-mail',
"form.invoice.sending_str" => '<b>faktura sendt</b>',

"form.migration.zip" => 'komprimering',
"form.migration.file" => 'vælg fil', 
"form.migration.import.title" => 'import data',
"form.migration.import.success" => 'import gennemført', 
"form.migration.import.text" => 'import team data fra en xml fil',
"form.migration.export.title" => 'export data',
"form.migration.export.success" => 'export gennemført', 
"form.migration.export.text" => 'Du kan eksporerer data til enxml fil. det kan være praktisk hvis du flytter til egen server.', 
// Note to translators: the 3 strings below are missing in the translation and must be added
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kunder',
"form.client.add_title" => 'tilføj kunde', 
"form.client.edit_title" => 'rediger kunde',
"form.client.del_title" => 'slet kunde',
"form.client.th.name" => 'navn',
"form.client.th.edit" => 'rediger',
"form.client.th.del" => 'slet',
"form.client.name" => 'naavn',
"form.client.tax" => 'skat',
"form.client.discount" => 'rabat',
"form.client.daily_subtotals" => 'daglige mellemregninger',
"form.client.yourcoo" => 'Dit navn<br> og adresse pе faktura',
"form.client.custcoo" => 'addresse',
"form.client.comment" => 'kommenter ',

// miscellaneous strings
"forward.forgot_password" => 'Glemt adgangskode?',
"forward.edit" => 'rediger',
"forward.delete" => 'slet',
"forward.sendbyemail" => 'send pr e-mail',
"forward.tocsvfile" => 'exporter data til .csv fil',
// Note to translators:  the string below is missing in the translation and must be added
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'dan faktura',
"forward.change" => 'konfigurer kunder',
// Note to translators:  the string below is missing in the translation and must be added
// "forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- vælg projekt ---',
"controls.select.activity" => '--- vælg aktivitet ---',
"controls.select.client" => '---  vælg kunde---',
"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
"controls.notbind" => '--- ingen ---',
"controls.per_tm" => 'denne mеned',
"controls.per_lm" => 'sidste mеned',
"controls.per_tw" => 'denne uge',
"controls.per_lw" => 'sidste uge',
// Note to translators: the 3 strings below are missing in the translation and must be added
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- vælg tids periode ---',
"controls.sel_groupby" => '--- vælg gruppe ---', 
// Note to translators: the 3 strings below are missing in the translation and must be added
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the 3 strings below are missing in the translation and must be added
//"label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>pе vegne af %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'ingen input',
"label.today" => 'idag',
"label.req_fields"=> '* krævede felter', 
"label.sel_project" => 'vælg projekt',
"label.sel_activity" => 'vælg aktivtet',
"label.sel_tp" => 'vælg periode',
"label.set_tp" => 'eller vælg datoer',
"label.fields" => 'Vis fleter',
"label.group_title" => 'gruper',
// Note to translators: the string below is missing in the translation and must be added
// "label.include_title" => 'include records',
"label.inv_str" => 'faktura',
"label.set_empl" => 'vælg brugere',
"label.sel_all" => 'vælg alle',
"label.sel_none" => 'fravælg alle', 
"label.or" => 'eller',
"label.disable" => 'disable',
"label.enable" => 'enable',
"label.filter" => 'filtrer'
// Note to translators: the 5 strings below are missing in the translation and must be added
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>