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

$i18n_language_name = "Norwegian";
$i18n_float_delimiter = ".";

$i18n_month = array ('januar', 'februar', 'mars', 'april', 'mai', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'desember');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('søndag', 'mondag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag');
$i18n_week_sn = array ("sn","mo","tw","th","td","fr","st");

//format d/m
$i18n_holidays = array("01/01","05/04", "09/04", "10/04", "12/04", "13/04", "01/05", "17/05", "21/05", "31/05", "01/06", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'innlogging',
"menu.logout" => 'logg ut',
"menu.feedback" => 'tilbakemelding',
"menu.help" => 'hjelp',
"menu.register" => 'lag ny adminkonto',
"menu.edprof" => 'endre profil',
"menu.mytime" => 'min tid',
"menu.report" => 'rapporter',
"menu.project" => 'prosjekt',
"menu.activity" => 'aktiviteter',
"menu.people" => 'personer',
// Note to translators: the strings below are missing and must be added and translated
// "menu.profile" => 'teams',
// "menu.migration" => 'export data',
// "menu.clients" => 'clients',
// "menu.services" => 'options',
// "menu.admin" => 'admin',

// error strings
"errors.db_error" => 'databasefeil',
// Note to translators: the strings below must be correctly translated
// "errors.wrong" => 'incorrect \'{0}\' data',
// "errors.empty" => 'field \'{0}\' is empty',
// "errors.compare" => 'the field \'{0}\' is not equaled to a field \'{1}\'',
// "errors.wr_interval" => 'incorrect interval',
// "errors.wr_project" => 'select prosjekt',
// "errors.wr_activity" => 'select aktivitet',
// "errors.wr_auth" => 'incorrect login or password',
// "errors.del_nothing" => 'no data for deleting',
// "errors.reg_error" => "unable to create new user",
// "errors.prof_error" => "unable to change profile",
// "errors.no_user" => "there is no such user",
// "errors.mt_del_no" => 'unable to delete the time record',
// "errors.mt_del_no_conf" => 'the time record has not been deleted',
// "errors.mt_insert" => 'time insert error',
// "errors.user_exist" => 'user with this e-mail already exists',
// "errors.user_notexists" => 'user not exists',
// "errors.user_update" => "unable to change user's data",
// "errors.user_delete" => "unable to delete user's data",
// "errors.project_exist" => 'prosjekt with this navn already exists',
// "errors.project_notexists" => 'prosjekt not exists',
// "errors.project_update" => "unable to change prosjekt navn",
// "errors.project_add" => 'unable to add new prosjekt',
// "errors.project_nodel" => 'unable to delete prosjekt',
// "errors.activity_add" => 'unable to add new aktivitet',
// "errors.activity_exist" => 'aktivitet with this navn already exists',
// "errors.activity_update" => "unable to change aktivitet navn",
// "errors.activity_nodel" => 'unable to delete aktivitet',
// "errors.activity_notexists" => 'aktivitet not exists',
// "errors.report_period" => 'incorrect period',
// "errors.search_by_login" => 'no user with this login',
// "errors.multiteam_mode" => 'you can\'t create more accounts',
// "errors.upload" => 'file upload error',
// "errors.client_nodel" => 'unable to delete client',
// "errors.client_notexists" => 'client does not exist',
// "errors.ie_sameusers" => 'one or more logins already exist in the database',
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// // labels for various buttons
// "button.login" => 'innlogging',
// "button.now" => 'nå',
// "button.behalf_set" => 'sette',
// "button.save" => 'save',
// "button.delete" => 'slett',
// "button.cancel" => 'cancel',
// "button.submit" => 'submit',
// "button.ppl_add" => 'add new user',
// "button.proj_add" => 'legg til nytt prosjekt',
// "button.act_add" => 'legg til ny aktivitet',
// "button.add" => 'add',
// "button.generate" => 'generer',
// "button.sendpwd" => 'send passord',
// "button.send" => 'send',
// "button.sendbyemail" => 'send som e-post',
// "button.asnew" => 'save as new',
// "button.profile_add" => 'create new team',
// "button.export" => 'export team',
// "button.import" => 'import team',
// "button.apply" => 'apply',
// "button.clnt_add" => 'add new client',

// "form.filter.project" => 'project',
// "form.filter.filter" => 'favorite report',
// "form.filter.filter_new" => 'save as favorite',
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'innlogging',
"form.login.login" => 'innlogging',
"form.login.password" => 'passord',

// password reminder form attributes
// Note to translators: "form.fpass.title" => 'remind password', // the string must be translated
"form.fpass.login" => 'innlogging',
"form.fpass.send_pass_str" => 'passordet er sendt',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker passordet ditt',
// Note to translators: the next string must be translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
//Note to translators: the string below is missing and must be added and translated
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// Note to translators: the strings below must be translated
// // administrator form
// "form.admin.title" => 'administrator',
// "form.admin.duty_text" => 'create a new team by creating a new team manager account.<br>you can also import team data from an xml file from another Anuko Time Tracker server (no login collisions are allowed).',
// "form.admin.password" => 'password',
// "form.admin.password_confirm" => 'confirm password',
// "form.admin.change_pass" => 'change password of administrator account',
// "form.admin.profile.title" => 'teams',
// "form.admin.profile.noprofiles" => 'your database is empty. login as admin and create a new team.',
// "form.admin.profile.comment" => 'delete team',
// "form.admin.profile.th.id" => 'id',
// "form.admin.profile.th.name" => 'name',
// "form.admin.profile.th.edit" => 'edit',
// "form.admin.profile.th.del" => 'delete',
// "form.admin.profile.th.active" => 'active',
// "form.admin.lock.period" => 'lock interval in days',
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
// Note to translators: the 2 strings below must be translated
// "form.mytime.title" => 'my time',
// "form.mytime.edit_title" => 'editing time record',
"form.mytime.del_str" => 'slett tid oppføring',
"form.mytime.time_form" => ' (tt:mm)',
// Note to translators: "form.mytime.date" => 'date', // the string must be translated
"form.mytime.project" => 'prosjekt',
"form.mytime.activity" => 'aktivitet',
"form.mytime.start" => 'starttid',
"form.mytime.finish" => 'ferdig',
"form.mytime.duration" => 'varighet',
"form.mytime.note" => 'notat',
"form.mytime.behalf" => 'daglig arbeide for',
"form.mytime.daily" => 'daglig arbeide',
"form.mytime.total" => 'totalt antall timer: ',
"form.mytime.th.project" => 'prosjekt',
"form.mytime.th.activity" => 'aktivitet',
"form.mytime.th.start" => 'starttid',
"form.mytime.th.finish" => 'ferdig',
"form.mytime.th.duration" => 'varighet',
"form.mytime.th.note" => 'notat',
"form.mytime.th.edit" => 'endre',
"form.mytime.th.delete" => 'slett',
// Note to translators: the strings below must be translated
// "form.mytime.del_yes" => 'the time record has been slettd successfully', 
// "form.mytime.no_finished_rec" => 'this record was saved with only start time. it is not an error. logout if you need to.',
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'lag ny adminkonto',
"form.profile.prof_str" => 'editing profile',
"form.profile.name" => 'navn',
"form.profile.login" => 'innlogging',
"form.profile.pas1" => 'passord',
"form.profile.pas2" => 'bekreft passord',
"form.profile.comp" => 'bedrift',
"form.profile.www" => 'bedriftens nettside',
"form.profile.curr" => 'valuta',
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
"form.people.ppl_str" => 'personer',
"form.people.createu_str" => 'legg til ny bruker',
"form.people.edit_str" => 'endre bruker',
"form.people.del_str" => 'slett bruker',
"form.people.th.name" => 'navn',
"form.people.th.login" => 'innlogging',
"form.people.th.role" => 'rolle',
"form.people.th.edit" => 'endre',
"form.people.th.del" => 'slett',
"form.people.th.status" => 'status',
// Note to translators: the 2 strings below are missing and must be added and translated
// "form.people.th.project" => 'project',
// "form.people.th.rate" => 'rate',
// Note to translators: the strings below must be correctly translated
// "form.people.manager" => 'admin',
// "form.people.comanager" => 'comanager',
"form.people.empl" => 'bruker',
"form.people.name" => 'navn',
"form.people.login" => 'innlogging',
"form.people.pas1" => 'passord',
"form.people.pas2" => 'bekreft passord',
"form.people.rate" => 'timesats',
// Note to translators: the strings below are missing and must be added and translated
// "form.people.comanager" => 'co-manager',
// "form.people.projects" => 'projects',
// "form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'prosjekter',
"form.project.edit_str" => 'endre prosjekt',
"form.project.add_str" => 'legg til nytt prosjekt',
"form.project.del_str" => 'slett prosjekt',
"form.project.th.name" => 'navn',
"form.project.th.edit" => 'endre',
"form.project.th.del" => 'slett',
"form.project.name" => 'navn',

// activities form attributes
"form.activity.act_title" => 'aktiviteter',
"form.activity.add_title" => 'legg til ny aktivitet',
"form.activity.edit_str" => 'endre aktivitet',
// Note to translators: "form.activity.del_str" => 'deleting aktivitet', // the string is incompletely translated
"form.activity.name" => 'navn',
"form.activity.project" => 'prosjekt',
"form.activity.th.name" => 'navn',
"form.activity.th.project" => 'prosjekt',
"form.activity.th.edit" => 'endre',
"form.activity.th.del" => 'slett',

// report attributes
"form.report.title" => 'rapporter',
"form.report.from" => 'starttid',
"form.report.to" => 'ferdig',
"form.report.groupby_user" => 'bruker',
"form.report.groupby_project" => 'prosjekt',
"form.report.groupby_activity" => 'aktivitet',
"form.report.duration" => 'varighet',
"form.report.start" => 'starttid',
"form.report.activity" => 'aktivitet',
"form.report.show_idle" => 'antall dager ikke aktiv',
"form.report.finish" => 'ferdig',
"form.report.note" => 'notat',
"form.report.project" => 'prosjekt',
// Note to translators: the strings below must be translated 
// "form.report.totals_only" => 'totals only',
"form.report.total" => 'totalt antall timer',
"form.report.th.empllist" => 'bruker',
"form.report.th.date" => 'dato',
"form.report.th.project" => 'prosjekt',
"form.report.th.activity" => 'aktivitet',
"form.report.th.start" => 'starttid',
"form.report.th.finish" => 'ferdig',
"form.report.th.duration" => 'varighet',
"form.report.th.note" => 'notat',

// mail form attributes
"form.mail.from" => 'fra',
"form.mail.to" => 'til',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'emne',
"form.mail.comment" => 'kommentar',
"form.mail.above" => 'send denne rapporten som e-post',
// Note to translators: the strings below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>', 
// "form.mail.sending_str" => '<b>the message has been sent</b>',

// invoice attributes
"form.invoice.title" => 'faktura',
"form.invoice.caption" => 'faktura',
"form.invoice.above" => 'tilleggsinformasjon for faktura',
// Note to translators: the strings below are missing and must be added and translated
// "form.invoice.select_cust" => 'select client',
// "form.invoice.fillform" => 'fill the fields',
"form.invoice.date" => 'dato',
"form.invoice.number" => 'fakturanummer',
"form.invoice.tax" => 'MVA',
// Note to translators: the strings below are missing and must be added and translated
// "form.invoice.discount" => 'discount',
// "form.invoice.daily_subtotals" => 'daily subtotals',
"form.invoice.yourcoo" => 'ditt navn<br> og adresse',
"form.invoice.custcoo" => 'kunden sitt navn<br> og adresse',
"form.invoice.comment" => 'notat',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'timer',
"form.invoice.th.rate" => 'sats',
"form.invoice.th.summ" => 'antall',
"form.invoice.subtotal" => 'delsum',
"form.invoice.total" => 'totalt',
"form.invoice.customer" => 'kommentar',
"form.invoice.period" => 'faktureringsperiode',
"form.invoice.mailinv_above" => 'send denne fakturaen som e-post',
// Note to translators: "form.invoice.sending_str" => '<b>invoice has been sent</b>', // the string must be translated

// Note to translators: the strings below are missing and must be added and translated
// "form.migration.zip" => 'compression',
// "form.migration.file" => 'select file',
// "form.migration.import.title" => 'import data',
// "form.migration.import.success" => 'import completed successfully',
// "form.migration.import.text" => 'import team data from an xml file',
// "form.migration.export.title" => 'export data',
// "form.migration.export.success" => 'export completed successfully',
// "form.migration.export.text" => 'you can export all team data into an xml file. this could be useful if you are migrating data to your own server.',
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

// "form.client.title" => 'clients',
// "form.client.add_title" => 'add client',
// "form.client.edit_title" => 'edit client',
// "form.client.del_title" => 'delete client',
// "form.client.th.name" => 'name',
// "form.client.th.edit" => 'edit',
// "form.client.th.del" => 'delete',
// "form.client.name" => 'name',
// "form.client.tax" => 'tax',
// "form.client.discount" => 'discount',
// "form.client.daily_subtotals" => 'daily subtotals',
// "form.client.yourcoo" => 'your name<br> and address in invoice',
// "form.client.custcoo" => 'address',
// "form.client.comment" => 'comment ',

// miscellaneous strings
"forward.forgot_password" => 'glemt passordet?',
"forward.edit" => 'endre',
"forward.delete" => 'slett',
// Note to translators: the string below must be translated 
// "forward.sendbyemail" => 'send by e-mail',
"forward.tocsvfile" => 'eksporter data til en .csv fil',
// Note to translators: the strings below are missing and must be translated and added
// "forward.toxmlfile" => 'export data to .xml file',
// "forward.geninvoice" => 'generate invoice',
// "forward.change" => 'configure clients',
// "forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- velg prosjekt ---',
"controls.select.activity" => '--- velg aktivitet ---',
// Note to translators: the string below is missing and must be translated and added
// "controls.select.client" => '--- select client ---',
"controls.project_bind" => '--- alle ---',
"controls.all" => '--- alle ---',
// Note to translators: the strings below are missing and must be translated and added 
// "controls.notbind" => '--- no ---',
"controls.per_tm" => 'denne måneden',
"controls.per_lm" => 'forrige måned',
"controls.per_tw" => 'denne uken',
"controls.per_lw" => 'forrige uke',
// Note to translators: the strings below are missing and must be translated and added
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- velg tidsperiode ---',
"controls.sel_groupby" => '--- ingen sortering ---',
// Note to translators: the strings below are missing and must be translated and added
// "controls.inc_billable" => 'billable',
// "controls.inc_nbillable" => 'not billable',
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be translated and added
// "label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>på vegne av %s</b>',
// Note to translators: the strings below must be correctly translated
// "label.pminfo" => ' (admin)',
// "label.pcminfo" => ' (co-manager)',
// "label.painfo" => ' (administrator)',
"label.time_noentry" => 'ingen tilgang',
"label.today" => 'i dag',
"label.req_fields" => '* obligatoriske felt',
"label.sel_project" => 'velg prosjekt',
"label.sel_activity" => 'velg aktivitet',
"label.sel_tp" => 'velg tidsperiode',
"label.set_tp" => 'eller sett dato',
"label.fields" => 'vis feltene',
"label.group_title" => 'sorter på',
// Note to translators: the strings below must be translated
// "label.include_title" => 'include records',
// "label.inv_str" => 'invoice',
"label.set_empl" => 'velg brukere',
// Note to translators: the strings below are missing and must be translated and added
// "label.sel_all" => 'select all',
// "label.sel_none" => 'deselect all',
// "label.or" => 'or',
// "label.disable" => 'disable',
// "label.enable" => 'enable',
// "label.filter" => 'filter',
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>