<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005-2006 The FlushPHP Group                           |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(��Զ��)  2006-1-15 15:56:14                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: SiteInit.php,v 1.9 2006/01/24 14:38:08 arzen Exp $ */
include_once("ModuleConfig.php");

include_once("DAO/WizardDAO.class.php");
include_once("DAO/SiteMenuDAO.class.php");

// -------  right menu define ---- start
if (__IS_ADMIN__ == 'Yes') 
{
	function __getRightMenu ($js_function) 
	{
		return " onmousedown=\"$js_function;\" ";
	}
	$smarty_site->assign("__right_menu_header__",__getRightMenu("showLogoRightMenu()"));
	$smarty_site->assign("__right_menu_copyright__",__getRightMenu("showCopyRightRightMenu()"));
	$smarty_site->assign("__right_menu_simple_home__",__getRightMenu("showSimpleHomeRightMenu()"));
	
	$smarty_site->assign("__right_menu_news_content__",__getRightMenu("showNewsContentRightMenu()"));
	$smarty_site->assign("__right_menu_single_content__",__getRightMenu("showSingleContentRightMenu()"));
}
// -------  right menu define ---- end

/**
 *
 *
 * @author  John.meng (��Զ��)
 * @since   version - 2006-1-21 17:05:26
 * @param   string  
 *
 */
function siteVersion () 
{
	global $__Lang__,$UrlParameter;
	$en=$__Lang__['langVersionEn-us'];
	$cn=$__Lang__['langVersionZh-cn'];
	if (__IS_ADMIN__ == 'Yes') 
	{
		$en_url="$UrlParameter&Ver=en-us";
		$cn_url="$UrlParameter&Ver=zh-cn";
	} 
	else 
	{
		$en_url="../en-us/?Ver=en-us";
		$cn_url="../zh-cn/?Ver=zh-cn";
	}
	$html_code=<<<EOT
	<TABLE>
	<TR>
		<TD> <a href="$en_url" >$en</a> | </TD>
		<TD> <a href="$cn_url" >$cn</a> </TD>
	</TR>
	</TABLE>
EOT;
	return $html_code;
}

$wizardDAO = & new WizardDAO();
$siteMenuDAO = & new SiteMenuDAO();
$__site_title__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_NAME']);
$__site_copyright__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_COPYRIGHT']);
$__site_keyword__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_KEYWORD']);

if ($site_logo = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_LOGO'])) 
{
	$swf_image_obj = $FlushPHPObj->loadUtility("ViewImgSwf");
	$__site_logo__ = $swf_image_obj->displayIt($site_logo,NULL,NULL,NULL,HTML_IMAGES_DIR);
}					

$__site_top_menu__ = $siteMenuDAO->getTopMenu();

$smarty_site->assign("__site_title__",$__site_title__);
$smarty_site->assign("__site_copyright__",$__site_copyright__);
$smarty_site->assign("__site_keyword__",$__site_keyword__);
$smarty_site->assign("__site_logo__",$__site_logo__);
$smarty_site->assign("__site_top_menu__",$__site_top_menu__);
$smarty_site->assign("__site_version__",siteVersion());
if ($menu_id = $_GET['MenuID']) 
{
	$row = $siteMenuDAO->getRowByID (SITE_MENU_TABLE,"SiteMenuID",$menu_id);
	$site_module_scripte = $row['Module'];
	$site_module_template = "Menu.".$row['SiteMenuID'].".tpl.htm";
}
else if($row = $siteMenuDAO->getHomeModule())
{
	$site_module_scripte = $row['Module'];
	$site_module_template = "Menu.".$row['SiteMenuID'].".tpl.htm";
}
include_once($site_module_scripte.".php");
$html_code = $smarty_site->fetch($site_module_template);
$replace_str = ( __IS_ADMIN__ == 'Yes')?"../HTML/".$_SESSION['CURRENT_LANG']."/":"";
$html_code = str_replace(CURRENT_HTML_DIR,$replace_str,$html_code);

if ($_GET['Pub']=="YES" && $__this_publish_file_name ) 
{
	$patten=array("../HTML/".$_SESSION['CURRENT_LANG']."/","onmousedown","Module=Site&Page=Preview&");
	$replace=array("","tag","");
	$html_code_pub = str_replace($patten,$replace,$html_code);
	
	$pub_file_name=CURRENT_HTML_DIR."/".$__this_publish_file_name;
	
	$PublishObj = $FlushPHPObj->loadApp("Publish");
	$PublishObj->writeFileText($pub_file_name,$html_code_pub);
}
?>
