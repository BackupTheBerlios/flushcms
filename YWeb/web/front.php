<?php
/**
 *
 * front.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: front.php,v 1.7 2006/11/28 14:49:42 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');
$DefaultModule = "default";
$DefaultPage = "index";
$site_menu = array(
	"首页"=>"front.php",
	"下载"=>"front.php/default/index/download",
	"手册文档"=>"front.php/default/index/manual",
//	"应用指南"=>"front.php/default/index/tech",
	"新闻事件"=>"front.php/default/index/tech/4",
	"开发产品"=>"front.php/default/index/develop",
	"即时反馈"=>"front.php/default/index/feedback",
	"论坛"=>"../bbs",
	"English"=>"front_en.php",
);

$site_menu_str = "";
$bottom_menu_str = "";
foreach($site_menu as $key=>$value)
{
	$site_menu_str .= "<td background=\"".URLHelper::getWebBaseURL ().$WebTemplateDir."images/menu_bg.gif\" valign=\"middle\" background=\"{TEMPLATEDIR}images/menu_bg.gif\" height=\"45\" width=\"91\" align=\"center\" > <a href=\"{$WebBaseDirName}{$value}\" title=\"\">{$key}</a></td>";
	$bottom_menu_str .= "<a href=\"{$WebBaseDirName}{$value}\" title=\"{$key}\" class=\"active\">{$key}</a> | ";
}
$template->setVar(array (
	"MAIN_MENU" => $site_menu_str,
	"BOTTOM_MENU" => rtrim($bottom_menu_str,"| "),
));

$controller->dispatch();
?>