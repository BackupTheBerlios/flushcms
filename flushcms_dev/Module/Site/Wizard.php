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
 
/* $Id: Wizard.php,v 1.4 2006/01/22 02:36:45 arzen Exp $ */
if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once("ModuleConfig.php");

include_once("Wizard.class.php");

$thisObj = new Wizard();

switch ($_REQUEST['Action']) 
{
	case 'Step2':
			$thisObj->opStep2();
		break;
		
	case 'Step3':
			$thisObj->opStep3();
		break;

	default:
		$thisObj->opStep1();
		break;
}
?>