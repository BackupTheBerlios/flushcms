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
   | Author: John.meng(цот╤РШ)  2006-1-5 22:36:20                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Wizard.php,v 1.1 2006/01/05 15:34:39 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once("Wizard.class.php");

$thisObj = new Wizard();

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
		$thisObj->opStep1();
		break;
}
?>