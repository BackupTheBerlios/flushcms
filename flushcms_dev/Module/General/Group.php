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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 26, 2005 6:04:28 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Group.php,v 1.2 2005/12/27 13:22:28 arzen Exp $ */

if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("Group.class.php");
$thisObj = new Group();

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

	case 'GroupUser':
			$thisObj->opGroupUser();
		break;

	default:
		$thisObj->viewList();
		break;
}
?>
