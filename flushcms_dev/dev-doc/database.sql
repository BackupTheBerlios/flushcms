-- MySQL dump 10.10
--
-- Host: localhost    Database: flushcms
-- ------------------------------------------------------
-- Server version	4.1.15-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `flushcms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `flushcms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `flushcms`;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `ID` int(6) NOT NULL auto_increment,
  `GroupName` varchar(40) NOT NULL default '',
  `Descrition` varchar(50) NOT NULL default '',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='User group';

--
-- Dumping data for table `group`
--


/*!40000 ALTER TABLE `group` DISABLE KEYS */;
LOCK TABLES `group` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `ID` int(2) unsigned NOT NULL auto_increment,
  `ModelName` varchar(40) NOT NULL default '',
  `Version` varchar(10) NOT NULL default '',
  `CreateTime` datetime NOT NULL default '0000-00-00 00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='model install list';

--
-- Dumping data for table `model`
--


/*!40000 ALTER TABLE `model` DISABLE KEYS */;
LOCK TABLES `model` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL auto_increment,
  `UserName` varchar(40) NOT NULL default '',
  `Passwd` varchar(50) NOT NULL default '',
  `CreateTime` time NOT NULL default '00:00:00',
  `AddIP` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='user base info';

--
-- Dumping data for table `users`
--


/*!40000 ALTER TABLE `users` DISABLE KEYS */;
LOCK TABLES `users` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

