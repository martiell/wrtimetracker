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

// $Id: InvoiceHelper.class.php,v 1.0 2005/07/08 16:08:21 dries Exp $

import('UserHelper');
import('ProjectHelper');
import('ActivityHelper');
import('InvoiceHelper');
import('TimeHelper');
import('ClientHelper');
import('ReportHelper');
import('User');
import('form.ActionErrors');

/**
 * This class allows to do export to a file and import of a file of TT data
 * @package TimeTracker
 */
class MigrationHelper {
	var $mCompressor	= ''; //gzip
	var $mMemoryLimit;
	var $mStoreInFile	= false;
	var $mFileName		= null;
	var $mZipFileName	= null;
	var $mFileHandle	= null;
	var $mManager		= null;

	var $mDepth			= array();
	var $mParser		= null;
	var $mAccPresent	= false;

	var $_mAccount		= array();
	var $_mUsers		= array();
	var $_mProject		= array();
	var $_mActivity		= array();
	var $_mTime			= array();
	var $_mNewManager;
	var $_mCurrElement	= array();
	var $_mCurrTag		= "";
	var $_mCurrAddr		= "";

	var $_mUser_map		= array();
	var $_mProject_map	= array();
	var $_mActivity_map	= array();

	var $mErrors		= null;
	var $_mDirName 		= "";

    /**
     * Constructor
     */
	function MigrationHelper() {
		//$this->mMemoryLimit = trim(@ini_get('memory_limit'));
    	if (empty($this->mMemoryLimit))
			$this->mMemoryLimit = 2 * 1024 * 1024;
    	$this->mMemoryLimit *= 2/3;

    	$this->mErrors = new ActionErrors();
    	$this->_mDirName = dirname(TEMPLATE_DIR . '_c/.');
	}

        /**
         * Setter for array of errors
         * @param array $errors
         */
	function setErrors(&$errors) {
		$this->mErrors = &$errors;
	}

        /**
         * The handler for event the beginning tag in XML document
         * @param Object $parser
         * @param string $name
         * @param array $attrs
         */
	function startElement($parser, $name, $attrs) {
		if ($name == "ACCOUNT"
			|| $name == "USER"
			|| $name == "PROJECT"
			|| $name == "ACTIVITY"
			|| $name == "TIME"
			|| $name == "INVOICE"
			|| $name == "USERBIND"
			|| $name == "ACTIVITYBIND"
			|| $name == "FEPORTFILTER"
			|| $name == "CLIENT"
			) {
   			$this->_mCurrElement = $attrs;
   		}
   		if ($name == "ADDRESS") {
   			$this->_mCurrAddr = $attrs["ID"];
   		}
    	$this->_mCurrTag = $name;
	    @$this->mDepth[$parser]++;
	}

        /**
         * The handler for event the ending tag in XML document
         * @param Object $parser
         * @param string $name
         */
	function endElement($parser, $name)	{
		if ($name == "ACCOUNT") {
			$this->_mAccount = $this->_mCurrElement;
			$this->_mCurrElement = array();
    	}
    	if ($name == "USER") {
			$this->_mUsers[$this->_mCurrElement["ID"]] = $this->_mCurrElement;
			$this->_mCurrElement = array();
    	}
    	if ($name == "USERS") {
    		foreach ($this->_mUsers as $k=>$user) {
    			if (UserHelper::findUserByLogin($user["LOGIN"])) {
    				$this->mAccPresent = true;
    				break;
    			}
    			if (!$user["MANAGER_ID"]) $managerId = $k;
    		}

    		if (!$this->mAccPresent && $managerId) {
    			$uid = UserHelper::insertAccount(array(
            'name' => $this->_mUsers[$managerId]["NAME"],
            'login' => $this->_mUsers[$managerId]["LOGIN"],
            'password' => $this->_mUsers[$managerId]["PASSWORD"],
            'company' => $this->_mAccount["NAME"],
            'company_www' => $this->_mAccount["WWW"],
            'currency' => $this->_mAccount["CURRENCY"],
            'email' => $cl_email,
            'lang' => $this->_mAccount["LANG"],
    				'email' => $this->_mUsers[$managerId]["EMAIL"],
    				'locktime' => $this->_mAccount["LOCKTIME"],
    				'show_pie' => $this->_mAccount["SHOW_PIE"],
    				'pie_mode' => $this->_mAccount["PIE_MODE"],
    				),
    				array('encode_pass' => false)
          );
          $this->_mNewManager = new User($uid, false);
    			$this->_mUser_map[$managerId] = $uid;

    			// set sysconfig settings
    			$sc = new SysConfig($this->_mNewManager);
		      $sc->setValue('lang_allow_user_change', (int)$this->_mAccount["LANG_ALLOW_USER_CHANGE"]);         
          $sc->setValue('format_date', $this->_mAccount["FORMAT_DATE"]);
          $sc->setValue('format_time', $this->_mAccount["FORMAT_TIME"]);
          $sc->setValue('start_week', (int)$this->_mAccount["START_WEEK"]);
          $sc->setValue('hide_world_clock', (int)$this->_mAccount["HIDE_WORLD_CLOCK"]);

    			foreach ($this->_mUsers as $k=>$user) {
    				if ($k!=$managerId) {
    					$uid= UserHelper::addEmployee($this->_mNewManager, array(
    						'name' => $user["NAME"],
    						'login' => $user["LOGIN"],
    						'password' => $user["PASSWORD"],
    						'rate' => $user["RATE"],
    						'comanager' => $user["COMANAGER"],
    						'lang' => $user["LANG"],
                'email' => $user["EMAIL"]),
                array('encode_pass' => false));

    					$this->_mUser_map[$k] = $uid;
    				}
	    		}
    		}
    	}
    	if ($name == "PROJECT" && !$this->mAccPresent) {
    		$this->_mProject_map[$this->_mCurrElement["ID"]] =
    			ProjectHelper::insert(array(
              'user_id' => $this->_mUser_map[$this->_mCurrElement["MANAGER_ID"]],
              'project_name' => $this->_mCurrElement["NAME"]));
    	}
    	if ($name == "ACTIVITY" && !$this->mAccPresent) {
    		$this->_mActivity_map[$this->_mCurrElement["ID"]] =
    			ActivityHelper::insert($this->_mUser_map[$this->_mCurrElement["MANAGER_ID"]],
    			$this->_mCurrElement["NAME"],
    			(isset($this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]])?$this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]]:null)
    			);
    	}
    	if ($name == "TIME" && !$this->mAccPresent) {
    		TimeHelper::insert(array(
    			'date' => $this->_mCurrElement["DATE"],
    			'user_id' => $this->_mUser_map[$this->_mCurrElement["USER_ID"]],
    			'project' => $this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]],
    			'activity' => $this->_mActivity_map[$this->_mCurrElement["ACTIVITY_ID"]],
    			'start' => $this->_mCurrElement["FROM"],
    			'finish' => $this->_mCurrElement["TO"],
    			'duration' => $this->_mCurrElement["DURATION"],
    			'note' => (isset($this->_mCurrElement["COMMENT"]) ? $this->_mCurrElement["COMMENT"] : ""),
    			'timestamp' => $this->_mCurrElement["TIMESTAMP"],
    			'billable' => $this->_mCurrElement["BILLABLE"]));
    	}
    	if ($name == "INVOICE" && !$this->mAccPresent) {
    		InvoiceHelper::update($this->_mNewManager, array(
    			'number' => stripcslashes($this->_mCurrElement["NUMBER"]),
    			'addr_your' => stripcslashes($this->_mCurrElement["ADDRESS_YOUR"]),
    			'addr_cust' => stripcslashes($this->_mCurrElement["ADDRESS_CUST"]),
    			'comment' => $this->_mCurrElement["COMMENT"],
    			'tax' => $this->_mCurrElement["TAX"],
    		    'discount' => $this->_mCurrElement["DISCOUNT"]));
    	}
    	if ($name == "USERBIND" && !$this->mAccPresent) {
    		UserHelper::insertProjectBind(
    			$this->_mUser_map[$this->_mCurrElement["USER_ID"]],
    			$this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]],
    			$this->_mCurrElement["RATE"],
    			$this->_mCurrElement["CHECKED"]
    			);
    	}
    	if ($name == "ACTIVITYBIND" && !$this->mAccPresent) {
    		ActivityHelper::insertActivityBind(
    			$this->_mActivity_map[$this->_mCurrElement["ACTIVITY_ID"]],
    			$this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]]
    			);
    	}
    	if ($name == "FEPORTFILTER" && !$this->mAccPresent) {
    		$new_user_list = "";
			if (strlen($this->_mCurrElement["USERS"])>0) {
				$sep = ",";
				$arr = explode($sep,$this->_mCurrElement["USERS"]);
				foreach ($arr as $v) {
					$new_user_list .= (strlen($new_user_list)==0?"":$sep).$this->_mUser_map[$v];
				}
			}
    		ReportHelper::insertFilter(
    			$this->_mUser_map[$this->_mCurrElement["USER_ID"]],
    			$this->_mCurrElement["NAME"],
    			($this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]]?$this->_mProject_map[$this->_mCurrElement["PROJECT_ID"]]:-1),
    			($this->_mActivity_map[$this->_mCurrElement["ACTIVITY_ID"]]?$this->_mActivity_map[$this->_mCurrElement["ACTIVITY_ID"]]:-1),
    			$new_user_list,
    			$this->_mCurrElement["PERIOD"],
    			$this->_mCurrElement["START"],
    			$this->_mCurrElement["FINISH"],
    			$this->_mCurrElement["CB_PROJECT"],
    			$this->_mCurrElement["CB_ACTIVITY"],
    			$this->_mCurrElement["CB_NOTE"],
    			$this->_mCurrElement["CB_START"],
    			$this->_mCurrElement["CB_FINISH"],
    			$this->_mCurrElement["CB_DURATION"],
    			$this->_mCurrElement["CB_SHOWIDLE"],
    			$this->_mCurrElement["CB_TOTALS_ONLY"],
    			$this->_mCurrElement["GROUPBY"],
    			$this->_mCurrElement["BILLABLE"]
    			);
    	}
    	if ($name == "CLIENT" && !$this->mAccPresent) {
    		ClientHelper::insert($this->_mNewManager, array(
    			'name' => $this->_mCurrElement["NAME"],
    			'address' => $this->_mCurrElement["ADDRESS_CUST"],
    			'tax' => $this->_mCurrElement["TAX"],
    			'discount' => $this->_mCurrElement["DISCOUNT"],
    			'address_you' => $this->_mCurrElement["ADDRESS_YOUR"],
    			'comment' => $this->_mCurrElement["COMMENT"],
    			'fsubtotals' => $this->_mCurrElement["ST"]
    			));
    	}
    	if ($name == "PACK" && !$this->mAccPresent) {
    		foreach ($this->_mUsers as $k=>$user) {
				$pr = null;
				if (isset($user["APROJECTS"])) {
					$pr = array();
					$prs = explode(",",$user["APROJECTS"]);
					foreach ($prs as $p) if (isset($this->_mProject_map[$p])) $pr[] = $this->_mProject_map[$p];
				}
				$uid= UserHelper::updateEmployee($this->_mNewManager, array(
					'user_id' => $this->_mUser_map[$k],
					'name' => stripcslashes($user["NAME"]),
          'login' => stripcslashes($user["LOGIN"]),
					'rate' => $user["RATE"],
					'comanager' => $user["COMANAGER"],
					'aprojects' => &$pr,
					'lang' => &$user["LANG"],
          'email' => &$user["EMAIL"]));
			}
    	}
    	$this->_mCurrTag = "";
	    $this->mDepth[$parser]--;
	}

        /**
         * The handler for event occurrence of the data in XML document
         * @param Object $parser
         * @param string $data
         */
	function dataElement($parser, $data) {
		if ($this->_mCurrTag=="NAME"
			|| $this->_mCurrTag=="TIMESTAMP"
			|| $this->_mCurrTag=="COMMENT"
			) {
			if (isset($this->_mCurrElement[$this->_mCurrTag])) {
				$this->_mCurrElement[$this->_mCurrTag] .= trim($data);
			} else {
				$this->_mCurrElement[$this->_mCurrTag] = trim($data);
			}
    	}
    	if ($this->_mCurrTag=="ADDRESS") {
    		$this->_mCurrElement[$this->_mCurrTag."_".strtoupper($this->_mCurrAddr)] = trim($data);
    	}
	}

        /**
         * Open XML file and load data into database
         */
	function importXml() {
		$this->mParser = xml_parser_create();
		xml_set_object($this->mParser, $this);
    	xml_set_element_handler($this->mParser, "startElement", "endElement");
    	xml_set_character_data_handler($this->mParser, "dataElement");

    	$file_name = $this->mFileName;
    	if ($this->mCompressor) {
    		$file_name = $this->createFile();
    		if ($this->uncompress($this->mFileName, $file_name)) {
    			@unlink($this->mFileName);
    			$this->mZipFileName = $file_name;
    		} else {
    			$this->errorAdd("file_uncompress", "uncompress: process error");
    		}
    	}

		if ($this->mFileHandle = fopen($file_name, "r")) {
			while ($data = $this->_readString()) {
	    		if (!@xml_parse($this->mParser, $data, feof($this->mFileHandle))) {
	    			$this->errorAdd("xml_parser",sprintf("XML error: %s at line %d",
	                    @xml_error_string(@xml_get_error_code($this->mParser)),
	                    @xml_get_current_line_number($this->mParser)));
	    		}
	    		if ($this->mAccPresent)
					break;
			}
			@xml_parser_free($this->mParser);
			if ($this->mFileHandle)
				fclose($this->mFileHandle);
		}
		else {
			$this->errorAdd("xml_open", "could not open XML file");
		}
		if ($this->mAccPresent) {
			$this->errorAdd("account", $GLOBALS["I18N"]->getKey("errors.ie_sameusers"));
		}
		@unlink($file_name);
	}

        /**
         * Load data from database and write into file in XML format
         * @return boolean
         */
	function exportXml() {
		if (!$this->mManager) return false;

		if ($this->mStoreInFile) {
			if (!$file_name = $this->createFile()) return false;

			if (is_writable($file_name))
			if (!$this->mFileHandle = fopen($file_name, 'wb')) {
				$this->errorAdd("xml_export", "can't create tmp file");
			}
		}

		$this->_writeString("<?xml version=\"1.0\"?>\n");
		//$this->_writeString("<!DOCTYPE pack SYSTEM \"http://timetracker.wrconsulting.com/ttpack.dtd\">\n");
		$this->_writeString("<pack>\n");


		$sc = new SysConfig($this->mManager);
		$lang_allow_user_change = $sc->getValue('lang_allow_user_change');
		if (is_null($lang_allow_user_change)) {
		  $lang_allow_user_change = 1;
		}
    $format_date = $sc->getValue('format_date');
    $format_time = $sc->getValue('format_time');
    $start_week = $sc->getValue('start_week');
    $hide_world_clock = (int)$sc->getValue('hide_world_clock');

		$this->_writeString(
      "<account www=\"".addslashes(htmlspecialchars($this->mManager->getWww())).
      "\" currency=\"".$this->mManager->getCurrency().
      "\" locktime=\"".$this->mManager->getLocktime().
      "\" lang=\"".$this->mManager->getLang().
      "\" lang_allow_user_change=\"".$lang_allow_user_change.
      "\" format_date=\"".$format_date.
      "\" format_time=\"".$format_time.
      "\" start_week=\"".$start_week.
      "\" hide_world_clock=\"".$hide_world_clock.
      "\" show_pie=\"".$this->mManager->getShowPie().
      "\" pie_mode=\"".$this->mManager->getPieMode().
      "\">\n");
		$this->_writeString("\t<name><![CDATA[".addslashes($this->mManager->getCompanyName())."]]></name>\n");
		$this->_writeString("\t<timestamp></timestamp>\n");
		$this->_writeString("</account>\n");


		$users = UserHelper::findAllUsers($this->mManager, false, true);
		foreach ($users as $k=>$user) {
			$this->_mUser_map[$user["u_id"]] = $k+1;
		}
		$projects = ProjectHelper::findAllProjects($this->mManager, array('restrict' => false, 'alldata' => true));
		foreach ($projects as $k=>$project) {
			$this->_mProject_map[$project["p_id"]] = $k+1;
		}

		$activities = ActivityHelper::findAllActivity($this->mManager, "", true);
		foreach ($activities as $k=>$activity) {
			$this->_mActivity_map[$activity["a_id"]] = $k+1;
		}

		// Users
		$this->_writeString("<users>\n");
		foreach ($users as $k=>$user) {
			$aprojects = array();
			/*if ($user["u_aprojects"]) {
				$aprojects_arr = explode(",",$user["u_aprojects"]);
				foreach ($aprojects_arr as $pr) {
					if ($this->_mProject_map[$pr])
					$aprojects[] = $this->_mProject_map[$pr];
				}
			}*/
			/*if (is_null($user["u_aprojects"]) && $this->_mProject_map) {
				$aprojects = $this->_mProject_map;
			}*/
			$this->_writeString("\t<user
				id=\"".$this->_mUser_map[$user["u_id"]]."\"
				login=\"".addslashes($user["u_login"])."\"
				password=\"".addslashes($user["u_password"])."\"
				manager_id=\"".($user["u_manager_id"]?$this->_mUser_map[$user["u_manager_id"]]:null)."\"
				company_id=\"1\"
				comanager=\"".$user["u_comanager"]."\"
				level=\"".$user["u_level"]."\"
				active=\"".$user["u_active"]."\"
				rate=\"".$user["u_rate"]."\"
				lang=\"".$user["u_lang"]."\"
				aprojects=\"".join(",",$aprojects)."\"
        email=\"".$user["u_email"]."\"        
				>\n");
			$this->_writeString("\t\t<name><![CDATA[".addslashes($user["u_name"])."]]></name>\n");
			$this->_writeString("\t\t<timestamp>".$user["u_timestamp"]."</timestamp>\n");
			$this->_writeString("\t</user>\n");
		}
		$this->_writeString("</users>\n");

		// Projects
		$this->_writeString("<projects>\n");
		foreach ($projects as $k=>$project) {
			$this->_writeString("\t<project
				id=\"".$this->_mProject_map[$project["p_id"]]."\"
				status=\"".$project["p_status"]."\"
				manager_id=\"".$this->_mUser_map[$project["p_manager_id"]]."\">\n");
			$this->_writeString("\t\t<name><![CDATA[".addslashes($project["p_name"])."]]></name>\n");
			$this->_writeString("\t\t<timestamp>".$project["p_timestamp"]."</timestamp>\n");
			$this->_writeString("\t</project>\n");
		}
		$this->_writeString("</projects>\n");
		unset($projects);

		// Activities
		$this->_writeString("<activities>\n");
		foreach ($activities as $k=>$activity) {
			$this->_writeString("\t<activity id=\"".$this->_mActivity_map[$activity["a_id"]]."\"
				manager_id=\"".$this->_mUser_map[$activity["a_manager_id"]]."\">\n");
			$this->_writeString("\t\t<name><![CDATA[".addslashes($activity["a_name"])."]]></name>\n");
			$this->_writeString("\t\t<timestamp>".$activity["a_timestamp"]."</timestamp>\n");
			$this->_writeString("\t</activity>\n");
		}
		$this->_writeString("</activities>\n");
		unset($activities);

		// Time
		$this->_writeString("<timedata>\n");
		foreach ($users as $user) {
			$timedata = TimeHelper::findAllTimeRecords($user["u_id"]);
			foreach ($timedata as $time) {
				$this->_writeString("\t<time project_id=\"".@$this->_mProject_map[$time["al_project_id"]]."\"
					activity_id=\"".@$this->_mActivity_map[$time["al_activity_id"]]."\"
					user_id=\"".$this->_mUser_map[$time["al_user_id"]]."\"
					from=\"".($time["tfrom"]?$time["tfrom"]:"")."\" to=\"".($time["tfrom"]?$time["tto"]:"")."\" duration=\"".($time["tfrom"]?"":$time["tdur"])."\"
					date=\"".$time["al_date"]."\" billable=\"".$time["al_billable"]."\">\n");
				$this->_writeString("\t\t<comment>".($time["al_comment"]?"<![CDATA[".addslashes($time["al_comment"])."]]>":"")."</comment>\n");
				$this->_writeString("\t\t<timestamp>".$time["al_timestamp"]."</timestamp>\n");
				$this->_writeString("\t</time>\n");
			}
		}
		$this->_writeString("</timedata>\n");
		unset($timedata);

		// Invoice
		$this->_writeString("<invoicedata>\n");
		$invoice = InvoiceHelper::findByUser($this->mManager);
		if ($invoice) {
			$this->_writeString("\t<invoice
				id=\"\"
				number=\"".$invoice["ih_number"]."\"
				user_id=\"".$this->mManager->getUserId()."\"
				tax=\"".$invoice["ih_tax"]."\"
				discount=\"".$invoice["ih_discount"]."\"
				>\n");
			$this->_writeString("\t\t<comment><![CDATA[".addslashes($invoice["ih_comment"])."]]></comment>\n");
			$this->_writeString("\t\t<address id=\"YOUR\">".($invoice["ih_addr_your"]?"<![CDATA[".addslashes($invoice["ih_addr_your"])."]]>":"")."</address>\n");
			$this->_writeString("\t\t<address id=\"CUST\">".($invoice["ih_addr_cust"]?"<![CDATA[".addslashes($invoice["ih_addr_cust"])."]]>":"")."</address>\n");
			$this->_writeString("\t</invoice>\n");
		}
		$this->_writeString("</invoicedata>\n");
		unset($invoice);

		// User binds
		$this->_writeString("<userbinds>\n");
		$userbinds = UserHelper::findAllUserBinds($this->mManager->getUserId());
		if ($userbinds) {
			foreach ($userbinds as $bind) {
        $userid    = isset($this->_mUser_map[$bind["ub_id_u"]])    ? $this->_mUser_map[$bind["ub_id_u"]]    : '';
        $projectid = isset($this->_mProject_map[$bind["ub_id_p"]]) ? $this->_mProject_map[$bind["ub_id_p"]] : '';
			$this->_writeString("\t<userbind user_id=\"{$userid}\" project_id=\"{$projectid}\" rate=\"".$bind["ub_rate"]."\" checked=\"".$bind["ub_checked"]."\"/>\n");
			}
		}
		$this->_writeString("</userbinds>\n");
		unset($userbinds);

		// Activity Binds
		$this->_writeString("<activitybinds>\n");
		$activitybinds = ActivityHelper::findAllActivityBinds($this->mManager->getUserId());
		if ($activitybinds) {
			foreach ($activitybinds as $bind) {
			$this->_writeString("\t<activitybind
				activity_id=\"".$this->_mActivity_map[$bind["ab_id_a"]]."\"
				project_id=\"".$this->_mProject_map[$bind["ab_id_p"]]."\"
				/>\n");
			}
		}
		$this->_writeString("</activitybinds>\n");
		unset($activitybinds);

		// Report Filter
		$this->_writeString("<feportfilters>\n");
		$feportfilters = ReportHelper::findFiltersAll($this->mManager->getUserId());
		if ($feportfilters) {
			foreach ($feportfilters as $filter) {
				$new_user_list = "";
				if (strlen($filter["rfs_users"])>0) {
					$sep = ",";
					$arr = explode($sep,$filter["rfs_users"]);
					foreach ($arr as $k=>$v) {
						$new_user_list .= (strlen($new_user_list)==0?"":$sep).$this->_mUser_map[$v];
					}
				}
			$this->_writeString("\t<feportfilter
				user_id=\"".@$this->_mUser_map[$filter["rfs_id_u"]]."\"
				project_id=\"".(strlen(@$this->_mProject_map[$filter["rfs_id_p"]])>0?$this->_mProject_map[$filter["rfs_id_p"]]:"-1")."\"
				activity_id=\"".(strlen(@$this->_mActivity_map[$filter["rfs_id_a"]])>0?$this->_mActivity_map[$filter["rfs_id_a"]]:"-1")."\"
				users=\"".$new_user_list."\"
				period=\"".$filter["rfs_period"]."\"
				start=\"".$filter["rfs_period_start"]."\"
				finish=\"".$filter["rfs_period_finish"]."\"
				cb_project=\"".$filter["rfs_cb_project"]."\"
				cb_activity=\"".$filter["rfs_cb_activity"]."\"
				cb_note=\"".$filter["rfs_cb_note"]."\"
				cb_start=\"".$filter["rfs_cb_start"]."\"
				cb_finish=\"".$filter["rfs_cb_finish"]."\"
				cb_duration=\"".$filter["rfs_cb_duration"]."\"
				cb_showidle=\"".$filter["rfs_cb_idle"]."\"
				cb_totals_only=\"".(strlen($filter["rfs_cb_totals_only"])>0?$filter["rfs_cb_totals_only"]:"-1")."\"
				groupby=\"".$filter["rfs_groupby"]."\"
				billable=\"".$filter["rfs_billable"]."\"
				>\n");
			$this->_writeString("\t\t<name><![CDATA[".$filter["rfs_name"]."]]></name>\n");
			$this->_writeString("\t</feportfilter>\n");
			}
		}
		$this->_writeString("</feportfilters>\n");
		unset($feportfilters);

		// Clients
		$this->_writeString("<clients>\n");
		$clients = ClientHelper::findAllClients($this->mManager->getUserId());
		if ($clients) {
			foreach ($clients as $client) {
			$this->_writeString("\t<client
				manager_id=\"".$this->_mUser_map[$client["clnt_id_um"]]."\"
				tax=\"".$client["clnt_tax"]."\"
				discount=\"".$client["clnt_discount"]."\"
				st=\"".$client["clnt_fsubtotals"]."\"
				>\n");
			$this->_writeString("\t\t<name><![CDATA[".addslashes($client["clnt_name"])."]]></name>");
			$this->_writeString("\t\t<address id=\"YOUR\">".($client["clnt_addr_your"]?"<![CDATA[".addslashes($client["clnt_addr_your"])."]]>":"")."</address>\n");
			$this->_writeString("\t\t<address id=\"CUST\">".($client["clnt_addr_cust"]?"<![CDATA[".addslashes($client["clnt_addr_cust"])."]]>":"")."</address>\n");
			$this->_writeString("\t\t<comment>".($client["clnt_comment"]?"<![CDATA[".addslashes($client["clnt_comment"])."]]>":"")."</comment>\n");
			$this->_writeString("\t</client>");
			}
		}
		$this->_writeString("</clients>\n");
		unset($clients);

		unset($users);
		$this->_mUser_map = array();
		$this->_mProject_map = array();
		$this->_mActivity_map = array();

		$this->_writeString("</pack>\n");

		if ($this->mFileHandle) fclose($this->mFileHandle);

		if ($this->mStoreInFile) {
			if ($this->mCompressor) {
				$this->mZipFileName = $this->createFile();
				$this->compress($file_name, $this->mZipFileName, "9");
				@unlink($file_name);
			} else {
				$this->mZipFileName = $file_name;
				//rename($file_name, $this->mFileName);
			}
		}
	}

        /**
         * Read line from file
         * @return string
         */
	function _readString() {
	    if ($this->mFileHandle) {
			if (!$string = fread($this->mFileHandle, 4096)) {
				//error reading
			}
	    }
	    return $string;
	}

        /**
         * Writes line into file
         * @param string $string
         * @return string
         */
	function _writeString($string) {
	    //$string = utf8_encode($string);
		//$string = utf8_encode($string);

        // write to file
        if ($this->mStoreInFile && $this->mFileHandle) {
            $write_result = @fwrite($this->mFileHandle, $string);
            if (!$write_result || ($write_result != strlen($string))) {
                $this->errorAdd("xml_export", "can't write to tmp file");
                return false;
            }
        } else {
        	echo $string;
        }
        $string = '';
	}

        /**
         * Sets compressor type (gzip or bzip)
         * @param string $compressor
         */
	function setCompressor($compressor) {
		$this->mCompressor = $compressor;
		switch ($compressor) {
	    	case "gzip":
	    		$this->mZipFileName = $this->mFileName.".gz";
	    	break;

	    	case "bzip":
	    		$this->mZipFileName = $this->mFileName.".bz2";
	    	break;
	    }
	}

        /**
         * Sets file name for loading and soting data
         * @param string $fileName
         */
	function setFileName($fileName) {
		$this->mFileName = $this->mZipFileName = $fileName;
		if($fileName)
			$this->mStoreInFile = true;
	}

        /**
         * Returns current file name
         * @return string
         */
	function getFileName() {
		return $this->mZipFileName;
	}

        /**
         * Sets the manager for which there is a loading of the data
         * @param User $user
         */
	function setManager($user) {
		if (($user instanceof user) && $user->isManager()) {
			$this->mManager = $user;
		}
	}

        /**
         * Converts a string from one charset in another
         * @param string $srcCharset
         * @param string $destCharset
         * @param string $string
         * @return string
         */
	function _convertString($srcCharset, $destCharset, $string) {
	    if ($src_charset == $dest_charset) return $string;
	    if (@function_exists('recode_string')) {
	    	recode_string($srcCharset . '..'  . $destCharset, $string);
	    }
	    return $string;
	}

        /**
         * Append error message into error array
         * @param string $name
         * @param string $context
         */
	function errorAdd($name, $context) {
		if ($this->mErrors) {
			$this->mErrors->add($name, $context);
		}
	}

        /**
         * Returns array as error or array of errors
         * @param string $name
         * @return array
         */
	function errorGet($name="") {
		if ($this->mErrors) {
			if ($name) {
				return $this->mErrors->get($name);
			} else {
				return $this->mErrors->getErrors();
			}
		}
		return false;
	}

        /**
         * Creates file with name $fileName and sets the rights to record
         * @param string $fileName
         * @return string
         */
	function createFile($fileName="") {
		if ($fileName) {
			$tmp_filename = @tempnam($this->_mDirName, 'wrt');
			@chmod($tmp_filename, 0666);
			return @rename($tmp_filename, $this->_mDirName.$fileName);
		} else {
			$tmp_filename = @tempnam($this->_mDirName, 'wrt');
			@chmod($tmp_filename, 0666);
			return $tmp_filename;
		}
	}

        /**
         * Compresses the data. Reads out from a file $in and
         * compressed the data writes down in a file $out.
         * $param is a level of compressing.
         * @param string $in
         * @param string $out
         * @param string $param
         * @return boolean
         */
	function compress($in, $out, $param="1") {
		if (!file_exists ($in) || !is_readable ($in))
		   return false;
		if ((!file_exists ($out) && !is_writable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
		   return false;

		$in_file = fopen ($in, "rb");

	    if ($this->mCompressor == 'bzip'  && @function_exists('bzopen')) {
	        if (!$out_file = bzopen($out, "wb".$param)) {
			   return false;
			}
			while (!feof ($in_file)) {
			   $buffer = fgets($in_file, 4096);
			   bzwrite($out_file, $buffer, 4096);
			}
			bzclose($out_file);
	    }
	    else if ($this->mCompressor == 'gzip' && @function_exists('gzopen')) {
	        if (!$out_file = gzopen ($out, "wb".$param)) {
			   return false;
			}
			while (!feof ($in_file)) {
			   $buffer = fgets($in_file, 4096);
			   gzwrite($out_file, $buffer, 4096);
			}
			gzclose($out_file);
	    }

		fclose ($in_file);
		return true;
	}

        /**
         * Reads out from a file $in decompress them and
         * writes data down in a file $out.
         * @param string $in
         * @param string $out
         * @return boolean
         */
	function uncompress($in, $out) {
		if (!file_exists ($in) || !is_readable ($in))
		   return false;
		if ((!file_exists ($out) && !is_writable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
		   return false;

		if (!$out_file = fopen ($out, "wb")) {
		   return false;
		}

		if ($this->mCompressor == 'bzip'  && @function_exists('bzopen')) {
	        if (!$in_file = bzopen ($in, "rb")) {
			   return false;
			}
			while (!bzeof($in_file)) {
			   $buffer = bzread($in_file, 4096);
			   fwrite($out_file, $buffer, 4096);
			}
			bzclose($in_file);
	    }
	    else if ($this->mCompressor == 'gzip' && @function_exists('gzopen')) {
	        if (!$in_file = gzopen ($in, "rb")) {
			   return false;
			}
			while (!gzeof($in_file)) {
			   $buffer = gzread($in_file, 4096);
			   fwrite($out_file, $buffer, 4096);
			}
			gzclose($in_file);
	    }

		fclose ($out_file);
		return true;
	}
}
?>