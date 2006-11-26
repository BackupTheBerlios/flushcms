<?php
/**
 *
 * front.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: front_en.php,v 1.1 2006/11/26 23:39:59 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');
$DefaultModule = "default";
$DefaultPage = "index";
$site_menu = array(
	"Home"=>"front_en.php",
	"Download"=>"front_en.php/default/index/download",
	"News"=>"front_en.php/default/index/tech/4",
	"Tutorial"=>"front_en.php/default/index/tech",
	"Product"=>"front_en.php/default/index/develop",
	"Feedback"=>"front_en.php/default/index/feedback",
	"Forum"=>"../bbs",
	"Chinese"=>"front.php",
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