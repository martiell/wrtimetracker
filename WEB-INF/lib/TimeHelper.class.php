<?php
/** WR Time Tracker
*
* Copyright (c) 2004-2006 WR Consulting (http://wrconsulting.com)
*
* LIBERAL FREEWARE LICENSE: This source code document may be used
* by anyone for any purpose, and freely redistributed alone or in
* combination with other software, provided that the license is obeyed.
*
* There are only two ways to violate the license:
*
* 1. To redistribute this code in source form, with the copyright
*    notice or license removed or altered. (Distributing in compiled
*    forms without embedded copyright notices is permitted).
*
* 2. To redistribute modified versions of this code in *any* form
*    that bears insufficient indications that the modifications are
*    not the work of the original author(s).
*
* This license applies to this document only, not any other software
* that it may be combined with.
*
* Contributors: Igor Melnik <igor.melnik at mail.ru>
*
*/

// $Id: TimeHelper.class.php,v 1.20 2009/03/09 05:03:02 nokuntseff Exp $

import('DateAndTime');

/**
 * Class InvoiceHelper for manipulation with the Invoice data
 * @package TimeTracker
 */

class TimeHelper {

  /**
   * Convert date into date string
   * @param DateAndTime $crdate
   * @return string
   */
  static function parseTimeString($crdate) {
    return $crdate->toString($GLOBALS["I18N"]->getTimeString());
  }

  /**
   * Validates the time format
         * Acceptance formats
   * 1.  00:00 - 23:59
   * 2.  0:00 - 9:59
   * 3.  0 - 23
   * 4.  000 - 2359
   *
   * 0 or 000 means 00:00
   *
   * @param string $value
   * @return boolean
   */
  static function isValidTime($value) {
    if (strlen($value)==0 || !isset($value)) return false;
    if ($value=="24" || $value=="24:00" || $value=="2400") return true;
      if (preg_match("/^(([0-1]{0,1}[0-9]|[2][0-3])[0-5][0-9])$/", $value )) { // 000, 001 ... 100, .. 2200, 2300, 2359
          return true;
      }
      if (preg_match("/^([0-1]{0,1}[0-9]|[2][0-3])$/", $value )) { // 0, 1 ... 9, 10, .. 22, 23
          return true;
      }
      if (preg_match("/^([0-1]{0,1}[0-9]|[2][0-3])[:][0-5][0-9]$/", $value )) { // 0:59, 1:59, 01:59, 19:59, 23:59
          return true;
      }
        return false;
  }

  /**
   * Validates the duration format
   * @param string $value
   * @return boolean
   */
  static function isValidDuration($value) {
    if (strlen($value)==0 || !isset($value)) return false;
    if ($value=="24:00" || $value=="2400") return true;
    if (preg_match("/^(([0-1]{0,1}[0-9]|[2][0-3])[0-5][0-9])$/", $value )) { // 000, 001 ... 100, .. 2200, 2300, 2359
      return true;
    }
    if (preg_match("/^([0-9]{0,1}[0-9])$/", $value )) { // 0, 1 ... 9, 10, .. 99
      return true;
    }
    if (preg_match("/^([0-9]{0,1}[0-9])[:][0-5][0-9]$/", $value )) { // 0:59, 1:59, 01:59, 19:59, 23:59
      return true;
    }
    return false;
  }

  /**
   * Converts DateAndTime object to string format 00:00
   *
   * @param DateAndTime $value
   * @return string
   */
  static function normTimeString($value) {
    $time_a = split(":", $value);
    $res = "";

    // 0-99,
    if (strlen($value)>=1 && strlen($value)<=2 && !isset($time_a[1])) {
      $res = $value.":00";
    }

    // 000-2359 (2400)
    if (strlen($value)>=3 && strlen($value)<=4 && !isset($time_a[1])) {
      if (strlen($value)==3) $value = "0".$value;
        $res = substr($value,0,2).":".substr($value,2,2);
    }

    // 0:00-23:59 (24:00)
    if (strlen($value)>=4 && strlen($value)<=5 && isset($time_a[1])) {
      $time_a[1] = @$time_a[1] + 0;

      if (@$time_a[1] < 10 ) @$time_a[1] = "0$time_a[1]";
        $res = @$time_a[0].":".@$time_a[1];
    }

    return $res;
  }

  /**
   * Converts string to minutes
   *
   * @param string $value
   * @return int
   */
  static function toMinutes($value) {
    $time_a = split(":", $value);
    return (int)@$time_a[1] + ((int)@$time_a[0]) * 60;
  }

  /**
   * Calculates duration of time proceeding from beginning and end time
   * @param string $start
   * @param string $finish
   * @return string
   */
  static function toDuration($start, $finish) {
    $time_duration_min = TimeHelper::toMinutes($finish) - TimeHelper::toMinutes($start);
    if ($time_duration_min <= 0) return false;

    $time_duration[0] = $time_duration_min / 60;
    $some = split("[.,]", $time_duration[0]);
    $time_duration[0] = $some[0];
    $time_duration[1] = $time_duration_min - (int)$time_duration[0] * 60;

    if ($time_duration[1] < 10 ) {
      $time_duration[1] = "0$time_duration[1]";
    }
    return "$time_duration[0]:$time_duration[1]";
  }

  /**
   * Checks time interval
   *
   * @param string $start
   * @param string $finish
   * @return boolean
   */
  static function isCorrectTimeInterval($start, $finish) {
    $start = TimeHelper::normTimeString($start);
    $finish = TimeHelper::normTimeString($finish);
    $pair1 = split(":", $start);
    $pair2 = split(":", $finish);
    $val1 = (int)@$pair1[0] * 60 + (int)@$pair1[1];
    $val2 = (int)@$pair2[0] * 60 + (int)@$pair2[1];
    if ($val1 > $val2) {
      return false;
    } else {
      return true;
    }
  }

  /**
   * Updates time record in the database
   * @param array $fields
   * @return boolean
   */
  static function update($fields)
  {
    $mdb2 = getConnection();
             
    $date = $fields['date'];
    $ts = $fields['ts'];
    $user_id = $fields['user_id'];
    $project = $fields['project'];
    $activity = $fields['activity'];
    $start = $fields['start'];
    $finish = $fields['finish'];
    $duration = $fields['duration'];
    $note = $fields['note'];
    $billable = $fields['billable'];
    $start = TimeHelper::normTimeString($start);
    $finish = TimeHelper::normTimeString($finish);
    $duration = TimeHelper::normTimeString($duration);

    if (!$billable) $billable = 0;
    if ($start) $duration = "";

    $result = array();
          
    if ($duration) {
      $sql = "UPDATE activity_log set al_timestamp = '$ts', al_from = NULL, al_duration = '$duration', al_project_id = $project, al_activity_id = $activity, ".
        "al_comment = ".mdb2_quote($mdb2, $note).", al_billable = $billable, al_date = '$date' WHERE al_user_id = $user_id AND al_timestamp = '$ts'";
      $affected = &$mdb2->exec($sql);
      if(PEAR::isError($affected) != 0)
        return false;
    } else {
      $result = array();
      $duration = TimeHelper::toDuration($start, $finish);
      if ($duration === false)
        $duration = 0;
      $uncompleted = TimeHelper::findUncompletedRecord($user_id);
      if (!$duration && $uncompleted && ($uncompleted["al_timestamp"] != $ts))
        return false;

      $sql = "UPDATE activity_log SET al_timestamp = '$ts', al_from = '$start', al_duration = '$duration', al_project_id = $project, al_activity_id = $activity, ".
        "al_comment = ".mdb2_quote($mdb2, $note).", al_billable = $billable, al_date = '$date' WHERE al_user_id = $user_id AND al_timestamp = '$ts'";
      $affected = $mdb2->exec($sql);
      if (PEAR::isError($affected) != 0)
        return false;
    }

    $result[] = array("r_userid"=>$user_id,
      "r_date"=>$date,
      "r_duration"=>$duration,
      "r_project"=>$project,
      "r_activity"=>$activity,
      "r_note"=>$note,
      "r_billable"=>$billable
    );
    return $result;
  }

  /**
   * Inserts time record into the database
   * @param array $fields
   * @return boolean
   */
  static function insert($fields)
  {
    $mdb2 = getConnection();
  	      
    $date = $fields['date'];
    $user_id = $fields['user_id'];
    $project = $fields['project'];
    $activity = $fields['activity'];
    $start = $fields['start'];
    $finish = $fields['finish'];
    $duration = $fields['duration'];
    $note = $fields['note'];
    $billable = $fields['billable'];
    $timestamp = isset($fields['timestamp']) ? $fields['timestamp'] : '';
    $start = TimeHelper::normTimeString($start);
    if ($finish) $finish = TimeHelper::normTimeString($finish);
    $duration = TimeHelper::normTimeString($duration);

    if (!$timestamp) {
      $timestamp = date("YmdHis");//yyyymmddhhmmss
    }
        
    if (!$billable) $billable = 0;
    $result = array();
      
    if ($duration) {
      $sql = "insert into activity_log (al_timestamp, al_user_id, al_date, al_duration, al_project_id, al_activity_id, al_comment, al_billable) ".
        "values ('$timestamp', $user_id, '$date', '$duration', $project, $activity, ".mdb2_quote($mdb2, $note).", $billable)";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) != 0)
        return false;
    } else {
      $duration = TimeHelper::toDuration($start, $finish);
      if ($duration === false) $duration = 0;
      if (!$duration && TimeHelper::findUncompletedRecord($user_id)) return false;

      $sql = "insert into activity_log (al_timestamp, al_user_id, al_date, al_from, al_duration, al_project_id, al_activity_id, al_comment, al_billable) ".
        "values ('$timestamp', $user_id, '$date', '$start', '$duration', $project, $activity, ".mdb2_quote($mdb2, $note).", $billable)";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) != 0) {
        return false;
      }
    }
    $result[] = array("r_userid"=>$user_id,
      "r_date"=>$date,
      "r_duration"=>$duration,
      "r_project"=>$project,
      "r_activity"=>$activity,
      "r_note"=>$note,
      "r_billable"=>$billable
    );
    return $result;
  }

  /**
   * Deletes time record from database
   * @param int $user_id
   * @param string $ts
   * @return boolean
   */
  static function delete($user_id, $ts) {
    $mdb2 = getConnection();

    $sql = "delete from activity_log where al_user_id = $user_id and al_timestamp = '$ts'";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) == 0) {
      return true;
    }
    return false;
  }

  /**
   * Returns a total time for date
   * @param string $date
   * @param int $user_id
   * @return string
   */
  static function getTotalTime($date, $user_id) {
    $mdb2 = getConnection();

    $sql = "select sum(time_to_sec(al_duration)) as sm from activity_log where al_user_id = $user_id and al_date = '$date'";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return false;
  }

  /**
   * Returns a total time for activity
   * @param mixed $activity
   * @param int $user_id
   * @param Period $period
   * @param string $pie_mode
   * @return <type>
   */
  static function getTotalTimeByActivities($activity, $user_id, $period=null, $pie_mode=null) {
    $result = array();

    $mdb2 = getConnection();

    $in_list = "";
    if (is_array($activity)) {
      $in_list = join(",", $activity);
    } else {
      $in_list = $activity;
    }

    $q_period = "";
    if ($period!=null) {
      $q_period = " and al_date>='".$period->getBeginDate(DB_DATEFORMAT)."' and al_date<='".$period->getEndDate(DB_DATEFORMAT)."'";
    }

    if($pie_mode AND $pie_mode=="project")
      $sql = "SELECT al_project_id  AS `act_id`, sum(time_to_sec(al_duration)) AS `time` FROM activity_log WHERE al_user_id = $user_id AND al_project_id IN (".$in_list.") $q_period GROUP BY al_project_id";
    else
      $sql = "SELECT al_activity_id AS `act_id`, sum(time_to_sec(al_duration)) AS `time` FROM activity_log WHERE al_user_id = $user_id AND al_activity_id IN (".$in_list.") $q_period GROUP BY al_activity_id";
        
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $val['time'] = sec_to_time_fmt_hm($val['time']);
        
        if($pie_mode AND $pie_mode=="project")
          $result[$val['act_id']] = $val['time'];
        else
          $result[$val['act_id']] = $val['time'];
      }
    }
    return $result;
  }

  /**
   * Returns all time records for certain date and the user
   * @param string $date
   * @param int $user_id
   * @return array
   */
  static function findAllTime($date, $user_id) {
    $result = array();

    $mdb2 = getConnection();

    global $i18n;
    $sql = "select TIME_FORMAT(al.al_from, '%k:%i') as tfrom,
             TIME_FORMAT(sec_to_time(time_to_sec(al.al_from) + time_to_sec(al.al_duration)), '%k:%i') as tto,
             TIME_FORMAT(al.al_duration, '%k:%i') as tdur, p.p_name, a.a_name, al_comment, al_timestamp, al_billable
             from activity_log al, projects p, activities a
             where al.al_date = '$date' and al.al_user_id = $user_id and p.p_id = al.al_project_id and a.a_id = al.al_activity_id
             order by al.al_from, al.al_duration";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $val['tfrom'] = (!$val['tfrom'] ? '&nbsp;' : htmlspecialchars($val['tfrom']));
        $val['tto'] = (!$val['tto'] ? '&nbsp;' : htmlspecialchars($val['tto']));
        $val['al_comment'] = (!$val['al_comment'] ? '&nbsp;' : htmlspecialchars($val['al_comment']));
        if($val['tdur']=="0:00") {
          $val['tdur'] = '<font color="#ff0000">'.$i18n->getKey('form.mytime.uncompleted').'</font>';
          $val['tto'] = "";
        }
        $result[] = $val;
      }
    } else return false;

    return $result;
  }


  /**
   * Returns all time records for a certain user
   * @param int $user_id
   * @return array
   */
  static function findAllTimeRecords($user_id) {
    $result = array();

    $mdb2 = getConnection();

    $sql = "select TIME_FORMAT(al.al_from, '%k:%i') as tfrom,
             TIME_FORMAT(sec_to_time(time_to_sec(al.al_from) + time_to_sec(al.al_duration)), '%k:%i') as tto,
             TIME_FORMAT(al.al_duration, '%k:%i') as tdur,
             al_comment, al_timestamp, al_user_id, al_project_id, al_activity_id, al_date, al_billable
             from activity_log al
             where al.al_user_id = $user_id
             order by al.al_from, al.al_duration";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    } else return false;

    return $result;
  }

  /**
   * Finds time records for certain date and the user
   * @param int $user_id
   * @param string $ts
   * @return array
   */
  static function findTimeRecord($user_id, $ts) {
    $mdb2 = getConnection();

    $sql = "select TIME_FORMAT(al.al_from, '%k:%i') as tfrom,
      TIME_FORMAT(sec_to_time(time_to_sec(al.al_from) + time_to_sec(al.al_duration)),'%k:%i') as tto,
      TIME_FORMAT(al.al_duration, '%k:%i') as tdur,
      p.p_name, a.a_name, al.al_comment, al.al_project_id, al.al_activity_id, al_billable, al_timestamp, al_date
      from activity_log al, projects p, activities a
      where al.al_user_id = $user_id and al.al_timestamp = '$ts' and p.p_id = al.al_project_id and a.a_id = al.al_activity_id";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  /**
   * Finds a record with empty duration for a user
   * @param int $user_id
   * @return boolean
   */
  // Note: this function needs renaming.
  static function findUncompletedRecord($user_id) {
    $mdb2 = getConnection();

    $sql = "select al.al_timestamp, al.al_date, TIME_FORMAT(al.al_from, '%k:%i') as tfrom,
      TIME_FORMAT(sec_to_time(time_to_sec(al.al_from) + time_to_sec(al.al_duration)),'%k:%i') as tto,
      TIME_FORMAT(al.al_duration, '%k:%i') as tdur,
      p.p_name, a.a_name, al.al_comment, al.al_project_id, al.al_activity_id
      from activity_log al, projects p, activities a
      where al.al_user_id = $user_id and p.p_id = al.al_project_id and a.a_id = al.al_activity_id
      and al_from is not null and time_to_sec(al_duration)=0";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }


  /**
   * Gets work time per week
   * @param <type> $user
   * @param <type> $date
   * @param <type> $addCondition
   * @return <type>
   */
  static function getTimePerWeek($user, $date, $addCondition="") {
    import('Period');
    $mdb2 = getConnection();

    $period = new Period(PERIOD_THIS_WEEK, $date);
    $sql = "select sum(time_to_sec(al_duration)) as sm from activity_log where al_user_id = ".$user->getActiveUser()." and al_date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and al_date <= '".$period->getEndDate(DB_DATEFORMAT)."'".$addCondition;
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      return ($val['sm']?sec_to_time_fmt_hm($val['sm']):0);
    }
    return 0;
  }

}
?>