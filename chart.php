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
// | Contributors: Igor Melnik <igor.melnik at mail.ru>
// +----------------------------------------------------------------------+

// Note: This script requires GD 2.0.1 or later.

	require_once('initialize.php');
	import('UserHelper');
	import('TimeHelper');
	import('ActivityHelper');
	import('ProjectHelper');
	import('DateAndTime');
	import('Period');
	import('ChartHelper');
	import('PieChartEx');

	//$key = md5(uniqid($user->getLogin()))

	if(!strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "msie") === false) {
	   header("HTTP/1.x 205 OK");
	} else {
	   header("HTTP/1.x 200 OK");
	}
	header("Pragma: no-cache");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-cache, cachehack=".time());
	header("Cache-Control: no-store, must-revalidate");
	header("Cache-Control: post-check=-1, pre-check=-1", false);
	if (!@$_GET["noimg"])
		header('Content-Type: image/png');

	if ($auth->isAuthenticated()) {
		$chart_data = ChartHelper::getActivityChartData($auth->getUserId(), $request->getParameter('period', $_SESSION['chPeriod']),
			$request->getParameter('pie_mode', null));

		$chart = new PieChartEx(300, 300);

		$data_set = new XYDataSet();

		foreach($chart_data['points'] as $p) {
			$data_set->addPoint(new Point( '', $p['time_min']));
		}
		$chart->setDataSet($data_set);

		$chart->renderEx(array('hideLogo' => true, 'hideTitle' => true, 'hideLabel' => true));
		//$chart->render();
	}
?>