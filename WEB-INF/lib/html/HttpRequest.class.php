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

class HttpRequest {
   	var $_params = array();
   	var $parsed_uri = 0;

	function HttpRequest() {
		$this->_parseUri();
	}
	
	/**
	 * @return unknown
	 * @desc get the type of request (Get, Post)
     */
	function getMethod() {
		return isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : false;
	}
	
	/**
	 * @return unknown
	 * @param objName = "" unknown
	 * @param default = "" unknown
	 * @desc 
     */
	function getParameter($objName="", $default=null) { 
		switch ( $this->getMethod() )
        {
            case 'GET':
            	if (isset($_GET[$objName])
            	   && ($_GET[$objName]!=""))
            	   return $_GET[$objName];

            case 'POST':
            	if (isset($_POST[$objName])
            	   && ($_POST[$objName]!=""))
            	   return  $_POST[$objName];
        }
        
        if (isset($this->_params[$objName]))
            return $this->_params[$objName];
            
        return $default;
	}
	
	function getAttribute($objName) {
		return $this->getParameter($objName);
	}
	
	function getCookieAttribute($objName="") {
	    if ($objName) {
			//return $GLOBALS['HTTP_COOKIE_VARS'][$objName];
   	        return  $_COOKIE[$objName];
   	    }
    	return null;
    }

    
   	function getSessionAttribute($objName="") {
   	    if ($objName) {
   	        return $_SESSION[$objName];
   	    }
    	return null;
    }
    
	/**
	 * @return void
	 * @desc
	 */
	function _parseUri()	{
		//global $HTTP_SERVER_VARS;
		
		if ($this->parsed_uri==0) {
      $this->_params = array();
      $this->parsed_uri = 1;
      if ( isset($_SERVER["QUERY_STRING"]) )
        parse_str($_SERVER["QUERY_STRING"], $this->_params);
		}
  	}
  	
  	function getScriptName() {
  		$script_name = $_SERVER['REQUEST_URI'];
  		$pos = strpos($script_name,"?");
  		if (!($pos === false)) {
  			$script_name = substr($script_name,1,$pos-1);
  		}
  		if ($script_name[0]!="/") $script_name = "/".$script_name;
  	    return $script_name;
  	    //['SCRIPT_NAME'];
  	}
  	
  	function getRequestUri() {
  	    return $_SERVER['REQUEST_URI'];
  	}
  	
  	function getLastHint() {
  	    return $_SESSION['LAST_HINT'];
  	}

}
?>