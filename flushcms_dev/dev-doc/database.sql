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
INSERT INTO `site_config` VALUES (1,2,'en-us','SITE_NAME','FlushPHP Office Site','2006-01-19 12:59:15','127.0.0.1'),(2,2,'en-us','SITE_KEYWORD','shop;cms;php','2006-01-19 12:59:15','127.0.0.1'),(3,2,'en-us','SITE_COPYRIGHT','CopyRight(c) 2005-2006 FlushPHP Group','2006-01-19 12:59:15','127.0.0.1'),(4,2,'en-us','SITE_LOGO','Pic_43cb6189a797b.gif','2006-01-16 17:04:09','127.0.0.1'),(6,2,'en-us','SITE_QUICKLINK','<a href=\"http://developer.berlios.de\" title=\"BerliOS Developer\"> <img src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=\"124px\" height=\"32px\" border=\"0\" alt=\"BerliOS Developer Logo\"></a>','2006-01-18 13:05:45','127.0.0.1');
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
INSERT INTO `site_large_config` VALUES (1,2,'en-us','SITE_QUICKLINK','<A title=\"BerliOS Developer\" href=\"http://developer.berlios.de\"><IMG height=32 alt=\"BerliOS Developer Logo\" src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=124 border=0></A> <A href=\"http://sourceforge.net/donate/index.php?group_id=154056\"><IMG height=32 alt=\"Support This Project\" src=\"http://images.sourceforge.net/images/project-support.jpg\" width=88 border=0> </A><A href=\"http://sourceforge.net\"><IMG height=37 alt=\"SourceForge.net Logo\" src=\"http://sflogo.sourceforge.net/sflogo.php?group_id=154056&amp;type=2\" width=125 border=0></A> <STRONG>Get Smarty</STRONG> \r\n<P><A href=\"http://smarty.php.net/download.php\">Download!</A><BR><A href=\"http://smarty.php.net/contribs.php\">Contributed Code</A> </P><B>What is Smarty?</B> \r\n<P><A href=\"http://smarty.php.net/rightforme.php\">Is Smarty right for me?</A><BR><A href=\"http://smarty.php.net/whyuse.php\">Why use it?</A><BR><A href=\"http://smarty.php.net/crashcourse.php\">Crash Course</A><BR><A href=\"http://smarty.php.net/manual/en/preface.php\">Preface from docs</A><BR><A href=\"http://smarty.php.net/manual/en/what.is.smarty.php\">Summary from docs</A><BR><A href=\"http://www.phpinsider.com/smarty-forum/viewforum.php?f=12\">Testimonials</A> </P><B>Get Help!</B> \r\n<P><A href=\"http://smarty.php.net/quick_start.php\">Quick Install</A><BR><A href=\"http://smarty.php.net/docs.php\">Documentation</A><BR><A href=\"http://smarty.php.net/sampleapp/sampleapp_p1.php\">Sample Application</A><BR><A href=\"http://www.phpinsider.com/smarty-forum/\">Discussion Forums</A><BR><A href=\"irc://irc.freenode.net/smarty\">Internet Relay Chat</A><BR><A href=\"http://smarty.php.net/resources.php?category=7\">Mailing Lists</A><BR><A href=\"http://smarty.incutio.com/\">Smarty Wiki</A><BR><A href=\"http://smarty.incutio.com/?page=SmartyFrequentlyAskedQuestions\">FAQ (from wiki)</A><BR><A href=\"http://smarty.php.net/resources.php\">Other Resources</A> </P>\r\n<P><B>Vote for Smarty!</B> </P>\r\n<P>Feel free to put in your rating or review of Smarty at <A href=\"http://www.hotscripts.com/Detailed/8817.html\">HotScripts.com</A> </P>\r\n<P><B>Smarty Icon</B> </P>\r\n<P>You may only use the Smarty logo according to the <A href=\"http://smarty.php.net/copyright.php\">trademark notice</A> </P><IMG height=31 src=\"http://smarty.php.net/gifs/smarty_icon.gif\" width=88 border=0> <BR><BR><IMG height=15 src=\"http://smarty.php.net/gifs/smarty-80x15.png\" width=80 border=0> \r\n<P><B>Tell us about it!</B> </P>\r\n<P>Got some news for the front page? New articles, weblog discussions, public talks, etc? <A href=\"mailto:smarty-webmaster@php.net?subject=smarty+news\">Let us know!</A> </P>','2006-01-19 09:03:02','127.0.0.1');
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
INSERT INTO `site_menu` VALUES (1,0,2,'en-us','Home','','ModuleHome','simple.info.index','1137560652','127.0.0.1'),(2,0,2,'en-us','DownLoad','','ModuleNews','news.content','1137646802','127.0.0.1'),(3,0,2,'en-us','Document','','ModuleNews','simple.info.index','1137474216','127.0.0.1'),(4,0,2,'en-us','Forum','','ModuleNews','simple.info.index','1137474162','127.0.0.1'),(5,0,2,'en-us','FAQ','','ModuleNews','simple.info.index','1137474168','127.0.0.1'),(6,2,2,'en-us','FlushPHP','','ModuleNews','news.content','1137646784','127.0.0.1'),(7,2,2,'en-us','FlushCMS','','ModuleNews','news.content','1137646870','127.0.0.1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `site_menu` ENABLE KEYS */;

--
-- Table structure for table `site_news`
--

DROP TABLE IF EXISTS `site_news`;
CREATE TABLE `site_news` (
  `NewsID` int(11) unsigned NOT NULL,
  `SiteMenuID` int(8) NOT NULL,
  `VersionCode` varchar(8) binary NOT NULL,
  `Title` varchar(100) binary NOT NULL,
  `Summary` tinytext NOT NULL,
  `Content` mediumtext NOT NULL,
  `Source` varchar(100) binary NOT NULL,
  `Author` varchar(60) binary NOT NULL,
  `CreateTime` datetime NOT NULL,
  `AddIP` varchar(24) binary NOT NULL,
  PRIMARY KEY  (`NewsID`)
) TYPE=MyISAM COMMENT='site news module';

--
-- Dumping data for table `site_news`
--


/*!40000 ALTER TABLE `site_news` DISABLE KEYS */;
LOCK TABLES `site_news` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `site_news` ENABLE KEYS */;

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

