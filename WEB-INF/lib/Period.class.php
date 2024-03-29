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

define("PERIOD_THIS_DAY",10);
define("PERIOD_THIS_WEEK",11);
define("PERIOD_LAST_WEEK",12);
define("PERIOD_THIS_MONTH",21);
define("PERIOD_LAST_MONTH",22);
define("PERIOD_THIS_YEAR",33);

class Period {
	var $mBeginDate;
	var $mEndDate;

	function Period($period_name=0, $date_point=null) {
		if (!$date_point || !($date_point instanceof DateAndTime)) {
			$date_point = new DateAndTime();
		}

		$startWeek=0;
		if ($GLOBALS["I18N"]) {
			$i18n = $GLOBALS["I18N"];
			$startWeek = $i18n->cStartWeek;
		}


		$date_begin = new DateAndTime();
		$date_begin->setFormat($date_point->getFormat());
		$date_end 	= new DateAndTime();
		$date_end->setFormat($date_point->getFormat());
		$t_arr = localtime($date_point->getTimestamp());
		$t_arr[5] = $t_arr[5] + 1900;

		if ($t_arr[6] < $startWeek) {
		  $startWeekBias = $startWeek - 7;
		} else {
		  $startWeekBias = $startWeek;
		}

		switch ($period_name) {
			case PERIOD_THIS_DAY:
				$date_begin->setTimestamp($date_point->getTimestamp());
				$date_end->setTimestamp($date_point->getTimestamp());
			break;
			case PERIOD_THIS_WEEK:
			  $date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
			break;
			case PERIOD_LAST_WEEK:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-7+$startWeekBias,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-1+$startWeekBias,$t_arr[5]));
			break;
			case PERIOD_THIS_MONTH:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,1,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+2,0,$t_arr[5]));
			break;
			case PERIOD_LAST_MONTH:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4],1,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,0,$t_arr[5]));
			break;

			case PERIOD_THIS_YEAR:
				$date_begin->setTimestamp(mktime(0, 0, 0, 1, 1, $t_arr[5]));
				$date_end->setTimestamp(mktime(0, 0, 0, 12, 31, $t_arr[5]));
			break;
		}
		$this->mBeginDate	= &$date_begin;
		$this->mEndDate		= &$date_end;
	}

	/**
	 * Return all days by period
	 *
	 * @return array
	 */
	function getAllDays() {
		$ret_array = array();
		if ($this->mBeginDate->before($this->mEndDate)) {
			$d = $this->getBegin();
			while ($d->before($this->getEnd())) {
				array_push($ret_array, $d);
				$d = $d->nextDate();
			}
			array_push($ret_array, $d);
		} else {
			array_push($ret_array, $this->mBeginDate);
		}
  		return $ret_array;
	}

	function setPeriod($b_date, $e_date) {
		$this->mBeginDate = $b_date;
		$this->mEndDate = $e_date;
	}

	// return date object
	function getBegin() {
		return $this->mBeginDate;
	}

	// return date object
	function getEnd() {
		return $this->mEndDate;
	}

	// return date string
	function getBeginDate($format="") {
		return $this->mBeginDate->toString($format);
	}

	// return date string
	function getEndDate($format="") {
		return $this->mEndDate->toString($format);
	}

	function getArray($format="") {
		$result = array();
		$d = $this->getBegin();
		while ($d->before($this->getEnd())) {
			$result[] = $d->toString($format);
			$d = $d->nextDate();
		}
		return $result;
	}
}
?>