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

require_once('WEB-INF/config.php');
require_once('WEB-INF/lib/common.lib.php');
if (!require_once('MDB2.php')) {
	die ("Unable to require MDB2 module. Please check it<br>\n");
}
require_once('initialize.php');
import('UserHelper');

function setChange($sql) {
	print "<pre>".$sql."</pre>";
	$mdb2 = getConnection();
	$affected = &$mdb2->exec($sql);
	if (PEAR::isError($affected) == 0) {
		print "successful update<br>\n";
	}
	else {
		print "error: ".$affected->getMessage()."<br>";
	}
}


  if ($_POST) {
  	print "proccess ...<br>\n";

  	if (@$_POST["crstructure"]) {
  		  $sqlQuery = join("\n", file("mysql.sql"));
  		  $sqlQuery = str_replace("TYPE=MyISAM","",$sqlQuery);
		  $queries  = split(";",$sqlQuery);
		  if (is_array($queries)) {
			  foreach ($queries as $query) {
				$query = trim($query);
				if (strlen($query)>0) {
					setChange($query);
				}
			  }
		  }
  	}

  	if (@$_POST["convert1to2"]) {
		// no db changes
  	}

  	if (@$_POST["convert2to3"]) {
	  setChange("alter table users add u_rate float(6,2) NOT NULL default '0.00'");
	  setChange("CREATE TABLE `invoice_header` (`ih_user_id` int(11) NOT NULL default '0', `ih_number` varchar(20) default NULL, `ih_addr_your` blob, `ih_addr_cust` blob, `ih_comment` varchar(255) default NULL, `ih_tax` float(9,2) default '0.00', PRIMARY KEY  (`ih_user_id`))");
	  setChange("alter table activities add a_project_id int NOT NULL default 0");
	  setChange("alter table companies add c_currency char(7) NULL");
  	}

  	if (@$_POST["convert3to4"]) {
  	  setChange("ALTER TABLE `activity_log` add `al_proof` int(11) default NULL");
	  setChange("ALTER TABLE `activity_log` add `al_charge` tinyint(4) NOT NULL default '1'");
	  setChange("CREATE TABLE `tmp_refs` (`tr_created` timestamp(4) NOT NULL,`tr_code` char(32) NOT NULL default '', `tr_userid` int(11) NOT NULL default '0')");
	  setChange("alter table users add `u_comanager` tinyint(4) default NULL");
	  setChange("DELETE from `users` WHERE u_login='admin'");
	  setChange("INSERT INTO `users` (`u_timestamp`, `u_login`, `u_password`, `u_name`, `u_company_id`, `u_manager_id`, `u_level`, `u_active`, `u_rate`, `u_comanager`) VALUES ('20051226031237','admin','428567f408994404','Admin',null,null,'0','1','0.00',null)");
	  //setChange("alter table users add `u_aprojects` varchar(255) default NULL");
  	}

  	if (@$_POST["convert4to5"]) {
  	  setChange("CREATE TABLE `activity_bind` (`ab_id` int(11) unsigned NOT NULL auto_increment, `ab_id_a` int(11) unsigned NOT NULL default '0', `ab_id_p` int(11) unsigned NOT NULL default '0', PRIMARY KEY  (`ab_id`), UNIQUE KEY `ab_id` (`ab_id`) )");
  	  setChange("ALTER table invoice_header add ih_fsubtotals char(1) default '0'");
  	  setChange("ALTER table invoice_header add ih_discount float(9,2) default 0");
  	  setChange("CREATE TABLE `user_bind` (`ub_id` int(4) unsigned NOT NULL auto_increment,`ub_id_u` int(11) unsigned NOT NULL default '0',`ub_id_p` int(11) unsigned NOT NULL default '0',`ub_rate` float(6,2) NOT NULL default '0.00',`ub_checked` tinyint(4) NOT NULL default '0', PRIMARY KEY  (`ub_id`),UNIQUE KEY `ub_id` (`ub_id`))");
  	  setChange("CREATE TABLE `report_filter_set` (`rfs_id` int(11) unsigned NOT NULL auto_increment,`rfs_id_u` int(11) NOT NULL default '0',`rfs_name` varchar(200) NOT NULL default '',`rfs_id_p` int(11) default NULL,`rfs_id_a` int(11) default NULL,`rfs_users` varchar(250) default NULL,`rfs_period` varchar(20) default NULL,`rfs_period_start` date default NULL,`rfs_period_finish` date default NULL,`rfs_cb_project` tinyint(4) NOT NULL default '0',`rfs_cb_activity` tinyint(4) NOT NULL default '0',`rfs_cb_note` tinyint(4) NOT NULL default '0',`rfs_cb_start` tinyint(4) NOT NULL default '0',`rfs_cb_finish` tinyint(4) NOT NULL default '0',`rfs_cb_duration` tinyint(4) NOT NULL default '0',`rfs_cb_idle` tinyint(4) NOT NULL default '0',`rfs_cb_totals_only` tinyint(4) NOT NULL default '0',`rfs_groupby` varchar(20) default NULL, PRIMARY KEY  (`rfs_id`), UNIQUE KEY `rfs_id` (`rfs_id`))");
  	  setChange("CREATE TABLE `clients` (`clnt_id` int(11) NOT NULL default '0',`clnt_id_um` int(11) NOT NULL default '0',`clnt_name` varchar(255) NOT NULL default '',`clnt_addr_your` blob,`clnt_addr_cust` blob,`clnt_comment` varchar(255) default NULL,`clnt_tax` float(9,2) NOT NULL default '0.00',`clnt_fsubtotals` char(1) default NULL,`clnt_discount` float(9,2) NOT NULL default '0.00',`clnt_status` smallint(6) NOT NULL default '1', PRIMARY KEY  (`clnt_id`), UNIQUE KEY `clnt_id` (`clnt_id`))");
  	}

  	if (@$_POST["admin_pass"]) {
  		if ($_POST["newpass"]) {
  			setChange("update users set u_password = md5('".str_replace("\"","\\\"",$_POST["newpass"])."') where u_login='admin'");
  		}
  	}

  	if (@$_POST["convert_pass"]) {
	  setChange("update users set u_password = md5(u_password)");
  	}
  	
  	if (@$_POST["convert5to6"]) {
	  setChange("alter table `activity_log` CHANGE al_comment al_comment BLOB");
	  setChange("CREATE TABLE `sysconfig` (`sysc_id` int(11) unsigned NOT NULL auto_increment,`sysc_name` varchar(32) NOT NULL default '',`sysc_value` varchar(70) default NULL, PRIMARY KEY  (`sysc_id`), UNIQUE KEY `sysc_id` (`sysc_id`), UNIQUE KEY `sysc_name` (`sysc_name`))");
	  setChange("alter table `companies` add c_locktime int(4) default -1");
	  setChange("alter table `activity_log` add al_billable tinyint(4) default 0");
	  setChange("alter table `sysconfig` drop INDEX `sysc_name`");
	  setChange("alter table `sysconfig` add sysc_id_u int(4)");
	  setChange("alter table `report_filter_set` add rfs_billable VARCHAR(10)");
  	}

	if (@$_POST["convert6to7"]) {
		setChange("ALTER TABLE clients MODIFY clnt_id int(11) NOT NULL AUTO_INCREMENT");
		setChange("ALTER TABLE `users` ADD `u_show_pie` smallint(2) DEFAULT '1'");
		setChange("alter table `users` ADD `u_pie_mode` smallint(2) DEFAULT '1'");
		setChange("alter table users drop `u_aprojects`");
  	}

  if (@$_POST["convert8to9"]) {
		setChange("ALTER TABLE users ADD COLUMN u_lang VARCHAR(20) NULL");
  }

  if (@$_POST["convert9to106"]) {
    setChange("ALTER TABLE users ADD COLUMN u_email VARCHAR(100) NULL");
  }

  if (@$_POST["convert106to1218"]) {
    setChange("ALTER TABLE `activity_log` drop `al_proof`");
    setChange("ALTER TABLE `activity_log` drop `al_charge`");
  }

  if (@$_POST["convert1218to1238"]) {
    setChange("ALTER TABLE `activities` drop `a_project_id`");
  }

  if (@$_POST["convert1238to1240"]) {
    setChange("DROP TABLE `activity_status_list`");
    setChange("DROP TABLE `project_status_list`");
    setChange("DROP TABLE `user_status_list`");
  }
  
  if (@$_POST["cleanup"]) {
  	
  	$inactive_teams = UserHelper::findInactiveTeams();
  	$count = count($inactive_teams);
    print "$count inactive teams found...<br>\n";
    for ($i = 0; $i < $count; $i++) {
      print "  deleting team for manager id ".$inactive_teams[$i]."<br>\n";    	
      $res = UserHelper::deleteInactiveTeam($inactive_teams[$i]);
    }
    
    setChange("OPTIMIZE TABLE activities");
    setChange("OPTIMIZE TABLE activity_bind");
    setChange("OPTIMIZE TABLE activity_log");
    setChange("OPTIMIZE TABLE clients");
    setChange("OPTIMIZE TABLE companies");
    setChange("OPTIMIZE TABLE invoice_header");
    setChange("OPTIMIZE TABLE projects");
    setChange("OPTIMIZE TABLE report_filter_set");
    setChange("OPTIMIZE TABLE sysconfig");
    setChange("OPTIMIZE TABLE user_bind");
    setChange("OPTIMIZE TABLE users");
  }
  
  	print "done.<br>\n";
  }
?>
<html>
<body>
<div align="center">
<form method="POST">
<h2>DB Install</h2>
<table width="80%" border="1" cellpadding="10" cellspacing="0">
<tr>
	<td width="80%"><b>Create database structure (v1.2.18)</b></td><td><input type="submit" name="crstructure" value="Create"></td>
</tr>
</table>

<h2>Updates</h2>

<table width="80%" border="1" cellpadding="10" cellspacing="0">
<tr>
	<td>Update database structure (v0.2 to v0.3)</td><td><input type="submit" name="convert2to3" value="Update"></td>
</tr>
<tr>
	<td>Update database structure (v0.3 to v0.4)</td><td><input type="submit" name="convert3to4" value="Update"><br><input type="submit" name="convert_pass" value="Convert passwords"></td>
</tr>
<tr>
	<td>Update database structure (v0.4 to v0.5)</td><td><input type="submit" name="convert4to5" value="Update"></td>
</tr>
<tr>
	<td>Change password of administrator account (only >=v0.4)</td><td><input type="text" name="newpass" size="10"><input type="submit" name="admin_pass" value="Save"></td>
</tr>
<tr valign="top">
	<td>Update database structure (v0.5 to v0.6)</td><td><input type="submit" name="convert5to6" value="Update"></td>
</tr>
<tr valign="top">
	<td>Update database structure (v0.6 to v0.7) <FONT COLOR="#FF0000">[for php/mysql - 5.*; apache - 2.*]</FONT></td><td><input type="submit" name="convert6to7" value="Update"></td>
</tr>
<tr valign="top">
	<td>Update database structure (v0.8 to v0.9)</td>
	<td><input type="submit" name="convert8to9" value="Update"></td>
</tr>
<tr valign="top">
  <td>Update database structure (v0.9 to v1.0.6)</td>
  <td><input type="submit" name="convert9to106" value="Update"></td>
</tr>
<tr valign="top">
  <td>Update database structure (v1.0.6 to v1.2.18)</td>
  <td><input type="submit" name="convert106to1218" value="Update"></td>
</tr>
<tr valign="top">
  <td>Update database structure (v1.2.18 to v1.2.38)</td>
  <td><input type="submit" name="convert1218to1238" value="Update"></td>
</tr>
<tr valign="top">
  <td>Update database structure (v1.2.38 to v1.2.40)</td>
  <td><input type="submit" name="convert1238to1240" value="Update"></td>
</tr>
</table>

<h2>DB Maintenance</h2>
<table width="80%" border="1" cellpadding="10" cellspacing="0">
<tr>
	<td width="80%">Clean up DB from inactive teams</td><td><input type="submit" name="cleanup" value="Clean up"></td>
</tr>
</table>

</form>
<a href="/">Go to site</a>
</div>
</body>
</html>