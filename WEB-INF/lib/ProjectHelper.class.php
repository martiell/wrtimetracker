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

// $Id: ProjectHelper.class.php,v 1.20 2009/01/30 23:12:19 nokuntseff Exp $

/**
 * Class ProjectHelper for manipulation with the Project data
 * @package TimeTracker
 */
class ProjectHelper {

	/**
         * Finds all projects belonging to the user.
         *  - if $options['restrict'] is true includes only projects which belong to the $user
         *  - if $options['alldata'] is true includes in result all data under the project
         *  - if $options['showHidden'] is true includes the hidden projects
         * @param User $user
         * @param array $options
         * @return array
         */
  static function findAllProjects($user, $options = null)
  {
    $result = array();
    $mdb2 = getConnection();

  	if ($user->isManager()) {
      if (@$options['alldata']) {
  	    $sql = "SELECT p.p_id, p.p_name, p.p_status, p.p_manager_id, p.p_timestamp";
      } else {
        $sql = "SELECT p.p_id, p.p_name, p.p_manager_id";
  	  }
  	  $sql .=" FROM projects AS p	WHERE p.p_manager_id = ". $user->getUserId();
  	  if (!@$options['showHidden']) $sql .= " AND p.p_status = 1";
  	} else {
      $sql = "SELECT p.p_id, p.p_name, p.p_status, p.p_manager_id, p.p_timestamp FROM projects AS p
        WHERE p.p_manager_id = ". $user->getManagerId();
      if (!@$options['showHidden']) $sql .= " AND p.p_status = 1";
  	}

    if (!($user->isManager() || $user->isCoManager()) || @$options['restrict']) {
  	  $user_projects = $user->getProjects();

  	  $arr = array();
  	  foreach ($user_projects as $p) {
  	    $arr[] = $p["p_id"];
  	  }
	  $sql .= " AND p.p_id in (".join(", ",$arr).")";
	}
	
	$res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      $result = mu_sort($result, "p_name");
    }

    return $result;
  }

        /**
         * Returns count of projects for $user
         * @param User $user
         * @param boolean $restrict
         * @return array
         */
  static function findAllProjectsCount($user, $restrict=false) {
    $result = array();
    $mdb2 = getConnection();

  	if ($user->isManager()) {
	  $sql = "SELECT count(*) as cnt FROM projects AS p WHERE p.p_manager_id = ".$user->getUserId()." AND p.p_status = 1";
  	} else {
      $sql = "SELECT count(*) as cnt FROM projects AS p WHERE p.p_manager_id = ".$user->getManagerId()." AND p.p_status = 1";
  	}

    if (!($user->isManager() || $user->isCoManager()) || $restrict) {
  	  if (count($user->getProjects()) > 0) {
  	    $arr = array();
  	    foreach ($user->getProjects() as $p) {
  		  if (isset($p["ub_checked"])) $arr[] = $p["p_id"];
  	    }
        $sql .= " AND p.p_id in (".join(", ",$arr).")";
      }
    }

  	$res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if ($val = $res->fetchRow()) {
      	$result = $val['cnt'];
      }
    }
    return $result;
  }


	/**
	 * Finds project by its ID
	 *
	 * @param string $user_id
	 * @param string $pr_id
	 * @return array
	 */
  static function findProjectById($user_id, $pr_id) {
    $mdb2 = getConnection();

    $sql = "select p.p_id, p.p_name from projects p where p.p_id = $pr_id and p.p_manager_id = $user_id and p.p_status = 1";
    $res = &$mdb2->query($sql);

    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
	  if ($val['p_id'] != '') {
        return $val;
      } else {
      	return false;
      }
    }
    return false;
  }

	/**
	 * Finds project by its name
	 *
	 * @param int $user_id
	 * @param string $pr_name
	 * @return boolean
	 */
  static function findProjectByName($user_id, $pr_name) {
    $mdb2 = getConnection();

    $sql = "select p.p_id, p.p_name from projects p where p.p_name = ".
      mdb2_quote($mdb2, $pr_name)." and p.p_manager_id = $user_id and p.p_status = 1";
  	$res = &$mdb2->query($sql);

    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
	  if ($val['p_id']!= '') {
        return $val;
      } else {
        return false;
      }
    }
    return false;
  }

	/**
	 * Update existing project
	 *
	 * @param User $user
	 * @param array $fields
	 * @return boolean
	 */
  static function update($user, $fields)
  {
    $mdb2 = getConnection();
    $project_id = $fields['project_id']; // Project we are updating.
    $project_name = $fields['project_name']; // Project name.
    $users_to_bind = isset($fields['user_add']) ? $fields['user_add'] : false; // Users we are binding with project.
    $activ_to_bind = isset($fields['activ_add']) ? $fields['activ_add'] : false; // Activities we binding with project.

    // Update records in user_bind table.
    $sql = "SELECT ub_id_u, ub_checked FROM user_bind WHERE ub_id_p = $project_id";
    $all_users = array();
    $users_to_update = array();
    $res2 = &$mdb2->query($sql);
    while ($row = $res2->fetchRow()) {
      if(!@in_array($row['ub_id_u'], $users_to_bind) OR !$users_to_bind) { 
      	// Delete user_bind records.
        $sql = "DELETE FROM user_bind WHERE ub_id_u = ".$row['ub_id_u']." AND ub_id_p = $project_id";
        $affected = &$mdb2->exec($sql);
      } else if (!$row['ub_checked']) {
		$users_to_update[] = $row['ub_id_u'];  // Users we need to update in user_bind.
      }
      $all_users[] = $row['ub_id_u']; // All users from user_bind for project.
    }

    // Insert records.
    $users_to_add = @array_diff($users_to_bind, $all_users); // Users missing from user_bind, that we need to insert.
    if(count($users_to_add) > 0) {
      $sql = "SELECT u_id, u_rate FROM users WHERE u_id IN (".join(', ', $users_to_add).")";
      $res = &$mdb2->query($sql);
      while ($row = $res->fetchRow()) {
        $user_rate[$row['u_id']] = $row['u_rate'];
      }
      foreach ($users_to_add as $id) {
        $sql = "INSERT INTO user_bind (ub_id_u, ub_id_p, ub_rate, ub_checked) VALUES($id, $project_id, ".$user_rate[$id].", 1)";
        $affected = &$mdb2->exec($sql);
      }
    }
    // Update records.
    if ($users_to_update) {
      $sql = "UPDATE user_bind SET ub_checked = 1 WHERE ub_id_p = $project_id AND ub_id_u IN (".join(', ', $users_to_update).")";
      $affected = &$mdb2->exec($sql);
    }
    // End of updating user_bind table.

    // Update records in activity_bind table.
    $g_act_list = ActivityHelper::findAllActivity($user, false);
    foreach ($g_act_list as $act_item) {
      foreach ($act_item['aprojects'] as $proj) {
        if($proj['p_id'] == $project_id)
          $check_act[] = $act_item["a_id"];
        }
        $act_list[$act_item["a_id"]] = $act_item["a_name"];
    }

    $act_to_del = @array_diff($check_act, $activ_to_bind);
	if(count($act_to_del) > 0) {
      foreach ($act_to_del as $id) {
        $sql = "DELETE FROM activity_bind WHERE ab_id_p = $project_id AND ab_id_a = $id";
        $affected = &$mdb2->exec($sql);
      }
    }

    if(!is_array(@$check_act) OR (count(@$check_act) < 1))
      $check_act = array();

    $act_to_add = @array_diff($activ_to_bind, $check_act);
    if(count($act_to_add) > 0) {
      foreach ($act_to_add as $id) {
        $sql = "INSERT INTO activity_bind (ab_id_p, ab_id_a) VALUES($project_id, $id)";
        $affected = &$mdb2->exec($sql);
      }
    }
    // End of updating activity_bind table.

    // Update project name.
    $sql = "UPDATE projects SET p_name = ".mdb2_quote($mdb2, $project_name)." WHERE p_id = $project_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) == 0) {
      return true;
    }
    return false;
  }

	/**
	 * Create new project
	 *
	 * @param array $fields
	 * @param array $options
	 * @return int
	 */
  static function insert($fields, $options = null)
  {
    $mdb2 = getConnection();
    $user_id = $fields['user_id'];
    $project_name = $fields['project_name'];
    $user_add = isset($fields['user_add']) ? $fields['user_add'] : false;
    $activ_add = isset($fields['activ_add']) ? $fields['activ_add'] : false;

    $sql = "insert into projects (p_manager_id, p_name) values ($user_id, ".mdb2_quote($mdb2, $project_name).")";
  	$affected = &$mdb2->exec($sql);
    $last_id = 0;
    if (PEAR::isError($affected) == 0) {
      $sql = "SELECT LAST_INSERT_ID() AS last_insert_id";
      $res = &$mdb2->query($sql);
      $val = $res->fetchRow();
      $last_id = $val['last_insert_id'];

      // Bind the project to users and activities if we need to.
      if (@$options['bind']) {
        $user = new User($user_id, false);

        // Bind the project to users.
        import('UserHelper');
        $users = UserHelper::findAllUsers($user, true, true);
        if (is_array($users))
          foreach ($users as $u) {
            if(@is_array($user_add)) {
              if(in_array($u["u_id"], $user_add)) {
                $sql = "insert into user_bind (ub_id_p, ub_id_u, ub_checked, ub_rate) values(
                  $last_id, ".$u["u_id"].", 1, ".$u["u_rate"].")";
                $affected = &$mdb2->exec($sql);
              }
            }
	      }
          
        // Bind the project to activities.
        import('ActivityHelper');
        $activities = ActivityHelper::findAllActivity($user);
        if (is_array($activities))
          foreach ($activities as $a) {
            if(@is_array($activ_add)) {
              if(in_array($a["a_id"], $activ_add)) {
                $sql = "insert into activity_bind (ab_id_a, ab_id_p) values(".$a["a_id"].", $last_id)";
                $affected = &$mdb2->exec($sql);
              }
            }
          }
      }
	  // End of binding section.

      return $last_id;
    }
    return false;
  }

	/**
	 * Delete project
	 *
	 * @param int $project_id
	 * @return boolean
	 */
  static function delete($project_id) {
    $mdb2 = getConnection();
    $deleted = DELETED;
    $sql = "update projects set p_status = $deleted where p_id = $project_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) == 0) {
      return true;
    }
  	return false;
  }

	/**
	 * Checks the project on an accessory to the user
	 *
	 * @param int $project_id
	 * @param object $user
	 * @return bool
	 */
  static function isProjectExistsStrict($project_id, $user) {
    $result = false;
    $mdb2 = getConnection();

    $user_id = $user->getManagerId();
    if ($user->isManager()) $user_id = $user->getUserId();

    $sql = "select count(p.p_id) as prjc from projects p
    		where p.p_id = $project_id and p.p_manager_id = $user_id and p.p_status = 1";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if ($val = $res->fetchRow()) {
        if ($val["prjc"]>0) $result = true;
      }
  	}
  	return $result;
  }

	/**
	 * Checks the project on existence
	 *
	 * @param int $project_id
	 * @return boolean
	 */
  static function isProjectExists($project_id) {
	$mdb2 = getConnection();

    $sql = "select count(p.p_id) as cnt from projects p where p.p_id = $project_id and p.p_status = 1";
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
}
?>