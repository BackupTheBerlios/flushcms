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
   | Author: John.meng(��Զ��)  Dec 8, 2005 8:45:48 AM                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: MenuConfig.php,v 1.7 2005/12/21 07:20:17 arzen Exp $ */

$MainMenu = array(
// home menu
	"Home"=>array(
		'ico' => "frontpage.png",
		'title' => $__Lang__['langGeneralHome'], 
		'url' => '?'
	),
// menu	
	"Menu"=>array(
		'ico' => "menu.png",
		'title' => $__Lang__['langMenu'], 
		'url' => '',
		'sub' => array(
		
			"SystemMenu"=>array(
				'title' => $__Lang__['langGeneralSystem'].$__Lang__['langMenu'], 
				'url' => '',
				'sub' => array(
					"AddMenu"=>array(
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langMenu'], 
						'url' => '?Module=General&Page=SystemMenu&Action=Add'
					),
					"MenuList"=>array(
						'title' => $__Lang__['langGeneralSystem'].$__Lang__['langMenu'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=SystemMenu'
					),
				)
			
			)
			
		)
	),
// user menu	
	"User"=>array(
		'ico' => "users.png",
		'title' => $__Lang__['langMenuUser'], 
		'url' => '',
		'sub' => array(
		
			"UserList"=>array(
				'title' => $__Lang__['langMenuUser'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddMenu"=>array(
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langMenuUser'], 
						'url' => '?Module=General&Page=SystemMenu&Action=Add'
					),
					"MenuList"=>array(
						'title' =>$__Lang__['langMenuUser'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=SystemMenu'
					),
				)
			
			),

			"GroupList"=>array(
				'title' => $__Lang__['langUserGroup'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddMenu"=>array(
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langUserGroup'], 
						'url' => '?Module=General&Page=SystemMenu&Action=Add'
					),
					"MenuList"=>array(
						'title' =>$__Lang__['langUserGroup'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=SystemMenu'
					),
				)
			
			)
			
		)
	),
// module menu
	"Module"=>array(
		'ico' => "config.png",
		'title' => $__Lang__['langMenu'], 
		'url' => '',
		'sub' => array(
		
			"SystemMenu"=>array(
				'title' => $__Lang__['langMenuModule'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddMenu"=>array(
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langMenuModule'], 
						'url' => '?Module=General&Page=SystemMenu&Action=Add'
					),
					"MenuList"=>array(
						'title' =>$__Lang__['langMenuModule'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=Module'
					),
				)
			
			)
			
		)
	)

);

?>
