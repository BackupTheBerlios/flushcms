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
 
/* $Id: index.php,v 1.4 2006/01/22 09:26:07 arzen Exp $ */
$language_string = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$language_arr = explode(",",$language_string);
$this_language = $language_arr[0];

header("location:HTML/".$this_language."/?Ver=".$this_language."");
?>