-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ��������: 2006 �� 09 �� 19 �� 22:01
-- �������汾: 4.0.26
-- PHP �汾: 4.4.2
-- 
-- ���ݿ�: `dev_apf`
-- 

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_news_category`
-- 

CREATE TABLE `apf_news_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(60) default NULL,
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- �������е����� `apf_news_category`
-- 

INSERT INTO `apf_news_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'fsafsaf', 'deleted', '', '2006-09-19 21:57:51', '0000-00-00 00:00:00');

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
  `active` varchar(8) NOT NULL default 'new',
  `add_ip` varchar(24) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `update_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- �������е����� `apf_users`
-- 

