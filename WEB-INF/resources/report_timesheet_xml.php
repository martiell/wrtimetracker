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

foreach($rows as $id=>$val) {
	if($val['start']!="") {
		$len = strlen($val['start']);
		if($len==3)
			$rows[$id]['start'] = $val['start']{0}.":".$val['start']{1}.$val['start']{2};
		else
			$rows[$id]['start'] = $val['start']{0}.$val['start']{1}.":".$val['start']{2}.$val['start']{3};
	}
}

	print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    print "<rows>\n";
    
    if ($total_only) {
    	if (is_array($sub_summary) && !isset($sub_summary['common'])) {
	    	foreach ($sub_summary as $v=>$sv) {
				$v = str_replace('"','""',$v);
				if ($v=='')	$v = '"'.$v.'"';
				print "<row>\n";
				print "\t<".$sort_key.">".$v."</".$sort_key.">\n";
				print "\t<duration>".$sv."</duration>\n";
				print "</row>\n";
	    	}
    	}
    } else {
    	$prev_value = "";
    	$prev_date = "";
    
	    for ( $i=0; $i<count($rows); $i++ ) {
	      $row = $rows[$i];
	      
	      print "<row>\n";
	
	      foreach ($hkeys as $fn) {
	        $v = $row[$fn];
	        //$v = str_replace('"','""',$v);
			

			if ($fn == 'date') {
				//$v = date(EXPORT_TIMEFORMAT, strtotime(@$clean_dates[$row[$fn]]));
				$v = @$clean_dates[$row[$fn]];
			}
	        if ($fn == 'user' && $v=='' && $sort_key=='user') $v = $row['sortkey'];
			if ($fn == 'project') {
				if ($v=='' && $sort_key=='project') $v = $row['sortkey'];
				//$v = '"'.$v.'"';
			}
			if ($fn == 'activity') {
				if ($v=='' && $sort_key=='activity') $v = $row['sortkey'];
				//$v = '"'.$v.'"';
			}
			if ($bean->getAttribute('showidle')) {
				if ($fn == 'note' && $v=='' && strlen($row['duration'])==0) $v = "no data";
				if ($fn == 'project' && $v=='' && $bean->getAttribute('project')) $v = $current_project_name;
				if ($fn == 'activity' && $v=='' && $bean->getAttribute('activity')) $v = $current_activity_name;
			}
			//if ($fn == 'user' && $v=='') $v = "no entry";
			if (!(strpos($v, ",")===false)) $v = '"'.$v.'"';
			
			if(EXPORT_TIMEFORMAT=="." AND $fn == 'duration') {
				$v = time_to_decimal($v);
			}
			
			print "<".$fn."><![CDATA[".$v."]]></".$fn.">\n";
		  }
		  
		  $prev_value = $row['sortkey'];
		  $prev_date = $row['date'];
		  print "</row>\n";
	    }
    }
    print "</rows>";

?>