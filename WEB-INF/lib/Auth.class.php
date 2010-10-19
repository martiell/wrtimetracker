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

// $Id: Auth.class.php,v 1.15 2009/01/28 05:22:14 nokuntseff Exp $

/**
* Auth class uses for represent of the authentication data
* @package TimeTracker
*/
class Auth {
  //var $session;
  var $_sessionName = '_authsession';
  /*var $username    = '';
  var $password    = '';
  var $mUserId    = null;*/
  var $authResult = null;

  function Auth($params = array()) {
    if( !isset($_SESSION[$this->_sessionName]) && !isset($GLOBALS['HTTP_SESSION_VARS'][$this->_sessionName]) ) {
      $_SESSION[$this->_sessionName] = array();
    }

    if (isset($GLOBALS["SMARTY"])) {
      $GLOBALS["SMARTY"]->assign("authsession",$_SESSION[$this->_sessionName]);
    }
  }

    /**
     * Check authentication of user
     * @return boolean
     */
    function isAuthenticated() {
      if (isset($_SESSION[$this->_sessionName]['registered']))
        return true;
      session_write_close();
      return false;
    }

    /**
     * Main function for authentication. Returns array with key 'login' set to login and
     * the others values depend on the underlying authentication module.
     * Returns false if error.
     * @return mixed
     */
    function authenticate($login, $password, $params = array())
    {
      return false;
    }

    /**
     * Returns true if actual password does not stored in the internal DB.
     *
     * @return boolean
     */
    function isPasswordExternal()
    {
      return false;
    }

    /**
     * Checks username and password, if successfully returns true
     * @param string $username
     * @param string $password
     * @return boolean
     */
    function doLogin($login, $password, $params = array()) {
      $auth = $this->authenticate($login, $password, $params);

      if (defined('AUTH_DEBUG') && AUTH_DEBUG) {
        echo '<br>'; var_dump($auth); echo '<br />';
      }

      if ($auth === false) {
        return false;
      }

      $this->authResult = $auth;

      $login = $auth['login'];

      $mdb2 = getConnection();
      $sql = "SELECT u.u_id, u.u_manager_id, u.u_password FROM users AS u
          WHERE u.u_login = ".mdb2_quote($mdb2, $login)." AND u.u_active = 1";
      $res = $mdb2->query($sql);
      if (PEAR::isError($res)) {
        if (defined('AUTH_DEBUG') && AUTH_DEBUG) {
          echo 'db error!<br />';
        }
        return false;
      }
      $val = $res->fetchRow();

      if (!@$val['u_id']) {
        if (defined('AUTH_DEBUG') && AUTH_DEBUG) {
          echo 'login "'.$login.'" does not exist in DB.<br />';
        }
        return false;
      }

      $this->setAuth($val['u_id'], $login);

      return true;
    }

    /**
     * Clear logon data in session
     */
    function doLogout() {
      $_SESSION[$this->_sessionName] = array();
      $GLOBALS[$this->_sessionName] = $_SESSION[$this->_sessionName];
    }

    /**
     * Stores authorization data into session
     * @param int $userid
     * @param string $username
     * @param string $rolenik
     */
    function setAuth($userid, $username, $rolenik="") {
      if (!isset($_SESSION[$this->_sessionName]) || !is_array($_SESSION[$this->_sessionName])) {
        $_SESSION[$this->_sessionName] = array();
      }

      if (!isset($_SESSION[$this->_sessionName]['data'])) {
        $_SESSION[$this->_sessionName]['data'] = array();
      }

      $_SESSION[$this->_sessionName]['sessionip'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
      $_SESSION[$this->_sessionName]['sessionuseragent'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

      // This should be set by the container to something more safe
      // Like md5(passwd.microtime)
      if(empty($_SESSION[$this->_sessionName]['challengekey'])) {
        $_SESSION[$this->_sessionName]['challengekey'] = md5($username.microtime());
      }

      $_SESSION[$this->_sessionName]['challengecookie'] = md5($_SESSION[$this->_sessionName]['challengekey'].microtime());
      setcookie('authchallenge', $_SESSION[$this->_sessionName]['challengecookie']);

      $_SESSION[$this->_sessionName]['registered'] = true;
      $_SESSION[$this->_sessionName]['username']   = $username;
      $_SESSION[$this->_sessionName]['userid']     = $userid;
      $_SESSION[$this->_sessionName]['timestamp']  = time();
      $_SESSION[$this->_sessionName]['idle']       = time();
      $_SESSION[$this->_sessionName]['rolenik']    = $rolenik;
    }

    /**
     * Retrieves username from session
     * @return string
     */
    function getUserName() {
      return $_SESSION[$this->_sessionName]['username'];
    }

    /**
     * Retrieves user ID from session
     * @return int
     */
    function getUserId() {
      if ( isset($_SESSION[$this->_sessionName]['userid']) )
        return $_SESSION[$this->_sessionName]['userid'];
      else
        return null;
    }


    static function &factory($module, $params = array())
    {
        import('auth.Auth_'.$module);
        $class = 'Auth_' . $module;
        if (class_exists($class)) {
            $new_class = new $class($params);
            return $new_class;
        } else {
            die('Class '.$class.' not found');
        }
    }
}
?>