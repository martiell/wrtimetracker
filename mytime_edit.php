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
// | Contributors: Igor Melnik <igor@rivne.com>
// +----------------------------------------------------------------------+

	require_once('initialize.php');
	import('form.Form');
	import('UserHelper');
	import('TimeHelper');
	import('DateAndTime');
	import('SysConfig');
	
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

	$date_ask	= $request->getParameter('date',(isset($_SESSION['date_ask'])?$_SESSION['date_ask']:null));
    $_SESSION['date_ask'] = $date_ask;
    
    $cl_ts	= $request->getParameter('ts',(isset($_SESSION['ts'])?$_SESSION['ts']:null));
    $_SESSION['ts'] = $cl_ts;
    
    if (!$date_ask) die("Not exists date parameter");
    $crdate = new DateAndTime(SYS_DATEFORMAT);
	$crdate->parseVal($date_ask);
	if ($crdate->isError()) $crdate = new DateAndTime(SYS_DATEFORMAT);
	
	if ($user && $cl_ts && $crdate) {
		$ud = TimeHelper::findTimeRecord($user->getActiveUser(),$cl_ts);
	}
  else {
    $ud = null;
  }
  $cl_start = $cl_finish = $cl_duration = $cl_pr_date = $cl_note = $cl_project = $cl_activity = $in_behalf_id = $cl_billable = null;
	if ($request->getMethod()=="POST") {
	    $cl_start		= trim($request->getParameter('start'));
	    $cl_finish		= trim($request->getParameter('finish'));
	    $cl_duration	= trim($request->getParameter('duration'));
		$cl_pr_date	= $request->getParameter('pr_date');
	    $cl_note		= trim($request->getParameter('note'));
	    $cl_project		= $request->getParameter('project');
	    $cl_activity	= $request->getParameter('activity');
	    $in_behalf_id	= $request->getParameter('behalfUser');
	    $cl_billable	= $request->getParameter('billable');
	} else {
		if ($ud) {
			$cl_project = $ud["al_project_id"];
	        $cl_activity = $ud["al_activity_id"];
	        $cl_start = $ud["tfrom"];
	        $cl_finish = $ud["tto"];
	        $cl_duration = $ud["tdur"];
//echo $ud['al_date'];
			$o_date = new DateAndTime(DB_DATEFORMAT, $ud['al_date']);
			//echo $ud['al_date']." * ".$o_date->toString($i18n->getDateFormat());
			//$cl_pr_date	= date("m/d/Y", strtotime($ud['al_date']));
			$cl_pr_date	= $o_date->toString($i18n->getDateFormat());
			unset($o_date);

	        $cl_note = $ud["al_comment"];	
	        if ($cl_start==$cl_finish && $cl_duration=="0:00") {
	        	$cl_finish = "";
	        	$cl_duration = "";
	        	$messages->add("no_finished_rec",$i18n->getKey("form.mytime.no_finished_rec"));
	        }
	        $cl_billable = $ud["al_billable"];
		}
	}
	
	if (!isset($in_behalf_id)) $in_behalf_id = $user->getBehalfId();
    
	// elements of form 'mytimeForm'
	import('ProjectHelper');
	$project_list = ProjectHelper::findAllProjects($user, array('restrict' => true));
	$form = new Form('mytimeForm');
    $form->addInput(array("type"=>"combobox",
    	"onchange"=>"fillActivityDir();",
    	"name"=>"project",
    	"style"=>"width: 250",
    	"value"=>@$cl_project,
    	"data"=>@$project_list,
    	"datakeys"=>array("p_id","p_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.select.project'))
    	));

    import('ActivityHelper');
 	$activity_list = ActivityHelper::findAllActivity($user);
    $form->addInput(array("type"=>"combobox",
    	"name"=>"activity",
    	"style"=>"width: 250",
    	"value"=>@$cl_activity,
    	"data"=>@$activity_list,
    	"datakeys"=>array("a_id","a_name"),
    	"empty"=>array(""=>$i18n->getKey('controls.select.activity'))
    	));
    $form->addInput(array("type"=>"text","name"=>"start","value"=>@$cl_start,"onchange"=>"formDisable('start');"));
    $form->addInput(array("type"=>"text","name"=>"finish","value"=>@$cl_finish,"onchange"=>"formDisable('finish');"));
    $form->addInput(array("type"=>"text","name"=>"duration","value"=>@$cl_duration,"onchange"=>"formDisable('duration');"));
	//$form->addInput(array("type"=>"text","name"=>"pr_date","value"=>@$cl_pr_date)); // date
	$form->addInput(array("type"=>"datetext", "maxlength"=>"20", "name"=>"pr_date", "value"=>@$cl_pr_date));
    $form->addInput(array("type"=>"textarea","name"=>"note","style"=>"width: 250; height: 200;","value"=>$cl_note));
    $form->addInput(array("type"=>"hidden","name"=>"date","value"=>@$date_ask));
    $form->addInput(array("type"=>"hidden","name"=>"ts","value"=>$cl_ts));
    $form->addInput(array("type"=>"checkbox","name"=>"billable","data"=>1,"value"=>$cl_billable));
	$form->addInput(array("type"=>"submit","name"=>"btmytime","value"=>$i18n->getKey('button.save')));
		$form->addInput(array("type"=>"submit","name"=>"btasnew","value"=>$i18n->getKey('button.asnew')));

	$locktime = $user->getLocktime();
	$lockdate = 0;
	if ($locktime<0 || $locktime==null || $locktime=="") {
		$sc = new SysConfig(new User($user->getOwnerId(), false));
		$locktime = $sc->getValue(SYSC_LOCK_DAYS);	
	}
	if ($locktime>0) {
		$cl_date_now = $request->getParameter('date_now');
		if ($cl_date_now) {
			$lockdate = new DateAndTime($i18n->getDateTimeFormat(), $cl_date_now);
			//$lockdate = new DateAndTime();
			$lockdate->decDay($locktime);
		}
	}
	
	$no_finished_rec = TimeHelper::findUncompletedRecord($user->getUserId());
	if ($no_finished_rec && $lockdate && $crdate->before($lockdate)) {
		if ($ud)
			header("Location: mytime_del.php?ts=".$cl_ts."&date=".$crdate->toString(SYS_DATEFORMAT));
		exit;
		
	}
	
	if ($request->getMethod()=="POST") {
		// check input data
		if (!$cl_project || $cl_project<=0) {
			$errors->add("project",$i18n->getKey("errors.wr_project"));
		}
		if (!$cl_activity || $cl_activity<=0) {
			$errors->add("activity",$i18n->getKey("errors.wr_activity"));
		}
		if (!$cl_duration) {
        	if ($cl_start || $cl_finish) {
            	if (!TimeHelper::isValidTime($cl_start)) {
              		$errors->add("start",$i18n->getKey("errors.wrong"),$i18n->getKey("form.mytime.start"));
            	}
            	if ($cl_finish) {
	            	if (!TimeHelper::isValidTime($cl_finish)) {
	              		$errors->add("finish",$i18n->getKey("errors.wrong"),$i18n->getKey("form.mytime.finish"));
	            	}
            	   	if (!TimeHelper::isCorrectTimeInterval($cl_start, $cl_finish)) {
    			        $errors->add("interval",$i18n->getKey("errors.wr_interval"));
    			    }
            	}
        	} else {
        		$errors->add("start",$i18n->getKey("errors.empty"),$i18n->getKey("form.mytime.start"));
        		$errors->add("finish",$i18n->getKey("errors.empty"),$i18n->getKey("form.mytime.finish"));
        		$errors->add("duration",$i18n->getKey("errors.empty"),$i18n->getKey("form.mytime.duration"));
        	}
    	} else {
			if(strstr($cl_duration, "."))
				$cl_duration = decimal_to_time($cl_duration);
       		if (!TimeHelper::isValidDuration($cl_duration)) {
       			$errors->add("duration",$i18n->getKey("errors.wrong"),$i18n->getKey("form.mytime.duration"));
       		}
    	}
    	// finish check input data
    	
    	if ($lockdate && $crdate->before($lockdate)) {
    		if($no_finished_rec) {
    			$cl_start = $cl_finish = "";
    			$cl_duration = 0;
    		} else {
				$errors->add("lock_period",$i18n->getKey("errors.period_lock"));
    		}
		}

      $o_date = new DateAndTime($i18n->getDateFormat(), $cl_pr_date);

    	// save record
    	if ($request->getAttribute("btmytime")) {			
	    	if (ProjectHelper::isProjectExists($cl_project) &&
				ActivityHelper::isActivityExists($cl_activity) &&
				$errors->isEmpty() AND !$o_date->isError() ) {
					//echo $o_date->toString(DB_DATEFORMAT); exit;
					if ($r = TimeHelper::update(array(
            'date' => $o_date->toString(DB_DATEFORMAT),
            'ts' => $cl_ts,
            'user_id' => $user->getActiveUser(),
            'project' => $cl_project,
            'activity' => $cl_activity,
            'start' => $cl_start,
            'finish' => $cl_finish,
            'duration' => $cl_duration,
            'note' => $cl_note,
            'billable' => $cl_billable))) {
  						if (count($r)>1) {
  							$d = new DateAndTime(DB_DATEFORMAT, $r[1]["r_date"]);
  							header("Location: mytime.php?date=".$d->toString(SYS_DATEFORMAT));
  						} else {
  							header("Location: mytime.php");
  						}
  						exit();
  					}
				}
				elseif($o_date->isError()) {
          var_dump($o_date, $cl_pr_date, $i18n->getDateFormat());
					$errors->add("datefrom", "incorrect date");
        }
    	}

    	// save as new record
    	if ($request->getAttribute("btasnew")) {
    		if (ProjectHelper::isProjectExistsStrict($cl_project, $user) &&
  				ActivityHelper::isActivityExistsStrict($cl_activity, $user) &&
  				$errors->isEmpty()) {
  					if (TimeHelper::insert(array(
                  'date' => $o_date->toString(DB_DATEFORMAT),
                  'user_id' => $user->getActiveUser(),
                  'project' => $cl_project,
                  'activity' => $cl_activity,
                  'start' => $cl_start,
                  'finish' => $cl_finish,
                  'duration' => $cl_duration,
                  'note' => $cl_note,
                  'billable' => $cl_billable))) {
  						header("Location: mytime.php");
  						exit();
  					}
  					$errors->add("insert",$i18n->getKey("errors.mt_insert"));
  			}
    	}
	}
	
	$week_time = TimeHelper::getTimePerWeek($user, $crdate);
	
  	$smarty->assign_by_ref("errors", $errors);
  	$smarty->assign_by_ref("messages", $messages);
  	$smarty->assign("curr_date", $crdate->toString() );
	$smarty->assign("project_list", $project_list );
	$smarty->assign("activity_list", $activity_list );
    $smarty->assign("forms",array($form->getName()=>$form->toArray()) );
    $smarty->assign("timestring",TimeHelper::parseTimeString($crdate));
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign("week_time", $week_time);
    $smarty->assign("onload","onLoad = \"document.mytimeForm.project.focus();fillActivityDir();\"");
    $smarty->assign("title_page",$i18n->getKey("form.mytime.edit_title"));
    if (@$ud) {
    	$smarty->assign("content_page_name","mytime_edit.tpl");
    } else {
    	$smarty->assign("content_page_name","syserror.tpl");
    }
  	$smarty->display(INDEX_TEMPLATE);

?>