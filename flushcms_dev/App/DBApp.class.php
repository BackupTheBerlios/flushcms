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
   | Author: John.meng(цот╤РШ)  Dec 15, 2005 10:20:12 AM                        
   +----------------------------------------------------------------------+
 */

/* $Id: DBApp.class.php,v 1.4 2005/12/20 14:55:40 arzen Exp $ */

class DBApp
{

	function DBApp()
	{
	}
	
	/**
	* Insert data into table
	*
	* @author	John.meng
	* @since    version 1.0- Dec 20, 2005
	* @param	sting $table  table name
	* @param	array $record inster data array
	* @return   Insert ID
	*/
	function opAdd ($table,$record) 
	{
		global $SiteDB;
		$SiteDB->AutoExecute($table,$record,'INSERT');
		return $SiteDB->Insert_ID();
		
	}
	/**
	 *
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version - 2005-12-20 21:51:10
	 * @param   string  
	 *
	 */
	function opUpdate ($table,$record,$whereis) 
	{
		global $SiteDB;
		$SiteDB->AutoExecute($table,$record,'UPDATE',$whereis);
	}
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getRowByID ($table,$field,$field_value) 
	{
		global $SiteDB;
		
		$Sql = " SELECT * FROM $table WHERE $field='$field_value' ";
		return $SiteDB->GetRow($Sql);
	}
	
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version1.0 - Dec 15, 2005
	* @param	string  $table     table name
	* @param	string  $where_is  select condition
	* @return   dataset first record   
	*/
	function checkExists ($table,$where_is) 
	{
		global $SiteDB;
		$Sql = " SELECT * FROM $table WHERE $where_is ";
		return $SiteDB->GetRow($Sql);
	}
	
}
?>