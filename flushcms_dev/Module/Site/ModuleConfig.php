<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005 The FlushPHP Group                                |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-5 23:02:59                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: ModuleConfig.php,v 1.7 2006/01/18 05:29:29 arzen Exp $ */
global $__CURRENT_LANGUAGE__,$FlushPHPObj,$__Lang__,$__SITE_VAR__,$__MODULE__,$__TEMPLATES__,$smarty_site;

define(HTML_DIR,ROOT_DIR."/HTML/");
define(CURRENT_HTML_DIR,HTML_DIR.$_SESSION['CURRENT_LANG']."/");
define(HTML_IMAGES_DIR,HTML_DIR.$_SESSION['CURRENT_LANG']."/images/");
define(HTML_THEMES_DIR,HTML_DIR.$__CURRENT_LANGUAGE__."/template/");

$LangObj = $FlushPHPObj->loadApp("Language");
$__ModuleLang__ = $LangObj->initLanguage(MODULE_DIR."Site/Language/");
$__Lang__ = $__ModuleLang__+$__Lang__;

$smarty_site = new Smarty;
$smarty_site->template_dir=HTML_THEMES_DIR;
$smarty_site->compile_dir=ROOT_DIR."/templates_c";

$__SITE_VAR__['SITE_NAME'] = 'SITE_NAME';
$__SITE_VAR__['SITE_KEYWORD'] = 'SITE_KEYWORD';
$__SITE_VAR__['SITE_COPYRIGHT'] = 'SITE_COPYRIGHT';
$__SITE_VAR__['SITE_LOGO'] = 'SITE_LOGO';
$__SITE_VAR__['SITE_QUICKLINK'] = 'SITE_QUICKLINK';

$__MODULE__ = array(
			'ModuleHome'=>$__Lang__['langSiteModuleHomePage'],
			'ModuleNews'=>$__Lang__['langSiteModuleNews']
		);
		
$__TEMPLATES__ = array(
			'simple.info.index'=>$__Lang__['langSiteTemplateSimpleInfoIndex'],
			'flash.index'=>$__Lang__['langSiteTemplateFlashIndex']
			
		);

?>
