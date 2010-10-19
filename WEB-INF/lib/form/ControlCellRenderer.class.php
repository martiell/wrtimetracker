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

class ControlCellRenderer extends DefaultCellRenderer {
	var $mCellValue		= null;
	
	function ControlCellRenderer() {
		
	}
	
	function toRender(&$table, $value, $row, $column ) {
		$html = "<td";
		$html .= ($this->mWidth!='' ? " width=\"$this->mWidth\"" : "");
		$html .= "><input type=\"checkbox\" value=\"".$value."\"></td>\n";
		return $html;
	}
}
?>