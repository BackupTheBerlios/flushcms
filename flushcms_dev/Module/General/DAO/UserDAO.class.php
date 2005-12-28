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
   | Author: John.meng(цот╤РШ)  Dec 15, 2005 8:46:33 AM                        
   +----------------------------------------------------------------------+
 */

/* $Id: UserDAO.class.php,v 1.4 2005/12/28 05:45:55 arzen Exp $ */

/**
 * User class handle
 * @package	Module
 */
include_once(APP_DIR."DBApp.class.php");
class UserDAO extends DBApp
{

	function UserDAO()
	{
	}
	/**
	* Insert into user to database
	*
	* @author	John.meng
	* @since    version1.0 - Dec 15, 2005
	* @param	array    $record   record array
	* @return   void
	*/
	function addUser ($record) 
	{
		global $SiteDB;
		$SiteDB->AutoExecute(USERS_TABLE,$record,'INSERT');
		return $SiteDB->Insert_ID();

	}
	/**
	* Get all users from user table
	*
	* @author	John.meng
	* @since    version1.0 - Dec 15, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getAllUsers () 
	{
		global $SiteDB;
		$Sql = " SELECT * FROM ".USERS_TABLE;
		return $SiteDB->GetAll($Sql);
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 28, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getNotGroupUsers () 
	{
		global $SiteDB;
		$Sql =" SELECT UsersID,UserName FROM ".USERS_TABLE;
		$GSql = "SELECT UsersID FROM ".UGROUPS_TABLE;
		if ($groupUsersArr = $SiteDB->GetAll($GSql)) 
		{
			$exist_users_arr = array();
			foreach($groupUsersArr as $key=>$value)
			{
				$exist_users_arr[] = $value['UsersID'];
			}
			
			$Sql .=" WHERE UsersID NOT IN (".implode(',',$exist_users_arr).")";
		}
		$users_arr = $SiteDB->GetAll($Sql);
		$all_users_arr = array();
		foreach($users_arr as $key=>$value)
		{
			$all_users_arr[$value['UsersID']] = $value['UserName'];
		}
		return $all_users_arr;
	}
	
	
	
}
?>