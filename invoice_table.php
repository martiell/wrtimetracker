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
// | Contributors: Igor Melnik <igor@rivne.com>
// +----------------------------------------------------------------------+

	require_once('initialize.php');
	import('form.Form');
	import('form.ActionForm');
	import('DateAndTime');
	import('Period');
	import('ProjectHelper');
    import('ActivityHelper');
    import('UserHelper');
    import('ReportHelper');
    
	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if ($user->isAdministrator()) {
			Header("Location: admin.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}

	$form = new Form("invoiceForm");
	$invbean = new ActionForm("invoiceBean", $form);
	$bean = new ActionForm("reportBean", $form);

    $smarty->assign("invoice_content", ReportHelper::prepareInvoice($bean, $invbean, $user, $i18n, $errors) );
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("title_page",$i18n->getKey("form.invoice.title"));
	$smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
  	$smarty->assign("content_page_name", "report_invoice.tpl");
  	$smarty->display(INDEX_TEMPLATE);	
?>