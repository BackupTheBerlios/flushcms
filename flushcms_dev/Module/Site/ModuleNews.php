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
   | Author: John.meng(ÃÏÔ¶òû)  Jan 17, 2006 1:01:50 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id$ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("ModuleConfig.php");

$class_path =INCLUDE_DIR. "editor/";
include_once($class_path."class.rich.php");

include_once("ModuleNews.class.php");
$thisObj = new ModuleNews();

switch ($_REQUEST['Action']) 
{
	case 'Add':
		$thisObj->opAdd();
		break;

	case 'Detail':
		$thisObj->opDetail();
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

	case 'ViewList':
		$thisObj->viewList();
		break;

	default:
		$thisObj->toHtml();
		break;
}

?>
