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
   | Author: John.meng(цот╤РШ)  Dec 26, 2005 6:09:30 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: GroupDAO.class.php,v 1.4 2006/01/04 13:49:53 arzen Exp $ */

/**
 * User class handle
 * @package	Module
 */
 
include_once(APP_DIR."DBApp.class.php");
class GroupDAO extends DBApp
{

	function GroupDAO()
	{
	}
	/**
	 *
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version - 2005-12-26 21:09:28
	 * @param   string  
	 *
	 */
	function getAllGroup () 
	{
		$all_arr = parent::getRows(GROUPS_TABLE);
		$group_arr = array();
		foreach($all_arr as $key => $value)
		{
			$group_id = $value['GroupsID'];
			$group_name = $value['GroupName'];
			$group_arr[$group_name.",".$group_id]=$this->getGroupUsers($group_id);
		}
		asort ($group_arr);
		reset ($group_arr);	
		return 	$group_arr;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 4, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getGroupUsers ($group_id) 
	{
		global $SiteDB;
		$Sql=" SELECT a.UsersID,b.UserName FROM ".UGROUPS_TABLE." AS a LEFT JOIN ".USERS_TABLE." AS b ON a.UsersID=b.UsersID WHERE a.GroupsID ='$group_id' ";
		$all_arr = $SiteDB->GetAll($Sql);
		$group_arr = array();
		if (sizeof($all_arr) && is_array($all_arr)) 
		{
			foreach($all_arr as $key => $value)
			{
				$group_arr[$value['UsersID']]=$value['UserName'];
			}
			asort ($group_arr);
			reset ($group_arr);
		}
		return 	$group_arr;	
	}
	
	

}
?>