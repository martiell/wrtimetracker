# Usage: 
# 1) Create a database using the "CREATE DATABASE" mysql command.
# 2) Then, execute this script from command prompt with a command this:
# mysql -h host -u user -p -D db_name < mysql.sql

# create database wrtts character set = 'utf8';

# use wrtts;

#
# Structure for table activities :
#

CREATE TABLE `activities` (
  `a_id` int(11) NOT NULL auto_increment,
  `a_timestamp` timestamp(14) NOT NULL,
  `a_name` varchar(200) default NULL,
  `a_manager_id` int(11) NOT NULL default '0',
  `a_status` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`a_id`),
  KEY `a_manager_idx` (`a_manager_id`,`a_status`)
);

#
# Structure for table activity_log :
#

CREATE TABLE `activity_log` (
  `al_timestamp` timestamp(14) NOT NULL,
  `al_user_id` int(11) NOT NULL default '0',
  `al_date` date default NULL,
  `al_from` time default NULL,
  `al_duration` time default NULL,
  `al_project_id` int(11) NOT NULL default '0',
  `al_activity_id` int(11) NOT NULL default '0',
  `al_comment` BLOB,
  `al_billable` tinyint(4) default '0',
  PRIMARY KEY  (`al_timestamp`,`al_user_id`),
  KEY `al_date_idx` (`al_date`),
  KEY `al_user_id_idx` (`al_user_id`),
  KEY `al_project_id_idx` (`al_project_id`),
  KEY `al_activity_id_idx` (`al_activity_id`)
);

#
# Structure for table companies :
#

CREATE TABLE `companies` (
  `c_id` int(11) NOT NULL auto_increment,
  `c_name` varchar(200) NOT NULL default '',
  `c_www` varchar(250) default NULL,
  `c_currency` varchar(7) default NULL,
  `c_locktime` int(4) default '-1',
  PRIMARY KEY  (`c_id`)
);

#
# Structure for table companies_c_id_seq :
#

CREATE TABLE `companies_c_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
);

#
# Structure for table invoice_header :
#

CREATE TABLE `invoice_header` (
  `ih_user_id` int(11) NOT NULL default '0',
  `ih_number` varchar(20) default NULL,
  `ih_addr_your` blob,
  `ih_addr_cust` blob,
  `ih_comment` varchar(255) default NULL,
  `ih_tax` float(9,2) default '0.00',
  `ih_fsubtotals` char(1) default '0',
  `ih_discount` float(9,2) default 0,
  PRIMARY KEY  (`ih_user_id`)
);

#
# Structure for table projects :
#

CREATE TABLE `projects` (
  `p_id` int(11) NOT NULL auto_increment,
  `p_timestamp` timestamp(14) NOT NULL,
  `p_name` varchar(200) default NULL,
  `p_manager_id` int(11) NOT NULL default '0',
  `p_status` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`p_id`),
  KEY `p_manager_idx` (`p_manager_id`,`p_status`)
);


#
# Structure for table tmp_refs :
#

CREATE TABLE `tmp_refs` (
  `tr_created` timestamp(4) NOT NULL,
  `tr_code` char(32) NOT NULL default '',
  `tr_userid` int(11) NOT NULL default '0'
);

#
# Structure for table users :
#

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL auto_increment,
  `u_timestamp` timestamp(14) NOT NULL,
  `u_login` varchar(100) default NULL,
  `u_password` varchar(50) default NULL,
  `u_name` varchar(100) default NULL,
  `u_company_id` int(11) default NULL,
  `u_manager_id` int(11) default NULL,
  `u_level` tinyint(4) NOT NULL default '0',
  `u_active` smallint(6) NOT NULL default '1',
  `u_rate` float(6,2) NOT NULL default '0.00',
  `u_comanager` tinyint(4) default NULL,
  `u_show_pie` smallint(2) DEFAULT '1',
  `u_pie_mode` smallint(2) DEFAULT '1',
  `u_lang` varchar(20) default NULL,
  `u_email` varchar(100) default NULL,
  PRIMARY KEY  (`u_id`),
  KEY `u_login_idx` (`u_login`,`u_active`)
);

# Password 'secret'
DELETE from `users` WHERE u_login='admin';
INSERT INTO `users` (`u_timestamp`, `u_login`, `u_password`, `u_name`, `u_company_id`, `u_manager_id`, `u_level`, `u_active`, `u_rate`, `u_comanager`) VALUES ('20051226031237','admin',md5('secret'),'Admin',null,null,'0','1','0.00',null);

#
# Structure for table activity_bind:
#
CREATE TABLE `activity_bind` (
	`ab_id` int(11) unsigned NOT NULL auto_increment,
	`ab_id_a` int(11) unsigned NOT NULL default '0',
	`ab_id_p` int(11) unsigned NOT NULL default '0',
	PRIMARY KEY  (`ab_id`)
);

#
# Structure for table user_bind:
#
CREATE TABLE `user_bind` (
	`ub_id` int(4) unsigned NOT NULL auto_increment,
	`ub_id_u` int(11) unsigned NOT NULL default '0',
	`ub_id_p` int(11) unsigned NOT NULL default '0',
	`ub_rate` float(6,2) NOT NULL default '0.00',
	`ub_checked` TINYINT not null default '0',
	PRIMARY KEY  (`ub_id`)
);

# This index is needed to improve performance.
ALTER TABLE `user_bind` ADD INDEX(ub_id_u, ub_id_p);

#
# Structure for table report_filter_set:
#
CREATE TABLE `report_filter_set` (
	`rfs_id` int(11) unsigned NOT NULL auto_increment,
	`rfs_id_u` int(11) NOT NULL default '0',
	`rfs_name` varchar(200) NOT NULL default '',
	`rfs_id_p` int(11) default NULL,
	`rfs_id_a` int(11) default NULL,
	`rfs_users` varchar(250) default NULL,
	`rfs_period` varchar(20) default NULL,
	`rfs_period_start` date default NULL,
	`rfs_period_finish` date default NULL,
	`rfs_cb_project` tinyint(4) NOT NULL default '0',
	`rfs_cb_activity` tinyint(4) NOT NULL default '0',
	`rfs_cb_note` tinyint(4) NOT NULL default '0',
	`rfs_cb_start` tinyint(4) NOT NULL default '0',
	`rfs_cb_finish` tinyint(4) NOT NULL default '0',
	`rfs_cb_duration` tinyint(4) NOT NULL default '0',
	`rfs_cb_idle` tinyint(4) NOT NULL default '0',
	`rfs_cb_totals_only` tinyint(4) NOT NULL default '0',
	`rfs_groupby` varchar(20) default NULL,
	`rfs_billable` VARCHAR(10),
	PRIMARY KEY  (`rfs_id`)
);

#
# Structure for table clients:
#
CREATE TABLE `clients` (
	`clnt_id` int(11) NOT NULL AUTO_INCREMENT,
	`clnt_id_um` int(11) NOT NULL default '0',
	`clnt_name` varchar(255) NOT NULL default '',
	`clnt_addr_your` blob,
	`clnt_addr_cust` blob,
	`clnt_comment` varchar(255) default NULL,
	`clnt_tax` float(9,2) NOT NULL default '0.00',
	`clnt_fsubtotals` char(1) default NULL,
	`clnt_discount` float(9,2) NOT NULL default '0.00',
	`clnt_status` smallint(6) NOT NULL default '1',
	PRIMARY KEY  (`clnt_id`)
);


CREATE TABLE `sysconfig` (
	`sysc_id` int(11) unsigned NOT NULL auto_increment,
	`sysc_name` varchar(32) NOT NULL default '',
	`sysc_value` varchar(70) default NULL,
	`sysc_id_u` int(4),
	PRIMARY KEY  (`sysc_id`)
);
