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
   | Author: John.meng(��Զ��)  2006-1-15 17:27:17                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: ModuleHome.php,v 1.5 2006/01/24 14:38:08 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("ModuleQuickLink.php");
include_once("ModuleNews.class.php");
$ModuleNewsObj= & new ModuleNews();
$smarty_site->assign("__site_main__",$ModuleNewsObj->getTopNews (5));
$__this_publish_file_name="index.htm";
?>
