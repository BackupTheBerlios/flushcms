-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ��������: 2006 �� 10 �� 29 �� 18:27
-- �������汾: 4.0.26
-- PHP �汾: 4.4.2
-- 
-- ���ݿ�: `dev_yweb`
-- 

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_grouprights`
-- 

CREATE TABLE `apf_grouprights` (
  `group_id` int(11) default '0',
  `right_id` int(11) default '0',
  `right_level` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`group_id`,`right_id`)
) TYPE=MyISAM;

-- 
-- �������е����� `apf_grouprights`
-- 

INSERT INTO `apf_grouprights` (`group_id`, `right_id`, `right_level`) VALUES (1, 1, 3),
(1, 2, 3),
(1, 3, 3);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_groups`
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

-- 
-- �������е����� `apf_groups`
-- 

INSERT INTO `apf_groups` (`group_id`, `group_type`, `group_define_name`, `is_active`, `owner_user_id`, `owner_group_id`) VALUES (2, 0, 'User', 1, 0, 0),
(1, 0, 'SuperUser', 1, 0, 0),
(3, 0, 'Customer', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_groupusers`
-- 

CREATE TABLE `apf_groupusers` (
  `perm_user_id` int(11) default '0',
  `group_id` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`perm_user_id`,`group_id`)
) TYPE=MyISAM;

-- 
-- �������е����� `apf_groupusers`
-- 

INSERT INTO `apf_groupusers` (`perm_user_id`, `group_id`) VALUES (1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_news`
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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- �������е����� `apf_news`
-- 


-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_news_category`
-- 

CREATE TABLE `apf_news_category` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(8) NOT NULL default '0',
  `category_name` varchar(60) default NULL,
  `orderid` int(11) NOT NULL default '0',
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- �������е����� `apf_news_category`
-- 

INSERT INTO `apf_news_category` (`id`, `pid`, `category_name`, `orderid`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 0, 'local news', 0, 'deleted', '', '2006-09-22 22:08:59', '0000-00-00 00:00:00'),
(2, 0, 'PHP Article', 2, 'new', '', '0000-00-00 00:00:00', '2006-10-16 17:37:12'),
(3, 0, 'Symbian', 3, 'live', '', '2006-10-08 18:02:29', '0000-00-00 00:00:00'),
(4, 1, '��������', 4, 'live', '', '2006-10-29 18:22:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_perm_users`
-- 

CREATE TABLE `apf_perm_users` (
  `perm_user_id` int(11) default '0',
  `auth_user_id` varchar(32) default NULL,
  `auth_container_name` varchar(32) default NULL,
  `perm_type` int(11) default '0',
  UNIQUE KEY `perm_user_id_idx` (`perm_user_id`),
  UNIQUE KEY `auth_id_i_idx` (`auth_user_id`,`auth_container_name`)
) TYPE=MyISAM;

-- 
-- �������е����� `apf_perm_users`
-- 

INSERT INTO `apf_perm_users` (`perm_user_id`, `auth_user_id`, `auth_container_name`, `perm_type`) VALUES (1, '1', 'DB', 1),
(2, '2', 'DB', 1),
(3, '3', 'DB', 1);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_product`
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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- �������е����� `apf_product`
-- 

INSERT INTO `apf_product` (`id`, `category`, `company_id`, `name`, `price`, `photo`, `memo`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 1, 0, '�ͻ�', 200.00, 'product/20061014/3118645306f9c6fc89.jpg', '�ͻ�', 'live', '', '2006-10-14 05:03:24', '0000-00-00 00:00:00'),
(2, 1, 0, '�̷�', 120.00, 'product/20061016/84164532bc0bdbefa.jpg', '�̷��̷�', 'new', '', '0000-00-00 00:00:00', '2006-10-16 06:54:17');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_product_category`
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

-- 
-- �������е����� `apf_product_category`
-- 

INSERT INTO `apf_product_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'ũ����Ʒ1', 'live', '', '0000-00-00 00:00:00', '2006-10-14 04:48:55');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_product_price`
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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- �������е����� `apf_product_price`
-- 

INSERT INTO `apf_product_price` (`id`, `company_id`, `product_id`, `price`, `add_ip`, `created_at`, `update_at`) VALUES (1, 1, 1, 200.00, NULL, '2006-10-18 06:50:26', '0000-00-00 00:00:00'),
(2, 1, 2, 250.00, NULL, '2006-10-18 06:51:11', '0000-00-00 00:00:00'),
(3, 1, 1, 320.00, NULL, '2006-10-18 07:09:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_rights`
-- 

CREATE TABLE `apf_rights` (
  `right_id` int(11) default '0',
  `area_id` int(11) default '0',
  `right_define_name` varchar(32) default NULL,
  `has_implied` tinyint(1) default '1',
  UNIQUE KEY `right_id_idx` (`right_id`),
  UNIQUE KEY `define_name_i_idx` (`area_id`,`right_define_name`)
) TYPE=MyISAM;

-- 
-- �������е����� `apf_rights`
-- 

INSERT INTO `apf_rights` (`right_id`, `area_id`, `right_define_name`, `has_implied`) VALUES (1, 0, 'ALLOWDELETE', 0),
(2, 0, 'ALLOWUPDATE', 0),
(3, 0, 'ALLOWCREATE', 0);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_userrights`
-- 

CREATE TABLE `apf_userrights` (
  `perm_user_id` int(11) default '0',
  `right_id` int(11) default '0',
  `right_level` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`perm_user_id`,`right_id`)
) TYPE=MyISAM;

-- 
-- �������е����� `apf_userrights`
-- 


-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_users`
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

-- 
-- �������е����� `apf_users`
-- 

INSERT INTO `apf_users` (`id`, `user_name`, `user_pwd`, `gender`, `addrees`, `phone`, `email`, `photo`, `role_id`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'm', '��������', '13684987661', 'arzen1013@gmail.com', '', 0, 'live', '', '0000-00-00 00:00:00', '2006-10-29 17:44:25'),
(2, 'user', 'd6ed7ca0720aaba96e4674098d61aad9', 'm', 'dddd', 'dddd', 'dddd', '', 0, 'new', '', '0000-00-00 00:00:00', '2006-10-27 07:42:57'),
(3, 'cust', '3aad3506aa11f05f265ea8304b8152b3', 'f', 'dddd', '13684987661', 'arzen1013@163.com', '', 0, 'deleted', '', '0000-00-00 00:00:00', '2006-10-28 16:08:03');
