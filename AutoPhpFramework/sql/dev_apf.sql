-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2006 年 10 月 06 日 18:37
-- 服务器版本: 4.0.26
-- PHP 版本: 4.4.2
-- 
-- 数据库: `dev_apf`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_apf_users_auth_user_id_seq`
-- 

INSERT INTO `apf_apf_users_auth_user_id_seq` (`id`) VALUES (1);

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
) TYPE=MyISAM AUTO_INCREMENT=45 ;

-- 
-- 导出表中的数据 `apf_contact`
-- 

INSERT INTO `apf_contact` (`id`, `category`, `company_id`, `name`, `gender`, `birthday`, `addrees`, `office_phone`, `phone`, `fax`, `mobile`, `email`, `photo`, `homepage`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 1, NULL, '孟远螓', 'm', '1981-10-13', '广西贺州', '0755-83818420', '0755-83818420', '0755-83818420', '13684987661', 'arzen1013@gmail.com', NULL, 'http://www.518ic.com', 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 0, '古金', 'f', '1981-04-06', '广东肇庆', '0755-83818420', '0755-83818420', '0755-83818420', '13537699656', '', NULL, '', 'live', '', '0000-00-00 00:00:00', '2006-09-28 07:18:52'),
(3, NULL, NULL, '上沙梁姨', NULL, NULL, NULL, NULL, '83445211\r\n', NULL, '26196703', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, NULL, NULL, '石厦汤姨', NULL, NULL, NULL, NULL, '83822115\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, NULL, NULL, '王李琰', NULL, NULL, NULL, NULL, '\r\n', NULL, '13600187159', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, NULL, NULL, '潘工', NULL, NULL, NULL, NULL, '\r\n', NULL, '13715463314', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, NULL, NULL, '徐先生', NULL, NULL, NULL, NULL, '\r\n', NULL, '13480165949', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, NULL, NULL, '韦先生', NULL, NULL, NULL, NULL, '\r\n', NULL, '13530252860', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, NULL, NULL, '姚小姐', NULL, NULL, NULL, NULL, '\r\n', NULL, '13714677877', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, NULL, NULL, '陈先生', NULL, NULL, NULL, NULL, '26389591\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, NULL, NULL, '杨先生', NULL, NULL, NULL, NULL, '81327585\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, NULL, NULL, '张文', NULL, NULL, NULL, NULL, '\r\n', NULL, '13927436844', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, NULL, NULL, '何丽云', NULL, NULL, NULL, NULL, '\r\n', NULL, '13148861982', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, NULL, NULL, '小曹', NULL, NULL, NULL, NULL, '\r\n', NULL, '13246680820', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, NULL, NULL, '四伯阿秋', NULL, NULL, NULL, NULL, '0774-3320385\r\n', NULL, '13737413079', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, NULL, NULL, '孟远烘', NULL, NULL, NULL, NULL, '5860529、07712694246\r\n', NULL, '0771-3960257', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, NULL, NULL, '欧阳', NULL, NULL, NULL, NULL, '\r\n', NULL, '13715432608', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, NULL, NULL, '古文卫', NULL, NULL, NULL, NULL, '\r\n', NULL, '13674073556', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, NULL, NULL, '培俊', NULL, NULL, NULL, NULL, '\r\n', NULL, '13018575100', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, NULL, NULL, '深南燃气', NULL, NULL, NULL, NULL, '26613249\r\n', NULL, '26520388', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, NULL, NULL, '深圳燃气', NULL, NULL, NULL, NULL, '83800000\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, NULL, NULL, '第一现场', NULL, NULL, NULL, NULL, '88310111\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, NULL, NULL, '蔡生娟', NULL, NULL, NULL, NULL, '83818418\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, NULL, NULL, '周红叶', NULL, NULL, NULL, NULL, '0755-83203420\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, NULL, NULL, '罗伟彬', NULL, NULL, NULL, NULL, '\r\n', NULL, '13192657839', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, NULL, NULL, '牛妹', NULL, NULL, NULL, NULL, '\r\n', NULL, '13424404233', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, NULL, NULL, '于杨敏', NULL, NULL, NULL, NULL, '\r\n', NULL, '13077820202', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, NULL, NULL, '大妹', NULL, NULL, NULL, NULL, '0731-7483549\r\n', NULL, '', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, NULL, NULL, '章献军', NULL, NULL, NULL, NULL, '\r\n', NULL, '13823105250', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, NULL, NULL, '黄承金', NULL, NULL, NULL, NULL, '13824353610\r\n', NULL, '13048985316', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, NULL, NULL, '卜创德', NULL, NULL, NULL, NULL, '\r\n', NULL, '13929535792', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, NULL, NULL, '吴家敏', NULL, NULL, NULL, NULL, '\r\n', NULL, '13668554221', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, NULL, NULL, '莫海建', NULL, NULL, NULL, NULL, '\r\n', NULL, '13676176870', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, NULL, NULL, '梁运林', NULL, NULL, NULL, NULL, '\r\n', NULL, '13610468457', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, NULL, NULL, '李桂兰', NULL, NULL, NULL, NULL, '\r\n', NULL, '13691680459', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, NULL, NULL, '冯冰', NULL, NULL, NULL, NULL, '\r\n', NULL, '13662642753', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, NULL, NULL, '阿鸟', NULL, NULL, NULL, NULL, '\r\n', NULL, '13242971795', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, NULL, NULL, '蒋哥', NULL, NULL, NULL, NULL, '\r\n', NULL, '13728796000', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, NULL, NULL, '刘超琳', NULL, NULL, NULL, NULL, '13707714200\r\n', NULL, '13737443260', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, NULL, NULL, '木头', NULL, NULL, NULL, NULL, '\r\n', NULL, '13907735764', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, NULL, NULL, '韦少玲', NULL, NULL, NULL, NULL, '\r\n', NULL, '13620414411', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, NULL, NULL, '覃明法', NULL, NULL, NULL, NULL, '\r\n', NULL, '13152687920', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, NULL, NULL, '张家明', NULL, NULL, NULL, NULL, '', NULL, '13978417961', NULL, NULL, NULL, 'new', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 0, '石厦西村房东', 'm', NULL, '广东深圳福田区委石厦西村163号', '', '0755-83824509', '', '', '', NULL, '', 'live', '', '2006-09-28 07:15:46', '2006-09-28 07:16:44');

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
-- 表的结构 `apf_grouprights`
-- 

CREATE TABLE `apf_grouprights` (
  `group_id` int(11) default '0',
  `right_id` int(11) default '0',
  `right_level` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`group_id`,`right_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `apf_grouprights`
-- 

INSERT INTO `apf_grouprights` (`group_id`, `right_id`, `right_level`) VALUES (3, 1, 3),
(1, 1, 3),
(2, 2, 3);

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

-- 
-- 导出表中的数据 `apf_groups`
-- 

INSERT INTO `apf_groups` (`group_id`, `group_type`, `group_define_name`, `is_active`, `owner_user_id`, `owner_group_id`) VALUES (2, 0, 'User', 1, 0, 0),
(1, 0, 'SuperUser', 1, 0, 0),
(3, 0, 'Customer', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groups_group_id_seq`
-- 

CREATE TABLE `apf_groups_group_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `apf_groups_group_id_seq`
-- 

INSERT INTO `apf_groups_group_id_seq` (`id`) VALUES (1);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_groupusers`
-- 

CREATE TABLE `apf_groupusers` (
  `perm_user_id` int(11) default '0',
  `group_id` int(11) default '0',
  UNIQUE KEY `id_i_idx` (`perm_user_id`,`group_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `apf_groupusers`
-- 

INSERT INTO `apf_groupusers` (`perm_user_id`, `group_id`) VALUES (1, 2),
(2, 1),
(2, 3);

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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_news`
-- 

INSERT INTO `apf_news` (`id`, `category_id`, `title`, `content`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 2, 'TESTSESTEST', '<ul><li>TESTSE<sup>STE</sup>ST<strike><strong>T<font color="#ff0000">E</font><font color="#ff0000">STSESTES</font>TTESTSESTEST</strong></strike><strike><strong><span style="background-color: #339999">STSESTEST</span></strong></strike><strike><strong>TE</strong></strike></li><li><br /></li><li><strong>18:25:25  2006-10-06</strong></li></ul>', 'live', '', '0000-00-00 00:00:00', '2006-10-06 18:32:18'),
(2, 2, 'TinyMCE', '<table border="0" cellspacing="0" cellpadding="0" width="750"><tbody><tr valign="top"><td width="15"><img src="http://image2.sina.com.cn/dy/nc62602.gif" alt="" width="15" height="16" /></td> <td width="735"> 	<table border="0" cellspacing="0" cellpadding="0" width="100%"> 	<tbody><tr><td bgcolor="#003fb7"><img src="http://image2.sina.com.cn/dy/nc62603.gif" alt="" width="104" height="3" /></td></tr> 	</tbody></table></td></tr> </tbody></table>    <table border="0" cellspacing="0" cellpadding="0" width="750"><tbody><tr valign="top"><td width="281"> 	 	<table border="0" cellspacing="0" cellpadding="0" width="281"> 	<tbody><tr valign="top">  	 	 <td width="3" bgcolor="#003cb2"><img src="http://image2.sina.com.cn/dy/nc62604.gif" alt="" width="3" height="139" /></td> 	  	 	<td width="278" align="right"> 	<!--START:焦点图--> 		<!--#config errmsg=""--> 		<!--include virtual="/FocusPic/index.html"--> 	<table border="0" cellspacing="0" cellpadding="0"> 			<tbody><tr><td><!--[1,124,1] published at 2006-10-06 10:32:38 from #012 by 44--> <a href="http://news.sina.com.cn/c/p/2006-10-06/102411169882.shtml" target="_blank"><!--北京人造月亮再现卢沟晓月--><img style="border-color: #000000; color: #000000; margin-bottom: 15px" src="http://image2.sina.com.cn/dy/FocusPic/U44P1T124D1F2633DT20061006103238.jpg" border="1" alt="北京人造月亮再现卢沟晓月" width="263" height="198" /></a></td></tr>		 			</tbody></table> 	<!--END:焦点图--> 	</td></tr> 	</tbody></table> 	 	<!--START:新浪观察--> 			<table border="0" cellspacing="0" cellpadding="0">  	<tbody><tr><td width="242" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/news_pic1.gif" border="0" alt="宽频新闻" width="118" height="22" /></a></td> 	<td width="39" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0125/news_lp_002.gif" border="0" alt="更多" width="29" height="10" /></a></td> 	</tr> 	</tbody></table> 	<table border="0" cellspacing="0" cellpadding="0" width="281" style="border-style: none solid solid; border-color: -moz-use-text-color rgb(198, 28, 6) rgb(198, 28, 6); border-width: medium 1px 1px"> 	<tbody><tr><td colspan="2" style="padding-left: 6px; padding-top: 1px; padding-bottom: 4px" bgcolor="#f0f0f0"> 		<!--宽频推荐1 begin--> 		<table border="0" cellspacing="0" cellpadding="0" style="margin-top: 6px"> 			    <tbody><tr><td height="70" align="center"><a href="http://bn.sina.com.cn/banquet/" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2006-01-25/69/U1503P1T69D70F1525DT20060930194819.jpg" border="1" alt="新浪宽频网络首映《夜宴》" width="74" height="74" /></a></td>  			           <td class="l15" style="padding-left: 8px">  	<a href="http://bn.sina.com.cn/banquet/" target="_blank"><font color="red">新浪网络首映冯小刚电影《夜宴》</font></a> <br /> 	 	 	<a href="http://bn.sina.com.cn/24/index.shtml" target="_blank">新浪TV</a>:<a href="http://bn.sina.com.cn/24/index.shtml?channel=3_3" target="_blank">六指琴魔</a> <a href="http://bn.sina.com.cn/24/index.shtml?channel=3_12" target="_blank">纪晓岚</a> <a href="http://bn.sina.com.cn/24/index.shtml?channel=3_9" target="_blank">醉打金枝</a><br />       	<a href="http://bn.sina.com.cn/movie/premiere/index.html" target="_blank">首映剧场：精彩电视剧国庆天天看</a><br /> 	 	<a href="http://bn.sina.com.cn/life/index.shtml" target="_blank">生活</a>：<a href="http://bn.sina.com.cn/life/2006-10-02/142125679.html" target="_blank">陈小春下厨</a> <a href="http://bn.sina.com.cn/dv/guoqing.html" target="_blank">DV影片十一展映</a><br />  	        </td> 			    </tr> 		    </tbody></table> 		<!--宽频推荐1 end--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		  <tbody><tr>  			     <td class="l15" valign="top"> <a href="http://ent.sina.com.cn/bn/zongyi/" target="_blank">台湾综艺节目黄金周大放送</a> <a href="http://bn.sina.com.cn/zongyi/huigu/2.html" target="_blank">我猜-靓眼麻辣女教师</a><br />       <a href="http://bn.sina.com.cn/zongyi/huigu/5.html" target="_blank">周日八点党-极限耐臭王</a>        <a href="http://bn.sina.com.cn/zongyi/huigu/11.html" target="_blank">夜来女人香-超另类兼差</a></td> 		  </tr> 				</tbody></table> 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		<tbody><tr><td height="1">&nbsp;</td></tr> 		<tr>       	    <td class="l15">       	       <!--宽频推荐2 begin--> 		<table border="0" cellspacing="0" cellpadding="0" style="margin-top: 2px"> 			    <tbody><tr><td width="15" height="70" align="center" bgcolor="#cc0000"><a href="http://bn.sina.com.cn/vipchat/" target="_blank"><font color="#ffffff"><strong>嘉<br />宾<br />访<br />谈</strong></font></a></td><td style="padding-right: 3px">&nbsp;</td><td align="center"><a href="http://bn.sina.com.cn/vipchat/" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2004-07-07/69/U1810P1T69D48F1525DT20060930111753.jpg" border="1" alt="冯小刚王中军聊《夜宴》" width="54" height="74" /></a></td>  			      <td class="l15" style="padding-left: 8px"> <a href="http://bn.sina.com.cn/vipchat/" target="_blank">实录</a> <a href="http://bn.sina.com.cn/vipchat/" target="_blank">冯小刚王中军聊《夜宴》</a><br />  <a href="http://ent.sina.com.cn/y/2006-09-30/09141270134.html" target="_blank">丁薇常宽科尔沁夫点评超女决赛</a><br />  <a href="http://ent.sina.com.cn/y/2006-09-28/17521267463.html" target="_blank">张信哲聊新碟</a> <a href="http://eladies.sina.com.cn/zc/v/2006/0927/1642302405.html" target="_blank">伊能静谈关爱乳房</a><br />  <a href="http://blog.sina.com.cn/lm/8/2006/0930/8753.html" target="_blank">好莱坞著名武术指导陈虎聊博客</a><br />   	    </td> 			    </tr> 		    </tbody></table> 		<!--宽频推荐2 end--> 		<table border="0" cellspacing="0" cellpadding="0" width="264"> 		  <tbody><tr>  			<td class="l15" valign="top"> 		 <a href="http://bn.sina.com.cn/pv/" target="_blank">蒙上眼睛玩游戏的后果太恐怖了</a> <a href="http://bn.sina.com.cn/bbs/p/2006/0930/11071463.html" target="_blank">著名桃花美少女</a> <br />    		<a href="http://bn.sina.com.cn/dv/" target="_blank">卧轨</a> <a href="http://bn.sina.com.cn/dv/guoqing.html" target="_blank">十一经典影片</a> <a href="http://bn.sina.com.cn/pv/mts/index.html" target="_blank">曼妥思搞笑大赛巨奖待高手</a><br /> 		   			</td> 		  </tr>  		</tbody></table>                 <!-- $ {新浪观察下}--> 		  <!--$ {新闻首页招聘信息}-->       	               	    </td></tr> 		<tr><td height="1">&nbsp;</td></tr> 		</tbody></table> 	</td></tr> 	</tbody></table> 	<!--END:新浪观察--> 	 </td> <td width="339" align="center">   <!-- function GetObj(objName){ 	if(document.getElementById){ 		return eval(''document.getElementById("'' + objName + ''")''); 	}else if(document.layers){ 		return eval("document.layers[''" + objName +"'']"); 	}else{ 		return eval(''document.all.'' + objName); 	} } //-->   <div id="focus1" class="l16"> <!--START:要闻--> <!--#config errmsg=""--> <!--[1,83,1] published at 2006-10-06 18:26:42 from #012 by 1044--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="319"> 		<tbody><tr bgcolor="#c61c06"><td width="9" bgcolor="#ffffff">&nbsp;</td><td width="180" height="21"><img src="http://image2.sina.com.cn/dy/nc62606.gif" alt="" hspace="6" width="31" height="15" /></td><td width="130" style="padding-top: 4px"><font color="#ffffff">北京时间：2006.10.06</font></td></tr> <tr><td height="3">&nbsp;</td></tr> 		</tbody></table> 		 		<!--走马灯 开始-->		 		<!--走马灯 结束--> 		<!----此部分为新闻首页要闻区内容---->    <!--图片文字位 开始1-->  <table border="0" cellspacing="0" cellpadding="0" width="319">  <tbody><tr><td width="9">&nbsp;</td><td width="310" align="center">   <!--勿动2--> <table border="0" cellspacing="0" cellpadding="0" width="310" style="border: 1px solid #b8b8b8" bgcolor="#ecf3ff">    <tbody><tr><td height="4">&nbsp;</td></tr>     <tr><td align="center">      <a href="http://news.sina.com.cn/z/cxjxhsy/index.shtml" target="_blank"><font style="font-size: 18px; font-family: 黑体" color="black">安理会就对朝鲜声明草案达成一致</font></a></td></tr>   <tr><td class="l15" style="padding-left: 4px"><!--勿动3-->   [<a href="http://news.sina.com.cn/w/2006-10-06/111210170944s.shtml" target="_blank">朝鲜最早本周末核试验</a>][<a href="http://news.sina.com.cn/w/2006-10-06/141410171470s.shtml" target="_blank">金正日接见朝鲜人民军指挥官</a>]<br />   [<a href="http://news.sina.com.cn/w/2006-10-06/063010169307s.shtml" target="_blank">美国称朝鲜核试验是严重挑衅</a>][<a href="http://news.sina.com.cn/w/2006-10-06/094610170296s.shtml" target="_blank">不太可能作出军事反应</a>]<br />  </td></tr></tbody></table>  <!--勿动4-->  </td></tr> </tbody></table>  <!--图片文字位 结束-->  <!--重点新闻1号位 开始-->	 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td class="l16">&nbsp;</td></tr> </tbody></table>  <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/z/wmswwmbw/index.shtml" target="_blank">文明办网</a> <a href="http://news.sina.com.cn/z/daodejianshe/index.shtml" target="_blank">道德建设知识竞赛</a> <a href="http://news.sina.com.cn/z/dyxjx/index.shtml" target="_blank">构建和谐社会</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-04/141310164079s.shtml" target="_blank">卢武铉13日访华</a> <a href="http://news.sina.com.cn/c/2006-10-04/143211163087.shtml" target="_blank">安倍8日访华</a> <a href="http://news.sina.com.cn/w/2006-10-06/003211167469.shtml" target="_blank">称日中密不可分</a><br />   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">  <span class="f12">　[<a href="http://news.sina.com.cn/w/2006-10-05/233611167339.shtml" target="_blank">日国民期待日中关系改善</a>][<a href="http://news.sina.com.cn/c/2006-10-06/025311167982.shtml" target="_blank">专家分析安倍访问中韩动机</a>]</span><br />  </td></tr></tbody></table>   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank">黄金周返程高峰形成</a> <a href="http://news.sina.com.cn/c/2006-10-06/012011168180.shtml" target="_blank">北京</a> <a href="http://news.sina.com.cn/c/2006-10-06/003511167473.shtml" target="_blank">广州客流强劲增长</a><br />    <!--红线 开始--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--红线 结束-->  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-06/151810171645s.shtml" target="_blank">中国将加大力度关注低收入人群和贫困者未来</a><br />   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-06/003811167478.shtml" target="_blank">中国竞猜型赛马彩票有望2008年前试点</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/edu/2006-10-06/005211167496.shtml" target="_blank">北大列泰晤士报全球大学排行榜第14位</a> <a href="http://news.sina.com.cn/edu/2006-10-06/174011171286.shtml" target="_blank">校方回应</a><br />  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-05/192711167142.shtml" target="_blank">韩国拟将中医改为韩医申报世界遗产</a><br />   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/w/2006-10-06/103910170818s.shtml" target="_blank">美国近200个城市爆发大规模反战游行(图)</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://sports.sina.com.cn/z/ql_shock/" target="_blank">实德球员被砍断大腿动脉</a> <a href="http://sports.sina.com.cn/j/2006-10-06/07492491971.shtml" target="_blank">知情者否认与赌球有关</a><br />  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-06/131410171364s.shtml" target="_blank">央企国有资本经营预算制度方案年内有望出台</a><br />   <!--红线 开始--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--红线 结束-->  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/z/2006newsreview/index.html" target="_blank">1-9月各频道精彩回顾</a> <a href="http://news.sina.com.cn/06/china/january.html" target="_blank">国内要闻</a> <a href="http://news.sina.com.cn/06/world/january.html" target="_blank">国际要闻回顾</a><br />   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-06/020411167812.shtml" target="_blank">今年中秋月呈三大特点</a> <a href="http://ent.sina.com.cn/f/cctvzhq2006/index.shtml" target="_blank">20:00直播央视中秋晚会</a><br />     <font class="f7" color="#00349a">●</font> <a href="http://sports.sina.com.cn/2006f1boat/" target="_blank"><font color="red">F1摩托艇世锦赛成都站吉尔曼夺冠</font></a> <a href="http://sports.sina.com.cn/z/coxshow/" target="_blank">奥运舵手选拔</a><br />  </td></tr> </tbody></table> <!--重点新闻1号位 结束--> 		 	 <!--END:要闻-->   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16" colspan="2">  	 <span class="f7">●</span> <a href="http://blog.sina.com.cn/main/" target="_blank">博客</a>：<a href="http://blog.sina.com.cn/m/chensongling" target="_blank">陈松伶</a> <a href="http://blog.sina.com.cn/m/kelan" target="_blank">柯蓝</a> <a href="http://blog.sina.com.cn/m/meiting" target="_blank">梅婷</a> <a href="http://blog.sina.com.cn/m/linxinru" target="_blank">林心如</a> <a href="http://blog.sina.com.cn/m/jiaoenjun" target="_blank">焦恩俊</a> <a href="http://blog.sina.com.cn/m/zhanghuali" target="_blank">张华立</a><br /> 	 </td></tr> <tr><td class="l16">  	 <!--新闻首页内容更新，不能超过16.5个字-->  <span class="f7">●</span> <a href="http://blog.sina.com.cn/lm/guoqing/travel.html" target="_blank">旅游指南</a> <a href="http://blog.sina.com.cn/lm/z/06supergirl/index.html" target="_blank">超女PK历程</a> <a href="http://blog.sina.com.cn/lm/z/huigu/index.html" target="_blank">博客周年回顾</a><br /> 	 </td> 	<td> 		<table border="0" cellspacing="0" align="right"> 		<tbody><tr> 		<td width="11">&nbsp;</td> 		<td class="linkBlue" width="60" align="center" style="padding-top: 2px"><a href="javascript:void(1)">更多要闻</a></td> 		</tr> 		</tbody></table>		 	</td> </tr> <tr><td height="2">&nbsp;</td></tr> </tbody></table>   </div> <!-- div01 end --> <!-- div02 begin --> <div id="focus2" class="l16" style="display: none">  		<!--[1,83,1] published at 2006-10-06 08:47:27 from #012 by 1044--> 	 		<table border="0" cellspacing="0" cellpadding="0" width="319"> 		<tbody><tr bgcolor="#c61c06"><td width="9" bgcolor="#ffffff">&nbsp;</td><td width="180" height="21"><img src="http://image2.sina.com.cn/dy/nc62606.gif" alt="" hspace="6" width="31" height="15" /><br /></td><td width="130" style="padding-top: 4px"><font color="#ffffff">北京时间：2006.10.06</font><br /></td></tr> <tr><td height="3">&nbsp;</td></tr> 		</tbody></table> 		 		<!--走马灯 开始-->		 		<!--走马灯 结束--> 		<!----此部分为新闻首页要闻区内容---->    <!--图片文字位 开始1-->  <table border="0" cellspacing="0" cellpadding="0" width="319">  <tbody><tr><td width="9">&nbsp;</td><td width="310" align="center">   <!--勿动2--> <table border="0" cellspacing="0" cellpadding="0" width="310" style="border: 1px solid #b8b8b8" bgcolor="#ecf3ff">    <tbody><tr><td height="4">&nbsp;</td></tr>     <tr><td align="center">      <a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank"><font style="font-size: 18px; font-family: 黑体" color="black">黄金周返程高峰形成</font></a><br /></td></tr>   <tr><td class="l15" style="padding-left: 4px"><!--勿动3-->   [<a href="http://news.sina.com.cn/c/2006-10-06/012011168180.shtml" target="_blank">北京</a> <a href="http://news.sina.com.cn/c/2006-10-06/022710168471s.shtml" target="_blank">重庆</a> <a href="http://news.sina.com.cn/c/2006-10-06/003511167473.shtml" target="_blank">广州客流强劲增长</a>][<a href="http://news.sina.com.cn/c/2006-10-05/210911167206.shtml" target="_blank">游客接待高峰回落</a>]<br />   [<a href="http://news.sina.com.cn/c/2006-10-06/020411167812.shtml" target="_blank">今年中秋月三大特点</a>][<a href="http://ent.sina.com.cn/f/cctvzhq2006/index.shtml" target="_blank">20:00视频直播央视中秋晚会</a>]<br />  <br /></td></tr></tbody></table>  <!--勿动4-->  <br /></td></tr> </tbody></table>  <!--图片文字位 结束-->  <!--重点新闻1号位 开始-->	 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td class="l16">&nbsp;</td></tr> </tbody></table>  <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">&nbsp;</td></tr></tbody></table> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16">   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/z/wmswwmbw/index.shtml" target="_blank">文明办网</a> <a href="http://news.sina.com.cn/z/daodejianshe/index.shtml" target="_blank">道德建设知识竞赛</a> <a href="http://news.sina.com.cn/z/dyxjx/index.shtml" target="_blank">构建和谐社会</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-04/141310164079s.shtml" target="_blank">卢武铉13日访华</a> <a href="http://news.sina.com.cn/c/2006-10-04/143211163087.shtml" target="_blank">安倍8日访华</a> <a href="http://news.sina.com.cn/w/2006-10-06/003211167469.shtml" target="_blank">称日中密不可分</a><br />   <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l15">  <span class="f12">　[<a href="http://news.sina.com.cn/w/2006-10-05/233611167339.shtml" target="_blank">日国民期待日中关系改善</a>][<a href="http://news.sina.com.cn/c/2006-10-06/025311167982.shtml" target="_blank">专家分析安倍访问中韩动机</a>]</span><br />  <br /></td></tr></tbody></table>   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/w/2006-10-06/073310169411s.shtml" target="_blank">韩国外长可能访朝</a> <a href="http://news.sina.com.cn/w/2006-10-06/063010169307s.shtml" target="_blank">美国称朝鲜核试验是严重挑衅</a><br />    <!--红线 开始--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--红线 结束-->  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/z/2006newsreview/index.html" target="_blank">1-9月各频道精彩回顾</a> <a href="http://news.sina.com.cn/06/china/january.html" target="_blank">国内要闻</a> <a href="http://news.sina.com.cn/06/world/january.html" target="_blank">国际要闻回顾</a><br />  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-06/003811167478.shtml" target="_blank">中国竞猜型赛马彩票有望2008年前试点</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-05/234711167340.shtml" target="_blank">北京用弹性管制和专用道网络解决奥运交通问题</a><br />   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/edu/2006-10-06/005211167496.shtml" target="_blank">英国媒体公布大学排行榜 哈佛排第一北大第十四</a><br />  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-05/192711167142.shtml" target="_blank">韩国拟将中医改为韩医申报世界遗产</a><br />   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/w/2006-10-06/015510168369s.shtml" target="_blank">欧盟11月起限制飞机乘客随身携带液态物品</a><br />  <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/w/2006-10-05/234711167345.shtml" target="_blank">美称伊拉克基地头目身亡可能性很小</a> <a href="http://news.sina.com.cn/w/2006-10-05/174910167797s.shtml" target="_blank">正检测DNA</a><br />  <!--红线 开始--> <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td height="4">&nbsp;</td></tr> <tr><td width="14">&nbsp;</td><td width="305" height="1" bgcolor="#c61c06">&nbsp;</td></tr> <tr><td height="4">&nbsp;</td></tr> </tbody></table> <!--红线 结束-->   <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/2006-10-05/231511167329.shtml" target="_blank">广州记者遭围殴调查：作案有组织派出所欲私了</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://news.sina.com.cn/c/l/2006-10-05/225511167319.shtml" target="_blank">司机开车撞死人 法院判车主垫付赔偿款引发争议</a><br />    <font class="f7" color="#00349a">●</font> <a href="http://sports.sina.com.cn/2006f1boat/" target="_blank"><font color="red">F1摩托艇世锦赛成都站吉尔曼夺冠</font></a> <a href="http://sports.sina.com.cn/z/coxshow/" target="_blank">奥运舵手选拔</a><br />  <br /></td></tr> </tbody></table> <!--重点新闻1号位 结束--> 		 	 		<!--tech start--> 		 <table border="0" cellspacing="0" cellpadding="0" width="319"> <tbody><tr><td class="l16" colspan="2"><span class="f7">●</span> <a href="http://blog.sina.com.cn/main/" target="_blank">博客</a>：<a href="http://blog.sina.com.cn/m/chensongling" target="_blank">陈松伶</a> <a href="http://blog.sina.com.cn/m/kelan" target="_blank">柯蓝</a> <a href="http://blog.sina.com.cn/m/meiting" target="_blank">梅婷</a> <a href="http://blog.sina.com.cn/m/linxinru" target="_blank">林心如</a> <a href="http://blog.sina.com.cn/m/jiaoenjun" target="_blank">焦恩俊</a> <a href="http://blog.sina.com.cn/m/zhanghuali" target="_blank">张华立</a><br /><br /></td></tr> <tr><td class="l16"> <!--新闻首页内容更新，不能超过16.5个字-->  <span class="f7">●</span> <a href="http://blog.sina.com.cn/lm/guoqing/travel.html" target="_blank">旅游指南</a> <a href="http://blog.sina.com.cn/lm/z/06supergirl/index.html" target="_blank">超女PK历程</a> <a href="http://blog.sina.com.cn/lm/z/huigu/index.html" target="_blank">博客周年回顾</a><br /> <br /></td>  	<td> 		<table border="0" cellspacing="0" align="right"> 		<tbody><tr> 		<td width="11">&nbsp;</td> 		<td class="linkBlue" width="60" align="center" style="padding-top: 2px"><a href="javascript:void(2)">返回</a><br /></td> 		</tr> 		</tbody></table> 	<br /></td>  </tr> <tr><td height="2">&nbsp;</td></tr> </tbody></table> 		 </div> <!-- div02 end -->  </td>  <td width="1" bgcolor="#969696">&nbsp;</td> <td width="128" align="center"> 			 	<!--推荐新闻 start-->	 		<!--推荐新闻 start-->	 	<table border="0" cellspacing="0" width="100%" bgcolor="#f0f0f0"> 	<tbody><tr><td width="100%" height="75" align="center" valign="top"> 		<table border="0" cellspacing="0" cellpadding="0" width="124"> 		<tbody><tr><td height="21" align="center" bgcolor="#7e7e7e"><a href="http://news.sina.com.cn/z/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0125/news_lp_003.gif" border="0" alt="" width="64" height="14" /></a></td></tr></tbody></table>  		<table border="0" cellspacing="0" cellpadding="0" width="123"> 		  <tbody><tr> 			<td height="2">&nbsp;</td> 		  </tr> 		  <tr> 			<td width="43" align="center" valign="top"><a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/temp/119/2006-01-24/U1075P1T119D39F2656DT20060930142611.jpg" border="1" alt="" hspace="2" vspace="2" width="41" height="41" /></a></td> 			<td width="2">&nbsp;</td> 			<td class="l15" width="78"><a href="http://news.sina.com.cn/z/octho2006/index.shtml" target="_blank">2006年国庆节</a><br /><a href="http://news.sina.com.cn/z/photo/06/octho2006/index.shtml" target="_blank">图集</a> <a href="http://news.sina.com.cn/z/video/octho2006/index.shtml" target="_blank">视频</a></td> 		  </tr> <tr><td height="6">&nbsp;</td></tr> 		<tr> 			<td class="l15" colspan="3"><p>  <a href="http://ent.sina.com.cn/f/h/shiyi/index.shtml" target="_blank">影视资讯</a> <a href="http://sports.sina.com.cn/z/gqtk2006.html" target="_blank">精彩赛事</a><br />  <a href="http://news.sina.com.cn/z/tiyanhuangjinzhou/index.shtml" target="_blank">CCTV-4征集黄金周体验</a><br /> 			</p></td> 		  </tr> 		</tbody></table> 	</td></tr> 	</tbody></table><table border="0" cellspacing="0" width="100%"> 	<tbody><tr><td width="100%" height="84" align="center" valign="top">  		<table border="0" cellspacing="0" cellpadding="0" width="123"> 		  <tbody><tr> 			<td height="2">&nbsp;</td> 		  </tr> 		  <!--<tr> 			<td width=43 valign=top align=center><a href=http://news.sina.com.cn/z/rongru/index.shtml target=_blank class=c03><img src=http://image2.sina.com.cn/dy/temp/119/2006-01-24/U1075P1T119D39F5157DT20060421095323.jpg border=1 width=41 height=41 vspace=2 hspace=2 class=c03></a></td> 			<td width=2></td> 			<td width=78 class=l15><a class=news3 href=http://news.sina.com.cn/z/rongru/index.shtml target=_blank>树立社会主义<br>荣辱观</a> <a href=http://comment4.news.sina.com.cn/comment/skin/default.html?channel=gn&newsid=1-63-2341&style=1&nice=0&rid=0&page=0&face=&hot=gn_default class=news3  target=_blank>评论</a></a> 		 </td> 		  </tr>--> 		  <tr> 			<td class="l15" colspan="3"><p>  <a href="http://news.sina.com.cn/z/nobel2006/index.shtml" target="_blank">2006年诺贝尔奖</a><br /> <a href="http://news.sina.com.cn/z/cxjxhsy/index.shtml" target="_blank">朝鲜宣布将进行核试验</a><br />    <a href="http://news.sina.com.cn/z/changzhengyijuhua/index.shtml" target="_blank">征集感悟长征一句话</a><br />  <a href="http://ent.sina.com.cn/f/y/06supergirl/index.shtml" target="_blank">06超级女声尚雯婕夺冠</a><br /> <a href="http://sports.sina.com.cn/z/0607championsleague/index.shtml" target="_blank">欧洲冠军杯独家视频</a>    			</p></td> 		  </tr> 		</tbody></table> 	</td></tr>  <tr> 			<td height="5">&nbsp;</td> 		  </tr> 	</tbody></table> 	<!--推荐新闻 end-->     	<!--推荐新闻 end-->           <!--$ {要闻右侧热点专题下滚动}-->            <table border="0" cellspacing="0" cellpadding="0" width="123"> 	<tbody><tr><td height="19" align="center" valign="center" style="padding-top: 3px; padding-left: 2px" bgcolor="#c61c06"><a href="http://bn.sina.com.cn/" target="_blank"><img src="http://image2.sina.com.cn/dy/deco/2006/0930/news_modi062425_05.gif" border="0" alt="" width="64" height="14" /></a></td></tr> 	<tr><td height="2" bgcolor="#c61c06">&nbsp;</td></tr> 	</tbody></table> 	<table border="0" cellspacing="0" cellpadding="0" width="123"> <tbody><tr><td height="7">&nbsp;</td></tr> <tr>     <td width="43" align="center" valign="top"> <a href="http://bn.sina.com.cn/z/7liao_6/index.shtml" target="_blank"><img class="c03" src="http://image2.sina.com.cn/dy/pc/2002-12-11/69/U1396P1T69D27F1525DT20061006165320.jpg" border="1" alt="" hspace="2" vspace="2" width="41" height="41" /></a></td> <td width="2">&nbsp;</td>                <td class="l15" width="78" align="center"><a href="http://bn.sina.com.cn/z/7liao_6/index.shtml" target="_blank">国庆七天聊<br />名嘴主持</a></td>   </tr>   <tr>     <td class="l15" colspan="3">	 	<a href="http://iask.sina.com.cn/info/iask_travel_060930.html" target="_blank">旅游卫视有奖知识问答</a><br /> 	<a href="http://bn.sina.com.cn/tvs/2006-09-30/141325657.html" target="_blank">情感之旅：妈妈的短裙</a><br /> 	 	<a href="http://bn.sina.com.cn/tvs/2006-09-29/151125574.html" target="_blank">汤加丽写真女人是与非</a><br />	 	<a href="http://bn.sina.com.cn/dv/ucvideo/index.shtml" target="_blank">UC美女网友热舞视频集</a><br /> 	<a href="http://bn.sina.com.cn/z/ansuan/index.shtml" target="_blank">电视剧-暗算</a> <a href="http://bn.sina.com.cn/z/wulinwaizhuanonline/" target="_blank">武林外传</a><br /> 	<a href="http://cctv.sina.com.cn/" target="_blank">CCTV节目免费在线收</a></td></tr></tbody></table></td></tr></tbody></table>', 'new', '', '2006-10-06 18:34:49', '0000-00-00 00:00:00');

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

-- 
-- 导出表中的数据 `apf_perm_users`
-- 

INSERT INTO `apf_perm_users` (`perm_user_id`, `auth_user_id`, `auth_container_name`, `perm_type`) VALUES (1, '1', 'DB', 1),
(2, '2', 'DB', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_perm_users_perm_user_id_seq`
-- 

CREATE TABLE `apf_perm_users_perm_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_perm_users_perm_user_id_seq`
-- 

INSERT INTO `apf_perm_users_perm_user_id_seq` (`id`) VALUES (2);

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

-- 
-- 导出表中的数据 `apf_rights`
-- 

INSERT INTO `apf_rights` (`right_id`, `area_id`, `right_define_name`, `has_implied`) VALUES (1, 0, 'ALLOWDELETE', 0),
(2, 0, 'ALLOWUPDATE', 0),
(3, 0, 'ALLOWCREATE', 0);

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

-- 
-- 导出表中的数据 `apf_userrights`
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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_users`
-- 

INSERT INTO `apf_users` (`id`, `user_name`, `user_pwd`, `gender`, `addrees`, `phone`, `email`, `photo`, `role_id`, `active`, `add_ip`, `created_at`, `update_at`) VALUES (1, 'test', 'test', 'f', 'test', 'test', 'test', 'test', 1, 'new', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'dddd', 'dddd', 'm', 'dddd', 'dddd', 'dddd', 'dddd', 0, 'live', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `apf_users_auth_user_id_seq`
-- 

CREATE TABLE `apf_users_auth_user_id_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `apf_users_auth_user_id_seq`
-- 

INSERT INTO `apf_users_auth_user_id_seq` (`id`) VALUES (2);
