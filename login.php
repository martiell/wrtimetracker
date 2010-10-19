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

  require_once('initialize.php');
  import('form.Form');
  import('form.check.Validator');
  import('UserHelper');

  $cl_login    = $request->getParameter('login',@$_COOKIE["stored_login_name"]);
  $cl_password  = $request->getParameter('password');

  $form = new Form('loginForm');
  $form->addInput(array("type"=>"text","size"=>"25","maxlength"=>"100","name"=>"login","style"=>"width:220;","value"=>$cl_login));
  $form->addInput(array("type"=>"text","size"=>"25","maxlength"=>"50","name"=>"password","style"=>"width:220;","aspassword"=>true,"value"=>$cl_password));
  $form->addInput(array("type"=>"hidden", "name"=>"user_date", "value"=>"")); // user date
  $form->addInput(array("type"=>"submit", "name"=>"btlogin", "onclick"=>"user_date.value=get_date()", "value"=>$i18n->getKey('button.login')));

  if ($request->getMethod()=="POST") {
    $validator = new Validator($cl_login);
    $validator->validateEmptyString();
    if (!$validator->isValid()) {
      $errors->add("login",$i18n->getKey("errors.empty"),$i18n->getKey("form.login.login"));
    }
    $validator = new Validator($cl_password);
    $validator->validateEmptyString();
    if (!$validator->isValid()) {
      $errors->add("password",$i18n->getKey("errors.empty"),$i18n->getKey("form.login.password"));
    }

    if ($errors->isEmpty()) {
      if ($auth->doLogin($cl_login, $cl_password)) {
        // set user date
        $user_date = $request->getParameter('user_date', null);
        $ex = explode("/", $user_date); // m/d/Y
        if ( count($ex) == 3 )
          $_SESSION['date'] = strftime(SYS_DATEFORMAT, mktime(0,0,0,$ex[0], $ex[1], $ex[2]));

        //success
        setcookie("stored_login_name", $cl_login, time()+COOKIE_EXPIRE);
        header("Location: mytime.php");
        exit();
      } else {
        $errors->add("auth",$i18n->getKey("errors.wr_auth"));
      }
    }
  }

  if(MULTITEAM_MODE!="true" && !UserHelper::findAllAccount()) {
    $errors->add("create_team",$i18n->getKey("form.admin.profile.noprofiles"));
    //$messages->add("create_team",$i18n->getKey("form.admin.profile.noprofiles"));
  }

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign_by_ref("messages", $messages);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()) );
  $smarty->assign("onload","onLoad = \"document.loginForm." . (!$cl_login?"login":"password") . ".focus()\"");
  $smarty->assign("title_page",$i18n->getKey("form.login.title"));
  $smarty->assign("content_page_name","login.tpl");

  $smarty->assign("login_hello_text",$i18n->getKey("login.hello.text"));
  $smarty->assign("login_hello_style",$i18n->getKey("login.hello.style"));

  $smarty->display(INDEX_TEMPLATE);
?>