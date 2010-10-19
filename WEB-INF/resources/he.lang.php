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
// | Contributors: Yonatan Schor
// +----------------------------------------------------------------------+

$i18n_language_name = "Hebrew";
$i18n_float_delimiter = ".";

$i18n_month = array ('ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת');
// Note to translators: the string below must be translated
// $i18n_week_sn = array ("su","mo","tu","we","th","fr","sa");

//format d/m
$i18n_holidays = array("10/02", "09/04", "15/04", "29/04", "29/05", "19/09", "20/09", "28/09", "03/10", "10/10");

$i18n_key_words = array(

// menu entries
"menu.login" => 'היכנס',
"menu.logout" => 'צא',
"menu.feedback" => 'פידבק',
"menu.help" => 'עזרה',
"menu.register" => 'צור חשבון מנהל חדש',
"menu.edprof" => 'ערוך פרופיל',
"menu.mytime" => 'הזמן שלי',
"menu.report" => 'דוחות',
"menu.project" => 'פרוייקטים',
"menu.activity" => 'פעילויות',
"menu.people" => 'אנשים',
"menu.profile" => 'צוותים',
"menu.migration" => 'יצוא נתונים',
"menu.clients" => 'לקוחות',
"menu.services" => 'שנהי ססמה',
"menu.admin" => 'ניהול',

// Note to translators: the strings below must be translated
// // error strings
// "errors.db_error" => 'database error',
// "errors.wrong" => 'incorrect \'{0}\' data',
// "errors.empty" => 'field \'{0}\' is empty',
//"errors.compare" => 'field \'{0}\' is not equal to field \'{1}\'',
// "errors.wr_interval" => 'incorrect interval',
// "errors.wr_project" => 'select project',
// "errors.wr_activity" => 'select activity',
// "errors.wr_auth" => 'incorrect login or password',
// "errors.del_nothing" => 'no data for deleting',
// "errors.reg_error" => "unable to create new user",
// "errors.prof_error" => "unable to change profile",
// "errors.no_user" => "there is no such user",
// "errors.mt_del_no" => 'unable to delete time record',
// "errors.mt_del_no_conf" => 'time record has not been deleted',
// "errors.mt_insert" => 'time insertion error',
// "errors.user_exist" => 'user with this e-mail already exists',
// "errors.user_notexists" => 'user does not exist',
// "errors.user_update" => "unable to change user data",
// "errors.user_delete" => "unable to delete user data",
// "errors.project_exist" => 'project with this name already exists',
// "errors.project_notexists" => 'project does not exist',
// "errors.project_update" => "unable to change project name",
// "errors.project_add" => 'unable to add new project',
// "errors.project_nodel" => 'unable to delete project',
// "errors.activity_add" => 'unable to add new activity',
// "errors.activity_exist" => 'activity with this name already exists',
// "errors.activity_update" => "unable to change activity name",
// "errors.activity_nodel" => 'unable to delete activity',
// "errors.activity_notexists" => 'activity does not exist',
// "errors.report_period" => 'incorrect period',
// "errors.search_by_login" => 'no user with this e-mail',
// "errors.multiteam_mode" => 'you can\'t create more accounts',
// "errors.upload" => 'file upload error',
// "errors.client_nodel" => 'unable to delete client',
// "errors.client_notexists" => 'client does not exist',
// "errors.ie_sameusers" => 'one or more e-mails already exist in the database',
// "errors.period_lock" => 'can\'t add record. period has been locked',
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'היכנס',
"button.now" => 'עכשיו',
// Note to translators: the string below must be translated
// "button.behalf_set" => 'set',
"button.save" => 'שמור',
"button.delete" => 'מחק',
"button.cancel" => 'ביטול',
"button.submit" => 'submit',
"button.ppl_add" => 'הוסף משתמש חדש',
"button.proj_add" => 'הוסף פרוייקט חדש',
"button.act_add" => 'הוסף פעילות חדשה',
"button.add" => 'הוסף',
"button.generate" => 'צור',
// Note to translators: "button.sendpwd" => 'go', // the string must be translated
"button.send" => 'שלח',
"button.sendbyemail" => 'שלח בדואר אלקטרוני',
"button.asnew" => 'שמור בשם חדש',
"button.profile_add" => 'צור צוות חדש',
"button.export" => 'יצא צוות',
"button.import" => 'ייבא צוות',
"button.apply" => 'החל',
"button.clnt_add" => 'הוסף לקוח חדש',

"form.filter.project" => 'פרוייקט',
"form.filter.filter" => 'דוח מועדף',
"form.filter.filter_new" => 'שמור כמועדף',
// Note to translators: the string below is missing and must be translated and added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'כניסה',
"form.login.login" => 'דואר אלקטרוני',
"form.login.password" => 'סיסמה',

// Note to transaltors: the strings below must be translated and added to the localization file
// // password reminder form attributes
// "form.fpass.title" => 'reset password',
// "form.fpass.login" => 'login',
// "form.fpass.send_pass_str" => 'password reset request sent',
// "form.fpass.send_pass_subj" => 'Anuko Time Tracker password reset request',
// "form.fpass.send_pass_body" => "Dear User,\n\nSomeone, possibly you, requested your Anuko Time Tracker password reset. Please visit this link if you want to reset your password.\n\n%s\n\nDevelopment of Anuko Time Tracker is sponsored by ZoneTick (http://zonetick.com).\n\n",
// "form.fpass.reset_comment" => "to reset your password please type it in and click on save",

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
"form.mytime.title" => 'הזמן שלי',
"form.mytime.edit_title" => 'עריכת רשומה',
"form.mytime.del_str" => 'מחיקת רשומה',
// Note to translators: the string below must be translated
// "form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'תאריך',
"form.mytime.project" => 'פרוייקט',
"form.mytime.activity" => 'פעילות',
"form.mytime.start" => 'התחלה',
"form.mytime.finish" => 'סוף',
"form.mytime.duration" => 'משך',
"form.mytime.note" => 'הערה',
"form.mytime.behalf" => 'עבודה יומית עבור',
"form.mytime.daily" => 'עבודה יומית',
"form.mytime.total" => 'סך הכל שעות: ',
"form.mytime.th.project" => 'פרוייקט',
"form.mytime.th.activity" => 'פעילות',
"form.mytime.th.start" => 'התחלה',
"form.mytime.th.finish" => 'סיום',
"form.mytime.th.duration" => 'משך',
"form.mytime.th.note" => 'הערות',
"form.mytime.th.edit" => 'ערוך',
"form.mytime.th.delete" => 'מחק',
"form.mytime.del_yes" => 'רשומה נמחקה בהצלחה',
"form.mytime.no_finished_rec" => 'רשומה זו נשמרה עם שעת התחלה בלבד. זו לא תקלה. צא אם אתה צריך.',
"form.mytime.billable" => 'לחיוב',
"form.mytime.warn_tozero_rec" => 'רשומה זו חייבת להימחק כי הזמן הזה נעול',
// Note to translators: the string below is missing and must be translated and added
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'צור חשבון מנהל חדש',
"form.profile.prof_str" => 'עריכת פרופיל',
"form.profile.name" => 'שם',
// Note to translators: "form.profile.login" => 'אי-מייל', // email has been changed to login
"form.profile.pas1" => 'סיסמה',
"form.profile.pas2" => 'ווידוי סיסמה',
"form.profile.comp" => 'חברה',
"form.profile.www" => 'אתר האינטרנט של החברה',
"form.profile.curr" => 'מטבע',
// Note to translators: the strings below are missing and must be translated and added
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
"form.people.ppl_str" => 'אנשים',
"form.people.createu_str" => 'יצירת משתמש חדש',
"form.people.edit_str" => 'עריכת משתמש',
"form.people.del_str" => 'מחיקת משתמש',
"form.people.th.name" => 'שם',
// Note to translators: "form.people.th.login" => 'אי-מייל', // email has been changed to login
"form.people.th.role" => 'תפקיד',
"form.people.th.edit" => 'ערוך',
"form.people.th.del" => 'מחק',
"form.people.th.status" => 'סטטוס',
"form.people.th.project" => 'פרוייקט',
"form.people.th.rate" => 'תעריף',
"form.people.manager" => 'מנהל',
"form.people.comanager" => 'מנהל צוות',
"form.people.empl" => 'משתמש',
"form.people.name" => 'שם',
// Note to translators: "form.people.login" => 'אי-מייל', // email has been changed to login
"form.people.pas1" => 'סיסמה',
"form.people.pas2" => 'ווידוי סיסמה',
"form.people.rate" => 'תעריף ברירת מחדל לשעה',
"form.people.comanager" => 'מנהל צוות',
"form.people.projects" => 'פרוייקטים',
// Note to translators: the string below is missing and must be translated and added
// "form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'פרוייקטים',
"form.project.edit_str" => 'עריכת פרוייקט',
"form.project.add_str" => 'הוספת פרוייקט חדש',
"form.project.del_str" => 'מחיקת פרוייקט',
"form.project.th.name" => 'שם',
"form.project.th.edit" => 'ערוך',
"form.project.th.del" => 'מחק',
"form.project.name" => 'שם',

// activities form attributes
"form.activity.act_title" => 'פעילויות',
"form.activity.add_title" => 'הוספת פעילות חדשה',
"form.activity.edit_str" => 'עריכת פעילות',
"form.activity.del_str" => 'מחיקת פעילות',
"form.activity.name" => 'שם',
"form.activity.project" => 'פרוייקט',
"form.activity.th.name" => 'שם',
"form.activity.th.project" => 'פרוייקט',
"form.activity.th.edit" => 'ערוך',
"form.activity.th.del" => 'מחק',

// report attributes
"form.report.title" => 'דוחות',
"form.report.from" => 'תאריך התחלה',
"form.report.to" => 'תאריך סיום',
"form.report.groupby_user" => 'משתמש',
"form.report.groupby_project" => 'פרוייקט',
"form.report.groupby_activity" => 'פעילות',
"form.report.duration" => 'משך',
"form.report.start" => 'התחלה',
"form.report.activity" => 'פעילות',
"form.report.show_idle" => 'הראה בטלה',
"form.report.finish" => 'סיום',
"form.report.note" => 'הערות',
"form.report.project" => 'פרוייקט',
"form.report.totals_only" => 'סיכומים בלבד',
"form.report.total" => 'סכום שעות',
"form.report.th.empllist" => 'משתמש',
"form.report.th.date" => 'תאריך',
"form.report.th.project" => 'פרוייקט',
"form.report.th.activity" => 'פעילות',
"form.report.th.start" => 'התחלה',
"form.report.th.finish" => 'סיום',
"form.report.th.duration" => 'משך',
"form.report.th.note" => 'הערות',

// Note to translators: the strings below must be translated
// // mail form attributes
// "form.mail.from" => 'from',
// "form.mail.to" => 'to',
// "form.mail.cc" => 'cc',
// "form.mail.subject" => 'subject',
// "form.mail.comment" => 'comment',
// "form.mail.above" => 'send this report by e-mail',
// "form.mail.footer_str" => 'Anuko Time Tracker development is sponsored by <a href="http://zonetick.com">ZoneTick</a>',
// "form.mail.sending_str" => '<b>message sent</b>',

// // invoice attributes
// "form.invoice.title" => 'invoice',
// "form.invoice.caption" => 'invoice',
// "form.invoice.above" => 'additional information for invoice',
// "form.invoice.select_cust" => 'select client',
// "form.invoice.fillform" => 'fill the fields',
// "form.invoice.date" => 'date',
// "form.invoice.number" => 'invoice number',
// "form.invoice.tax" => 'tax',
// "form.invoice.discount" => 'discount',
// "form.invoice.daily_subtotals" => 'daily subtotals',
// "form.invoice.yourcoo" => 'your name<br> and address',
// "form.invoice.custcoo" => 'client name<br> and address',
// "form.invoice.comment" => 'comment ',
// "form.invoice.th.username" => 'person',
// "form.invoice.th.time" => 'hours',
// "form.invoice.th.rate" => 'rate',
// "form.invoice.th.summ" => 'amount',
// "form.invoice.subtotal" => 'subtotal',
// "form.invoice.total" => 'total',
// "form.invoice.customer" => 'client',
// "form.invoice.period" => 'billing period',
// "form.invoice.mailinv_above" => 'send this invoice by e-mail',
// "form.invoice.sending_str" => '<b>invoice sent</b>',

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
"forward.forgot_password" => 'שכחת סיסמה?',
"forward.edit" => 'ערוך',
"forward.delete" => 'מחק',
"forward.sendbyemail" => 'שלח באי-מייל',
"forward.tocsvfile" => 'ייצא נתונים לקובץ CSV',
"forward.toxmlfile" => 'יצא נתונים לקובץ XML',
"forward.geninvoice" => 'הנפק חשבונית',
"forward.change" => 'קנפג לקוחות',
"forward.lockpage" => 'זמן לנעילת רשומות זמן אחרי שינוי',

// strings inside contols on forms
"controls.select.project" => '--- בחר פרוייקט ---',
"controls.select.activity" => '--- בחר פעילות ---',
"controls.select.client" => '--- בחר לקוח ---',
"controls.project_bind" => '--- הכל ---',
"controls.all" => '--- הכל ---',
"controls.notbind" => '--- לא ---',
"controls.per_tm" => 'חודש זה',
"controls.per_lm" => 'חודש שעבר',
"controls.per_tw" => 'שבוע זה',
"controls.per_lw" => 'שבוע שעבר',
"controls.per_td" => 'היום',
"controls.per_at" => 'כל הזמן',
// Note to translators: the string below is missing and must be translated and added
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- בחר תקופת זמן ---',
"controls.sel_groupby" => '--- ללא קיבוץ ---',
"controls.inc_billable" => 'לחיוב',
"controls.inc_nbillable" => 'לא לחיוב',
// Note to translators: the string below is missing and must be translated and added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'פעילויות למשתמש',
// Note to translators: the string below is missing and must be translated and added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'תרשים לתקופה',

// Note to translators: the strings below must be translated and added
// "label.pinfo" => '%s, %s',
// "label.pinfo2" => '%s',
// "label.pbehalf_info" => '%s %s <b>on behalf of %s</b>',
// "label.pminfo" => ' (manager)',
// "label.pcminfo" => ' (co-manager)',
// "label.painfo" => ' (administrator)',
// "label.time_noentry" => 'no entry',
// "label.today" => 'today',
// "label.req_fields" => '* required fields',
// "label.sel_project" => 'select project',
// "label.sel_activity" => 'select activity',
// "label.sel_tp" => 'select time period',
// "label.set_tp" => 'or set dates',
// "label.fields" => 'show fields',
// "label.group_title" => 'group by',
// "label.include_title" => 'include records',
// "label.inv_str" => 'invoice',
// "label.set_empl" => 'select users',
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