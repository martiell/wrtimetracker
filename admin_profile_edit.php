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

  $cl_profile_id = (int)$request->getParameter('profile_id');
  if ($cl_profile_id>0) {
    $_SESSION["cl_profile_id"] = $cl_profile_id;
  }
  if ($cl_profile_id==0) {
    $cl_profile_id = $_SESSION["cl_profile_id"];
  }

  $cl_password1 = null;
  $ud = UserHelper::findAccountById($cl_profile_id);
  if ($request->getMethod()=="POST") {
    $cl_name  = $request->getParameter('uname');
    $cl_name  = trim($cl_name);
    $cl_login  = $request->getParameter('login');
    $cl_login  = trim(strtolower($cl_login));
    if (!$auth->isPasswordExternal()) {
      $cl_password1  = $request->getParameter('pas1');
      $cl_password2  = $request->getParameter('pas2');
    }
    $cl_email = $request->getParameter('email');
    $cl_company  = $request->getParameter('comp');
    $cl_www    = $request->getParameter('www');
    $cl_currency = $request->getParameter('curr');
    if (!$cl_currency) $cl_currency = 'US$';
  } else {
    $cl_name  = $ud["u_name"];
    $cl_login  = $ud["u_login"];
    if (!$auth->isPasswordExternal()) {
      $cl_password1 = $cl_password2 = ""; //@$ud["u_password"];
    }
    $cl_email = $ud['u_email'];
    $cl_company = $ud["c_name"];
    $cl_www = $ud["c_www"];
    $cl_currency = ( $ud["c_currency"]=="" ? "US$" : $ud["c_currency"]);
  }

  $form = new Form('profileForm');
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"login","value"=>$cl_login));
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"email","value"=>$cl_email));
  $form->addInput(array("type"=>"text","maxlength"=>"200","name"=>"comp","value"=>$cl_company));
  $form->addInput(array("type"=>"text","maxlength"=>"250","name"=>"www","value"=>$cl_www));
  $form->addInput(array("type"=>"text","maxlength"=>"10","name"=>"curr","value"=>$cl_currency));

  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"uname","value"=>$cl_name));
  if (!$auth->isPasswordExternal()) {
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas1","aspassword"=>true,"value"=>$cl_password1));
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas2","aspassword"=>true,"value"=>$cl_password2));
  }

  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.save')));
  $form->addInput(array("type"=>"submit","name"=>"btcancel","value"=>$i18n->getKey('button.cancel')));

  if ($request->getMethod()=="POST") {
    if ($request->getAttribute("btsubmit")) {
      $validator = new Validator($cl_name);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      if (!$validator->isValid()) {
        $errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.name"));
      }

      $validator = new Validator($cl_login);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      $validator->validateEmail();
      if (!$validator->isValid()) {
        $errors->add("login",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.login"));
      }

      if (!$auth->isPasswordExternal()) {
        if ($cl_password1 || $cl_password2) {
          $validator = new Validator($cl_password1);
        $validator->validateSpaceString();
        if (!$validator->isValid()) {
          $errors->add("password",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.pas1"));
        } elseif (!($cl_password1 === $cl_password2))
          $errors->add("passwords",$i18n->getKey("errors.compare"),$i18n->getKey("form.profile.pas1"),$i18n->getKey("form.profile.pas2"));
        }
      }

      $validator = new Validator($cl_company);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      if (!$validator->isValid()) {
        $errors->add("company",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.comp"));
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

      if ($errors->isEmpty() && $ud["u_id"]) {
        $manager = new User($ud["u_id"], false);
        $checkData = UserHelper::findUserByLogin($cl_login);

        if ($checkData && $checkData["u_id"]!=$ud["u_id"])
          $errors->add("loginexists",$i18n->getKey("errors.user_exist"));

        if ($errors->isEmpty()) {
          if (UserHelper::updateAccount(
              $manager, array(
                'name' => $cl_name,
                'login' => $cl_login,
                'password' => $cl_password1,
                'company' => $cl_company,
                'company_www' => $cl_www,
                'currency' => $cl_currency,
                'email' => $cl_email))) {
            Header("Location: admin_profiles.php");
            exit();
          } else {
            $errors->add("newprofile",$i18n->getKey("errors.prof_error"));
          }
        }
      }
    }

    if ($request->getAttribute("btcancel")) {
      Header("Location: admin_profiles.php");
      exit();
    }
  } // post

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()));
  $smarty->assign("onload","onLoad = \"document.profileForm.uname.focus()\"");
  $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
  $smarty->assign("title_page",$i18n->getKey("form.profile.prof_str"));
  if ($ud) {
    $smarty->assign("content_page_name","profile_edit.tpl");
  } else {
    $smarty->assign("content_page_name","syserror.tpl");
  }
  $smarty->display(INDEX_TEMPLATE);
?>