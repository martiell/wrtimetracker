<?php
// +----------------------------------------------------------------------+
// | WR Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
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
// | Translation: Juliana Arboleda
// | Translation: Cirano <davidherney@gmail.com>
// +----------------------------------------------------------------------+

$i18n_language_name = "Catalan";
$i18n_charset = 'utf-8';
$i18n_timestring = "%W %D de %M del %Y";
$i18n_format_date = "d/m/Y";
$i18n_format_time = "H:i:s";
$i18n_float_delimiter = ",";

$i18n_month = array ('Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre');
$i18n_week = array ('Diumenge', 'Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte');
$i18n_week_sn = array ("Dg","Dl","Dm","Dc","Dj","Dv","Ds");
$i18n_start_week = 0; // 0 - Su, 1 - Mo

//format d/m
$i18n_holidays = array("01/01","01/16", "02/20", "03/29", "07/04", "09/04", "10/09", "11/11", "11/23", "12/25");

$i18n_key_words = array(

// menu entries
"menu.login" => 'Iniciar sessió',
"menu.logout" => 'Finalitzar sessió',
"menu.feedback" => 'Retroalimentació',
"menu.help" => 'Ajuda',
"menu.register" => 'Crear un nou compte de manejador',
"menu.edprof" => 'Editar perfil',
"menu.mytime" => 'El meu temps',
"menu.report" => 'Informes',
"menu.reportAdvanced" => 'Informe_CCPE',
"menu.project" => 'Projectes',
"menu.activity" => 'Activitats',
"menu.people" => 'Persones',
"menu.profile" => 'Equips',
"menu.migration" => 'Exportar Dades',
"menu.clients" => 'Clients',
"menu.services" => 'Modificar Parula de pas',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'Error de la Base de Dades',
"errors.wrong" => 'Dada \'{0}\' incorrecta',
"errors.empty" => 'L\'Arxiu \'{0}\' està buit',
"errors.compare" => 'L\'Arxiu \'{0}\' no és igual al arxiu \'{1}\'',
"errors.wr_interval" => 'Interval incorrecte',
"errors.wr_project" => 'Sel·leccionar Projecte',
"errors.wr_activity" => 'Sel·leccionar Actividat',
"errors.wr_auth" => 'Usuari o parula de pas incorrecta',
"errors.del_nothing" => 'No hi ha dades per borrar',
"errors.reg_error" => "No és possible crear un nou usuari",
"errors.prof_error" => "No és possible canviar el perfil",
"errors.no_user" => "L\'usuari no existeix",
"errors.mt_del_no" => 'No és possible eliminar l\'historial',
"errors.mt_del_no_conf" => 'L\'historial de temps no s\'ha borrat',
"errors.mt_insert" => 'Error en la inserció del temps',
"errors.user_exist" => 'L\'usuari amb aquest correu electrònic ja existeix',
"errors.user_notexists" => 'L\'usuari no existeix',
"errors.user_update" => "No és possible modificar l\'usuari",
"errors.user_delete" => "No és possible eliminar l\'usuari",
"errors.project_exist" => 'Ja existeix un projecte amb aquest nom',
"errors.project_notexists" => 'El projecte no existeix',
"errors.project_update" => "No és possible canviar el nom del projecte",
"errors.project_add" => 'No és possible agregar un nou projecte',
"errors.project_nodel" => 'No és possible eliminar el projecte',
"errors.activity_add" => 'No és possible agregar una nova activitat',
"errors.activity_exist" => 'Ja existeix una activitat amb aquest nom',
"errors.activity_update" => 'No és possible canviar el nom de l\'activitat',
"errors.activity_nodel" => 'No és possible eliminar l\'activitat',
"errors.activity_notexists" => 'L\'activitat no existeix',
"errors.report_period" => 'Període incorrecte',
"errors.search_by_login" => 'No existeix cap usuari amb aquest e-mail',
"errors.multiteam_mode" => 'No és possible crear més comptes',
"errors.upload" => 'Error pujant l\'arxiu',
"errors.client_nodel" => 'No és possible eliminar el client',
"errors.client_notexists" => 'El client no existeix',
"errors.ie_sameusers" => 'Un o més e-mails, ja existeixen a la base de dades',
"errors.period_lock" => 'No es pot addicionar el registre. El període s\'ha bloquejat',

// labels for various buttons
"button.login" => 'Iniciar sessió',
"button.now" => 'Ara',
"button.behalf_set" => 'Establir',
"button.save" => 'Guardar',
"button.delete" => 'Eliminar',
"button.cancel" => 'Cancel·lar',
"button.submit" => 'Enviar',
"button.ppl_add" => 'Agregar nou usuari ',
"button.proj_add" => 'Agregar nou projecte',
"button.act_add" => 'Agregar nova activitat',
"button.add" => 'Agregar',
"button.generate" => 'Generar',
"button.sendpwd" => 'Anar',
"button.send" => 'Enviar',
"button.sendbyemail" => 'Enviar per correu',
"button.asnew" => 'Guardar com a nou',
"button.profile_add" => 'Crear nou grup',
"button.export" => 'Exportar grup',
"button.import" => 'Importar Grup',
"button.apply" => 'Aplicar',
"button.clnt_add" => 'Agregar nou client',

"form.filter.project" => 'Projecte',
"form.filter.filter" => 'Report favorit',
"form.filter.filter_new" => 'Guardar com a favorit',

// login form attributes
"form.login.title" => 'Sessió iniciada',
"form.login.login" => 'e-mail',
"form.login.password" => 'Paraula de pas',

"form.language.title" => 'seleccioni llengua',
"form.language.sel_lang" => 'llengua actual',
"form.language.addlang" => 'Tip: vosté pot <a href="http://wrconsulting.com/cms/localization/wr_time_tracker/" target="_blank">traduir o millorar una traducció</a> de WR Time Tracker<br> per la seva llengua utilitzant <a href="http://wrconsulting.com/cms/localization/" target="_blank">WR Localization Service</a>.',

// password reminder form attributes
"form.fpass.title" => 'Restablir paraula de pas',
"form.fpass.login" => 'e-mail',
"form.fpass.send_pass_str" => 's\'ha enviat la petició de restablir paraula de pas',
"form.fpass.send_pass_subj" => 'Sol·licitud de restabliment de la paraula de pas de WR Time Tracker',
"form.fpass.send_pass_body" => "Estimat usuari, algú, possiblemente vosté, a sol·licitat restablir la seva paraula de pas de WR Time Tracker. Si us plau visiti aquest enllaç si vol restablir la seva paraula de pas.\n\n%s\n\n. El desenvolupament de WR Time Tracker és patrocinat per ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "Per restablir la paraula de pas, si us plau escrigui-la i faci clic en guardar",

// administrator form
"form.admin.title" => 'Administrador',
"form.admin.duty_text" => 'Crear un nou grup, creant un nou compte del manejador de l\'equip.<br>També pot importar dades de grups, d\'un arxiu xml d\'un altre servidor wr time tracker.(No està permès col·lisions de e-mail).',
"form.admin.password" => 'Paraula de pas',
"form.admin.password_confirm" => 'Confirmar paraula de pas',
"form.admin.change_pass" => 'Canviar la paraula de pas de l\'administrador de compte',
"form.admin.profile.title" => 'Grups',
"form.admin.profile.noprofiles" => 'La seva base de dades està buida. Iniciï sessió com a administrador i creï un nou grup.',
"form.admin.profile.comment" => 'Eliminar grup',
"form.admin.profile.th.id" => 'Identificació',
"form.admin.profile.th.name" => 'Nom',
"form.admin.profile.th.edit" => 'Modificar',
"form.admin.profile.th.del" => 'Eliminar',
"form.admin.profile.th.active" => 'Actiu',
"form.admin.lock.period" => 'interval de tancament en dies',

// my time form attributes
"form.mytime.title" => 'El meu temps',
"form.mytime.edit_title" => 'Modificant l\'historial de temps',
"form.mytime.del_str" => 'Eliminant l\'historial de temps',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'Data',
"form.mytime.project" => 'Projecte',
"form.mytime.activity" => 'Activitat',
"form.mytime.start" => 'Inici',
"form.mytime.finish" => 'Fi',
"form.mytime.duration" => 'Durada',
"form.mytime.note" => 'Nota',
"form.mytime.behalf" => 'Treball del dia per a',
"form.mytime.daily" => 'Treball diari',
"form.mytime.total" => 'Hores totals: ',
"form.mytime.th.project" => 'Projecte',
"form.mytime.th.activity" => 'Activitat',
"form.mytime.th.start" => 'Inici',
"form.mytime.th.finish" => 'Fi',
"form.mytime.th.duration" => 'Durada',
"form.mytime.th.note" => 'Nota',
"form.mytime.th.edit" => 'Modificar',
"form.mytime.th.delete" => 'Eliminar',
"form.mytime.del_yes" => 'L\'historial de temps s\'ha eliminat amb èxit',
"form.mytime.no_finished_rec" => 'Aquest historial s\'ha guardat únicament amb l\'hora d\'inici. Aixó no és un error. Finalitzi sessió si ho necessita.',
"form.mytime.billable" => 'facturable',

// profile form attributes
"form.profile.createm_str" => 'Crear un nou compte de manejador',
"form.profile.prof_str" => 'Modificant perfil',
"form.profile.name" => 'Nom',
"form.profile.email" => 'e-mail',
"form.profile.pas1" => 'Paraula de pas',
"form.profile.pas2" => 'Confirmar Paraula de pas',
"form.profile.comp" => 'Companyia',
"form.profile.www" => 'Lloc web de la companyia',
"form.profile.curr" => 'Moneda',

// people form attributes
"form.people.ppl_str" => 'Persones',
"form.people.createu_str" => 'Creant nou usuari',
"form.people.edit_str" => 'Modificant usuari',
"form.people.del_str" => 'Eliminant usuari',
"form.people.th.name" => 'Nom',
"form.people.th.email" => 'e-mail',
"form.people.th.role" => 'Rol',
"form.people.th.edit" => 'Modificar',
"form.people.th.del" => 'Eliminar',
"form.people.th.status" => 'Estat',
"form.people.th.project" => 'Projecte',
"form.people.th.rate" => 'Taxa',
"form.people.manager" => 'Manejador',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.empl" => 'Usuari',
"form.people.name" => 'Nom',
"form.people.email" => 'e-mail',
"form.people.pas1" => 'Paraula de pas',
"form.people.pas2" => 'Confirmar paraula de pas',
"form.people.rate" => 'Taxa per defecte en hores',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.projects" => 'Projectes',

// projects form attributes
"form.project.proj_title" => 'Projectes',
"form.project.edit_str" => 'Modificant projecte',
"form.project.add_str" => 'Agregant nou projecte',
"form.project.del_str" => 'Eliminant projecte',
"form.project.th.name" => 'Nom',
"form.project.th.edit" => 'Modificar',
"form.project.th.del" => 'Eliminar',
"form.project.name" => 'Nom',

// activities form attributes
"form.activity.act_title" => 'Activitats',
"form.activity.add_title" => 'Agregant nova activitat',
"form.activity.edit_str" => 'Modificant activitat',
"form.activity.del_str" => 'Eliminant activitat',
"form.activity.name" => 'Nom',
"form.activity.project" => 'Projecte',
"form.activity.th.name" => 'Nom',
"form.activity.th.project" => 'Projecte',
"form.activity.th.edit" => 'Editar',
"form.activity.th.del" => 'Eliminar',

// report attributes
"form.report.title" => 'Reports',
"form.report.from" => 'Data d\'inici',
"form.report.to" => 'Data de fi',
"form.report.groupby_user" => 'Usuari',
"form.report.groupby_project" => 'Projecte',
"form.report.groupby_activity" => 'Activitat',
"form.report.duration" => 'Durada',
"form.report.start" => 'Inici',
"form.report.activity" => 'Activitat',
"form.report.show_idle" => 'Mostrar ausent',
"form.report.finish" => 'Fi',
"form.report.note" => 'Nota',
"form.report.project" => 'Projecte',
"form.report.totals_only" => 'Només totals',
"form.report.total" => 'Hores Totals',
"form.report.th.empllist" => 'Usuari',
"form.report.th.date" => 'Data',
"form.report.th.project" => 'Projecte',
"form.report.th.activity" => 'Activitat',
"form.report.th.start" => 'Inici',
"form.report.th.finish" => 'Fi',
"form.report.th.duration" => 'Durada',
"form.report.th.note" => 'Nota',

// mail form attributes
"form.mail.from" => 'De',
"form.mail.to" => 'Per a',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'Assumpte',
"form.mail.comment" => 'Comentari',
"form.mail.above" => 'Enviar aquest report por e-mail',
"form.mail.footer_str" => 'El desenvolupament de WR Time Tracker és suministrat per <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>Missatge enviat</b>',

// invoice attributes
"form.invoice.title" => 'Factura',
"form.invoice.caption" => 'Factura',
"form.invoice.above" => 'Informació addicional per factura',
"form.invoice.select_cust" => 'Seleccioni el client',
"form.invoice.fillform" => 'Empleni els camps',
"form.invoice.date" => 'Data',
"form.invoice.number" => 'Número de factura',
"form.invoice.tax" => 'Impost',
"form.invoice.discount" => 'Descompte',
"form.invoice.daily_subtotals" => 'Subtotals diaris',
"form.invoice.yourcoo" => 'El seu nom <br> i direcció',
"form.invoice.custcoo" => 'Nom del client <br> i direcció',
"form.invoice.comment" => 'Comentari ',
"form.invoice.th.username" => 'Persona',
"form.invoice.th.time" => 'Hores',
"form.invoice.th.rate" => 'Taxa',
"form.invoice.th.summ" => 'Quantitat',
"form.invoice.subtotal" => 'Subtotal',
"form.invoice.total" => 'Total',
"form.invoice.customer" => 'Client',
"form.invoice.period" => 'Període de facturació',
"form.invoice.mailinv_above" => 'Enviar aquesta factura per e-mail',
"form.invoice.sending_str" => '<b>Factura enviada</b>',

"form.migration.zip" => 'Comprimir',
"form.migration.file" => 'Sel·leccioni l\'arxiu',
"form.migration.import.title" => 'Importar dades',
"form.migration.import.success" => 'Importació finalitzada amb èxit',
"form.migration.import.text" => 'Importar dades del grup des d\'un arxiu xml',
"form.migration.export.title" => 'Exportar dades',
"form.migration.export.success" => 'Exportació finalitzada amb èxit',
"form.migration.export.text" => 'Vosté pot exportar totes les dades del grup dins d\'un archivo xml. Això pot ser útil si necessita migrar dades al seu propi servidor.',

"form.client.title" => 'Clients',
"form.client.add_title" => 'Agregar client',
"form.client.edit_title" => 'Modificar client',
"form.client.del_title" => 'Eliminar client',
"form.client.th.name" => 'Nom',
"form.client.th.edit" => 'Modificar',
"form.client.th.del" => 'Eliminar',
"form.client.name" => 'Nom',
"form.client.tax" => 'Impost',
"form.client.discount" => 'Descompte',
"form.client.daily_subtotals" => 'Subtotals diaris',
"form.client.yourcoo" => 'El seu nou <br> i direcció a la factura',
"form.client.custcoo" => 'Direcció',
"form.client.comment" => 'Comentari ',

// miscellaneous strings
"forward.forgot_password" => '¿Ha oblidat la seva paraula de pas?',
"forward.edit" => 'Modificar',
"forward.delete" => 'Eliminar',
"forward.sendbyemail" => 'Enviar per e-mail',
"forward.tocsvfile" => 'Exportar dades a un arxiu .csv',
"forward.geninvoice" => 'Generar factura',
"forward.change" => 'Configurar clients',
"forward.lockpage" => 'interval per tancar les modificacions en els reports de temps',

// strings inside contols on forms
"controls.select.project" => '--- Sel·leccionar projecte ---',
"controls.select.activity" => '--- Sel·leccionar activitat---',
"controls.select.client" => '--- Sel·leccionar client ---',
"controls.project_bind" => '--- Tots ---',
"controls.all" => '--- Tots ---',
"controls.notbind" => '--- No ---',
"controls.per_tm" => 'Aquest mes',
"controls.per_lm" => 'El mes passat',
"controls.per_tw" => 'Aquestat setmana',
"controls.per_lw" => 'La setmana passada',
"controls.per_td" => 'Aquest dia',
"controls.per_lw" => 'La setmana passada',
"controls.sel_period" => '--- Seleccionar període de temps ---',
"controls.sel_groupby" => '--- No agrupar ---',
"controls.inc_billable" => 'facturable',
"controls.inc_nbillable" => 'no facturable',

// labels
"label.chart.title1" => 'activitats per usuari',
"label.chart.period" => 'gràfica por període',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>A nom de %s</b>',
"label.pminfo" => ' (Manejador)',
"label.pcminfo" => ' (Auxiliar del manejador)',
"label.painfo" => ' (Administrador)',
"label.time_noentry" => 'Sense entrada',
"label.today" => 'Data Actual',
"label.req_fields" => '* camps requerits',
"label.sel_project" => 'Seleccionar projecte',
"label.sel_activity" => 'Seleccionar activitat',
"label.sel_tp" => 'Seleccionar període de temps',
"label.set_tp" => 'o establir dates',
"label.fields" => 'Mostrar camps',
"label.group_title" => 'Agrupar per',
"label.include_title" => 'include records',
"label.inv_str" => 'Factura',
"label.set_empl" => 'Seleccionar usuaris',
"label.sel_all" => 'Seleccionar tots',
"label.sel_none" => 'Treure totes las seleccions',
"label.or" => 'o',
"label.disable" => 'Deshabilitar',
"label.enable" => 'Habilitar',
"label.filter" => 'Filtrar',
"label.timeweek" => 'total setmanal'
);
?>