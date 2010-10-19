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
  import('SysConfig');
  import('form.check.Validator');

  if ($auth->isAuthenticated()) {
    $user = new User($auth->getUserId());
  } else {
    Header("Location: login.php");
    exit();
  }

  $ud = UserHelper::findUserById($user->getUserId(),$user);

  $user_arr = UserHelper::findUserByLogin("admin");
  $sc_a = new SysConfig(new User($user_arr["u_id"], false));
  $sc = new SysConfig(new User($user->getUserId(), false));
  if ($user->isManager()) {
    $sc_m = $sc;
  } else {
    $sc_m = new SysConfig(new User($user->getOwnerId(), false));
  }

  $cl_lang_allow_user_change = $sc_m->getValue('lang_allow_user_change');
  if ($cl_lang_allow_user_change !== '0' && $cl_lang_allow_user_change !== '1') {
    $cl_lang_allow_user_change = true;
  } else {
    $cl_lang_allow_user_change = (bool)$cl_lang_allow_user_change;
  }
  $cl_password1 = null;

  $can_change_login = $user->isAdministrator() || $user->isManager() || $user->isCoManager();
  $cl_new_login = null;

  $show_world_clock = $sc_a->getValue('show_world_clock');
  if (is_null($show_world_clock)) {
    $show_world_clock = true;
  }
  $can_hide_world_clock = (bool)$show_world_clock;

  $can_set_custom_datetime_formats = $user->isAdministrator() || $user->isManager();
  $cl_start_week_is_default = false;

  if ($request->getMethod()=="POST") {
    $cl_name  = $request->getParameter('uname');
    $cl_name  = trim($cl_name);

    if ($can_change_login) {
      $cl_new_login  = $request->getParameter('login');
      $cl_new_login  = trim(strtolower($cl_new_login));
    }

    if (!$auth->isPasswordExternal()) {
      $cl_password1  = $request->getParameter('pas1');
      $cl_password2  = $request->getParameter('pas2');
    }

    $cl_email = $request->getParameter('email');
    $cl_company  = $request->getParameter('comp');
    $cl_www    = $request->getParameter('www');
    $cl_currency = $request->getParameter('curr');
    if (!$cl_currency) $cl_currency = 'US$';
    $cl_locktime = $request->getParameter('locktime');

    $cl_show_pie = $request->getParameter('show_pie');
    $cl_pie_mode = $request->getParameter('pie_mode');

    if ($user->isManager() || $cl_lang_allow_user_change) {
      $cl_lang = $request->getParameter('lang');
    } else {
      $cl_lang = null;
    }
    if ($user->isManager()) {
      $cl_lang_set_to_all = (bool)$request->getParameter('lang_set_to_all');
      $cl_lang_allow_user_change = (bool)$request->getParameter('lang_allow_user_change');
    } else {
      $cl_lang_set_to_all = null;
      $cl_lang_allow_user_change = null;
    }

    if ($can_set_custom_datetime_formats) {
      $cl_custom_format_date = $request->getParameter('format_date');
      $cl_custom_format_time = $request->getParameter('format_time');
      $cl_custom_timestring = $request->getParameter('timestring');
      $cl_start_week = $request->getParameter('start_week');
    }

    if ($can_hide_world_clock) {
      $cl_hide_world_clock = $request->getParameter('hide_world_clock');
    }
  } else {
    $cl_name  = $ud["u_name"];
    if (!$auth->isPasswordExternal()) {
      $cl_password1 = $cl_password2 = @$ud["u_password"];
    }
    $cl_email = $ud['u_email'];
    $cl_company = $ud["c_name"];
    $cl_www = $ud["c_www"];
    $cl_currency = ( $ud["c_currency"]=="" ? "US$" : $ud["c_currency"]);
    $cl_locktime = "";
    if($ud["c_locktime"]>=0) {
      $cl_locktime = $ud["c_locktime"];
    } else {
      $cl_locktime = $sc_a->getValue(SYSC_LOCK_DAYS);
      if (!$cl_locktime) $cl_locktime = 0;
    }
    $cl_show_pie = $ud['u_show_pie'];
    $cl_pie_mode = $ud['u_pie_mode'];

    $cl_lang = $ud['u_lang'];

    $cl_lang_set_to_all = false;
    if (!$cl_lang)
      $cl_lang = '';

    if ($can_set_custom_datetime_formats) {
      $cl_custom_format_date = $sc_m->getValue('format_date');
      $cl_custom_format_time = $sc_m->getValue('format_time');
      $cl_custom_timestring = $sc_m->getValue('timestring');

      $cl_start_week = $sc->getValue('start_week');
      if (is_null($cl_start_week) || $cl_start_week === false) {
        $cl_start_week = $sc_a->getValue('start_week');
        $cl_start_week_is_default = true;
      }
      $cl_start_week = intval($cl_start_week);
    }

    if ($can_hide_world_clock) {
      $cl_hide_world_clock = $sc_m->getValue('hide_world_clock');
    }
  }

  // did not set new login so user cannot change it
  if (is_null($cl_new_login)) {
    $cl_new_login = $ud['u_login'];
  }

  $form = new Form('profileForm');
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"uname","value"=>$cl_name));
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"login","value"=>$cl_new_login, "enable" => $can_change_login));
  if (!$auth->isPasswordExternal()) {
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas1","aspassword"=>true,"value"=>$cl_password1));
    $form->addInput(array("type"=>"text","maxlength"=>"30","name"=>"pas2","aspassword"=>true,"value"=>$cl_password2));
  }
  $form->addInput(array("type"=>"text","maxlength"=>"100","name"=>"email","value"=>$cl_email));
  $form->addInput(array("type"=>"text","maxlength"=>"200","name"=>"comp","value"=>$cl_company));
  $form->addInput(array("type"=>"text","maxlength"=>"250","name"=>"www","value"=>$cl_www));
  $form->addInput(array("type"=>"text","maxlength"=>"10","name"=>"curr","value"=>$cl_currency));
  $form->addInput(array("type"=>"text","maxlength"=>"10","name"=>"locktime","value"=>$cl_locktime));
  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.save')));

  $form->addInput(array("type"=>"checkbox","name"=>"show_pie","data"=>1,"value"=>'show pie charts'));
  $form->setValueByElement("show_pie", $cl_show_pie);

  $form->addInput(array("type"=>"combobox", "name"=>"pie_mode", "value"=>$cl_pie_mode,
     "data"=>array(1=>$i18n->getKey('form.activity.act_title'), 2=>$i18n->getKey('form.project.proj_title'))));

  // add languages
  if (is_array($lang_files)) {
    foreach ($lang_files as $lfile) {
      $content = file(RESOURCE_DIR."/".$lfile);
      $lname = "";
      foreach ($content as $line) {
        if (strstr($line, "i18n_language_name")) {
          $a = split("=",$line);
          $lname = trim(str_replace(";","",str_replace("'","",str_replace("\"","",$a[1]))));
          break;
        }
      }
      unset($content);
      if (!$lname) {
        $lname = substr($lfile,0,2);
      }
      $longname_lang[] = array("id"=>I18n::getLangFromFilename($lfile), "name"=>$lname);
    }
  }
  $longname_lang = mu_sort($longname_lang, "name");
  $longname_lang = array_merge(array(array("id" => "", "name" => $i18n->getKey('form.profile.lang_browser_default'))), $longname_lang);
  $form->addInput(array("type"=>"combobox","name"=>"lang","style"=>"width: 150","data"=>$longname_lang,"datakeys"=>array("id","name"),"value"=>@$cl_lang));

  if ($user->isManager()) {
    $form->addInput(array("type"=>"checkbox","name"=>"lang_set_to_all","data"=>1,"value"=>'set this language to all users'));
    $form->setValueByElement("lang_set_to_all", $cl_lang_set_to_all);
    $form->addInput(array("type"=>"checkbox","name"=>"lang_allow_user_change","data"=>1,"value"=>'allow users to change their language'));
    $form->setValueByElement("lang_allow_user_change", $cl_lang_allow_user_change);
  }

  if ($can_set_custom_datetime_formats) {

    // callback function for array_walk - appends '(default)' string
    // to default format
    function markDefaultFormat(&$item, $key, $format)
    {
      if ($item['id'] == $format) {
        $item['name'] = $item['name'].' '.$GLOBALS['i18n']->getKey('form.profile.default_format');
      }
    }

    function formatInArray(&$array, $format)
    {
      foreach ($array as $v) {
        if ($v['id'] == $format) {
          return true;
        }
      }
      return false;
    }

    $tmp_arr = $DATE_FORMAT_OPTIONS;
    if (empty($cl_custom_format_date)) {
      $cur_fmt = $i18n->getDateFormat();
      $cl_custom_format_date = $cur_fmt;
      array_walk($tmp_arr, 'markDefaultFormat', $cur_fmt);
    }
    if (!formatInArray($tmp_arr, $cl_custom_format_date)) {
      $tmp_arr[] = array('id' => $cl_custom_format_date, 'name' => '('.str_replace('%', '', $cl_custom_format_date.')'));
    }
    $form->addInput(array("type"=>"combobox","name"=>"format_date","style"=>"width: 150px;","data"=>$tmp_arr,"datakeys"=>array("id","name"),"value"=>@$cl_custom_format_date,
      "onchange"=>'SetCustomDateTimeFormatPreview(&quot;custom_date_format_preview&quot;, this);'));

    $tmp_arr = $TIME_FORMAT_OPTIONS;
    if (empty($cl_custom_format_time)) {
      $cur_fmt = $i18n->getTimeFormat();
      $cl_custom_format_time = $cur_fmt;
      array_walk($tmp_arr, 'markDefaultFormat', $cur_fmt);
    }
    if (!formatInArray($tmp_arr, $cl_custom_format_time)) {
      $tmp_arr[] = array('id' => $cl_custom_format_time, 'name' => '('.str_replace('%', '', $cl_custom_format_time.')'));
    }
    $form->addInput(array("type"=>"combobox","name"=>"format_time","style"=>"width: 150px;","data"=>$tmp_arr,"datakeys"=>array("id","name"),"value"=>@$cl_custom_format_time,
      "onchange"=>'SetCustomDateTimeFormatPreview(&quot;custom_time_format_preview&quot;, this);'));

    $smarty->assign('js_date_cur_locale', $i18n->getLang());

    // prepare start week day choices
    if ($cl_start_week < 0 || $cl_start_week > 6) {
      $cl_start_week = 0;
    }
    $start_week_options = array();
    foreach ($i18n->getWeekDayNames() as $id => $week_dn) {
      $start_week_options[] = array('id' => $id, 'name' => $week_dn);
    }
    if ($cl_start_week_is_default) {
      $start_week_options[$cl_start_week]['name'] .= ' '.$GLOBALS['i18n']->getKey('form.profile.default_format');
    }
    $form->addInput(array("type"=>"combobox","name"=>"start_week","style"=>"width: 150px;","data"=>$start_week_options,"datakeys"=>array("id","name"),"value"=>@$cl_start_week));
  }

  if ($can_hide_world_clock) {
    $form->addInput(array("type"=>"checkbox","name"=>"hide_world_clock","data"=>1,"value"=>@$cl_hide_world_clock));
  }

  if ($request->getMethod()=="POST") {

    $validator = new Validator($cl_name);
    $validator->validateSpaceString();
    $validator->validateEmptyString();
    if (!$validator->isValid()) {
      $errors->add("name",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.name"));
    }

    if ($can_change_login) {
      $validator = new Validator($cl_new_login);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      $validator->validateEmail();
      if (!$validator->isValid()) {
        $errors->add("login",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.login"));
      }
    }

    if ($auth->isPasswordExternal() && ($cl_password1 || $cl_password2)) {
      $validator = new Validator($cl_password1);
      //$validator->validateSpaceString();
      $validator->validateEmptyString();
      //$validator->validateLatinCharset();
      if (!$validator->isValid()) {
        $errors->add("password",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.pas1"));
      }
      if (!($cl_password1 === $cl_password2))
        $errors->add("password",$i18n->getKey("errors.compare"),$i18n->getKey("form.profile.pas1"),$i18n->getKey("form.profile.pas2"));
    }

    if ($user->isManager()){
      $validator = new Validator($cl_company);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      if (!$validator->isValid()) {
        $errors->add("company",$i18n->getKey("errors.wrong"),$i18n->getKey("form.profile.comp"));
      }
    }

    if ($cl_locktime!=null) {
      $validator = new Validator($cl_locktime);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      $validator->validateInteger();
      if (!$validator->isValid()) {
        $errors->add("period",$i18n->getKey("errors.wrong"),$i18n->getKey("form.admin.lock.period"));
      }
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
      //if (UserHelper::findUserByLogin($cl_new_login)) {
        if ($cl_locktime==null || trim($cl_locktime)=="")
          $cl_locktime = -1;

        if ($user->isManager()) {
          if ($cl_lang_allow_user_change !== null) {
            $sc_m->setValue('lang_allow_user_change', (int)$cl_lang_allow_user_change);
          }
        }
        if (empty($cl_lang)) {
          // browser default language
          $cl_lang = "";
        }

        if ($can_set_custom_datetime_formats) {
          $sc_m->setValue('format_date', $cl_custom_format_date);
          $sc_m->setValue('format_time', $cl_custom_format_time);
          $sc_m->setValue('timestring', $cl_custom_timestring);
          $sc_m->setValue('start_week', $cl_start_week);
        }

        if ($can_hide_world_clock) {
          $sc_m->setValue('hide_world_clock', $cl_hide_world_clock);
        }

        if (UserHelper::updateAccount($user, array(
            'name' => $cl_name,
            'login' => $cl_new_login,
            'password' => $cl_password1,
            'company' => $cl_company,
            'company_www' => $cl_www,
            'currency' => $cl_currency,
            'locktime' => $cl_locktime,
            'show_pie' => $cl_show_pie,
            'pie_mode' => $cl_pie_mode,
            'lang' => $cl_lang,            
            'email' => $cl_email),
            array('lang_set_to_all' => $cl_lang_set_to_all))) {          
          $user->setUserId($user->getUserId()); // reload personal data
          Header("Location: mytime.php");
          exit();
        } else {
          $errors->add("newprofile",$i18n->getKey("errors.prof_error"));
        }
      /*} else
        $errors->add("newprofile",$i18n->getKey("errors.no_user"));*/
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
  $smarty->assign('cl_lang_allow_user_change', $cl_lang_allow_user_change);
  $smarty->assign('can_change_login', $can_change_login);
  $smarty->assign('can_set_custom_datetime_formats', $can_set_custom_datetime_formats);
  $smarty->assign('can_hide_world_clock', $can_hide_world_clock);
  $smarty->display(INDEX_TEMPLATE);
?>