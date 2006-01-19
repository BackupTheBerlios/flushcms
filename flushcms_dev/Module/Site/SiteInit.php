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
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-15 15:56:14                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: SiteInit.php,v 1.3 2006/01/19 05:31:38 arzen Exp $ */
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
}
// -------  right menu define ---- end

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

?>
