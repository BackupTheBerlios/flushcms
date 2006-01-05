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
 
/* $Id: MenuConfig.php,v 1.16 2006/01/05 15:34:39 arzen Exp $ */

$MainMenu = array(
// home menu
	"Home"=>array(
		'ico' => "frontpage.png",
		'title' => $__Lang__['langGeneralHome'], 
		'url' => '',
		'sub' => array(
		
			"logout"=>array(
				'title' => $__Lang__['langLoginOut'],
				'ico' => 'exit_small.png', 
				'js'=>" onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\" ",
				'url' => '?Action=Logout'
			
			)
			
		)
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
						'ico' =>'doc.gif',
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
				'ico' => 'user_small.png',
				'title' => $__Lang__['langMenuUser'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddUser"=>array(
//						'ico' =>'doc.gif',
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langMenuUser'], 
						'url' => '?Module=General&Page=User&Action=Add'
					),
					"UserList"=>array(
//						'ico' => 'info.gif',
						'title' =>$__Lang__['langMenuUser'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=User'
					),
				)
			
			),

			"GroupList"=>array(
				'ico' => 'users_small.png',
				'title' => $__Lang__['langUserGroup'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddGroup"=>array(
//						'ico' =>'doc.gif',
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langUserGroup'], 
						'url' => '?Module=General&Page=Group&Action=Add'
					),
					"GroupList"=>array(
//						'ico' => 'info.gif',
						'title' =>$__Lang__['langUserGroup'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=Group'
					),
				)
			
			)
			
		)
	),
// module menu
	"Module"=>array(
		'ico' => "config.png",
		'title' => $__Lang__['langMenuModule'], 
		'url' => '',
		'sub' => array(
		
			"ModuleList"=>array(
				'ico' => 'package.gif',
				'title' => $__Lang__['langMenuModule'].$__Lang__['langGeneralList'], 
				'url' => '',
				'sub' => array(
					"AddModule"=>array(
						'title' => $__Lang__['langGeneralAdd'].$__Lang__['langMenuModule'], 
						'url' => '?Module=General&Page=SystemMenu&Action=Add'
					),
					"ModuleList"=>array(
						'title' =>$__Lang__['langMenuModule'].$__Lang__['langGeneralList'], 
						'url' => '?Module=General&Page=Module'
					),
				)
			
			)
			
		)
	),
// site menu
	"Site"=>array(
		'ico' => "earth.gif",
		'title' => $__Lang__['langSite'], 
		'url' => '',
		'sub' => array(
		
			"ModuleList"=>array(
				'ico' => 'wizard.png',
				'title' => $__Lang__['langSite'].$__Lang__['langWizard'], 
				'url' => '?Module=Site&Page=Wizard'			
			)
			
		)
	)

);

?>
