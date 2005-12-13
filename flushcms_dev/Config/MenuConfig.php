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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 8, 2005 8:45:48 AM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: MenuConfig.php,v 1.5 2005/12/13 08:58:12 arzen Exp $ */
//$MainMenu = array(
//	array("PID"=>0,"ID"=>1,"Name"=>$__Lang__['langMenu'],"URL"=>"###")
//	);
	
$MainMenu[0]['Name']= $__Lang__['langMenuGeneral'];
$MainMenu[0]['URL']= "####";
$MainMenu[0][0]['Name']= $__Lang__['langMenuModule'].$__Lang__['langGeneralList'];
$MainMenu[0][0]['URL']= "?Module=General&Page=Module";
$MainMenu[0][1]['Name']= $__Lang__['langMenuUser'].$__Lang__['langGeneralList'];
$MainMenu[0][1]['URL']= "?Module=General&Page=User";

?>
