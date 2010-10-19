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
  import('ActivityHelper');
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

  $sc = new SysConfig(new User($user->getUserId(), false));

  if ($request->getMethod()=="POST") {
    $cl_newpass  = $request->getParameter('newpass');
    $cl_newpass1  = $request->getParameter('newpass1');
    $cl_todate = $request->getAttribute("todate");
    $cl_lang_default = $request->getParameter('lang_default');
    $cl_show_world_clock = $request->getParameter('show_world_clock');

    $cl_custom_format_date = $request->getParameter('format_date');
    $cl_custom_format_time = $request->getParameter('format_time');
    $cl_custom_timestring = $request->getParameter('timestring');
    $cl_start_week = $request->getParameter('start_week');
  } else {
    $cl_todate = $sc->getValue(SYSC_LOCK_DAYS);
		if (!$cl_todate) $cl_todate = 0;
    $cl_lang_default = $sc->getValue('lang_default');
    if (empty($cl_lang_default)) {
      $cl_lang_default = '';
    }
    $cl_show_world_clock = $sc->getValue('show_world_clock');
    if ($cl_show_world_clock === null) {
      $cl_show_world_clock = true;
    } else {
      $cl_show_world_clock = (bool)$cl_show_world_clock;
    }

    $cl_custom_format_date = $sc->getValue('format_date');
    $cl_custom_format_time = $sc->getValue('format_time');
    $cl_custom_timestring = $sc->getValue('timestring');
    $cl_start_week = intval($sc->getValue('start_week'));
  }

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
  $longname_lang = array_merge(array(array("id" => "", "name" => $i18n->getKey('form.admin.lang_browser_default'))), $longname_lang);

  // set defaults for datetime formats if needed
  if (empty($cl_custom_format_date)) {
    $cl_custom_format_date = DATE_FORMAT_DEFAULT;
  }
  if (empty($cl_custom_format_time)) {
    $cl_custom_format_time = TIME_FORMAT_DEFAULT;
  }
  if (empty($cl_custom_timestring)) {
    $cl_custom_timestring = DATE_FORMAT_DEFAULT;
  }

  // prepare start week day choices
  if ($cl_start_week < 0 || $cl_start_week > 6) {
    $cl_start_week = 0;
  }
  $start_week_options = array();
  foreach ($i18n->getWeekDayNames() as $id => $week_dn) {
    $start_week_options[] = array('id' => $id, 'name' => $week_dn);
  }

  $form = new Form('serviceForm');
  $form->addInput(array("type"=>"text","aspassword"=>true,"maxlength"=>"30","name"=>"newpass","style"=>"width: 150px;","value"=>@$cl_newpass));
  $form->addInput(array("type"=>"text","aspassword"=>true,"maxlength"=>"30","name"=>"newpass1","style"=>"width: 150px;","value"=>@$cl_newpass1));
  $form->addInput(array("type"=>"text","maxlength"=>"20","name"=>"todate","style"=>"width: 150px;","value"=>@$cl_todate));
  $form->addInput(array("type"=>"combobox","name"=>"lang_default","style"=>"width: 150px;","data"=>$longname_lang,"datakeys"=>array("id","name"),"value"=>@$cl_lang_default));
  $form->addInput(array("type"=>"checkbox","name"=>"show_world_clock","data"=>"1","value"=>@$cl_show_world_clock));

  $form->addInput(array("type"=>"combobox","name"=>"format_date","style"=>"width: 150px;","data"=>$DATE_FORMAT_OPTIONS,"datakeys"=>array("id","name"),"value"=>@$cl_custom_format_date,
    "onchange"=>'SetCustomDateTimeFormatPreview(&quot;custom_date_format_preview&quot;, this);'));
  $form->addInput(array("type"=>"combobox","name"=>"format_time","style"=>"width: 150px;","data"=>$TIME_FORMAT_OPTIONS,"datakeys"=>array("id","name"),"value"=>@$cl_custom_format_time,
    "onchange"=>'SetCustomDateTimeFormatPreview(&quot;custom_time_format_preview&quot;, this);'));

  $form->addInput(array("type"=>"combobox","name"=>"start_week","style"=>"width: 150px;","data"=>$start_week_options,"datakeys"=>array("id","name"),"value"=>@$cl_start_week));

  $form->addInput(array("type"=>"submit","name"=>"btsubmit","value"=>$i18n->getKey('button.submit')));

  if ($request->getMethod()=="POST") {
    if ($cl_newpass) {
      $validator = new Validator($cl_newpass);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      if (!$validator->isValid()) {
        $errors->add("password",$i18n->getKey("errors.wrong"),$i18n->getKey("form.admin.password"));
      }

      $validator = new Validator($cl_newpass1);
      $validator->validateSpaceString();
      $validator->validateEmptyString();
      if (!$validator->isValid()) {
        $errors->add("password1",$i18n->getKey("errors.wrong"),$i18n->getKey("form.admin.password_confirm"));
      } elseif (!($cl_newpass === $cl_newpass1)) {
        $errors->add("passwords",$i18n->getKey("errors.compare"),$i18n->getKey("form.admin.password"),$i18n->getKey("form.admin.password_confirm"));
      }
    }

    // lock period validate
    $validator = new Validator($cl_todate);
		$validator->validateSpaceString();
		$validator->validateEmptyString();
		$validator->validateInteger();
		if (!$validator->isValid()) {
			$errors->add("period", $i18n->getKey("errors.wrong"), $i18n->getKey("form.admin.lock.period"));
		}

    if ($errors->isEmpty()) {
      $ok = true;
      if ($cl_newpass)
        $ok = $ok && UserHelper::setPassword($user->getUserId(), $cl_newpass);
      $ok = $ok && $sc->setValue(SYSC_LOCK_DAYS, $cl_todate);
      $ok = $ok && $sc_a->setValue('lang_default', $cl_lang_default);
      $ok = $ok && $sc_a->setValue('show_world_clock', $cl_show_world_clock);

      $ok = $ok && $sc->setValue('format_date', $cl_custom_format_date);
      $ok = $ok && $sc->setValue('format_time', $cl_custom_format_time);
      $ok = $ok && $sc->setValue('timestring', $cl_custom_timestring);
      $ok = $ok && $sc->setValue('start_week', $cl_start_week);

      if ($ok) {
        Header("Location: admin.php");
        exit();
      } else
        $errors->add("addact",$i18n->getKey("errors.db_error"));
    }
  } // post

  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign("forms",array($form->getName()=>$form->toArray()));
  $smarty->assign("title_page",$i18n->getKey("form.admin.options"));
  $smarty->assign("content_page_name","admin_services.tpl");
  $smarty->assign('js_date_cur_locale', $i18n->getLang());
  $smarty->display(INDEX_TEMPLATE);
?>