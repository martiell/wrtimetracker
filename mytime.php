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
// | Contributors: Igor Melnik <igor.melnik at mail.ru>
// +----------------------------------------------------------------------+


	require_once('initialize.php');

	import('form.Form');
	import('UserHelper');
	import('TimeHelper');
	import('DateAndTime');
	import('SysConfig');
	import('ChartHelper');

	// init and store date in session
  
	$cl_date = $request->getParameter('date',@$_SESSION['date']);
	$crdate = new DateAndTime(SYS_DATEFORMAT, $cl_date);
	if($crdate->isError())
		$crdate = new DateAndTime(SYS_DATEFORMAT);
	if(!$cl_date)
		$cl_date = $crdate->toString(SYS_DATEFORMAT);

	$_SESSION['date'] = $cl_date;


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

	//$user->reload();

/*echo "<PRE>";
print_r($_SESSION);
echo "</PRE>";*/
	/*if ($no_finished_rec = TimeHelper::findUncompletedRecord($user->getUserId())) {
		$d = new DateAndTime(DB_DATEFORMAT,$no_finished_rec["al_date"]);
		Header("Location: mytime_edit.php?ts=".$no_finished_rec["al_timestamp"]."&date=".$d->toString(SYS_DATEFORMAT));
	}*/

	$cl_start		= trim($request->getParameter('start'));
	$cl_finish		= trim($request->getParameter('finish'));
	$cl_duration	= trim($request->getParameter('duration'));
	$cl_note		= trim($request->getParameter('note'));
	if ($request->getMethod()=="POST") {
		$cl_billable	= $request->getParameter('billable');
	} else {
		$cl_billable = 1;
	}

	// init and store behalf_id in session
	$in_behalf_id	= $request->getParameter('behalfUser',(isset($_SESSION['behalf_id'])?$_SESSION['behalf_id']:$user->getUserId()));
	$_SESSION['behalf_id'] = $in_behalf_id;

	$cl_project		= $request->getParameter('project',($request->getMethod()!="POST"?@$_SESSION['project']:null));
	$_SESSION['project'] = $cl_project;

	$cl_activity	= $request->getParameter('activity',($request->getMethod()!="POST"?@$_SESSION['activity']:null));
	$_SESSION['activity'] = $cl_activity;

	$cl_chperiod	= $request->getParameter('chPeriod',($request->getMethod()!="POST"?@$_SESSION['chPeriod']:null));
	if ($cl_chperiod==null) {
		$sc = new SysConfig($user);
		$cl_chperiod = $sc->getValue(SYSC_CHART_PERIOD);
	}
	if (!$cl_chperiod) $cl_chperiod = 5;
	$_SESSION['chPeriod'] = $cl_chperiod;

	// elements of form 'behalfForm'
	$sform = new Form('behalfForm');
	if ($user->isManager() || $user->isCoManager()) {

		$user_list = UserHelper::findAllUsers($user);

		$sform->addInput(array("type"=>"combobox",
		"onchange"=>"if(this.form) this.form.submit();",
			"name"=>"behalfUser",
			"value"=>$in_behalf_id,
			"data"=>$user_list,
			"datakeys"=>array("u_id","u_name"),
		));

	   	$sform->addInput(array("type"=>"submit","name"=>"bhvsubmit","value"=>$i18n->getKey('button.behalf_set')));
    	//$sform->addInput(array("type"=>"hidden", "name"=>"date", "value"=>$cl_date));
    }

    // elements of form 'chartForm'
    $chperiod_data = array();
    $chperiod_data["1"]=$i18n->getKey('controls.per_td');
    $chperiod_data["2"]=$i18n->getKey('controls.per_tw');
    $chperiod_data["3"]=$i18n->getKey('controls.per_tm');
	$chperiod_data["4"]=$i18n->getKey('controls.per_ty');
    $chperiod_data["5"]=$i18n->getKey('controls.per_at');

    $form3 = new Form('chartForm');
	$form3->addInput(array("type"=>"combobox",
		"onchange"=>"if(this.form) this.form.submit();",
		"name"=>"chPeriod",
		"value"=>$cl_chperiod,
		"data"=>$chperiod_data
	));
	$form3->addInput(array("type"=>"submit","name"=>"chsubmit","value"=>$i18n->getKey('button.save')));


	// elements of form 'mytimeForm'
	import('ProjectHelper');
	$project_list = ProjectHelper::findAllProjects($user, array('restrict' => true));

	$form = new Form('mytimeForm');
	$form->addInput(array("type"=>"combobox",
		"onchange"=>"fillActivityDir();",
		"name"=>"project",
		"style"=>"width: 250",
		"value"=>$cl_project,
		"data"=>$project_list,
		"datakeys"=>array("p_id","p_name"),
		"empty"=>array(""=>$i18n->getKey('controls.select.project'))
		));
	import('ActivityHelper');
	$activity_list = ActivityHelper::findAllActivity($user);
	$form->addInput(array("type"=>"combobox",
		"name"=>"activity",
		"style"=>"width: 250",
		"value"=>$cl_activity,
		"data"=>$activity_list,
		"datakeys"=>array("a_id","a_name"),
		"empty"=>array(""=>$i18n->getKey('controls.select.activity'))
		));

	$form->addInput(array("type"=>"text","name"=>"start","value"=>$cl_start,"onchange"=>"formDisable('start');"));
	$form->addInput(array("type"=>"text","name"=>"finish","value"=>$cl_finish,"onchange"=>"formDisable('finish');"));
	$form->addInput(array("type"=>"text","name"=>"duration","value"=>$cl_duration,"onchange"=>"formDisable('duration');"));
	$form->addInput(array("type"=>"textarea","name"=>"note","style"=>"width: 250; height: 200;","value"=>$cl_note));
  $form->addInput(array("type"=>"calendar", "name"=>"date", "value"=>$cl_date, "sysdateformat"=>SYS_DATEFORMAT)); // calendar
	$form->addInput(array("type"=>"checkbox","name"=>"billable","data"=>1,"value"=>$cl_billable));
	$form->addInput(array("type"=>"submit","name"=>"btmytime","value"=>$i18n->getKey('button.submit')));

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

	// submit
	if ($request->getMethod()=="POST") {

		if ($request->getParameter("btmytime")) {
			// check input data
			if (!$cl_project || $cl_project<=0) {
				$errors->add("project",$i18n->getKey("errors.wr_project"));
			}
			if (!$cl_activity || $cl_activity<=0) {
				$errors->add("activity",$i18n->getKey("errors.wr_activity"));
			}
			if (!$cl_duration) {
				if (isset($cl_start) || isset($cl_finish)) {
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
				if(strpos($cl_duration, ".") !== false  || strpos($cl_duration, ":") === false)
					$cl_duration = decimal_to_time($cl_duration);

				if (!TimeHelper::isValidDuration($cl_duration) || $cl_duration == '00:00') {
					$errors->add("duration",$i18n->getKey("errors.wrong"),$i18n->getKey("form.mytime.duration"));
				}
			}
			// finish check input data

			if($lockdate && $crdate->before($lockdate)) {
				$errors->add("lock_period",$i18n->getKey("errors.period_lock"));
			}

			if (ProjectHelper::isProjectExistsStrict($cl_project, $user) &&
				ActivityHelper::isActivityExistsStrict($cl_activity, $user) &&
				$errors->isEmpty()) {

					if($no_finished_rec = TimeHelper::findUncompletedRecord($user->getUserId()) AND ($cl_finish=="" AND $cl_duration=="")) {
						$errors->add("insert", "uncompleted entry already exists, close previous one. <A HREF='mytime_edit.php?ts=".$no_finished_rec['al_timestamp']."&date=".date("m/d/Y", strtotime($no_finished_rec['al_date']))."'>Go to record</A>");
					}
					else {
						if ($r = TimeHelper::insert(array(
                'date' => $crdate->toString(DB_DATEFORMAT),
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
							}
							else {
								header("Location: mytime.php");
							}
							exit();
						}
						$errors->add("insert",$i18n->getKey("errors.mt_insert"));
					}
			}
		}

		if ($request->getParameter("behalfUser")) {
	    	// if user is manager
		    if($user->isManager() || $user->isCoManager()) {
			    $user->setBehalfId($in_behalf_id);
			    $user->reload();
			    header("Location: mytime.php");
			    exit();
		    }
		}

		if ($request->getParameter("chPeriod")) {//echo SYSC_CHART_PERIOD." = $cl_chperiod";
		    $sc = new SysConfig($user);
			$sc->setValue(SYSC_CHART_PERIOD, $cl_chperiod);
			header("Location: mytime.php");
			exit;
		}
	}

	$ud = UserHelper::findUserById($user->getOwnerId(), new User($user->getOwnerId(),false));

	$week_time = TimeHelper::getTimePerWeek($user, $crdate);

	$smarty->assign_by_ref("errors", $errors);
	$smarty->assign_by_ref("messages", $messages);
	$smarty->assign("time_list", TimeHelper::findAllTime($crdate->toString(DB_DATEFORMAT),$user->getActiveUser()) );
	$smarty->assign("total_time", TimeHelper::getTotalTime($crdate->toString(DB_DATEFORMAT),$user->getActiveUser()) );
	$smarty->assign("curr_date", $crdate->toString() );
	$smarty->assign_by_ref("project_list", $project_list );
	$smarty->assign_by_ref("activity_list", $activity_list );
    $smarty->assign("forms",array($form->getName()=>$form->toArray(),$sform->getName()=>$sform->toArray(),$form3->getName()=>$form3->toArray()) );
    $smarty->assign("onload","onLoad = \"document.mytimeForm.project.focus();fillActivityDir();\"");
    $smarty->assign("timestring",$crdate->toString($i18n->getDateFormat()));
    $smarty->assign("userdet_string",UserHelper::getUserDetailsString($user,$GLOBALS["I18N"]));
    $smarty->assign_by_ref("week_time", $week_time);
	if($ud['u_show_pie']!=0) {
		if($ud['u_pie_mode']==2)
			$smarty->assign("chart_href", "chart.php?r=".md5(uniqid("random"))."&period=".$cl_chperiod."&pie_mode=project");
		else
			$smarty->assign("chart_href", "chart.php?r=".md5(uniqid("random"))."&period=".$cl_chperiod);

		$smarty->assign('pie_mode', $ud['u_pie_mode']);
		$chart_data = ChartHelper::getActivityChartData($user->getUserId(), $cl_chperiod, $ud['u_pie_mode'] == 2 ? 'project' : '');
		$smarty->assign("chart_data", $chart_data);
	}

    $smarty->assign("title_page",$i18n->getKey("form.mytime.title"));
  	$smarty->assign("content_page_name","mytime.tpl");
  	$smarty->display(INDEX_TEMPLATE);
?>