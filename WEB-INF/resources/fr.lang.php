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

$i18n_language_name = "French";
$i18n_float_delimiter = ",";

$i18n_month = array ('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'); 
// order of week day names must be from Sunday to Saturday in all translated files
$i18n_week = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
$i18n_week_sn = array ("di","lu","ma","me","je","ve","sa");

//format m/d
$i18n_holidays = array("01/01", "13/04", "01/05", "08/05", "21/05", "01/06", "14/07", "15/08", "01/11", "11/11", "25/12");

$i18n_key_words = array(

// menu entries
"menu.login" => 'ouvrir la session',
"menu.logout" => 'fermer la session',
"menu.feedback" => 'commentaire',
"menu.help" => 'aide',
"menu.register" => 'créer un compte pour un responsable',
"menu.edprof" => 'modifier le profil',
"menu.mytime" => 'mon temps',
"menu.report" => 'rapports',
"menu.project" => 'projets',
"menu.activity" => 'activités',
"menu.people" => 'personnes',
"menu.profile" => 'équipes',
"menu.migration" => 'exporter les données',
"menu.clients" => 'clients',
"menu.services" => 'modifier le mot de passe',
"menu.admin" => 'admin',

// error strings
"errors.db_error" => 'erreur de base de données',
"errors.wrong" => 'données \'{0}\' incorrecte',
"errors.empty" => 'le champ \'{0}\' est vide',
"errors.compare" => 'le champ \'{0}\' n\'est pas égal au champ \'{1}\'',
"errors.wr_interval" => 'intervalle incorrect',
"errors.wr_project" => 'sélectionnez un projet',
"errors.wr_activity" => 'sélectionnez une activité',
"errors.wr_auth" => 'nom d\'utilisateur ou mot de passe incorrect',
"errors.del_nothing" => 'aucune donnée à supprimer',
"errors.reg_error" => "impossible de créer un nouvel utilisateur",
"errors.prof_error" => "impossible de changer le profil",
"errors.no_user" => "cet utilisateur n\'existe pas",
"errors.mt_del_no" => 'impossible d\'effacer cette durée',
"errors.mt_del_no_conf" => 'la durée n\'a pas été effacée',
"errors.mt_insert" => 'erreur d\'insertion de durée',
"errors.user_exist" => 'un utilisateur avec cette adresse email existe déjà',
"errors.user_notexists" => 'cet utilisateur n\'existe pas',
"errors.user_update" => "impossible de changer les données de l\'utilisateur",
"errors.user_delete" => "impossible d\'effacer les données de l\'utilisateur",
"errors.project_exist" => 'un projet avec ce nom existe déjà',
"errors.project_notexists" => 'ce projet n\'existe pas',
"errors.project_update" => 'impossible de changer le nom de projet',
"errors.project_add" => 'impossible d\'ajouter un nouveau projet',
"errors.project_nodel" => 'impossible de supprimer le projet',
"errors.activity_add" => 'impossible d\'ajouter une nouvelle activité',
"errors.activity_exist" => 'une activité avec ce nom existe déjà',
"errors.activity_update" => 'impossible de changer le nom de cette activité',
"errors.activity_nodel" => 'impossible d\'effacer cette activité',
"errors.activity_notexists" => 'cette activité n\'existe pas',
"errors.report_period" => 'période incorrecte',
"errors.search_by_login" => 'aucun utilisateur avec cette adresse email',
"errors.multiteam_mode" => 'vous ne pouvez plus créer de compte supplémentaire',
"errors.upload" => 'erreur de chargement de fichier',
"errors.client_nodel" => 'impossible d\'effacer de client',
"errors.client_notexists" => 'ce client n\'existe pas',
"errors.ie_sameusers" => 'un ou plusieurs email existent déjà dans la base',
"errors.period_lock" => 'impossible d\'ajouter un enregistrement. La période est verrouillée',
// A note to translators: the 2 strings are missing in the translation and must be added 
// "errors.mail_send" => 'error sending mail',
// "errors.fpass_no_user_email" => 'no email associated with this login',

// labels for various buttons
"button.login" => 'connexion',
"button.now" => 'maintenant',
"button.behalf_set" => 'valider',
"button.save" => 'sauvegarder',
"button.delete" => 'supprimer',
"button.cancel" => 'annuler',
"button.submit" => 'soumettre',
"button.ppl_add" => 'ajout nouvel utilisateur',
"button.proj_add" => 'ajout nouveau projet',
"button.act_add" => 'ajout nouvelle activité',
"button.add" => 'ajout',
"button.generate" => 'générer',
"button.sendpwd" => 'exécuter',
"button.send" => 'envoyer',
"button.sendbyemail" => 'envoyer par email',
"button.asnew" => 'enregistrer comme nouveau',
"button.profile_add" => 'créer une nouvelle équipe',
"button.export" => 'exporter l\'équipe',
"button.import" => 'importer l\'équipe',
"button.apply" => 'appliquer',
"button.clnt_add" => 'ajouter un nouveau client',

"form.filter.project" => 'projet',
"form.filter.filter" => 'rapport favori',
"form.filter.filter_new" => 'enregistrer comme favori',
"form.filter.filter_confirm_delete" => 'êtes-vous sur de vouloir supprimer ce rapport favori?',

// login form attributes
"form.login.title" => 'connexion',
"form.login.login" => 'connexion',
"form.login.password" => 'mot de passe',

// password reminder form attributes
"form.fpass.title" => 'réinitialisation du mot de passer',
"form.fpass.login" => 'connexion',
"form.fpass.send_pass_str" => 'le mot de passe a été envoyé',
"form.fpass.send_pass_subj" => 'Votre mot de passe Anuko Time Tracker',
"form.fpass.send_pass_body" => "Cher utilisateur,\n\nQuelqu'un, probablement vous, avez demandé une réinitialisation de votre mot de passe. Merci d\'aller à ce lien pour le réinitialiser\n\n%s\n\nLe développement de Anuko Time Tracker est sponsorisé par ZoneTick (http://zonetick.com).\n\n",
"form.fpass.reset_comment" => "pour réinitialiser votre mot de passe, saisissez le et cliquez sur enregistrer.",

// administrator form
"form.admin.title" => 'administrateur',
"form.admin.duty_text" => 'créer une nouvelle équipe en créant un nouveau compte de responsable d\'équipe.<br>Vous pouvez également importer des données sur une équipe depuis un fichier xml provenant d\'un autre serveur Anuko Time Tracker (les doublons d\'email ne sont pas autorisés).',
"form.admin.password" => 'mot de passe',
"form.admin.password_confirm" => 'confirmer le mot de passe',
"form.admin.change_pass" => 'changer le mot de passe du compte administrateur',
"form.admin.profile.title" => 'équipes',
"form.admin.profile.noprofiles" => 'votre base de données est vide. Connectez-vous comme administrateur et créez une nouvelle équipe.',
"form.admin.profile.comment" => 'supprimer une équipe',
"form.admin.profile.th.id" => 'id',
"form.admin.profile.th.name" => 'nom',
"form.admin.profile.th.edit" => 'modifier',
"form.admin.profile.th.del" => 'supprimer',
"form.admin.profile.th.active" => 'actif',
"form.admin.lock.period" => 'intervalle de verrouillage en jours',
// A note to translators: the strings are missing in the translation and must be added 
// "form.admin.options" => 'options',
// "form.admin.lang_default" => 'site default language',
// "form.admin.show_world_clock" => 'show world clock',
// "form.admin.custom_date_format" => "date format",
// "form.admin.custom_time_format" => "time format",
// "form.admin.start_week" => "first day of week",

// my time form attributes
"form.mytime.title" => 'mon temps',
"form.mytime.edit_title" => 'édition du l\'entrée de temps',
"form.mytime.del_str" => 'supprimer l\'entrée de temps',
"form.mytime.time_form" => ' (hh:mm)',
"form.mytime.date" => 'date',
"form.mytime.project" => 'projet',
"form.mytime.activity" => 'activité',
"form.mytime.start" => 'début',
"form.mytime.finish" => 'fin',
"form.mytime.duration" => 'durée',
"form.mytime.note" => 'note',
"form.mytime.behalf" => 'travail quotidien pour',
"form.mytime.daily" => 'travail quotidien',
"form.mytime.total" => 'total d\'heures:',
"form.mytime.th.project" => 'projet',
"form.mytime.th.activity" => 'activité',
"form.mytime.th.start" => 'début',
"form.mytime.th.finish" => 'fin',
"form.mytime.th.duration" => 'durée',
"form.mytime.th.note" => 'note',
"form.mytime.th.edit" => 'modifier',
"form.mytime.th.delete" => 'supprimer',
"form.mytime.del_yes" => 'l\'enregistrement de durée a été supprimé',
"form.mytime.no_finished_rec" => 'cet enregistrement a été enregistré avec seulement une heure de début. Il ne s\'agit pas d\'une erreur. Déconnectez-vous si besoin.',
"form.mytime.billable" => 'facturable',
"form.mytime.warn_tozero_rec" => 'cet enregistrement de durée doit être supprimé car la période est verrouillée',
// A note to translators: the string is missing in the translation and must be added 
// "form.mytime.uncompleted" => 'uncompleted',

// profile form attributes
"form.profile.createm_str" => 'créez le nouveau compte de responsable',
"form.profile.prof_str" => 'modification du profil',
"form.profile.name" => 'nom',
"form.profile.login" => 'connexion',
"form.profile.pas1" => 'mot de passe',
"form.profile.pas2" => 'confirmez le mot de passe',
"form.profile.comp" => 'société',
"form.profile.www" => 'site web de la société',
"form.profile.curr" => 'devise',
// A note to translators: the strings below are missing in the translation and must be added 
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
"form.people.ppl_str" => 'personnes',
"form.people.createu_str" => 'création d\'un nouvel utilisateur',
"form.people.edit_str" => 'modification de l\'utilisateur',
"form.people.del_str" => 'suppression de l\'utilisateur',
"form.people.th.name" => 'nom',
"form.people.th.login" => 'connexion',
"form.people.th.role" => 'rôle',
"form.people.th.edit" => 'modifier',
"form.people.th.del" => 'supprimer',
"form.people.th.status" => 'statut',
"form.people.th.project" => 'projet',
"form.people.th.rate" => 'tarif',
"form.people.manager" => 'responsable',
"form.people.comanager" => 'co-responsable',
"form.people.empl" => 'utilisateur',
"form.people.name" => 'nom',
"form.people.login" => 'connexion',
"form.people.pas1" => 'mot de passe',
"form.people.pas2" => 'confirmez le mot de passe',
"form.people.rate" => 'tarif horaire standard',
"form.people.comanager" => 'co-responsable',
"form.people.projects" => 'projets',
"form.people.email" => "email",

// projects form attributes
"form.project.proj_title" => 'projets',
"form.project.edit_str" => 'modification du projet',
"form.project.add_str" => 'ajout du nouveau projet',
"form.project.del_str" => 'suppression du projet',
"form.project.th.name" => 'nom',
"form.project.th.edit" => 'modifier',
"form.project.th.del" => 'supprimer',
"form.project.name" => 'nom',

// activities form attributes
"form.activity.act_title" => 'activités',
"form.activity.add_title" => 'ajouter une nouvelle activité',
"form.activity.edit_str" => 'modification de l\'activité',
"form.activity.del_str" => 'suppression de l\'activité',
"form.activity.name" => 'nom',
"form.activity.project" => 'projet',
"form.activity.th.name" => 'nom',
"form.activity.th.project" => 'projet',
"form.activity.th.edit" => 'modifier',
"form.activity.th.del" => 'supprimer',

// report attributes
"form.report.title" => 'rapports',
"form.report.from" => 'date de début',
"form.report.to" => 'date de fin',
"form.report.groupby_user" => 'utilisateur',
"form.report.groupby_project" => 'projet',
"form.report.groupby_activity" => 'activité',
"form.report.duration" => 'durée',
"form.report.start" => 'début',
"form.report.activity" => 'activité',
"form.report.show_idle" => 'montrez inactif',
"form.report.finish" => 'fin',
"form.report.note" => 'note',
"form.report.project" => 'projet',
"form.report.totals_only" => 'totaux uniquement',
"form.report.total" => 'total des heures',
"form.report.th.empllist" => 'utilisateur',
"form.report.th.date" => 'date',
"form.report.th.project" => 'projet',
"form.report.th.activity" => 'activité',
"form.report.th.start" => 'début',
"form.report.th.finish" => 'fin',
"form.report.th.duration" => 'durée',
"form.report.th.note" => 'note',

// mail form attributes
"form.mail.from" => 'de',
"form.mail.to" => 'à',
"form.mail.cc" => 'cc',
"form.mail.subject" => 'objet',
"form.mail.comment" => 'commentaire',
"form.mail.above" => 'envoyez ce rapport par email',
"form.mail.footer_str" => 'Le développement de Anuko Time Tracker est sponsorisé par <a href="http://zonetick.com">ZoneTick</a>',
"form.mail.sending_str" => '<b>le message a été envoyé</b>',

// invoice attributes
"form.invoice.title" => 'facture',
"form.invoice.caption" => 'facture',
"form.invoice.above" => 'information supplémentaire pour la facture',
"form.invoice.select_cust" => 'sélectionnez le client',
"form.invoice.fillform" => 'remplissez les champs',
"form.invoice.date" => 'date de facture',
"form.invoice.number" => 'numéro de facture',
"form.invoice.tax" => 'taxe',
"form.invoice.discount" => 'remise',
"form.invoice.daily_subtotals" => 'sous-totaux journaliers',
"form.invoice.yourcoo" => 'votre nom<br> et adresse',
"form.invoice.custcoo" => 'nom du client<br> et adresse',
"form.invoice.comment" => 'commentaire',
"form.invoice.th.username" => 'personne',
"form.invoice.th.time" => 'heures',
"form.invoice.th.rate" => 'tarif',
"form.invoice.th.summ" => 'montant',
"form.invoice.subtotal" => 'sous-total',
"form.invoice.total" => 'total',
"form.invoice.customer" => 'client',
"form.invoice.period" => 'période de facturation',
"form.invoice.mailinv_above" => 'envoyez cette facture par email',
"form.invoice.sending_str" => '<b>la facture a été envoyée</b>',

"form.migration.zip" => 'compression',
"form.migration.file" => 'sélectionner le fichier',
"form.migration.import.title" => 'importer les données',
"form.migration.import.success" => 'import réussi',
"form.migration.import.text" => 'importer les donnés des équipes depuis un fichier xml',
"form.migration.export.title" => 'exporter les données',
"form.migration.export.success" => 'export réussi',
"form.migration.export.text" => 'vous pouvez exporter toute les données d\'une équipe dans un ficheir xml. Cela peut être utile si vous transférer des données vers votre serveur.',
// Note to translators: the string below is missing in the translation and must be added 
// "form.migration.compression.none" => 'none',
"form.migration.compression.gzip" => 'gzip',
"form.migration.compression.bzip" => 'bzip',

"form.client.title" => 'clients',
"form.client.add_title" => 'ajouter un client',
"form.client.edit_title" => 'modifier un client',
"form.client.del_title" => 'supprimer un client',
"form.client.th.name" => 'nom',
"form.client.th.edit" => 'modifier',
"form.client.th.del" => 'supprimer',
"form.client.name" => 'nom',
"form.client.tax" => 'taxe',
"form.client.discount" => 'remise',
"form.client.daily_subtotals" => 'sous-totaux journaliers',
"form.client.yourcoo" => 'votre nom<br> et l\'adresse pour la facturation',
"form.client.custcoo" => 'adresse',
"form.client.comment" => 'commentaire ',

// miscellaneous strings
"forward.forgot_password" => 'mot de passe oublié?',
"forward.edit" => 'modifier',
"forward.delete" => 'supprimer',
"forward.sendbyemail" => 'envoyer par email',
"forward.tocsvfile" => 'export des données vers un fichier .csv',
"forward.toxmlfile" => 'export des données vers un fichier .xml',
"forward.geninvoice" => 'produire la facture',
"forward.change" => 'configurer les clients',
"forward.lockpage" => 'intervalle pour bloquer la modification des entrées de durée',

// strings inside contols on forms
"controls.select.project" => '--- choisissez le projet ---',
"controls.select.activity" => '--- choisissez l\'activité ---',
"controls.select.client" => '--- choisissez le client ---',
"controls.project_bind" => '--- tous ---',
"controls.all" => '--- tous ---',
"controls.notbind" => '--- non ---',
"controls.per_tm" => 'ce mois',
"controls.per_lm" => 'le mois passé',
"controls.per_tw" => 'cette semaine',
"controls.per_lw" => 'la semaine passée',
"controls.per_td" => 'ce jour',
"controls.per_at" => 'depuis toujours',
"controls.per_ty" => 'cette année',
"controls.sel_period" => '--- choisissez la période de temps ---',
"controls.sel_groupby" => '--- aucun regroupage ---',
"controls.inc_billable" => 'facturables',
"controls.inc_nbillable" => 'non facturables',
"controls.default" => '--- défaut ---',

// labels
"label.chart.title1" => 'activités pour l\'utilisateur',
// Note to translators: the string below is missing in the translation and must be added 
// "label.chart.title2" => 'projects for user',
"label.chart.period" => 'graphe pour la période',

"label.pinfo" => '%s, %s',
"label.pinfo2" => '%s',
"label.pbehalf_info" => '%s %s <b>de la part de %s</b>',
"label.pminfo" => ' (responsable)',
"label.pcminfo" => ' (co-responsable)',
"label.painfo" => ' (administrateur)',
"label.time_noentry" => 'aucune entrée',
"label.today" => 'aujourd\'hui',
"label.req_fields" => '* champs obligatoires',
"label.sel_project" => 'choisissez le projet',
"label.sel_activity" => 'choisissez l\'activité',
"label.sel_tp" => 'choisissez la période de temps',
"label.set_tp" => 'ou dates indiquées',
"label.fields" => 'montrer les champs',
"label.group_title" => 'regroupés par',
"label.include_title" => 'inclure les enregistrements',
"label.inv_str" => 'facture',
"label.set_empl" => 'sélectionnez les utilisateurs',
"label.sel_all" => 'tout sélectionner',
"label.sel_none" => 'tout désélectionner',
"label.or" => 'ou',
"label.disable" => 'désactiver',
"label.enable" => 'activer',
"label.filter" => 'filtre',
"label.timeweek" => 'total hebdomadaire',
"label.hrs" => 'h', 
// Note to translators: the strings below are missing in the translation and must be added 
// "label.errors" => 'errors',
// "label.ldap_auth_module_demo" => '<b><font color="red">This is a demo version of LDAP Authentication Module.<br />You will be logged out after %d sec.</font></b><br /><a href="http://www.anuko.com">Buy full version here!</a>',
// "label.ldap_hint" => 'Type your <b>Windows login</b> and <b>password</b> in the fields below.',
);
?>