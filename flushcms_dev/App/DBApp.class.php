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

/* $Id: DBApp.class.php,v 1.1 2005/12/15 03:29:22 arzen Exp $ */

class DBApp
{

	function DBApp()
	{
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