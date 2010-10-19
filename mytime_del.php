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
	import('UserHelper');
	import('TimeHelper');
	import('DateAndTime');
	import('SysConfig');
	
	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if ($user->isAdministrator()) {
			Header("Location: admin.php");
			exit();
		}
	}
	else {
		Header("Location: login.php");
		exit();
	}

	$date_ask	= $request->getParameter('date',(isset($_SESSION['date_ask'])?$_SESSION['date_ask']:null));
    $_SESSION['date_ask'] = $date_ask;
    
    $cl_ts	= $request->getParameter('ts',(isset($_SESSION['ts'])?$_SESSION['ts']:null));
    $_SESSION['ts'] = $cl_ts;

	if(!$date_ask)
		die("Not exists date parameter");
	$crdate = new DateAndTime(SYS_DATEFORMAT);
	$crdate->parseVal($date_ask);
	
	$locktime = $user->getLocktime();
	$lockdate = 0;
	if ($locktime<0 || $locktime==null || $locktime=="") {
		$sc = new SysConfig(new User($user->getOwnerId(), false));
		$locktime = $sc->getValue(SYSC_LOCK_DAYS);	
	}
	if ($locktime>0) {
		$cl_date_now = $request->getParameter('date_now');
		if ($cl_date_now) {
			$lockdate = new DateAndTime($i18n->getDateTimeFormat(), $cl_date_now);
			//$lockdate = new DateAndTime();
			$lockdate->decDay($locktime);
		}
	}
	
	$no_finished_rec = TimeHelper::findUncompletedRecord($user->getUserId());
	if ($no_finished_rec && $lockdate && $crdate->before($lockdate)) {
		$messages->add("warn_tozero_rec",$i18n->getKey("form.mytime.warn_tozero_rec"));
	}
	

	if ($request->getMethod()=="POST") {
		
		if ($request->getParameter('confirmation'))  {  // Confirmation of deleting
            //  deleting
            if (TimeHelper::delete($user->getActiveUser(), $cl_ts)) {
              header("Location: mytime.php");
              exit();
            } else {
              $errors->add("deleting",$i18n->getKey("errors.mt_del_no"));
            }
          }
          
        if ($request->getParameter('rejecting')) {
            header("Location: mytime.php");
            exit();
        }
	} else {
		if ($time_rec = TimeHelper::findTimeRecord($user->getActiveUser(),$cl_ts)) {
			$smarty->assign("time_rec", array($time_rec) );
		}
	}
		
	$form = new Form('mytimeForm');
    $form->addInput(array("type"=>"hidden","name"=>"date","value"=>$date_ask));
    $form->addInput(array("type"=>"hidden","name"=>"ts","value"=>$cl_ts));
    $form->addInput(array("type"=>"submit","name"=>"confirmation","value"=>$i18n->getKey('button.delete')));
    $form->addInput(array("type"=>"submit","name"=>"rejecting","value"=>$i18n->getKey('button.cancel')));
	
  	$smarty->assign_by_ref("errors", $errors);
  	$smarty->assign_by_ref("messages", $messages);
	$smarty->assign("forms",array($form->getName()=>$form->toArray()) );
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.mytime.del_str"));
  	$smarty->assign("content_page_name","mytime_del.tpl");
  	$smarty->display(INDEX_TEMPLATE);

?>