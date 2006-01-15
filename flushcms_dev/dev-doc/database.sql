-- MySQL dump 9.07
--
-- Host: localhost    Database: flushcms
---------------------------------------------------------
-- Server version	4.0.5-beta-max-nt-log

--
-- Current Database: flushcms
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ flushcms;

USE flushcms;

--
-- Table structure for table 'groups'
--

CREATE TABLE groups (
  GroupsID int(6) NOT NULL auto_increment,
  GroupName varchar(40) NOT NULL default '',
  Descrition varchar(50) NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (GroupsID)
) TYPE=MyISAM COMMENT='User group';

--
-- Dumping data for table 'groups'
--

INSERT INTO groups VALUES (1,'admin','admin','2005-12-26 21:22:48','127.0.0.1');
INSERT INTO groups VALUES (2,'user','user','2005-12-26 20:41:47','127.0.0.1');

--
-- Table structure for table 'modules'
--

CREATE TABLE modules (
  ModulesID int(2) unsigned NOT NULL auto_increment,
  ModelName varchar(40) NOT NULL default '',
  Version varchar(10) NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (ModulesID)
) TYPE=MyISAM COMMENT='Module install list';

--
-- Dumping data for table 'modules'
--


--
-- Table structure for table 'site_config'
--

CREATE TABLE site_config (
  SiteConfigID int(11) NOT NULL auto_increment,
  UserID int(11) NOT NULL default '0',
  VersionCode varchar(8) NOT NULL default '',
  VarName varchar(40) NOT NULL default '',
  VarValue varchar(255) NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (SiteConfigID)
) TYPE=MyISAM COMMENT='site configure';

--
-- Dumping data for table 'site_config'
--

INSERT INTO site_config VALUES (1,2,'en-us','SITE_NAME','FlushPHP Office','2006-01-15 17:22:38','127.0.0.1');
INSERT INTO site_config VALUES (2,2,'en-us','SITE_KEYWORD','shop;cms;php','2006-01-15 17:22:38','127.0.0.1');
INSERT INTO site_config VALUES (3,2,'en-us','SITE_COPYRIGHT','CopyRight(c) 2005-2006 FlushPHP Group','2006-01-15 17:22:38','127.0.0.1');
INSERT INTO site_config VALUES (4,2,'en-us','SITE_LOGO','Pic_43bf91eae27af.gif','2006-01-07 18:03:22','127.0.0.1');

--
-- Table structure for table 'site_menu'
--

CREATE TABLE site_menu (
  SiteMenuID int(11) NOT NULL auto_increment,
  PID int(11) NOT NULL default '0',
  UserID int(11) NOT NULL default '0',
  VersionCode varchar(8) NOT NULL default '',
  Title varchar(200) NOT NULL default '',
  URL varchar(220) NOT NULL default '',
  Module varchar(60) NOT NULL default '',
  Template varchar(60) NOT NULL default '',
  CreateTime varchar(40) NOT NULL default '',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (SiteMenuID)
) TYPE=MyISAM COMMENT='site menu';

--
-- Dumping data for table 'site_menu'
--

INSERT INTO site_menu VALUES (1,0,2,'en-us','Home','','ModuleHome','simple.info.index','1137311187','127.0.0.1');
INSERT INTO site_menu VALUES (2,0,2,'en-us','DownLoad','','ModuleNews','simple.info.index','1137311574','127.0.0.1');
INSERT INTO site_menu VALUES (3,2,2,'en-us','Document','','ModuleNews','simple.info.index','1137311580','127.0.0.1');
INSERT INTO site_menu VALUES (4,0,2,'en-us','Forum','','ModuleNews','simple.info.index','1137311583','127.0.0.1');
INSERT INTO site_menu VALUES (5,0,2,'en-us','FAQ','','ModuleNews','simple.info.index','1137311586','127.0.0.1');

--
-- Table structure for table 'ugroups'
--

CREATE TABLE ugroups (
  UGroupsID int(6) NOT NULL auto_increment,
  UsersID int(11) NOT NULL default '0',
  GroupsID int(6) NOT NULL default '0',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (UGroupsID)
) TYPE=MyISAM COMMENT='user group';

--
-- Dumping data for table 'ugroups'
--

INSERT INTO ugroups VALUES (7,2,1,'2006-01-07 16:25:41','127.0.0.1');

--
-- Table structure for table 'users'
--

CREATE TABLE users (
  UsersID int(11) NOT NULL auto_increment,
  UserName varchar(40) NOT NULL default '',
  Passwd varchar(50) NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (UsersID)
) TYPE=MyISAM COMMENT='user base info';

--
-- Dumping data for table 'users'
--

INSERT INTO users VALUES (2,'admin','21232f297a57a5a743894a0e4a801fc3','2005-12-21 21:21:01','127.0.0.1');
INSERT INTO users VALUES (3,'etysafd','098f6bcd4621d373cade4e832627b4f6','2005-12-21 21:21:18','127.0.0.1');

