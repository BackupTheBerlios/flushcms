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
   | Author: John.meng(цот╤РШ)  Jan 16, 2006 12:28:50 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id$ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once("ModuleConfig.php");

include_once("ModuleBaseInfo.calss.php");

$thisObj = new ModuleBaseInfo();

switch ($_REQUEST['Action']) 
{
	default:
		$thisObj->opUpdate();
		break;
}

?>