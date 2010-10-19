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
	
class TextField extends FormElement {
    var $mValue;
    var $mPassword	= false;
    var $cClassName		= "TextField";

	function TextField($name,$value="")
	{
		$this->mName			= $name;
		$this->mValue			= $value;
	}
	
	function setAsPassword($name)	{ $this->mPassword = $name;	}
	function getAsPassword()	{ return $this->mPassword; }

	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
		if (!$this->isEnable()) {
			$html = htmlspecialchars($this->getValue()).
				"<input type=\"hidden\" name=\"$this->mName\" value=\"".htmlspecialchars($this->getValue())."\">\n"; 
		} else {
			
		    if ($this->mId=="") $this->mId = $this->mName;
		    
			$html = "\n\t<input";
			$html .= ( $this->mPassword ? " type=\"password\"" : " type=\"text\"");
			$html .= " name=\"$this->mName\" id=\"$this->mId\"";
			
			if ($this->mSize!="")
			  $html .= " size=\"$this->mSize\"";
			  
			if ($this->mStyle!="")
			   $html .= " style=\"$this->mStyle\"";
			  
			if ($this->mMaxLength!="")
			   $html .= " maxlength=\"$this->mMaxLength\"";
			   
			if ($this->mOnChange!="")
			   $html .= " onchange=\"$this->mOnChange\"";

			$html .= " value=\"".htmlspecialchars(stripslashes($this->getValue()))."\"";
			$html .= ">";
		}
		
		return $html;
	}
}
?>