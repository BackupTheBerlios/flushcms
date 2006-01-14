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
   | Author: John.meng(цот╤РШ)  2005-12-2 19:46:39                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: FlushPHP.class.php,v 1.8 2006/01/14 11:33:05 arzen Exp $ */

/**
 * @package	Kelnel
 */
class FlushPHP
{

	function FlushPHP()
	{
		global $__Lang__,$__CURRENT_LANGUAGE__;
		$LangObj = $this->loadApp("Language");
		$__Lang__ = $LangObj->initLanguage();
		$__CURRENT_LANGUAGE__ = $LangObj->getFirstLanguage();
	}
	
	/**
	 * Load Utility
	 *
	 * @author  John.meng (цот╤РШ)
	 * @date    2005-12-2 22:05:14
	 * @param   string  $name
	 *
	 */
	function &loadUtility ($name) 
	{
		global $__Lang__;
		$util_name = UTIL_DIR.$name.".class.php";
		if (file_exists($util_name)) 
		{
			include_once($util_name);
			$util_obj = & new $name;
			return $util_obj;
		} 
		else 
		{
			return $__Lang__["langGeneralFileNotExist"];
		}
		
	}
	
	/**
	* Load App class
	*
	* @author	John.meng (цот╤РШ)
	* @date		Dec 5, 2005 12:31:37 PM
	* @param	string $name	
	* @return	class object
	*/
	function &loadApp ($name)
	{
		global $__Lang__;
		$util_name = APP_DIR.$name.".class.php";
		if ($util_name) 
		{
			include_once($util_name);
			$util_obj = & new $name;
			return $util_obj;
		} 
		else 
		{
			return $__Lang__["langGeneralFileNotExist"];
		}
		
	}
	/**
	 * Load Module
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version1.0 - 2005-12-11 21:11:13
	 * @param   string  
	 *
	 */
	function loadModule ($Module,$Page) 
	{
		global $__Lang__,$__Version__,$MessageObj,$smarty;
		$Module_file_path = MODULE_DIR.$Module."/".$Page.".php";
		if (file_exists($Module_file_path)) 
		{
			include_once($Module_file_path);
		}
		else 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralFileNotExist'],"ERROR"));
		}
	}
	/**
	* Get Module info
	*
	* @author	John.meng
	* @since    version - Dec 13, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getModuleInfo ($Module) 
	{
		$_mod_desc = array();
		$_mod_desc['name']= $_mod_desc['description']= $Module;
		if (file_exists(MODULE_DIR.$Module."/version.php")) 
		{
			include_once(MODULE_DIR.$Module."/version.php");
		}
		
		return $_mod_desc;
	}
	
	
}
?>