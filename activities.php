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
	import('UserHelper');
	import('ActivityHelper');
	import('ProjectHelper');

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
	
	$form = new Form('activityForm');
	$project_list = ProjectHelper::findAllProjects($user);
	$form->addInput(array("type"=>"combobox",
    	"onchange"=>"javascript:this.form.submit();",
    	"name"=>"f_project",
    	"style"=>"width: 250",
    	"data"=>$project_list,
    	"datakeys"=>array("p_id","p_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.project_bind'))
    	));
	$form->addInput(array("type"=>"submit","name"=>"btsubmit"));
	
	$bean = new ActionForm("activityBean", $form, $request);
	$form->setValueByElement("btsubmit",$i18n->getKey('button.submit'));

	$activity_list = ActivityHelper::findAllActivity($user, $bean->getAttribute("f_project"));

	if ($request->getMethod()=="POST") {
       	$bean->saveBean();
    }

    $smarty->assign("activity_list", $activity_list);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.activity.act_title"));
  	$smarty->assign("content_page_name","activities.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>