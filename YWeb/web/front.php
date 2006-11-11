<?php
/**
 *
 * front.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: front.php,v 1.5 2006/11/11 04:28:49 arzen Exp $
 */
define('APF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('APF_DEBUG',       false);
require_once(APF_ROOT_DIR.DIRECTORY_SEPARATOR.'front_init.php');
$DefaultModule = "default";
$DefaultPage = "index";
$site_menu = array(
	"��ҳ"=>"",
	"������Ʒ"=>"/default/index/develop",
	"��ҵ����"=>"/default/index/solution",
	"�����ĵ�"=>"/default/index/tech",
	"����ע��"=>"/default/index/domain",
	"�����¼�"=>"/default/index/tech/4",
	"��ʱ����"=>"/default/index/feedback",
	"��������"=>"/default/index/aboutus",
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