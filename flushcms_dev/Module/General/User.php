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
 
/* $Id: User.php,v 1.2 2005/12/14 13:46:32 arzen Exp $ */
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
		
	case 'GroupList':
			$select_tab = 1;
		break;

	case 'GroupUser':
			$select_tab = 2;
		break;

	case 'Configure':
			$select_tab = 3;
		break;
	
	default:
		$thisObj->viewList();
		break;
}

?>
