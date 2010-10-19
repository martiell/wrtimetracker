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

// $Id: ReportHelper.class.php,v 1.22 2009/03/09 05:02:08 nokuntseff Exp $

import("DateAndTime");

/**
 * Class ReportHelper is the assistant for preparation
 * and construction of reports
 *
 * @package TimeTracker
 */
class ReportHelper {

    /**
     * Prepares data and build invoice form and returns as string
     *
     * @param FormAction $bean
     * @param FormAction $invbean
     * @param User $user
     * @param I18n $i18n
     * @param array $errors
     * @return string
     */
	static function prepareInvoice($bean, $invbean, $user, $i18n, $errors) {
		if($bean->getAttribute("period")) {
			$period = new Period($bean->getAttribute("period"), new DateAndTime($i18n->getDateFormat()) );
		}
		else {
			$o_from = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("from"));
			$o_to = new DateAndTime($i18n->getDateFormat(),$bean->getAttribute("to"));
			$period = new Period();
			$period->setPeriod($o_from, $o_to);
		}

		if( ($user->isManager() || $user->isCoManager()) && is_array($bean->getAttribute('users'))  )
			$userlist = join (',', $bean->getAttribute('users'));
		if(!isset($userlist))
			$userlist = $user->getUserId();

		$invoice_items = ReportHelper::getInvoiceItems($userlist,
						$period->getBeginDate(DB_DATEFORMAT),
						$period->getEndDate(DB_DATEFORMAT),
						$bean->getAttribute("project"),
						$bean->getAttribute("activity"),
						$invbean->getAttribute("daily_subtotals"));

		$labels = $invbean->getAttributes();
		$labels["from"] = $period->getBeginDate();
		$labels["to"] = $period->getEndDate();

		$summs["total"] = $summs["tax"] = $summs["pay"] = 0;
		$tax = toFloat($invbean->getAttribute("tax"));
		$discount = toFloat($invbean->getAttribute("discount"));
		if (!$tax) {
			$tax = 0;
			$labels["tax"] = 0;
		}

		if(@$invoice_items["m"]) {
			$summ_total = 0;

			foreach($invoice_items["m"] as $item) {
				$summ_total += $item["ssumm"];
			}
			$summ_total = round($summ_total,2);
			$summs["total"] = $summ_total;

			$summs["discount"] = round($summ_total * $discount / 100, 2);
			$summs["tax"] = round(($summ_total-$summs["discount"]) * $tax / 100, 2);
			$summs["pay"] = $summ_total - $summs["discount"] + $summs["tax"];
		}

		ob_start();

		$style_cell = 'background-color: white; background: white;';
		$style_invtitle = 'font-size: 15pt; font-family: Arial, Helvetica, sans-serif;';
		$style_tableHeader = 'color: #000000; font-weight: bold; background-color: #A6CCF7;';
		$style_tableRow = 'border-top: solid #e0e0e0 1pt;';

		/*<style>
			.cell { background-color:white; background:white; }
			.invtitle {font-size : 15pt; font-family : Arial, Helvetica, sans-serif;}
			.tableHeader { color: #000000; font-weight: bold; background-color: #A6CCF7; }
			.tableRow { border-top: solid #e0e0e0 1pt; }
		</style>*/
		?>
	    <table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td colspan="2"><?php echo @$labels["yourcoo"]?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				   <table cellpadding="3" cellspacing="0" border="0" width="100%">
				   <tr><td align="center"><b style="<?php echo $style_invtitle?>"><?php echo $i18n->getKey("form.invoice.caption")?></b> #<?php echo @$labels["number"]?></td></tr>
				   <tr><td><b><?php echo $i18n->getKey("form.invoice.date")?>:</b>&nbsp;<?php echo @$labels["date"]?></td></tr>
				   <tr><td><b><?php echo $i18n->getKey("form.invoice.customer")?>:</b>&nbsp;<?php echo @$labels["custcoo"]?></td></tr>
				   <tr><td><b><?php echo $i18n->getKey("form.invoice.period")?>:</b>&nbsp;<?php echo $labels["from"]?> - <?php echo $labels["to"]?></td></tr>
			       </table>
			       <br>
				</td>
			</tr>
			<tr>
				<td colspan="2">

				    <table border='0' cellpadding='4' cellspacing='0' width="100%">
			        <tr>
			        	<td colspan="3" width="70%" style="<?php echo $style_tableHeader?>" align="center"><B><?php echo $i18n->getKey("form.invoice.th.username")?></B></td>
			        	<td style="<?php echo $style_tableHeader?>" align="center"><B><?php echo $i18n->getKey("form.invoice.th.time")?></B></td>
			        	<!--<td style="<?php echo $style_tableHeader?>" align="center"><B><?php echo $i18n->getKey("form.invoice.th.rate")?></B></td>-->
			        	<td style="<?php echo $style_tableHeader?>" align="center"><B><?php echo $i18n->getKey("form.invoice.th.summ")?></B></td>
			        </tr>
			        <?php if (@$invoice_items["m"]) {
		        	$dt = new DateAndTime(DB_DATEFORMAT);
		        	$bg = "";
		        	if ($invbean->getAttribute("daily_subtotals")) $bg = " bgcolor=\"#eeeeee\"";
			        foreach ($invoice_items["m"] as $iit) {
				        ?>
				        <tr <?php echo $bg?>>
				        	<td colspan="3" width="70%" style="<?php echo $style_tableRow?>"><?php echo $iit["u_name"]?></td>
				        	<td style="<?php echo $style_tableRow?>" align="center"><nobr><?php if (!$invbean->getAttribute("daily_subtotals")){?><?php echo $iit["stotal"]?><?php } else {?>&nbsp;<?php }?></nobr></td>
				        	<!--<td style="<?php echo $style_tableRow?>" align="right"><nobr><?php echo $user->getCurrency()?> <?php echo @$iit["u_rate"]?></nobr></td>-->
				        	<td style="<?php echo $style_tableRow?>" align="right"><nobr><?php if (!$invbean->getAttribute("daily_subtotals")){?><?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$iit["ssumm"])?><?php } else {?>&nbsp;<?php }?></nobr></td>
				        </tr>
				        <?php
				        if (isset($invoice_items["s"]))
				        foreach ($invoice_items["s"] as $iits) {
					        if ($iit["al_user_id"]==$iits["al_user_id"]) {
					        	$dt->parseVal($iits["al_date"]);
					        ?>
						        <tr>
						        	<td width="10%" style="<?php echo $style_tableRow?>">&nbsp;</td>
						        	<td colspan="2" width="70%" style="<?php echo $style_tableRow?>"><?php echo $dt->toString($i18n->getDateFormat())?></td>
						        	<td style="<?php echo $style_tableRow?>" align="center"><?php echo $iits["stotal"]?></td>
						        	<!--<td style="<?php echo $style_tableRow?>" align="right">&nbsp;</td>-->
						        	<td style="<?php echo $style_tableRow?>" align="right"><nobr><?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$iits["ssumm"])?></nobr></td>
						        </tr>
					        <?php
					        }
						}
					}
			        }?>

			        <tr>
			        	<td colspan="5" style="<?php echo $style_tableRow?>">&nbsp;</td>
			        </tr>
			        <tr>
			        	<td style="<?php echo $style_cell?>" align="right" colspan="4"><B><?php echo $i18n->getKey("form.invoice.subtotal")?>:</B></td>
			        	<td style="<?php echo $style_cell?>" align="right"><nobr><?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$summs["total"]);/* echo "orig=".$summs["total"];*/?></nobr></td>
			        </tr>
			        <?php if ($invbean->getAttribute("discount")>0) {?>
			        <tr>
			        	<td style="<?php echo $style_cell?>" align="right" colspan="4"><B>- <?php echo $i18n->getKey("form.invoice.discount")?> <?php echo $labels["discount"]?>%:</B></td>
			        	<td style="<?php echo $style_cell?>" align="right"><nobr>- <?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$summs["discount"])?></nobr></td>
			        </tr>
			        <?php }?>
			        <tr>
			        	<td style="<?php echo $style_cell?>" align="right" colspan="4"><B><?php echo $i18n->getKey("form.invoice.tax")?> <?php echo $labels["tax"]?>%:</B></td>
			        	<td style="<?php echo $style_cell?>" align="right"><nobr><?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$summs["tax"])?></nobr></td>
			        </tr>
			        <tr>
			        	<td style="<?php echo $style_cell?>" align="right" colspan="4"><B><?php echo $i18n->getKey("form.invoice.total")?>:</B></td>
			        	<td style="<?php echo $style_cell?>" align="right"><nobr><?php echo $user->getCurrency()?> <?php echo sprintf("%8.2f",$summs["pay"])?></nobr></td>
			        </tr>
			        </table>
			        <br>

				</td>
			</tr>
			<tr>
			    <td><?php echo @$labels["comment"]?></td>
			</tr>
			</table>
			<?php
			$content = ob_get_contents();
			ob_clean();
			return $content;
	}

	
        /**
         * Prepares invoice items
         * @param string $user_list
         * @param string $date_from
         * @param string $date_to
         * @param int $selproject
         * @param int $selactivity
         * @param int $daily_subtotals
         * @return array
         */
	static function getInvoiceItems($user_list, $date_from, $date_to, $selproject = 0, $selactivity = 0, $daily_subtotals = 0) {
		$mdb2 = getConnection();

    	// Main items.
    	$result = array();
    	$sql = "select u_name, al_user_id, sum(time_to_sec(al_duration)) as stotal,
          round(sum(time_to_sec(al_duration) * coalesce(ub_rate,0)/3600),2) as ssumm from activity_log
            inner join user_bind on (ub_id_u = al_user_id and ub_id_p = al_project_id)
            inner join users on (al_user_id = u_id)
          where al_billable = 1 and al_user_id in (".$user_list.") and al_date >= '$date_from' and al_date <= '$date_to'".
            ($selproject>0 ? " and al_project_id = ".$selproject : "").
            ($selactivity>0 ? " and al_activity_id = ".$selactivity : "").
          " group by u_name, al_user_id";

        $res = &$mdb2->query($sql);
        if (PEAR::isError($res) == 0) {
           while ($val = $res->fetchRow()) {
             $val['stotal'] = sec_to_time_fmt_hm($val['stotal']);
             $result["m"][] = $val; // "m" means main items
           }
        }

        // Daily subtotals.
        if ($daily_subtotals) {
	      $sql = "select al_user_id, sum(time_to_sec(al_duration)) as stotal,
	        round(sum(time_to_sec(al_duration) * coalesce(ub_rate,0)/3600),2) as ssumm,
	        al_date from activity_log
	          inner join user_bind on (ub_id_u = al_user_id and ub_id_p = al_project_id)
	        where al_billable = 1 and  al_user_id in (".$user_list.") and al_date >= '$date_from' and al_date <= '$date_to'".
	          ($selproject>0 ? " and al_project_id = ".$selproject : "").
	          ($selactivity>0 ? " and al_activity_id = ".$selactivity : "").
	        " group by al_date, al_user_id".
			" order by al_date, al_user_id";
	      $res = &$mdb2->query($sql);
	      if (PEAR::isError($res) == 0) {
	        while ($val = $res->fetchRow()) {
              $val['stotal'] = sec_to_time_fmt_hm($val['stotal']);
              $result["s"][] = $val;  // "s" means subtotals
	        }
	      }
        }

        return $result;
	}

        /**
         * Updates filter settings of report into database
         *
         * @param User $user
         * @param array $fields
         * @param array $options
         * @return int
         */
	function updateFilter($user, $fields, $options = null) {
        $mdb2 = getConnection();
    	$sql = "update report_filter_set
        	  set ".
  			   "rfs_name = ".mdb2_quote($mdb2, $fields['name']).", ".
  			   "rfs_id_p = ".$fields['project'].", ".
    	       "rfs_id_a = ".$fields['activity'].", ".
			   "rfs_users = ".mdb2_quote($mdb2, $fields['users']).", ".
			   "rfs_period = ".mdb2_quote($mdb2, $fields['period']).", ".
			   "rfs_period_start = ".mdb2_quote($mdb2, $fields['from'])." ,".
			   "rfs_period_finish = ".mdb2_quote($mdb2, $fields['to']).", ".
			   "rfs_cb_project = ".$fields['chproject'].", ".
    	       "rfs_cb_activity = ".$fields['chactivity'].", ".
    		   "rfs_cb_note = ".$fields['chnote'].", ".
			   "rfs_cb_start = ".$fields['chstart'].", ".
			   "rfs_cb_finish = ".$fields['chfinish'].", ".
			   "rfs_cb_duration = ".$fields['chduration'].", ".
			   "rfs_cb_idle = ".$fields['chshowidle'].", ".
			   "rfs_cb_totals_only = ".$fields['chtotalonly'].", ".
			   "rfs_groupby = ".mdb2_quote($mdb2, $fields['groupby']).", ".
			   "rfs_billable = ".$fields['billable'].
			   " where rfs_id_u = ".$user->getUserId()." and rfs_id = ".$fields['id'];
    	$affected = &$mdb2->exec($sql);
 		return PEAR::isError($affected);
	}

        /**
         * Stores filter settings of report into database
         *
         * @param User $user
         * @param array $fields
         * @param array $options
         * @return array
         */
	static function insertFilter($fields, $options = null) {
		$mdb2 = getConnection();
    	$sql = "insert into report_filter_set (rfs_id_u, rfs_name, ".
			   "rfs_id_p, rfs_id_a, rfs_users, rfs_period, rfs_period_start, rfs_period_finish, ".
    	       "rfs_cb_project, rfs_cb_activity, rfs_cb_note, rfs_cb_start, rfs_cb_finish, rfs_cb_duration, ".
    	       "rfs_cb_idle, rfs_cb_totals_only, rfs_groupby, rfs_billable) values(".
			   $fields['user_id'].", ".mdb2_quote($mdb2, $fields['name']).", ".
			   $fields['project'].", ".$fields['activity'].", ".
			   mdb2_quote($mdb2, $fields['users']).", ".mdb2_quote($mdb2, $fields['period']).", ".
			   mdb2_quote($mdb2, $fields['from']).", ".mdb2_quote($mdb2, $fields['to']).", ".
			   $fields['chproject'].", ".$fields['chactivity'].", ".
			   $fields['chnote'].", ".$fields['chstart'].", ".
               $fields['chfinish'].", ".$fields['chduration'].", ".
			   $fields['chshowidle'].", ".$fields['chtotalonly'].", ".
               mdb2_quote($mdb2, $fields['groupby']).", ".$fields['billable'].")";
		$affected = &$mdb2->exec($sql);
  		if (PEAR::isError($affected) == 0) {
  			$sql = "SELECT LAST_INSERT_ID() AS `last_id`";
			$res = &$mdb2->query($sql);
			$val = $res->fetchRow();
			if(!isset($val['last_id']) OR $val['last_id']=='')
				return $val[0];
			else
				return $val['last_id'];
  		}
    	return false;
	}

        /**
         * Deletes filter setting from database
         * @param User $user
         * @param int $filter_id
         * @return boolean
         */
	static function deleteFilter($user, $filter_id) {
		$mdb2 = getConnection();
		$sql = "delete from report_filter_set where rfs_id_u = ".$user->getUserId()." and rfs_id = $filter_id";
     	$affected = &$mdb2->exec($sql);
    	if (PEAR::isError($affected) == 0) {
        	return true;
    	}
        return false;
	}

        /**
         * Returns array of data of all filters which belong to the user
         * @param int $user_id
         * @return array
         */
	static function findFilters($user_id) {
		$mdb2 = getConnection();

    	$result = array();
    	$sql = "select * from report_filter_set where rfs_id_u = $user_id";
    	$res = &$mdb2->query($sql);
    	if (PEAR::isError($res) == 0) {
	        while ($val = $res->fetchRow()) {
	        	$result[] = $val;
        	}
        	return mu_sort($result, "rfs_name");
    	}
        return false;
	}

        /**
         * Returns array of data of all filters
         * @param int $manager_id
         * @return <type>
         */
	static function findFiltersAll($manager_id) {
		$mdb2 = getConnection();

    	$result = array();
    	$sql = "SELECT * FROM report_filter_set WHERE rfs_id_u = $manager_id
    	  OR rfs_id_u IN (SELECT u_id FROM users WHERE u_manager_id = $manager_id)";
    	$res = &$mdb2->query($sql);
    	if (PEAR::isError($res) == 0) {
	        while ($val = $res->fetchRow()) {
	        	$result[] = $val;
        	}
        	return mu_sort($result, "rfs_name");
    	}
        return false;
	}

        /**
         * Finds filter data by ID
         * @param User $user
         * @param int $filterId
         * @return array
         */
	static function findFilterById($user, $filterId) {
		$mdb2 = getConnection();
    	$sql = "select * from report_filter_set where rfs_id_u = ".$user->getUserId()." and rfs_id = $filterId";
    	$res = &$mdb2->query($sql);
    	if (PEAR::isError($res) == 0) {
	        if ($val = $res->fetchRow()) {
	        	return $val;
        	}
    	}
        return false;
	}

        /**
         * Finds filter data by name
         * @param User $user
         * @param string $filterName
         * @return array
         */
	static function findFilterByName($user, $filterName) {
		$mdb2 = getConnection();
    	$sql = "select * from report_filter_set where rfs_id_u = ".$user->getUserId()." and rfs_name = ".mdb2_quote($mdb2, $filterName);
    	$res = &$mdb2->query($sql);
    	if (PEAR::isError($res) == 0) {
	        if ($val = $res->fetchRow()) {
	        	return $val;
        	}
    	}
        return false;
	}

        /**
         * Stores filter settings
         * @param User $user
         * @param ActionForm $bean
         * @return boolean
         */
	static function saveReportFilter($user, &$bean) {
		$user_s = "";
		if (!$bean->getAttribute("project")) $bean->setAttribute("project","-1");
		if (!$bean->getAttribute("activity")) $bean->setAttribute("activity", "-1");
		if (!$bean->getAttribute("chproject")) $bean->setAttribute("chproject", "-1");
		if (!$bean->getAttribute("chactivity")) $bean->setAttribute("chactivity", "-1");
		if (!$bean->getAttribute("chnote")) $bean->setAttribute("chnote", "-1");
		if (!$bean->getAttribute("chstart")) $bean->setAttribute("chstart", "-1");
		if (!$bean->getAttribute("chfinish")) $bean->setAttribute("chfinish", "-1");
		if (!$bean->getAttribute("chduration")) $bean->setAttribute("chduration", "-1");
		if (!$bean->getAttribute("chshowidle")) $bean->setAttribute("chshowidle", "-1");
		if (!$bean->getAttribute("chtotalonly")) $bean->setAttribute("chtotalonly", "-1");
		if (!$bean->getAttribute("chshowidle")) $bean->setAttribute("chshowidle", "-1");
		if (!$bean->getAttribute("chtotalonly")) $bean->setAttribute("chtotalonly", "-1");
		if (!$bean->getAttribute("increcords")) $bean->setAttribute("increcords", "-1");

		if ($bean->getAttribute("users") && is_array($bean->getAttribute("users"))) {
			$user_s = join(",",$bean->getAttribute("users"));

		}
		if ($bean->getAttribute("from")) {
			$dt = new DateAndTime($GLOBALS["I18N"]->getDateFormat(), $bean->getAttribute("from"));
			$from = $dt->toString(DB_DATEFORMAT);
		}
		if ($bean->getAttribute("to")) {
			$dt = new DateAndTime($GLOBALS["I18N"]->getDateFormat(), $bean->getAttribute("to"));
			$to = $dt->toString(DB_DATEFORMAT);
		}
		if ($p = ReportHelper::findFilterByName($user, $bean->getAttribute("f_filter_new"))) {
		return ReportHelper::updateFilter($user, array(
        'id' => $p["rfs_id"],
        'name' => $bean->getAttribute("f_filter_new"),
        'project' => $bean->getAttribute("project"),
        'activity' => $bean->getAttribute("activity"),
        'users' => $user_s,
        'period' => $bean->getAttribute("period"),
        'from' => $from,
        'to' => $to,
        'chproject' => $bean->getAttribute("chproject"),
        'chactivity' => $bean->getAttribute("chactivity"),
        'chnote' => $bean->getAttribute("chnote"),
        'chstart' => $bean->getAttribute("chstart"),
        'chfinish' => $bean->getAttribute("chfinish"),
        'chduration' => $bean->getAttribute("chduration"),
        'chshowidle' => $bean->getAttribute("chshowidle"),
        'chtotalonly' => $bean->getAttribute("chtotalonly"),
        'groupby' => $bean->getAttribute("groupby"),
        'billable' => $bean->getAttribute("increcords")));
		} else {
          /* $user_id, $name,
				$project, $activity, $users, $period, $from, $to, $chproject, $chactivity,
        		$chnote, $chstart, $chfinish, $chduration, $chshowidle, $chtotalonly, $groupby, $billable)*/
		return ReportHelper::insertFilter(array(
      'user_id' => $user->getUserId(),
			'name' => $bean->getAttribute("f_filter_new"),
			'project' => $bean->getAttribute("project"),
			'activity' => $bean->getAttribute("activity"),
			'users' => $user_s,
			'period' => $bean->getAttribute("period"),
			'from' => $from,
      'to' => $to,
      'chproject' => $bean->getAttribute("chproject"),
      'chactivity' => $bean->getAttribute("chactivity"),
      'chnote' => $bean->getAttribute("chnote"),
      'chstart' => $bean->getAttribute("chstart"),
      'chfinish' => $bean->getAttribute("chfinish"),
      'chduration' => $bean->getAttribute("chduration"),
      'chshowidle' => $bean->getAttribute("chshowidle"),
      'chtotalonly' => $bean->getAttribute("chtotalonly"),
      'groupby' => $bean->getAttribute("groupby"),
      'billable' => $bean->getAttribute("increcords") ));
		}
	}

        /**
         * Loads filter settings into form
         * @param User $user
         * @param ActionForm $bean
         * @return boolean
         */
	static function loadReportFilter($user, &$bean) {
		$val = ReportHelper::findFilterById($user, $bean->getAttribute("f_filter_select"));
        if ($val) {
			$bean->setAttribute("project",		$val["rfs_id_p"]);
			$bean->setAttribute("activity",		$val["rfs_id_a"]);
			if ($val["rfs_users"]) {
				$bean->setAttribute("users", explode(",",$val["rfs_users"]));
			}
			$bean->setAttribute("period",		$val["rfs_period"]);
			if ($val["rfs_period_start"]) {
				$dt = new DateAndTime(DB_DATEFORMAT, $val["rfs_period_start"]);
				$bean->setAttribute("from",			$dt->toString($GLOBALS["I18N"]->getDateFormat()));
			}
			if ($val["rfs_period_finish"]) {
				$dt = new DateAndTime(DB_DATEFORMAT, $val["rfs_period_finish"]);
				$bean->setAttribute("to",			$dt->toString($GLOBALS["I18N"]->getDateFormat()));
			}
        	$bean->setAttribute("chproject",	$val["rfs_cb_project"]);
        	$bean->setAttribute("chactivity",	$val["rfs_cb_activity"]);
        	$bean->setAttribute("chnote",		$val["rfs_cb_note"]);
        	$bean->setAttribute("chstart",		$val["rfs_cb_start"]);
        	$bean->setAttribute("chfinish",		$val["rfs_cb_finish"]);
        	$bean->setAttribute("chduration",	$val["rfs_cb_duration"]);
        	$bean->setAttribute("chshowidle",	$val["rfs_cb_idle"]);
        	$bean->setAttribute("chtotalonly",	$val["rfs_cb_totals_only"]);
        	$bean->setAttribute("groupby",		$val["rfs_groupby"]);
        	$bean->setAttribute("increcords",	$val["rfs_billable"]);
        	return true;
    	} else {
    		$attrs = $bean->getAttributes();
    		$attrs = array_merge($attrs, array(
    			"project"=>"",
    			"activity"=>"",
    			"users"=>$user->getUserId(),
    			"period"=>PERIOD_THIS_WEEK,
    			"chproject"=>"1",
    			"chactivity"=>"1",
    			"chnote"=>"1",
    			"chstart"=>"1",
    			"chfinish"=>"1",
    			"chduration"=>"1",
    			"chshowidle"=>"",
    			"chtotalonly"=>"",
    			"groupby"=>"",
    			"increcords"=>"",
    			"f_filter_new"=>""
    			));
    		$bean->setAttributes($attrs);
    		return true;
    	}
        return false;
    }
}
?>