-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2006 年 12 月 11 日 07:22
-- 服务器版本: 4.0.26
-- PHP 版本: 4.4.2
-- 
-- 数据库: `dev_apf`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_agreement`
-- 

CREATE TABLE `apf_agreement` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `noid` varchar(255) NOT NULL default '',
  `category` int(5) default NULL,
  `effectdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `expireddate` datetime NOT NULL default '0000-00-00 00:00:00',
  `buyer` varchar(120) default NULL,
  `vender` varchar(120) default NULL,
  `buyersignature` varchar(120) default NULL,
  `vendersignature` varchar(120) default NULL,
  `description` text,
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `noid` (`noid`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_agreement_category`
-- 

CREATE TABLE `apf_agreement_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company`
-- 

CREATE TABLE `apf_company` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `addrees` varchar(150) default NULL,
  `phone` varchar(80) default NULL,
  `fax` varchar(80) default NULL,
  `email` varchar(80) default NULL,
  `photo` varchar(60) default NULL,
  `homepage` varchar(90) default NULL,
  `employee` int(5) default NULL,
  `bankroll` decimal(10,2) default NULL,
  `link_man` varchar(50) default NULL,
  `incorporator` varchar(50) default NULL,
  `industry` varchar(50) default NULL,
  `products` text,
  `memo` text,
  `active` varchar(8) NOT NULL default 'new',
  `access` varchar(8) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=73027 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company_contact`
-- 

CREATE TABLE `apf_company_contact` (
  `id` int(11) NOT NULL auto_increment,
  `company_id` int(11) default NULL,
  `contact_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `company_id` (`company_id`),
  KEY `contact_id` (`contact_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_company_product`
-- 

CREATE TABLE `apf_company_product` (
  `id` int(11) NOT NULL auto_increment,
  `company_id` int(11) default NULL,
  `product_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `company_id` (`company_id`),
  KEY `product_id` (`product_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_complaints`
-- 

CREATE TABLE `apf_complaints` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `category` int(5) default NULL,
  `complainanter` varchar(120) default NULL,
  `title` varchar(120) NOT NULL default '',
  `content` text,
  `reply` char(2) NOT NULL default 'n',
  `handleman` varchar(40) NOT NULL default '',
  `handledate` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_complaints_category`
-- 

CREATE TABLE `apf_complaints_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_contact`
-- 

CREATE TABLE `apf_contact` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(5) default NULL,
  `company_id` int(5) default NULL,
  `name` varchar(50) default NULL,
  `gender` char(2) default NULL,
  `birthday` date default NULL,
  `addrees` varchar(150) default NULL,
  `office_phone` varchar(80) default NULL,
  `phone` varchar(80) default NULL,
  `fax` varchar(80) default NULL,
  `mobile` varchar(80) default NULL,
  `email` varchar(80) default NULL,
  `photo` varchar(60) default NULL,
  `homepage` varchar(90) default NULL,
  `memo` text NOT NULL,
  `active` varchar(8) NOT NULL default 'new',
  `access` varchar(8) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) TYPE=MyISAM AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_contact_category`
-- 

CREATE TABLE `apf_contact_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `category_name` (`category_name`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_dailyreport`
-- 

CREATE TABLE `apf_dailyreport` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(60) default NULL,
  `content` text,
  `filldate` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_files`
-- 

CREATE TABLE `apf_files` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `parent` int(4) NOT NULL default '0',
  `filename` varchar(255) NOT NULL default '',
  `ext` varchar(10) NOT NULL default '',
  `f_size` bigint(20) NOT NULL default '0',
  `description` text NOT NULL,
  `checked_out` int(4) NOT NULL default '0',
  `major_revision` int(4) NOT NULL default '0',
  `minor_revision` int(4) NOT NULL default '1',
  `url` int(4) NOT NULL default '0',
  `password` varchar(50) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `groupid` varchar(11) NOT NULL default '',
  `active` varchar(8) NOT NULL default 'live',
  `access` varchar(8) NOT NULL default '',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fileid_index` (`id`),
  KEY `parentid_index` (`parent`),
  KEY `files_filetype` (`url`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_finance`
-- 

CREATE TABLE `apf_finance` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(5) default NULL,
  `create_date` date default NULL,
  `amount` tinyint(4) default NULL,
  `debit` varchar(4) default NULL,
  `money` decimal(10,2) default NULL,
  `memo` text,
  `active` varchar(8) NOT NULL default 'new',
  `access` varchar(8) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_finance_category`
-- 

CREATE TABLE `apf_finance_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_folders`
-- 

CREATE TABLE `apf_folders` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `dirpath` varchar(255) NOT NULL default '',
  `parent` int(4) default NULL,
  `description` text,
  `password` varchar(50) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `active` varchar(8) NOT NULL default 'live',
  `access` varchar(8) NOT NULL default '',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_grouprights`
-- 

CREATE TABLE `apf_grouprights` (
  `group_id` int(11) default '0',
  `right_id` int(11) default '0',
  `right_level` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`group_id`,`right_id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groups`
-- 

CREATE TABLE `apf_groups` (
  `group_id` int(11) default '0',
  `group_type` int(11) default '0',
  `group_define_name` varchar(32) default NULL,
  `is_active` tinyint(1) default '1',
  `owner_user_id` int(11) default '0',
  `owner_group_id` int(11) default '0',
  UNIQUE KEY `group_id_idx` (`group_id`),
  UNIQUE KEY `define_name_i_idx` (`group_define_name`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groups_group_id_seq`
-- 

CREATE TABLE `apf_groups_group_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groupusers`
-- 

CREATE TABLE `apf_groupusers` (
  `perm_user_id` int(11) default '0',
  `group_id` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`perm_user_id`,`group_id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_news`
-- 

CREATE TABLE `apf_news` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(8) NOT NULL default '0',
  `title` varchar(60) default NULL,
  `content` text,
  `active` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_news_category`
-- 

CREATE TABLE `apf_news_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `orderid` int(11) NOT NULL default '0',
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_opportunity`
-- 

CREATE TABLE `apf_opportunity` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(150) default NULL,
  `addrees` varchar(150) default NULL,
  `phone` varchar(80) default NULL,
  `fax` varchar(80) default NULL,
  `email` varchar(80) default NULL,
  `homepage` varchar(90) default NULL,
  `link_man` varchar(50) default NULL,
  `memo` text,
  `state` varchar(50) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`),
  KEY `phone` (`phone`),
  KEY `link_man` (`link_man`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_order`
-- 

CREATE TABLE `apf_order` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `noid` varchar(255) NOT NULL default '',
  `category` int(5) default NULL,
  `contactid` int(8) default NULL,
  `product` varchar(60) default NULL,
  `amount` int(8) default NULL,
  `money` decimal(10,2) default NULL,
  `discount` int(2) default NULL,
  `payway` varchar(30) NOT NULL default '',
  `deliveryway` varchar(30) NOT NULL default '',
  `deliverydatetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` varchar(8) NOT NULL default 'new',
  `memo` text,
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `noid` (`noid`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_order_category`
-- 

CREATE TABLE `apf_order_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_perm_users`
-- 

CREATE TABLE `apf_perm_users` (
  `perm_user_id` int(11) default '0',
  `auth_user_id` varchar(32) default NULL,
  `auth_container_name` varchar(32) default NULL,
  `perm_type` int(11) default '0',
  UNIQUE KEY `perm_user_id_idx` (`perm_user_id`),
  UNIQUE KEY `auth_id_i_idx` (`auth_user_id`,`auth_container_name`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_perm_users_perm_user_id_seq`
-- 

CREATE TABLE `apf_perm_users_perm_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_product`
-- 

CREATE TABLE `apf_product` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(5) default NULL,
  `company_id` int(5) default NULL,
  `name` varchar(60) default NULL,
  `price` decimal(10,2) default NULL,
  `photo` varchar(60) default NULL,
  `memo` text,
  `active` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_product_category`
-- 

CREATE TABLE `apf_product_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_product_price`
-- 

CREATE TABLE `apf_product_price` (
  `id` int(11) NOT NULL auto_increment,
  `company_id` int(11) default NULL,
  `product_id` int(11) default NULL,
  `price` decimal(10,2) default NULL,
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `company_id` (`company_id`),
  KEY `product_id` (`product_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_refundment`
-- 

CREATE TABLE `apf_refundment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `category` int(5) default NULL,
  `company` int(5) default NULL,
  `refundmenter` varchar(120) default NULL,
  `reasons` varchar(255) NOT NULL default '',
  `reply` char(2) NOT NULL default 'n',
  `handleman` varchar(40) NOT NULL default '',
  `handledate` datetime NOT NULL default '0000-00-00 00:00:00',
  `state` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_refundment_category`
-- 

CREATE TABLE `apf_refundment_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_review`
-- 

CREATE TABLE `apf_review` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `company` varchar(120) default NULL,
  `linkman` varchar(120) default NULL,
  `reviewdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `category` varchar(10) default NULL,
  `content` text,
  `groupid` varchar(11) NOT NULL default '',
  `userid` int(4) NOT NULL default '0',
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_rights`
-- 

CREATE TABLE `apf_rights` (
  `right_id` int(11) default '0',
  `area_id` int(11) default '0',
  `right_define_name` varchar(32) default NULL,
  `has_implied` tinyint(1) default '1',
  UNIQUE KEY `right_id_idx` (`right_id`),
  UNIQUE KEY `define_name_i_idx` (`area_id`,`right_define_name`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_schedule`
-- 

CREATE TABLE `apf_schedule` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `description` text,
  `publish_date` date NOT NULL default '0000-00-00',
  `publish_starttime` time NOT NULL default '00:00:00',
  `publish_endtime` time NOT NULL default '00:00:00',
  `image` varchar(255) NOT NULL default '',
  `active` varchar(8) NOT NULL default 'live',
  `access` varchar(8) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `publish_date` (`publish_date`),
  KEY `publish_starttime` (`publish_starttime`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_selfcompany`
-- 

CREATE TABLE `apf_selfcompany` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `addrees` varchar(150) default NULL,
  `phone` varchar(80) default NULL,
  `fax` varchar(80) default NULL,
  `email` varchar(80) default NULL,
  `photo` varchar(60) default NULL,
  `homepage` varchar(90) default NULL,
  `employee` int(5) default NULL,
  `bankroll` decimal(10,2) default NULL,
  `link_man` varchar(50) default NULL,
  `incorporator` varchar(50) default NULL,
  `industry` varchar(50) default NULL,
  `taxaccounts` varchar(120) default NULL,
  `bankaccounts` text,
  `products` text,
  `memo` text,
  `active` varchar(8) NOT NULL default 'new',
  `access` varchar(8) NOT NULL default '',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_selfproduct`
-- 

CREATE TABLE `apf_selfproduct` (
  `id` int(11) NOT NULL auto_increment,
  `productname` varchar(60) default NULL,
  `retailprice` decimal(10,2) default NULL,
  `wholesaleprice` decimal(10,2) default NULL,
  `costprice` decimal(10,2) default NULL,
  `photo` varchar(60) default NULL,
  `releasedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `memo` text,
  `access` varchar(8) NOT NULL default 'public',
  `active` varchar(8) NOT NULL default 'new',
  `groupid` varchar(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_userrights`
-- 

CREATE TABLE `apf_userrights` (
  `perm_user_id` int(11) default '0',
  `right_id` int(11) default '0',
  `right_level` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`perm_user_id`,`right_id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_users`
-- 

CREATE TABLE `apf_users` (
  `id` int(11) NOT NULL auto_increment,
  `user_name` varchar(60) default NULL,
  `user_pwd` varchar(50) default NULL,
  `gender` varchar(8) default NULL,
  `addrees` varchar(150) default NULL,
  `phone` varchar(80) default NULL,
  `email` varchar(80) default NULL,
  `photo` varchar(80) default NULL,
  `role_id` int(8) default NULL,
  `active` varchar(8) NOT NULL default 'live',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

-- 
-- 表的结构 `liveuser_applications_application_id_seq`
-- 

CREATE TABLE `liveuser_applications_application_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;
