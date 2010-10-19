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

import('form.DefaultCellRenderer');
import('form.CRCellRenderer');
import('form.CBCellRenderer');

class TableColumn {
	var $mTitle			= "";
	var $mIndexField	= "";
	var $mRenderer		= null;
	var $mWidth			= "";
	var $mTable         = null;
	var $mBgColor		= "#ffffff";
	var $mFgColor		= "#000000";
	
	function TableColumn($indexField, $title="",$renderer=null) {
		$this->mIndexField	= $indexField;
		$this->mTitle	    = $title;
		if ($renderer!=null) {
		  $this->mRenderer	= $renderer;
		} else {
		  $this->mRenderer	= new DefaultCellRenderer();
		}
	}
	
	function getColumnTitle() { return $this->mTitle; }
	
	function getField() { return $this->mIndexField; }
    
    function setTable(&$table) { $this->mTable = &$table; }

    function setRenderer(&$renderer) { $this->mRenderer = &$renderer; }
    function &getRenderer() { return $this->mRenderer; }    
    
    function setFgColor($value) { $this->mFgColor = $value; }
    function getFgColor() { return $this->mFgColor; }
    
    function setBgColor($value) { $this->mBgColor = $value; }
    function getBgColor() { return $this->mBgColor; }
    
    function renderCell($value,$row,$column,$selected=false) {
    	if ($this->mRenderer!=null) {
    		//$this->mRenderer->setValue($value);
    		return $this->mRenderer->toRender($this->mTable,$value,$row,$column,$selected);
    	} else {
    		return null;
    	}
    }
    
    function setWidth($value) {
    	$this->mWidth = $value;
    	if ($this->mRenderer!=null) $this->mRenderer->setWidth($value);
    }
    
    function getWidth() {
        return $this->mWidth;
    }
}
?>