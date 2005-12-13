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
   | Author: John.meng(цот╤РШ)  Dec 13, 2005 4:35:41 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: User.class.php,v 1.2 2005/12/13 10:27:54 arzen Exp $ */

class User
{

	function User()
	{
	}
	
	/**
	* View list
	*
	* @author	John.meng
	* @since    version - Dec 13, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__, $FlushPHPObj, $smarty;
		include_once (APP_DIR."UI.class.php");
		
	    $tabs = array(
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralList'], "Main.php?module=Event&page=my_events"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langGeneralList'], "Main.php?module=Event&page=pas_events"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langMenuUser'], "Main.php?module=Event&page=all_events"),  
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralConfigure'], "Main.php?module=Event&page=e_calendar")
	                  ); 
	           
	    $tab = new Tabset($tabs, 0);
		
		$smarty->assign("Main", $tab->toHtml());
		
	}
	
}
?>