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
// | Contributors: சுதர்சன் சாந்தியப்பன்
// +----------------------------------------------------------------------+

$i18n_language_name = "Tamil";
$i18n_float_delimiter = ".";

$i18n_month = array ('ஜனவரி', 'பிப்ரவரி', 'மார்ச்', 'ஏப்ரல்', 'மே', 'ஜுன்', 'ஜூலை', 'ஆகஸ்ட்', 'செப்டம்பர்', 'அக்டோபர்', 'நவம்பர்', 'டிசம்பர்');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('ஞாயிறு', 'திங்கள்', 'செவ்வாய்', 'புதன்', 'வியாழன்', 'வெள்ளி', 'சனி');
// Note to translators: the string below must be translated
// $i18n_week_sn = array ("su","mo","tu","we","th","fr","sa");

//format d/m
$i18n_holidays = array("26/01","01/04", "30/04", "15/08", "02/10");

$i18n_key_words = array(

// menu entries
"menu.login" => 'உள் நுழை',
"menu.logout" => 'வெளியேறு',
"menu.feedback" => 'கருத்து',
"menu.help" => 'உதவி',
"menu.register" => 'மேளாலர் கணக்கை உருவாக்கு',
"menu.edprof" => 'edit profile',
"menu.mytime" => 'என்னுடைய நேரம்',
"menu.report" => 'அறிக்கைகள்',
"menu.project" => 'திட்டப்பணிகள்',
"menu.activity" => 'செயல்பாடுகள்',
"menu.people" => 'மக்கள்',
"menu.profile" => 'குழுக்கள்',
// Note to translators: the strings below must be translated 
// "menu.migration" => 'export data',
// "menu.clients" => 'clients',
"menu.services" => 'கடவுச்சொல்லை மாற்று',
"menu.admin" => 'நிர்வகி',

// error strings
"errors.db_error" => 'தரவுதள பிழை',
"errors.wrong" => 'தரவு \'{0}\' பிழை',
// Note to translators: the strings below must be translated
// "errors.empty" => 'field \'{0}\' is empty',
// "errors.compare" => 'field \'{0}\' is not equal to field \'{1}\'',
// "errors.wr_interval" => 'incorrect interval',
"errors.wr_project" => 'திட்டப்பணியை தேர்வு செய்',
"errors.wr_activity" => 'செயல்பாட்டை தேர்வு செய்',
"errors.wr_auth" => 'தவறான கடவுச்சொல்',
"errors.del_nothing" => 'அழிப்பதற்கு தகவலேதுமில்லை',
"errors.reg_error" => "புதிய பயனரை உருவாக்க முடியவில்லை",
// Note to translators: the string below must be translated 
"errors.prof_error" => "unable to change profile",
"errors.no_user" => "அப்படியேதும் பயனர் இல்லை",
"errors.mt_del_no" => 'நேரப்பதிவை அழிக்க முடியவில்லை',
"errors.mt_del_no_conf" => 'நேரப்பதிவு அழிக்கப்படவில்லை',
"errors.mt_insert" => 'நேரச் செருகுதல் பிழை',
"errors.user_exist" => 'இந்த மின்னஞ்சலுடைய பயனர் முன்னதாகவே இருக்கிறார்',
"errors.user_notexists" => 'பயனர் இல்லை',
"errors.user_update" => "பயனர் தகவலை மாற்ற முடியவில்லை",
"errors.user_delete" => "பயனர் தகவலை அழிக்க முடியவில்லை",
"errors.project_exist" => 'இந்த பெயரையுடைய திட்டப்பணி முன்னதாகவே இருக்கிறது',
"errors.project_notexists" => 'திட்டப்பணி இல்லை',
"errors.project_update" => "திட்டப்பணியின் பெயரை மாற்ற முடியவில்லை",
"errors.project_add" => 'புதிய திட்டப்பணியை சேர்க்க முடியவில்லை',
"errors.project_nodel" => 'திட்டப்பணியை அழிக்க முடியவில்லை',
"errors.activity_add" => 'புதிய செயல்பாட்டை சேர்க்க முடியவில்லை',
"errors.activity_exist" => 'இந்த பெயரையுடைய செயல்பாடு முன்னதாகவே இருக்கிறது',
"errors.activity_update" => "செயல்பாட்டின் பெயரை மாற்ற முடியவில்லை",
"errors.activity_nodel" => 'செயல்பாட்டை அழிக்க முடியவில்லை',
"errors.activity_notexists" => 'செயல்பாடு இங்கு இல்லை',
// Note to translators: "errors.report_period" => 'incorrect period', // the string must be translated
"errors.search_by_login" => 'இந்த மின்னஞ்சலுடைய பயனர் இல்லை',
"errors.multiteam_mode" => 'உங்களால் மேற்கொண்டு கணக்குகளை உருவாக்க முடியாது',
"errors.upload" => 'கோப்பு மேலேற்றுதல் பிழை',
// Note to translators: the strings below must be translated
// "errors.client_nodel" => 'unable to delete client',
// "errors.client_notexists" => 'client does not exist',
// "errors.ie_sameusers" => 'one or more logins already exist in the database',
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'உள்நுழை',
"button.now" => 'தற்போது',
"button.behalf_set" => 'set',
"button.save" => 'சேமி',
"button.delete" => 'அழி',
"button.cancel" => 'தடு',
"button.submit" => 'சமர்ப்பி',
"button.ppl_add" => 'புதிய பயனரை சேர்',
"button.proj_add" => 'புதிய திட்டப்பணியை சேர்',
"button.act_add" => 'புதிய செயல்பாட்டை சேர்',
"button.add" => 'சேர்',
"button.generate" => 'உருவாக்கு',
"button.sendpwd" => 'செல்',
"button.send" => 'அனுப்பு',
"button.sendbyemail" => 'மின்னஞ்சலாக அனுப்பு',
"button.asnew" => 'புதியதாக சேமி',
"button.profile_add" => 'புதிய குழுவை சேர்',
// Note to translators: the strings below must be translated
// "button.export" => 'export team',
// "button.import" => 'import team',
"button.apply" => 'வின்னப்பி',
// Note to translators: "button.clnt_add" => 'add new client', // the string must be translated

"form.filter.project" => 'திட்டப்பணி',
"form.filter.filter" => 'பிடித்தமானதின் அறிக்கை',
"form.filter.filter_new" => 'பிடித்தமானதாக சேமி',
// Note to translators: the string below is missing and must be added and translated
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'உள் நுழை',
"form.login.login" => 'மின்னஞ்சல்',
"form.login.password" => 'கடவுச்சொல்',

// password reminder form attributes
"form.fpass.title" => 'கடவுச்சொல்லை திருத்து',
"form.fpass.login" => 'மின்னஞ்சல்',
"form.fpass.send_pass_str" => 'கடவுச்சொல்லை திருத்தும் விண்ணப்பம் அனுப்பப்பட்டது',
// Note to translators: the strings below must be translated
// "form.fpass.send_pass_subj" => 'Anuko Time Tracker password reset request',
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

// administrator form
"form.admin.title" => 'நிர்வாகி',
// Note to translators: the string below must be translated
// "form.admin.duty_text" => 'create a new team by creating a new team manager account.<br>you can also import team data from an xml file from another Anuko Time Tracker server (no e-mail collisions are allowed).',
"form.admin.password" => 'கடவுச்சொல்',
"form.admin.password_confirm" => 'கடவுச்சொல்லை உறுதிசெய்',
// Note to translators: the string below must be translated
// "form.admin.change_pass" => 'change password of administrator account',
"form.admin.profile.title" => 'குழுக்கள்',
// Note to translators: the string below must be translated
// "form.admin.profile.noprofiles" => 'your database is empty. login as admin and create a new team.',
"form.admin.profile.comment" => 'குழுவை நீக்கு',
// Note to translators: the string below must be translated
// "form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'பெயர்',
"form.admin.profile.th.edit" => 'திருத்து',
"form.admin.profile.th.del" => 'நீக்கு',
// Note to translators: the strings below must be translated
// "form.admin.profile.th.active" => 'active',
// "form.admin.lock.period" => 'lock interval in days',
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'என்னுடைய நேரம்',
// Note to translators: the strings below must be translated
// "form.mytime.edit_title" => 'editing time record',
// "form.mytime.del_str" => 'deleting time record',
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'தேதி',
"form.mytime.project" => 'திட்டப்பணி',
"form.mytime.activity" => 'செயல்பாடு',
"form.mytime.start" => 'ஆரம்பம்',
"form.mytime.finish" => 'முடிவு',
"form.mytime.duration" => 'அவகாசம்',
// Note to translators: the strings below must be translated
// "form.mytime.note" => 'note',
// "form.mytime.behalf" => 'daily work for',
// "form.mytime.daily" => 'daily work',
// "form.mytime.total" => 'hours total: ',
// "form.mytime.th.project" => 'project',
// "form.mytime.th.activity" => 'activity',
// "form.mytime.th.start" => 'start',
// "form.mytime.th.finish" => 'finish',
// "form.mytime.th.duration" => 'duration',
// "form.mytime.th.note" => 'note',
// "form.mytime.th.edit" => 'edit',
// "form.mytime.th.delete" => 'delete',
// "form.mytime.del_yes" => 'time record deleted successfully',
// "form.mytime.no_finished_rec" => 'this record was saved with only start time. it is not an error. logout if you need to.',
// "form.mytime.billable" => 'billable',
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted',

// Note to translators: from here up to the end all the strings must be translated
// profile form attributes
"form.profile.createm_str" => 'create new manager account',
"form.profile.prof_str" => 'editing profile',
"form.profile.name" => 'name',
"form.profile.login" => 'login',
"form.profile.pas1" => 'password',
"form.profile.pas2" => 'confirm password',
"form.profile.comp" => 'company',
"form.profile.www" => 'company web site',
"form.profile.curr" => 'currency',
"form.profile.showchart" => 'show pie charts',
"form.profile.lang" => 'language',
"form.profile.lang_set_as_default" => 'set as team default language',
"form.profile.lang_set_to_all" => 'set to all users of my team',
"form.profile.lang_allow_user_change" => 'allow users to change their language',
"form.profile.custom_date_format" => "date format",
"form.profile.custom_time_format" => "time format",
"form.profile.default_format" => "(default)",
"form.profile.start_week" => "first day of week",
"form.profile.hide_world_clock" => "hide world clock",
"form.profile.email" => "email",

// people form attributes
"form.people.ppl_str" => 'people',
"form.people.createu_str" => 'creating new user',
"form.people.edit_str" => 'editing user',
"form.people.del_str" => 'deleting user',
"form.people.th.name" => 'name',
"form.people.th.login" => 'login',
"form.people.th.role" => 'role',
"form.people.th.edit" => 'edit',
"form.people.th.del" => 'delete',
"form.people.th.status" => 'status',
"form.people.th.project" => 'project',
"form.people.th.rate" => 'rate',
"form.people.manager" => 'manager',
"form.people.comanager" => 'comanager',
"form.people.empl" => 'user',
"form.people.name" => 'name',
"form.people.login" => 'login',
"form.people.pas1" => 'password',
"form.people.pas2" => 'confirm password',
"form.people.rate" => 'default hourly rate',
"form.people.comanager" => 'co-manager',
"form.people.projects" => 'projects',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projects',
"form.project.edit_str" => 'editing project',
"form.project.add_str" => 'adding new project',
"form.project.del_str" => 'deleting project',
"form.project.th.name" => 'name',
"form.project.th.edit" => 'edit',
"form.project.th.del" => 'delete',
"form.project.name" => 'name',

// activities form attributes
"form.activity.act_title" => 'activities',
"form.activity.add_title" => 'adding new activity',
"form.activity.edit_str" => 'editing activity',
"form.activity.del_str" => 'deleting activity',
"form.activity.name" => 'name',
"form.activity.project" => 'project',
"form.activity.th.name" => 'name',
"form.activity.th.project" => 'project',
"form.activity.th.edit" => 'edit',
"form.activity.th.del" => 'delete',

// report attributes
"form.report.title" => 'reports',
"form.report.from" => 'start date',
"form.report.to" => 'end date',
"form.report.groupby_user" => 'user',
"form.report.groupby_project" => 'project',
"form.report.groupby_activity" => 'activity',
"form.report.duration" => 'duration',
"form.report.start" => 'start',
"form.report.activity" => 'activity',
"form.report.show_idle" => 'show idle',
"form.report.finish" => 'finish',
"form.report.note" => 'note',
"form.report.project" => 'project',
"form.report.totals_only" => 'totals only',
"form.report.total" => 'hours total',
"form.report.th.empllist" => 'user',
"form.report.th.date" => 'date',
"form.report.th.project" => 'project',
"form.report.th.activity" => 'activity',
"form.report.th.start" => 'start',
"form.report.th.finish" => 'finish',
"form.report.th.duration" => 'duration',
"form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'from',
"form.mail.to" => 'to',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'subject',
"form.mail.comment" => 'comment',
"form.mail.above" => 'send this report by e-mail',
"form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>message sent</b>',

// invoice attributes
"form.invoice.title" => 'invoice',
"form.invoice.caption" => 'invoice',
"form.invoice.above" => 'additional information for invoice',
"form.invoice.select_cust" => 'select client',
"form.invoice.fillform" => 'fill the fields',
"form.invoice.date" => 'date',
"form.invoice.number" => 'invoice number',
"form.invoice.tax" => 'tax',
"form.invoice.discount" => 'discount',
"form.invoice.daily_subtotals" => 'daily subtotals',
"form.invoice.yourcoo" => 'your name<br> and address',
"form.invoice.custcoo" => 'client name<br> and address',
"form.invoice.comment" => 'comment ',
"form.invoice.th.username" => 'person',
"form.invoice.th.time" => 'hours',
"form.invoice.th.rate" => 'rate',
"form.invoice.th.summ" => 'amount',
"form.invoice.subtotal" => 'subtotal',
"form.invoice.total" => 'total',
"form.invoice.customer" => 'client',
"form.invoice.period" => 'billing period',
"form.invoice.mailinv_above" => 'send this invoice by e-mail',
"form.invoice.sending_str" => '<b>invoice sent</b>',

"form.migration.zip" => 'compression',
"form.migration.file" => 'select file',
"form.migration.import.title" => 'import data',
"form.migration.import.success" => 'import completed successfully',
"form.migration.import.text" => 'import team data from an xml file',
"form.migration.export.title" => 'export data',
"form.migration.export.success" => 'export completed successfully',
"form.migration.export.text" => 'you can export all team data into an xml file. this could be useful if you are migrating data to your own server.',
"form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'clients',
"form.client.add_title" => 'add client',
"form.client.edit_title" => 'edit client',
"form.client.del_title" => 'delete client',
"form.client.th.name" => 'name',
"form.client.th.edit" => 'edit',
"form.client.th.del" => 'delete',
"form.client.name" => 'name',
"form.client.tax" => 'tax',
"form.client.discount" => 'discount',
"form.client.daily_subtotals" => 'daily subtotals',
"form.client.yourcoo" => 'your name<br> and address in invoice',
"form.client.custcoo" => 'address',
"form.client.comment" => 'comment ',

// miscellaneous strings
"forward.forgot_password" => 'forgot password?',
"forward.edit" => 'edit',
"forward.delete" => 'delete',
"forward.sendbyemail" => 'send by e-mail',
"forward.tocsvfile" => 'export data to .csv file',
"forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'generate invoice',
"forward.change" => 'configure clients',
"forward.lockpage" => 'interval to lock time entries from modifications',

// strings inside contols on forms
"controls.select.project" => '--- select project ---',
"controls.select.activity" => '--- select activity ---',
"controls.select.client" => '--- select client ---',
"controls.project_bind" => '--- all ---',
"controls.all" => '--- all ---',
"controls.notbind" => '--- no ---',
"controls.per_tm" => 'this month',
"controls.per_lm" => 'last month',
"controls.per_tw" => 'this week',
"controls.per_lw" => 'last week',
"controls.per_td" => 'this day',
"controls.per_at" => 'all time',
"controls.per_ty" => 'this year',
"controls.sel_period" => '--- select time period ---',
"controls.sel_groupby" => '--- no grouping ---',
"controls.inc_billable" => 'billable',
"controls.inc_nbillable" => 'not billable',
"controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'activities for user',
"label.chart.title2" => 'projects for user',
"label.chart.period" => 'chart for period',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
"label.pminfo" => ' (manager)',
"label.pcminfo" => ' (co-manager)',
"label.painfo" => ' (administrator)',
"label.time_noentry" => 'no entry',
"label.today" => 'today',
"label.req_fields" => '* required fields',
"label.sel_project" => 'select project',
"label.sel_activity" => 'select activity',
"label.sel_tp" => 'select time period',
"label.set_tp" => 'or set dates',
"label.fields" => 'show fields',
"label.group_title" => 'group by',
"label.include_title" => 'include records',
"label.inv_str" => 'invoice',
"label.set_empl" => 'select users',
"label.sel_all" => 'select all',
"label.sel_none" => 'deselect all',
"label.or" => 'or',
"label.disable" => 'disable',
"label.enable" => 'enable',
"label.filter" => 'filter',
"label.timeweek" => 'weekly total',
"label.hrs" => 'hrs',
"label.errors" => 'errors',
"label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
"label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>