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

$i18n_language_name = "Italian";
$i18n_float_delimiter = ",";

$i18n_month = array ('gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luiglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('domenica', 'lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato');
$i18n_week_sn = array ("do","lu","ma","me","gi","ve","sa");

//format m/d
$i18n_holidays = array("01/01","06/01", "12/04", "13/04", "25/04", "01/05", "02/06", "15/08", "01/11", "08/12", "25/12", "26/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'login',
"menu.logout" => 'logout',
"menu.feedback" => 'feedback',
// Note to translators: "menu.help" => 'help', // the string must be translated
"menu.register" => 'crea un nuovo account',
"menu.edprof" => 'modifica profilo',
"menu.mytime" => 'tempo di lavoro',
// Note to translators: "menu.report" => 'report', // the string must be translated
"menu.project" => 'progetti',
"menu.activity" => 'attività',
"menu.people" => 'persone',
"menu.profile" => 'teams',
"menu.migration" => 'esporta dati',
"menu.clients" => 'clienti',
"menu.services" => 'cambia password',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'database error',
"errors.wrong" => 'dato \'{0}\' errato',
"errors.empty" => 'il campo \'{0}\' è vuoto',
"errors.compare" => 'il campo \'{0}\' non è uguale al campo \'{1}\'',
"errors.wr_interval" => 'intervallo errato',
"errors.wr_project" => 'seleziona il progetto',
"errors.wr_activity" => 'seleziona la attività',
"errors.wr_auth" => 'login o password errati',
"errors.del_nothing" => 'nessun elemento da cancellare',
"errors.reg_error" => "impossibile creare un nuovo account",
"errors.prof_error" => "impossibile cambiare il profilo",
"errors.no_user" => "nessun utente simile",
"errors.mt_del_no" => 'impossibile cancellare il record',
"errors.mt_del_no_conf" => 'il record non è stato cancellato',
"errors.mt_insert" => 'erroe nell\'inserimento del tempo',
"errors.user_exist" => 'questa e-mail è già utilizzata da un altro utente',
"errors.user_notexists" => 'l\'utente non esiste',
"errors.user_update" => "impossibile cambiare i dati utente",
"errors.user_delete" => "impossibile cancellare i dati utente",
"errors.project_exist" => 'esiste già un progetto con questo nome',
"errors.project_notexists" => 'il progetto non esiste',
"errors.project_update" => "impossibile cambiare il nome del progetto",
"errors.project_add" => 'impossibile aggiungere un nuovo progetto',
"errors.project_nodel" => 'impossibile cancellare il progetto',
"errors.activity_add" => 'impossibile aggiungere una nuva attività',
"errors.activity_exist" => 'esiste già una attività con questo nome',
"errors.activity_update" => "impossibile cambiare il nome della attività",
"errors.activity_nodel" => 'impossibile cancellare la attività',
"errors.activity_notexists" => 'la attività non esiste',
"errors.report_period" => 'periodo errato',
"errors.search_by_login" => 'nessun utente con questa e-mail',
"errors.multiteam_mode" => 'non puoi creare ulteriori accounts',
"errors.upload" => 'file upload error',
"errors.client_nodel" => 'impossibile cancellare il cliente',
"errors.client_notexists" => 'il cliente non esiste',
"errors.ie_sameusers" => 'una o più e-mail esistono già nel database',
"errors.period_lock" => 'impossibile aggiungere un record. Il periodo è stato bloccato',
// Note to translators: the strings below are missing and must be added and translated
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'login',
"button.now" => 'adesso',
"button.behalf_set" => 'set',
"button.save" => 'salva',
"button.delete" => 'elimina',
"button.cancel" => 'cancella',
"button.submit" => 'invia',
"button.ppl_add" => 'aggiungi nuovo utente',
"button.proj_add" => 'aggiungi nuovo progetto',
"button.act_add" => 'aggiungi nuova attività',
"button.add" => 'add',
"button.generate" => 'genera',
"button.sendpwd" => 'vai',
"button.send" => 'invia',
"button.sendbyemail" => 'invia tramite e-mail',
"button.asnew" => 'salva come nuovo',
"button.profile_add" => 'crea un nuovo team',
"button.export" => 'esporta team',
"button.import" => 'importa team',
"button.apply" => 'applica',
"button.clnt_add" => 'aggiungi un nuovo cliente',

"form.filter.project" => 'progetto',
"form.filter.filter" => 'report preferiti',
"form.filter.filter_new" => 'salva nei preferiti',
"form.filter.filter_confirm_delete" => 'sei sicuro di voler cancellare questo report dai preferiti?',

// login form attributes
"form.login.title" => 'login',
"form.login.login" => 'login',
"form.login.password" => 'password',

// password reminder form attributes
"form.fpass.title" => 'reset password',
"form.fpass.login" => 'login',
"form.fpass.send_pass_str" => 'richiesta di reset pasword inviata',
"form.fpass.send_pass_subj" => 'richiesta di password reset', 
// Note to translators: the strings below must be translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'amministratore',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new team by creating a new team manager account.<br>you can also import team data from an xml file from another Anuko Time Tracker server (no e-mail collisions are allowed).',
"form.admin.password" => 'password',
"form.admin.password_confirm" => 'conferma password',
"form.admin.change_pass" => 'cambia la password dell\'amministratore',
"form.admin.profile.title" => 'teams',
"form.admin.profile.noprofiles" => 'il database è vuoto. loggati come amministratore e crea un nuovo team.',
"form.admin.profile.comment" => 'elimina team',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'nome',
"form.admin.profile.th.edit" => 'edit',
"form.admin.profile.th.del" => 'elimina',
"form.admin.profile.th.active" => 'attivo',
"form.admin.lock.period" => 'blocca l\'intervallo di tempo',
// Note to translators: the strings below are missing and must be added and translated
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'giorno',
"form.mytime.edit_title" => 'modifica time record',
"form.mytime.del_str" => 'elimina time record',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'data',
"form.mytime.project" => 'progetto',
"form.mytime.activity" => 'attività',
"form.mytime.start" => 'inizio',
"form.mytime.finish" => 'fine',
"form.mytime.duration" => 'durata',
"form.mytime.note" => 'note',
"form.mytime.behalf" => 'attività giornaliera per',
"form.mytime.daily" => 'attività giornaliera',
"form.mytime.total" => 'ore totali: ',
"form.mytime.th.project" => 'progetto',
"form.mytime.th.activity" => 'attività',
"form.mytime.th.start" => 'inizio',
"form.mytime.th.finish" => 'fine',
"form.mytime.th.duration" => 'durata',
"form.mytime.th.note" => 'note',
"form.mytime.th.edit" => 'edit',
"form.mytime.th.delete" => 'elimina',
"form.mytime.del_yes" => 'time record cancellato',
"form.mytime.no_finished_rec" => 'questo record è stato salvato con la sola ora di inzio attività. non è un errore. esegui il logout per altro....',
"form.mytime.billable" => 'fatturabile',
"form.mytime.warn_tozero_rec" => 'questo time record deve essere cancellato perchè il periodo di riferimento è stato bloccato',
// Note to translators: the string below is missing and must be added and translated
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'crea un nuovo account manager',
"form.profile.prof_str" => 'modifca il profilo',
"form.profile.name" => 'nome',
"form.profile.login" => 'login',
"form.profile.pas1" => 'password',
"form.profile.pas2" => 'conferma password',
"form.profile.comp" => 'azienda',
"form.profile.www" => 'sito dell\'azienda',
"form.profile.curr" => 'moneta',
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
"form.people.ppl_str" => 'persone',
"form.people.createu_str" => 'crea un nuovo utente',
"form.people.edit_str" => 'modifica utente',
"form.people.del_str" => 'elimina utente',
"form.people.th.name" => 'nome',
"form.people.th.login" => 'login',
"form.people.th.role" => 'funzione',
"form.people.th.edit" => 'modifica',
"form.people.th.del" => 'elimina',
"form.people.th.status" => 'stato',
"form.people.th.project" => 'progetto',
"form.people.th.rate" => 'costo',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'utente',
"form.people.name" => 'nome',
"form.people.login" => 'login',
"form.people.pas1" => 'password',
"form.people.pas2" => 'conferma password',
"form.people.rate" => 'costo per ora di default',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'progetti',
"form.people.email" => "e-mail",

// projects form attributes
"form.project.proj_title" => 'progetti',
"form.project.edit_str" => 'mofifca progetto',
"form.project.add_str" => 'aggiungi nuovo progetto',
"form.project.del_str" => 'elimina progetto',
"form.project.th.name" => 'nome',
"form.project.th.edit" => 'modifica',
"form.project.th.del" => 'elimina',
"form.project.name" => 'nome',

// activities form attributes
"form.activity.act_title" => 'attività',
"form.activity.add_title" => 'aggiungi nuova attività',
"form.activity.edit_str" => 'modifica attività',
"form.activity.del_str" => 'elimina attività',
"form.activity.name" => 'nome',
"form.activity.project" => 'progetto',
"form.activity.th.name" => 'nome',
"form.activity.th.project" => 'progetto',
"form.activity.th.edit" => 'modifica',
"form.activity.th.del" => 'elimina',

// report attributes
"form.report.title" => 'report',
"form.report.from" => 'data inizio',
"form.report.to" => 'data fine',
"form.report.groupby_user" => 'utente',
"form.report.groupby_project" => 'progetto',
"form.report.groupby_activity" => 'attività',
"form.report.duration" => 'durata',
"form.report.start" => 'inizio',
"form.report.activity" => 'attività',
"form.report.show_idle" => 'mostra inattivi',
"form.report.finish" => 'fine',
"form.report.note" => 'nota',
"form.report.project" => 'progetto',
"form.report.totals_only" => 'solo i totali',
"form.report.total" => 'ore totali',
"form.report.th.empllist" => 'utente',
"form.report.th.date" => 'data',
"form.report.th.project" => 'progetto',
"form.report.th.activity" => 'attività',
"form.report.th.start" => 'inizio',
"form.report.th.finish" => 'fine',
"form.report.th.duration" => 'durata',
"form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'da',
"form.mail.to" => 'a',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'oggetto',
"form.mail.comment" => 'commento',
"form.mail.above" => 'invia questo report tramite e-mail',
"form.mail.footer_str" => 'Anuko Time Tracker development è sponsorizzato da <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>messaggio inviato</b>',

// invoice attributes
"form.invoice.title" => 'fattura',
"form.invoice.caption" => 'fattura',
"form.invoice.above" => 'informazioni aggiuntive per la fattura',
"form.invoice.select_cust" => 'seleziona il cliente',
"form.invoice.fillform" => 'compila i campi',
"form.invoice.date" => 'data',
"form.invoice.number" => 'numero fattura',
"form.invoice.tax" => 'tassa',
"form.invoice.discount" => 'sconto',
"form.invoice.daily_subtotals" => 'subtotaole giornaliero',
"form.invoice.yourcoo" => 'tuo nome<br> e indirizzo',
"form.invoice.custcoo" => 'nome cliente<br> e indirizzo',
"form.invoice.comment" => 'commento ',
"form.invoice.th.username" => 'persona',
"form.invoice.th.time" => 'ore',
"form.invoice.th.rate" => 'costo',
"form.invoice.th.summ" => 'ammontare',
"form.invoice.subtotal" => 'subtotale',
"form.invoice.total" => 'totale',
"form.invoice.customer" => 'cliente',
"form.invoice.period" => 'periodo di fatturazione',
"form.invoice.mailinv_above" => 'invia la fattura tramite e-mail',
"form.invoice.sending_str" => '<b>fattura inviata</b>',

"form.migration.zip" => 'compressione',
"form.migration.file" => 'seleziona il file',
"form.migration.import.title" => 'importa i dati',
"form.migration.import.success" => 'importazione eseguita con successo',
"form.migration.import.text" => 'importa i dati del team da un file xml',
"form.migration.export.title" => 'esporta i dati',
"form.migration.export.success" => 'esportazione eseguita con successo',
"form.migration.export.text" => 'puoi esporate tutti i dati dei team in un file xml. questo può essere utile se devi trasferire i dati da un server ad un altro.',
// Note to translators: the strings below are missing and must be added and translated
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'clienti',
"form.client.add_title" => 'aggiungi cliente',
"form.client.edit_title" => 'modifica cliente',
"form.client.del_title" => 'elimina cliente',
"form.client.th.name" => 'nome',
"form.client.th.edit" => 'modifica',
"form.client.th.del" => 'elimina',
"form.client.name" => 'nome',
"form.client.tax" => 'tassa',
"form.client.discount" => 'sconto',
"form.client.daily_subtotals" => 'subtotale giornaliero',
"form.client.yourcoo" => 'il tuo nome<br> e indirizzo nella fattura',
"form.client.custcoo" => 'indirizzo',
"form.client.comment" => 'commento ',

// miscellaneous strings
"forward.forgot_password" => 'password dimenticata?',
"forward.edit" => 'modifica',
"forward.delete" => 'elimina',
"forward.sendbyemail" => 'invia tramite e-mail',
"forward.tocsvfile" => 'esporta i dati in un file .csv',
"forward.toxmlfile" => 'esporta i dati in un file .xml',
"forward.geninvoice" => 'genera la fattura',
"forward.change" => 'configura i clienti',
"forward.lockpage" => 'intervallo di tempo da bloccare per non consentire ulteriori modifiche',

// strings inside contols on forms
"controls.select.project" => '--- seleziona il progetto ---',
"controls.select.activity" => '--- seleziona la attività ---',
"controls.select.client" => '--- seleziona il cliente ---',
"controls.project_bind" => '--- tutti ---',
"controls.all" => '--- tutti ---',
"controls.notbind" => '--- no ---',
"controls.per_tm" => 'questo mese',
"controls.per_lm" => 'mese scorso',
"controls.per_tw" => 'questa settimana',
"controls.per_lw" => 'settimana scorsa',
"controls.per_td" => 'questo giorno',
"controls.per_at" => 'tutto il tempo',
"controls.per_ty" => 'quest\'anno',
"controls.sel_period" => '--- seleziona il periodo di tempo ---',
"controls.sel_groupby" => '--- non raggruppare ---',
"controls.inc_billable" => 'fatturabile',
"controls.inc_nbillable" => 'non fatturabile',
// Note to translators: the string below must be translated
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'attività per utente',
// Note to translators: the string below is missing and must be added and translated
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'grafico per il periodo',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>a favore di %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (amministratore)',
"label.time_noentry" => 'nessun inserimento',
"label.today" => 'oggi',
"label.req_fields" => '* campi obbligatori',
"label.sel_project" => 'seleziona il progetto',
"label.sel_activity" => 'seleziona la attività',
"label.sel_tp" => 'seleziona il periodo di tempo',
"label.set_tp" => 'oppure setta le date',
"label.fields" => 'mostra i campi',
"label.group_title" => 'raggruppa per',
"label.include_title" => 'includi records',
"label.inv_str" => 'fattura',
"label.set_empl" => 'seleziona utenti',
"label.sel_all" => 'seleziona tutti',
"label.sel_none" => 'deseleziona tutti',
"label.or" => 'o',
"label.disable" => 'disabilita',
"label.enable" => 'abilita',
"label.filter" => 'filtro',
"label.timeweek" => 'totale settimanale',
"label.hrs" => 'ore',
// Note to translators: the strings below are missing and must be added and translated
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>