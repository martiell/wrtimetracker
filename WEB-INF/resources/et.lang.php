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

$i18n_language_name = "Estonian";
$i18n_float_delimiter = ",";

$i18n_month = array ('jaanuar', 'veebruar', 'märts', 'aprill', 'mai', 'juuni', 'juuli', 'august', 'september', 'oktoober', 'november', 'detsember');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('pühapäev', 'esmaspäev', 'teisipäev', 'kolmapäev', 'neljapäev', 'reede', 'laupäev');
$i18n_week_sn = array ("P","E","T","K","N","R","L");

//format d/m
$i18n_holidays = array("01/01","24/02", "10/04", "12/04", "01/05", "31/05", "23/06", "24/06", "20/08", "24/12", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'login',
"menu.logout" => 'logout',
"menu.feedback" => 'tagasiside',
"menu.help" => 'abiinfo',
"menu.register" => 'loo uus managerikonto',
"menu.edprof" => 'muuda profiili',
"menu.mytime" => 'minu aeg',
"menu.report" => 'raportid',
"menu.project" => 'projektid',
"menu.activity" => 'tegevused',
"menu.people" => 'inimesed',
"menu.profile" => 'meeskonnad',
"menu.migration" => 'ekspordi andmed',
"menu.clients" => 'kliendid',
"menu.services" => 'vaheta salasõna',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'andmebaasi viga',
"errors.wrong" => 'valed \'{0}\' andmed',
"errors.empty" => 'väli \'{0}\' on tühi',
"errors.compare" => 'väli \'{0}\' ei ole väljaga \'{1}\' võrdne',
"errors.wr_interval" => 'ebakorrektne intervall',
"errors.wr_project" => 'vali projekt',
"errors.wr_activity" => 'vali tegevus',
"errors.wr_auth" => 'vale login või salasõna',
"errors.del_nothing" => 'pole andmeid mida kustutada',
"errors.reg_error" => "uue kasutaja loomine ebaõnnestus",
"errors.prof_error" => "profiili muutmine ebaõnnestus",
"errors.no_user" => "sellist kasutajat ei ole",
"errors.mt_del_no" => 'ajakande kustutamine ebaõnnestus',
"errors.mt_del_no_conf" => 'ajakannet ei ole kustutatud',
"errors.mt_insert" => 'viga aja sisestamisel',
"errors.user_exist" => 'selle e-maili aadressiga kasutaja juba eksisteerib',
"errors.user_notexists" => 'kasutajat ei eksisteeri',
"errors.user_update" => "kasutaja andmete muutmine ebaõnnestus",
"errors.user_delete" => "kasutaja andmete kustutamine ebaõnnestus",
"errors.project_exist" => 'selle nimega projekt on juba olemas',
"errors.project_notexists" => 'sellist projekti ei ole',
"errors.project_update" => "projekti nime muutmine ebaõnnestus",
"errors.project_add" => 'projekti lisamine ebaõnnestus',
"errors.project_nodel" => 'projekti kustutamine ebaõnnestus',
"errors.activity_add" => 'tegevuse lisamine ebaõnnestus',
"errors.activity_exist" => 'selle nimega tegevus on juba olemas',
"errors.activity_update" => "tegevuse nime muutmine ebaõnnestus",
"errors.activity_nodel" => 'tegevus kustutamine ebaõnnestus',
"errors.activity_notexists" => 'sellist tegevust ei ole',
"errors.report_period" => 'ebakorrektne ajaperiood',
"errors.search_by_login" => 'sellise e-mail aadressiga kasutajat ei ole', 
"errors.multiteam_mode" => 'sa ei saa rohkem kontosid luua',
"errors.upload" => 'viga faili vastuvõtmisel',
"errors.client_nodel" => 'kliendi kustutamine ebaõnnestus',
"errors.client_notexists" => 'sellist klienti ei ole',
"errors.ie_sameusers" => 'üks või rohkem e-maili on juba andmebaasis olemas',
"errors.period_lock" => 'kande lisamine ebaõnnestus. ajaperiood on lukustatud',
// Note to translators: the strings below are missing and must be added to the translation
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'login',
"button.now" => 'kohe',
"button.behalf_set" => 'aseta',
"button.save" => 'salvesta',
"button.delete" => 'kustuta',
"button.cancel" => 'tühista',
"button.submit" => 'postita',
"button.ppl_add" => 'lisa uus kasutaja',
"button.proj_add" => 'lisa uus projekt',
"button.act_add" => 'lisa uus tegevus',
"button.add" => 'lisa',
"button.generate" => 'loo',
"button.sendpwd" => 'edasi',
"button.send" => 'saada',
"button.sendbyemail" => 'saada e-mailiga',
"button.asnew" => 'salvesta uuena',
"button.profile_add" => 'loo uus meeskond',
"button.export" => 'ekspordi meeskond',
"button.import" => 'impordi meeskond',
"button.apply" => 'rakenda',
"button.clnt_add" => 'lisa uus klient',

"form.filter.project" => 'projekt',
"form.filter.filter" => 'lemmikraport',
"form.filter.filter_new" => 'salvesta lemmikuna',
// Note to translators: the string below is missing and must be added to the translation
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',
"form.login.password" => 'salasõna',

// password reminder form attributes
"form.fpass.title" => 'tühjenda salasõna',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'salasõna tühjendamise käsk edastatud',
// Note to translators: the 3 strings below must be translated
// "form.fpass.send_pass_subj" => 'AnukoTime Tracker password reset request',
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your AnukoTime Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'administraator',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new meeskond by creating a new meeskond manager account.<br>you can also import meeskond data from an xml file from another Anuko time tracker server (no e-mail collisions are allowed).',
"form.admin.password" => 'salasõna',
"form.admin.password_confirm" => 'kinnita salasõna',
"form.admin.change_pass" => 'muuda administraatori konto salasõna',
"form.admin.profile.title" => 'meeskonnad',
"form.admin.profile.noprofiles" => 'sinu andmebaas on tühi. logi adminina sisse ja loo uus meeskond.',
"form.admin.profile.comment" => 'kustuta meeskond',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'nimi',
"form.admin.profile.th.edit" => 'muuda',
"form.admin.profile.th.del" => 'kustuta',
"form.admin.profile.th.active" => 'aktiivne',
"form.admin.lock.period" => 'lukusta intervall päevades',
// Note to translators: the 6 strings below are missing in the translation and must be translated abd added
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'minu aeg',
"form.mytime.edit_title" => 'ajakande muutmine',
"form.mytime.del_str" => 'ajakande kustutamine',
// Note to translators: the string below must be translated
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'kuupäev',
"form.mytime.project" => 'projekt',
"form.mytime.activity" => 'tegevus',
"form.mytime.start" => 'algus',
"form.mytime.finish" => 'lõpp',
"form.mytime.duration" => 'kestus',
"form.mytime.note" => 'märkus',
// Note to translators: "form.mytime.behalf" => 'igapäevane töö', // the translation is incorrect
"form.mytime.daily" => 'igapäevane töö',
"form.mytime.total" => 'tunde kokku: ',
"form.mytime.th.project" => 'projekt',
"form.mytime.th.activity" => 'tegevus',
"form.mytime.th.start" => 'algus',
"form.mytime.th.finish" => 'lõpp',
"form.mytime.th.duration" => 'kestus',
"form.mytime.th.note" => 'märkus',
"form.mytime.th.edit" => 'muuda',
"form.mytime.th.delete" => 'kustuta',
"form.mytime.del_yes" => 'ajakanne kustutatud',
"form.mytime.no_finished_rec" => 'kanne salvestati ainult alguse ajaga. see ei ole viga. logi välja kui vaja peaks olema.',
"form.mytime.billable" => 'arvestatav',
"form.mytime.warn_tozero_rec" => 'see ajakanne tuleb kustutada kuna see ajaperiood on lukustatud',
// Note to translators: the string below must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'loo uus halduri konto',
"form.profile.prof_str" => 'profiili muutmine',
"form.profile.name" => 'nimi',
"form.profile.login" => 'login',
"form.profile.pas1" => 'salasõna',
"form.profile.pas2" => 'kinnita salasõna',
"form.profile.comp" => 'ettevõte',
"form.profile.www" => 'ettevõtte www',
"form.profile.curr" => 'valuuta',
// Note to translators: the 11 strings below must be translated and added to the localization file
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
"form.people.ppl_str" => 'inimesed',
"form.people.createu_str" => 'loo uus kasutaja',
"form.people.edit_str" => 'kasutaja muutmine',
"form.people.del_str" => 'kasutaja kustutamine',
"form.people.th.name" => 'nimi',
"form.people.th.login" => 'login',
"form.people.th.role" => 'roll',
"form.people.th.edit" => 'muuda',
"form.people.th.del" => 'kustuta',
"form.people.th.status" => 'seisund',
"form.people.th.project" => 'projekt',
"form.people.th.rate" => 'hind',
"form.people.manager" => 'haldur',
"form.people.comanager" => 'kaashaldur',
"form.people.empl" => 'kasutaja',
"form.people.name" => 'nimi',
"form.people.login" => 'login',
"form.people.pas1" => 'salasõna',
"form.people.pas2" => 'kinnita salasõna',
"form.people.rate" => 'vaikimisi tunni hind',
"form.people.comanager" => 'kaashaldur',
"form.people.projects" => 'projektid',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projektid',
"form.project.edit_str" => 'projektide muutmine',
"form.project.add_str" => 'uue projekti lisamine',
"form.project.del_str" => 'projekti kustutamine',
"form.project.th.name" => 'nimi',
"form.project.th.edit" => 'muuda',
"form.project.th.del" => 'kustuta',
"form.project.name" => 'nimi',

// activities form attributes
"form.activity.act_title" => 'tegevus',
"form.activity.add_title" => 'uue tegevuse lisamine',
"form.activity.edit_str" => 'tegevuse muutmine',
"form.activity.del_str" => 'tegevuse kustutamine',
"form.activity.name" => 'nimi',
"form.activity.project" => 'projekt',
"form.activity.th.name" => 'nimi',
"form.activity.th.project" => 'projekt',
"form.activity.th.edit" => 'muuda',
"form.activity.th.del" => 'kustuta',

// report attributes
"form.report.title" => 'aruanded',
"form.report.from" => 'algab kuupäevast',
"form.report.to" => 'lõpeb kuupäeval',
"form.report.groupby_user" => 'kasutaja',
"form.report.groupby_project" => 'projekt',
"form.report.groupby_activity" => 'tegevus',
"form.report.duration" => 'kestus',
"form.report.start" => 'algus',
"form.report.activity" => 'tegevus',
"form.report.show_idle" => 'näita tühja aega',
"form.report.finish" => 'lõpp',
"form.report.note" => 'märkus',
"form.report.project" => 'projekt',
"form.report.totals_only" => 'ainult summad',
"form.report.total" => 'tunde kokku',
"form.report.th.empllist" => 'kasutaja',
"form.report.th.date" => 'kuupäev',
"form.report.th.project" => 'projekt',
"form.report.th.activity" => 'tegevus',
"form.report.th.start" => 'algus',
"form.report.th.finish" => 'lõpp',
"form.report.th.duration" => 'kestus',
"form.report.th.note" => 'märkus',

// mail form attributes
"form.mail.from" => 'kellelt',
"form.mail.to" => 'kellele',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'teema',
"form.mail.comment" => 'märkus',
"form.mail.above" => 'saada aruanne e-mailiga',
// Note to translators: the string below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>teade saadetud</b>',

// invoice attributes
"form.invoice.title" => 'arve',
"form.invoice.caption" => 'arve',
"form.invoice.above" => 'lisainformatsioon arvele',
"form.invoice.select_cust" => 'vali klient',
"form.invoice.fillform" => 'täida väljad',
"form.invoice.date" => 'kuupäev',
"form.invoice.number" => 'arve number',
"form.invoice.tax" => 'maks',
"form.invoice.discount" => 'allahindlus',
"form.invoice.daily_subtotals" => 'igapäevased vahesummad',
"form.invoice.yourcoo" => 'sinu nimi<br> ja aadress',
"form.invoice.custcoo" => 'kliendi nimi<br> ja aadress',
"form.invoice.comment" => 'kommentaar ',
"form.invoice.th.username" => 'isik',
"form.invoice.th.time" => 'tunde',
"form.invoice.th.rate" => 'hind',
"form.invoice.th.summ" => 'summa',
"form.invoice.subtotal" => 'vahesumma',
"form.invoice.total" => 'kokku',
"form.invoice.customer" => 'klient',
"form.invoice.period" => 'töö periood',
"form.invoice.mailinv_above" => 'saada see arve e-mailiga',
"form.invoice.sending_str" => '<b>arve saadetud</b>',

"form.migration.zip" => 'pakkimine',
"form.migration.file" => 'vali fail',
"form.migration.import.title" => 'impordi andmed',
"form.migration.import.success" => 'andmed imporditud',
"form.migration.import.text" => 'impordi meeskonna andmed xml-failist',
"form.migration.export.title" => 'ekspordi andmed',
"form.migration.export.success" => 'andmed eksporditud',
"form.migration.export.text" => 'võid kogu meeskonna andmed eksportida xml-faili. sellest võib olla kasu kui vahetad serverit.',
// Note to translators: the string below must be translated and added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'kliendid',
"form.client.add_title" => 'lisa klient',
"form.client.edit_title" => 'muuda klienti',
"form.client.del_title" => 'kustuta klient',
"form.client.th.name" => 'nimi',
"form.client.th.edit" => 'muuda',
"form.client.th.del" => 'kustuta',
"form.client.name" => 'nimi',
"form.client.tax" => 'maks',
"form.client.discount" => 'allahindlus',
"form.client.daily_subtotals" => 'igapäevased vahesummad',
"form.client.yourcoo" => 'sinu nimi<br> ja aadress arvel',
"form.client.custcoo" => 'aadress',
"form.client.comment" => 'märkus ',

// miscellaneous strings
"forward.forgot_password" => 'unustasid salasõna?',
"forward.edit" => 'muuda',
"forward.delete" => 'kustuta',
"forward.sendbyemail" => 'saada e-mailiga',
"forward.tocsvfile" => 'ekspordi andmed .csv faili',
"forward.toxmlfile" => 'ekspordi andmed .xml faili',
"forward.geninvoice" => 'loo arve',
"forward.change" => 'konfigureeri kliendid',
"forward.lockpage" => 'ajakannete muutuste lukustamise intervall',

// strings inside contols on forms
"controls.select.project" => '--- vali projekt ---',
"controls.select.activity" => '--- vali tegevus ---',
"controls.select.client" => '--- vali klient ---',
"controls.project_bind" => '--- kõik ---',
"controls.all" => '--- kõik ---',
"controls.notbind" => '--- ei ---',
"controls.per_tm" => 'käesolev kuu',
"controls.per_lm" => 'eelmine kuu',
"controls.per_tw" => 'käesolev nädal',
"controls.per_lw" => 'eelmine nädal',
"controls.per_td" => 'täna',
"controls.per_at" => 'kõik ajad',
// Note to translators: the string below must be translated and added
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- vali ajaperiood ---',
"controls.sel_groupby" => '--- ilma grupeerimata ---',
"controls.inc_billable" => 'arvestatav',
"controls.inc_nbillable" => 'mittearvestatav',
// Note to translators: the string below must be translated and added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'tegevused kasutajal',
// Note to translators: the string below is missing and must be translated and added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'tabel perioodiks',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (haldur)',
"label.pcminfo" => ' (kaashaldur)',
"label.painfo" => ' (administraator)',
"label.time_noentry" => 'sissekanne puudub',
"label.today" => 'täna',
"label.req_fields" => '* nõutud väljad',
"label.sel_project" => 'vali projekt',
"label.sel_activity" => 'vali tegevus',
"label.sel_tp" => 'vali ajaperiood',
"label.set_tp" => 'või märgi kuupäevad',
"label.fields" => 'näita välju',
"label.group_title" => 'grupeeri',
"label.include_title" => 'kaasa kanded',
"label.inv_str" => 'arved',
"label.set_empl" => 'vali kasutajad',
"label.sel_all" => 'vali kõik',
"label.sel_none" => 'märgi kõik mittevalituks',
"label.or" => 'või',
"label.disable" => 'keela',
"label.enable" => 'luba',
"label.filter" => 'filtreeri',
"label.timeweek" => 'nädalane summa'
// Note to translators: the strings below must be translated and added to the localization file
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>