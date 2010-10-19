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


  $style_tableHeader = 'color: #000000; font-weight: bold; background-color: #A6CCF7';
	$style_bgLiteSilver = 'background-color: #f7f7f7';

    $report_table_header	= "<table border='0' cellpadding='4' cellspacing='0' width='100%'>\n";
	$report_table_header2	= "<tr>\n<td style=\"$style_tableHeader\">";
	$report_table_header_glue = "</td>\n<td style=\"$style_tableHeader\">";
	$report_table_header3	= "</td></tr>\n";
	$report_table_body_glue	= "</td>\n<td%s>";
	$report_table_body	= "<tr%s>\n<td%s>%s</td>\n</tr>\n";
	$report_table_body2	= "<tr%s><td align='right' style='border-top: solid #e0e0e0 1Pt'>%s</td>\n<td style='border-top: solid #e0e0e0 1Pt' colspan = %s>no entry</td></tr>\n";
	$report_table_weekend	= " style=\"$style_bgLiteSilver\"";
	$report_table_ending	= "</table>\n<table border=0 class='mh'>\n<tr>\n<td align='left'><B>%s:</B></td>\n<td><B>%s</B></td>\n</tr>\n<tr>\n<td align='left'><B>%s:</B></td>\n<td><B>%s</B></td>\n</tr>\n<tr>\n<td align='left'><B>%s:</B></td><td><B>%s</B></td>\n</tr>\n</table>";
    $top_framed = ' style=\'border-top: solid #e0e0e0 1pt\'';
    $accum  = '';
    $accum .= $report_table_header;

    // header of table
    if ($total_only) {
    	$short_header = array();
    	foreach ($hkeys as $k=>$fn) {
    		if ($fn==$sort_key || $fn=='duration' ||
    			($bean->getAttribute("project") && $fn=='project') ||
    			($bean->getAttribute("activity") && $fn=='activity')) $short_header[] = $header[$k];
    	}
    	$accum .= $report_table_header2 . join($report_table_header_glue, $short_header). $report_table_header3;
    } else {
		$accum .= $report_table_header2 . join($report_table_header_glue, $header). $report_table_header3;
	}

foreach($rows as $id=>$val) {
	if($val['start']!="") {
		$len = strlen($val['start']);
		if($len==3)
			$rows[$id]['start'] = $val['start']{0}.":".$val['start']{1}.$val['start']{2};
		else
			$rows[$id]['start'] = $val['start']{0}.$val['start']{1}.":".$val['start']{2}.$val['start']{3};
	}


}

//echo TimeHelper::toMinutes("2:01")."<BR>";
//echo TimeHelper::normTimeString("121");
/*foreach($rows as $id=>$val) {
	if($val['start']!="")
		$temp[$val['date']][$id] = TimeHelper::toMinutes($val['start']);
	else
		$temp[$val['date']][$id] = "";
	if($val['start']!="")
		$isset_start_date[] = $val['date'];
}
echo "<PRE>";
print_r($temp);
echo "</PRE>";
$isset_start_date = array_unique($isset_start_date);
echo "<PRE>";
print_r($isset_start_date);
echo "</PRE>";
$out = array();
foreach($isset_start_date as $date) {
	$sort = $temp[$date];
	asort($sort);
	$out[$date] = $sort;
	unset($sort);

}
echo "<PRE>";
print_r($out);
echo "</PRE>";

foreach ($rows as $id=>$val) {
	if(in_array($val['date'], $isset_start_date)) {

	}
}*/

	// build table
	$prev_value = "";
	$prev_date = "";
	for( $i=0; $i<count($rows); $i++ ) {
		$row = $rows[$i];

		if(!$total_only) {
			// styles, weekend days
			$we_style = '';
			$cur_weekday = @$wdates[$row['date']];
			//echo date("m/d", strtotime($row['date']))."<BR>";
			if( (($cur_weekday == 0) || ($cur_weekday == 6)) OR in_array(date("m/d", strtotime($row['date'])), $i18n->cHolidays) ) {
				$we_style = $report_table_weekend;
			}

			// styles, type of separate line and type of cell
			if ($prev_value == $row['sortkey'] && $prev_date==$row['date']) {
				$line_style = '';
				$fmt_glue = sprintf($report_table_body_glue, ' ');
			}
			else {
				$line_style = $top_framed;
				$fmt_glue = sprintf($report_table_body_glue, $top_framed);
			}
			// all records
			$sep = "";
			$srow = "";
			foreach ($hkeys as $fn) {
				// cell's value
				$v = $row[$fn];
				if ($fn == 'date') { $v = @$clean_dates[$row[$fn]]; }
				if ($fn == 'user' && $v=='' && $sort_key=='user') $v = $row['sortkey'];
				if ($fn == 'project' && $v=='' && $sort_key=='project') $v = $row['sortkey'];
				if ($fn == 'activity' && $v=='' && $sort_key=='activity') $v = $row['sortkey'];
				if ($bean->getAttribute("chshowidle")) {
					if ($fn == 'note' && $v=='' && strlen($row['duration'])==0) $v = "no data";
					if ($fn == 'project' && $v=='' && $bean->getAttribute('project')) $v = $current_project_name;
					if ($fn == 'activity' && $v=='' && $bean->getAttribute('activity')) $v = $current_activity_name;
				}

				if (!$v) $v = '&nbsp;';

				if ($fn != 'date') {
					$srow .= $sep . $v;
				} else {
					// empty place for date
					$srow .= $sep . ($prev_date != $row['date'] ? $v : '&nbsp;');
				}
				$sep = $fmt_glue;
		  }
		  //if (!$total_only)
		  $accum .= sprintf($report_table_body, $we_style, $line_style, $srow);

		  $prev_value = $row['sortkey'];
		  $prev_date = $row['date'];
		}

		// subsummary block
		if((@$row['sortkey']!=@$rows[$i+1]['sortkey']) && (@$sort_key!='date')) {

			$sep = "";
			$srow = "";
			if ($total_only) { // "total only" flag
				foreach($hkeys as $k=>$fn) {
					if($fn==$sort_key) {
						$srow .= $sep . @$row['sortkey'];
						$sep = sprintf($report_table_body_glue, $top_framed);
					}
					if($fn=='duration') {
						$srow .= $sep . @$sub_summary[@$row['sortkey']];
						$sep = sprintf($report_table_body_glue, $top_framed);
					}
					if($bean->getAttribute("project") && $fn=='project' && $sort_key!='project') {
						$srow .= $sep . @$row['project'];
						$sep = sprintf($report_table_body_glue, $top_framed);
					}
					if ($bean->getAttribute("activity") && $fn=='activity' && $sort_key!='activity') {
						$srow .= $sep . @$row['activity'];
						$sep = sprintf($report_table_body_glue, $top_framed);
					}
				}
				$accum .= sprintf($report_table_body, '', $top_framed, $srow);
			}
			else { // the rest
				foreach ($hkeys as $fn) {
					switch ($fn) {
						case 'duration':
							$srow .= $sep . '<b>'.@$sub_summary[@$row['sortkey']].'</b>';
						break;
						case 'date':
							$srow .= $sep . '<b>subtotal: </b>';
						break;
						default:
							$srow .= $sep . '&nbsp;';
					}
					$sep = sprintf($report_table_body_glue, $top_framed);
				}
				$accum .= sprintf($report_table_body, '', $top_framed, $srow);
				$accum .= sprintf("<tr><td %s colspan=%d>&nbsp;</td></tr>", '', (count($fields)));
			}
			// reset date
			$prev_date = '';
		}
	}

	$accum .= sprintf("<tr><td %s colspan=%d>&nbsp;</td></tr>", $top_framed, (count($fields)));

// summary
    if ($total=="") $total = 0;
    $accum .= sprintf ($report_table_ending, $i18n->getKey("form.report.from"), $period->getBeginDate(),
    										$i18n->getKey("form.report.to"), $period->getEndDate(),
    										$i18n->getKey("form.report.total"), $total);

	/* ?>
	<style>
	.tableHeader { color: #000000; font-weight: bold; background-color: #A6CCF7}
	.bgLiteSilver {	background-color: #f7f7f7 }
	</style>
	<?php */
    print $accum;
?>