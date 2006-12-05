-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2006 年 10 月 16 日 07:07
-- 服务器版本: 4.0.26
-- PHP 版本: 4.4.2
-- 
-- 数据库: `dev_apf`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_apf_users_auth_user_id_seq`
-- 

CREATE TABLE `APF_APF_USERS_AUTH_USER_ID_SEQ` (
  `ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_apf_users_auth_user_id_seq`
-- 

INSERT INTO `APF_APF_USERS_AUTH_USER_ID_SEQ` (`ID`) VALUES (1);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company`
-- 

CREATE TABLE `APF_COMPANY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NAME` VARCHAR(50) DEFAULT NULL,
  `ADDREES` VARCHAR(150) DEFAULT NULL,
  `PHONE` VARCHAR(80) DEFAULT NULL,
  `FAX` VARCHAR(80) DEFAULT NULL,
  `EMAIL` VARCHAR(80) DEFAULT NULL,
  `PHOTO` VARCHAR(60) DEFAULT NULL,
  `HOMEPAGE` VARCHAR(90) DEFAULT NULL,
  `EMPLOYEE` INT(5) DEFAULT NULL,
  `BANKROLL` DECIMAL(10,2) DEFAULT NULL,
  `LINK_MAN` VARCHAR(50) DEFAULT NULL,
  `INCORPORATOR` VARCHAR(50) DEFAULT NULL,
  `INDUSTRY` VARCHAR(50) DEFAULT NULL,
  `PRODUCTS` TEXT,
  `MEMO` TEXT,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `NAME` (`NAME`)
) TYPE=MYISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_company`
-- 

INSERT INTO `APF_COMPANY` (`ID`, `NAME`, `ADDREES`, `PHONE`, `FAX`, `EMAIL`, `PHOTO`, `HOMEPAGE`, `EMPLOYEE`, `BANKROLL`, `LINK_MAN`, `INCORPORATOR`, `INDUSTRY`, `PRODUCTS`, `MEMO`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, '广西艺术学院美术学院', '2004-2006 远烘艺术画廊版权所有', '0771-2694246', '', '', 'product/20061015/58314531817ba5035.jpg', '', 0, 0.00, '', '', '', '', '', 'live', '', '0000-00-00 00:00:00', '2006-10-15 00:31:55');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company_contact`
-- 

CREATE TABLE `APF_COMPANY_CONTACT` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` INT(11) DEFAULT NULL,
  `CONTACT_ID` INT(11) DEFAULT NULL,
  PRIMARY KEY  (`ID`),
  KEY `COMPANY_ID` (`COMPANY_ID`),
  KEY `CONTACT_ID` (`CONTACT_ID`)
) TYPE=MYISAM AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `apf_company_contact`
-- 

INSERT INTO `APF_COMPANY_CONTACT` (`ID`, `COMPANY_ID`, `CONTACT_ID`) VALUES (2, 1, 46),
(4, 1, 39),
(6, 1, 44);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company_product`
-- 

CREATE TABLE `APF_COMPANY_PRODUCT` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` INT(11) DEFAULT NULL,
  `PRODUCT_ID` INT(11) DEFAULT NULL,
  PRIMARY KEY  (`ID`),
  KEY `COMPANY_ID` (`COMPANY_ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_company_product`
-- 

INSERT INTO `APF_COMPANY_PRODUCT` (`ID`, `COMPANY_ID`, `PRODUCT_ID`) VALUES (2, 1, 1),
(3, 1, 2);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_contact`
-- 

CREATE TABLE `APF_CONTACT` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` INT(5) DEFAULT NULL,
  `COMPANY_ID` INT(5) DEFAULT NULL,
  `NAME` VARCHAR(50) DEFAULT NULL,
  `GENDER` CHAR(2) DEFAULT NULL,
  `BIRTHDAY` DATE DEFAULT NULL,
  `ADDREES` VARCHAR(150) DEFAULT NULL,
  `OFFICE_PHONE` VARCHAR(80) DEFAULT NULL,
  `PHONE` VARCHAR(80) DEFAULT NULL,
  `FAX` VARCHAR(80) DEFAULT NULL,
  `MOBILE` VARCHAR(80) DEFAULT NULL,
  `EMAIL` VARCHAR(80) DEFAULT NULL,
  `PHOTO` VARCHAR(60) DEFAULT NULL,
  `HOMEPAGE` VARCHAR(90) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `CATEGORY` (`CATEGORY`)
) TYPE=MYISAM AUTO_INCREMENT=47 ;

-- 
-- 导出表中的数据 `apf_contact`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `apf_contact_category`
-- 

CREATE TABLE `APF_CONTACT_CATEGORY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` VARCHAR(60) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `CATEGORY_NAME` (`CATEGORY_NAME`)
) TYPE=MYISAM AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `apf_contact_category`
-- 

INSERT INTO `APF_CONTACT_CATEGORY` (`ID`, `CATEGORY_NAME`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, '朋友', 'new', '', '0000-00-00 00:00:00', '2006-09-23 11:24:12'),
(2, '同事', 'live', '', '2006-09-23 11:24:22', '0000-00-00 00:00:00'),
(3, '同学', 'live', '', '2006-09-23 11:24:39', '0000-00-00 00:00:00'),
(4, '国外朋友', 'live', '', '2006-09-23 11:28:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_finance`
-- 

CREATE TABLE `APF_FINANCE` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` INT(5) DEFAULT NULL,
  `CREATE_DATE` DATE DEFAULT NULL,
  `AMOUNT` TINYINT(4) DEFAULT NULL,
  `DEBIT` VARCHAR(4) DEFAULT NULL,
  `MONEY` DECIMAL(10,2) DEFAULT NULL,
  `MEMO` TEXT,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_finance`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `apf_finance_category`
-- 

CREATE TABLE `APF_FINANCE_CATEGORY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` VARCHAR(60) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_finance_category`
-- 

INSERT INTO `APF_FINANCE_CATEGORY` (`ID`, `CATEGORY_NAME`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, '工资', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:06'),
(2, '外单', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:18');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_grouprights`
-- 

CREATE TABLE `APF_GROUPRIGHTS` (
  `GROUP_ID` INT(11) DEFAULT '0',
  `RIGHT_ID` INT(11) DEFAULT '0',
  `RIGHT_LEVEL` INT(11) DEFAULT '0',
  UNIQUE KEY `ID_I_IDX` (`GROUP_ID`,`RIGHT_ID`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_grouprights`
-- 

INSERT INTO `APF_GROUPRIGHTS` (`GROUP_ID`, `RIGHT_ID`, `RIGHT_LEVEL`) VALUES (1, 1, 3),
(1, 2, 3),
(1, 3, 3);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groups`
-- 

CREATE TABLE `APF_GROUPS` (
  `GROUP_ID` INT(11) DEFAULT '0',
  `GROUP_TYPE` INT(11) DEFAULT '0',
  `GROUP_DEFINE_NAME` VARCHAR(32) DEFAULT NULL,
  `IS_ACTIVE` TINYINT(1) DEFAULT '1',
  `OWNER_USER_ID` INT(11) DEFAULT '0',
  `OWNER_GROUP_ID` INT(11) DEFAULT '0',
  UNIQUE KEY `GROUP_ID_IDX` (`GROUP_ID`),
  UNIQUE KEY `DEFINE_NAME_I_IDX` (`GROUP_DEFINE_NAME`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_groups`
-- 

INSERT INTO `APF_GROUPS` (`GROUP_ID`, `GROUP_TYPE`, `GROUP_DEFINE_NAME`, `IS_ACTIVE`, `OWNER_USER_ID`, `OWNER_GROUP_ID`) VALUES (2, 0, 'User', 1, 0, 0),
(1, 0, 'SuperUser', 1, 0, 0),
(3, 0, 'Customer', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groups_group_id_seq`
-- 

CREATE TABLE `APF_GROUPS_GROUP_ID_SEQ` (
  `ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_groups_group_id_seq`
-- 

INSERT INTO `APF_GROUPS_GROUP_ID_SEQ` (`ID`) VALUES (1);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groupusers`
-- 

CREATE TABLE `APF_GROUPUSERS` (
  `PERM_USER_ID` INT(11) DEFAULT '0',
  `GROUP_ID` INT(11) DEFAULT '0',
  UNIQUE KEY `ID_I_IDX` (`PERM_USER_ID`,`GROUP_ID`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_groupusers`
-- 

INSERT INTO `APF_GROUPUSERS` (`PERM_USER_ID`, `GROUP_ID`) VALUES (1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_news`
-- 

CREATE TABLE `APF_NEWS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_ID` INT(8) NOT NULL DEFAULT '0',
  `TITLE` VARCHAR(60) DEFAULT NULL,
  `CONTENT` TEXT,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=16 ;

-- 
-- 导出表中的数据 `apf_news`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_news_category`
-- 

CREATE TABLE `APF_NEWS_CATEGORY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` VARCHAR(60) DEFAULT NULL,
  `ORDERID` INT(11) NOT NULL DEFAULT '0',
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_news_category`
-- 

INSERT INTO `APF_NEWS_CATEGORY` (`ID`, `CATEGORY_NAME`, `ORDERID`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, 'local news', 2, 'deleted', '', '2006-09-22 22:08:59', '0000-00-00 00:00:00'),
(2, 'chinese news', 1, 'new', '', '2006-09-22 22:09:21', '0000-00-00 00:00:00'),
(3, 'Symbian', 3, 'live', '', '2006-10-08 18:02:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_perm_users`
-- 

CREATE TABLE `APF_PERM_USERS` (
  `PERM_USER_ID` INT(11) DEFAULT '0',
  `AUTH_USER_ID` VARCHAR(32) DEFAULT NULL,
  `AUTH_CONTAINER_NAME` VARCHAR(32) DEFAULT NULL,
  `PERM_TYPE` INT(11) DEFAULT '0',
  UNIQUE KEY `PERM_USER_ID_IDX` (`PERM_USER_ID`),
  UNIQUE KEY `AUTH_ID_I_IDX` (`AUTH_USER_ID`,`AUTH_CONTAINER_NAME`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_perm_users`
-- 

INSERT INTO `APF_PERM_USERS` (`PERM_USER_ID`, `AUTH_USER_ID`, `AUTH_CONTAINER_NAME`, `PERM_TYPE`) VALUES (1, '1', 'DB', 1),
(2, '2', 'DB', 1),
(3, '3', 'DB', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_perm_users_perm_user_id_seq`
-- 

CREATE TABLE `APF_PERM_USERS_PERM_USER_ID_SEQ` (
  `ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_perm_users_perm_user_id_seq`
-- 

INSERT INTO `APF_PERM_USERS_PERM_USER_ID_SEQ` (`ID`) VALUES (3);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_product`
-- 

CREATE TABLE `APF_PRODUCT` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` INT(5) DEFAULT NULL,
  `COMPANY_ID` INT(5) DEFAULT NULL,
  `NAME` VARCHAR(60) DEFAULT NULL,
  `PRICE` DECIMAL(10,2) DEFAULT NULL,
  `PHOTO` VARCHAR(60) DEFAULT NULL,
  `MEMO` TEXT,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_product`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `apf_product_category`
-- 

CREATE TABLE `APF_PRODUCT_CATEGORY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` VARCHAR(60) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_product_category`
-- 

INSERT INTO `APF_PRODUCT_CATEGORY` (`ID`, `CATEGORY_NAME`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, '农副产品1', 'live', '', '0000-00-00 00:00:00', '2006-10-14 04:48:55');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_rights`
-- 

CREATE TABLE `APF_RIGHTS` (
  `RIGHT_ID` INT(11) DEFAULT '0',
  `AREA_ID` INT(11) DEFAULT '0',
  `RIGHT_DEFINE_NAME` VARCHAR(32) DEFAULT NULL,
  `HAS_IMPLIED` TINYINT(1) DEFAULT '1',
  UNIQUE KEY `RIGHT_ID_IDX` (`RIGHT_ID`),
  UNIQUE KEY `DEFINE_NAME_I_IDX` (`AREA_ID`,`RIGHT_DEFINE_NAME`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_rights`
-- 

INSERT INTO `APF_RIGHTS` (`RIGHT_ID`, `AREA_ID`, `RIGHT_DEFINE_NAME`, `HAS_IMPLIED`) VALUES (1, 0, 'ALLOWDELETE', 0),
(2, 0, 'ALLOWUPDATE', 0),
(3, 0, 'ALLOWCREATE', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_userrights`
-- 

CREATE TABLE `APF_USERRIGHTS` (
  `PERM_USER_ID` INT(11) DEFAULT '0',
  `RIGHT_ID` INT(11) DEFAULT '0',
  `RIGHT_LEVEL` INT(11) DEFAULT '0',
  UNIQUE KEY `ID_I_IDX` (`PERM_USER_ID`,`RIGHT_ID`)
) TYPE=MYISAM;

-- 
-- 导出表中的数据 `apf_userrights`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `apf_users`
-- 

CREATE TABLE `APF_USERS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `USER_NAME` VARCHAR(60) DEFAULT NULL,
  `USER_PWD` VARCHAR(50) DEFAULT NULL,
  `GENDER` VARCHAR(8) DEFAULT NULL,
  `ADDREES` VARCHAR(150) DEFAULT NULL,
  `PHONE` VARCHAR(80) DEFAULT NULL,
  `EMAIL` VARCHAR(80) DEFAULT NULL,
  `PHOTO` VARCHAR(80) DEFAULT NULL,
  `ROLE_ID` INT(8) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'live',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_users`
-- 

INSERT INTO `APF_USERS` (`ID`, `USER_NAME`, `USER_PWD`, `GENDER`, `ADDREES`, `PHONE`, `EMAIL`, `PHOTO`, `ROLE_ID`, `ACTIVE`, `ADD_IP`, `CREATED_AT`, `UPDATE_AT`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'm', '广西贺州', '13684987661', 'arzen1013@gmail.com', '', 0, 'live', '', '0000-00-00 00:00:00', '2006-10-07 07:36:04'),
(2, 'user', '0d8d5cd06832b29560745fe4e1b941cf', 'm', 'dddd', 'dddd', 'dddd', 'users/20061007/261274526f0358e8eb.jpg', 0, 'live', '', '0000-00-00 00:00:00', '2006-10-07 08:09:25'),
(3, 'cust', '3aad3506aa11f05f265ea8304b8152b3', 'f', 'dddd', '', '', '', 0, 'new', '', '0000-00-00 00:00:00', '2006-10-07 07:37:40');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_users_auth_user_id_seq`
-- 

CREATE TABLE `APF_USERS_AUTH_USER_ID_SEQ` (
  `ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY  (`ID`)
) TYPE=MYISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `apf_users_auth_user_id_seq`
-- 

INSERT INTO `APF_USERS_AUTH_USER_ID_SEQ` (`ID`) VALUES (3);

-- 
-- 表的结构 `apf_company_contact`
-- 

CREATE TABLE `APF_PRODUCT_PRICE` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` INT(11) DEFAULT NULL,
  `PRODUCT_ID` INT(11) DEFAULT NULL,
  `PRICE` DECIMAL(10,2) DEFAULT NULL,
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `COMPANY_ID` (`COMPANY_ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`)
) TYPE=MYISAM;

CREATE TABLE `APF_HOUSE` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `TITLE` INT(11) DEFAULT NULL,
  `PRODUCT_ID` INT(11) DEFAULT NULL,
  `PRICE` DECIMAL(10,2) DEFAULT NULL,
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `COMPANY_ID` (`COMPANY_ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`)
) TYPE=MYISAM;

CREATE TABLE `APF_OPPORTUNITY` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `TITLE` VARCHAR(150) DEFAULT NULL,
  `ADDREES` VARCHAR(150) DEFAULT NULL,
  `PHONE` VARCHAR(80) DEFAULT NULL,
  `FAX` VARCHAR(80) DEFAULT NULL,
  `EMAIL` VARCHAR(80) DEFAULT NULL,
  `HOMEPAGE` VARCHAR(90) DEFAULT NULL,
  `LINK_MAN` VARCHAR(50) DEFAULT NULL,
  `MEMO` TEXT,
  `STATE` VARCHAR(50) DEFAULT NULL,
  `ACTIVE` VARCHAR(8) NOT NULL DEFAULT 'new',
  `ADD_IP` VARCHAR(24) DEFAULT NULL,
  `CREATED_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATE_AT` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`ID`),
  KEY `TITLE` (`TITLE`),
  KEY `PHONE` (`PHONE`),
  KEY `LINK_MAN` (`LINK_MAN`)
) TYPE=MYISAM;

CREATE TABLE `apf_schedule` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text,
  `publish_date` date NOT NULL default '0000-00-00',
  `publish_starttime` time NOT NULL default '00:00:00',
  `publish_endtime` time NOT NULL default '00:00:00',
  `image` varchar(255) NOT NULL default '',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `publish_date` (`publish_date`),
  KEY `publish_starttime` (`publish_starttime`)
) TYPE=MyISAM;

CREATE TABLE `apf_folders` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `parent` INT(4) DEFAULT NULL,
  `description` text,
  `password` varchar(50) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',

  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM;

CREATE TABLE `apf_files` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `parent` int(4) NOT NULL default '0',
  `filename` varchar(255) NOT NULL default '',
  `f_size` bigint(20) NOT NULL default '0',
  `userid` int(4) NOT NULL default '0',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `description` text NOT NULL,
  `metadata` text NOT NULL,
  `groupid` varchar(11) NOT NULL default '',
  `checked_out` int(4) NOT NULL default '0',
  `major_revision` int(4) NOT NULL default '0',
  `minor_revision` int(4) NOT NULL default '1',
  `url` int(4) NOT NULL default '0',
  `password` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fileid_index` (`id`),
  KEY `parentid_index` (`parent`),
  KEY `files_filetype` (`url`)
) TYPE=MyISAM;
