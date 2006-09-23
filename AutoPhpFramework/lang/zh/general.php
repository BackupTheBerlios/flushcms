<?php
/**
 *
 * general.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: general.php,v 1.7 2006/09/23 02:34:51 arzen Exp $
 */
$this->setCharset('gb2312'); 
$messages = array(
	'site_title' => 'AutoPhpFramework',
	'Copyright' => '&copy; 2006 Copyright Arzen Inc.',
	'Home' => 'Home',
	'Users' => 'Users',
	'News' => 'News',
	'NewsCategory' => 'News Category',

	'AreYouSure' => 'Listing',
	'Create' => 'Create',
	'MoveUp' => '上移',
	'MoveDown' => '下移',
	'Action' => 'Action',
	'Active' => 'State',

	'Please check here' => '请检查此处',
	'Your modifications have been saved' => '您的更改已保存',
);
$this->set($messages);

?>
