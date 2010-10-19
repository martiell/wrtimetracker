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
// | Contributors: Sergey Kikot <skikot@wrconsulting.com>
// +----------------------------------------------------------------------+

  require_once('initialize.php');
  import('form.Form');
  import('UserHelper');
  import('ProjectHelper');
  import('UserHelper');
  import('ActivityHelper');

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

  $user_bind = $request->getParameter('users', array());
  $activ_bind = $request->getParameter('activity', array());
  $cl_project_id = (int)$request->getParameter('pr_id');
  if ($cl_project_id > 0) {
    $_SESSION["cl_project_id"] = $cl_project_id;
  }
  if ($cl_project_id == 0) {
    $cl_project_id = $_SESSION["cl_project_id"];
  }

  $ud = ProjectHelper::findProjectById($user->getOwnerId(), $cl_project_id);
  if ($request->getMethod() == "POST") {
    $cl_name  = $request->getParameter('name');
    $cl_name  = trim($cl_name);
  } else {
    $cl_name  = $ud["p_name"];
  }

  $form = new Form('projectForm');
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"name","value"=>$cl_name));
  $form->addInput(array("type"=>"hidden","name"=>"pr_id","value"=>$cl_project_id));
  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.save')));

  // people part
  $g_user_list = UserHelper::findAllUsers($user, false);
  foreach ($g_user_list as $user_item) {
    $user_list[$user_item["u_id"]] = $user_item["u_name"];
  }

  $mdb2 = getConnection();

  $sql = "SELECT ub_id_u FROM user_bind WHERE ub_checked = 1 AND ub_id_p = ".$cl_project_id;
  $res = &$mdb2->query($sql);
  if (PEAR::isError($res)) {
    die($res->getMessage());
  }
  while ($row = $res->fetchRow()) {
    $check_user[] = $row['ub_id_u'];
  }

  $form->addInput(array("type"=>"checkboxgroup", "name"=>"users", "data" => $user_list, "layout" => "H"));
  $form->setValueByElement("users", @$check_user);
  // people part end

  // activity part
  $g_act_list = ActivityHelper::findAllActivity($user, false);
    foreach ($g_act_list as $act_item) {
    foreach ($act_item['aprojects'] as $proj) {
        if($proj['p_id'] == $cl_project_id)
        $check_act[] = $act_item["a_id"];
    }
      $act_list[$act_item["a_id"]] = $act_item["a_name"];
    }

  $form->addInput(array("type" => "checkboxgroup", "name"=>"activity", "data" => $act_list, "layout"=>"H"));
  $form->setValueByElement("activity", @$check_act);
  // activ. part end

  if ($request->getMethod() == "POST") {
    import('form.check.Validator');

    $validator = new Validator($cl_name);
    $validator->validateSpaceString();
    $validator->validateEmptyString();
    if (!$validator->isValid()) {
      $errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.project.name"));
    }

    if ($errors->isEmpty()) {
      $ulo = ProjectHelper::findProjectByName($user->getOwnerId(), $cl_name);
      if (($ulo && $cl_project_id == $ulo["p_id"]) || (!$ulo)) {
        if(!is_array($activ_bind) OR count($activ_bind) < 1)
          $activ_bind = array();
        if (ProjectHelper::update($user, array(
            'user_id' => $user->getOwnerId(),
            'project_id' => $cl_project_id,
            'project_name' => $cl_name,
            'user_add' => $user_bind,
            'activ_add' => $activ_bind))) {
          $user->reload();
          Header("Location: projects.php");
          exit();
        } else
          $errors->add("editproj",$i18n->getKey("errors.project_update"));
      } else
        $errors->add("editproj",$i18n->getKey("errors.project_exist"));
    }
  } // post

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()));
  $smarty->assign("onload","onLoad=\"document.projectForm.name.focus()\"");
  $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
  $smarty->assign("title_page",$i18n->getKey("form.project.edit_str"));
  if ($ud) {
    $smarty->assign("content_page_name","project_edit.tpl");
  } else {
    $smarty->assign("content_page_name","syserror.tpl");
  }
  $smarty->display(INDEX_TEMPLATE);
?>