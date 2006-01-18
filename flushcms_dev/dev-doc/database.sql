-- MySQL dump 10.10
--
-- Host: localhost    Database: flushcms
-- ------------------------------------------------------
-- Server version	5.0.18-nt
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,MYSQL40' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `flushcms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `flushcms` /*!40100 DEFAULT CHARACTER SET gbk COLLATE gbk_bin */;

USE `flushcms`;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `GroupsID` int(6) NOT NULL,
  `GroupName` varchar(40) NOT NULL default '',
  `Descrition` varchar(50) NOT NULL default '',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`GroupsID`)
) TYPE=MyISAM COMMENT='User group';

--
-- Dumping data for table `groups`
--


/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
LOCK TABLES `groups` WRITE;
INSERT INTO `groups` VALUES (1,'admin','admin','2005-12-26 21:22:48','127.0.0.1'),(2,'user','user','2005-12-26 20:41:47','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

--
-- Table structure for table `site_config`
--

DROP TABLE IF EXISTS `site_config`;
CREATE TABLE `site_config` (
  `SiteConfigID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL default '0',
  `VersionCode` varchar(8) NOT NULL default '',
  `VarName` varchar(40) NOT NULL default '',
  `VarValue` varchar(255) NOT NULL default '',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`SiteConfigID`)
) TYPE=MyISAM COMMENT='site configure';

--
-- Dumping data for table `site_config`
--


/*!40000 ALTER TABLE `site_config` DISABLE KEYS */;
LOCK TABLES `site_config` WRITE;
INSERT INTO `site_config` VALUES (1,2,'en-us','SITE_NAME','FlushPHP Office Site','2006-01-18 13:04:07','127.0.0.1'),(2,2,'en-us','SITE_KEYWORD','shop;cms;php','2006-01-18 13:04:07','127.0.0.1'),(3,2,'en-us','SITE_COPYRIGHT','CopyRight(c) 2005-2006 FlushPHP Group','2006-01-18 13:04:07','127.0.0.1'),(4,2,'en-us','SITE_LOGO','Pic_43cb6189a797b.gif','2006-01-16 17:04:09','127.0.0.1'),(6,2,'en-us','SITE_QUICKLINK','<a href=\"http://developer.berlios.de\" title=\"BerliOS Developer\"> <img src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=\"124px\" height=\"32px\" border=\"0\" alt=\"BerliOS Developer Logo\"></a>','2006-01-18 13:05:45','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `site_config` ENABLE KEYS */;

--
-- Table structure for table `site_large_config`
--

DROP TABLE IF EXISTS `site_large_config`;
CREATE TABLE `site_large_config` (
  `SiteConfigID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL default '0',
  `VersionCode` varchar(8) NOT NULL default '',
  `VarName` varchar(40) NOT NULL default '',
  `VarValue` text,
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`SiteConfigID`)
) TYPE=MyISAM COMMENT='site configure';

--
-- Dumping data for table `site_large_config`
--


/*!40000 ALTER TABLE `site_large_config` DISABLE KEYS */;
LOCK TABLES `site_large_config` WRITE;
INSERT INTO `site_large_config` VALUES (1,2,'en-us','SITE_QUICKLINK','<a href=\"http://developer.berlios.de\" title=\"BerliOS Developer\"> <img src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=\"124px\" height=\"32px\" border=\"0\" alt=\"BerliOS Developer Logo\"></a>\r\n\r\n<a href=\"http://sourceforge.net/donate/index.php?group_id=154056\"><img src=\"http://images.sourceforge.net/images/project-support.jpg\" width=\"88\" height=\"32\" border=\"0\" alt=\"Support This Project\" /> </a>\r\n\r\n<a href=\"http://sourceforge.net\"><img src=\"http://sflogo.sourceforge.net/sflogo.php?group_id=154056&amp;type=2\" width=\"125\" height=\"37\" border=\"0\" alt=\"SourceForge.net Logo\" /></a>\r\n\r\n\r\n','2006-01-18 13:22:16','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `site_large_config` ENABLE KEYS */;

--
-- Table structure for table `site_menu`
--

DROP TABLE IF EXISTS `site_menu`;
CREATE TABLE `site_menu` (
  `SiteMenuID` int(11) NOT NULL,
  `PID` int(11) NOT NULL default '0',
  `UserID` int(11) NOT NULL default '0',
  `VersionCode` varchar(8) NOT NULL default '',
  `Title` varchar(200) NOT NULL default '',
  `URL` varchar(220) NOT NULL default '',
  `Module` varchar(60) NOT NULL default '',
  `Template` varchar(60) NOT NULL default '',
  `CreateTime` varchar(40) NOT NULL default '',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`SiteMenuID`)
) TYPE=MyISAM COMMENT='site menu';

--
-- Dumping data for table `site_menu`
--


/*!40000 ALTER TABLE `site_menu` DISABLE KEYS */;
LOCK TABLES `site_menu` WRITE;
INSERT INTO `site_menu` VALUES (1,0,2,'en-us','Home','','ModuleHome','simple.info.index','1137560652','127.0.0.1'),(2,0,2,'en-us','DownLoad','','ModuleNews','simple.info.index','1137474137','127.0.0.1'),(3,0,2,'en-us','Document','','ModuleNews','simple.info.index','1137474216','127.0.0.1'),(4,0,2,'en-us','Forum','','ModuleNews','simple.info.index','1137474162','127.0.0.1'),(5,0,2,'en-us','FAQ','','ModuleNews','simple.info.index','1137474168','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `site_menu` ENABLE KEYS */;

--
-- Table structure for table `ugroups`
--

DROP TABLE IF EXISTS `ugroups`;
CREATE TABLE `ugroups` (
  `UGroupsID` int(6) NOT NULL,
  `UsersID` int(11) NOT NULL default '0',
  `GroupsID` int(6) NOT NULL default '0',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`UGroupsID`)
) TYPE=MyISAM COMMENT='user group';

--
-- Dumping data for table `ugroups`
--


/*!40000 ALTER TABLE `ugroups` DISABLE KEYS */;
LOCK TABLES `ugroups` WRITE;
INSERT INTO `ugroups` VALUES (7,2,1,'2006-01-07 16:25:41','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `ugroups` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UsersID` int(11) NOT NULL,
  `UserName` varchar(40) NOT NULL default '',
  `Passwd` varchar(50) NOT NULL default '',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`UsersID`)
) TYPE=MyISAM COMMENT='user base info';

--
-- Dumping data for table `users`
--


/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (2,'admin','21232f297a57a5a743894a0e4a801fc3','2005-12-21 21:21:01','127.0.0.1'),(3,'etysafd','098f6bcd4621d373cade4e832627b4f6','2005-12-21 21:21:18','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

