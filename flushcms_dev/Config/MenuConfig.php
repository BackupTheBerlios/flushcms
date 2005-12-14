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
 
/* $Id: MenuConfig.php,v 1.6 2005/12/14 09:49:59 arzen Exp $ */
	
$MainMenu = array(
			    'General' => array(
			        'title' => $__Lang__['langMenuGeneral'], 
			        'url' => '####',
			        'sub' => array(
			            11 => array(
									'title' => $__Lang__['langMenuModule'].$__Lang__['langGeneralList'],
									'url' => '?Module=General&Page=Module'
									),
			            12 => array(
					                'title' => $__Lang__['langMenuUser'].$__Lang__['langGeneralList'], 
					                'url' => '?Module=General&Page=User'
			            			)
			        )
			    )
			);

?>
