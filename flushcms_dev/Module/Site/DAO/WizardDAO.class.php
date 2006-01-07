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
   | Author: John.meng(цот╤РШ)  2006-1-7 10:52:21                        
   +----------------------------------------------------------------------+
 */

/* $Id: WizardDAO.class.php,v 1.1 2006/01/07 05:02:37 arzen Exp $ */

/**
 * User class handle
 * @package	Module
 */
include_once(APP_DIR."DBApp.class.php");

class WizardDAO extends DBApp
{

	function WizardDAO()
	{
	}
	/**
	 * Get site var name value
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version - 2006-1-7 11:43:05
	 * @param   string   $var_name
	 *
	 */
	function getSiteVarValue ($var_name) 
	{
		global $SiteDB;
		
		$Sql = " SELECT * FROM ".SITE_CONFIG_TABLE." WHERE VarName='$var_name' AND UserID='".$_SESSION['UsersID']."' AND VersionCode = '".$_SESSION['CURRENT_LANG']."' ";
		$row = $SiteDB->GetRow($Sql);
		return $row['VarValue'];
	}
	
}
?>