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

import('form.FormElement');
import('DateAndTime');

class Calendar extends FormElement {

    var $mLocation    = "";
    var $mHolidays    = array();
    var $mShowHolidays  = true;
    var $mMarkedDays  = array();
    var $mStartWeek    = 1;
    var $mDateFormat  = "%d/%m/%Y";
    var $mDateTimeFormat  = "%d/%m/%Y %H:%M:%S";
    var $mSysDateFormat  = "%d/%m/%Y"; // use for build URI parameters
    var $lToday      = "Today";

    var $mCommonCell    = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid White; color: #333333; background : #D9D9D9; background-color : #D9D9D9; font: 8pt;";
    var $mDayCell       = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid Silver; color: #333333; background : #ffffff; background-color : #ffffff; font: 8pt;";
    var $mDayCellActive = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid Silver; color: #666666; background : #A6CCF7; background-color : #A6CCF7; font: 8pt;";
        var $mDayCellWE     = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid Silver; color: #666666; background : #f7f7f7; background-color : #f7f7f7; font: 8pt;";
        var $mDayCellHolyday= "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid Silver; color: #666666; background : #f7f7f7; background-color : #f7f7f7; font: 8pt;";
        var $mDayCellMark   = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid White; color: #666666; background : #EEEEEE; background-color : #EEEEEE; font: 8pt;";
        var $mDayHeaderCell = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid White; color: #333333; font: 8pt;";
        var $mDayHeaderCellWE = "padding-bottom : 5px; padding-left : 5px; padding-right : 5px; padding-top : 5px; padding : 5px 5px 5px 5px; border : 1px solid White; color: #999999; font: 8pt;";

    var $mName          = "";
    var $mAllDays       = true;
    var $cClassName    = "Calendar";

    function Calendar($name) {
        $this->mName = $name;
        $this->mMonthNames = array('January','February','March','April','May','June','July','August','September','October','November','December');
        $this->mWeekDayNameChort= array("Sn","Mo","Tw","Th","Td","Fr","St");
    }

    function setLocalization($i18n) {
      FormElement::setLocalization($i18n);
      $this->mMonthNames    = $i18n->cMonthNames;
      $this->mWeekDayNameChort= $i18n->cWeekDayShortNames;
      if (is_array($i18n->cHolidays)) {
        foreach ($i18n->cHolidays as $fday) {
          $date_a = split("/",$fday); // input format d/m
          $this->mHolidays[] = mktime(0,0,0, $date_a[1], $date_a[0], date("Y"));// + 7200;
        }
      }
      $this->mStartWeek    = $i18n->cStartWeek;
      if ($i18n->getKey('label.today'))
        $this->lToday    = $i18n->getKey('label.today');
      $this->mDateFormat    = $i18n->getDateFormat();
      $this->mDateTimeFormat  = $i18n->getDateTimeFormat();
    }

    function setStyle($style) { $this->mStyle = $style; }
    function setCellStyle($style) { $this->mCellStyle = $style; }
    function setACellStyle($style) { $this->mACellStyle = $style; }
    function setLinkStyle($style) { $this->mLinkStyle = $style; }
    function setDateFormat($format) { $this->mDateFormat = $format;}
    function setSysDateFormat($format) { $this->mSysDateFormat = $format;}

    function setShowHolidays($value) {
      $this->mShowHolidays  = $value;
    }

    function setMarkedDays($list) {
        if (is_array($list) && count($list)>0) $this->mAllDays = false;
      foreach ($list as $day) {
        $this->mMarkedDays[$day["date"]] = $day["url"];
      }
    }

    /**
     * @return void
     * @param date
     * @desc Enter description here...
     */
    function toString($date="") {
      $indate = $this->mValue;
      if (!$indate) $indate = strftime($this->mSysDateFormat);

      if (!$this->isRenderable()) return "";

      //current year and month
      if ( strlen ( $indate ) > 0 ) {
        $indateObj = new DateAndTime($this->mSysDateFormat, $indate);
        $thismonth = $indateObj->getMonth();
        $thisyear = $indateObj->getYear();
      } else {
        $thismonth = date("m");
        $thisyear = date("Y");
      }

      // next date, month, year
      $next = mktime ( 2, 0, 0, $thismonth + 1, 1, $thisyear );
      $nextyear = date ( "Y", $next );
      $nextmonth = date ( "m", $next );
      $nextdate = strftime ( $this->mSysDateFormat, $next );

      // prev date, month, year
      $prev = mktime ( 2, 0, 0, $thismonth - 1, 1, $thisyear );
      $prevyear = date ( "Y", $prev );
      $prevmonth = date ( "m", $prev );
      $prevdate = strftime( $this->mSysDateFormat, $prev );

      $str = $this->_genStyles();

      $str .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr><td align="center"><div class="CalendarCommonCell">'.
          //'<a href="?date='.$prevyear.'">&lt;&lt;</a> '.
          '<a href="?date='.$prevdate.'">&lt;&lt;&lt;</a>  '.
          $this->mMonthNames[$thismonth-1].'&nbsp;'.$thisyear.
          '  <a href="?date='.$nextdate.'">&gt;&gt;&gt;</a>'.
          //' <a href="?date='.$nextyear.'">&gt;&gt;</a>'.
          '</div></td></tr>
          </table>';

      $str .= '<center>
          <table border="0" cellpadding="1" cellspacing="1" width="100%">
          <tr>';

      $str .= "<tr>";

      // calc sat and sun positions
      $we_sat = 6 - $this->mStartWeek;
      $we_sun = (7 - $this->mStartWeek) % 7;

      for ( $i=0; $i<7; $i++ ) {
        $weekdayNameIdx = ($i + $this->mStartWeek) % 7;
        if ($i==$we_sat || $i==$we_sun) {
          $str .= '<td class="CalendarDayHeaderCellWE">'.$this->mWeekDayNameChort[$weekdayNameIdx].'</td>';
        } else {
          $str .= '<td class="CalendarDayHeaderCell">'.$this->mWeekDayNameChort[$weekdayNameIdx].'</td>';
        }
      }

      $str .= "</tr>\n";

      list($wkstart,$monthstart,$monthend,$start_date) = $this->_getWeekDayBefore( $thisyear, $thismonth );

      $project_date = $this->_getProject($monthstart, $monthend);

      for ( $i = $wkstart; $i<=$monthend;  $i=mktime(0,0,0,$thismonth,$start_date+=7,$thisyear) ) {
        $str .= "<TR>\n";
          for ( $j = 0; $j < 7; $j++ ) {
            $date = mktime(0,0,0,$thismonth,$start_date+$j,$thisyear);
            if ( $date >= $monthstart && $date <= $monthend ) {

            $stl_cell = "";
            $stl_link = "";

            // weeekend
            if ($j==$we_sat || $j==$we_sun) {
              $stl_cell = ' class="CalendarDayCellWE"';
              $stl_link = ' class="CalendarLinkWE"';
            } else {
              $stl_cell = ' class="CalendarDayCell"';
            }

              // holidays
              if ($this->mShowHolidays) {
              foreach ($this->mHolidays as $day) {
                if($day == $date) {
                  $stl_cell = ' class="CalendarDayHolyday"';
                  $stl_link = ' class="CalendarLinkHolyday"';
                }
              }
            }

            // selected day
            if ( $indate == strftime($this->mSysDateFormat,$date))
              $stl_cell = ' class="CalendarDayCellActive"';


            $str .= '<td'.$stl_cell.'>';

            // project exist
            if($project_date) {
              if( in_array(strftime($this->mSysDateFormat, $date), $project_date) )
                $stl_link = ' class="'.CALENDAR_PROJECT_CLASS.'"';
            }

            if ($this->mAllDays) {
              $str .= "<a".$stl_link." href=\"?".$this->mName."=".strftime($this->mSysDateFormat,$date)."\">".date("d",$date)."</a>";
            } elseif ($this->mMarkedDays[ strftime($this->mSysDateFormat,$date) ] ) {
                $stl_link = ' class="CalendarDayMark"';
                $str .= "<a".$stl_link." href=\"".$this->mMarkedDays[strftime($this->mSysDateFormat,$date)]."\">".date("d",$date)."</a>";
            }
            else {
              $str .= date("d",$date);
            }

            $str .= "</TD>";
          }
          else {
            $str .= "<TD>&nbsp;</TD>\n";
          }
        }
        $str .= "</TR>\n";
      }

      $now_time = new DateAndTime($this->mDateFormat);
      $now_time = $now_time->toString();
      $str .= "<tr><td colspan=\"7\" align=\"center\"><a id=\"today_link\" href=\"?".$this->mName."=".strftime($this->mSysDateFormat)."\">".$this->lToday."</a><div id=\"calendar_now_time\">".$now_time."</div></td></tr>\n";

      $str .= "</table>\n";
      $str .= "<SCRIPT LANGUAGE=\"JavaScript\">\n";
      $str .= "function getRefToDiv(divID) {\n";
        $str .= "if( document.layers ) { //Netscape layers\n";
          $str .= "\treturn document.layers[divID]; }\n";
        $str .= "if( document.getElementById ) { //DOM; IE5, NS6, Mozilla, Opera\n";
          $str .= "\treturn document.getElementById(divID); }\n";
        $str .= "if( document.all ) { //Proprietary DOM; IE4\n";
          $str .= "\treturn document.all[divID]; }\n";
        $str .= "if( document[divID] ) { //Netscape alternative\n";
          $str .= "\treturn document[divID]; }\n";
        $str .= "return false;\n";
      $str .= "}\n\n";

      $str .= "function chContent(myReference, chText) {\n";
      $str .= "if (myReference) if(typeof( myReference.innerHTML ) != 'undefined' ) {\n";
        $str .= "\t//used by the IE series, Konqueror, Opera 7+ and Gecko browsers\n";
        $str .= "\tmyReference.innerHTML = chText;\n";
      $str .= "} else {\n";
        $str .= "if( myReference.document && myReference.document != window.document ) {\n";
        $str .= "\t//used by layers browsers\n";
        $str .= "\tmyReference.document.open();\n";
        $str .= "\tmyReference.document.write(chText);\n";
        $str .= "\tmyReference.document.close();\n";
        $str .= "} else {\n";
        $str .= "\tif( window.frames && window.frames.length && window.frames['nameOfIframe'] ) {\n";
          $str .= "\t\t//used by browsers like Opera 6-\n";
          $str .= "\t\t//if we attempt to rewrite the iframe content before\n";
          $str .= "\t\t//it has loaded we will only produce errors\n";
          $str .= "\t\tmyReference = window.frames['nameOfIframe'].window;\n";
          $str .= "\t\tmyReference.document.open();\n";
          $str .= "\t\tmyReference.document.write(chText);\n";
          $str .= "\t\tmyReference.document.close();\n";
        $str .= "\t}\n";
        $str .= "\t}\n";
      $str .= "}\n}\n";

      $str .= "function changeLinkHref(id,newHref) {\n";
        $str .= "if (document.links.length > 0) {\n";
        $str .= "if (document.getElementById) {\n";
          $str .= "document.getElementById(id).href = newHref;\n";
        $str .= "}\n";
        $str .= "else if (document.all) {\n";
          $str .= "document.all[id].href = newHref;\n";
        $str .= "}\n}\n}\n";

        $str .= "function addZero(vNumber){ return ((vNumber < 10) ? '0' : '') + vNumber }\n";

        $str .= "function formatDate(vDate, vFormat){\n";
        if (isset($GLOBALS['i18n'])) {
          $str .= "vDate.locale = \"".$GLOBALS['i18n']->mLang."\";\n";
        }
        $str .= "return vDate.strftime(vFormat);\n";
        $str .= "}\n";



      $str .= "function calendar_clock() {\n";
      $str .= "var all=new Date();\n";
      $str .= "var hours=all.getHours();\n";
      $str .= "var minutes=all.getMinutes();\n";
      //$str .= "var timevalue=' ' + formatDate(all,'".$this->mDateTimeFormat."') + ' ' + ((hours>=12)?'p.m.':'a.m.');\n";
      $str .= "var timevalue=' ' + formatDate(all,'".$this->mDateTimeFormat."')\n";

      $str .= "changeLinkHref('today_link', '?".$this->mName."='+formatDate(all,'".$this->mSysDateFormat."'));\n";
      $str .= "chContent(getRefToDiv('calendar_now_time'), timevalue);\n";
      $str .= "var he = getRefToDiv('".$this->mName."_now'); he.value = timevalue;\n";
      $str .= "setTimeout('calendar_clock()', 1000);\n";
      $str .= "}\n";
      $str .= "</SCRIPT>\n";
      $str .= "<input type=\"hidden\" name=\"$this->mName\" value=\"$indate\">\n";
      $str .= "<input type=\"hidden\" id=\"".$this->mName."_now\" name=\"".$this->mName."_now\" value=\"$indate\">\n";
      $str .= "<script>calendar_clock();</script>\n";
      return $str;
    }

    function toStringControl() {
        return $this->toString();
    }

    function _getWeekDayBefore($year, $month) {
      $weekday = date ( "w", mktime ( 2, 0, 0, $month, 1 - $this->mStartWeek, $year ) );
      return array(
        mktime ( 0, 0, 0, $month, 1 - $weekday, $year ),
        mktime ( 0, 0, 0, $month, 1, $year ),
      mktime ( 0, 0, 0, $month + 1, 0, $year ),
      (1 - $weekday)
      );
    }

    function _genStyles() {
      $str = "<style>\n";
      $str .= ".CalendarCommonCell {". $this->mCommonCell  ."}\n";
      $str .= ".CalendarDayCell {". $this->mDayCell  ."}\n";
      $str .= ".CalendarDayCellActive {". $this->mDayCellActive  ."}\n";
      $str .= ".CalendarDayCellWE {". $this->mDayCellWE  ."}\n";
      $str .= ".CalendarDayHolyday {". $this->mDayCellHolyday  ."}\n";
      $str .= ".CalendarDayMark {". $this->mDayCellMark  ."}\n";
      $str .= ".CalendarDayHeaderCell {". $this->mDayHeaderCell  ."}\n";
      $str .= ".CalendarDayHeaderCellWE {". $this->mDayHeaderCellWE  ."}\n";
      $str .= ".CalendarLinkWE { color: #999999;}\n";
      $str .= ".CalendarLinkHolyday {color: #999999;}\n";
      $str .= ".CalendarLinkProject {color: #FF0000;}\n";
        $str .= "</style>\n";
        return $str;
    }
    function _getProject($start, $end) {
      global $user;

      if(isset($_SESSION['behalf_id']) AND $_SESSION['behalf_id']!='') {
        $user_id = $_SESSION['behalf_id'];
      }
      else
        $user_id = $user->getUserId();

      $mdb2 = getConnection();

      $start_date = date("Y-m-d", $start);
      $end_date = date("Y-m-d", $end);
      $sql = "SELECT al_date FROM activity_log WHERE al_date >= '$start_date' AND al_date <= '$end_date' AND al_user_id = ".$user_id;
      $res = &$mdb2->query($sql);
      if (PEAR::isError($res) == 0) {
        while ($row = $res->fetchRow()) {
          $out[] = date("m/d/Y", strtotime($row['al_date']));
        }
        return @$out;
      }
      else
        return false;
    }
}
?>