-- MySQL dump 9.11
--
-- Host: localhost    Database: flushcms
-- ------------------------------------------------------
-- Server version	4.0.26-nt

--
-- Current Database: flushcms
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ flushcms;

USE flushcms;

--
-- Table structure for table `groups`
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
-- Dumping data for table `groups`
--

INSERT INTO groups VALUES (1,'Admin','Admin','2005-12-28 08:44:38','127.0.0.1');
INSERT INTO groups VALUES (2,'user','user','2005-12-28 09:41:54','127.0.0.1');

--
-- Table structure for table `modules`
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
-- Dumping data for table `modules`
--


--
-- Table structure for table `sysmenu`
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
-- Dumping data for table `sysmenu`
--

INSERT INTO sysmenu VALUES (1,0,'test1','test1','2005-12-20 17:00:44','127.0.0.1');
INSERT INTO sysmenu VALUES (2,0,'test2','test2','2005-12-20 17:01:01','127.0.0.1');
INSERT INTO sysmenu VALUES (3,1,'test11','test11','2005-12-20 17:01:15','127.0.0.1');
INSERT INTO sysmenu VALUES (4,2,'test111','test111','2005-12-20 17:01:26','127.0.0.1');
INSERT INTO sysmenu VALUES (5,3,'test112','test112','2005-12-20 17:31:46','127.0.0.1');
INSERT INTO sysmenu VALUES (6,5,'test1121','test1121','2005-12-20 17:32:07','127.0.0.1');

--
-- Table structure for table `ugroups`
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
-- Dumping data for table `ugroups`
--


--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO users VALUES (8,'gsafds','098f6bcd4621d373cade4e832627b4f6','2005-12-23 12:56:36','127.0.0.1');
INSERT INTO users VALUES (9,'gasdfdsaf','098f6bcd4621d373cade4e832627b4f6','2005-12-23 12:56:44','127.0.0.1');

