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

// **** Errors
// Turn off all error reporting
// error_reporting(0);
//
// Report simple running errors
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
//
// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//
// Report all errors except E_NOTICE
// This is the default value set in php.ini
// error_reporting(E_ALL ^ E_NOTICE);
//
// Report all PHP errors (bitwise 63 may be used in PHP 3)
 if ( !defined('E_STRICT') ) define('E_STRICT', 2048);
 error_reporting(E_ALL ^ E_NOTICE);
//

// **** Path
//
  define("APP_DIR",    dirname(__FILE__));
  define("LIBRARY_DIR",  APP_DIR."/WEB-INF/lib");
  define("TEMPLATE_DIR",  APP_DIR."/WEB-INF/templates");
  define("RESOURCE_DIR",  APP_DIR."/WEB-INF/resources");

  define("COOKIE_EXPIRE",  60*60*24*30); // expire in 30 days
  define("DELETED", "1000");  // Status value for deleted users, projects, etc.

  require_once("WEB-INF/config.php");
  // Checks for the configuration
  if (!defined("DSN")) {
    die ("Emergency situation! No main configuration file. Please check file 'config.php'<br>\n");
  }
  if ( !isset($GLOBALS['AUTH_MODULE_PARAMS']) || !is_array($GLOBALS['AUTH_MODULE_PARAMS']) )
    $GLOBALS['AUTH_MODULE_PARAMS'] = array();

  date_default_timezone_set( @date_default_timezone_get() );
  require_once(LIBRARY_DIR.'/common.lib.php');
  //import('strutsphp.Controller');

  load_dl('mbstring');

  // Strip slashes when magic_quotes on.
  magic_quotes_off();

// **** HTTP Request
//
  import('html.HttpRequest');
  $request = new HttpRequest();

  // **** Errors
   import('form.ActionErrors');
  $errors = new ActionErrors();
  $messages = new ActionErrors();


// **** Authorization
//
// must be here, for correct restore from session
//
  import('Auth');
  import('User');
  @session_start();

// **** Smarty initialization
//
  import('smarty.Smarty');
  $smarty=new Smarty;
  $smarty->use_sub_dirs = false;
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = TEMPLATE_DIR . '_c';
//    $smarty->debugging = true;
  $GLOBALS["SMARTY"] = & $smarty;

// **** Auth class create

  $auth = Auth::factory(AUTH_MODULE, $GLOBALS['AUTH_MODULE_PARAMS']);

// **** SysConfig

  import('SysConfig');

// **** Localization
//

  import('I18n');
  $i18n = new I18n();
  $i18n->setSourceDir(RESOURCE_DIR);

  $user_id = $auth->getUserId();
  $user_arr = UserHelper::findUserByLogin("admin");
  $sc_a = new SysConfig(new User($user_arr["u_id"], false));

  $lang = '';

  // try to get lang from user's db settings
  if ($user_id) {
    $mdb2 = getConnection();
    $sql = 'SELECT u_lang FROM users WHERE u_id='.$user_id;
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      $lang = $val['u_lang'];
    };
  }

  // try to get default value
  if (!$lang) {
    $lang = $sc_a->getValue('lang_default');
  }
  // get browser's language preferences
  if (!$lang) {
    $lang = $i18n->getBrowserLanguage();
  }
  // finally - English is the default
  if (!$lang) {
    $lang = 'en';
  }

  /*$lang = @$_SESSION["stored_lang"];
  if (!$lang) $lang = @$_COOKIE['stored_lang'];*/

  /*$new_lang = $request->getParameter('lng');
  if ($new_lang != '') {
    $lang = $new_lang;
  }
  if ($lang == '') $lang = 'en';
  $_SESSION["stored_lang"] = $lang;

  if ($request->getMethod()!="POST") {
    setcookie("stored_lang", $lang, time()+COOKIE_EXPIRE);
  }*/

  // load i18n file

  $i18n->load($lang);
  define("CHARSET", "utf-8");
   //define("CHARSET",$i18n->getCharSet());
  $GLOBALS["I18N"] = &$i18n;

  init_setup_custom_datetime_formats(!empty($user_id));

  // set i18n to smarty

  $smarty->assign("i18n",$i18n->getKeys());
  $smarty->assign_by_ref("errors", $errors);
  $smarty->assign_by_ref("messages", $messages);

  //WR Localizations Service
  $lang_files = getFileList(RESOURCE_DIR, "^(.*\.lang\.php)$", "^(CVS|\..*)$");
  $available_languages = "";
  if (is_array($lang_files)) {
    foreach ($lang_files as $lfile) {
      if(!$available_languages) {
        $available_languages = I18n::getLangFromFilename($lfile);
      } else {
        $available_languages .= ",".I18n::getLangFromFilename($lfile);
      }
    }
  }
  define("AVAILABLE_LANG", $available_languages);
  $smarty->assign("available_languages",array_slice(split(",",AVAILABLE_LANG),0,3));
  $smarty->assign('auth_is_password_external', $auth->isPasswordExternal());

  // 'show world clock' admin config
  init_show_world_clock(!empty($user_id));

  // setup javascript strftime localization
  init_setup_js_strftime_i18n();

  ///// helper init functions

  function init_show_world_clock($userIsAuth)
  {
    global $auth, $smarty;

    $user_arr = UserHelper::findUserByLogin("admin");
    $sc_a = new SysConfig(new User($user_arr["u_id"], false));
    $show_world_clock = $sc_a->getValue('show_world_clock');
    if (is_null($show_world_clock)) {
      $show_world_clock = true;
    } else {
      $show_world_clock = (bool)$show_world_clock;
    }

    if ($show_world_clock && $userIsAuth) {
      $user = new User($auth->getUserId());
      if (!$user->isAdministrator()) {
        if ($user->isManager()) {
          $sc_m = new SysConfig(new User($user->getUserId(), false));
        } else {
          $sc_m = new SysConfig(new User($user->getOwnerId(), false));
        }
        $hide_world_clock = $sc_m->getValue('hide_world_clock');
        if (!is_null($hide_world_clock)) {
          $show_world_clock = !((bool)$hide_world_clock);
          //var_dump($show_world_clock);
        }
      }
    }

    $smarty->assign('show_world_clock', $show_world_clock);
  }

  function init_setup_custom_datetime_formats($userIsAuth)
  {
    global $i18n, $auth;

    $custom_format_date = null;
    $custom_format_time = null;
    $custom_timestring = null;
    $start_week = null;

    // setup custom date and time formats (priority user's manager (user's if user is manager) -> admin -> default in config)

    // try manager
    if ($userIsAuth) {
      $user = new User($auth->getUserId());
      if ($user->isManager()) {
        $sc_m = new SysConfig(new User($user->getUserId(), false));
      } else {
        $sc_m = new SysConfig(new User($user->getOwnerId(), false));
      }
      $custom_format_date = $sc_m->getValue('format_date');
      $custom_format_time = $sc_m->getValue('format_time');
      $custom_timestring = $sc_m->getValue('timestring');
      $start_week = $sc_m->getValue('start_week');
    }

    // try admin
    $user_arr = UserHelper::findUserByLogin("admin");
    $sc_a = new SysConfig(new User($user_arr["u_id"], false));

    if (empty($custom_format_date)) {
      $custom_format_date = $sc_a->getValue('format_date');
    }
    if (empty($custom_format_time)) {
      $custom_format_time = $sc_a->getValue('format_time');
    }
    if (empty($custom_timestring)) {
      $custom_timestring = $sc_a->getValue('timestring');
    }

    if (is_null($start_week) || $start_week === false) {
      $start_week = $sc_a->getValue('start_week');
    }

    // defaults
    if (empty($custom_format_date)) {
      $custom_format_date = DATE_FORMAT_DEFAULT;
    }
    if (empty($custom_format_time)) {
      $custom_format_time = TIME_FORMAT_DEFAULT;
    }
    if (empty($custom_timestring)) {
      $custom_timestring = DATE_FORMAT_DEFAULT;
    }

    // validate start week
    $start_week = intval($start_week);
    if ($start_week < 0 || $start_week > 6) {
      $start_week = 0;
    }

    // set
    $old_date_format = $i18n->cDateFormat;
    $i18n->cDateFormat = $custom_format_date;
    $i18n->cDateTimeFormat = $i18n->cDateFormat . " " . $custom_format_time;

    $i18n->cTimeString = $custom_timestring;

    $i18n->cStartWeek = $start_week;
  }

  function init_setup_js_strftime_i18n()
  {
    global $i18n, $smarty;
    $lang = $i18n->mLang;

    $days = $i18n->getWeekDayNames();
    $sdays = array();
    foreach($days as $k => $v) {
      $sdays[$k] = mb_substr($v, 0, 3, 'utf-8');
    }

    $months = $i18n->getMonthes();
    $smonths = array();
    foreach ($months as $k => $v) {
      $smonths[$k] = mb_substr($v, 0, 3, 'utf-8');
    }

    $js = "
      Date.ext.locales['$lang'] = {
        a: ['" . join("', '", $sdays) . "'],
        A: ['" . join("', '", $days) . "'],
        b: ['" . join("', '", $smonths) . "'],
        B: ['" . join("', '", $months) . "'],
        c: '%a %d %b %Y %T %Z',
        p: ['', ''],
        P: ['', ''],
        x: '%Y-%m-%d',
        X: '%T'
      };";
    $smarty->assign('js_date_locale', $js);
  }
?>