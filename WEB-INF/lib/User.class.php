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

import("UserHelper");

/**
 * User class uses for represent of the data about the current user
 * @package TimeTracker
 */
class User {
  var $session;
  var $_sessionName = '_usersession';
  var $mUserId;
  var $mBehalfId = null;
  var $mBehalfName;
  var $mBehalfProjects = null;
  var $mLogin;
  var $mUserName;
  var $mRoles;
  var $mCompanyName;
  var $mCompanyId;
  var $mWww;
  var $mManagerId = 0;
  var $mRate;
  var $mCurrency;
  var $mProjectsString = null;
  var $mFlagCM; // flag co-manager
  var $mLocktime = -1;
  var $mLang = null;
  var $mEmail = null;
  var $mShowPie = null;
  var $mPieMode = null;

  var $mStoreInSession = false;

        /**
         * Constructor.
         * If $store_in_session is true after create user
         * object it stores in session
         * @param int $userid
         * @param boolean $store_in_session
         */
  function User($userid="", $store_in_session=true) {

    $this->mStoreInSession = $store_in_session;

    if ($this->mStoreInSession) {
      if( !isset($_SESSION[$this->_sessionName]) && !isset($GLOBALS['HTTP_SESSION_VARS'][$this->_sessionName]) ) {
        $_SESSION[$this->_sessionName] = array();
      }

      if (!isset($_SESSION[$this->_sessionName]["userid"])) {
         $this->setUserId($userid);
      } else {
        $this->mUserId = $_SESSION[$this->_sessionName]["userid"];
        $this->mLogin = $_SESSION[$this->_sessionName]["username"];
        $this->mUserName = @$_SESSION[$this->_sessionName]["name"];
        $this->mCompanyName = @$_SESSION[$this->_sessionName]["cname"];
        $this->mCompanyId = @$_SESSION[$this->_sessionName]["cid"];
        $this->mWww = @$_SESSION[$this->_sessionName]["www"];
        $this->mRate = @$_SESSION[$this->_sessionName]["rate"];
        $this->mManagerId = @$_SESSION[$this->_sessionName]["manager"];
        $this->mFlagCM = @$_SESSION[$this->_sessionName]["comanager"];
        if (isset($_SESSION[$this->_sessionName]["behalfid"])) {
          $this->mBehalfId = $_SESSION[$this->_sessionName]["behalfid"];
          $this->mBehalfName = @$_SESSION[$this->_sessionName]["behalfname"];
        }
        if (isset($_SESSION[$this->_sessionName]["behalfprojects"]))
          $this->mBehalfProjects = $_SESSION[$this->_sessionName]["behalfprojects"];
        $this->mCurrency = @$_SESSION[$this->_sessionName]["currency"];
        $this->mProjects = @$_SESSION[$this->_sessionName]["projects"];
        $this->mLocktime = @$_SESSION[$this->_sessionName]["locktime"];
        $this->mLang = @$_SESSION[$this->_sessionName]["lang"];
        $this->mEmail = @$_SESSION[$this->_sessionName]["email"];
        $this->mShowPie = @$_SESSION[$this->_sessionName]["show_pie"];
        $this->mPieMode = @$_SESSION[$this->_sessionName]["pie_mode"];
      }
      if (isset($GLOBALS["SMARTY"])) $GLOBALS["SMARTY"]->assign("user",$this);
    } else {
      $this->setUserId($userid);
    }
  }

        /**
         * Retrieves user's ID
         * @return int
         */
  function getUserId() {
    return $this->mUserId;
  }

        /**
         * Reads the data of the user with $id from database and stores
         * them in session. Retrieves true if storing
         * has passed successfully.
         * @param int $id
         * @return boolean
         */
  function setUserId($id) {
    $mdb2 = getConnection();
    $sql = "SELECT u_id, u_manager_id, u_name, u_login, u_password, c_name, 
      c_www, u_rate, c_currency, c_locktime, u_company_id, u_comanager, u_lang,
      u_show_pie, u_pie_mode, u_email
      FROM users AS u LEFT JOIN companies c ON (u.u_company_id = c.c_id)
      WHERE u.u_id = $id AND u.u_active = 1";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) {
      return false;
    }
    
    $val = $res->fetchRow();
    if ($val['u_id'] > 0) {
      $this->mUserId = $val['u_id'];
      $this->mLogin = $val['u_login'];
      $this->mUserName = $val['u_name'];
      $this->mCompanyName = $val['c_name'];
      $this->mCompanyId = $val['u_company_id'];
      if (@$val['c_www']) {
        $href = strpos($val['c_www'],'http://')=== false ? 'http://'.$val['c_www'] : $val['c_www'];
      }
      $this->mWww = @$href;
      $this->mRate = $val['u_rate'];
      $this->mCurrency = $val['c_currency'];
      $this->mLocktime = $val['c_locktime'];
      $this->mManagerId = ($val['u_manager_id']>0 ? $val['u_manager_id'] : 0);
      if (@$val['u_comanager']) {
        $this->mFlagCM = ($val['u_comanager']==1);
      }
      $this->mProjects = UserHelper::findProjects($id, $this->getOwnerId(), true);
      $this->mLang = $val['u_lang'];
      $this->mEmail = $val["u_email"];
      $this->mShowPie = $val["u_show_pie"];
      $this->mPieMode = $val["u_pie_mode"];

      if ($this->mStoreInSession) {
        $_SESSION[$this->_sessionName]["userid"] = $this->mUserId;
        $_SESSION[$this->_sessionName]["username"] = $this->mLogin;
        $_SESSION[$this->_sessionName]["name"] = $this->mUserName;
        $_SESSION[$this->_sessionName]["cname"] = $this->mCompanyName;
        $_SESSION[$this->_sessionName]["cid"] = $this->mCompanyId;
        $_SESSION[$this->_sessionName]["www"] = $this->mWww;
        $_SESSION[$this->_sessionName]["rate"] = $this->mRate;
        $_SESSION[$this->_sessionName]["currency"] = $this->mCurrency;
        $_SESSION[$this->_sessionName]["locktime"] = $this->mLocktime;
        $_SESSION[$this->_sessionName]["manager"] = $this->mManagerId;
        $_SESSION[$this->_sessionName]["comanager"] = $this->mFlagCM;
        $_SESSION[$this->_sessionName]["projects"] = $this->mProjects;
        $_SESSION[$this->_sessionName]["lang"] = $this->mLang;
        $_SESSION[$this->_sessionName]["email"] = $this->mEmail;
        $_SESSION[$this->_sessionName]["show_pie"] = $this->mShowPie;
        $_SESSION[$this->_sessionName]["pie_mode"] = $this->mPieMode;
      }
        return true;
      } else {
        return false;
      }
  }

        /**
         * Retrieves login of current user
         * @return String
         */
  function getLogin() { return $this->mLogin; }

        /**
         *
         * @param String $login
         */
  function setLogin($login) {$this->mLogin = $login; }

        /**
         * Retrieves name of user
         * @return String
         */
  function getUserName() { return $this->mUserName; }

        /**
         *
         * @param String $uname
         */
  function setUserName($uname) {$this->mUserName = $uname; }

        /**
         * Retrieves accessible roles for current user
         * @return array
         */
  function getRoles() { return $this->mRoles; }

        /**
         *
         * @param array $roles
         */
  function setRoles($roles) {$this->mRoles = $roles; }

        /**
         * Retrieves name of company
         * @return int
         */
  function getCompanyName() { return $this->mCompanyName; }

        /**
         *
         * @param String $name
         */
  function setCompanyName($name) {$this->mCompanyName = $name; }

        /**
         * Retrieves ID of company
         * @return int
         */
  function getCompanyId() { return $this->mCompanyId; }

        /**
         *
         * @param int $value
         */
  function setCompanyId($value) {$this->mCompanyId = $value; }

        /**
         * Retrieves address of web page
         * @return String
         */
  function getWww() { return $this->mWww; }

        /**
         *
         * @param String $www
         */
  function setWww($www) { $this->mWww = $www; }

        /**
         * Retrieves manager's ID
         * @return int
         */
  function getManagerId() { return $this->mManagerId; }

        /**
         *
         * @param int $id
         */
  function setManagerId($id) { $this->mManagerId = $id; }

        /**
         * Retrieves rate for current user
         * @return float
         */
  function getRate() { return $this->mRate; }

        /**
         *
         * @param float $rate
         */
  function setRate($rate) { $this->mRate = $rate; }

        /**
         * Retrieves currency name
         * @return String
         */
  function getCurrency() { return $this->mCurrency; }

        /**
         *
         * @param String $curr
         */
  function setCurrency($curr) { $this->mCurrency = $curr; }

        /**
         * Retrieves time (in days) after which occur locked period
         * @return int
         */
  function getLocktime() { return $this->mLocktime; }

        /**
         *
         * @param int $value
         */
  function setLocktime($value) { $this->mLocktime = $value; }

        /**
         * Retrieves accessible projects
         * @return array
         */
  function getProjects() {
    if ($this->mBehalfId>0) {
      return ($this->mBehalfProjects?$this->mBehalfProjects:array());
    } else {
      if (!$this->isManager())
        $this->mProjects = UserHelper::findProjects($this->mUserId, $this->getOwnerId(), true);
      return ($this->mProjects?$this->mProjects:array());
    }
  }

        /**
         * Getter for Behalf User ID
         * @return int
         */
  function getBehalfId() { return $this->mBehalfId; }

        /**
         * Reads the data of the user on behalf of user with $id
         * from database and stores them in session. Retrieves true if storing
         * has passed successfully.
         * @param int $id
         * @return boolean
         */
  function setBehalfId($id) {
    $mdb2 = getConnection();
    $manager_id = $this->getOwnerId();
    $sql = "select u.u_id, u.u_manager_id, u.u_name, u.u_login, u.u_rate, u.u_comanager
        from users u, companies c
        where u.u_id = $id and u.u_manager_id = $manager_id and u.u_active = 1";
    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) {
      return false;
    }

    if ((int)$id == $this->mUserId) {
      $_SESSION[$this->_sessionName]["behalfid"] = $this->mBehalfId = 0;
      $_SESSION[$this->_sessionName]["behalfname"] = $this->mBehalfName = "";
      $_SESSION[$this->_sessionName]["behalfprojects"] = $this->mBehalfProjects = array();
      return true;
    }

    $val = $res->fetchRow();
    if ($val['u_id'] > 0) {
      $_SESSION[$this->_sessionName]["behalfid"] = $this->mBehalfId = $val['u_id'];
      $_SESSION[$this->_sessionName]["behalfname"] = $this->mBehalfName = $val['u_name'];
      // support old version 0.4
      /*if ($val["u_aprojects"]) {
        $arr = explode(",",$val["u_aprojects"]);
        $arr1 = array();
        foreach ($arr as $v) $arr1[] = array("p_id"=>$v);
        $_SESSION[$this->_sessionName]["behalfprojects"] = $this->mBehalfProjects =  $arr1;
      } else {*/
        $_SESSION[$this->_sessionName]["behalfprojects"] = $this->mBehalfProjects = UserHelper::findProjects($id, $this->getOwnerId(), true);
      //}
      return true;
    }
    return false;
  }

        /**
         * Getter for BehalfName
         * @return String
         */
  function getBehalfName() { return $this->mBehalfName; }

        /**
         *
         * @param String $name
         */
  function setBehalfName($name) { $this->mBehalfName = $name; }

        /**
         * Checks presence of the specified role at the list of the accessible
         * @param String $role_name
         * @return boolean
         */

  /**
   * Returns user language
   *
   * @return string
   */
  function getLang() { return $this->mLang; }
  /**
   * Sets user language
   *
   * @param string $value
   */
  function setLang($value) { $this->mLang = $value; }

  /**
   * Returns user email.
   *
   * @return string
   */
  function getEmail() { return $this->mEmail; }
  /**
   * Sets user email.
   *
   * @param string $value
   */
  function setEmail($value) { $this->mEmail = $value; }

  /**
   * Returns pie visibility.
   *
   * @return integer
   */
  function getShowPie() { return $this->mShowPie; }
  /**
   * Sets pie visibility.
   *
   * @param integer $value
   */
  function setShowPie($value) { $this->mShowPie = $value; }

  /**
   * Returns pie mode.
   *
   * @return integer
   */
  function getPieMode() { return $this->mPieMode; }
  /**
   * Sets pie mode.
   *
   * @param integer $value
   */
  function setPieMode($value) { $this->mPieMode = $value; }

  function hasRole($role_name) {
    $result = false;
    if (is_array($this->mRoles) && in_array($role_name,$this->mRoles)) $result = true;
    return $result;
  }

        /**
         * Destroy user's data
         *
         */
  function destroy() {
    $_SESSION[$this->_sessionName] = null;
  }

        /**
         * Retrieves true if active user is Manager
         * @return boolean
         */
  function isManager() {
    return ($this->mLogin!="admin" && ($this->mManagerId==0 || !isset($this->mManagerId)));
  }

        /**
         * Retrieves true if active user is Administrator
         * @return boolean
         */
  function isAdministrator() {
    return ($this->mLogin=="admin" && ($this->mManagerId==0 || !isset($this->mManagerId)));
  }

        /**
         * Setter for CoManager role
         * @param boolean $flag
         */
  function setCoManager($flag) {
    $this->mFlagCM = $flag;
  }

        /**
         * Retrieves true if active user is CoManager
         * @return boolean
         */
  function isCoManager() {
    return ($this->mFlagCM==1 && isset($this->mFlagCM));
  }

        /**
         * Retrieves Active User's ID
         * @return int
         */
  function getActiveUser() {
    return ($this->mBehalfId>0 ? $this->mBehalfId : $this->mUserId);
  }

        /**
         * Retrieves Manager's ID for current user
         * @return int
         */
  function getOwnerId() {
    if ($this->isManager()) {
      return $this->getUserId();
    } elseif ($this->isCoManager()) {
      return $this->getManagerId();
    } else {
      return $this->getManagerId();
    }
  }

        /**
         * Rereads active user data from database and store in session
         *
         */
  function reload() {
    $this->mStoreInSession = true;
    if ($this->getBehalfId()>0) {
      // reload data for behalf user
      $this->setBehalfId($this->getBehalfId());
    } else {
      // reload personal data for current user
      $this->setUserId($this->getUserId());
    }
  }

}
?>