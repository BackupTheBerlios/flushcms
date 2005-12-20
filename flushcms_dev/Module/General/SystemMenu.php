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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 20, 2005 10:56:43 AM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: SystemMenu.php,v 1.1 2005/12/20 09:37:22 arzen Exp $ */

if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once("SystemMenu.class.php");
$thisObj = new SystemMenu();

switch ($_REQUEST['Action']) 
{
	case 'Add':
			$thisObj->opAdd();
		break;
		
	default:
		$thisObj->viewList();
		break;
}

?>
