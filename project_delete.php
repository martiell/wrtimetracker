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
	
	$cl_project_id = (int)$request->getParameter('pr_id');
	$ud = ProjectHelper::findProjectById($user->getOwnerId(), $cl_project_id);
    $delstr_project = $ud["p_name"];
	
	$form = new Form('projectForm');
    $form->addInput(array("type"=>"hidden","name"=>"pr_id","value"=>$cl_project_id));
	$form->addInput(array("type"=>"submit","name"=>"confirmation","value"=>$i18n->getKey('button.delete')));
	$form->addInput(array("type"=>"submit","name"=>"rejecting","value"=>$i18n->getKey('button.cancel')));
	
	if ($request->getMethod()=="POST") {
		if(ProjectHelper::findProjectById($user->getOwnerId(), $cl_project_id)) {
			if ($request->getParameter('confirmation')) {
				if (ProjectHelper::delete($cl_project_id)) {
					header("Location: projects.php");
					exit();
				} else {
					$errors->add("delproj",$i18n->getKey("errors.project_nodel"));
				}
			}
		} else 
			$errors->add("noproj",$i18n->getKey("errors.project_notexists"));
			
		if ($request->getParameter('rejecting')) {
			header("Location: projects.php");
			exit();
		}
	} // post
	
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("delstr_project", $delstr_project);
    $smarty->assign("forms",array($form->getName()=>$form->toArray()));
    $smarty->assign("onload","onLoad=\"document.projectForm.rejecting.focus()\"");
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("title_page",$i18n->getKey("form.project.del_str"));
    if ($ud) {
    	$smarty->assign("content_page_name","project_del.tpl");
    } else {
    	$smarty->assign("content_page_name","syserror.tpl");
    }
  	$smarty->display(INDEX_TEMPLATE);
?>