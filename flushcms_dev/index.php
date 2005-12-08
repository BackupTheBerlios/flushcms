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
   | Author: John.meng(цот╤РШ)  2005-12-2 19:46:39                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: index.php,v 1.1 2005/12/08 08:52:36 arzen Exp $ */

include_once("../FlushPHP.class.php");
$FlushPHPObj = new FlushPHP();

$smarty->display("admin_index.tpl.htm");
//echo $test = $FlushPHPObj->loadUtility ("testgdsafd");
//var_dump($__Lang__["langGeneralFileNotExist"]);

//phpinfo();
?>