-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ��������: 2006 �� 10 �� 06 �� 18:37
-- �������汾: 4.0.26
-- PHP �汾: 4.4.2
-- 
-- ���ݿ�: `dev_apf`
-- 

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- �������е����� `apf_apf_users_auth_user_id_seq`
-- 

INSERT INTO `apf_apf_users_auth_user_id_seq` (`id`) VALUES (1);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_company`
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
-- �������е����� `apf_company`
-- 


-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_contact`
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
) TYPE=MyISAM AUTO_INCREMENT=45 ;

-- 
-- �������е����� `apf_contact`
-- 

INSERT INTO `apf_contact` (`id`, `category`, `company_id`, `name`, `gender`, `birthday`, `addrees`, `office_phone`, `phone`, `fax`, `mobile`, `email`, `photo`, `homepage`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 1, NULL, '��Զ��', 'm', '1981-10-13', '��������', '0755-83818420', '0755-83818420', '0755-83818420', '13684987661', 'arzen1013@gmail.com', NULL, 'http://www.518ic.com', 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 0, '�Ž�', 'f', '1981-04-06', '�㶫����', '0755-83818420', '0755-83818420', '0755-83818420', '13537699656', '', NULL, '', 'live', '', '0000-00-00 00:00:00', '2006-09-28 07:18:52'),
(3, NULL, NULL, '��ɳ����', NULL, NULL, NULL, NULL, '83445211\r\n', NULL, '26196703', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, NULL, NULL, 'ʯ������', NULL, NULL, NULL, NULL, '83822115\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13600187159', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, NULL, NULL, '�˹�', NULL, NULL, NULL, NULL, '\r\n', NULL, '13715463314', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13480165949', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, NULL, NULL, 'Τ����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13530252860', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, NULL, NULL, 'ҦС��', NULL, NULL, NULL, NULL, '\r\n', NULL, '13714677877', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, NULL, NULL, '������', NULL, NULL, NULL, NULL, '26389591\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, NULL, NULL, '������', NULL, NULL, NULL, NULL, '81327585\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, NULL, NULL, '����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13927436844', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13148861982', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, NULL, NULL, 'С��', NULL, NULL, NULL, NULL, '\r\n', NULL, '13246680820', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, NULL, NULL, '�Ĳ�����', NULL, NULL, NULL, NULL, '0774-3320385\r\n', NULL, '13737413079', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, NULL, NULL, '��Զ��', NULL, NULL, NULL, NULL, '5860529��07712694246\r\n', NULL, '0771-3960257', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, NULL, NULL, 'ŷ��', NULL, NULL, NULL, NULL, '\r\n', NULL, '13715432608', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13674073556', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, NULL, NULL, '�࿡', NULL, NULL, NULL, NULL, '\r\n', NULL, '13018575100', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, NULL, NULL, '����ȼ��', NULL, NULL, NULL, NULL, '26613249\r\n', NULL, '26520388', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, NULL, NULL, '����ȼ��', NULL, NULL, NULL, NULL, '83800000\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, NULL, NULL, '��һ�ֳ�', NULL, NULL, NULL, NULL, '88310111\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, NULL, NULL, '������', NULL, NULL, NULL, NULL, '83818418\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, NULL, NULL, '�ܺ�Ҷ', NULL, NULL, NULL, NULL, '0755-83203420\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, NULL, NULL, '��ΰ��', NULL, NULL, NULL, NULL, '\r\n', NULL, '13192657839', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, NULL, NULL, 'ţ��', NULL, NULL, NULL, NULL, '\r\n', NULL, '13424404233', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13077820202', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, NULL, NULL, '����', NULL, NULL, NULL, NULL, '0731-7483549\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, NULL, NULL, '���׾�', NULL, NULL, NULL, NULL, '\r\n', NULL, '13823105250', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, NULL, NULL, '�Ƴн�', NULL, NULL, NULL, NULL, '13824353610\r\n', NULL, '13048985316', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13929535792', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, NULL, NULL, '�����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13668554221', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, NULL, NULL, 'Ī����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13676176870', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13610468457', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, NULL, NULL, '�����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13691680459', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, NULL, NULL, '���', NULL, NULL, NULL, NULL, '\r\n', NULL, '13662642753', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, NULL, NULL, '����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13242971795', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, NULL, NULL, '����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13728796000', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, NULL, NULL, '������', NULL, NULL, NULL, NULL, '13707714200\r\n', NULL, '13737443260', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, NULL, NULL, 'ľͷ', NULL, NULL, NULL, NULL, '\r\n', NULL, '13907735764', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, NULL, NULL, 'Τ����', NULL, NULL, NULL, NULL, '\r\n', NULL, '13620414411', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, NULL, NULL, '������', NULL, NULL, NULL, NULL, '\r\n', NULL, '13152687920', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, NULL, NULL, '�ż���', NULL, NULL, NULL, NULL, '', NULL, '13978417961', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 0, 'ʯ�����巿��', 'm', NULL, '�㶫���ڸ�����ίʯ������163��', '', '0755-83824509', '', '', '', NULL, '', 'live', '', '2006-09-28 07:15:46', '2006-09-28 07:16:44');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_contact_category`
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
-- �������е����� `apf_contact_category`
-- 

INSERT INTO `apf_contact_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, '����', 'new', '', '0000-00-00 00:00:00', '2006-09-23 11:24:12'),
(2, 'ͬ��', 'live', '', '2006-09-23 11:24:22', '0000-00-00 00:00:00'),
(3, 'ͬѧ', 'live', '', '2006-09-23 11:24:39', '0000-00-00 00:00:00'),
(4, '��������', 'live', '', '2006-09-23 11:28:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_finance`
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
-- �������е����� `apf_finance`
-- 

INSERT INTO `apf_finance` (`id`, `category`, `create_date`, `amount`, `debit`, `money`, `memo`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 2, '2006-09-23', 1, 'P', 599.00, '', 'new', '', '0000-00-00 00:00:00', '2006-09-23 18:18:34'),
(2, 1, '2006-09-23', 2, 'P', 287956.00, '', 'new', '', '0000-00-00 00:00:00', '2006-09-23 18:20:59');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_finance_category`
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
-- �������е����� `apf_finance_category`
-- 

INSERT INTO `apf_finance_category` (`id`, `category_name`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, '����', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:06'),
(2, '�ⵥ', 'live', '', '0000-00-00 00:00:00', '2006-09-23 15:20:18');

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

INSERT INTO `apf_grouprights` (`group_id`, `right_id`, `right_level`) VALUES (3, 1, 3),
(1, 1, 3),
(2, 2, 3);

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
-- ��Ľṹ `apf_groups_group_id_seq`
-- 

CREATE TABLE `apf_groups_group_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- �������е����� `apf_groups_group_id_seq`
-- 

INSERT INTO `apf_groups_group_id_seq` (`id`) VALUES (1);

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

INSERT INTO `apf_groupusers` (`perm_user_id`, `group_id`) VALUES (1, 2),
(2, 1),
(2, 3);

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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- �������е����� `apf_news`
-- 

INSERT INTO `apf_news` (`id`, `category_id`, `title`, `content`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 2, 'TESTSESTEST', '<ul><li>TESTSE<sup>STE</sup>ST<strike><strong>T<font color="#ff0000">E</font><font color="#ff0000">STSESTES</font>TTESTSESTEST</strong></strike><strike><strong><span style="background-color: #339999">STSESTEST</span></strong></strike><strike><strong>TE</strong></strike></li><li><br /></li><li><strong>18:25:25  2006-10-06</strong></li></ul>', 'live', '', '0000-00-00 00:00:00', '2006-10-06 18:32:18'),
(2, 2, 'TinyMCE', '<table border="0" cellspacing="0" cellpadding="0" width="750"><tbody><tr valign="top"><td width="15"><img src="http://image2.sina.com.cn/dy/nc62602.gif" alt="" width="15" height="16" /></td> <td width="735"> 	<table border="0" cellspacing="0" cellpadding="0" width="100%"> 	<tbody><tr><td bgcolor="#003fb7"><img src="http://image2.sina.com.cn/dy/nc62603.gif" alt="" width="104" height="3" /></td></tr> 	</tbody></table></td></tr> </tbody></table>    <table border="0" cellspacing="0" cellpadding="0" width="750"><tbody><tr valign="top"><td width="281"> 	 	<table border="0" cellspacing="0" cellpadding="0" width="281"> 	<tbody><tr valign="top">  	 	 <td width="3" bgcolor="#003cb2"><img src="http://image2.sina.com.cn/dy/nc62604.gif" alt="" width="3" height="139" /></td> 	  	 	<td width="278" align="right"> 	<!--START:����ͼ--> 		<!--#config errmsg=""--> 		<!--include virtual="/FocusPic/index.html"--> 	<table border="0" cellspacing="0" cellpadding="0"> 			<tbody><tr><td><!--[1,124,1] published at 2006-10-06 10:32:38 from #012 by 44--> <a href="http://news.sina.com.cn/c/p/2006-10-06/102411169882.shtml" target="_blank"><!--����������������¬������--><img style="border-color: #000000; color: #000000; margin-bottom: 15px" src="http://image2.sina.com.cn/dy/FocusPic/U44P1T124D1F2633DT20061006103238.jpg" border="1" alt="����������������¬������" width="263" height="198" /></a></td></tr>		 			</tbody></table> 	<!--END:����ͼ--> 	</td></tr> 	</tbody></table> 	 	<!--START:���˹۲�--> 			<table border="0" cellspacing="0" cellpadding="0">  	<tbody><tr><td width="242" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/news_pic1.gif" border="0" alt="��Ƶ����" width="118" height="22" /></a></td> 	<td width="39" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0125/news_lp_002.gif" border="0" alt="����" width="29" height="10" /></a></td> 	</tr> 	</tbody></table> 	<table border="0" cellspacing="0" cellpadding="0" width="281" style="border-style: none solid solid; border-color: -moz-use-text-color rgb(198, 28, 6) rgb(198, 28, 6); border-width: medium 1px 1px"> 	<tbody><tr><td colspan="2" style="padding-left: 6px; padding-top: 1px; padding-bottom: 4px" bgcolor="#f0f0f0"> 		<!--��Ƶ�Ƽ�1 begin--> 		<table border="0" cellspacing="0" cellpadding="0" style="margin-top: 6px"> 			    <tbody><tr><td height="70" align="center"><a href="http://bn.sina.com.cn/banquet/" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2006-01-25/69/U1503P1T69D70F1525DT20060930194819.jpg" border="1" alt="���˿�Ƶ������ӳ��ҹ�硷" width="74" height="74" /></a></td>  			           <td class="l15" style="padding-left: 8px">  	<a href="http://bn.sina.com.cn/banquet/" target="_blank"><font color="red">����������ӳ��С�յ�Ӱ��ҹ�硷</font></a> <br /> 	 	 	<a href="http://bn.sina.com.cn/24/index.shtml" target="_blank">����TV</a>:<a href="http://bn.sina.com.cn/24/index.shtml?channel=3_3" target="_blank">��ָ��ħ</a> <a href="http://bn.sina.com.cn/24/index.shtml?channel=3_12" target="_blank">�����</a> <a href="http://bn.sina.com.cn/24/index.shtml?channel=3_9" target="_blank">����֦</a><br />       	<a href="http://bn.sina.com.cn/movie/premiere/index.html" target="_blank">��ӳ�糡�����ʵ��Ӿ�������쿴</a><br /> 	 	<a href="http://bn.sina.com.cn/life/index.shtml" target="_blank">����</a>��<a href="http://bn.sina.com.cn/life/2006-10-02/142125679.html" target="_blank">��С���³�</a> <a href="http://bn.sina.com.cn/dv/guoqing.html" target="_blank">DVӰƬʮһչӳ</a><br />  	        </td> 			    </tr> 		    </tbody></table> 		<!--��Ƶ�Ƽ�1 end--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		  <tbody><tr>  			     <td class="l15" valign="top"> <a href="http://ent.sina.com.cn/bn/zongyi/" target="_blank">̨�����ս�Ŀ�ƽ��ܴ����</a> <a href="http://bn.sina.com.cn/zongyi/huigu/2.html" target="_blank">�Ҳ�-��������Ů��ʦ</a><br />       <a href="http://bn.sina.com.cn/zongyi/huigu/5.html" target="_blank">���հ˵㵳-�����ͳ���</a>        <a href="http://bn.sina.com.cn/zongyi/huigu/11.html" target="_blank">ҹ��Ů����-��������</a></td> 		  </tr> 				</tbody></table> 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		<tbody><tr><td height="1">&nbsp;</td></tr> 		<tr>       	    <td class="l15">       	       <!--��Ƶ�Ƽ�2 begin--> 		<table border="0" cellspacing="0" cellpadding="0" style="margin-top: 2px"> 			    <tbody><tr><td width="15" height="70" align="center" bgcolor="#cc0000"><a href="http://bn.sina.com.cn/vipchat/" target="_blank"><font color="#ffffff"><strong>��<br />��<br />��<br /≯</strong></font></a></td><td style="padding-right: 3px">&nbsp;</td><td align="center"><a href="http://bn.sina.com.cn/vipchat/" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2004-07-07/69/U1810P1T69D48F1525DT20060930111753.jpg" border="1" alt="��С�����о��ġ�ҹ�硷" width="54" height="74" /></a></td>  			      <td class="l15" style="padding-left: 8px"> <a href="http://bn.sina.com.cn/vipchat/" target="_blank">ʵ¼</a> <a href="http://bn.sina.com.cn/vipchat/" target="_blank">��С�����о��ġ�ҹ�硷</a><br />  <a href="http://ent.sina.com.cn/y/2006-09-30/09141270134.html" target="_blank">��ޱ����ƶ��߷������Ů����</a><br />  <a href="http://ent.sina.com.cn/y/2006-09-28/17521267463.html" target="_blank">���������µ�</a> <a href="http://eladies.sina.com.cn/zc/v/2006/0927/1642302405.html" target="_blank">���ܾ�̸�ذ��鷿</a><br />  <a href="http://blog.sina.com.cn/lm/8/2006/0930/8753.html" target="_blank">��������������ָ���»��Ĳ���</a><br />   	    </td> 			    </tr> 		    </tbody></table> 		<!--��Ƶ�Ƽ�2 end--> 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		  <tbody><tr>  			<td class="l15" valign="top"> 		 <a href="http://bn.sina.com.cn/pv/" target="_blank">�����۾�����Ϸ�ĺ��̫�ֲ���</a> <a href="http://bn.sina.com.cn/bbs/p/2006/0930/11071463.html" target="_blank">�����һ�����Ů</a> <br />    		<a href="http://bn.sina.com.cn/dv/" target="_blank">�Թ�</a> <a href="http://bn.sina.com.cn/dv/guoqing.html" target="_blank">ʮһ����ӰƬ</a> <a href="http://bn.sina.com.cn/pv/mts/index.html" target="_blank">����˼��Ц�����޽�������</a><br /> 		   			</td> 		  </tr>  		</tbody></table>                 <!-- $ {���˹۲���}--> 		  <!--$ {������ҳ��Ƹ��Ϣ}-->       	               	    </td></tr> 		<tr><td height="1">&nbsp;</td></tr> 		</tbody></table> 	</td></tr> 	</tbody></table> 	<!--END:���˹۲�--> 	 </td> <td width="339" align="center">   <!-- function GetObj(objName){ 	if(document.getElementById){ 		return eval(''document.getElementById("'' + objName + ''")''); 	}else if(document.layers){ 		return eval("document.layers[''" + objName +"'']"); 	}else{ 		return eval(''document.all.'' + objName); 	} } //-->   <div id="focus1" class="l16"> <!--START:Ҫ��--> <!--#config errmsg=""--> <!--[1,83,1] published at 2006-10-06 18:26:42 from #012 by 1044--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="319"> 		<tbody><tr bgcolor="#c61c06"><td width="9" bgcolor="#ffffff">&nbsp;</td><td width="180" height="21"><img src="http://image2.sina.com.cn/dy/nc62606.gif" alt="" hspace="6" width="31" height="15" /></td><td width="130" style="padding-top: 4px"><font color="#ffffff">����ʱ�䣺2006.10.06</font></td></tr> <tr><td height="3">&nbsp;</td></tr> 		</tbody></table> 		 		<!--����� ��ʼ-->		 		<!--����� ����--> 		<!----�˲���Ϊ������ҳҪ��������---->    <!--ͼƬ����λ ��ʼ1-->  <table border="0" cellspacing="0" cellpadding="0" width="319">  <tbody><tr><td width="9">&nbsp;</td><td width="310" align="center">   <!--��2--> <table border="0" cellspacing="0" cellpadding="0" width="310" style="border: 1px solid #b8b8b8" bgcolor="#ecf3ff">    <tbody><tr><td height="4">&nbsp;</td></tr>     <tr><td align="center">      <a href="http://news.sina.com.cn/z/cxjxhsy/index.shtml" target="_blank"><font style="font-size: 18px; font-family: ����" color="black">�����ͶԳ��������ݰ����һ��</font></a></td></tr>   <tr><td class="l15" style="padding-left: 4px"><!--��3-->   [<a href="http://news.sina.com.cn/w/2006-10-06/111210170944s.shtml" target="_blank">�������籾��ĩ������</a>][<a href="http://news.sina.com.cn/w/2006-10-06/141410171470s.shtml" target="_blank">�����սӼ����������ָ�ӹ�</a>]<br />   [<a href="http://news.sina.com.cn/w/2006-10-06/063010169307s.shtml" target="_blank">�����Ƴ��ʺ���������������</a>][<a href="http://news.sina.com.cn/w/2006-10-06/094610170296s.shtml" target="_blank">��̫�����������·�Ӧ</a>]<br />  </td></tr></tbody></table>  <!--��4-->  </td></tr> </tbody></table>  <!--ͼƬ����λ ����-->  <!--�ص�����1��λ ��ʼ-->	 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td class="l16">&nbsp;</td></tr> </tbody></table>  <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/z/wmswwmbw/index.shtml" target="_blank">��������</a> <a href="http://news.sina.com.cn/z/daodejianshe/index.shtml" target="_blank">���½���֪ʶ����</a> <a href="http://news.sina.com.cn/z/dyxjx/index.shtml" target="_blank">������г���</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-04/141310164079s.shtml" target="_blank">¬����13�շû�</a> <a href="http://news.sina.com.cn/c/2006-10-04/143211163087.shtml" target="_blank">����8�շû�</a> <a href="http://news.sina.com.cn/w/2006-10-06/003211167469.shtml" target="_blank">�������ܲ��ɷ�</a><br />   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">  <span class="f12">��[<a href="http://news.sina.com.cn/w/2006-10-05/233611167339.shtml" target="_blank">�չ����ڴ����й�ϵ����</a>][<a href="http://news.sina.com.cn/c/2006-10-06/025311167982.shtml" target="_blank">ר�ҷ������������к�����</a>]</span><br />  </td></tr></tbody></table>   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank">�ƽ��ܷ��̸߷��γ�</a> <a href="http://news.sina.com.cn/c/2006-10-06/012011168180.shtml" target="_blank">����</a> <a href="http://news.sina.com.cn/c/2006-10-06/003511167473.shtml" target="_blank">���ݿ���ǿ������</a><br />    <!--���� ��ʼ--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--���� ����-->  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-06/151810171645s.shtml" target="_blank">�й����Ӵ����ȹ�ע��������Ⱥ��ƶ����δ��</a><br />   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-06/003811167478.shtml" target="_blank">�й������������Ʊ����2008��ǰ�Ե�</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/edu/2006-10-06/005211167496.shtml" target="_blank">������̩��ʿ��ȫ���ѧ���а��14λ</a> <a href="http://news.sina.com.cn/edu/2006-10-06/174011171286.shtml" target="_blank">У����Ӧ</a><br />  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-05/192711167142.shtml" target="_blank">�����⽫��ҽ��Ϊ��ҽ�걨�����Ų�</a><br />   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/w/2006-10-06/103910170818s.shtml" target="_blank">������200�����б������ģ��ս����(ͼ)</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://sports.sina.com.cn/z/ql_shock/" target="_blank">ʵ����Ա�����ϴ��ȶ���</a> <a href="http://sports.sina.com.cn/j/2006-10-06/07492491971.shtml" target="_blank">֪���߷���������й�</a><br />  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-06/131410171364s.shtml" target="_blank">��������ʱ���ӪԤ���ƶȷ�������������̨</a><br />   <!--���� ��ʼ--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--���� ����-->  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/z/2006newsreview/index.html" target="_blank">1-9�¸�Ƶ�����ʻع�</a> <a href="http://news.sina.com.cn/06/china/january.html" target="_blank">����Ҫ��</a> <a href="http://news.sina.com.cn/06/world/january.html" target="_blank">����Ҫ�Żع�</a><br />   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-06/020411167812.shtml" target="_blank">���������³������ص�</a> <a href="http://ent.sina.com.cn/f/cctvzhq2006/index.shtml" target="_blank">20:00ֱ�������������</a><br />     <font class="f7" color="#00349a">��</font> <a href="http://sports.sina.com.cn/2006f1boat/" target="_blank"><font color="red">F1Ħ��ͧ�������ɶ�վ���������</font></a> <a href="http://sports.sina.com.cn/z/coxshow/" target="_blank">���˶���ѡ��</a><br />  </td></tr> </tbody></table> <!--�ص�����1��λ ����--> 		 	 <!--END:Ҫ��-->   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16" colspan="2">  	 <span class="f7">��</span> <a href="http://blog.sina.com.cn/main/" target="_blank">����</a>��<a href="http://blog.sina.com.cn/m/chensongling" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/kelan" target="_blank">����</a> <a href="http://blog.sina.com.cn/m/meiting" target="_blank">÷��</a> <a href="http://blog.sina.com.cn/m/linxinru" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/jiaoenjun" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/zhanghuali" target="_blank">�Ż���</a><br /> 	 </td></tr> <tr><td class="l16">  	 <!--������ҳ���ݸ��£����ܳ���16.5����-->  <span class="f7">��</span> <a href="http://blog.sina.com.cn/lm/guoqing/travel.html" target="_blank">����ָ��</a> <a href="http://blog.sina.com.cn/lm/z/06supergirl/index.html" target="_blank">��ŮPK����</a> <a href="http://blog.sina.com.cn/lm/z/huigu/index.html" target="_blank">��������ع�</a><br /> 	 </td> 	<td> 		<table border="0" cellspacing="0" align="right"> 		<tbody><tr> 		<td width="11">&nbsp;</td> 		<td class="linkBlue" width="60" align="center" style="padding-top: 2px"><a href="javascript:void(1)">����Ҫ��</a></td> 		</tr> 		</tbody></table>		 	</td> </tr> <tr><td height="2">&nbsp;</td></tr> </tbody></table>   </div> <!-- div01 end --> <!-- div02 begin --> <div id="focus2" class="l16" style="display: none">  		<!--[1,83,1] published at 2006-10-06 08:47:27 from #012 by 1044--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="319"> 		<tbody><tr bgcolor="#c61c06"><td width="9" bgcolor="#ffffff">&nbsp;</td><td width="180" height="21"><img src="http://image2.sina.com.cn/dy/nc62606.gif" alt="" hspace="6" width="31" height="15" /><br /></td><td width="130" style="padding-top: 4px"><font color="#ffffff">����ʱ�䣺2006.10.06</font><br /></td></tr> <tr><td height="3">&nbsp;</td></tr> 		</tbody></table> 		 		<!--����� ��ʼ-->		 		<!--����� ����--> 		<!----�˲���Ϊ������ҳҪ��������---->    <!--ͼƬ����λ ��ʼ1-->  <table border="0" cellspacing="0" cellpadding="0" width="319">  <tbody><tr><td width="9">&nbsp;</td><td width="310" align="center">   <!--��2--> <table border="0" cellspacing="0" cellpadding="0" width="310" style="border: 1px solid #b8b8b8" bgcolor="#ecf3ff">    <tbody><tr><td height="4">&nbsp;</td></tr>     <tr><td align="center">      <a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank"><font style="font-size: 18px; font-family: ����" color="black">�ƽ��ܷ��̸߷��γ�</font></a><br /></td></tr>   <tr><td class="l15" style="padding-left: 4px"><!--��3-->   [<a href="http://news.sina.com.cn/c/2006-10-06/012011168180.shtml" target="_blank">����</a> <a href="http://news.sina.com.cn/c/2006-10-06/022710168471s.shtml" target="_blank">����</a> <a href="http://news.sina.com.cn/c/2006-10-06/003511167473.shtml" target="_blank">���ݿ���ǿ������</a>][<a href="http://news.sina.com.cn/c/2006-10-05/210911167206.shtml" target="_blank">�οͽӴ��߷����</a>]<br />   [<a href="http://news.sina.com.cn/c/2006-10-06/020411167812.shtml" target="_blank">���������������ص�</a>][<a href="http://ent.sina.com.cn/f/cctvzhq2006/index.shtml" target="_blank">20:00��Ƶֱ�������������</a>]<br />  <br /></td></tr></tbody></table>  <!--��4-->  <br /></td></tr> </tbody></table>  <!--ͼƬ����λ ����-->  <!--�ص�����1��λ ��ʼ-->	 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td class="l16">&nbsp;</td></tr> </tbody></table>  <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/z/wmswwmbw/index.shtml" target="_blank">��������</a> <a href="http://news.sina.com.cn/z/daodejianshe/index.shtml" target="_blank">���½���֪ʶ����</a> <a href="http://news.sina.com.cn/z/dyxjx/index.shtml" target="_blank">������г���</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-04/141310164079s.shtml" target="_blank">¬����13�շû�</a> <a href="http://news.sina.com.cn/c/2006-10-04/143211163087.shtml" target="_blank">����8�շû�</a> <a href="http://news.sina.com.cn/w/2006-10-06/003211167469.shtml" target="_blank">�������ܲ��ɷ�</a><br />   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">  <span class="f12">��[<a href="http://news.sina.com.cn/w/2006-10-05/233611167339.shtml" target="_blank">�չ����ڴ����й�ϵ����</a>][<a href="http://news.sina.com.cn/c/2006-10-06/025311167982.shtml" target="_blank">ר�ҷ������������к�����</a>]</span><br />  <br /></td></tr></tbody></table>   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/w/2006-10-06/073310169411s.shtml" target="_blank">�����ⳤ���ܷó�</a> <a href="http://news.sina.com.cn/w/2006-10-06/063010169307s.shtml" target="_blank">�����Ƴ��ʺ���������������</a><br />    <!--���� ��ʼ--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--���� ����-->  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/z/2006newsreview/index.html" target="_blank">1-9�¸�Ƶ�����ʻع�</a> <a href="http://news.sina.com.cn/06/china/january.html" target="_blank">����Ҫ��</a> <a href="http://news.sina.com.cn/06/world/january.html" target="_blank">����Ҫ�Żع�</a><br />  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-06/003811167478.shtml" target="_blank">�й������������Ʊ����2008��ǰ�Ե�</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-05/234711167340.shtml" target="_blank">�����õ��Թ��ƺ�ר�õ����������˽�ͨ����</a><br />   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/edu/2006-10-06/005211167496.shtml" target="_blank">Ӣ��ý�幫����ѧ���а� �����ŵ�һ�����ʮ��</a><br />  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-05/192711167142.shtml" target="_blank">�����⽫��ҽ��Ϊ��ҽ�걨�����Ų�</a><br />   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/w/2006-10-06/015510168369s.shtml" target="_blank">ŷ��11�������Ʒɻ��˿�����Я��Һ̬��Ʒ</a><br />  <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/w/2006-10-05/234711167345.shtml" target="_blank">���������˻���ͷĿ���������Ժ�С</a> <a href="http://news.sina.com.cn/w/2006-10-05/174910167797s.shtml" target="_blank">�����DNA</a><br />  <!--���� ��ʼ--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--���� ����-->   <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/2006-10-05/231511167329.shtml" target="_blank">���ݼ�����ΧŹ���飺��������֯�ɳ�����˽��</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://news.sina.com.cn/c/l/2006-10-05/225511167319.shtml" target="_blank">˾������ײ���� ��Ժ�г����渶�⳥����������</a><br />    <font class="f7" color="#00349a">��</font> <a href="http://sports.sina.com.cn/2006f1boat/" target="_blank"><font color="red">F1Ħ��ͧ�������ɶ�վ���������</font></a> <a href="http://sports.sina.com.cn/z/coxshow/" target="_blank">���˶���ѡ��</a><br />  <br /></td></tr> </tbody></table> <!--�ص�����1��λ ����--> 		 	 		<!--tech start--> 		 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16" colspan="2"><span class="f7">��</span> <a href="http://blog.sina.com.cn/main/" target="_blank">����</a>��<a href="http://blog.sina.com.cn/m/chensongling" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/kelan" target="_blank">����</a> <a href="http://blog.sina.com.cn/m/meiting" target="_blank">÷��</a> <a href="http://blog.sina.com.cn/m/linxinru" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/jiaoenjun" target="_blank">������</a> <a href="http://blog.sina.com.cn/m/zhanghuali" target="_blank">�Ż���</a><br /><br /></td></tr> <tr><td class="l16"> <!--������ҳ���ݸ��£����ܳ���16.5����-->  <span class="f7">��</span> <a href="http://blog.sina.com.cn/lm/guoqing/travel.html" target="_blank">����ָ��</a> <a href="http://blog.sina.com.cn/lm/z/06supergirl/index.html" target="_blank">��ŮPK����</a> <a href="http://blog.sina.com.cn/lm/z/huigu/index.html" target="_blank">��������ع�</a><br /> <br /></td>  	<td> 		<table border="0" cellspacing="0" align="right"> 		<tbody><tr> 		<td width="11">&nbsp;</td> 		<td class="linkBlue" width="60" align="center" style="padding-top: 2px"><a href="javascript:void(2)">����</a><br /></td> 		</tr> 		</tbody></table> 	<br /></td>  </tr> <tr><td height="2">&nbsp;</td></tr> </tbody></table> 		 </div> <!-- div02 end -->  </td>  <td width="1" bgcolor="#969696">&nbsp;</td> <td width="128" align="center"> 			 	<!--�Ƽ����� start-->	 		<!--�Ƽ����� start-->	 	<table border="0" cellspacing="0" width="100%" bgcolor="#f0f0f0"> 	<tbody><tr><td width="100%" height="75" align="center" valign="top"> 		<table border="0" cellspacing="0" cellpadding="0" width="124"> 		<tbody><tr><td height="21" align="center" bgcolor="#7e7e7e"><a href="http://news.sina.com.cn/z/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0125/news_lp_003.gif" border="0" alt="" width="64" height="14" /></a></td></tr></tbody></table>  		<table border="0" cellspacing="0" cellpadding="0" width="123"> 		  <tbody><tr> 			<td height="2">&nbsp;</td> 		  </tr> 		  <tr> 			<td width="43" align="center" valign="top"><a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/temp/119/2006-01-24/U1075P1T119D39F2656DT20060930142611.jpg" border="1" alt="" hspace="2" vspace="2" width="41" height="41" /></a></td> 			<td width="2">&nbsp;</td> 			<td class="l15" width="78"><a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank">2006������</a><br /><a href="http://news.sina.com.cn/z/photo/06/octho2006/index.shtml" target="_blank">ͼ��</a> <a href="http://news.sina.com.cn/z/video/octho2006/index.shtml" target="_blank">��Ƶ</a></td> 		  </tr> <tr><td height="6">&nbsp;</td></tr> 		<tr> 			<td class="l15" colspan="3"><p>  <a href="http://ent.sina.com.cn/f/h/shiyi/index.shtml" target="_blank">Ӱ����Ѷ</a> <a href="http://sports.sina.com.cn/z/gqtk2006.html" target="_blank">��������</a><br />  <a href="http://news.sina.com.cn/z/tiyanhuangjinzhou/index.shtml" target="_blank">CCTV-4�����ƽ�������</a><br /> 			</p></td> 		  </tr> 		</tbody></table> 	</td></tr> 	</tbody></table><table border="0" cellspacing="0" width="100%"> 	<tbody><tr><td width="100%" height="84" align="center" valign="top">  		<table border="0" cellspacing="0" cellpadding="0" width="123"> 		  <tbody><tr> 			<td height="2">&nbsp;</td> 		  </tr> 		  <!--<tr> 			<td width=43 valign=top align=center><a href=http://news.sina.com.cn/z/rongru/index.shtml target=_blank class=c03><img src=http://image2.sina.com.cn/dy/temp/119/2006-01-24/U1075P1T119D39F5157DT20060421095323.jpg border=1 width=41 height=41 vspace=2 hspace=2 class=c03></a></td> 			<td width=2></td> 			<td width=78 class=l15><a class=news3 href=http://news.sina.com.cn/z/rongru/index.shtml target=_blank>�����������<br>�����</a> <a href=http://comment4.news.sina.com.cn/comment/skin/default.html?channel=gn&newsid=1-63-2341&style=1&nice=0&rid=0&page=0&face=&hot=gn_default class=news3  target=_blank>����</a></a> 		 </td> 		  </tr>--> 		  <tr> 			<td class="l15" colspan="3"><p>  <a href="http://news.sina.com.cn/z/nobel2006/index.shtml" target="_blank">2006��ŵ������</a><br /> <a href="http://news.sina.com.cn/z/cxjxhsy/index.shtml" target="_blank">�������������к�����</a><br />    <a href="http://news.sina.com.cn/z/changzhengyijuhua/index.shtml" target="_blank">����������һ�仰</a><br />  <a href="http://ent.sina.com.cn/f/y/06supergirl/index.shtml" target="_blank">06����Ů������漶��</a><br /> <a href="http://sports.sina.com.cn/z/0607championsleague/index.shtml" target="_blank">ŷ�޹ھ���������Ƶ</a>    			</p></td> 		  </tr> 		</tbody></table> 	</td></tr>  <tr> 			<td height="5">&nbsp;</td> 		  </tr> 	</tbody></table> 	<!--�Ƽ����� end-->     	<!--�Ƽ����� end-->           <!--$ {Ҫ���Ҳ��ȵ�ר���¹���}-->            <table border="0" cellspacing="0" cellpadding="0" width="123"> 	<tbody><tr><td height="19" align="center" valign="center" style="padding-top: 3px; padding-left: 2px" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0930/news_modi062425_05.gif" border="0" alt="" width="64" height="14" /></a></td></tr> 	<tr><td height="2" bgcolor="#c61c06">&nbsp;</td></tr> 	</tbody></table> 	<table border="0" cellspacing="0" cellpadding="0" width="123"> <tbody><tr><td height="7">&nbsp;</td></tr> <tr>     <td width="43" align="center" valign="top"> <a href="http://bn.sina.com.cn/z/7liao_6/index.shtml" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2002-12-11/69/U1396P1T69D27F1525DT20061006165320.jpg" border="1" alt="" hspace="2" vspace="2" width="41" height="41" /></a></td> <td width="2">&nbsp;</td>                <td class="l15" width="78" align="center"><a href="http://bn.sina.com.cn/z/7liao_6/index.shtml" target="_blank">����������<br />��������</a></td>   </tr>   <tr>     <td class="l15" colspan="3">	 	<a href="http://iask.sina.com.cn/info/iask_travel_060930.html" target="_blank">���������н�֪ʶ�ʴ�</a><br /> 	<a href="http://bn.sina.com.cn/tvs/2006-09-30/141325657.html" target="_blank">���֮�ã�����Ķ�ȹ</a><br /> 	 	<a href="http://bn.sina.com.cn/tvs/2006-09-29/151125574.html" target="_blank">������д��Ů�������</a><br />	 	<a href="http://bn.sina.com.cn/dv/ucvideo/index.shtml" target="_blank">UC��Ů����������Ƶ��</a><br /> 	<a href="http://bn.sina.com.cn/z/ansuan/index.shtml" target="_blank">���Ӿ�-����</a> <a href="http://bn.sina.com.cn/z/wulinwaizhuanonline/" target="_blank">�����⴫</a><br /> 	<a href="http://cctv.sina.com.cn/" target="_blank">CCTV��Ŀ���������</a></td></tr></tbody></table></td></tr></tbody></table>', 'new', '', '2006-10-06 18:34:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_news_category`
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
-- �������е����� `apf_news_category`
-- 

INSERT INTO `apf_news_category` (`id`, `category_name`, `orderid`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'local news', 2, 'deleted', '', '2006-09-22 22:08:59', '0000-00-00 00:00:00'),
(2, 'chinese news', 1, 'new', '', '2006-09-22 22:09:21', '0000-00-00 00:00:00');

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
(2, '2', 'DB', 1);

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_perm_users_perm_user_id_seq`
-- 

CREATE TABLE `apf_perm_users_perm_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- �������е����� `apf_perm_users_perm_user_id_seq`
-- 

INSERT INTO `apf_perm_users_perm_user_id_seq` (`id`) VALUES (2);

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- �������е����� `apf_product`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- �������е����� `apf_product_category`
-- 


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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- �������е����� `apf_users`
-- 

INSERT INTO `apf_users` (`id`, `user_name`, `user_pwd`, `gender`, `addrees`, `phone`, `email`, `photo`, `role_id`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'test', 'test', 'f', 'test', 'test', 'test', 'test', 1, 'new', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'dddd', 'dddd', 'm', 'dddd', 'dddd', 'dddd', 'dddd', 0, 'live', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- ��Ľṹ `apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- �������е����� `apf_users_auth_user_id_seq`
-- 

INSERT INTO `apf_users_auth_user_id_seq` (`id`) VALUES (2);
