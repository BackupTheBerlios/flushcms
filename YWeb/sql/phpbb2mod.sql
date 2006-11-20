-- phpMyAdmin SQL Dump
-- version 2.6.4-pl4
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2006 年 11 月 20 日 16:33
-- 服务器版本: 4.0.26
-- PHP 版本: 4.4.2
-- 
-- 数据库: `phpbb2mod`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_attach_quota`
-- 

CREATE TABLE `phpbb_attach_quota` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `quota_type` smallint(2) NOT NULL default '0',
  `quota_limit_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `quota_type` (`quota_type`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_attach_quota`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_attachments`
-- 

CREATE TABLE `phpbb_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `privmsgs_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id_1` mediumint(8) NOT NULL default '0',
  `user_id_2` mediumint(8) NOT NULL default '0',
  KEY `attach_id_post_id` (`attach_id`,`post_id`),
  KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  KEY `post_id` (`post_id`),
  KEY `privmsgs_id` (`privmsgs_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_attachments`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_attachments_config`
-- 

CREATE TABLE `phpbb_attachments_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`config_name`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_attachments_config`
-- 

INSERT INTO `phpbb_attachments_config` VALUES ('upload_dir', 'files');
INSERT INTO `phpbb_attachments_config` VALUES ('upload_img', 'images/icon_clip.gif');
INSERT INTO `phpbb_attachments_config` VALUES ('topic_icon', 'images/icon_clip.gif');
INSERT INTO `phpbb_attachments_config` VALUES ('display_order', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('max_filesize', '262144');
INSERT INTO `phpbb_attachments_config` VALUES ('attachment_quota', '52428800');
INSERT INTO `phpbb_attachments_config` VALUES ('max_filesize_pm', '262144');
INSERT INTO `phpbb_attachments_config` VALUES ('max_attachments', '3');
INSERT INTO `phpbb_attachments_config` VALUES ('max_attachments_pm', '1');
INSERT INTO `phpbb_attachments_config` VALUES ('disable_mod', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('allow_pm_attach', '1');
INSERT INTO `phpbb_attachments_config` VALUES ('attachment_topic_review', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('allow_ftp_upload', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('show_apcp', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('attach_version', '2.4.1');
INSERT INTO `phpbb_attachments_config` VALUES ('default_upload_quota', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('default_pm_quota', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('ftp_server', '');
INSERT INTO `phpbb_attachments_config` VALUES ('ftp_path', '');
INSERT INTO `phpbb_attachments_config` VALUES ('download_path', '');
INSERT INTO `phpbb_attachments_config` VALUES ('ftp_user', '');
INSERT INTO `phpbb_attachments_config` VALUES ('ftp_pass', '');
INSERT INTO `phpbb_attachments_config` VALUES ('ftp_pasv_mode', '1');
INSERT INTO `phpbb_attachments_config` VALUES ('img_display_inlined', '1');
INSERT INTO `phpbb_attachments_config` VALUES ('img_max_width', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('img_max_height', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('img_link_width', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('img_link_height', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('img_create_thumbnail', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('img_min_thumb_filesize', '12000');
INSERT INTO `phpbb_attachments_config` VALUES ('img_imagick', '');
INSERT INTO `phpbb_attachments_config` VALUES ('use_gd2', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('wma_autoplay', '0');
INSERT INTO `phpbb_attachments_config` VALUES ('flash_autoplay', '0');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_attachments_desc`
-- 

CREATE TABLE `phpbb_attachments_desc` (
  `attach_id` mediumint(8) unsigned NOT NULL auto_increment,
  `physical_filename` varchar(255) NOT NULL default '',
  `real_filename` varchar(255) NOT NULL default '',
  `download_count` mediumint(8) unsigned NOT NULL default '0',
  `comment` varchar(255) default NULL,
  `extension` varchar(100) default NULL,
  `mimetype` varchar(100) default NULL,
  `filesize` int(20) NOT NULL default '0',
  `filetime` int(11) NOT NULL default '0',
  `thumbnail` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_attachments_desc`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_auth_access`
-- 

CREATE TABLE `phpbb_auth_access` (
  `group_id` mediumint(8) NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `auth_view` tinyint(1) NOT NULL default '0',
  `auth_read` tinyint(1) NOT NULL default '0',
  `auth_post` tinyint(1) NOT NULL default '0',
  `auth_reply` tinyint(1) NOT NULL default '0',
  `auth_edit` tinyint(1) NOT NULL default '0',
  `auth_delete` tinyint(1) NOT NULL default '0',
  `auth_sticky` tinyint(1) NOT NULL default '0',
  `auth_announce` tinyint(1) NOT NULL default '0',
  `auth_globalannounce` tinyint(1) NOT NULL default '0',
  `auth_vote` tinyint(1) NOT NULL default '0',
  `auth_pollcreate` tinyint(1) NOT NULL default '0',
  `auth_attachments` tinyint(1) NOT NULL default '0',
  `auth_mod` tinyint(1) NOT NULL default '0',
  `auth_download` tinyint(1) NOT NULL default '0',
  `auth_sellpost` tinyint(1) NOT NULL default '0',
  `auth_hide4reply` tinyint(1) NOT NULL default '0',
  `auth_hide4posts` tinyint(1) NOT NULL default '0',
  `auth_hide4fortune` tinyint(1) NOT NULL default '0',
  `auth_ban` tinyint(1) NOT NULL default '0',
  `auth_greencard` tinyint(1) NOT NULL default '0',
  `auth_bluecard` tinyint(1) NOT NULL default '0',
  `auth_commend` tinyint(1) NOT NULL default '3',
  KEY `group_id` (`group_id`),
  KEY `forum_id` (`forum_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_auth_access`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_banlist`
-- 

CREATE TABLE `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL auto_increment,
  `ban_userid` mediumint(8) NOT NULL default '0',
  `ban_ip` varchar(8) NOT NULL default '',
  `ban_email` varchar(255) default NULL,
  PRIMARY KEY  (`ban_id`),
  KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_banlist`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_cash`
-- 

CREATE TABLE `phpbb_cash` (
  `cash_id` smallint(6) NOT NULL auto_increment,
  `cash_order` smallint(6) NOT NULL default '0',
  `cash_settings` smallint(4) NOT NULL default '3313',
  `cash_dbfield` varchar(64) NOT NULL default '',
  `cash_name` varchar(64) NOT NULL default 'GP',
  `cash_default` int(11) NOT NULL default '0',
  `cash_decimals` tinyint(2) NOT NULL default '0',
  `cash_imageurl` varchar(255) NOT NULL default '',
  `cash_exchange` int(11) NOT NULL default '1',
  `cash_perpost` int(11) NOT NULL default '25',
  `cash_postbonus` int(11) NOT NULL default '2',
  `cash_perreply` int(11) NOT NULL default '25',
  `cash_maxearn` int(11) NOT NULL default '75',
  `cash_perpm` int(11) NOT NULL default '0',
  `cash_perchar` int(11) NOT NULL default '20',
  `cash_allowance` tinyint(1) NOT NULL default '0',
  `cash_allowanceamount` int(11) NOT NULL default '0',
  `cash_allowancetime` tinyint(2) NOT NULL default '2',
  `cash_allowancenext` int(11) NOT NULL default '0',
  `cash_forumlist` varchar(255) NOT NULL default '',
  `cash_max_sellingprice` int(11) NOT NULL default '0',
  `cash_min_sellingprice` int(11) NOT NULL default '1',
  `cash_max_fortunerequired` int(11) NOT NULL default '0',
  `cash_min_fortunerequired` int(11) NOT NULL default '1',
  PRIMARY KEY  (`cash_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_cash`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_cash_events`
-- 

CREATE TABLE `phpbb_cash_events` (
  `event_name` varchar(32) NOT NULL default '',
  `event_data` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`event_name`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_cash_events`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_cash_exchange`
-- 

CREATE TABLE `phpbb_cash_exchange` (
  `ex_cash_id1` int(11) NOT NULL default '0',
  `ex_cash_id2` int(11) NOT NULL default '0',
  `ex_cash_enabled` int(1) NOT NULL default '0',
  PRIMARY KEY  (`ex_cash_id1`,`ex_cash_id2`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_cash_exchange`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_cash_groups`
-- 

CREATE TABLE `phpbb_cash_groups` (
  `group_id` mediumint(6) NOT NULL default '0',
  `group_type` tinyint(2) NOT NULL default '0',
  `cash_id` smallint(6) NOT NULL default '0',
  `cash_perpost` int(11) NOT NULL default '0',
  `cash_postbonus` int(11) NOT NULL default '0',
  `cash_perreply` int(11) NOT NULL default '0',
  `cash_perchar` int(11) NOT NULL default '0',
  `cash_maxearn` int(11) NOT NULL default '0',
  `cash_perpm` int(11) NOT NULL default '0',
  `cash_allowance` tinyint(1) NOT NULL default '0',
  `cash_allowanceamount` int(11) NOT NULL default '0',
  `cash_allowancetime` tinyint(2) NOT NULL default '2',
  `cash_allowancenext` int(11) NOT NULL default '0',
  PRIMARY KEY  (`group_id`,`group_type`,`cash_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_cash_groups`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_cash_log`
-- 

CREATE TABLE `phpbb_cash_log` (
  `log_id` int(11) NOT NULL auto_increment,
  `log_time` int(11) NOT NULL default '0',
  `log_type` smallint(6) NOT NULL default '0',
  `log_action` varchar(255) NOT NULL default '',
  `log_text` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`log_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_cash_log`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_categories`
-- 

CREATE TABLE `phpbb_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_title` varchar(100) default NULL,
  `cat_order` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_order` (`cat_order`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_categories`
-- 

INSERT INTO `phpbb_categories` VALUES (1, '测试分区', 10);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_config`
-- 

CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`config_name`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_config`
-- 

INSERT INTO `phpbb_config` VALUES ('config_id', '1');
INSERT INTO `phpbb_config` VALUES ('board_disable', '0');
INSERT INTO `phpbb_config` VALUES ('sitename', 'phpbb论坛');
INSERT INTO `phpbb_config` VALUES ('site_desc', '论坛描述');
INSERT INTO `phpbb_config` VALUES ('cookie_name', 'phpbb2mysql');
INSERT INTO `phpbb_config` VALUES ('cookie_path', '/');
INSERT INTO `phpbb_config` VALUES ('cookie_domain', '');
INSERT INTO `phpbb_config` VALUES ('cookie_secure', '0');
INSERT INTO `phpbb_config` VALUES ('session_length', '3600');
INSERT INTO `phpbb_config` VALUES ('allow_html', '0');
INSERT INTO `phpbb_config` VALUES ('allow_html_tags', 'b,i,u,pre');
INSERT INTO `phpbb_config` VALUES ('allow_bbcode', '1');
INSERT INTO `phpbb_config` VALUES ('allow_smilies', '1');
INSERT INTO `phpbb_config` VALUES ('allow_sig', '1');
INSERT INTO `phpbb_config` VALUES ('allow_namechange', '0');
INSERT INTO `phpbb_config` VALUES ('allow_theme_create', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_local', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_upload', '0');
INSERT INTO `phpbb_config` VALUES ('enable_confirm', '0');
INSERT INTO `phpbb_config` VALUES ('override_user_style', '0');
INSERT INTO `phpbb_config` VALUES ('posts_per_page', '15');
INSERT INTO `phpbb_config` VALUES ('topics_per_page', '50');
INSERT INTO `phpbb_config` VALUES ('hot_threshold', '25');
INSERT INTO `phpbb_config` VALUES ('max_poll_options', '10');
INSERT INTO `phpbb_config` VALUES ('max_sig_chars', '255');
INSERT INTO `phpbb_config` VALUES ('max_inbox_privmsgs', '50');
INSERT INTO `phpbb_config` VALUES ('max_sentbox_privmsgs', '25');
INSERT INTO `phpbb_config` VALUES ('max_savebox_privmsgs', '50');
INSERT INTO `phpbb_config` VALUES ('board_email_sig', '谢谢您的阅读, 论坛管理团队');
INSERT INTO `phpbb_config` VALUES ('board_email', 'arzen1013@gmail.com');
INSERT INTO `phpbb_config` VALUES ('smtp_delivery', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_host', '');
INSERT INTO `phpbb_config` VALUES ('smtp_username', '');
INSERT INTO `phpbb_config` VALUES ('smtp_password', '');
INSERT INTO `phpbb_config` VALUES ('sendmail_fix', '0');
INSERT INTO `phpbb_config` VALUES ('require_activation', '0');
INSERT INTO `phpbb_config` VALUES ('flood_interval', '15');
INSERT INTO `phpbb_config` VALUES ('board_email_form', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_filesize', '6144');
INSERT INTO `phpbb_config` VALUES ('avatar_max_width', '80');
INSERT INTO `phpbb_config` VALUES ('avatar_max_height', '80');
INSERT INTO `phpbb_config` VALUES ('avatar_path', 'images/avatars');
INSERT INTO `phpbb_config` VALUES ('avatar_gallery_path', 'images/avatars/gallery');
INSERT INTO `phpbb_config` VALUES ('smilies_path', 'images/smiles');
INSERT INTO `phpbb_config` VALUES ('default_style', '1');
INSERT INTO `phpbb_config` VALUES ('default_dateformat', 'Y-M-d D, ag:i');
INSERT INTO `phpbb_config` VALUES ('board_timezone', '8');
INSERT INTO `phpbb_config` VALUES ('prune_enable', '1');
INSERT INTO `phpbb_config` VALUES ('privmsg_disable', '0');
INSERT INTO `phpbb_config` VALUES ('gzip_compress', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_fax', '');
INSERT INTO `phpbb_config` VALUES ('coppa_mail', '');
INSERT INTO `phpbb_config` VALUES ('record_online_users', '1');
INSERT INTO `phpbb_config` VALUES ('record_online_date', '1164009272');
INSERT INTO `phpbb_config` VALUES ('server_name', 'localhost');
INSERT INTO `phpbb_config` VALUES ('server_port', '80');
INSERT INTO `phpbb_config` VALUES ('script_path', '/dev/forum/2021MOD/');
INSERT INTO `phpbb_config` VALUES ('version', '.0.21');
INSERT INTO `phpbb_config` VALUES ('board_disable_msg', '对不起，本论坛系统暂时不能访问，请稍候再试。');
INSERT INTO `phpbb_config` VALUES ('board_disable_downtime', '10 分钟');
INSERT INTO `phpbb_config` VALUES ('board_disable_notes', '论坛版本升级中');
INSERT INTO `phpbb_config` VALUES ('board_disable_admin_mod', '0');
INSERT INTO `phpbb_config` VALUES ('anonymous_show_sqr', '0');
INSERT INTO `phpbb_config` VALUES ('anonymous_sqr_mode', '0');
INSERT INTO `phpbb_config` VALUES ('anonymous_open_sqr', '0');
INSERT INTO `phpbb_config` VALUES ('max_login_attempts', '5');
INSERT INTO `phpbb_config` VALUES ('login_reset_time', '30');
INSERT INTO `phpbb_config` VALUES ('search_flood_interval', '15');
INSERT INTO `phpbb_config` VALUES ('rand_seed', '771ded003625141034edb2bcffc08ac0');
INSERT INTO `phpbb_config` VALUES ('search_min_chars', '3');
INSERT INTO `phpbb_config` VALUES ('cash_disable', '0');
INSERT INTO `phpbb_config` VALUES ('cash_display_after_posts', '1');
INSERT INTO `phpbb_config` VALUES ('cash_post_message', '此贴为您赚得了 %s');
INSERT INTO `phpbb_config` VALUES ('cash_disable_spam_num', '10');
INSERT INTO `phpbb_config` VALUES ('cash_disable_spam_time', '24');
INSERT INTO `phpbb_config` VALUES ('cash_disable_spam_message', '您超出了系统允许的最大发贴数，您将无法赚得虚拟货币');
INSERT INTO `phpbb_config` VALUES ('cash_installed', '是');
INSERT INTO `phpbb_config` VALUES ('cash_version', '2.2.2');
INSERT INTO `phpbb_config` VALUES ('cash_adminbig', '0');
INSERT INTO `phpbb_config` VALUES ('cash_adminnavbar', '1');
INSERT INTO `phpbb_config` VALUES ('points_name', '点数');
INSERT INTO `phpbb_config` VALUES ('allow_quickreply', '1');
INSERT INTO `phpbb_config` VALUES ('cash_system_type', '2');
INSERT INTO `phpbb_config` VALUES ('allow_sellpost', '0');
INSERT INTO `phpbb_config` VALUES ('allow_hide4reply', '0');
INSERT INTO `phpbb_config` VALUES ('allow_hide4posts', '0');
INSERT INTO `phpbb_config` VALUES ('allow_hide4fortune', '0');
INSERT INTO `phpbb_config` VALUES ('max_sellingprice', '0');
INSERT INTO `phpbb_config` VALUES ('min_sellingprice', '1');
INSERT INTO `phpbb_config` VALUES ('max_postsrequired', '0');
INSERT INTO `phpbb_config` VALUES ('min_postsrequired', '1');
INSERT INTO `phpbb_config` VALUES ('max_fortunerequired', '0');
INSERT INTO `phpbb_config` VALUES ('min_fortunerequired', '1');
INSERT INTO `phpbb_config` VALUES ('cash_field_name', '');
INSERT INTO `phpbb_config` VALUES ('cash_type_name', '');
INSERT INTO `phpbb_config` VALUES ('who_is_online_time', '5');
INSERT INTO `phpbb_config` VALUES ('birthday_required', '0');
INSERT INTO `phpbb_config` VALUES ('birthday_greeting', '1');
INSERT INTO `phpbb_config` VALUES ('max_user_age', '100');
INSERT INTO `phpbb_config` VALUES ('min_user_age', '5');
INSERT INTO `phpbb_config` VALUES ('birthday_check_day', '7');
INSERT INTO `phpbb_config` VALUES ('bluecard_limit', '3');
INSERT INTO `phpbb_config` VALUES ('bluecard_limit_2', '1');
INSERT INTO `phpbb_config` VALUES ('max_user_bancard', '10');
INSERT INTO `phpbb_config` VALUES ('report_forum', '0');
INSERT INTO `phpbb_config` VALUES ('email_enabled', '1');
INSERT INTO `phpbb_config` VALUES ('allow_autologin', '1');
INSERT INTO `phpbb_config` VALUES ('max_autologin_time', '0');
INSERT INTO `phpbb_config` VALUES ('board_startdate', '1164009216');
INSERT INTO `phpbb_config` VALUES ('default_lang', 'chinese_simplified');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_confirm`
-- 

CREATE TABLE `phpbb_confirm` (
  `confirm_id` char(32) NOT NULL default '',
  `session_id` char(32) NOT NULL default '',
  `code` char(6) NOT NULL default '',
  PRIMARY KEY  (`session_id`,`confirm_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_confirm`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_disallow`
-- 

CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL auto_increment,
  `disallow_username` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`disallow_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_disallow`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_extension_groups`
-- 

CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_name` varchar(20) NOT NULL default '',
  `cat_id` tinyint(2) NOT NULL default '0',
  `allow_group` tinyint(1) NOT NULL default '0',
  `download_mode` tinyint(1) unsigned NOT NULL default '1',
  `upload_icon` varchar(100) default '',
  `max_filesize` int(20) NOT NULL default '0',
  `forum_permissions` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`group_id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `phpbb_extension_groups`
-- 

INSERT INTO `phpbb_extension_groups` VALUES (1, 'Images', 1, 1, 1, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (2, 'Archives', 0, 1, 1, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (3, 'Plain Text', 0, 0, 1, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (4, 'Documents', 0, 0, 1, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (5, 'Real Media', 0, 0, 2, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (6, 'Streams', 2, 0, 1, '', 0, '');
INSERT INTO `phpbb_extension_groups` VALUES (7, 'Flash Files', 3, 0, 1, '', 0, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_extensions`
-- 

CREATE TABLE `phpbb_extensions` (
  `ext_id` mediumint(8) unsigned NOT NULL auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `extension` varchar(100) NOT NULL default '',
  `comment` varchar(100) default NULL,
  PRIMARY KEY  (`ext_id`)
) TYPE=MyISAM AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `phpbb_extensions`
-- 

INSERT INTO `phpbb_extensions` VALUES (1, 1, 'gif', '');
INSERT INTO `phpbb_extensions` VALUES (2, 1, 'png', '');
INSERT INTO `phpbb_extensions` VALUES (3, 1, 'jpeg', '');
INSERT INTO `phpbb_extensions` VALUES (4, 1, 'jpg', '');
INSERT INTO `phpbb_extensions` VALUES (5, 1, 'tif', '');
INSERT INTO `phpbb_extensions` VALUES (6, 1, 'tga', '');
INSERT INTO `phpbb_extensions` VALUES (7, 2, 'gtar', '');
INSERT INTO `phpbb_extensions` VALUES (8, 2, 'gz', '');
INSERT INTO `phpbb_extensions` VALUES (9, 2, 'tar', '');
INSERT INTO `phpbb_extensions` VALUES (10, 2, 'zip', '');
INSERT INTO `phpbb_extensions` VALUES (11, 2, 'rar', '');
INSERT INTO `phpbb_extensions` VALUES (12, 2, 'ace', '');
INSERT INTO `phpbb_extensions` VALUES (13, 3, 'txt', '');
INSERT INTO `phpbb_extensions` VALUES (14, 3, 'c', '');
INSERT INTO `phpbb_extensions` VALUES (15, 3, 'h', '');
INSERT INTO `phpbb_extensions` VALUES (16, 3, 'cpp', '');
INSERT INTO `phpbb_extensions` VALUES (17, 3, 'hpp', '');
INSERT INTO `phpbb_extensions` VALUES (18, 3, 'diz', '');
INSERT INTO `phpbb_extensions` VALUES (19, 4, 'xls', '');
INSERT INTO `phpbb_extensions` VALUES (20, 4, 'doc', '');
INSERT INTO `phpbb_extensions` VALUES (21, 4, 'dot', '');
INSERT INTO `phpbb_extensions` VALUES (22, 4, 'pdf', '');
INSERT INTO `phpbb_extensions` VALUES (23, 4, 'ai', '');
INSERT INTO `phpbb_extensions` VALUES (24, 4, 'ps', '');
INSERT INTO `phpbb_extensions` VALUES (25, 4, 'ppt', '');
INSERT INTO `phpbb_extensions` VALUES (26, 5, 'rm', '');
INSERT INTO `phpbb_extensions` VALUES (27, 6, 'wma', '');
INSERT INTO `phpbb_extensions` VALUES (28, 7, 'swf', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_favorites`
-- 

CREATE TABLE `phpbb_favorites` (
  `fav_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `topic_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`fav_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_favorites`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forbidden_extensions`
-- 

CREATE TABLE `phpbb_forbidden_extensions` (
  `ext_id` mediumint(8) unsigned NOT NULL auto_increment,
  `extension` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`ext_id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `phpbb_forbidden_extensions`
-- 

INSERT INTO `phpbb_forbidden_extensions` VALUES (1, 'php');
INSERT INTO `phpbb_forbidden_extensions` VALUES (2, 'php3');
INSERT INTO `phpbb_forbidden_extensions` VALUES (3, 'php4');
INSERT INTO `phpbb_forbidden_extensions` VALUES (4, 'phtml');
INSERT INTO `phpbb_forbidden_extensions` VALUES (5, 'pl');
INSERT INTO `phpbb_forbidden_extensions` VALUES (6, 'asp');
INSERT INTO `phpbb_forbidden_extensions` VALUES (7, 'cgi');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forum_prune`
-- 

CREATE TABLE `phpbb_forum_prune` (
  `prune_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `prune_days` smallint(5) unsigned NOT NULL default '0',
  `prune_freq` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`prune_id`),
  KEY `forum_id` (`forum_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_forum_prune`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forums`
-- 

CREATE TABLE `phpbb_forums` (
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `cat_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_name` varchar(150) default NULL,
  `forum_desc` text,
  `forum_status` tinyint(4) NOT NULL default '0',
  `forum_order` mediumint(8) unsigned NOT NULL default '1',
  `forum_posts` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `prune_next` int(11) default NULL,
  `prune_enable` tinyint(1) NOT NULL default '0',
  `auth_view` tinyint(2) NOT NULL default '0',
  `auth_read` tinyint(2) NOT NULL default '0',
  `auth_post` tinyint(2) NOT NULL default '0',
  `auth_reply` tinyint(2) NOT NULL default '0',
  `auth_edit` tinyint(2) NOT NULL default '0',
  `auth_delete` tinyint(2) NOT NULL default '0',
  `auth_sticky` tinyint(2) NOT NULL default '0',
  `auth_announce` tinyint(2) NOT NULL default '0',
  `auth_globalannounce` tinyint(2) NOT NULL default '3',
  `auth_vote` tinyint(2) NOT NULL default '0',
  `auth_pollcreate` tinyint(2) NOT NULL default '0',
  `auth_attachments` tinyint(2) NOT NULL default '0',
  `auth_download` tinyint(2) NOT NULL default '0',
  `auth_sellpost` tinyint(2) NOT NULL default '1',
  `auth_hide4reply` tinyint(2) NOT NULL default '3',
  `auth_hide4posts` tinyint(2) NOT NULL default '3',
  `auth_hide4fortune` tinyint(2) NOT NULL default '3',
  `auth_ban` tinyint(2) NOT NULL default '3',
  `auth_greencard` tinyint(2) NOT NULL default '5',
  `auth_bluecard` tinyint(2) NOT NULL default '1',
  `auth_commend` tinyint(1) NOT NULL default '3',
  `forum_sub` smallint(5) unsigned NOT NULL default '0',
  `sort_sub` smallint(5) unsigned NOT NULL default '0',
  `main_sub` smallint(50) unsigned NOT NULL default '0',
  `forum_icon` varchar(150) default NULL,
  PRIMARY KEY  (`forum_id`),
  KEY `forums_order` (`forum_order`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_forums`
-- 

INSERT INTO `phpbb_forums` VALUES (1, 1, '测试论坛', '这是一个测试论坛.', 0, 10, 1, 1, 1, NULL, 0, 0, 0, 0, 0, 1, 1, 1, 3, 3, 1, 1, 3, 0, 1, 3, 3, 3, 3, 5, 1, 3, 0, 0, 0, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_groups`
-- 

CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_type` tinyint(4) NOT NULL default '1',
  `group_name` varchar(40) NOT NULL default '',
  `group_description` varchar(255) NOT NULL default '',
  `group_moderator` mediumint(8) NOT NULL default '0',
  `group_single_user` tinyint(1) NOT NULL default '1',
  `group_allow_pm` tinyint(2) NOT NULL default '5',
  `group_count` int(4) unsigned default '99999999',
  `group_count_max` int(4) unsigned default '99999999',
  `group_count_enable` smallint(2) unsigned default '0',
  PRIMARY KEY  (`group_id`),
  KEY `group_single_user` (`group_single_user`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_groups`
-- 

INSERT INTO `phpbb_groups` VALUES (1, 1, 'Anonymous', 'Personal User', 0, 1, 5, 99999999, 99999999, 0);
INSERT INTO `phpbb_groups` VALUES (2, 1, 'Admin', 'Personal User', 0, 1, 5, 99999999, 99999999, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_link_categories`
-- 

CREATE TABLE `phpbb_link_categories` (
  `cat_id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_title` varchar(100) NOT NULL default '',
  `cat_order` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`cat_id`),
  KEY `cat_order` (`cat_order`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `phpbb_link_categories`
-- 

INSERT INTO `phpbb_link_categories` VALUES (1, '艺术', 1);
INSERT INTO `phpbb_link_categories` VALUES (2, '商业', 2);
INSERT INTO `phpbb_link_categories` VALUES (3, '儿童', 3);
INSERT INTO `phpbb_link_categories` VALUES (4, '电脑', 4);
INSERT INTO `phpbb_link_categories` VALUES (5, '游戏', 5);
INSERT INTO `phpbb_link_categories` VALUES (6, '健康', 6);
INSERT INTO `phpbb_link_categories` VALUES (7, '生活', 7);
INSERT INTO `phpbb_link_categories` VALUES (8, '新闻', 8);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_link_config`
-- 

CREATE TABLE `phpbb_link_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default ''
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_link_config`
-- 

INSERT INTO `phpbb_link_config` VALUES ('site_logo', 'images/links/web_logo88a.gif');
INSERT INTO `phpbb_link_config` VALUES ('site_url', '');
INSERT INTO `phpbb_link_config` VALUES ('width', '88');
INSERT INTO `phpbb_link_config` VALUES ('height', '31');
INSERT INTO `phpbb_link_config` VALUES ('linkspp', '10');
INSERT INTO `phpbb_link_config` VALUES ('display_interval', '6000');
INSERT INTO `phpbb_link_config` VALUES ('display_logo_num', '10');
INSERT INTO `phpbb_link_config` VALUES ('display_links_logo', '1');
INSERT INTO `phpbb_link_config` VALUES ('email_notify', '1');
INSERT INTO `phpbb_link_config` VALUES ('pm_notify', '0');
INSERT INTO `phpbb_link_config` VALUES ('lock_submit_site', '0');
INSERT INTO `phpbb_link_config` VALUES ('allow_no_logo', '0');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_links`
-- 

CREATE TABLE `phpbb_links` (
  `link_id` mediumint(8) unsigned NOT NULL auto_increment,
  `link_title` varchar(100) NOT NULL default '',
  `link_desc` varchar(255) default NULL,
  `link_category` mediumint(8) unsigned NOT NULL default '0',
  `link_url` varchar(100) NOT NULL default '',
  `link_logo_src` varchar(120) default NULL,
  `link_joined` int(11) NOT NULL default '0',
  `link_active` tinyint(1) NOT NULL default '0',
  `link_hits` int(10) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `user_ip` varchar(8) NOT NULL default '',
  `last_user_ip` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`link_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_links`
-- 

INSERT INTO `phpbb_links` VALUES (1, 'cnphpBB', 'phpbb中文开发小组', 4, 'http://www.cnphpbb.com/', 'images/links/cnphpBB_88a.gif', 0, 1, 0, 2, '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_payment`
-- 

CREATE TABLE `phpbb_payment` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `post_id_user_id` (`post_id`,`user_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_payment`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_posts`
-- 

CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) NOT NULL default '0',
  `post_time` int(11) NOT NULL default '0',
  `poster_ip` varchar(8) NOT NULL default '',
  `post_username` varchar(25) default NULL,
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_html` tinyint(1) NOT NULL default '0',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `post_edit_time` int(11) default NULL,
  `post_edit_count` smallint(5) unsigned NOT NULL default '0',
  `post_attachment` tinyint(1) NOT NULL default '0',
  `hiding_type` tinyint(1) unsigned default '0',
  `hiding_condition_value` int(11) default '0',
  `hiding_cash_id` smallint(6) default '0',
  `post_bluecard` tinyint(1) default NULL,
  PRIMARY KEY  (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_time` (`post_time`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_posts`
-- 

INSERT INTO `phpbb_posts` VALUES (1, 1, 1, 2, 972086460, '7F000001', NULL, 1, 0, 1, 1, NULL, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_posts_text`
-- 

CREATE TABLE `phpbb_posts_text` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(10) NOT NULL default '',
  `post_subject` varchar(120) default NULL,
  `post_text` text,
  PRIMARY KEY  (`post_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_posts_text`
-- 

INSERT INTO `phpbb_posts_text` VALUES (1, '', NULL, '欢迎来到phpBB! 一个完全免费的论坛系统。这是一个phpBB2 的贴子样例。您可以删除它，当它能正常显示时，说明您的安装和设置已成功!');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs`
-- 

CREATE TABLE `phpbb_privmsgs` (
  `privmsgs_id` mediumint(8) unsigned NOT NULL auto_increment,
  `privmsgs_type` tinyint(4) NOT NULL default '0',
  `privmsgs_subject` varchar(255) NOT NULL default '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL default '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL default '0',
  `privmsgs_date` int(11) NOT NULL default '0',
  `privmsgs_ip` varchar(8) NOT NULL default '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL default '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL default '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL default '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL default '1',
  `privmsgs_attachment` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_privmsgs`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs_text`
-- 

CREATE TABLE `phpbb_privmsgs_text` (
  `privmsgs_text_id` mediumint(8) unsigned NOT NULL default '0',
  `privmsgs_bbcode_uid` varchar(10) NOT NULL default '0',
  `privmsgs_text` text,
  PRIMARY KEY  (`privmsgs_text_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_privmsgs_text`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_quota_limits`
-- 

CREATE TABLE `phpbb_quota_limits` (
  `quota_limit_id` mediumint(8) unsigned NOT NULL auto_increment,
  `quota_desc` varchar(20) NOT NULL default '',
  `quota_limit` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`quota_limit_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `phpbb_quota_limits`
-- 

INSERT INTO `phpbb_quota_limits` VALUES (1, 'Low', 262144);
INSERT INTO `phpbb_quota_limits` VALUES (2, 'Medium', 2097152);
INSERT INTO `phpbb_quota_limits` VALUES (3, 'High', 5242880);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_ranks`
-- 

CREATE TABLE `phpbb_ranks` (
  `rank_id` smallint(5) unsigned NOT NULL auto_increment,
  `rank_title` varchar(50) NOT NULL default '',
  `rank_min` mediumint(8) NOT NULL default '0',
  `rank_special` tinyint(1) default '0',
  `rank_image` varchar(255) default NULL,
  PRIMARY KEY  (`rank_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_ranks`
-- 

INSERT INTO `phpbb_ranks` VALUES (1, '论坛管理员', -1, 1, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_results`
-- 

CREATE TABLE `phpbb_search_results` (
  `search_id` int(11) unsigned NOT NULL default '0',
  `session_id` varchar(32) NOT NULL default '',
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`search_id`),
  KEY `session_id` (`session_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_search_results`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_wordlist`
-- 

CREATE TABLE `phpbb_search_wordlist` (
  `word_text` varchar(50) binary NOT NULL default '',
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word_common` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`word_text`),
  KEY `word_id` (`word_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- 导出表中的数据 `phpbb_search_wordlist`
-- 

INSERT INTO `phpbb_search_wordlist` VALUES (0x6578616d706c65, 1, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x706f7374, 2, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x7068706262, 3, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x696e7374616c6c6174696f6e, 4, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x64656c657465, 5, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x746f706963, 6, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x666f72756d, 7, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x73696e6365, 8, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x65766572797468696e67, 9, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x7365656d73, 10, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x776f726b696e67, 11, 0);
INSERT INTO `phpbb_search_wordlist` VALUES (0x77656c636f6d65, 12, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_wordmatch`
-- 

CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `title_match` tinyint(1) NOT NULL default '0',
  KEY `post_id` (`post_id`),
  KEY `word_id` (`word_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_search_wordmatch`
-- 

INSERT INTO `phpbb_search_wordmatch` VALUES (1, 1, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 2, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 3, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 4, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 5, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 6, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 7, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 8, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 9, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 10, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 11, 0);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 12, 1);
INSERT INTO `phpbb_search_wordmatch` VALUES (1, 3, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_sessions`
-- 

CREATE TABLE `phpbb_sessions` (
  `session_id` char(32) NOT NULL default '',
  `session_user_id` mediumint(8) NOT NULL default '0',
  `session_start` int(11) NOT NULL default '0',
  `session_time` int(11) NOT NULL default '0',
  `session_ip` char(8) NOT NULL default '0',
  `session_page` int(11) NOT NULL default '0',
  `session_logged_in` tinyint(1) NOT NULL default '0',
  `session_admin` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_sessions`
-- 

INSERT INTO `phpbb_sessions` VALUES ('e523f23ef994f974df18b4c7336e061c', 2, 1164009299, 1164009384, '7f000001', 0, 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_sessions_keys`
-- 

CREATE TABLE `phpbb_sessions_keys` (
  `key_id` varchar(32) NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `last_ip` varchar(8) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  PRIMARY KEY  (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_sessions_keys`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_smilies`
-- 

CREATE TABLE `phpbb_smilies` (
  `smilies_id` smallint(5) unsigned NOT NULL auto_increment,
  `code` varchar(50) default NULL,
  `smile_url` varchar(100) default NULL,
  `emoticon` varchar(75) default NULL,
  PRIMARY KEY  (`smilies_id`)
) TYPE=MyISAM AUTO_INCREMENT=43 ;

-- 
-- 导出表中的数据 `phpbb_smilies`
-- 

INSERT INTO `phpbb_smilies` VALUES (1, ':D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO `phpbb_smilies` VALUES (2, ':-D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO `phpbb_smilies` VALUES (3, ':grin:', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO `phpbb_smilies` VALUES (4, ':)', 'icon_smile.gif', 'Smile');
INSERT INTO `phpbb_smilies` VALUES (5, ':-)', 'icon_smile.gif', 'Smile');
INSERT INTO `phpbb_smilies` VALUES (6, ':smile:', 'icon_smile.gif', 'Smile');
INSERT INTO `phpbb_smilies` VALUES (7, ':(', 'icon_sad.gif', 'Sad');
INSERT INTO `phpbb_smilies` VALUES (8, ':-(', 'icon_sad.gif', 'Sad');
INSERT INTO `phpbb_smilies` VALUES (9, ':sad:', 'icon_sad.gif', 'Sad');
INSERT INTO `phpbb_smilies` VALUES (10, ':o', 'icon_surprised.gif', 'Surprised');
INSERT INTO `phpbb_smilies` VALUES (11, ':-o', 'icon_surprised.gif', 'Surprised');
INSERT INTO `phpbb_smilies` VALUES (12, ':eek:', 'icon_surprised.gif', 'Surprised');
INSERT INTO `phpbb_smilies` VALUES (13, ':shock:', 'icon_eek.gif', 'Shocked');
INSERT INTO `phpbb_smilies` VALUES (14, ':?', 'icon_confused.gif', 'Confused');
INSERT INTO `phpbb_smilies` VALUES (15, ':-?', 'icon_confused.gif', 'Confused');
INSERT INTO `phpbb_smilies` VALUES (16, ':???:', 'icon_confused.gif', 'Confused');
INSERT INTO `phpbb_smilies` VALUES (17, '8)', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (18, '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (19, ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (20, ':lol:', 'icon_lol.gif', 'Laughing');
INSERT INTO `phpbb_smilies` VALUES (21, ':x', 'icon_mad.gif', 'Mad');
INSERT INTO `phpbb_smilies` VALUES (22, ':-x', 'icon_mad.gif', 'Mad');
INSERT INTO `phpbb_smilies` VALUES (23, ':mad:', 'icon_mad.gif', 'Mad');
INSERT INTO `phpbb_smilies` VALUES (24, ':P', 'icon_razz.gif', 'Razz');
INSERT INTO `phpbb_smilies` VALUES (25, ':-P', 'icon_razz.gif', 'Razz');
INSERT INTO `phpbb_smilies` VALUES (26, ':razz:', 'icon_razz.gif', 'Razz');
INSERT INTO `phpbb_smilies` VALUES (27, ':oops:', 'icon_redface.gif', 'Embarassed');
INSERT INTO `phpbb_smilies` VALUES (28, ':cry:', 'icon_cry.gif', 'Crying or Very sad');
INSERT INTO `phpbb_smilies` VALUES (29, ':evil:', 'icon_evil.gif', 'Evil or Very Mad');
INSERT INTO `phpbb_smilies` VALUES (30, ':twisted:', 'icon_twisted.gif', 'Twisted Evil');
INSERT INTO `phpbb_smilies` VALUES (31, ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes');
INSERT INTO `phpbb_smilies` VALUES (32, ':wink:', 'icon_wink.gif', 'Wink');
INSERT INTO `phpbb_smilies` VALUES (33, ';)', 'icon_wink.gif', 'Wink');
INSERT INTO `phpbb_smilies` VALUES (34, ';-)', 'icon_wink.gif', 'Wink');
INSERT INTO `phpbb_smilies` VALUES (35, ':!:', 'icon_exclaim.gif', 'Exclamation');
INSERT INTO `phpbb_smilies` VALUES (36, ':?:', 'icon_question.gif', 'Question');
INSERT INTO `phpbb_smilies` VALUES (37, ':idea:', 'icon_idea.gif', 'Idea');
INSERT INTO `phpbb_smilies` VALUES (38, ':arrow:', 'icon_arrow.gif', 'Arrow');
INSERT INTO `phpbb_smilies` VALUES (39, ':|', 'icon_neutral.gif', 'Neutral');
INSERT INTO `phpbb_smilies` VALUES (40, ':-|', 'icon_neutral.gif', 'Neutral');
INSERT INTO `phpbb_smilies` VALUES (41, ':neutral:', 'icon_neutral.gif', 'Neutral');
INSERT INTO `phpbb_smilies` VALUES (42, ':mrgreen:', 'icon_mrgreen.gif', 'Mr. Green');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_themes`
-- 

CREATE TABLE `phpbb_themes` (
  `themes_id` mediumint(8) unsigned NOT NULL auto_increment,
  `template_name` varchar(30) NOT NULL default '',
  `style_name` varchar(30) NOT NULL default '',
  `head_stylesheet` varchar(100) default NULL,
  `body_background` varchar(100) default NULL,
  `body_bgcolor` varchar(6) default NULL,
  `body_text` varchar(6) default NULL,
  `body_link` varchar(6) default NULL,
  `body_vlink` varchar(6) default NULL,
  `body_alink` varchar(6) default NULL,
  `body_hlink` varchar(6) default NULL,
  `tr_color1` varchar(6) default NULL,
  `tr_color2` varchar(6) default NULL,
  `tr_color3` varchar(6) default NULL,
  `tr_class1` varchar(25) default NULL,
  `tr_class2` varchar(25) default NULL,
  `tr_class3` varchar(25) default NULL,
  `th_color1` varchar(6) default NULL,
  `th_color2` varchar(6) default NULL,
  `th_color3` varchar(6) default NULL,
  `th_class1` varchar(25) default NULL,
  `th_class2` varchar(25) default NULL,
  `th_class3` varchar(25) default NULL,
  `td_color1` varchar(6) default NULL,
  `td_color2` varchar(6) default NULL,
  `td_color3` varchar(6) default NULL,
  `td_class1` varchar(25) default NULL,
  `td_class2` varchar(25) default NULL,
  `td_class3` varchar(25) default NULL,
  `fontface1` varchar(50) default NULL,
  `fontface2` varchar(50) default NULL,
  `fontface3` varchar(50) default NULL,
  `fontsize1` tinyint(4) default NULL,
  `fontsize2` tinyint(4) default NULL,
  `fontsize3` tinyint(4) default NULL,
  `fontcolor1` varchar(6) default NULL,
  `fontcolor2` varchar(6) default NULL,
  `fontcolor3` varchar(6) default NULL,
  `span_class1` varchar(25) default NULL,
  `span_class2` varchar(25) default NULL,
  `span_class3` varchar(25) default NULL,
  `img_size_poll` smallint(5) unsigned default NULL,
  `img_size_privmsg` smallint(5) unsigned default NULL,
  `online_color` varchar(6) default NULL,
  `offline_color` varchar(6) default NULL,
  `hidden_color` varchar(6) default NULL,
  PRIMARY KEY  (`themes_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_themes`
-- 

INSERT INTO `phpbb_themes` VALUES (1, 'subSilver', 'subSilver', 'subSilver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, ''Courier New'', sans-serif', 12, 12, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL, '008500', 'DF0000', 'EBD400');
INSERT INTO `phpbb_themes` VALUES (2, 'cnphpbbice', 'cnphpbbice', 'cnphpbbice.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, ''Courier New'', sans-serif', 12, 12, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL, '008500', 'DF0000', 'EBD400');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_themes_name`
-- 

CREATE TABLE `phpbb_themes_name` (
  `themes_id` smallint(5) unsigned NOT NULL default '0',
  `tr_color1_name` char(50) default NULL,
  `tr_color2_name` char(50) default NULL,
  `tr_color3_name` char(50) default NULL,
  `tr_class1_name` char(50) default NULL,
  `tr_class2_name` char(50) default NULL,
  `tr_class3_name` char(50) default NULL,
  `th_color1_name` char(50) default NULL,
  `th_color2_name` char(50) default NULL,
  `th_color3_name` char(50) default NULL,
  `th_class1_name` char(50) default NULL,
  `th_class2_name` char(50) default NULL,
  `th_class3_name` char(50) default NULL,
  `td_color1_name` char(50) default NULL,
  `td_color2_name` char(50) default NULL,
  `td_color3_name` char(50) default NULL,
  `td_class1_name` char(50) default NULL,
  `td_class2_name` char(50) default NULL,
  `td_class3_name` char(50) default NULL,
  `fontface1_name` char(50) default NULL,
  `fontface2_name` char(50) default NULL,
  `fontface3_name` char(50) default NULL,
  `fontsize1_name` char(50) default NULL,
  `fontsize2_name` char(50) default NULL,
  `fontsize3_name` char(50) default NULL,
  `fontcolor1_name` char(50) default NULL,
  `fontcolor2_name` char(50) default NULL,
  `fontcolor3_name` char(50) default NULL,
  `span_class1_name` char(50) default NULL,
  `span_class2_name` char(50) default NULL,
  `span_class3_name` char(50) default NULL,
  PRIMARY KEY  (`themes_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_themes_name`
-- 

INSERT INTO `phpbb_themes_name` VALUES (1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');
INSERT INTO `phpbb_themes_name` VALUES (2, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics`
-- 

CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(8) unsigned NOT NULL default '0',
  `topic_title` char(120) NOT NULL default '',
  `topic_poster` mediumint(8) NOT NULL default '0',
  `topic_time` int(11) NOT NULL default '0',
  `topic_views` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies` mediumint(8) unsigned NOT NULL default '0',
  `topic_status` tinyint(3) NOT NULL default '0',
  `topic_vote` tinyint(1) NOT NULL default '0',
  `topic_type` tinyint(3) NOT NULL default '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_attachment` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_moved_id` (`topic_moved_id`),
  KEY `topic_status` (`topic_status`),
  KEY `topic_type` (`topic_type`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_topics`
-- 

INSERT INTO `phpbb_topics` VALUES (1, 1, '欢迎来到phpBB论坛', 2, 972086460, 0, 0, 0, 0, 0, 1, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics_watch`
-- 

CREATE TABLE `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_topics_watch`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_user_group`
-- 

CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `user_pending` tinyint(1) default NULL,
  `group_moderator` tinyint(1) NOT NULL default '0',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_user_group`
-- 

INSERT INTO `phpbb_user_group` VALUES (1, -1, 0, 0);
INSERT INTO `phpbb_user_group` VALUES (2, 2, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users`
-- 

CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) NOT NULL default '0',
  `user_active` tinyint(1) default '1',
  `username` varchar(25) NOT NULL default '',
  `user_password` varchar(32) NOT NULL default '',
  `user_session_time` int(11) NOT NULL default '0',
  `user_session_page` smallint(5) NOT NULL default '0',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_regdate` int(11) NOT NULL default '0',
  `user_level` tinyint(4) default '0',
  `user_posts` mediumint(8) unsigned NOT NULL default '0',
  `user_timezone` decimal(5,2) NOT NULL default '0.00',
  `user_style` tinyint(4) default NULL,
  `user_lang` varchar(255) default NULL,
  `user_dateformat` varchar(14) NOT NULL default 'd M Y H:i',
  `user_new_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_emailtime` int(11) default NULL,
  `user_viewemail` tinyint(1) default NULL,
  `user_attachsig` tinyint(1) default NULL,
  `user_allowhtml` tinyint(1) default '1',
  `user_allowbbcode` tinyint(1) default '1',
  `user_allowsmile` tinyint(1) default '1',
  `user_allowavatar` tinyint(1) NOT NULL default '1',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_mass_pm` tinyint(1) default '2',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_notify` tinyint(1) NOT NULL default '1',
  `user_notify_pm` tinyint(1) NOT NULL default '0',
  `user_popup_pm` tinyint(1) NOT NULL default '0',
  `user_rank` int(11) default '0',
  `user_avatar` varchar(100) default NULL,
  `user_avatar_type` tinyint(4) NOT NULL default '0',
  `user_email` varchar(255) default NULL,
  `user_icq` varchar(15) default NULL,
  `user_website` varchar(100) default NULL,
  `user_from` varchar(100) default NULL,
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(10) default NULL,
  `user_aim` varchar(255) default NULL,
  `user_yim` varchar(255) default NULL,
  `user_msnm` varchar(255) default NULL,
  `user_occ` varchar(100) default NULL,
  `user_interests` varchar(255) default NULL,
  `user_actkey` varchar(32) default NULL,
  `user_newpasswd` varchar(32) default NULL,
  `user_warnings` smallint(5) default '0',
  `user_birthday` int(11) NOT NULL default '999999',
  `user_next_birthday_greeting` int(11) NOT NULL default '0',
  `user_show_quickreply` tinyint(1) NOT NULL default '1',
  `user_quickreply_mode` tinyint(1) NOT NULL default '1',
  `user_gender` tinyint(4) NOT NULL default '0',
  `user_allow_ag` tinyint(1) NOT NULL default '1',
  `user_open_quickreply` tinyint(1) NOT NULL default '1',
  `user_skype` varchar(255) default NULL,
  `user_login_tries` smallint(5) unsigned NOT NULL default '0',
  `user_last_login_try` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  KEY `user_session_time` (`user_session_time`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_users`
-- 

INSERT INTO `phpbb_users` VALUES (-1, 0, 'Anonymous', '', 0, 0, 0, 1164009216, 0, 0, 0.00, NULL, '', '', 0, 0, 0, NULL, 0, 0, 0, 1, 1, 1, 0, 2, 1, 0, 1, 0, NULL, '', 0, '', '', '', '', '', NULL, '', '', '', '', '', '', '', 0, 999999, 0, 0, 0, 0, 1, 0, NULL, 0, 0);
INSERT INTO `phpbb_users` VALUES (2, 1, 'dev', 'f6af7afd01d4eb0dc5fe0a342cd6cee7', 1164009384, 0, 1164009268, 1164009216, 1, 1, 8.00, 1, 'chinese_simplified', 'Y-M-d D, ag:i', 0, 0, 0, NULL, 1, 0, 0, 1, 1, 1, 1, 2, 1, 0, 1, 1, 1, '', 0, 'arzen1013@gmail.com', '', '', '', '', NULL, '', '', '', '', '', '', '', 0, 999999, 0, 1, 1, 0, 1, 1, NULL, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_vote_desc`
-- 

CREATE TABLE `phpbb_vote_desc` (
  `vote_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL default '0',
  `vote_length` int(11) NOT NULL default '0',
  `vote_max` int(3) NOT NULL default '1',
  `vote_voted` int(7) NOT NULL default '0',
  `vote_hide` tinyint(1) NOT NULL default '0',
  `vote_tothide` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`vote_id`),
  KEY `topic_id` (`topic_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_vote_desc`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_vote_results`
-- 

CREATE TABLE `phpbb_vote_results` (
  `vote_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_option_id` tinyint(4) unsigned NOT NULL default '0',
  `vote_option_text` varchar(255) NOT NULL default '',
  `vote_result` int(11) NOT NULL default '0',
  KEY `vote_option_id` (`vote_option_id`),
  KEY `vote_id` (`vote_id`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_vote_results`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_vote_voters`
-- 

CREATE TABLE `phpbb_vote_voters` (
  `vote_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_user_id` mediumint(8) NOT NULL default '0',
  `vote_user_ip` char(8) NOT NULL default '',
  KEY `vote_id` (`vote_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) TYPE=MyISAM;

-- 
-- 导出表中的数据 `phpbb_vote_voters`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_words`
-- 

CREATE TABLE `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` char(100) NOT NULL default '',
  `replacement` char(100) NOT NULL default '',
  PRIMARY KEY  (`word_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_words`
-- 

