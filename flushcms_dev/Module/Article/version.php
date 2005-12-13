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
   | Author: John.meng(цот╤РШ)  Dec 13, 2005 12:15:15 PM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: version.php,v 1.1 2005/12/13 05:36:06 arzen Exp $ */

$_mod_desc['name'] = "Article";
$_mod_desc['version'] = "1.0";
$_mod_desc['description'] = "Article Module";
$_mod_desc['author'] = "Arzen";
$_mod_desc['license'] = "GPL see LICENSE";
$_mod_desc['logo'] = "logo.gif";
$_mod_desc['dirname'] = "Article";

//$_mod_desc['sqlfile']['mysql'] = "sql/mysql.sql";

// Table
$_mod_desc['tables'][0] = "article";

//install
$_mod_desc['onInstall'] = 'include/install.php';
//update
$_mod_desc['onUpdate'] = 'include/update.php';
?>