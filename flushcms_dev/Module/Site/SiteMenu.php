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
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-8 15:09:01                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: SiteMenu.php,v 1.2 2006/01/15 07:02:57 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once("ModuleConfig.php");

include_once("SiteMenu.class.php");
$thisObj = new SiteMenu();

switch ($_REQUEST['Action']) 
{
	case 'UserList':
			$thisObj->viewList();
		break;

	case 'Add':
			$thisObj->opAdd();
		break;

	case 'Update':
			$thisObj->opAdd();
		break;
		
	case 'Cancel':
			$thisObj->opCancel();
		break;
		
	case 'CancelSelected':
			$thisObj->opCancelSelected();
		break;

	default:
		$thisObj->viewList();
		break;
}

?>
