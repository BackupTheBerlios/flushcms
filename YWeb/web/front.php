<?php
/**
 *
 * front.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: front.php,v 1.5 2006/11/11 04:28:49 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');
$DefaultModule = "default";
$DefaultPage = "index";
$site_menu = array(
	"首页"=>"",
	"开发产品"=>"/default/index/develop",
	"企业服务"=>"/default/index/solution",
	"技术文档"=>"/default/index/tech",
	"域名注册"=>"/default/index/domain",
	"新闻事件"=>"/default/index/tech/4",
	"即时反馈"=>"/default/index/feedback",
	"关于我们"=>"/default/index/aboutus",
);

$site_menu_str = "";
$bottom_menu_str = "";
foreach($site_menu as $key=>$value)
{
	$site_menu_str .= "<td background=\"".URLHelper::getWebBaseURL ().$WebTemplateDir."images/menu_bg.gif\" valign=\"middle\" background=\"{TEMPLATEDIR}images/menu_bg.gif\" height=\"45\" width=\"91\" align=\"center\" > <a href=\"{$WebBaseDir}{$value}\" title=\"\">{$key}</a></td>";
	$bottom_menu_str .= "<a href=\"{$WebBaseDir}{$value}\" title=\"{$key}\" class=\"active\">{$key}</a> | ";
}
$template->setVar(array (
	"MAIN_MENU" => $site_menu_str,
	"BOTTOM_MENU" => rtrim($bottom_menu_str,"| "),
));

$controller->dispatch();
?>