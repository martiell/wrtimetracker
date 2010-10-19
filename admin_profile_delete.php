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
	import('form.check.Validator');

	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if (!$user->isAdministrator()) {
			Header("Location: login.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}
	
	$cl_profileid = (int)$request->getParameter('profile_id');
	$ud = UserHelper::findAccountById($cl_profileid);
	
	$form = new Form('profileForm');
	$form->addInput(array("type"=>"hidden","name"=>"profile_id","value"=>$cl_profileid));
	$form->addInput(array("type"=>"submit","name"=>"confirmation","value"=>$i18n->getKey('button.delete')));
	$form->addInput(array("type"=>"submit","name"=>"rejecting","value"=>$i18n->getKey('button.cancel')));
	
	if ($request->getMethod()=="POST") {
		if ($request->getParameter('confirmation')) {
			if(UserHelper::findAccountById($cl_profileid)) {
				if (UserHelper::deleteAccount($cl_profileid)) {
					header("Location: admin_profiles.php");
					exit();
				} else {
					$errors->add("deluser",$i18n->getKey("errors.user_delete"));
				}
			} else
				$errors->add("nouser",$i18n->getKey("errors.user_notexists"));
		}
			
		if ($request->getParameter('rejecting')) {
			header("Location: admin_profiles.php");
			exit();
		}
	}
	
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("delstr_profile", $i18n->getKey("form.admin.profile.comment")." \"".$ud["c_name"]."\" (id: ".$ud["c_id"].")");
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.admin.profile.title"));
    if ($ud) {
    	$smarty->assign("content_page_name","profile_del.tpl");
    } else {
    	$smarty->assign("content_page_name","syserror.tpl");
    }
  	$smarty->display(INDEX_TEMPLATE);
?>