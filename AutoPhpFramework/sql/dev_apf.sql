-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2006 年 09 月 24 日 12:33
-- 服务器版本: 4.0.26
-- PHP 版本: 4.4.2
-- 
-- 数据库: `dev_apf`
-- 

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
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `apf_company`
-- 


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
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_contact`
-- 

INSERT INTO `apf_contact` (`id`, `category`, `company_id`, `name`, `gender`, `birthday`, `addrees`, `office_phone`, `phone`, `fax`, `mobile`, `email`, `photo`, `homepage`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 1, 0, '孟远螓', 'm', '1981-10-13', '广西贺州', '0755-83818420', '0755-83818420', '0755-83818420', '13684987661', 'arzen1013@gmail.com', '', 'http://www.518ic.com', 'new', '', '0000-00-00 00:00:00', '2006-09-23 14:13:59'),
(2, 1, 0, '古金', 'f', '1981-04-23', '广东肇庆', '0755-83818420', '0755-83818420', '0755-83818420', '13537699656', '', '', '', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:07:06');

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
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `apf_contact_category`
-- 

INSERT INTO `apf_contact_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, '朋友', 'new', '', '0000-00-00 00:00:00', '2006-09-23 11:24:12'),
(2, '同事', 'live', '', '2006-09-23 11:24:22', '0000-00-00 00:00:00'),
(3, '同学', 'live', '', '2006-09-23 11:24:39', '0000-00-00 00:00:00'),
(4, '国外朋友', 'live', '', '2006-09-23 11:28:21', '0000-00-00 00:00:00');

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
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_finance`
-- 

INSERT INTO `apf_finance` (`id`, `category`, `create_date`, `amount`, `debit`, `money`, `memo`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 2, '2006-09-23', 1, 'P', 599.00, '', 'new', '', '0000-00-00 00:00:00', '2006-09-23 18:18:34'),
(2, 1, '2006-09-23', 2, 'P', 287956.00, '', 'new', '', '0000-00-00 00:00:00', '2006-09-23 18:20:59');

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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_finance_category`
-- 

INSERT INTO `apf_finance_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, '工资', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:06'),
(2, '外单', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:18');

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
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_news`
-- 

INSERT INTO `apf_news` (`id`, `category_id`, `title`, `content`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 2, 'TESTSESTEST', 'TESTSESTESTTESTSESTESTTESTSESTESTTESTSESTEST', 'new', '', '0000-00-00 00:00:00', '2006-09-23 11:10:46');

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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_news_category`
-- 

INSERT INTO `apf_news_category` (`id`, `category_name`, `orderid`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'local news', 2, 'deleted', '', '2006-09-22 22:08:59', '0000-00-00 00:00:00'),
(2, 'chinese news', 1, 'new', '', '2006-09-22 22:09:21', '0000-00-00 00:00:00');

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
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `apf_product`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `apf_product_category`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_users`
-- 

INSERT INTO `apf_users` (`id`, `user_name`, `user_pwd`, `gender`, `addrees`, `phone`, `email`, `photo`, `role_id`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'test', 'test', '', '', '444', '', '', 0, 'deleted', '', '0000-00-00 00:00:00', '2006-09-23 11:10:11');
