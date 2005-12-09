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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 9, 2005 9:46:51 AM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: index.php,v 1.1 2005/12/09 03:39:56 arzen Exp $ */

include_once("../FlushPHP.class.php");
$FlushPHPObj = new FlushPHP();

$smarty->display("admin_index.tpl.htm");

?>
