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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-11 21:18:52                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Module.php,v 1.1 2005/12/13 09:06:35 arzen Exp $ */

if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("Module.class.php");
$thisObj = new Module();

switch ($_REQUEST['Action']) 
{
	case value:
		
		break;
	
	default:
		$thisObj->viewList();
		break;
}
?>
