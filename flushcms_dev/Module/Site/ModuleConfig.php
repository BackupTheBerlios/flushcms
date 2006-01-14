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
 
/* $Id: ModuleConfig.php,v 1.4 2006/01/14 11:33:05 arzen Exp $ */
global $__CURRENT_LANGUAGE__,$FlushPHPObj;

define(HTML_DIR,ROOT_DIR."/HTML/");
define(HTML_IMAGES_DIR,HTML_DIR.$_SESSION['CURRENT_LANG']."/images/");
define(HTML_THEMES_DIR,HTML_DIR.$__CURRENT_LANGUAGE__."/template/");

$smarty_site = new Smarty;
$smarty_site->template_dir=HTML_THEMES_DIR;
$smarty_site->compile_dir=ROOT_DIR."/templates_c";

$__SITE_VAR__['SITE_NAME'] = 'SITE_NAME';
$__SITE_VAR__['SITE_KEYWORD'] = 'SITE_KEYWORD';
$__SITE_VAR__['SITE_COPYRIGHT'] = 'SITE_COPYRIGHT';
$__SITE_VAR__['SITE_LOGO'] = 'SITE_LOGO';

?>
