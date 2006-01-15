<?php

/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005-2006 The FlushPHP Group                           |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-14 9:25:26                        
   +----------------------------------------------------------------------+
 */

/* $Id: SiteMenuDAO.class.php,v 1.2 2006/01/15 07:02:58 arzen Exp $ */

include_once(APP_DIR."DBApp.class.php");
class SiteMenuDAO extends DBApp
{
	var $_menu_arr = array();
	var $_menu_all_arr = array();
	
	function SiteMenuDAO()
	{
	}
	
	function getAllMenu($pid=0,$pre_patten="--")
	{
		global $SiteDB;
		$Sql = " SELECT * FROM ".SITE_MENU_TABLE." WHERE PID = '$pid' ";
		$all_menu = $SiteDB->GetAll($Sql);
		$patten=$pre_patten;
		$this_patten = $patten.$pre_patten;
		if (count($all_menu)) 
		{
			for ($index = 0; $index < sizeof($all_menu); $index++) 
			{
				$menu_id = $all_menu[$index]['SiteMenuID'];
				$menu_title = $all_menu[$index]['Title'];
				$all_menu[$index]['Title']=$this->_menu_arr[$menu_id]=$pre_patten.$menu_title;
				$this->_menu_all_arr[$menu_id]=$all_menu[$index];
				$this->getAllMenu($menu_id,$this_patten);
			}
		}
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getMenuArr () 
	{
		$this->getAllMenu();
		
		return $this->_menu_arr;
	}
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-15 14:00:14
	 * @param   string  
	 *
	 */
	function getMenuAllArr () 
	{
		$this->getAllMenu();
		return $this->_menu_all_arr;
	}
	
}
?>