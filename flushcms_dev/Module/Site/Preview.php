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
   | Author: John.meng(��Զ��)  2006-1-14 14:27:23                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Preview.php,v 1.2 2006/01/15 08:23:02 arzen Exp $ */

include_once("SiteInit.php");

$html_code .= $smarty->fetch("js_right_menu.tpl.htm");
$smarty->assign("Main",$html_code);
?>
