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

	require_once('initialize.php');
	import('form.Form');
	import('UserHelper');

	$auth->doLogout();

	$cl_ref  = $request->getParameter('ref');
	if (!$cl_ref || $auth->isPasswordExternal()) {
		Header("Location: login.php");
		exit();
	}

	$user_id = UserHelper::getUserIdByTmpRef($cl_ref);
	if ($user_id) {
		$user = UserHelper::getUserArrById($user_id);
		$smarty->assign("userdet_string", $user["u_name"]);
	}

	$cl_password1		= $request->getParameter('pass1');
    $cl_password2		= $request->getParameter('pass2');

	$form = new Form('fpassForm');
    $form->addInput(array("type"=>"text","maxlength"=>"120","name"=>"pass1","aspassword"=>true,"value"=>$cl_password1));
    $form->addInput(array("type"=>"text","maxlength"=>"120","name"=>"pass2","aspassword"=>true,"value"=>$cl_password2));
    $form->addInput(array("type"=>"hidden","name"=>"ref","value"=>$cl_ref));
    $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.save')));

    if ($request->getMethod()=="POST") {
    	import('form.check.Validator');

		$validator = new Validator($cl_password1);
		$validator->validateSpaceString();
		$validator->validateEmptyString();
		if (!$validator->isValid()) {
			$errors->add("pass1",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.pas1"));
		}

		$validator = new Validator($cl_password2);
		$validator->validateSpaceString();
		$validator->validateEmptyString();
		if (!$validator->isValid()) {
	    	$errors->add("pass2",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.pas2"));
	    }

	    if (!($cl_password1 === $cl_password2))
    			$errors->add("passwords",$i18n->getKey("errors.compare"),$i18n->getKey("form.profile.pas1"),$i18n->getKey("form.profile.pas2"));

		if ($errors->isEmpty()) {
			UserHelper::setPassword($user_id, $cl_password1);
			header("Location: login.php");
  			exit();
		}
    }

	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("forms",array($form->getName()=>$form->toArray()));
	$smarty->assign("title_page",$i18n->getKey("form.fpass.title"));
  	$smarty->assign("content_page_name","change_password.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>