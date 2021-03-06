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
   | Author: John.meng(��Զ��)  2006-1-21 14:47:27                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: ModuleSingleContent.php,v 1.1 2006/01/21 08:58:07 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once("ModuleConfig.php");

$class_path =INCLUDE_DIR. "editor/";
include_once($class_path."class.rich.php");

include_once("ModuleSingleContent.class.php");

$thisObj = new ModuleSingleContent();

switch ($_REQUEST['Action']) 
{
	case 'Add':
		$thisObj->opAdd();
		break;

	case 'Detail':
		$thisObj->opDetail();
		break;

	default:
		$thisObj->toHtml();
		break;
}


?>
