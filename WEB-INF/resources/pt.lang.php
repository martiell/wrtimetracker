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

$i18n_language_name = "Portuguese";
$i18n_float_delimiter = ".";

$i18n_month = array ('janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'augosto', 'setembro', 'outubro', 'novembro', 'dezembro');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado');
$i18n_week_sn = array ("sn","mo","tw","th","td","fr","st");

//format d/m
$i18n_holidays = array("01/01","24/02", "10/04", "12/04", "25/04", "01/05", "10/06", "11/06", "15/08", "05/10", "01/11", "01/12", "08/12", "25/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'login',
"menu.logout" => 'logout',
"menu.feedback" => 'feedback',
"menu.help" => 'ajuda',
"menu.register" => 'criar nova conta de gerente',
"menu.edprof" => 'editar perfil',
"menu.mytime" => 'meu tempo',
"menu.report" => 'relatórios',
"menu.project" => 'projetos',
"menu.activity" => 'atividades',
"menu.people" => 'pessoas',
// Note to translators: the strings below are missing and must be added and translated 
// "menu.profile" => 'teams',
// "menu.migration" => 'export data',
// "menu.clients" => 'clients',
// "menu.services" => 'options',
// "menu.admin" => 'admin',

// error strings
// Note to translators: the strings below must be translated
// "errors.db_error" => 'database error',
// "errors.wrong" => 'incorrect \'{0}\' data',
// "errors.empty" => 'field \'{0}\' is empty',
// "errors.compare" => 'the field \'{0}\' is not equaled to a field \'{1}\'',
// "errors.wr_interval" => 'incorrect interval',
// "errors.wr_project" => 'select project',
// "errors.wr_activity" => 'select activity',
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
// "errors.project_exist" => 'project with this name already exists',
// "errors.project_notexists" => 'project not exists',
// "errors.project_update" => "unable to change project name",
// "errors.project_add" => 'unable to add new project',
// "errors.project_nodel" => 'unable to delete project',
// "errors.activity_add" => 'unable to add new activity',
// "errors.activity_exist" => 'activity with this name already exists',
// "errors.activity_update" => "unable to change activity name",
// "errors.activity_nodel" => 'unable to delete activity',
// "errors.activity_notexists" => 'activity not exists',
// "errors.report_period" => 'incorrect period',
// "errors.search_by_login" => 'no user with this e-mail',
// Note to translators: the strings below are missing and must be added and translated 
// "errors.multiteam_mode" => 'you can\'t create more accounts',
// "errors.upload" => 'file upload error',
// "errors.client_nodel" => 'unable to delete client',
// "errors.client_notexists" => 'client does not exist',
// "errors.ie_sameusers" => 'one or more logins already exist in the database',
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'login',
"button.now" => 'hoje',
"button.behalf_set" => 'set',
"button.save" => 'salvar',
"button.delete" => 'apagar',
"button.cancel" => 'cancelar',
"button.submit" => 'submeter',
// Note to translators: "button.ppl_add" => 'add new user', // the string must be translated
"button.proj_add" => 'adicionar novo projeto',
"button.act_add" => 'adicionar nova atividade',
"button.add" => 'add',
"button.generate" => 'generate',
"button.sendpwd" => 'enviar senha',
"button.send" => 'enviar',
"button.sendbyemail" => 'send by email',
// Note to translators: the strings below are missing and must be added and translated
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
"form.login.title" => 'login como usuário de debug',
// Note to translators: "form.login.login" => 'e-mail', // email has been changed to login
"form.login.password" => 'senha',

// password reminder form attributes
"form.fpass.title" => 'enviar senha',
// Note to translators: "form.fpass.login" => 'e-mail', // email has been changed to login
"form.fpass.send_pass_str" => 'senha foi enviada',
"form.fpass.send_pass_subj" => 'Sua senha do Anuko Time Tracker',
// Note to translators: the strings below are missing and must be added and translated
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
// Note to translators: the strings below are missing and must be added and translated 
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
"form.mytime.title" => 'adicionar período',
// Note to translators: the strings below must be translated
// "form.mytime.edit_title" => 'editing time record',
// "form.mytime.del_str" => 'deleting time record',
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'data',
"form.mytime.project" => 'projeto',
"form.mytime.activity" => 'atividade',
"form.mytime.start" => 'início',
"form.mytime.finish" => 'fim',
"form.mytime.duration" => 'duração',
"form.mytime.note" => 'anotação',
// Note to translators: the string below must be translated
// "form.mytime.behalf" => 'daily work for',
"form.mytime.daily" => 'trabalho diário',
"form.mytime.total" => 'horas totais: ',
"form.mytime.th.project" => 'projeto',
"form.mytime.th.activity" => 'actividade',
"form.mytime.th.start" => 'início',
"form.mytime.th.finish" => 'finish',
"form.mytime.th.duration" => 'duração',
"form.mytime.th.note" => 'fim',
"form.mytime.th.edit" => 'editar',
"form.mytime.th.delete" => 'apagar',
"form.mytime.del_yes" => 'o período registrado foi apagado com sucesso',
// Note to translators: the strings below are missing and must be added and translated 
// "form.mytime.no_finished_rec" => 'this record was saved with only start time. it is not an error. logout if you need to.',
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'criar nova conta de gerência',
"form.profile.prof_str" => 'editando perfil',
"form.profile.name" => 'nome',
// Note to translators: the string below is missing and must be added and translated 
// "form.profile.login" => 'login',
"form.profile.pas1" => 'senha',
"form.profile.pas2" => 'confirme a senha',
"form.profile.comp" => 'empresa',
"form.profile.www" => 'site da empresa',
"form.profile.curr" => 'currency',
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
"form.people.ppl_str" => 'pessoas',
"form.people.createu_str" => 'adicionar novo usuário',
"form.people.edit_str" => 'editando usuário',
"form.people.del_str" => 'apagando usuário',
"form.people.th.name" => 'nome',
// Note to translators: "form.people.th.login" => 'e-mail', // email has been changed to login
"form.people.th.role" => 'regra',
"form.people.th.edit" => 'editar',
"form.people.th.del" => 'apagar',
"form.people.th.status" => 'status',
// Note to translators: the strings below are missing and must be added and translated 
// "form.people.th.project" => 'project',
// "form.people.th.rate" => 'rate',
"form.people.manager" => 'gerente',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.comanager" => 'comanager',
"form.people.empl" => 'usuário',
"form.people.name" => 'nome',
// Note to translators: the string below is missing and must be added and translated 
// "form.people.login" => 'login',
"form.people.pas1" => 'senha',
"form.people.pas2" => 'confirme a senha',
"form.people.rate" => 'hourly rate',
// Note to translators: the strings below are missing and must be added and translated 
// "form.people.comanager" => 'co-manager',
// "form.people.projects" => 'projects',
// "form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projetos',
"form.project.edit_str" => 'editando projeto',
"form.project.add_str" => 'adicionando novo projeto',
"form.project.del_str" => 'apagando projeto',
"form.project.th.name" => 'nome',
"form.project.th.edit" => 'editar',
"form.project.th.del" => 'apagar',
"form.project.name" => 'nome',

// activities form attributes
"form.activity.act_title" => 'atividades',
"form.activity.add_title" => 'adicionando nova atividade',
"form.activity.edit_str" => 'editando atividade',
// Note to translators: the string below must be translated
// "form.activity.del_str" => 'deleting activity',
"form.activity.name" => 'nome',
"form.activity.project" => 'project',
"form.activity.th.name" => 'nome',
"form.activity.th.project" => 'project',
"form.activity.th.edit" => 'editar',
"form.activity.th.del" => 'apagar',

// report attributes
"form.report.title" => 'relatórios',
"form.report.from" => 'data inicial',
"form.report.to" => 'data final',
// Note to translators: the strings below must be translated
// "form.report.groupby_user" => 'user',
// "form.report.groupby_project" => 'project',
// "form.report.groupby_activity" => 'activity',
"form.report.duration" => 'duração',
"form.report.start" => 'início',
"form.report.activity" => 'atividade',
// Note to translators: the string below must be translated
// "form.report.show_idle" => 'show idle',
"form.report.finish" => 'fim',
"form.report.note" => 'anotação',
"form.report.project" => 'projeto',
// Note to translators: the string below is missing and must be added and translated 
// "form.report.totals_only" => 'totals only',
"form.report.total" => 'horas totais',
"form.report.th.empllist" => 'usuário',
// Note to translators: the strings below must be translated
// "form.report.th.date" => 'data',
// "form.report.th.project" => 'project',
// "form.report.th.activity" => 'activity',
// "form.report.th.start" => 'start',
// "form.report.th.finish" => 'finish',
// "form.report.th.duration" => 'duration',
// "form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'de',
"form.mail.to" => 'para',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'assunto',
"form.mail.comment" => 'comentário',
"form.mail.above" => 'enviar este relatório por e-mail',
// Note to translators: the strings below must be translated
// "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>',
// "form.mail.sending_str" => '<b>the message has been sent</b>',

// invoice attributes
// Note to translators: the strings below must be translated
// "form.invoice.title" => 'invoice',
// "form.invoice.caption" => 'invoice',
// "form.invoice.above" => 'additional information for invoice',
// "form.invoice.select_cust" => 'select client',
// "form.invoice.fillform" => 'fill the fields',
// "form.invoice.date" => 'invoice date',
// "form.invoice.number" => 'invoice number',
// "form.invoice.tax" => 'tax',
// "form.invoice.discount" => 'discount',
// "form.invoice.daily_subtotals" => 'daily subtotals'
// "form.invoice.yourcoo" => 'your name<br> and address',
// "form.invoice.custcoo" => 'client name<br> and address',
// "form.invoice.comment" => 'comment ',
// "form.invoice.th.username" => 'person',
// "form.invoice.th.time" => 'hours',
// "form.invoice.th.rate" => 'rate',
// "form.invoice.th.summ" => 'amount',
// "form.invoice.subtotal" => 'subtotal',
// "form.invoice.total" => 'total',
// "form.invoice.customer" =>'customer',
"form.invoice.period" => 'período de tempo',
// Note to translators: the strings below must be translated
// "form.invoice.mailinv_above" => 'send this invoice by e-mail',
// "form.invoice.sending_str" => '<b>invoice has been sent</b>',

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
"forward.forgot_password" => 'esqueceu a senha?',
// Note to translators: the strings below must be translated 
// "forward.edit" => 'edit',
// "forward.delete" => 'delete',
"forward.sendbyemail" => 'enviar relatório por e-mail',
// Note to translators: the string below must be translated 
// "forward.tocsvfile" => 'export data to .csv file',
// Note to translators: the strings below are missing and must be added and translated 
// "forward.toxmlfile" => 'export data to .xml file',
// "forward.geninvoice" => 'generate invoice',
// "forward.change" => 'configure clients',
// "forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- selecione projeto ---',
"controls.select.activity" => '--- selecione atividade ---',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.select.client" => '--- select client ---',
// "controls.project_bind" => '--- all ---',
// "controls.all" => '--- all ---',
// "controls.notbind" => '--- no ---',
"controls.per_tm" => 'este mês',
"controls.per_lm" => 'último mês',
"controls.per_tw" => 'esta semana',
"controls.per_lw" => 'última semana',
// Note to translators: the strings below are missing and must be added and translated 
// "controls.per_td" => 'this day',
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- selecione o período de tempo ---',
// Note to translators: the strings below must be translated 
// "controls.sel_groupby" => '--- no grouping ---',
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
"label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (gerente)',
// Note to translators: the strings below are missing and must be added and translated 
// "label.pcminfo" => ' (co-manager)',
// "label.painfo" => ' (administrator)',
"label.time_noentry" => 'sem registro',
"label.today" => 'today',
"label.req_fields" => '* campos obrigatórios',
// Note to translators: the strings below must be translated 
// "label.sel_project" => 'select project',
// "label.sel_activity" => 'select activity',
"label.sel_tp" => 'selecione o período de tempo',
"label.set_tp" => 'ou selecionar datas',
"label.fields" => 'exibir campos',
// Note to translators: the strings below must be translated
// "label.group_title" => 'group by',
// "label.include_title" => 'include records',
// "label.inv_str" => 'invoice',
// "label.set_empl" => 'select users'
//" label.sel_all" => 'select all',
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