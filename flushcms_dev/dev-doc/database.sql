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

INSERT INTO site_config VALUES (1,2,'en-us','SITE_NAME','FlushPHP Office Site','2006-01-21 16:40:39','127.0.0.1');
INSERT INTO site_config VALUES (2,2,'en-us','SITE_KEYWORD','shop;cms;php','2006-01-21 16:40:39','127.0.0.1');
INSERT INTO site_config VALUES (3,2,'en-us','SITE_COPYRIGHT','CopyRight(c) 2005-2006 FlushPHP Group','2006-01-21 16:40:39','127.0.0.1');
INSERT INTO site_config VALUES (4,2,'en-us','SITE_LOGO','Pic_43cb6189a797b.gif','2006-01-16 17:04:09','127.0.0.1');
INSERT INTO site_config VALUES (6,2,'en-us','SITE_QUICKLINK','<a href=\"http://developer.berlios.de\" title=\"BerliOS Developer\"> <img src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=\"124px\" height=\"32px\" border=\"0\" alt=\"BerliOS Developer Logo\"></a>','2006-01-18 13:05:45','127.0.0.1');

--
-- Table structure for table 'site_content'
--

CREATE TABLE site_content (
  ContentID int(11) unsigned NOT NULL auto_increment,
  SiteMenuID int(8) NOT NULL default '0',
  VersionCode varchar(8) NOT NULL default '',
  Content mediumtext NOT NULL,
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (ContentID)
) TYPE=MyISAM COMMENT='site content module';

--
-- Dumping data for table 'site_content'
--

INSERT INTO site_content VALUES (1,5,'en-us','<PRE>Windows users may want to follow <A href=\"http://news.php.net/php.smarty.dev/2703\"><U><FONT color=#0000ff>this install guide</FONT></U></A><BR><BR>This is a simple guide to get Smarty setup and running quickly. The online\r\ndocumentation includes a very thorough explanation of a Smarty installation.\r\nThis guide is meant to be a quick and painless way of getting Smarty working,\r\nand nothing more. The guide assumes you are familiar with the UNIX system\r\nenvironment. Windows users will need to make adjustments where necessary.\r\n\r\nINSTALL SMARTY LIBRARY FILES\r\n\r\nCopy the Smarty library files to your system. In our example, we place them in\r\n/usr/local/lib/php/Smarty/\r\n\r\n$&gt; cd YOUR_DOWNLOAD_DIRECTORY\r\n$&gt; gtar -zxvf Smarty-2.6.7.tar.gz\r\n$&gt; mkdir /usr/local/lib/php/Smarty\r\n$&gt; cp -r Smarty-2.6.7/libs/* /usr/local/lib/php/Smarty\r\n\r\nYou should now have the following file structure:\r\n\r\n/usr/local/lib/php/Smarty/\r\n                          Config_File.class.php\r\n                          debug.tpl\r\n                          internals/\r\n                          plugins/\r\n                          Smarty.class.php\r\n                          Smarty_Compiler.class.php\r\n\r\n\r\nSETUP SMARTY DIRECTORIES\r\n\r\nYou will need four directories setup for Smarty to work. These files are for\r\ntemplates, compiled templates, cached templates and config files. You may or\r\nmay not use caching or config files, but it is a good idea to set them up\r\nanyways. It is also recommended to place them outside of the web server\r\ndocument root. The web server PHP user will need write access to the cache and\r\ncompile directories as well.\r\n\r\nIn our example, the document root is /web/www.domain.com/docs and the\r\nweb server username is \"nobody\". We will keep our Smarty files under\r\n/web/www.domain.com/smarty\r\n\r\n$&gt; cd /web/www.domain.com\r\n$&gt; mkdir smarty\r\n$&gt; mkdir smarty/templates\r\n$&gt; mkdir smarty/templates_c\r\n$&gt; mkdir smarty/cache\r\n$&gt; mkdir smarty/configs\r\n$&gt; chown nobody:nobody smarty/templates_c\r\n$&gt; chown nobody:nobody smarty/cache\r\n$&gt; chmod 775 smarty/templates_c\r\n$&gt; chmod 775 smarty/cache\r\n\r\n\r\nSETUP SMARTY PHP SCRIPTS\r\n\r\nNow we setup our application in the document root:\r\n\r\n$&gt; cd /web/www.domain.com/docs\r\n$&gt; mkdir myapp\r\n$&gt; cd myapp\r\n$&gt; vi index.php\r\n\r\nEdit the index.php file to look like the following:\r\n\r\n&lt;?php\r\n\r\n// put full path to Smarty.class.php\r\nrequire(\'/usr/local/lib/php/Smarty/Smarty.class.php\');\r\n$smarty = new Smarty();\r\n\r\n$smarty-&gt;template_dir = \'/web/www.domain.com/smarty/templates\';\r\n$smarty-&gt;compile_dir = \'/web/www.domain.com/smarty/templates_c\';\r\n$smarty-&gt;cache_dir = \'/web/www.domain.com/smarty/cache\';\r\n$smarty-&gt;config_dir = \'/web/www.domain.com/smarty/configs\';\r\n\r\n$smarty-&gt;assign(\'name\', \'Ned\');\r\n$smarty-&gt;display(\'index.tpl\');\r\n\r\n?&gt;\r\n\r\n\r\nSETUP SMARTY TEMPLATE\r\n\r\n$&gt; vi /web/www.domain.com/smarty/templates/index.tpl\r\n\r\nEdit the index.tpl file with the following:\r\n\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;title&gt;Smarty&lt;/title&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\nHello, {$name}!\r\n&lt;/body&gt;\r\n&lt;/html&gt;\r\n\r\n\r\n\r\nNow go to your new application through the web browser,\r\nhttp://www.domain.com/myapp/index.php in our example. You should see the text\r\n\"Hello Ned!\" in your browser.\r\n\r\nOnce you get this far, you can continue on to the Smarty Crash Course to learn\r\na few more simple things, or on to the documentation to learn it all.\r\n</PRE>','2006-01-21 15:43:57','127.0.0.1');
INSERT INTO site_content VALUES (2,8,'en-us','gsdahdsafdsafdsafd','2006-01-21 15:42:32','127.0.0.1');

--
-- Table structure for table 'site_large_config'
--

CREATE TABLE site_large_config (
  SiteConfigID int(11) NOT NULL auto_increment,
  UserID int(11) NOT NULL default '0',
  VersionCode varchar(8) NOT NULL default '',
  VarName varchar(40) NOT NULL default '',
  VarValue text,
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) NOT NULL default '',
  PRIMARY KEY  (SiteConfigID)
) TYPE=MyISAM COMMENT='site configure';

--
-- Dumping data for table 'site_large_config'
--

INSERT INTO site_large_config VALUES (1,2,'en-us','SITE_QUICKLINK','<P><STRONG>Thank You</STRONG></P>\r\n<P><BR><A title=\"BerliOS Developer\" href=\"http://developer.berlios.de\"><IMG height=32 alt=\"BerliOS Developer Logo\" src=\"http://developer.berlios.de/bslogo.php?group_id=5444\" width=124 border=0></A></P>\r\n<P>&nbsp;<A href=\"http://sourceforge.net/donate/index.php?group_id=154056\"><IMG height=32 alt=\"Support This Project\" src=\"http://images.sourceforge.net/images/project-support.jpg\" width=88 border=0> </A></P>\r\n<P><A href=\"http://sourceforge.net\"><IMG height=37 alt=\"SourceForge.net Logo\" src=\"http://sflogo.sourceforge.net/sflogo.php?group_id=154056&amp;type=2\" width=125 border=0></A> </P>','2006-01-21 14:58:23','127.0.0.1');
INSERT INTO site_large_config VALUES (2,2,'en-us','SITE_LEFT_TOP','SGDSAFDSAFD','2006-01-21 16:02:24','127.0.0.1');

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

INSERT INTO site_menu VALUES (1,0,2,'en-us','Home','','ModuleHome','simple.info.index','1137832842','127.0.0.1');
INSERT INTO site_menu VALUES (2,0,2,'en-us','News','','ModuleNews','news.content','1137832845','127.0.0.1');
INSERT INTO site_menu VALUES (3,0,2,'en-us','Document','','ModuleNews','news.content','1137832855','127.0.0.1');
INSERT INTO site_menu VALUES (4,0,2,'en-us','Forum','','ModuleNews','news.content','1137832857','127.0.0.1');
INSERT INTO site_menu VALUES (5,0,2,'en-us','About Us','','ModuleSingleContent','single.content','1137832860','127.0.0.1');
INSERT INTO site_menu VALUES (6,2,2,'en-us','FlushPHP','','ModuleNews','news.content','1137832848','127.0.0.1');
INSERT INTO site_menu VALUES (7,2,2,'en-us','FlushCMS','','ModuleNews','news.content','1137832852','127.0.0.1');
INSERT INTO site_menu VALUES (8,5,2,'en-us','Contact Me','','ModuleSingleContent','single.content','1137832862','127.0.0.1');

--
-- Table structure for table 'site_news'
--

CREATE TABLE site_news (
  NewsID int(11) unsigned NOT NULL auto_increment,
  SiteMenuID int(8) NOT NULL default '0',
  VersionCode varchar(8) binary NOT NULL default '',
  Title varchar(100) binary NOT NULL default '',
  Summary tinytext NOT NULL,
  Content mediumtext NOT NULL,
  Source varchar(100) binary NOT NULL default '',
  Author varchar(60) binary NOT NULL default '',
  CreateTime datetime NOT NULL default '0000-00-00 00:00:00',
  AddIP varchar(24) binary NOT NULL default '',
  PRIMARY KEY  (NewsID)
) TYPE=MyISAM COMMENT='site news module';

--
-- Dumping data for table 'site_news'
--

INSERT INTO site_news VALUES (1,2,'en-us','gdsafdsafdsaf','dfdsafdsafdsafdsafd','fdsafdsafdsafdsa','sfdsaf','fdsafdsa','2006-01-19 21:35:50','127.0.0.1');
INSERT INTO site_news VALUES (2,6,'en-us','Integrating Google Maps into Smarty','This new Google Map API library gives examples how to integrate custom Google maps into Smarty templates. Smarty examples are at the bottom of the README. \r\n','This new Google Map API library gives examples how to integrate custom Google maps into Smarty templates. Smarty examples are at the bottom of the README. ','Smarty','Smarty','2006-01-21 11:30:47','127.0.0.1');
INSERT INTO site_news VALUES (3,6,'en-us','Smarty 2.6.10 Released','This release addresses some minor bug fixes and feature enhancements. Most notable are the secure_dir setting can now be a filename as well as a directory name, more strict syntax checking for quoted strings in the templates, and removal of an ambiguity w','This release addresses some minor bug fixes and feature enhancements. Most notable are the secure_dir setting can now be a filename as well as a directory name, more strict syntax checking for quoted strings in the templates, and removal of an ambiguity with numerical date_format values. See the change log for the entire list. ','Smarty','Smarty','2006-01-21 11:31:24','127.0.0.1');
INSERT INTO site_news VALUES (4,2,'en-us','PHP turns 10','Yesterday was the 10th anniversary of the inception of PHP onto the programming world. The Smarty developers send their congrats to Rasmus and the literally thousands of developers who have made it into what it is today. Smarty itself is over four years o','Yesterday was the <A href=\"http://www.phpdeveloper.org/index/3223\"><U><FONT color=#0000ff>10th anniversary</FONT></U></A> of the inception of PHP onto the programming world. The Smarty developers send their congrats to Rasmus and the literally thousands of developers who have made it into what it is today. Smarty itself is over four years old now, which was introduced on January 18th, 2001. ','Smarty','Smarty','2006-01-21 11:32:52','127.0.0.1');

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

