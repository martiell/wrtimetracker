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

$i18n_language_name = "Spanish";
$i18n_float_delimiter = ",";

$i18n_month = array ('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');
$i18n_week_sn = array ("Do","Lu","Ma","Mi","Ju","Vi","Sa");

//format d/m
$i18n_holidays = array("01/01","06/01", "09/04", "10/04", "12/04", "01/05", "15/08", "12/10", "01/11", "06/12", "08/12", "25/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'Iniciar sesión',
"menu.logout" => 'Finalizar sesión',
"menu.feedback" => 'Retroalimentación',
"menu.help" => 'Ayuda',
"menu.register" => 'Crear una nueva cuenta de manejador',
"menu.edprof" => 'Editar perfil',
"menu.mytime" => 'Mi tiempo',
"menu.report" => 'Informes',
"menu.project" => 'Proyectos',
"menu.activity" => 'Actividades',
"menu.people" => 'Personas',
"menu.profile" => 'Equipos',
"menu.migration" => 'Exportar Datos',
"menu.clients" => 'Clientes',
"menu.services" => 'Modificar Contraseña',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'Error de la Base de Datos ',
"errors.wrong" => 'Dato \'{0}\' incorrecto',
"errors.empty" => 'El archivo \'{0}\' esta vacío',
"errors.compare" => 'El archivo \'{0}\' no es igual al archivo \'{1}\'',
"errors.wr_interval" => 'Intervalo incorrecto',
"errors.wr_project" => 'Seleccionar Proyecto',
"errors.wr_activity" => 'Seleccionar Actividad',
"errors.wr_auth" => 'Usuario o contraseña incorrecta',
"errors.del_nothing" => 'No hay datos para borrar',
"errors.reg_error" => "No es posible crear un nuevo usuario",
"errors.prof_error" => "No es posible cambiar el perfil",
"errors.no_user" => "El usuario no existe",
"errors.mt_del_no" => 'No es posible eliminar el historial',
"errors.mt_del_no_conf" => 'El historial de tiempo no ha sido borrado',
"errors.mt_insert" => 'Error en la inserción del tiempo',
"errors.user_exist" => 'El usuario con este correo electrónico ya existe',
"errors.user_notexists" => 'El usuario no existe',
"errors.user_update" => "No es posible modificar el usuario",
"errors.user_delete" => "No es posible eliminar el usuario",
"errors.project_exist" => 'Ya existe un proyecto con este nombre',
"errors.project_notexists" => 'El proyecto no existe',
"errors.project_update" => "No es posible cambiar el nombre del proyecto",
"errors.project_add" => 'No es posible agregar un nuevo proyecto',
"errors.project_nodel" => 'No es posible eliminar el proyecto',
"errors.activity_add" => 'No es posible agregar una nueva actividad',
"errors.activity_exist" => 'Ya existe una actividad con este nombre',
"errors.activity_update" => "No es posible cambiar el nombre de la actividad",
"errors.activity_nodel" => 'No es posible eliminar la actividad',
"errors.activity_notexists" => 'La actividad no existe',
"errors.report_period" => 'Periodo incorrecto',
"errors.search_by_login" => 'No existe ningún usuario con este e-mail',
"errors.multiteam_mode" => 'No es posible crear más cuentas',
"errors.upload" => 'Error subiendo el archivo',
"errors.client_nodel" => 'No es posible eliminar el cliente',
"errors.client_notexists" => 'El cliente no existe',
"errors.ie_sameusers" => 'Uno o más e-mails, ya existen en la base de datos',
"errors.period_lock" => 'No se puede adicionar el registro. El período ha sido bloqueado',
// Note to translators: the strings below are missing in the translation and must be added
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'Iniciar sesion',
"button.now" => 'Ahora',
"button.behalf_set" => 'Establecer',
"button.save" => 'Guardar',
"button.delete" => 'Eliminar',
"button.cancel" => 'Cancelar',
"button.submit" => 'Enviar',
"button.ppl_add" => 'Agregar nuevo usuario ',
"button.proj_add" => 'Agregar nuevo proyecto',
"button.act_add" => 'Agregar nueva actividad',
"button.add" => 'Agregar',
"button.generate" => 'Generar',
"button.sendpwd" => 'Ir',
"button.send" => 'Enviar',
"button.sendbyemail" => 'Enviar por correo',
"button.asnew" => 'Guardar como nuevo',
"button.profile_add" => 'Crear nuevo grupo',
"button.export" => 'Exportar grupo',
"button.import" => 'Importar Grupo',
"button.apply" => 'Aplicar',
"button.clnt_add" => 'Agregar nuevo cliente',

"form.filter.project" => 'Proyecto',
"form.filter.filter" => 'Reporte favorito',
"form.filter.filter_new" => 'Guardar como favorito',
// Note to translators: the string below is missing in the translation and must be added
// "form.filter.filter_confirm_delete" => 'are you sure you want to delete this favorite report?',

// login form attributes
"form.login.title" => 'Sesión iniciada',
// Note to translators: "form.login.login" => 'e-mail', // email has been changed to login
"form.login.password" => 'Contraseña',

// password reminder form attributes
"form.fpass.title" => 'Reestablecer contraseña',
// Note to translators: "form.fpass.login" => 'e-mail', // email has been changed to login
"form.fpass.send_pass_str" => 'Se ha enviado la petición de reestablecer contraseña',
"form.fpass.send_pass_subj" => 'Solicitud de reestablecimiento de la contraseña de Anuko Time Tracker',
"form.fpass.send_pass_body" => "Querido usuario, Alguien, posiblemente usted, solicitó reestablecer su contraseña de Anuko Time Tracker. Por favor visite este enlace si quiere reestablecer su contraseña.\n\n%s\n\n. El desarrollo de Anuko Time Tracker es patrocinado por ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "Para reestablecer su contraseña, por favor digítela y de clic en guardar",

// administrator form
"form.admin.title" => 'Administrador',
"form.admin.duty_text" => 'Crear un nuevo grupo, creando una nueva cuenta del manejador del equipo.<br>También puede importar datos de grupos, de un archivo xml de otro servidor Anuko Time Tracker.(No estan permitidad colisiones de e-mail).',
"form.admin.password" => 'Contraseña',
"form.admin.password_confirm" => 'Confirmar contraseña',
"form.admin.change_pass" => 'Cambiar la contraseña del administrador de cuenta',
"form.admin.profile.title" => 'Grupos',
"form.admin.profile.noprofiles" => 'Su base de datos esta vacía. Inicie sesión como administrador y cree un nuevo grupo.',
"form.admin.profile.comment" => 'Eliminar grupo',
"form.admin.profile.th.id" => 'Identificación',
"form.admin.profile.th.name" => 'Nombre',
"form.admin.profile.th.edit" => 'Modificar',
"form.admin.profile.th.del" => 'Eliminar',
"form.admin.profile.th.active" => 'Activo',
"form.admin.lock.period" => 'intervalo de cierre en días',
// Note to translators: the strings below are missing in the translation and must be added
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'Mi tiempo',
"form.mytime.edit_title" => 'Modificando el historial de tiempo',
"form.mytime.del_str" => 'Eliminando el historial de tiempo',
// Note to translators: "form.mytime.time_form" => ' (hh:mm)', // the string must be translated
"form.mytime.date" => 'Fecha',
"form.mytime.project" => 'Proyecto',
"form.mytime.activity" => 'Actividad',
"form.mytime.start" => 'Inicio',
"form.mytime.finish" => 'Fin',
"form.mytime.duration" => 'Duración',
"form.mytime.note" => 'Nota',
"form.mytime.behalf" => 'Trabajo del día para',
"form.mytime.daily" => 'Trabajo diario',
"form.mytime.total" => 'Horas totales: ',
"form.mytime.th.project" => 'Proyecto',
"form.mytime.th.activity" => 'Actividad',
"form.mytime.th.start" => 'Inicio',
"form.mytime.th.finish" => 'Fin',
"form.mytime.th.duration" => 'Duración',
"form.mytime.th.note" => 'Nota',
"form.mytime.th.edit" => 'Modificar',
"form.mytime.th.delete" => 'Eliminar',
"form.mytime.del_yes" => 'El historial de tiempo ha sido eliminado exitosamente',
"form.mytime.no_finished_rec" => 'Este historial fue guardado solamente con la hora de Inicio. Esto no es un error. Finalice sesion si lo necesita.',
"form.mytime.billable" => 'facturable',
// Note to translators: the strings below are missing in the translation and must be added
// "form.mytime.warn_tozero_rec" => 'this time record must be deleted because this time period is locked',
// "form.mytime.uncompleted" => 'uncompleted'

// profile form attributes
"form.profile.createm_str" => 'Crear una nueva cuenta de manejador',
"form.profile.prof_str" => 'Modificando perfil',
"form.profile.name" => 'Nombre',
// Note to translators:"form.profile.login" => 'e-mail', // email has been changed to login
"form.profile.pas1" => 'Contraseña',
"form.profile.pas2" => 'Confirmar Contraseña',
"form.profile.comp" => 'Compañía',
"form.profile.www" => 'Sitio web de la compañía',
"form.profile.curr" => 'Moneda',
// Note to translators: the strings below are missing in the translation and must be added
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
"form.people.ppl_str" => 'Personas',
"form.people.createu_str" => 'Creando nuevo usuario',
"form.people.edit_str" => 'Modificando usuario',
"form.people.del_str" => 'Eliminando usuario',
"form.people.th.name" => 'Nombre',
// Note to translators: "form.people.th.login" => 'e-mail', // email has been changed to login
"form.people.th.role" => 'Rol',
"form.people.th.edit" => 'Modificar',
"form.people.th.del" => 'Eliminar',
"form.people.th.status" => 'Estado',
"form.people.th.project" => 'Proyecto',
"form.people.th.rate" => 'Tasa',
"form.people.manager" => 'Manejador',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.empl" => 'Usuario',
"form.people.name" => 'Nombre',
// Note to translators:"form.people.login" => 'e-mail', // email has been changed to login
"form.people.pas1" => 'Contraseña',
"form.people.pas2" => 'Confirmar contraseña',
"form.people.rate" => 'Tasa por defecto en horas',
"form.people.comanager" => 'Auxiliar del manejador',
"form.people.projects" => 'Proyectos',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'Proyectos',
"form.project.edit_str" => 'Modificando proyecto',
"form.project.add_str" => 'Agregando nuevo proyecto',
"form.project.del_str" => 'Eliminando proyecto',
"form.project.th.name" => 'Nombre',
"form.project.th.edit" => 'Modificar',
"form.project.th.del" => 'Eliminar',
"form.project.name" => 'Nombre',

// activities form attributes
"form.activity.act_title" => 'Actividades',
"form.activity.add_title" => 'Agregando nueva actividad',
"form.activity.edit_str" => 'Modificando actividad',
"form.activity.del_str" => 'Eliminando actividad',
"form.activity.name" => 'Nombre',
"form.activity.project" => 'Proyecto',
"form.activity.th.name" => 'Nombre',
"form.activity.th.project" => 'Proyecto',
"form.activity.th.edit" => 'Editar',
"form.activity.th.del" => 'Eliminar',

// report attributes
"form.report.title" => 'Reportes',
"form.report.from" => 'Fecha de inicio',
"form.report.to" => 'Fecha de fin',
"form.report.groupby_user" => 'Usuario',
"form.report.groupby_project" => 'Proyecto',
"form.report.groupby_activity" => 'Actividad',
"form.report.duration" => 'Duración',
"form.report.start" => 'Inicio',
"form.report.activity" => 'Actividad',
"form.report.show_idle" => 'Mostrar ausente',
"form.report.finish" => 'Fin',
"form.report.note" => 'Nota',
"form.report.project" => 'Proyecto',
"form.report.totals_only" => 'Solo totales',
"form.report.total" => 'Horas Totales',
"form.report.th.empllist" => 'Usuario',
"form.report.th.date" => 'Fecha',
"form.report.th.project" => 'Proyecto',
"form.report.th.activity" => 'Actividad',
"form.report.th.start" => 'Inicio',
"form.report.th.finish" => 'Fin',
"form.report.th.duration" => 'Duración',
"form.report.th.note" => 'Nota',

// mail form attributes
"form.mail.from" => 'De',
"form.mail.to" => 'Para',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'Asunta',
"form.mail.comment" => 'Comentario',
"form.mail.above" => 'Enviar este reporte por e-mail',
"form.mail.footer_str" => 'El desarrollo de Anuko Time Tracker es suministrado por <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>Mensaje enviado</b>',

// invoice attributes
"form.invoice.title" => 'Factura',
"form.invoice.caption" => 'Factura',
"form.invoice.above" => 'Información adicional para factura',
"form.invoice.select_cust" => 'Seleccione el cliente',
"form.invoice.fillform" => 'Llene los campos',
"form.invoice.date" => 'Fecha',
"form.invoice.number" => 'Número de factura',
"form.invoice.tax" => 'Impuesto',
"form.invoice.discount" => 'Descuento',
"form.invoice.daily_subtotals" => 'Subtotales diarios',
"form.invoice.yourcoo" => 'Su nombre <br> y dirección',
"form.invoice.custcoo" => 'Nombre del cliente <br> y dirección',
"form.invoice.comment" => 'Comentario ',
"form.invoice.th.username" => 'Persona',
"form.invoice.th.time" => 'Horas',
"form.invoice.th.rate" => 'Tasa',
"form.invoice.th.summ" => 'Cantidad',
"form.invoice.subtotal" => 'Subtotal',
"form.invoice.total" => 'Total',
"form.invoice.customer" => 'Cliente',
"form.invoice.period" => 'Periodo de facturación',
"form.invoice.mailinv_above" => 'Enviar esta factura por e-mail',
"form.invoice.sending_str" => '<b>Factura enviada</b>',

"form.migration.zip" => 'Comprimir',
"form.migration.file" => 'Seleccione el archivo',
"form.migration.import.title" => 'Importar datos',
"form.migration.import.success" => 'Importación finalizada con éxito',
"form.migration.import.text" => 'Importar datos del grupo desde un archivo xml',
"form.migration.export.title" => 'Exportar datos',
"form.migration.export.success" => 'Exportación finalizada con éxito',
"form.migration.export.text" => 'Usted puede exportar todos los datos del grupo dentro de un archivo xml. Ésto puede ser útil si necesita migrar datos a su propio sevidor.',
// Note to translators: the strings below are missing in the translation and must be added
// "form.migration.compression.none" => 'none',
// "form.migration.compression.gzip" => 'gzip',
// "form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'Clientes',
"form.client.add_title" => 'Agregar cliente',
"form.client.edit_title" => 'Modificar cliente',
"form.client.del_title" => 'Eliminar cliente',
"form.client.th.name" => 'Nombre',
"form.client.th.edit" => 'Modificar',
"form.client.th.del" => 'Eliminar',
"form.client.name" => 'Nombre',
"form.client.tax" => 'Impuesto',
"form.client.discount" => 'Descuento',
"form.client.daily_subtotals" => 'Subototales diarios',
"form.client.yourcoo" => 'Su nombre <br> y dirección en la factura',
"form.client.custcoo" => 'Dirección',
"form.client.comment" => 'Comentario ',

// miscellaneous strings
"forward.forgot_password" => '¿Olvido su contraseña?',
"forward.edit" => 'Modificar',
"forward.delete" => 'Eliminar',
"forward.sendbyemail" => 'Enviar por e-mail',
"forward.tocsvfile" => 'Exportar datos a un archivo .csv',
// Note to translators: the string below is missing in the translation and must be added
// "forward.toxmlfile" => 'export data to .xml file',
"forward.geninvoice" => 'Generar factura',
"forward.change" => 'Configurar clientes',
"forward.lockpage" => 'intervalo para cerrar las modificaciones en los reportes de tiempo',

// strings inside contols on forms
"controls.select.project" => '--- Seleccionar proyecto ---',
"controls.select.activity" => '--- Seleccionar actividad---',
"controls.select.client" => '--- Seleccionar cliente ---',
"controls.project_bind" => '--- Todos ---',
"controls.all" => '--- Todos ---',
"controls.notbind" => '--- No ---',
"controls.per_tm" => 'Este mes',
"controls.per_lm" => 'El mes pasado',
"controls.per_tw" => 'Esta semana',
"controls.per_lw" => 'last week',
"controls.per_td" => 'this day',
// Note to translators: the strings below are missing in the translation and must be added
// "controls.per_at" => 'all time',
// "controls.per_ty" => 'this year',
"controls.sel_period" => '--- Seleccionar período de tiempo ---',
"controls.sel_groupby" => '--- No agrupar ---',
"controls.inc_billable" => 'facturable',
"controls.inc_nbillable" => 'no facturable',
// Note to translators: the string below is missing in the translation and must be added
// "controls.default" => '--- default ---',

// labels
"label.chart.title1" => 'actividades por usuario',
// Note to translators: the string below is missing in the translation and must be added
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'grafica por período',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>A nombre de %s</b>',
"label.pminfo" => ' (Manejador)',
"label.pcminfo" => ' (Auxiliar del manejador)',
"label.painfo" => ' (Administrador)',
"label.time_noentry" => 'Sin entrada',
"label.today" => 'Fecha Actual',
"label.req_fields" => '* campos requeridos',
"label.sel_project" => 'Seleccionar proyecto',
"label.sel_activity" => 'Seleccionar actividad',
"label.sel_tp" => 'Seleccionar período de tiempo',
"label.set_tp" => 'o establecer fechas',
"label.fields" => 'Mostrar campos',
"label.group_title" => 'Agrupar por',
"label.include_title" => 'include records',
"label.inv_str" => 'Factura',
"label.set_empl" => 'Seleccionar usuarios',
"label.sel_all" => 'Seleccionar todos',
"label.sel_none" => 'Quitar todas las selecciones',
"label.or" => 'o',
"label.disable" => 'Deshabilitar',
"label.enable" => 'Habilitar',
"label.filter" => 'Filtrar',
"label.timeweek" => 'total semanal'
// Note to translators: the strings below are missing in the translation and must be added
// "label.hrs" => 'hrs',
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>