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
 
/* $Id: FlushPHP.php,v 1.2 2005/12/11 13:25:15 arzen Exp $ */

define(ROOT_DIR,dirname(__FILE__));
define(UTIL_DIR,ROOT_DIR."/Utility/");
define(MODULE_DIR,ROOT_DIR."/Module/");
define(INCLUDE_DIR,ROOT_DIR."/Include/");
define(LANG_DIR,ROOT_DIR."/Language/");
define(APP_DIR,ROOT_DIR."/App/");
define(CONFIG_DIR,ROOT_DIR."/Config/");

include_once(ROOT_DIR."/FlushPHP.class.php");
include_once(CONFIG_DIR."Config.php");
include_once(INCLUDE_DIR."/smarty/Smarty.class.php");
define(THEMES_DIR,ROOT_DIR."/templates/".$Themes."/");
$__Lang__ = array();
$smarty = new Smarty;

$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir=THEMES_DIR;
$smarty->compile_dir=ROOT_DIR."/templates_c";

$FlushPHPObj = new FlushPHP();
$MessageObj = $FlushPHPObj->loadApp("Messages");

include_once(CONFIG_DIR."MenuConfig.php");

$smarty->append('MainMenu',$MainMenu);

$FlushPHPObj->loadModel($_GET['Model'],$_GET['Page']);

?>
