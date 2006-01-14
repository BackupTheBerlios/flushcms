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
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-14 14:27:23                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Preview.php,v 1.1 2006/01/14 11:33:05 arzen Exp $ */
include_once("ModuleConfig.php");

include_once("DAO/WizardDAO.class.php");

// -------  right menu define ---- start
function __getRightMenu ($js_function) 
{
	return " onmousedown=\"$js_function;\" ";
}
$smarty_site->assign("__right_menu_header__",__getRightMenu("showLogoRightMenu()"));
$smarty_site->assign("__right_menu_copyright__",__getRightMenu("showCopyRightRightMenu()"));
// -------  right menu define ---- end

$wizardDAO = & new WizardDAO();
$__site_title__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_NAME']);
$__site_copyright__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_COPYRIGHT']);
$__site_keyword__ = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_KEYWORD']);

if ($site_logo = $wizardDAO->getSiteVarValue($__SITE_VAR__['SITE_LOGO'])) 
{
	$swf_image_obj = $FlushPHPObj->loadUtility("ViewImgSwf");
	$__site_logo__ = $swf_image_obj->displayIt($site_logo,NULL,NULL,NULL,HTML_IMAGES_DIR);
}					


$smarty_site->assign("__site_title__",$__site_title__);
$smarty_site->assign("__site_copyright__",$__site_copyright__);
$smarty_site->assign("__site_keyword__",$__site_keyword__);
$smarty_site->assign("__site_logo__",$__site_logo__);


$html_code = $smarty_site->fetch("index.tpl.htm");
$html_code .= $smarty->fetch("js_right_menu.tpl.htm");
$smarty->assign("Main",$html_code);
?>
