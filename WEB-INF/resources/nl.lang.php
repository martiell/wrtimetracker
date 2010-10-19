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
// | Contributors: Marc Fleischeuers 
// +----------------------------------------------------------------------+

$i18n_language_name = "Dutch";
$i18n_float_delimiter = ",";

$i18n_month = array ('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag');
$i18n_week_sn = array ("zo","ma","di","wo","do","vr","za");

//format d/m
$i18n_holidays = array("01/01","12/04", "13/04", "30/04", "21/05", "31/05", "01/06", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'inloggen',
"menu.logout" => 'uitloggen',
"menu.feedback" => 'feedback',
"menu.help" => 'help',
"menu.register" => 'maak een nieuw manager account',
"menu.edprof" => 'wijzig profiel',
"menu.mytime" => 'mijn tijden',
"menu.report" => 'rapporten',
"menu.project" => 'projecten',
"menu.activity" => 'activiteiten',
"menu.people" => 'medewerkers',
"menu.profile" => 'teams',
"menu.migration" => 'export',
"menu.clients" => 'klanten',
"menu.services" => 'wijzig wachtwoord',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'database fout',
"errors.wrong" => 'incorrecte gegevens: \'{0}\'',
"errors.empty" => 'veld \'{0}\' is leeg',
"errors.compare" => 'veld \'{0}\' is niet gelijk aan veld \'{1}\'',
"errors.wr_interval" => 'incorrect interval',
"errors.wr_project" => 'kies project',
"errors.wr_activity" => 'kies activiteit',
"errors.wr_auth" => 'onjuiste login of wachtwoord',
"errors.del_nothing" => 'geen gegevens om te verwijderen',
"errors.reg_error" => "kan geen nieuwe medewerker maken",
"errors.prof_error" => "kan het profiel niet wijzigen",
"errors.no_user" => "de medewerker bestaat niet",
"errors.mt_del_no" => 'kan tijdrecord niet verwijderen',
"errors.mt_del_no_conf" => 'tijdrecord is niet verwijderd',
"errors.mt_insert" => 'fout bij toevoegen van tijdrecord',
"errors.user_exist" => 'een medewerker met dit emailadres bestaat al',
"errors.user_notexists" => 'de medewerker bestaat niet',
"errors.user_update" => "kan de medewerkergegevens niet wijzigen",
"errors.user_delete" => "kan medewerkergegevens niet verwijderen",
"errors.project_exist" => 'een project met deze naam bestaat al',
"errors.project_notexists" => 'project bestaat niet',
"errors.project_update" => "kan de projectnaam niet wijzigen",
"errors.project_add" => 'kan het nieuwe project niet toevoegen',
"errors.project_nodel" => 'kan project niet verwijderen',
"errors.activity_add" => 'kan de nieuwe activiteit niet toevoegen',
"errors.activity_exist" => 'een activiteit met deze naam bestaat al',
"errors.activity_update" => "kan de naam van de activiteit niet wijzigen",
"errors.activity_nodel" => 'kan de activiteit niet verwijderen',
"errors.activity_notexists" => 'de activiteit bestaat niet',
"errors.report_period" => 'onjuiste periode',
"errors.search_by_login" => 'geen medewerker met dit email adres',
"errors.multiteam_mode" => 'u kunt geen medewerkers meer aanmaken',
// Note to translators: the string below must be correctly translated
// "errors.upload" => 'file upload fout',
"errors.client_nodel" => 'kan klantgegevens niet verwijderen',
"errors.client_notexists" => 'klant bestaat niet',
"errors.ie_sameusers" => 'een of meer e-mails bestaan al in de database',
// Note to translators: the strings below are missing and must be translated and added 
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'login',
"button.now" => 'nu',
"button.behalf_set" => 'instellen',
"button.save" => 'bewaren',
"button.delete" => 'verwijderen',
"button.cancel" => 'afbreken',
"button.submit" => 'opslaan',
"button.ppl_add" => 'nieuwe medewerker toevoegen',
"button.proj_add" => 'nieuw project toevoegen',
"button.act_add" => 'nieuwe activiteit toevoegen',
"button.add" => 'toevoegen',
"button.generate" => 'genereren',
// Note to translators: the string below must be translated
// "button.sendpwd" => 'go',
"button.send" => 'verzenden',
"button.sendbyemail" => 'stuur per e-mail',
"button.asnew" => 'oplsaan als nieuw',
"button.profile_add" => 'nieuw team maken',
"button.export" => 'team exporteren',
"button.import" => 'team importeren',
"button.apply" => 'toepassen',
"button.clnt_add" => 'nieuwe klant toevoegen',

"form.filter.project" => 'project',
"form.filter.filter" => 'standaard rapport',
"form.filter.filter_new" => 'opslaan als standaard',
// Note to translators: the string below is missing and must be translated and added 
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',
"form.login.password" => 'wachtwoord',

// password reminder form attributes
"form.fpass.title" => 'wachtwoord herstellen',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'verzoek om wachtwoord te herstellen verzonden',
"form.fpass.send_pass_subj" => 'Anuko Time Tracker wachtwoord herstel verzoek',
"form.fpass.send_pass_body" => "Geachte medewerker,\n\nIemand, mogelijk uzelf, heeft verzocht uw wachtwoord in Anuko Time Tracker te herstellen. Klik op deze link als u uw wachtwoord wil wijzigen.\n\n%s\n\nDe ontwikkeling van Anuko Time Tracker wordt mogelijk gemaakt door ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "om uw wachtwoord te wijzigen, geef het in en klik op Opslaan",

// administrator form
"form.admin.title" => 'beheerder',
"form.admin.duty_text" => 'Maak een nieuw team door een team  manager account aan te maken.<br>U kunt ook teamgegevens importeren uit een xml file van een andere Anuko TimeTracker server (e-mail adressen die al in deze database bestaan zijn niet toegestaan).',
"form.admin.password" => 'wachtwoord',
"form.admin.password_confirm" => 'bevestig wachtwoord',
"form.admin.change_pass" => 'wijzig wachtwoord van de beheerder',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'uw database is leeg. login als admin en creëer een nieuw team.',
"form.admin.profile.comment" => 'verwijder team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'naam',
"form.admin.profile.th.edit" => 'wijzig',
"form.admin.profile.th.del" => 'verwijder',
"form.admin.profile.th.active" => 'actief',
// Note to translators: the strings below are missing in the translation and must be translated and added
// "form.admin.lock.period" => 'lock interval in days',
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'mijn tijden',
"form.mytime.edit_title" => 'wijzigen tijdrecord',
"form.mytime.del_str" => 'verwijder tijdrecord',
"form.mytime.time_form" => ' (uu:mm)',
"form.mytime.date" => 'datum',
"form.mytime.project" => 'project',
"form.mytime.activity" => 'activiteit',
"form.mytime.start" => 'aanvang',
"form.mytime.finish" => 'einde',
"form.mytime.duration" => 'tijdsduur',
"form.mytime.note" => 'opmerking',
"form.mytime.behalf" => 'invullen namens',
"form.mytime.daily" => 'op deze dag',
"form.mytime.total" => 'totaal uren: ',
"form.mytime.th.project" => 'project',
"form.mytime.th.activity" => 'activiteit',
"form.mytime.th.start" => 'aanvang',
"form.mytime.th.finish" => 'einde',
"form.mytime.th.duration" => 'tijdsduur',
"form.mytime.th.note" => 'opmerking',
"form.mytime.th.edit" => 'wijzig',
"form.mytime.th.delete" => 'verwijder',
"form.mytime.del_yes" => 'tijdrecord verwijderd',
"form.mytime.no_finished_rec" => 'dit tijdrecord is opgeslagen met alleen een starttijd. dit is geen fout. log uit indien nodig.',
"form.mytime.billable" => 'factureerbaar',
// Note to translators: the strings below are missing in the translation and must be translated and added
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'nieuw manager account aanmaken',
"form.profile.prof_str" => 'wijzig profiel',
"form.profile.name" => 'naam',
"form.profile.login" => 'login',
"form.profile.pas1" => 'wachtwoord',
"form.profile.pas2" => 'bevestig wachtwoord',
"form.profile.comp" => 'bedrijf',
"form.profile.www" => 'website van bedrijf',
"form.profile.curr" => 'valuta',
// Note to translators: the strings below are missing in the translation and must be translated and added
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
"form.people.ppl_str" => 'medewerkers',
"form.people.createu_str" => 'nieuwe medewerker toevoegen',
"form.people.edit_str" => 'medewerker wijzigen',
"form.people.del_str" => 'medewerker verwijderen',
"form.people.th.name" => 'naam',
"form.people.th.login" => 'login',
"form.people.th.role" => 'rol',
"form.people.th.edit" => 'wijzig',
"form.people.th.del" => 'verwijder',
"form.people.th.status" => 'status',
"form.people.th.project" => 'project',
"form.people.th.rate" => 'tarief',
"form.people.manager" => 'manager',
"form.people.comanager" => 'co-manager',
"form.people.empl" => 'medewerker',
"form.people.name" => 'naam',
"form.people.login" => 'login',
"form.people.pas1" => 'wachtwoord',
"form.people.pas2" => 'bevestig wachtwoord',
"form.people.rate" => 'standaard uurtarief',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projecten',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projecten',
"form.project.edit_str" => 'project wijzigen',
"form.project.add_str" => 'nieuw project toevoegen',
"form.project.del_str" => 'project verwijderen',
"form.project.th.name" => 'naam',
"form.project.th.edit" => 'wijzig',
"form.project.th.del" => 'verwijder',
"form.project.name" => 'naam',

// activities form attributes
"form.activity.act_title" => 'activiteiten',
"form.activity.add_title" => 'nieuwe activiteit toevoegen',
"form.activity.edit_str" => 'activiteit wijzigen',
"form.activity.del_str" => 'activiteit verwijderen',
"form.activity.name" => 'naam',
"form.activity.project" => 'project',
"form.activity.th.name" => 'naam',
"form.activity.th.project" => 'project',
"form.activity.th.edit" => 'wijzig',
"form.activity.th.del" => 'verwijder',

// report attributes
"form.report.title" => 'rapporten',
"form.report.from" => 'begindatum',
"form.report.to" => 'einddatum',
"form.report.groupby_user" => 'medewerker',
"form.report.groupby_project" => 'project',
"form.report.groupby_activity" => 'activiteit',
"form.report.duration" => 'duur',
"form.report.start" => 'begin',
"form.report.activity" => 'activiteit',
"form.report.show_idle" => 'toon leegloop',
"form.report.finish" => 'eind',
"form.report.note" => 'opmerking',
"form.report.project" => 'project',
"form.report.totals_only" => 'alleen totalen',
"form.report.total" => 'uren totaal',
"form.report.th.empllist" => 'medewerker',
"form.report.th.date" => 'datum',
"form.report.th.project" => 'project',
"form.report.th.activity" => 'activiteit',
"form.report.th.start" => 'begin',
"form.report.th.finish" => 'eind',
"form.report.th.duration" => 'duur',
"form.report.th.note" => 'opmerking',

// mail form attributes
"form.mail.from" => 'van',
"form.mail.to" => 'aan',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'onderwerp',
"form.mail.comment" => 'opmerking',
"form.mail.above" => 'stuur dit rapport per e-mail',
"form.mail.footer_str" => 'Ontwikkeling van Anuko Time Tracker is mogelijk gemaakt door <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>e-mail is verstuurd</b>',

// invoice attributes
"form.invoice.title" => 'factuur',
"form.invoice.caption" => 'factuur',
"form.invoice.above" => 'extra informatie voor factuur',
"form.invoice.select_cust" => 'kies klant',
"form.invoice.fillform" => 'vul de velden in',
"form.invoice.date" => 'datum',
"form.invoice.number" => 'factuur nummer',
"form.invoice.tax" => 'BTW',
"form.invoice.discount" => 'korting',
"form.invoice.daily_subtotals" => 'subtotalen per dag',
"form.invoice.yourcoo" => 'uw naam<br> en adres',
"form.invoice.custcoo" => 'klant naam<br> en adres',
"form.invoice.comment" => 'opmerkingen',
"form.invoice.th.username" => 'medewerker',
"form.invoice.th.time" => 'uren',
"form.invoice.th.rate" => 'tarief',
"form.invoice.th.summ" => 'bedrag',
"form.invoice.subtotal" => 'subtotaal',
"form.invoice.total" => 'totaal',
"form.invoice.customer" => 'klant',
"form.invoice.period" => 'factuur over periode',
"form.invoice.mailinv_above" => 'stuur deze factuur per e-mail',
"form.invoice.sending_str" => '<b>factuur verzonden</b>',

"form.migration.zip" => 'compressie',
"form.migration.file" => 'kies bestand',
"form.migration.import.title" => 'importeer gegevens',
"form.migration.import.success" => 'import gelukt',
"form.migration.import.text" => 'import teamgegevens uit een xml bestand',
"form.migration.export.title" => 'exporteer gegevens',
"form.migration.export.success" => 'export gelukt',
"form.migration.export.text" => 'u kunt alle teamgegevens naar een xml bestand exporteren. dit kan zinvol zijn als u gegevens migreert naar uw eigen server.',
// Note to translators: the string below is missing and must be translated and added
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'klanten',
"form.client.add_title" => 'klant toevoegen',
"form.client.edit_title" => 'klant wijzigen',
"form.client.del_title" => 'klant verwijderen',
"form.client.th.name" => 'naam',
"form.client.th.edit" => 'wijzig',
"form.client.th.del" => 'verwijder',
"form.client.name" => 'naam',
"form.client.tax" => 'BTW',
"form.client.discount" => 'korting',
"form.client.daily_subtotals" => 'subtotalen per dag',
"form.client.yourcoo" => 'uw naam<br> en adres op de factuur',
"form.client.custcoo" => 'adres',
"form.client.comment" => 'opmerkingen',

// miscellaneous strings
"forward.forgot_password" => 'wachtwoord vergeten?',
"forward.edit" => 'wijzig',
"forward.delete" => 'verwijder',
"forward.sendbyemail" => 'stuur per e-mail',
"forward.tocsvfile" => 'exporteer gegevens naar .csv file',
// Note to translators: the string below is missing and must be translated and added
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'factuur maken',
"forward.change" => 'klanten wijzigen',
// Note to translators: the string below is missing and must be translated and added
// "forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- kies project ---',
"controls.select.activity" => '--- kies activiteit ---',
"controls.select.client" => '--- kies klant ---',
"controls.project_bind" => '--- allemaal ---',
"controls.all" => '--- allemaal ---',
"controls.notbind" => '--- geen ---',
"controls.per_tm" => 'deze maand',
"controls.per_lm" => 'afgelopen maand',
"controls.per_tw" => 'deze week',
"controls.per_lw" => 'afgelopen week',
// Note to translators: the strings below is missing and must be translated and added 
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- kies periode ---',
"controls.sel_groupby" => '--- niet groeperen ---',
"controls.inc_billable" => 'factureerbaar',
"controls.inc_nbillable" => 'niet factureerbaar',
// Note to translators: the string below is missing and must be translated and added
// "controls.default" => '--- default ---',

// labels
// Note to translators: the strings below are missing and must be translated and added
// "label.chart.title1" => 'activities for user',
// "label.chart.title2" => 'projects for user',
// "label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>namens %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (beheerder)',
"label.time_noentry" => 'geen opgave',
"label.today" => 'vandaag',
"label.req_fields" => '* verplichte velden',
"label.sel_project" => 'kies project',
"label.sel_activity" => 'kies activiteit',
"label.sel_tp" => 'kies periode',
"label.set_tp" => 'of stel datums in',
"label.fields" => 'toon velden',
"label.group_title" => 'groeperen op',
// Note to translators: the string below is missing and must be translated and added
// "label.include_title" => 'include records',
"label.inv_str" => 'factuur',
"label.set_empl" => 'kies medewerkers',
"label.sel_all" => 'kies alles',
"label.sel_none" => 'kies geen',
"label.or" => 'of',
"label.disable" => 'uitschakelen',
"label.enable" => 'inschakelen',
"label.filter" => 'filter',
// Note to translators: the strings below are missing and must be translated and added
// "label.timeweek" => 'weekly total',
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>