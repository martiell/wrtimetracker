<?php
	$all1 = array();
	$all2 = array();

	/*$coral = file("coral.txt");
	foreach ($coral as $str) {
		if (strlen($str)>5) {
			$all2[] = split("\t", $str);
		}
	}*/
	
	$coral = file("stat.txt");
	foreach ($coral as $str) {
		if (strlen($str)>5) {
			$all2[] = split("\t", $str);
		}
	}
	
	$coral = file("st.txt");
	foreach ($coral as $str) {
		if (strlen($str)>5) {
			$all1[] = split("\t", $str);
		}
	}
	
	/*$coral = file("autogen.log");
	foreach ($coral as $str) {
		if (strlen($str)>5) {
			$all1[] = split(";", $str);
		}
	}*/
	
	
	
	$fd = false;
	foreach ($all1 as $a1) {
		foreach ($all2 as $a2) {
			$a1[0] = trim($a1[0]);
			$a2[0] = trim($a2[4]);
			//print trim($a1[0])."==".trim($a2[0])."\n";
			//if (strcmp(trim($a1[0]), trim($a2[0]))>0 ) {
			if ((int)$a1[0]==(int)$a2[0]) {
				//print "--\n";
				print "UPDATE USR set USR_PASSWORD='".$a2[5]."' WHERE USR_LOGIN='".$a2[4]."';<br>\n";
				break;
			}
		}
	}
	
?>