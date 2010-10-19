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

import('form.FormElement');
import('form.TableColumn');

class Table extends FormElement {

	var $mColumns		= array();
	var $mTColumns		= array();
	var $mData			= null;
	var $mHeaderTitle	= array();
	var $mAutoCreateColumns = false;
	var $mMultiSelect	= false;
	var $mInteractive	= true;
	var $mIAScript		= null;
	var $mKeyField		= ""; 		// key index
	var $mIndexesFields	= array();	// keys of fields in each row of data
	var $mBgColor		= "#ffffff";
	var $mBgColorOver	= "#eeeeff";
	var $mBgColorSelect = "#eeeeee";
	var $mWidth			= "";
	var $cClassName		= "Table";
	var $mTableOptions	= array();
	var $mRowOptions	= array();
	var $mHeaderOptions	= array();
	var $mProccessed	= false;
	
	function Table($name,$value="") {
		$this->mName			= $name;
		$this->mValue			= $value;
	}
	
	function setAutoCreateColumns($value=true) {
		$this->mAutoCreateColumns = $value;
	}
	
	function setKeyField($value) {
		$this->mKeyField = $value;
	}
	
	function setData(&$data) {
		if (is_array($data)) {
			if (isset($data[0]) && is_array($data[0])) {
				$this->mData = &$data;
			}
		}
	}
	
	function addColumn(&$column) {
	    if ($column!=null) $column->setTable($this);
		$this->mColumns[] = &$column;
	}
	
	
	function setInteractive($value) { $this->mInteractive = $value;}
	function isInteractive() { return $this->mInteractive;}
	
	function setIAScript($value) { $this->mIAScript = $value;}
	function getIAScript() { return $this->mIAScript;}
		
	function setMultiSelect($value) { $this->mMultiSelect = $value;}
	function getMultiSelect() { return $this->mMultiSelect;}
	
	function setWidth($value) { $this->mWidth = $value;}
	function getWidth() { return $this->mWidth;}
	
	function setTableOptions($value) { $this->mTableOptions = $value;}
	function getTableOptions() { return $this->mTableOptions;}
	
	function setRowOptions($value) { $this->mRowOptions = $value;}
	function getRowOptions() { return $this->mRowOptions;}
	
	function setHeaderOptions($value) { $this->mHeaderOptions = $value;}
	function getHeaderOptions() { return $this->mHeaderOptions;}
	
	function toString() {
		print_r($this);		
	}
	
	function getValueAt($rowindex,$colindex) {
		if (!$this->mProccessed) $this->_process();
		return @$this->mData[$rowindex][$this->mIndexesFields[$colindex]];
	}
	
	function getValueAtName($rowindex,$fieldname) {
		if (!$this->mProccessed) $this->_process();
		return @$this->mData[$rowindex][$fieldname];
	}
	
	function _process() {
		$this->mProccessed = true;
		
	    if ($this->mInteractive) {
			$tcolumn = new TableColumn("","<input type=\"checkbox\" name=\"".$this->getName()."_allcheckbox\" onclick=\"setAll(this.checked)\">");
			if ($this->mMultiSelect) {
				import('form.CBCellRenderer');
				$cb = new CBCellRenderer();
				if ($this->getIAScript()) $cb->setOnChangeAdd($this->getIAScript()."(this)");
				$tcolumn->setRenderer($cb);
			} else {
				import('form.CRCellRenderer');
				$tcolumn->setRenderer(new CRCellRenderer());
			}
			$tcolumn->setTable($this);
			array_unshift($this->mColumns, $tcolumn);
		}

		if ($this->mAutoCreateColumns && is_array($this->mData[0])) {
			foreach ($this->mData[0] as $key=>$value) {
			    $this->mColumns[] = new TableColumn($key, strtoupper($key) );
		    }
		}
		
		foreach ($this->mColumns as $column) {
			$this->mIndexesFields[] = $column->getField();
			$this->mHeaderTitle[] = $column->getColumnTitle();
    	}
    	
    	if (!$this->mKeyField) {
	    	if (is_array($this->mData[0]) && (list($key,$value) = each($this->mData[0])) ) {
	    		$this->mKeyField = $key;
	    	}
    	}
	}
	
	function toStringControl() {
		if (!$this->isRenderable()) return "";
		if (!$this->mProccessed) $this->_process();
		$html = "";
		
		if ($this->mInteractive) {
			$html .= $this->_addJavaScript();
		}
		
		$html .= "<table";
		if (count($this->mTableOptions)>0) {
			foreach ($this->mTableOptions as $k=>$v) {
				$html .= " $k=\"$v\"";
			}
		} else {
			$html .= " border=\"1\"";
		}
		
		if ($this->mWidth!="") $html .= " width=\"".$this->mWidth."\"";
		
		$html .= ">\n";
		
		if (($this->mInteractive && count($this->mHeaderTitle)>1) || 
			(!$this->mInteractive && count($this->mHeaderTitle)>0)) {
			$html .= "<tr";
			if (count($this->mRowOptions)>0) {
				foreach ($this->mRowOptions as $k=>$v) {
					$html .= " $k=\"$v\"";
				}
			}
			$html .= ">\n";
			foreach ($this->mHeaderTitle as $title) {
				$html .= "<th";
				if (count($this->mHeaderOptions)>0) {
					foreach ($this->mHeaderOptions as $k=>$v) {
						$html .= " $k=\"$v\"";
					}
				}
				$html .= ">$title</th>\n";
			}
			$html .= "</tr>\n";
		}
		for ($row = 0; $row<count($this->mData); $row++) {
			$html .= "\n<tr bgcolor=\"".$this->mBgColor."\" onmouseover=\"setPointer(this, '".$this->mBgColorOver."')\" onmouseout=\"setPointer(this, null)\">\n";
			for ($col=0; $col<$this->getColumnCount();$col++) {
			    if ((strtolower(get_class($this->mColumns[$col]->getRenderer())) == 'cbcellrenderer')
			    	|| (strtolower(get_class($this->mColumns[$col]->getRenderer())) == 'crcellrenderer')) {
			    	// Control elements for rows
			    	$selected = false;
			    	if (is_array($this->mValue))
    				foreach ($this->mValue as $p) {
    					if ($p == $this->mData[$row][$this->mKeyField]) $selected = true;
    				}
				    $html .= $this->mColumns[$col]->renderCell($this->mData[$row][$this->mKeyField],$row,$col,$selected);
			    } else {
			        $html .= $this->mColumns[$col]->renderCell($this->getValueAt($row,$col),$row,$col);
			    }
			}
			$html .= "</tr>\n";
		}
		$html .= "</table>";
		return $html;
	}
	
	function getColumnCount() {
	    //return ($this->mAutoCreateColumns ? count($this->mData[0]) : count($this->mColumns));
	    return count($this->mColumns);
	}
	
	function _addJavaScript() {
		$html = "<script language=\"JavaScript\">\n";
		$html .= "function setAll(value) {\n";
		$html .= "\tfor (var i = 0; i < ".$this->getFormName().".elements.length; i++) {\n";
        $html .= "\t\tif (".$this->getFormName().".elements[i].type=='checkbox' && ".$this->getFormName().".elements[i].name=='".$this->getName()."[]') {\n";
        $html .= "\t\t\t".$this->getFormName().".elements[i].checked=value;\n";
        if ($this->getIAScript()) {
        	//$html .= "\t\t\tif(".$this->getFormName().".elements[i].checked) {\n";
        	$html .= "\t\t\t\t".$this->getIAScript()."(".$this->getFormName().".elements[i]);\n";
        	//$html .= "\t\t\t}\n";
        }
        $html .= "\t}}\n";
		$html .= "}\n\n";
		
		$html .= "var rowBgColors;\n";
		$html .= "function setPointer(theRow, thePointerColor) {\n";
    	$html .= "\tif (typeof(theRow.style) == 'undefined' || typeof(theRow.cells) == 'undefined') {\n";
        $html .= "\treturn false;\n\t}\n\n";

        $html .= "\tvar row_cells_cnt = theRow.cells.length;\n";
        
        $html .= "\tif (thePointerColor!=null) {\n";
        $html .= "\trowBgColors = new Array(row_cells_cnt);\n";
    	$html .= "\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
        $html .= "\t\trowBgColors[c]=theRow.cells[c].bgColor;\n\t}\n";
        $html .= "\t}\n";
        
    	$html .= "\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
        $html .= "\t\ttheRow.cells[c].bgColor = thePointerColor;\n\t}\n\n";
        
        $html .= "\tif (thePointerColor==null) {\n";
    	$html .= "\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
        $html .= "\t\ttheRow.cells[c].bgColor=rowBgColors[c];\n\t}\n";
        $html .= "\tdelete rowBgColors;\n";
        $html .= "\t}\n";

	    $html .= "\treturn true;\n}\n";
		$html .= "</script>\n";
		return $html;
	}
}
?>