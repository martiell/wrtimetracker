<?php
/**
* Auth_db class to authenticate users against internal users DB
* @package TimeTracker
*/
class Auth_db extends Auth {

  /**
   * Authenticate user against internal users DB
   *
   * @param string $login
   * @param string $password
   * @return mixed
   */
  function authenticate($login, $password, $params = array())
  {
  	$mdb2 = getConnection();
  	// Try md5 password match first.
  	$sql = "SELECT u.u_id, u.u_manager_id, u.u_password FROM users AS u
      WHERE u.u_login = ".mdb2_quote($mdb2, $login)." AND u.u_password = md5(".mdb2_quote($mdb2, $password).") AND u.u_active = 1";

    $res = &$mdb2->query($sql);
    if (PEAR::isError($res)) {
      die($res->getMessage());
    }

    $val = $res->fetchRow();
    if ($val['u_id'] > 0) {
      return array('login' => $login, 'data' => $val);
    } else {

      // Try legacy password match. This is needed for compatibility with older versions of TT.
      $sql = "SELECT u.u_id, u.u_manager_id, u.u_password FROM users AS u
        WHERE u.u_login = ".mdb2_quote($mdb2, $login)." AND u.u_password = password(".mdb2_quote($mdb2, $password).") AND u.u_active = 1";
      $res = &$mdb2->query($sql);
      if (PEAR::isError($res)) {
        die($res->getMessage());
      }
      $val = $res->fetchRow();
      if ($val['u_id'] > 0) {
        return array('login' => $login, 'data' => $val);
      }
      return false;
    }
  }

  function isPasswordExternal() {
    return false;
  }
}