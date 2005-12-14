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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 9, 2005 2:13:50 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: FlushPHP.php,v 1.8 2005/12/14 10:33:21 arzen Exp $ */

define(ROOT_DIR,dirname(__FILE__));
define(UTIL_DIR,ROOT_DIR."/Utility/");
define(MODULE_DIR,ROOT_DIR."/Module/");
define(INCLUDE_DIR,ROOT_DIR."/Include/");
define(LANG_DIR,ROOT_DIR."/Language/");
define(APP_DIR,ROOT_DIR."/App/");
define(CONFIG_DIR,ROOT_DIR."/Config/");
define(PEAR_DIR,INCLUDE_DIR."/pear/");

include_once(ROOT_DIR."/FlushPHP.class.php");
include_once(CONFIG_DIR."Config.php");
include_once(INCLUDE_DIR."/smarty/Smarty.class.php");
include(INCLUDE_DIR."/adodb/adodb.inc.php");
define(THEMES_DIR,ROOT_DIR."/templates/".$Themes."/");

$__Lang__ = array();
$smarty = new Smarty;

$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir=THEMES_DIR;
$smarty->compile_dir=ROOT_DIR."/templates_c";

$FlushPHPObj = & new FlushPHP();
$MessageObj = $FlushPHPObj->loadApp("Messages");

include_once(CONFIG_DIR."MenuConfig.php");
require_once PEAR_DIR.'HTML/Menu.php';
require_once PEAR_DIR.'HTML/Menu/DirectRenderer.php';
$menu =& new HTML_Menu($MainMenu);
$menu->forceCurrentUrl("?".$_SERVER["QUERY_STRING"]);
$type = 'sitemap';
$renderer =& new HTML_Menu_DirectRenderer();
$renderer->setMenuTemplate("<table border=0>","</table>");
$menu->render($renderer,$type);
// Output the menu
$smarty->assign('MainMenu',$renderer->toHtml());

$FlushPHPObj->loadModule($_REQUEST['Module'],$_REQUEST['Page']);

$SiteDB = & ADONewConnection($DB_Type); # eg. 'mysql' or 'oci8' 
$SiteDB->debug = false;
$SiteDB->Connect($DB_Host, $DB_UserName, $DB_PassWord, $DB_Name) or die($MessageObj->displayMsg($SiteDB->ErrorMsg(),"ERROR"));

?>
