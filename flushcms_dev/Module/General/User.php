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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 13, 2005 4:34:42 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: User.php,v 1.6 2005/12/26 10:48:38 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("User.class.php");
$thisObj = new User();

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
