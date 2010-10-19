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
	import('ClientHelper');
	import('form.check.Validator');

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
	
	if ($request->getMethod()=="POST") {
		$cl_name  = $request->getParameter('name');
		$cl_name  = trim($cl_name);
		$cl_yourcoo = $request->getAttribute("yourcoo");
		$cl_custcoo = $request->getAttribute("custcoo");
		$cl_comment = $request->getAttribute("comment");
		$cl_tax = $request->getAttribute("tax");
		$cl_daily_subtotals = $request->getAttribute("daily_subtotals");
		$cl_discount = $request->getAttribute("discount");
	}
	
	$form = new Form('clientForm');
	$form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"name","style"=>"width:350;","value"=>@$cl_name));
	$form->addInput(array("type"=>"textarea","name"=>"yourcoo","maxlength"=>"255","style"=>"width:350;","cols"=>"55","rows"=>"5","value"=>@$cl_yourcoo));
    $form->addInput(array("type"=>"textarea","name"=>"custcoo","maxlength"=>"255","style"=>"width:350;","cols"=>"55","rows"=>"5","value"=>@$cl_custcoo));
    $form->addInput(array("type"=>"textarea","name"=>"comment","maxlength"=>"200","style"=>"width:350;","cols"=>"55","rows"=>"5","value"=>@$cl_comment));
    $form->addInput(array("type"=>"floatfield","name"=>"tax","size"=>"10","format"=>".2","value"=>@$cl_tax));
    $form->addInput(array("type"=>"checkbox","name"=>"daily_subtotals","data"=>1,"value"=>@$cl_daily_subtotals));
	$form->addInput(array("type"=>"floatfield","name"=>"discount","size"=>"10","format"=>".2","value"=>@$cl_discount));
	$form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.add')));
	
	if ($request->getMethod()=="POST") {
		$validator = new Validator($cl_name);
		$validator->validateSpaceString();
		$validator->validateEmptyString();
		if (!$validator->isValid()) {
			$errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.client.name"));	
		}

		if (isset($cl_tax)) {
			$validator = new Validator($cl_tax);
			$validator->validateSpaceString();
			$validator->validateEmptyString();
			$validator->validateFloat($i18n->getFloatDelimiter());
			if (!$validator->isValid()) {
				$errors->add("tax",$i18n->getKey("errors.wrong"),$i18n->getKey("form.client.tax"));	
			}
		}
		
		if (isset($cl_discount)) {
			$validator = new Validator($cl_discount);
			$validator->validateSpaceString();
			$validator->validateEmptyString();
			$validator->validateFloat($i18n->getFloatDelimiter());
			if (!$validator->isValid()) {
				$errors->add("discount",$i18n->getKey("errors.wrong"),$i18n->getKey("form.client.discount"));	
			}
		}
		
        if ($errors->isEmpty()) {
        	ClientHelper::insert($user, array(
              'name' => $cl_name,
              'address' => $cl_custcoo,
              'tax' => $cl_tax,
              'discount' => $cl_discount,
              'addr_you' => $cl_yourcoo,
              'comment' => $cl_comment,
              'fsubtotals' => $cl_daily_subtotals));
        	header("Location: clients.php");
        }
	} // post
	
	$smarty->assign_by_ref("errors", $errors);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("onload","onLoad=\"document.clientForm.name.focus()\"");
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.client.add_title"));
  	$smarty->assign("content_page_name","client_add.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>