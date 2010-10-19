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
  
  // Use the "limit" plugin if we have one. Ignore include errors.
  // The "limit" plugin is not required for normal operation of the Time Tracker.
  @include("plugins/limit/people_add.php");
    
  $projects = UserHelper::findProjects($user->getUserId(), $user->getOwnerId(), false);
  $projects = mu_sort($projects, "p_name");
  $ud["projects"] = array(); // ud means user details
  $cl_password1 = '';
  if ($request->getMethod()=="POST") {
    $cl_name  = $request->getParameter('name');
    $cl_name  = trim($cl_name);
    $cl_login  = $request->getParameter('login');
    $cl_login  = trim(strtolower($cl_login));
    if (!$auth->isPasswordExternal()) {
      $cl_password1  = $request->getParameter('pas1');
      $cl_password2  = $request->getParameter('pas2');
    }
    $cl_rate  = $request->getParameter('rate');
    $cl_comanager  = $request->getParameter('comanager');
    $cl_projects = $request->getAttribute("projects");
    
    if (is_array($cl_projects)) {
      foreach ($cl_projects as $p) {
    	$it = array();
    	$it["p_id"] = $p;
    	$it["ub_checked"] = 1;
    	$it["ub_rate"] = $request->getAttribute("rate_".$p);
        $ud["projects"][] = $it;  		
      }
    }
    $cl_email = $request->getParameter('email');
  } else {
    $cl_projects = array();
    foreach ($ud["projects"] as $p) if ($p["ub_checked"]) $cl_projects[] = $p["p_id"];
    $cl_email = '';
  }

  $form = new Form('peopleForm');
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"name","style"=>"width:300;","value"=>@$cl_name));
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"login","style"=>"width:300;","value"=>@$cl_login));
  if (!$auth->isPasswordExternal()) {
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas1","aspassword"=>true,"value"=>@$cl_password1));
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas2","aspassword"=>true,"value"=>@$cl_password2));
  }
  $form->addInput(array("type"=>"floatfield","maxlength"=>"10","name"=>"rate","format"=>".2","value"=>@$cl_rate));
  $form->addInput(array("type"=>"checkbox","name"=>"comanager","data"=>"1","value"=>@$cl_comanager));
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"email","value"=>$cl_email));

  import("form.Table");
  import("form.TableColumn");
  class NameCellRenderer extends DefaultCellRenderer {
    function toRender(&$table, $value, $row, $column, $selected=false) {
      $this->setOptions(array("width"=>200,"valign"=>"top"));
      $this->setValue($value);
      return $this->toString();
    }
  }
  class RateCellRenderer extends DefaultCellRenderer {
    function toRender(&$table, $value, $row, $column, $selected=false) {
      global $ud;
      $field = new FloatField("rate_".$table->getValueAtName($row,"p_id"), $table->getValueAtName($row, "p_rate"));
      $field->setFormName($table->getFormName());
      $field->setLocalization($GLOBALS["I18N"]);
      $field->setSize(5);
      $field->setFormat(".2");
      if ($ud["projects"])
      foreach ($ud["projects"] as $p) {
        if ($p["p_id"]==$table->getValueAtName($row,"p_id")) $field->setValue(@$p["ub_rate"]);
      }
      $this->setValue($field->toStringControl());
      return $this->toString();
    }
  }
  $table = new Table("projects");
  $table->setIAScript("selectProject");
  $table->setTableOptions(array("width"=>"100%","cellspacing"=>"1","cellpadding"=>"3","border"=>"0"));
  $table->setRowOptions(array("valign"=>"top","class"=>"tableHeader"));
  $table->setMultiSelect(true);
  $table->setData($projects);
  $table->setKeyField("p_id");
  $table->setValue($cl_projects);
  $table->addColumn(new TableColumn("p_name",$i18n->getKey('form.people.th.project'), new NameCellRenderer()));
  $table->addColumn(new TableColumn("p_rate",$i18n->getKey('form.people.th.rate'), new RateCellRenderer()));
  $form->addInputElement($table);

  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.submit')));

  if ($request->getMethod()=="POST") {
    import('form.check.Validator');

    $validator = new Validator($cl_name);
    $validator->validateSpaceString();
    $validator->validateEmptyString();
    if (!$validator->isValid()) {
      $errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.people.name"));
    }

    $validator = new Validator($cl_login);
    $validator->validateSpaceString();
    $validator->validateEmptyString();
    $validator->validateEmail();
    if (!$validator->isValid()) {
      $errors->add("login",$i18n->getKey("errors.wrong"),$i18n->getKey("form.people.login"));
    }

    if (!$auth->isPasswordExternal()) {
      $validator = new Validator($cl_password1);
      //$validator->validateSpaceString();
      $validator->validateEmptyString();
      //$validator->validateLatinCharset();
      if (!$validator->isValid()) {
        $errors->add("password",$i18n->getKey("errors.wrong"),$i18n->getKey("form.people.pas1"));
      } elseif (!($cl_password1 === $cl_password2))
        $errors->add("passwords",$i18n->getKey("errors.compare"),$i18n->getKey("form.people.pas1"),$i18n->getKey("form.people.pas2"));
    }

    $validator = new Validator($cl_rate);
    $validator->validateFloat($i18n->getFloatDelimiter());
    if ($cl_rate && !$validator->isValid()) {
      $errors->add("rate",$i18n->getKey("errors.wrong"),$i18n->getKey("form.people.rate"));
    }

    if (!empty($cl_email)) {
      $validator = new Validator($cl_email);
      $validator->validateSpaceString();
      $validator->validateEmail();
      if (!$validator->isValid()) {
        $errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.email"));
      }
    } else {
      $cl_email = '';
    }

    if ($errors->isEmpty()) {
      if (!UserHelper::findUserByLogin($cl_login)) {
        if (UserHelper::addEmployee($user, array(
            'name' => $cl_name,
            'login' => $cl_login,
            'password' => $cl_password1,
            'rate' => $cl_rate,
            'comanager' => $cl_comanager,
            'aprojects' => &$ud["projects"],
            'email' => $cl_email),
            array('encode_pass' => true))) {
          Header("Location: people.php");
          exit();
        } else {
          $errors->add("newuser",$i18n->getKey("errors.reg_error"));
        }
      } else
        $errors->add("user",$i18n->getKey("errors.user_exist"));
    }
  } // post

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()));
  $smarty->assign("onload","onLoad = \"document.peopleForm.name.focus()\"");
  $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
  $smarty->assign("title_page",$i18n->getKey("form.people.createu_str"));
  $smarty->assign("content_page_name","people_add.tpl");
  $smarty->display(INDEX_TEMPLATE);
?>