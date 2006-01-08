-- MySQL dump 9.07
--
-- Host: localhost    Database: flushcms
---------------------------------------------------------
-- Server version	4.0.5-beta-max-nt

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

INSERT INTO site_config VALUES (1,2,'en-us','SITE_NAME','FlushPHP Office','2006-01-08 12:45:48','127.0.0.1');
INSERT INTO site_config VALUES (2,2,'en-us','SITE_KEYWORD','shop;cms;php','2006-01-08 12:45:48','127.0.0.1');
INSERT INTO site_config VALUES (3,2,'en-us','SITE_COPYRIGHT','CopyRight(c) 2005-2006 FlushPHP Group','2006-01-08 12:45:48','127.0.0.1');
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
  CreateTime varchar(40) NOT NULL default '',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (SiteMenuID)
) TYPE=MyISAM COMMENT='site menu';

--
-- Dumping data for table 'site_menu'
--


--
-- Table structure for table 'sysmenu'
--

CREATE TABLE sysmenu (
  SysmenuID int(11) NOT NULL auto_increment,
  PID int(6) NOT NULL default '0',
  Title varchar(50) NOT NULL default '',
  URL varchar(50) NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (SysmenuID)
) TYPE=MyISAM COMMENT='System menu';

--
-- Dumping data for table 'sysmenu'
--

INSERT INTO sysmenu VALUES (1,0,'test1','test1','2005-12-20 22:52:06','127.0.0.1');
INSERT INTO sysmenu VALUES (2,0,'test2','test2','2005-12-20 22:52:19','127.0.0.1');
INSERT INTO sysmenu VALUES (3,1,'test11','test11','2005-12-20 22:52:26','127.0.0.1');
INSERT INTO sysmenu VALUES (4,3,'test111','test111','2005-12-20 22:52:36','127.0.0.1');
INSERT INTO sysmenu VALUES (5,4,'test1111','test1111','2005-12-20 22:52:47','127.0.0.1');
INSERT INTO sysmenu VALUES (6,2,'test21','test21','2005-12-20 22:52:59','127.0.0.1');
INSERT INTO sysmenu VALUES (7,6,'test211','test211','2005-12-20 22:53:08','127.0.0.1');
INSERT INTO sysmenu VALUES (8,7,'test2111','test2111','2005-12-20 22:53:18','127.0.0.1');
INSERT INTO sysmenu VALUES (9,4,'test112','test112','2005-12-20 22:53:35','127.0.0.1');
INSERT INTO sysmenu VALUES (10,3,'test122','test122','2005-12-20 22:53:55','127.0.0.1');
INSERT INTO sysmenu VALUES (11,6,'test223','test223','2005-12-20 22:54:21','127.0.0.1');

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

