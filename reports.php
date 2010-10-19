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
// | Contributors: Igor Melnik <imelnik@wrconsulting.com>
// +----------------------------------------------------------------------+

	require_once('initialize.php');
	import('form.Form');
	import('form.ActionForm');
	import('DateAndTime');
	import('UserHelper');
	import('Period');
	import('ProjectHelper');
    import('ActivityHelper');
    import('ReportHelper');
    
	if ($auth->isAuthenticated()) {
		$user = new User($auth->getUserId());
		if ($user->isAdministrator()) {
			Header("Location: admin.php");
			exit();
		}
	} else {
		Header("Location: login.php");
		exit();
	}

	$default_sets = array(
		"rfs_name"=>$i18n->getKey('controls.default'),
		"rfs_id"=>"-1",
		/*"rfs_id_p"=>"",
		"rfs_id_a"=>"",
		"rfs_users"=>"",
		"rfs_period"=>PERIOD_LAST_WEEK,
		"rfs_period_start"=>"",
		"rfs_period_finish"=>"",
        "rfs_cb_project"=>"1",
        "rfs_cb_activity"=>"1",
        "rfs_cb_note"=>"1",
        "rfs_cb_start"=>"1",
        "rfs_cb_finish"=>"1",
        "rfs_cb_duration"=>"1",
        "rfs_cb_idle"=>"",
        "rfs_cb_totals_only"=>"",
        "rfs_groupby"=>""*/
		);
    $form = new Form('reportForm');
    $form->setRequest($request);
    $filter_list = ReportHelper::findFilters($user->getUserId());
    array_unshift($filter_list, $default_sets);
    $form->addInput(array("type"=>"combobox",
    	"name"=>"f_filter_select",
    	"onchange"=>"document.reportForm.filter_form.value=1; document.reportForm.submit();",
    	"style"=>"width: 250",
    	"data"=>$filter_list,
    	"datakeys"=>array("rfs_id","rfs_name")
    	));
    
    $project_list = ProjectHelper::findAllProjects($user, array('restrict' => count($user->getProjects())>0));
    $form->addInput(array("type"=>"combobox",
    	"onchange"=>"fillActivityDir();fillUsersGroup();",
    	"name"=>"project",
    	"style"=>"width: 250",
    	"data"=>$project_list,
    	"datakeys"=>array("p_id","p_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.all'))
    	));
    
   	$user_list = array();
    $g_user_list = UserHelper::findAllUsers($user, false);
    foreach ($g_user_list as $user_item) {
    	$user_list[$user_item["u_id"]] = $user_item["u_name"];
    	$ub = UserHelper::findProjects($user_item["u_id"], $user->getOwnerId());
    	if ($ub) {
    		foreach ($ub as $ap) {
    			$aprojects[$user_item["u_id"]][] =  $ap["p_id"];
    		}
    	}
    }
    
    $col_count = ceil(count($user_list)/3);
    $form->addInput(array("type"=>"checkboxgroup","name"=>"users",
    		"data"=>$user_list,"layout"=>"V","groupin"=>$col_count,"style"=>"width: 100%"));
    
 	$activity_list = ActivityHelper::findAllActivity($user);
    $form->addInput(array("type"=>"combobox",
    	"name"=>"activity",
    	"style"=>"width: 250",
    	"data"=>$activity_list,
    	"datakeys"=>array("a_id","a_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.all'))
    	));
    $form->addInput(array("type"=>"combobox",
    	"name"=>"period",
    	"data"=>array(
    			PERIOD_THIS_MONTH=>$i18n->getKey('controls.per_tm'),
    			PERIOD_LAST_MONTH=>$i18n->getKey('controls.per_lm'),
    			PERIOD_THIS_WEEK=>$i18n->getKey('controls.per_tw'),
    			PERIOD_LAST_WEEK=>$i18n->getKey('controls.per_lw')),
    	"empty"=>array(""=>$i18n->getKey('controls.sel_period'))
    	));
    	
    if ($user->isManager() || $user->isCoManager())
    	$groupby_data = array("user"=>$i18n->getKey('form.report.groupby_user'));
    $groupby_data["project"]=$i18n->getKey('form.report.groupby_project');
    $groupby_data["activity"]=$i18n->getKey('form.report.groupby_activity');
    
    $increcords_data = array();
    $increcords_data["1"]=$i18n->getKey('controls.inc_billable');
    $increcords_data["2"]=$i18n->getKey('controls.inc_nbillable');
    
    $form->addInput(array("type"=>"datetext","maxlength"=>"20","name"=>"from"));
    $form->addInput(array("type"=>"datetext","maxlength"=>"20","name"=>"to"));
    $form->addInput(array("type"=>"combobox",
    	"name"=>"groupby",
    	"data"=>$groupby_data,
    	"empty"=>array(""=>$i18n->getKey('controls.sel_groupby'))
    	));
    $form->addInput(array("type"=>"combobox",
    	"name"=>"increcords",
    	"data"=>$increcords_data,
    	"empty"=>array(""=>$i18n->getKey('controls.all'))
    	));
    $form->addInput(array("type"=>"text","name"=>"f_filter_new","maxlength"=>"30","style"=>"width: 250"));
    $form->addInput(array("type"=>"checkbox","name"=>"chproject","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chactivity","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chstart","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chfinish","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chduration","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chnote","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chshowidle","data"=>1));
    $form->addInput(array("type"=>"checkbox","name"=>"chtotalonly","data"=>1));
	$form->addInput(array("type"=>"submit","name"=>"btsubmit"));
	$form->addInput(array("type"=>"submit","name"=>"btsave"));
	$form->addInput(array("type"=>"submit","name"=>"btapply"));
    $form->addInput(array("type"=>"submit","name"=>"btdelete","onclick"=>"return confirm('".$i18n->getKey("form.filter.filter_confirm_delete")."')"));
    $form->addInput(array("type"=>"hidden","name"=>"filter_form"));
    
	$bean = new ActionForm("reportBean", $form, $request);
	$form->setValueByElement("btsubmit",$i18n->getKey('button.generate'));
	$form->setValueByElement("btsave",$i18n->getKey('button.save'));
	$form->setValueByElement("btapply",$i18n->getKey('button.apply'));
	$form->setValueByElement("btdelete",$i18n->getKey('button.delete'));
	$form->setValueByElement("filter_form","");

	if (!$bean->getAttribute("f_filter_select") || $bean->getAttribute("f_filter_select")==-1) {
		$el = &$form->getElement("btdelete");
		$el->setEnable(false);
	}
	
	if ($request->getMethod()=="POST") {
		if (!$bean->getAttribute("btsubmit") && ($request->getAttribute("filter_form") || $bean->getAttribute("btapply"))) {
			// apply filter
			if ($bean->getAttribute("f_filter_select")) {
				ReportHelper::loadReportFilter($user, $bean);
				if ($bean->getAttribute("f_filter_select")>0) {
					if ($filter_list && is_array($filter_list)) {
						foreach ($filter_list as $filter) {
							if ($filter["rfs_id"]==$bean->getAttribute("f_filter_select")) {
								$bean->setAttribute("f_filter_new",$filter["rfs_name"]);
							}
						}
					}
				}
				$bean->saveBean();
				Header("Location: reports.php");
				exit();
			}
		} elseif ($bean->getAttribute("btsave")) {
			// save filter
			import('form.check.Validator');
		
			$validator = new Validator($bean->getAttribute("f_filter_new"));
			$validator->validateSpaceString();
			$validator->validateEmptyString();
			if (!$validator->isValid()) {
				$errors->add("f_filter_new",$i18n->getKey("errors.wrong"),$i18n->getKey("form.filter.filter_new"));	
			}
			
			if ($errors->isEmpty()) {
				$id = ReportHelper::saveReportFilter($user, $bean);
				$bean->setAttribute("f_filter_select",$id);
				$bean->saveBean();
				Header("Location: reports.php");
				exit();
			}
		} elseif($bean->getAttribute("btdelete")) {
			// delete filter
			if ($bean->getAttribute("f_filter_select")) {
				ReportHelper::deleteFilter($user, $bean->getAttribute("f_filter_select"));
				if (isset($filter_list[0])) {
					$bean->setAttribute("f_filter_new",$filter_list[0]["rfs_name"]);
					ReportHelper::loadReportFilter($user, $bean);
					$bean->setAttribute("f_filter_new","");
					$bean->setAttribute("f_filter_select","");
					$bean->saveBean();
				}
				Header("Location: reports.php");
				exit();
			}
		} else {
			if (!$bean->getAttribute("period")) {
				$o_from = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("from"));
				
				if ($o_from->isError() || !$bean->getAttribute("from") )
					$errors->add("datefrom",$i18n->getKey("errors.wrong"),$i18n->getKey("form.report.from"));
					
				$o_to = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("to"));
				if ($o_to->isError() || !$bean->getAttribute("to"))
					$errors->add("dateto",$i18n->getKey("errors.wrong"),$i18n->getKey("form.report.to"));
				
				if ($o_from->compare($o_to)>0)
					$errors->add("period",$i18n->getKey("errors.report_period"));
			}
			$bean->saveBean();
			
	        if ($errors->isEmpty()) {
	        	header("Location: report_table.php");
	        	exit();
	        }
		}
	}
	
	if (!$bean->isSaved()) { // stored in session
    	$form->setValueByElement("users", array_keys($user_list));

    	$period		= new Period(PERIOD_THIS_MONTH, new DateAndTime($i18n->getDateFormat()));
		$form->setValueByElement("from", $period->getBeginDate() );
		$form->setValueByElement("to", $period->getEndDate() );
		
		$form->setValueByElement("chproject", 1);
		$form->setValueByElement("chactivity", 1);
		$form->setValueByElement("chstart", 1);
		$form->setValueByElement("chfinish", 1);
		$form->setValueByElement("chduration", 1);
		$form->setValueByElement("chnote", 1);
		$form->setValueByElement("chshowidle", 0);
		$form->setValueByElement("chtotalonly", 0);
    }
    
	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign("activity_list", $activity_list );
	$smarty->assign("aprojects_list", @$aprojects );
	$smarty->assign("forms",array($form->getName()=>$form->toArray()));
	$smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
	if ($bean->getAttribute("f_filter_select")==-1) {
		$smarty->assign("onload","onLoad=\"document.reportForm.project.focus();fillActivityDir();fillUsersGroup();\"");
	} else {
		$smarty->assign("onload","onLoad=\"document.reportForm.project.focus();fillActivityDir();\"");
	}
    $smarty->assign("title_page",$i18n->getKey("form.report.title"));
  	$smarty->assign("content_page_name", "report_filter.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>