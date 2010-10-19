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
	
	$bean = new ActionForm("reportBean", new Form("reportForm"), $request);
	if ($bean->getAttribute("period")) {
  		$period = new Period($bean->getAttribute("period"), new DateAndTime($i18n->getDateFormat()) );
	} else {
		$period = new Period();
		$period->setPeriod(
				new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("from")),
				new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("to"))
				);
	}

	if ( ($user->isManager() || $user->isCoManager())
		 && is_array($bean->getAttribute('users'))  )
		$userlist	= join (',', $bean->getAttribute('users'));
    if (!isset($userlist))	$userlist = $user->getUserId(); 
    
    header('Content-type: text/html; charset=utf-8');

	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename="timesheet.csv"');
	
	include(RESOURCE_DIR."/prepare.report_timesheet.php");
	include(RESOURCE_DIR."/report_timesheet_csv.php");

?>