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

// $Id: ActivityHelper.class.php,v 1.17 2008/12/29 01:50:53 nokuntseff Exp $

import("ProjectHelper");

/**
 * Class ActivityHelper for manipulation with the Activity data
 * @package TimeTracker
 */
class ActivityHelper {

    /**
     * Finds all projects for specified user
     * @param int $user
     * @param int $project_id
     * @param boolean $alldata
     * @param boolean $showHidden
     * @return array
     */
	static function findAllActivity($user, $project_id="", $alldata=false, $showHidden=false) {
		$result = array();
		$mdb2 = getConnection();

    	$project_tables = "";
    	$project_cond = "";
    	if ($project_id) {
    		$project_tables = ", activity_bind";
    		$project_cond = " and a_id=ab_id_a and ab_id_p=".$project_id;
    	}
		if ($user->isManager() || $user->isCoManager()) {
			if ($alldata) {
				$sql = "select a.a_id, a.a_name, a.a_timestamp, a.a_manager_id, a.a_status";
			} else {
				$sql = "select a.a_id, a.a_name, a.a_manager_id";
			}

			$sql .= " from activities a $project_tables
				where a.a_manager_id = ". $user->getOwnerId() . $project_cond;
			if (!$showHidden) $sql .= " and a.a_status=1";
			$sql .= " order by a.a_name";
  		} else {
    		$sql = "select DISTINCT a_id, a_name, a_timestamp, a_manager_id, a_status
				FROM user_bind, activity_bind, activities
				where ab_id_p=ub_id_p and ab_id_a=a_id and
				ub_id_u = ".$user->getUserId()." and ub_checked=1 ".$project_cond;
    		if (!$showHidden) $sql .= " and a_status=1";
    		$sql .= " order by a_name";
  		}

  		$res = &$mdb2->query($sql);
  		$actIds = array();
  		if (PEAR::isError($res) == 0) {
  			$pCount = ProjectHelper::findAllProjectsCount($user);

    		while ($val = $res->fetchRow()) {
    			$actIds[] = $val["a_id"];
    			/*if ($user->isManager() || $user->isCoManager()) {
    				$val["aprojects"] = ActivityHelper::findProjectsBinded($val["a_id"]);
    			} else {
    				$val["aprojects"] = ActivityHelper::findProjectsBinded($val["a_id"], $user->getProjects());
    			}
    			$val["aprojects_all"] = (is_array($val["aprojects"]) && $pCount==count($val["aprojects"]));*/
      			$result[] = $val;
      		}

      		$result = mu_sort($result,"a_name");

      		if ($user->isManager() || $user->isCoManager()) {
				$aprojects = ActivityHelper::findProjectsBinded($actIds);
			} else {
				$aprojects = ActivityHelper::findProjectsBinded($actIds, $user->getProjects());
			}

      		foreach ($result as $k=>$v) {
      			$result[$k]["aprojects"] = array();
      			if ($aprojects)
	      			foreach ($aprojects as $p) {
	      				if ($v["a_id"]==$p["ab_id_a"]) $result[$k]["aprojects"][] = $p;
	      			}
      			$result[$k]["aprojects_all"] = ($pCount==count($result[$k]["aprojects"]));
      		}
  		}
  		return $result;
	}

        /**
         * Finds activity data by ID
         * @param int $user_id
         * @param int $act_id
         * @return array
         */
	static function findActivityById($user_id, $act_id) {
	  $mdb2 = getConnection();

	  $sql = "select a.a_id, a.a_name from activities a, users u
        where u.u_id=a.a_manager_id and u.u_id = $user_id and a.a_id = $act_id";
  	  $res = &$mdb2->query($sql);
	  if (PEAR::isError($res) == 0) {
    		$val = $res->fetchRow();
		    if ($val['a_id'] != '') {
		    	$val["aprojects"] = ActivityHelper::findProjectsBinded($act_id);
      			return $val;
    		} else {
      			return false;
    		}
	  }
	  return false;
    }

        /**
         * Finds activity data by name
         * @param int $user_id
         * @param string $act_name
         * @return array
         */
   static function findActivityByName($user_id, $act_name) {
      $mdb2 = getConnection();

	  $sql = "select a.a_id, a.a_name from activities a, users u
        where u.u_id = a.a_manager_id and a.a_status = 1 and u.u_id = $user_id and a.a_name = '$act_name'";
  	  $res = &$mdb2->query($sql);
	  if (PEAR::isError($res) == 0) {
    		$val = $res->fetchRow();
		    if ($val['a_id'] != '') {
		    	$val["aprojects"] = ActivityHelper::findProjectsBinded($val['a_id']);
      			return $val;
    		} else {
      			return false;
    		}
	  }
	  return false;
    }

    /**
     * Checks presence of activity for the set user
     * @param int $activity_id
     * @param User $user
     * @return boolean
     */
	static function isActivityExistsStrict($activity_id,$user) {
		$result = false;
		$mdb2 = getConnection();

    	$user_id = $user->getManagerId();
    	if ($user->isManager()) $user_id = $user->getUserId();

    	$sql = "select count(a.a_id) as actc
    	  from activities a where a.a_id = $activity_id and a.a_manager_id = ".$user_id." and a.a_status = 1";
  		$res = &$mdb2->query($sql);
  		if (PEAR::isError($res) == 0) {
    		if ($val = $res->fetchRow()) {
    			if ($val["actc"]>0) $result = true;
      		}
  		}

  		return $result;
	}

        /**
         * Checks presence of activity
         * @param int $activity_id
         * @return boolean
         */
	static function isActivityExists($activity_id) {
		$mdb2 = getConnection();

    	$sql = "select count(a.a_id) as cnt from activities a where a.a_id = $activity_id and a.a_status = 1";
  		$res = &$mdb2->query($sql);

  		if (PEAR::isError($res) == 0) {
    		$val = $res->fetchRow();

    		if ($val['cnt'] > 0) {
      			return true;
    		} else {
      			return false;
    		}
  		}
  		return false;
	}


        /**
         * Finds all projects bound to $activity_id
         * and present in $projects_cs_list list
         * @param int $activity_id
         * @param array $projects_cs_list
         * @return array
         */
  	static function findProjectsBinded($activity_id, $projects_cs_list=null) {
  		$mdb2 = getConnection();

    	$result = array();

    	if (is_array($activity_id) && count($activity_id)>0) {
    		$sql = "select p_id, p_name, ab_id_p, ab_id_a from activity_bind, projects where p_id=ab_id_p and p_status=1 and ab_id_a in (".join(",",$activity_id).")";
    	} else {
    		$sql = "select p_id, p_name, ab_id_p, ab_id_a from activity_bind, projects where p_id=ab_id_p and p_status=1 and ab_id_a = ".$activity_id;
    	}
    	if (!is_null($projects_cs_list)) {
    		$arr = array();
    		foreach ($projects_cs_list as $p) {
    			$arr[] = $p["p_id"];
    		}
    		$sql .= " and p_id in (".join(",",$arr).")";
    	}


  		$res = &$mdb2->query($sql);
  		if (PEAR::isError($res) == 0) {
  			while ($val = $res->fetchRow()) {
   				$result[] = $val;
  			}
  			return $result;
 		}
    	return false;
  	}

        /**
         * Finds all project to activity binds for a team.
         * @param int $manager_id
         * @return array
         */
  	static function findAllActivityBinds($manager_id) {
  		$mdb2 = getConnection();

    	$result = array();

    	$sql = "select p_id, ab_id_a, ab_id_p from projects
    	  inner join activity_bind on (ab_id_p = p_id)
		  where p_status = 1 and p_manager_id = $manager_id and ab_id_a is not null
		  order by ab_id_p";
  		$res = &$mdb2->query($sql);
  		if (PEAR::isError($res) == 0) {
  			while ($val = $res->fetchRow()) {
   				$result[] = $val;
  			}
  			return $result;
 		}
    	return false;
  	}

        /**
         * Binds activity to projects
         * @param int $activity_id
         * @param int $project_id
         * @return boolean
         */
  	static function insertActivityBind($activity_id, $project_id) {
  		$mdb2 = getConnection();
    	$sql = "INSERT INTO activity_bind (ab_id_a, ab_id_p) VALUES($activity_id, $project_id)";
  		$affected = &$mdb2->exec($sql);
  		return (PEAR::isError($affected) == 0);
  	}

        /**
         * Stores Activity data into database. Returns stored entity ID.
         * @param int $user_id
         * @param string $activity_name
         * @param array $aprojects
         * @return int
         */
  	static function insert($user_id, $activity_name, $aprojects) {
  	  $mdb2 = getConnection();
      $sql = "insert into activities (a_manager_id, a_name) values ($user_id, ".mdb2_quote($mdb2, $activity_name).")";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) == 0) {
    	$sql = "SELECT LAST_INSERT_ID() AS `last_id`";
		$res = &$mdb2->query($sql);
		$val = $res->fetchRow();
		$lastid = $val['last_id'];

		if (is_array($aprojects) && (count($aprojects) > 0))
   		  foreach ($aprojects as $p_id) {
   			$sql = "insert into activity_bind (ab_id_p, ab_id_a) values(".$p_id.",".$lastid.")";
			$affected = &$mdb2->exec($sql);
		}

		return $lastid;
  	  }
	  return false;
  	}

        /**
         * Updates Activity data in database.
         * @param int $fields
         * @return boolean
         */
  	static function update($fields)
    {
      $mdb2 = getConnection();

      $activity_id = $fields['activity_id'];
      $activity_name = $fields['activity_name'];
      $aprojects = &$fields['aprojects'];

      $sql = "update activities set a_name = ".mdb2_quote($mdb2, $activity_name)." where a_id = $activity_id";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) == 0) {
    	$sql = "delete from activity_bind where ab_id_a = ".$activity_id;
        $affected = &$mdb2->exec($sql);

    	if (count($aprojects) > 0)
    	  foreach ($aprojects as $p_id) {
	   	    $sql = "insert into activity_bind (ab_id_p, ab_id_a) values(".$p_id.",".$activity_id.")";
    		$affected = &$mdb2->exec($sql);
    	  }
        return true;
      }
      return false;
	}

        /**
         * Deletes activity in database
         * @param int $activity_id
         * @return boolean
         */
	static function delete($activity_id) {
      $mdb2 = getConnection();
      $deleted = DELETED;
      $sql = "update activities set a_status = $deleted where a_id = $activity_id";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) == 0) {
      	return true;
      }
      return false;
	}
}
?>