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

// $Id: UserHelper.class.php,v 1.34 2009/04/04 20:40:32 nokuntseff Exp $

/**
 * Class UserHelper for manipulation with the User objects
 * @package TimeTracker
 */
class UserHelper {

  /**
   * Gets list of all users by manager, include manager
   *
   * @param User $user
   * @return array
   */
  static function findAllUsers($user, $hierarhy_check=true, $alldata=false) {
    $result = array();
    $mdb2 = getConnection();

    if ($alldata) {
      $sql =  "select u.u_id, u.u_name, u.u_login, u.u_password, u.u_company_id, u.u_manager_id,
        u.u_comanager, u.u_level, u.u_active, u.u_rate, u.u_timestamp, u.u_lang, u.u_email,
        u_show_pie, u_pie_mode";
    } else {
      $sql =  "select u.u_id, u.u_name, u.u_login, u.u_manager_id, u.u_comanager";
    }

    $sql .=  " from users u";
    if ($hierarhy_check) {
      if ($user->isManager()) {
        $sql .=  " where (u.u_manager_id = ". $user->getUserId() ." or u.u_id = ". $user->getUserId() .")";
      } elseif ($user->isCoManager()) {
        $sql .=  " where (u.u_id=".$user->getUserId()." or u.u_comanager is null) and u.u_manager_id = ". $user->getManagerId(); // users and co-manager
      } else {
        $sql .=  " where (u.u_manager_id = ". $user->getManagerId() ." or u.u_id = ". $user->getManagerId() .")";
      }
    } else {
      if ($user->isManager() || $user->isCoManager()) {
        $sql .=  " where (u.u_manager_id = ". $user->getUserId() ." or u.u_id = ". $user->getUserId() ." or ".
          "u.u_manager_id = ". $user->getManagerId() ." or u.u_id = ". $user->getManagerId().")";
      } else {
        $sql .=  " where (u.u_manager_id = ". $user->getManagerId() ." or u.u_id = ". $user->getManagerId() .")";
      }
    }
    $sql .= " and u.u_active = 1 order by u.u_manager_id, u.u_name";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        if ($alldata) {
          $val["aprojects"] = UserHelper::findProjects($val["u_id"], $user->getOwnerId());
        }
        $result[] = $val;
      }
      $result = mu_sort($result,"u_manager_id,u_name");
    }
    return $result;
  }

        /**
         * Finds all user accounts
         * @return array
         */
  static function findAllAccount() {
    $result = array();
    $mdb2 = getConnection();

    $sql =  "select * from companies c, users u where u.u_company_id = c.c_id and u.u_manager_id is null
      and u.u_active < 1000 and u.u_active >= 1";
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
         * Finds all inactive teams (for which there are no log entries for a significant amount of time).
         * @return array
         */
  static function findInactiveTeams() {
    $managers = array();
    $mdb2 = getConnection();

    // Find all managers.
    $ts = date('Y-m-d', strtotime('-1 year')); 
    $sql =  "select u_id from users where u_manager_id is null and u_login <> 'admin' and u_timestamp < '$ts' order by u_id";
    $res = &$mdb2->query($sql);

    $count = 0;
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
      	$manager_id = $val['u_id'];
      	if (UserHelper::isTeamActive($manager_id) == false) {
          $count ++;
      	  $managers[] = $manager_id;
      	  // Limit the array size for perfomance by allowing this operation on small chunks only.
      	  if ($count >= 100) break;
      	}
      }
      return $managers;
    }
    return false;
  }

       /**
         * Determines if a team is acrive.
         * @return boolean
         */
  static function isTeamActive($manager_id) {
    $users = $manager_id;
    
  	$mdb2 = getConnection();
    $sql = "select u_id from users where u_manager_id = $manager_id";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) die($res->getMessage());
    while ($val = $res->fetchRow()) {
      $users .= ", ".$val['u_id'];
    }
    
    $count = 0;
  	$ts = date('Y-m-d', strtotime('-2 years')); 
    $sql = "select count(*) as cnt from activity_log where al_user_id in ($users) and al_timestamp > '$ts'";  
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if ($val = $res->fetchRow()) {
        $count = $val['cnt'];
      }
    }
    
    if ($count == 0)
      return false;  // No time entries for the last 2 years.
      
    if ($count <= 5) {
      // We will consider a team inactive if it has 5 or less time entries made more than 1 year ago.
      $count_last_year = 0;
      $ts = date('Y-m-d', strtotime('-1 year')); 
      $sql = "select count(*) as cnt from activity_log where al_user_id in ($users) and al_timestamp > '$ts'";  
      $res = &$mdb2->query($sql);
      if (PEAR::isError($res) == 0) {
        if ($val = $res->fetchRow()) {
          $count_last_year = $val['cnt'];
        }
        if ($count_last_year == 0)
          return false;  // No time entries for the last year and only a few entries before that...
      } 
    }
    return true;
  }

  
       /**
         * Permanently deletes ALL data for an inactive team.
         * @return boolean
         */
  static function deleteInactiveTeam($manager_id) {
  	$mdb2 = getConnection();
    $sql = "select u_id from users where u_manager_id = $manager_id";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) die($res->getMessage());
    while ($val = $res->fetchRow()) {
      $user_id = $val['u_id'];
      if (UserHelper::deleteInactiveUser($user_id) == false)
  	    return false;
    }
    return UserHelper::deleteInactiveUser($manager_id);
  }

       /**
         * Permanently deletes ALL data for an inactive user.
         * @return boolean
         */
  static function deleteInactiveUser($user_id) {
  	$mdb2 = getConnection();
  	
  	// Clean up activity log
  	$sql = "delete from activity_log where al_user_id = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());
    
    // Clean up sysconfig
  	$sql = "delete from sysconfig where sysc_id_u = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());    

    // Clean up report_filter_set
  	$sql = "delete from report_filter_set where rfs_id_u = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());    

    // Clean up clients
  	$sql = "delete from clients where clnt_id_um = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());    
  	
    // Clean up invoice_header
  	$sql = "delete from invoice_header where ih_user_id = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());   
  	
    $res = UserHelper::deleteActivities($user_id);

    // Clean up projects
  	$sql = "delete from projects where p_manager_id = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());

    // Clean up user_bind
  	$sql = "delete from user_bind where ub_id_u = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());

    // Delete company
  	$sql = "select u_company_id from users where u_id = $user_id";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) die($res->getMessage());
    $val = $res->fetchRow();
    $company_id = $val['u_company_id'];
    if ($company_id) {
      $sql = "delete from companies where c_id = $company_id";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected)) die($affected->getMessage());
    }
        
    // Delete user
  	$sql = "delete from users where u_id = $user_id";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected)) die($affected->getMessage());
    
    return true;
  }
  
    /**
         * Permanently deletes ALL activities and activity binds for an inactive team.
         * @return boolean
         */
  static function deleteActivities($manager_id) {
  	$mdb2 = getConnection();
  	$sql = "select a_id from activities where a_manager_id = $manager_id";
  	$res = &$mdb2->query($sql);
  	if (PEAR::isError($res)) die ($res->getMessage());
  	while ($val = $res->fetchRow()) {
  	  
  	  // Clean up activity_bind
  	  $activity_id = $val['a_id'];
  	  $sql = "delete from activity_bind where ab_id_a = $activity_id";
  	  $affected = &$mdb2->exec($sql);
  	  if (PEAR::isError($res)) die ($res->getMessage());
  	  
  	  // Clean up activities
  	  $sql = "delete from activities where a_id = $activity_id";
  	  $affected = &$mdb2->exec($sql);
  	  if (PEAR::isError($res)) die ($res->getMessage());  	  
  	}
  }

  
  /**
   * Finds user by login
   *
   * @param string $login
   * @return array
   */
  static function findUserByLogin($login) {
    $mdb2 = getConnection();

    $sql = "select u.u_id, u.u_name from users u where u.u_login = ".mdb2_quote($mdb2, $login)." and u.u_active = 1";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }


  /**
   * Finds user by user ID
   *
   * @param string $user_id
   * @return array
   */
  static function findUserById($user_id, $user, $check_projects=true) {
    $mdb2 = getConnection();

    if(!isset($user)) return false;

    $sql = "SELECT u_id, u_manager_id, u_name, u_login, c_name, c_www, u_rate, u_show_pie, u_pie_mode, u_lang, c_currency, c_locktime, u_comanager, u_email
      FROM users LEFT JOIN companies ON (u_company_id = c_id)
      WHERE u_id = $user_id  AND u_active = 1";

    if ($user->isManager()) {
      $sql .= " AND (u_manager_id = ". $user->getOwnerId() ." OR u_id = ". $user->getUserId() .")";
    } elseif ($user->isCoManager()) {
      $sql .= " AND u_manager_id = ". $user->getOwnerId() ." AND (u_comanager is null OR (u_id = ". $user->getUserId() ." AND u_comanager is not null))";
    } else {
      $sql .= " AND (u_manager_id = ". $user->getOwnerId() ." AND u_comanager is null)";
    }

    $res = &$mdb2->query($sql);
    
    if (PEAR::isError($res) == 0) {
      if ($val = $res->fetchRow()) {
        if ($val["u_name"] != '') {
          $val["projects"] = UserHelper::findProjects($user_id, $user->getOwnerId(), $check_projects);
          return $val;
        } else {
          return false;
        }
      }
      return false;
    }
  }

  /**
   * Gets manager of account
   *
   * @return array
   */
  static function findManagerOfAccount($acc_id) {
    $mdb2 = getConnection();

    $sql = "select u.u_id, u.u_manager_id, u.u_name, u.u_login, c.c_name, c.c_www, u.u_rate, c.c_currency, u.u_comanager
      from users u, companies c where u.u_active = 1 and u.u_company_id = c.c_id
      and u_manager_id is null and c.c_id = $acc_id";

    $res = &$mdb2->query($sql);

    if (PEAR::isError($res) == 0) {
        $val = $res->fetchRow();

        if ($val["u_name"] != '') {
            return $val;
        } else {
            return false;
        }
      }
    return false;
  }

  /**
   * Finds account by ID
   *
   * @param int $acc_id
   * @return array
   */
  static function findAccountById($acc_id) {
    $mdb2 = getConnection();

    $sql = "select * from companies left join users on (c_id = u_company_id and u_manager_id is null) where c_id = ".$acc_id;
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      
      if (isset($val["c_id"])) {

      	$sql = "select * from users u where u.u_company_id = $acc_id and u.u_active = 1";
        $res = &$mdb2->query($sql);

        if (PEAR::isError($res) == 0) {
          $users = array();
          while ($uval = $res->fetchRow()) {
            $users[] = $uval;
          }
          $val["users"] = $users;
        }
        return $val;
      } else {
        return false;
      }
    }
    return false;
  }

  /**
   * Gets array of user data
   *
   * @param int $user_id
   * @return array
   */
  static function getUserArrById($user_id) {
    $mdb2 = getConnection();

    $sql = "select * from users u where u.u_id = $user_id and u.u_active = 1";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {

      $val = $res->fetchRow();
      if ($val["u_name"] != '') {
        return $val;
      } else {
        return false;
      }
    }
    return false;
  }

  /**
   * Gets string of user details
   *
   * @param User $user
   * @param I18n $i18n
   * @return string
   */
  static function getUserDetailsString($user, $i18n) {
    $pers_manager_info = "";

    if ($user->isManager()) {
        $pers_manager_info = $i18n->getKey('label.pminfo');
      }
      if ($user->isCoManager()) {
        $pers_manager_info = $i18n->getKey('label.pcminfo');
      }
      if ($user->isAdministrator()) {
        $pers_manager_info = $i18n->getKey('label.painfo');
      }

      if($user->getBehalfId()>0) {
        $username = sprintf($i18n->getKey('label.pbehalf_info'), $user->getUserName(), $pers_manager_info, $user->getBehalfName());
      } else {
        $username = sprintf("%s %s", $user->getUserName(), $pers_manager_info);
      }
    $username = trim($username);

      if ($user->getCompanyName()) {
        $www = trim($user->getWww());
        if ($www = trim($user->getWww())) {
          if (substr($www,0,7) == "http://") {
            $www = substr($www,7);
          }
          if (substr($www,-1)=="/") {
            $www = substr($www,0,strlen($www)-1);
          }

          $company_str = $user->getCompanyName()." (<a href='".$user->getWww()."' target=\"_blank\">".$www."</a>)";
        } else {
          $company_str = $user->getCompanyName();
        }
        $res = sprintf($i18n->getKey('label.pinfo'), $username, $company_str);
      } else {
        $res = sprintf($i18n->getKey('label.pinfo2'), $username);
      }
      return $res;
  }

  /**
   * Creates new account for user
   *
   * @param array $fields
   * @param array $options
   * @return boolean
   */
  static function insertAccount($fields, $options = null) {

    $mdb2 = getConnection();
    $mdb2->setOption('seqcol_name', 'id'); // for compatibility with sequence tables generated by PEAR::DB
    $id = $mdb2->nextID('companies_c_id');
    
    if (@$fields['locktime'] !== null) {
      $locktime_f = ', c_locktime';
      $locktime_v = ", " . (int)$fields['locktime'];
    } else {
      $locktime_f = '';
      $locktime_v = '';
    }
    
    $sql = "insert into companies (c_id, c_name, c_www, c_currency $locktime_f) values($id, ".
      mdb2_quote($mdb2, $fields['company']).", ".mdb2_quote($mdb2, $fields['company_www']).
      ", ".mdb2_quote($mdb2, $fields['currency']).$locktime_v.")";
    $affected = &$mdb2->exec($sql);

    if (PEAR::isError($affected) == 0) {
      $password = mdb2_quote($mdb2, $fields['password']);

      $encode_pass = isset($options['encode_pass']) ? $options['encode_pass'] : true;
      if ($encode_pass) {
        $ppart = "md5(".$password.")";
      } else {
        $ppart = $password;
      }

      $lang = @$fields['lang'];
      if ($lang === null) {
        $user_arr = UserHelper::findUserByLogin("admin");
        $sc_a = new SysConfig(new User($user_arr["u_id"], false));
        $lang = $sc_a->getValue('lang_default');
        if (!$lang) $lang = 'en';
      }

      $show_pie = @$fields['show_pie'];
      if ($show_pie !== null) {
        $show_pie_f = ', u_show_pie';
        $show_pie_v = ', ' . (int)$show_pie;
      } else {
        $show_pie_f = '';
        $show_pie_v = '';
      }

      $pie_mode = @$fields['pie_mode'];
      if ($pie_mode !== null) {
        $pie_mode_f = ', u_pie_mode';
        $pie_mode_v = ', ' . (int)$pie_mode;
      } else {
        $pie_mode_f = '';
        $pie_mode_v = '';
      }

      $email = @$fields['email'];

      $sql= "insert into users (u_name, u_login, u_password, u_company_id, u_lang, u_email $show_pie_f $pie_mode_f) values (".
        mdb2_quote($mdb2, $fields['name']).", ".mdb2_quote($mdb2, $fields['login']).", $ppart, $id, ".
        mdb2_quote($mdb2, $lang).", ".
        mdb2_quote($mdb2, $email)." $show_pie_v $pie_mode_v)";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) == 0) {
        $sql = "SELECT LAST_INSERT_ID() AS insert_id";
        $res = &$mdb2->query($sql);
        $val = $res->fetchRow();
        return $val['insert_id'];
      } else {
        $sql = "delete from companies WHERE c_id = $id";
        $affected = &$mdb2->exec($sql);
        return false;
      }
    }
    return false;
  }

        /**
         * Updates account
         * @param User $user
         * @param array $fields
         * @param array $options
         * @return boolean
         */
  static function updateAccount($user, $fields, $options = null)    
  {
    $mdb2 = getConnection();
    
    $pass_part = "";
    $upd_str2 = "";

    $password = $fields['password'];
    if ($password) {
      $pass_part = ", u_password = md5(".mdb2_quote($mdb2, $password).")";
    } else {
      $pass_part = "";
    }

    $company_part="";
    $company_www_part="";
    $curr_part = "";
    $locktime_part = "";
    if (isset($fields['company_www'])) $company_www_part = ", c_www = ".mdb2_quote($mdb2, $fields['company_www']);
    if (isset($fields['company'])) $company_part = ", c_name = ".mdb2_quote($mdb2, $fields['company']);
    if (isset($fields['currency'])) $curr_part = ", c_currency = ".mdb2_quote($mdb2, $fields['currency']);
    if (isset($fields['locktime'])) $locktime_part = ", c_locktime = ".intval($fields['locktime']);

    if (isset($fields['lang'])) {
      $lang_part = ", u_lang = '".$fields['lang']."'";
    } else {
      $lang_part = "";
    }

    if (isset($fields['email'])) {
      $email_part = ", u_email = ".mdb2_quote($mdb2, $fields['email']);
    } else {
      $email_part = "";
    }

    if(isset($fields['show_pie']) AND isset($fields['pie_mode'])) {
      $pie_part = ", u_show_pie = ".$fields['show_pie'].", u_pie_mode = ".$fields['pie_mode'];
    }
    else
      $pie_part = ", u_show_pie = 0";

    // Update company information.
    if ($user->isManager()) {
      $sql = "select u_company_id from users where u_id = ".$user->getUserId();
      $res = &$mdb2->query($sql);
      if (PEAR::isError($res) == 0) {
        $val = $res->fetchRow();
        if ($val['u_company_id']) {
          $sql = "update companies set c_id=".$val['u_company_id']." $locktime_part $company_part $company_www_part $curr_part where c_id = ".$val['u_company_id'];
          $affected = &$mdb2->exec($sql);
          if (PEAR::isError($affected) != 0) return false;
        } else return false;
      } else return false;
    }

    // Update user information.
    $sql = "update users set u_name = ".mdb2_quote($mdb2, $fields['name']).
      ", u_login = ".mdb2_quote($mdb2, $fields['login']). 
      " $pass_part $pie_part $lang_part $email_part where u_id = ".$user->getUserId();
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) != 0) {
      return false;
    }

    // Update language setting for all team members if we need to.
    if (isset($fields['lang']) && @$options['lang_set_to_all']) {
      $sql = "update users set u_lang = '".$fields['lang']."' where u_manager_id = ".$user->getUserId();
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected) != 0) {
        return false;
      }
    }
    return true;
  }


  /**
   * Appends new employee
   *
   * @param string $user
   * @param array $fields
   * @param array $options
   * @return bool
   */
  static function addEmployee($user, $fields, $options = null)
  {
    $mdb2 = getConnection();

    $rate = str_replace(",",".",isset($fields['rate']) ? $fields['rate'] : 0);
    if($rate == '')
      $rate = 0;
    $comanager = empty($fields['comanager']) ? 'null' : $fields['comanager'];
    $password = mdb2_quote($mdb2, $fields['password']);

    if(@$options['encode_pass']) {
      $ppart = "md5(".$password.")";
    }
    else {
      $ppart = $password;
    }

    $lang = @$fields['lang'];
    if ($lang === null) {
      $user_arr = UserHelper::findUserByLogin("admin");
      $sc_a = new SysConfig(new User($user_arr["u_id"], false));
      $lang = $sc_a->getValue('lang_default');
      if (!$lang) $lang = 'en';
    }

    $email = isset($fields['email']) ? $fields['email'] : '';

    $sql = "insert into users (u_name, u_login, u_password, u_manager_id, u_company_id, u_rate, u_comanager, u_lang, u_email) values (".
      mdb2_quote($mdb2, $fields['name']).", ".mdb2_quote($mdb2, $fields['login']).
      ", $ppart, ".$user->getOwnerId().", ".$user->getCompanyId().", $rate, $comanager, ".mdb2_quote($mdb2, $lang).", ".mdb2_quote($mdb2, $email).")";
    $affected = &$mdb2->exec($sql);
    if(PEAR::isError($affected) == 0) {
      $sql = "SELECT LAST_INSERT_ID() AS last_id";
      $res = &$mdb2->query($sql);
      $val = $res->fetchRow();
      $lastid = $val['last_id'];

      $aprojects = isset($fields['aprojects']) ? $fields['aprojects'] : array();
      if (is_array($aprojects) && (count($aprojects) > 0)) {

      	// Determine if we have at least one project assigned to user.
      	$p_assigned = false;
      	foreach($aprojects as $p) {
      	  if(isset($p["ub_checked"])) {
      	    $p_assigned = true;
      	    break;
          }
      	}
        if ($p_assigned) {
      	  // We have at least one project assigned. Insert corresponding entries in user_bind table.
          foreach($aprojects as $p) {
            if(!isset($p["ub_rate"]))
              $p["ub_rate"] = 0;
            else
              $p["ub_rate"] = str_replace(",",".",$p["ub_rate"]);
            if(isset($p["ub_checked"])) {
              $sql = "insert into user_bind (ub_id_p, ub_id_u, ub_rate, ub_checked) values(".$p["p_id"].",".$lastid.",".$p["ub_rate"].",".$p["ub_checked"].")";
              $affected = &$mdb2->exec($sql);
            }
          }
        }	
      }
      return $lastid;
    }
    return false;
  }

        /**
         * Updates the employee
         * @param User $user
         * @param array $fields
         * @param array $options
         * @return boolean
         */
  static function updateEmployee($user, $fields, $options = null) {
    $mdb2 = getConnection();

    $rate = isset($fields['rate']) ? $fields['rate'] : 0;
    $rate = str_replace(",",".",$rate);
    if ($rate=='') $rate = 0;

    $comanager = empty($fields['comanager']) ? 'null' : $fields['comanager'];
      
    $user_id = $fields['user_id'];
    if (($user->getUserId() == $user_id) && $user->isCoManager()) $comanager = 1;

    $password = $fields['password'];
    $pass_part = '';
    if ($password) {
      $pass_part = ", u_password = md5(".mdb2_quote($mdb2, $password).")";
    } else {
      $pass_part = "";
    }

    if (isset($fields['email'])) {
      $email_part = ", u_email = ".mdb2_quote($mdb2, $fields['email']);
    } else {
      $email_part = '';
    }

    $sql = "update users set u_name = ".mdb2_quote($mdb2, $fields['name']).
      ", u_login = ".mdb2_quote($mdb2, $fields['login']).
      ", u_rate = $rate, u_comanager = $comanager $pass_part $email_part where u_id = $user_id".
      " and (u_manager_id = ".$user->getOwnerId()." or u_id = ".$user->getUserId().")";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) == 0) {
      	
      // Handle user to project binds. Algorithm:
      // 
      // Get a list of all projects.
      // Get a list of assigned projects.
      // Iterate through the list of all projects.
      //   if a project is not assigned - call the deleteProjectBind function.
      //   if a project is assigned - either update or insert new user_bind record.
      	
      // Get a list of all projects.
      $projects = UserHelper::findProjects($user->getUserId(), $user->getOwnerId(), false);
      // Get a list of assigned projects.
      $aprojects = isset($fields['aprojects']) ? $fields['aprojects'] : array();
      foreach ($projects as $p) {
        // Determine if a project is assigned.
        $assigned = false;
        $project_id = $p['p_id'];
        $rate = 0;
        if (is_array($aprojects) && (count($aprojects) > 0)) {
          foreach ($aprojects as $ap) {
            if ($project_id == $ap['p_id']) {
              $assigned = true;
              $rate = $ap['ub_rate']; 	
              break;
          	}
          }
        }
          
        if (!$assigned) {
          UserHelper::deleteProjectBind($user_id, $project_id);
        } else {
          // Here we need to either update or insert new user_bind record.
          // Determine if a record exists.
          $sql = "select ub_id from user_bind where ub_id_u = $user_id and ub_id_p = $project_id";
          $res = &$mdb2->query($sql);
          if (PEAR::isError($res)) die ($res->getMessage());
          if ($val = $res->fetchRow()) {
            // Record exists. Update it.
            $sql = "update user_bind set ub_checked = 1, ub_rate = $rate where ub_id = ".$val['ub_id'];
       	    $affected = &$mdb2->exec($sql);
            if (PEAR::isError($affected)) die ($res->getMessage());
          } else {
            // Record does not exist. Insert it.
            UserHelper::insertProjectBind($user_id, $project_id, $rate, 1);
          }
        }
      }
      return true;
    }
    return false;
  }

  /**
   * Deleting employee record
   *
   * @param $manager
   * @param int $user_id
   * @return boolean
   */
  static function deleteEmployee($manager, $user_id) {
    $mdb2 = getConnection();
      
    $employee_count = UserHelper::getEmployeeCount($user_id);
    $is_manager = ($manager->getUserId() == $user_id);
    
    // Deleting a manager with active employees  is not allowed.
    if ($is_manager && ($employee_count > 0))
      return false;

    $deleted = DELETED;
    if (!$employee_count) {
      // No employees.
      if ($is_manager) {
      	//  Mark team projects as deleted.
        $sql = "update projects set p_status = $deleted where p_manager_id = $user_id";
        $affected = &$mdb2->exec($sql);
        if (PEAR::isError($affected) != 0) {
          return false;
        }
 
        // Mark team activities as deleted.
        $sql = "update activities set a_status = $deleted where a_manager_id = $user_id";
        $affected = &$mdb2->exec($sql);
        if (PEAR::isError($affected) != 0) {
          return false;
        }
      }
    }

    // Delete user.
    $sql = "update users set u_active = $deleted where u_id = $user_id
      and (u_manager_id = ". $manager->getOwnerId() ." or u_id = ". $manager->getUserId() .")";
    $affected = &$mdb2->exec($sql);
    if (PEAR::isError($affected) != 0) {
      return false;
    } else {
      return true;
    }
  }

        /**
         * Deletes a team from database
         * @param int $company_id
         * @return boolean
         */
  static function deleteAccount($company_id) {
    $mdb2 = getConnection();
      
    // Find a team manager 
    $manager_arr = UserHelper::findManagerOfAccount($company_id);
    $manager = new User($manager_arr["u_id"], false);

    $sql = "select u.u_id from users u where u.u_manager_id = ".$manager->getUserId()."  and u.u_active = 1";
    $res = &$mdb2->query($sql);
    
    if (PEAR::isError($res) == 0) {
      // Delete all team members.
      while ($val = $res->fetchRow()) {
        if (!UserHelper::deleteEmployee($manager, $val["u_id"])) {
          return false;
        }
      }
    
      // Now delete the manager.
      if (!UserHelper::deleteEmployee($manager, $manager->getUserId())) {
        return false;
      }
      return true;
    }
    return false;
  }

  /**
   * Gets employee count for manager
   *
   * @param int $manager_id
   * @return boolean
   */
  static function getEmployeeCount($manager_id) {
    $mdb2 = getConnection();
    
    $sql = "select count(u.u_id) as cnt from users u where u.u_manager_id = $manager_id and u.u_active = 1";
    $res = &$mdb2->query($sql);

    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      return $val['cnt'];
    }
    return false;
  }



  /**
         * Generates random password and update user record in database
         * @param int $ref
         * @param int $user_id
         * @return boolean
         */
  static function saveTmpRef($ref, $user_id) {
    $mdb2 = getConnection();
    
    $sql = "delete from tmp_refs where tr_created + 86400 < now()";
    $affected = &$mdb2->exec($sql);

    $sql = "insert into tmp_refs (tr_code, tr_userid) values(".mdb2_quote($mdb2, $ref).", $user_id)";
    $affected = &$mdb2->exec($sql);
  }

        /**
         * Returns user ID over ref ID
         * @param string $ref
         * @return int
         */
  static function getUserIdByTmpRef($ref) {
    $mdb2 = getConnection();
    
    $sql = "select tr_userid from tmp_refs where tr_code = ".mdb2_quote($mdb2, $ref);
    $res = &$mdb2->query($sql);

    if (PEAR::isError($res) == 0) {
      $val = $res->fetchRow();
      return $val['tr_userid'];
    }
    return false;
  }

        /**
         * Updates password for the user
         * @param int $user_id
         * @param string $password
         * @return boolean
         */
  static function setPassword($user_id, $password) {
    $mdb2 = getConnection();
      
    $sql = "update users set u_password = md5(".mdb2_quote($mdb2, $password).") where u_id = $user_id";
    $affected = &$mdb2->exec($sql);
      
    if (PEAR::isError($affected) != 0)
      return false;
      
    return true;
  }

        /**
         * Finds all projects for user
         *  - if $assigned is true then the function returns only assigned projects
         * @param int $user_id
         * @param int $manager_id
         * @param boolean $assigned
         * @return array
         */
  static function findProjects($user_id, $manager_id, $assigned = true) {
    $mdb2 = getConnection();
      
    $projects = array();
    $sql = "select ub_id, p_id, p_name, ub_id_p, ub_id_u, ub_rate, ub_checked
      from projects left join user_bind on (p_id = ub_id_p and ub_id_u = $user_id)
      where p_manager_id = $manager_id and p_status = 1".($assigned ? " and ub_checked=1" : "");
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res) == 0) {
      while ($val = $res->fetchRow()) {
        $projects[] = $val;
      }
      return $projects;
    }
    return false;
  }

        /**
         * Finds all user to project binds for a team.
         * @param int $manager_id
         * @return array
         */
  static function findAllUserBinds($manager_id) {
    $mdb2 = getConnection();
      
    $result = array();
    $sql = "select u_id, ub_id_u, ub_id_p, ub_rate, ub_checked from users
      inner join user_bind on (ub_id_u = u_id)
      where (u_id = $manager_id or u_manager_id = $manager_id)
      order by ub_id_u";
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
         * Binds project with user
         * @param int $user_id
         * @param int $project_id
         * @param float $rate
         * @param boolean $checked
         * @return boolean
         */
  static function insertProjectBind($user_id, $project_id, $rate, $checked) {
    $mdb2 = getConnection();
    
    $sql = "insert into user_bind (ub_id_u, ub_id_p, ub_rate, ub_checked)
      values($user_id, $project_id, '$rate', $checked)";
    $affected = &$mdb2->exec($sql);
    return (PEAR::isError($affected) == 0);
  }

        /**
         * Either deletes a project bind record if we don't have time entries for it
         * or unchecks it if we do.
         *
         * @param int $user_id
         * @param int $project_id
         * @return boolean
         */
  static function deleteProjectBind($user_id, $project_id) {
    $mdb2 = getConnection();
    
    $sql = "select count(*) as cnt from activity_log where 
      al_user_id = $user_id and al_project_id = $project_id";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) die ($res->getMessage());
    
    $count = 0;
    $val = $res->fetchRow();
    $count = $val['cnt'];
    
    if ($count > 0) {
      // Uncheck user bind record.
      $sql = "select ub_id from user_bind where ub_id_u = $user_id
        and ub_id_p = $project_id";
       $res = &$mdb2->query($sql);
       if (PEAR::isError($res)) die ($res->getMessage());
       if ($val = $res->fetchRow()) {
         $sql = "update user_bind set ub_checked = 0 where ub_id = ".$val['ub_id'];
       	 $affected = &$mdb2->exec($sql);
         if (PEAR::isError($affected)) die ($res->getMessage());
       }
    } else {
      // Delete record.
      $sql = "delete from user_bind where ub_id_u = $user_id and ub_id_p = $project_id";
      $affected = &$mdb2->exec($sql);
      if (PEAR::isError($affected)) die ($res->getMessage());
    } 
    return true;
  }
}
?>