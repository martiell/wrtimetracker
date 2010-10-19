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

$mdb2 = getConnection();

// Reports seem to be a one-off case where Fetch Mode needs to be ordered.
// We set the Fetch Mode in getConnection for a global shared connection.
// We are changing it here to MDB2_FETCHMODE_ORDERED.
// Make sure to revert back on exit from this file to MDB2_FETCHMODE_ASSOC.
$mdb2->setFetchMode(MDB2_FETCHMODE_ORDERED);
	$array_of_days = $period->getAllDays();
	foreach ($array_of_days as $i) {
		$dt_tmp = $i->toString(DB_DATEFORMAT);
		$wdates[$dt_tmp] = $i->getDay();
		$clean_dates[$dt_tmp] = $i->toString();
		$dates_work[$dt_tmp] = '';
	}

	$total_only = $bean->getAttribute("chtotalonly");
	$fields = array();
	$header = array();
	$hkeys  = array();

	array_push ($fields, 'al.al_date');
	array_push ($header, $i18n->getKey("form.report.th.date"));
	array_push ($hkeys, 'date');

	if($user->isManager() || $user->isCoManager()) {
		array_push ($fields, 'u.u_name');
		array_push ($header, $i18n->getKey("form.report.th.empllist"));
		array_push ($hkeys, 'user');
	}
    if ($bean->getAttribute("chproject") || $bean->getAttribute("groupby")=="project") {
      array_push ($fields, 'p.p_name');
      array_push ($header, $i18n->getKey("form.report.th.project"));
      array_push ($hkeys, 'project');
    }
    if ($bean->getAttribute("chactivity") || $bean->getAttribute("groupby")=="activity") {
      array_push ($fields, 'a.a_name');
      array_push ($header, $i18n->getKey("form.report.th.activity"));
      array_push ($hkeys, 'activity');
    }
    if ($bean->getAttribute("chstart")) {
      array_push ($fields, "TIME_FORMAT(al.al_from, '%k:%i')");
      array_push ($header, $i18n->getKey("form.report.th.start"));
      array_push ($hkeys, 'start');
    }
    if ($bean->getAttribute("chfinish")) {
      array_push ($fields, "TIME_FORMAT(sec_to_time(time_to_sec(al.al_from) + time_to_sec(al.al_duration)), '%k:%i')");
      array_push ($header, $i18n->getKey("form.report.th.finish"));
      array_push ($hkeys, 'finish');
    }
    if ($bean->getAttribute("chduration")) {
      array_push ($fields, "TIME_FORMAT(al.al_duration, '%k:%i')");
      array_push ($header, $i18n->getKey("form.report.th.duration"));
      array_push ($hkeys, 'duration');
    }
    if ($bean->getAttribute("chnote")) {
      array_push ($fields, 'al.al_comment');
      array_push ($header, $i18n->getKey("form.report.th.note"));
      array_push ($hkeys, 'note');
    }

   	$q_selproject = ($bean->getAttribute("project") ? " and al.al_project_id = ".$bean->getAttribute("project") : "");
   	$q_selact = ($bean->getAttribute("activity") ? " and al.al_activity_id = ".$bean->getAttribute("activity") : "");
   	
  	$sort_key = (!$bean->getAttribute("groupby") ? "date" : $bean->getAttribute("groupby"));
  	
  	$q_billable = "";
  	if ($bean->getAttribute("increcords")=="1") $q_billable = " and al_billable=1";
  	if ($bean->getAttribute("increcords")=="2") $q_billable = " and al_billable=0";
  	
	$field_list = array_flip($hkeys);
	foreach($field_list as $k=>$v) $empty[$k] = '';
	
	switch ($sort_key) {
        case "user": $group_field = "u.u_name"; break;
        case "project": $group_field = "p.p_name"; break;
        case "activity": $group_field = "a.a_name"; break;
        default: $group_field = "";
    }

    $current_project_name = "";
    $current_activity_name = "";

    // db query
    if ($bean->getAttribute("chproject") && $bean->getAttribute("project")) {
      $sql = "select p.p_name from projects p ".
        "where p.p_id = ".$bean->getAttribute("project")." and p.p_status = 1";  	
      $res = &$mdb2->query($sql);

      if (PEAR::isError($res) == 0) {
      	if ($val = $res->fetchRow()) {
          $current_project_name = $val[0];
      	}
      }
    }
   	if ($bean->getAttribute("chactivity") && $bean->getAttribute("activity")) {
      $sql = "select a_name from activities where a_id = ".$bean->getAttribute("activity");
      $res = &$mdb2->query($sql);
      
      if (PEAR::isError($res) == 0) {
        if ($val = $res->fetchRow()) {
          $current_activity_name = $val[0];
      	}
      }
   	}

   	// comprehensive data
   	if(!isset($userlist))
	  $userlist = -1;
    $rows = array(); 
    $fill_date = array(); 
    if ($user->isManager() || $user->isCoManager()) {
      $sql = "SELECT " . join (', ', $fields) . " FROM activity_log AS al, projects AS p, activities AS a, users AS u WHERE al.al_date >= '".$period->getBeginDate(DB_DATEFORMAT)."' AND al.al_date <= '".$period->getEndDate(DB_DATEFORMAT)."' AND al.al_user_id in (".$userlist.") AND p.p_id = al.al_project_id". $q_selproject . $q_selact. $q_billable. " AND a.a_id = al.al_activity_id AND u.u_id = al.al_user_id ORDER BY u.u_name, al.al_date, al.al_from DESC";
    } else {
      $sql = "SELECT " . join (', ', $fields) . " FROM activity_log AS al, projects AS p, activities AS a WHERE al.al_date >= '".$period->getBeginDate(DB_DATEFORMAT)."' AND al.al_date <= '".$period->getEndDate(DB_DATEFORMAT)."' AND al.al_user_id = ".$user->getUserId()." AND p.p_id = al.al_project_id". $q_selproject . $q_selact. $q_billable. " AND a.a_id = al.al_activity_id ORDER BY al.al_date, al.al_from DESC";
    }
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $row = array();
      	foreach ($hkeys as $fn) {
      	  $row[$fn] = $val[$field_list[$fn]];
      	}
      	$row["sortkey"] = @$row[$sort_key];
      	$fill_date[] = array('sortkey'=>@$row[$sort_key],'date'=>$val[0]);
   	    $rows[] = $row;
      }
    } else {
      print "<font color=\"red\">Database processing error 1/Report generating error/</font><br>\n";
      die();
    }

    // totals
    $total = 0;
    $sql = "select sum(time_to_sec(al_duration))
        from activity_log al
        where al_user_id in ($userlist) and al_date >=  '".$period->getBeginDate(DB_DATEFORMAT)."' and al_date <= '".$period->getEndDate(DB_DATEFORMAT)."'".
        $q_selproject . $q_selact . $q_billable;
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      $total = sec_to_time_fmt_hm($val[0]);
    } else {
      print "<font color=\"red\">Database processing error /Report generating error 2/</font><br>\n";
      die();
    }

    // subtotals
    $sub_summary = array();
    if ($group_field) {
        if ($user->isManager() || $user->isCoManager()) {
          $sql = "select $group_field,sum(time_to_sec(al.al_duration)) from activity_log al, projects p, activities a, users u where al.al_date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and al.al_date <= '".$period->getEndDate(DB_DATEFORMAT)."' and al.al_user_id in (".$userlist.") and p.p_id = al.al_project_id". $q_selproject . $q_selact. $q_billable ." and a.a_id = al.al_activity_id and u.u_id = al.al_user_id group by $group_field";
        } else {
          $sql = "select $group_field,sum(time_to_sec(al.al_duration)) from activity_log al, projects p, activities a, users u where al.al_date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and al.al_date <= '".$period->getEndDate(DB_DATEFORMAT)."' and al.al_user_id = ".$user->getUserId()." and p.p_id = al.al_project_id". $q_selproject . $q_selact. $q_billable. " and a.a_id = al.al_activity_id and u.u_id = al.al_user_id group by $group_field";
        }
        $res = &$mdb2->query($sql);
        if (PEAR::isError($res) == 0) {
          while ($val = $res->fetchRow()) {
            $sub_summary[$val[0]] = sec_to_time_fmt_hm($val[1]);
          }
        } else {
          print "<font color=\"red\">Database processing error 2/Report generating error/</font><br>\n";
        }
    } else {
    	if ($total_only && $bean->getAttribute("project") && count($rows)) {
    		// for show one row in report if was selected "project" and "total_only"
    		if (is_array($rows[0])) {
    			$pname = $rows[0]["project"];
    			$aname = (isset($rows[0]["activity"])?$rows[0]["activity"]:" ");
    			$sub_summary[$pname] = $total;
    			$sort_key = "project";
    			$rows = array();
				$rows[] = array("sortkey"=>$pname,"user"=>"","date"=>"","project"=>$pname,"activity"=>$aname,"start"=>"","finish"=>"","duration"=>$total,"note"=>"");
    		}
    	} else {
        	$sub_summary['common'] = '1';
    	}
    }
    
    if ($bean->getAttribute("chshowidle") && isset($user)) {
    	
    	if ($sort_key=='user'&& ($bean->getAttribute('user')==null)) {
    		import("UserHelper");
    		$users = UserHelper::findAllUsers($user);
    		$arr = $bean->getAttribute('users');
    		foreach ($users as $user_it) {
    			if (is_array(@$arr) && in_array($user_it["u_id"],@$arr)) {
	    			if (!in_array($user_it["u_name"],array_keys($sub_summary))) {
	    				$sub_summary[$user_it["u_name"]] = 0;
	    			}
    			}
    		}
    	}

    	if ($sort_key=='project' && ($bean->getAttribute('project')==null)) {
    		import("ProjectHelper");
    		$projects = ProjectHelper::findAllProjects($user);
    		foreach ($projects as $project) {
    			if (!in_array($project["p_name"],array_keys($sub_summary))) {
    				$sub_summary[$project["p_name"]] = 0;
    			}
    		}
    	}
    	if ($sort_key=='activity' && ($bean->getAttribute('activity')==null)) {
    		import("ActivityHelper");
    		$activities = ActivityHelper::findAllActivity($user);
    		foreach ($activities as $activity) {
    			if (!in_array($activity["a_name"],array_keys($sub_summary))) {
    				$sub_summary[$activity["a_name"]] = 0;
    			}
    		}
    	}
    	
    }
    
    //build dates period for each subsummary
	if ($bean->getAttribute("chshowidle")) {
	    foreach ($sub_summary as $k=>$v) {
            foreach ($array_of_days as $i) {
              $index = $i->toString(DB_DATEFORMAT);
              $row = $empty;
    		  $row["date"] = $index;
    		  $row["sortkey"] = ($sort_key=='date' ? $row[$sort_key] : $k);
              $toadd = true;
              foreach ($fill_date as $key) {
                  if ($key['date']==$index && $key['sortkey']==$row["sortkey"]) {
                      $toadd = false;
                  }
              }
              if ($toadd) {
                 $rows[] = $row;
                 $fill_date[] = array('date'=>$index,'sortkey'=>$row["sortkey"]);
              }
            }
	    }
    }
    /*echo "<PRE>";
print_r($rows);
echo "</PRE>";*/
    
    // sort by keys
    $sort_string = "sortkey,date";
    //if ($user->isManager() || $user->isCoManager()) {
    //	$sort_string .= ",user";
    //}
    if ($bean->getAttribute("chstart")) {
    	$sort_string .= ",start";
    }
	//echo $sort_string;
foreach($rows as $id=>$val) {
	if($val['start']!="")
		$rows[$id]['start'] = str_replace(":", "", $val['start']);
}
	$rows = mu_sort($rows, $sort_string);

	// Change Fetch Mode back (see comment in the beginning of the file).
	$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);
?>