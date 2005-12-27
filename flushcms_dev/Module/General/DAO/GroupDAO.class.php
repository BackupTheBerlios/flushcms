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

/* $Id: GroupDAO.class.php,v 1.2 2005/12/27 13:22:28 arzen Exp $ */

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
			$group_arr[$value['GroupsID']]=$value['GroupName'];
		}
		asort ($group_arr);
		reset ($group_arr);	
		return 	$group_arr;
	}
	

}
?>