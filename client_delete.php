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
	
	$cl_id = (int)$request->getParameter('client_id');
	$ud = ClientHelper::findClientById($user, $cl_id);
    $delstr_activity = $ud["clnt_name"];
	
	$form = new Form('clientForm');
    $form->addInput(array("type"=>"hidden","name"=>"client_id","value"=>$cl_id));
	$form->addInput(array("type"=>"submit","name"=>"confirmation","value"=>$i18n->getKey('button.delete')));
	$form->addInput(array("type"=>"submit","name"=>"rejecting","value"=>$i18n->getKey('button.cancel')));
	
	if ($request->getMethod()=="POST") {
		if(ClientHelper::findClientById($user, $cl_id)) {
			if ($request->getParameter('confirmation')) {
				if (ClientHelper::delete($user, $cl_id)) {
					header("Location: clients.php");
					exit();
				} else {
					$errors->add("delact",$i18n->getKey("errors.client_nodel"));
				}
			}
		} else 
			$errors->add("noact",$i18n->getKey("errors.client_notexists"));
			
		if ($request->getParameter('rejecting')) {
			header("Location: clients.php");
			exit();
		}
	} // post
	
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("delstr_client", $delstr_activity);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.client.del_title"));
  	if ($ud) {
    	$smarty->assign("content_page_name","client_del.tpl");
    } else {
    	$smarty->assign("content_page_name","syserror.tpl");
    }
 	$smarty->display(INDEX_TEMPLATE);
?>