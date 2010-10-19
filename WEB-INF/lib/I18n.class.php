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
// | Contributors: Igor Melnik <igor.melnik@mail.ru>
// +----------------------------------------------------------------------+

class I18n {

    var $mLang = "en";
    var $mDefaultLang = "en";
    var $mLangRtl = false;
    var $cDateFormat = "d.m.Y";
    var $cDateTimeFormat = "d.m.Y H:i:s";
    var $cFloatDelimiter = ",";
    var $cTimeString = "";
    var $cMonthNames;
    var $cWeekDayNames;
    var $cWeekDayShortNames;
    var $cStartWeek;
    var $cHolidays;

    var $mKeys = array();
    var $mSourceDir = "";

    function I18n() {
      $this->mKeys["test"] = array("one"=>"word");
    }

    function setSourceDir($dir) {
      $this->mSourceDir = $dir;
    }

    function getKeys() {
      return $this->mKeys;
    }

    function getKey($kword) {
      $value = "";
      $pos = strpos($kword, ".");
    if (!($pos === false)) {
           $p = explode(".", $kword);
           $str = "";
           foreach ($p as $w) {
               $str .= "[\"".$w."\"]";
           }
           eval("\$value = @\$this->mKeys".$str.";");
    } else {
           @$value = $this->mKeys[$kword];
    }
      return $value;
    }

    function getLang()
    {
      return $this->mLang;
    }

    function getLangRtl() {
      return $this->mLangRtl;
    }

    function getDateFormat() {
      return $this->cDateFormat;
    }

    function getDateTimeFormat() {
      return $this->cDateTimeFormat;
    }

    function getTimeFormat()
    {
      return substr($this->cDateTimeFormat, strlen($this->cDateFormat) + 1);
    }

    function getFloatDelimiter() {
      return $this->cFloatDelimiter;
    }

    function getCharSet() {
      return 'utf-8';
    }

    function getTimeString() {
      return $this->cTimeString;
    }

    function getMonthName($id) {
      $id = intval($id);
      if ( isset($this->cMonthNames[$id]) )
        return $this->cMonthNames[$id];
      else
        return '';
    }

    function getMonthes() {
      return $this->cMonthNames;
    }

    function getWeekDayNames() {
      return $this->cWeekDayNames;
    }

    function getWeekDayShortNames() {
      return $this->cWeekDayShortNames;
    }

    function getWeekDayName($id) {
      $id = intval($id);
      return $this->cWeekDayNames[$id];
    }

    function load($localName) {
    $kw = array();
    $filename = strtolower($localName) . '.lang.php';
    $inc_filename = $this->mSourceDir . '/' . $this->mDefaultLang . '.lang.php';

    if (file_exists($inc_filename)) {
      include($inc_filename);

      $this->mLangRtl = @$i18n_language_rtl;
      $this->cMonthNames = $i18n_month;
        $this->cWeekDayNames = $i18n_week;
        $this->cWeekDayShortNames = $i18n_week_sn;
      $this->cFloatDelimiter = $i18n_float_delimiter;
      if (defined("SHOW_HOLIDAYS") && SHOW_HOLIDAYS == "true") {
        $this->cHolidays = @$i18n_holidays;
      }
      foreach ($i18n_key_words as $kword=>$value) {
         $pos = strpos($kword, ".");
         if (!($pos === false)) {
                   $p = explode(".", $kword);
                   $str = "";
                   foreach ($p as $w) {
                       $str .= "[\"".$w."\"]";
                   }
                   $value = str_replace("'","&rsquo;",$value);
                   eval("\$this->mKeys".$str."='".$value."';");
               } else {
                   $this->mKeys[$kword] = $value;
               }
      }
      $this->mKeys["float_delimiter"] = $i18n_float_delimiter;
    }

    $inc_filename = $this->mSourceDir . '/' . $filename;
    if (file_exists($inc_filename) && $localName!=$this->mDefaultLang) {
      require($inc_filename);

      $this->mLang = $localName;
      $this->mLangRtl = @$i18n_language_rtl;
      $this->cMonthNames = $i18n_month;
        $this->cWeekDayNames = $i18n_week;
        $this->cWeekDayShortNames = $i18n_week_sn;
      $this->cFloatDelimiter = $i18n_float_delimiter;
      if (defined("SHOW_HOLIDAYS") && SHOW_HOLIDAYS == "true") {
        $this->cHolidays = @$i18n_holidays;
      }
      foreach ($i18n_key_words as $kword=>$value) {
         if (!$value) continue;
         $pos = strpos($kword, ".");
         if (!($pos === false)) {
                   $p = explode(".", $kword);
                   $str = "";
                   foreach ($p as $w) {
                       $str .= "[\"".$w."\"]";
                   }
                   $value = str_replace("'","&rsquo;",$value);
                   eval("\$this->mKeys".$str."='".$value."';");
               } else {
                   $this->mKeys[$kword] = $value;
               }
      }
      $this->mKeys["float_delimiter"] = $i18n_float_delimiter;
        return true;
    }
  }

  function hasLang($lang)
  {
    $filename = $this->mSourceDir . '/' . strtolower($lang) . '.lang.php';
    return file_exists($filename);
  }

  function getBrowserLanguage()
  {
    $acclang = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];
    if (empty($acclang)) {
      return "";
    }
    $lang_prefs = split(',', $acclang);
    foreach ($lang_prefs as $lang_pref) {
      $lang_pref_parts = split(';', trim($lang_pref));
      $lang_parts = split('-', trim($lang_pref_parts[0]));
      $lang_main = $lang_parts[0];
      if ($this->hasLang($lang_main)) {
        return $lang_main;
      }
    }
    return "";
  }

  static function getLangFromFilename($filename)
  {
    return substr($filename, 0, strpos($filename, '.'));
  }
}
?>