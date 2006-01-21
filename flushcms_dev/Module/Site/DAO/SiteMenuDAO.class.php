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

/* $Id: SiteMenuDAO.class.php,v 1.6 2006/01/21 09:16:48 arzen Exp $ */

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
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-15 15:07:39
	 * @param   string  
	 *
	 */
	function getHomeModule () 
	{
		global $SiteDB;
		$Sql = " SELECT * FROM ".SITE_MENU_TABLE." WHERE VersionCode = '".$_SESSION['CURRENT_LANG']."' AND Module='ModuleHome' ";
		return $home_menu = $SiteDB->GetRow($Sql);
		
	}
	
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-15 15:22:10
	 * @param   string  
	 *
	 */
	function getTopMenu () 
	{
		global $SiteDB,$smarty,$UrlParameter;
		$Sql = " SELECT * FROM ".SITE_MENU_TABLE." WHERE VersionCode = '".$_SESSION['CURRENT_LANG']."' AND PID='0' ";
		$all_menu = $SiteDB->GetAll($Sql);
		$HTML_CODE = "<TABLE class = \"site_menu_table\"><TR class = \"site_menu_tr\">";
		for ($index = 0; $index < sizeof($all_menu); $index++) 
		{
			if ($all_menu[$index]['URL']) 
			{
				$menu_url = $all_menu[$index]['URL'];
			} 
			else 
			{
				$prefix_url=(__IS_ADMIN__ == 'Yes')?$UrlParameter:"?";
				$menu_url = $prefix_url."&Ver=".$all_menu[$index]['VersionCode']."&MenuID=".$all_menu[$index]['SiteMenuID']."&PID=".$all_menu[$index]['PID'];
			}
			$HTML_CODE .= "<TD class = \"site_menu_td\"><A HREF=\"$menu_url\" class = \"site_menu_link\" >".$all_menu[$index]['Title']."</A></TD>";
		}
		$HTML_CODE .= "</TR></TABLE>";
		return $HTML_CODE;
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getSubMenu ($PID=0) 
	{
		global $SiteDB,$smarty,$UrlParameter;
		$Sql = " SELECT * FROM ".SITE_MENU_TABLE." WHERE VersionCode = '".$_SESSION['CURRENT_LANG']."' AND PID='".$PID."' ";
		$all_menu = $SiteDB->GetAll($Sql);
		$HTML_CODE = "<TABLE class = \"site_sub_menu_table\">";
		for ($index = 0; $index < sizeof($all_menu); $index++) 
		{
			if ($all_menu[$index]['URL']) 
			{
				$menu_url = $all_menu[$index]['URL'];
			} 
			else 
			{
				$prefix_url=(__IS_ADMIN__ == 'Yes')?$UrlParameter:"?";
				$menu_url = $prefix_url."&Ver=".$all_menu[$index]['VersionCode']."&MenuID=".$all_menu[$index]['SiteMenuID']."&PID=".$all_menu[$index]['PID'];
			}
			$HTML_CODE .= "<TR class = \"site_sub_menu_tr\"><TD class = \"site_sub_menu_td\"><A HREF=\"$menu_url\" class = \"site_sub_menu_link\" >".$all_menu[$index]['Title']."</A></TD></TR>";
		}
		$HTML_CODE .= "</TABLE>";
		return $HTML_CODE;
	}
	
	
}
?>