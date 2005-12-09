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
 
/* $Id: FlushPHP.class.php,v 1.2 2005/12/09 03:44:22 arzen Exp $ */

/**
 * @package	Kelnel
 */
define(ROOT_DIR,dirname(__FILE__));
define(UTIL_DIR,ROOT_DIR."/Utility/");
define(MODULE_DIR,ROOT_DIR."/Module/");
define(INCLUDE_DIR,ROOT_DIR."/Include/");
define(LANG_DIR,ROOT_DIR."/Language/");
define(APP_DIR,ROOT_DIR."/App/");
define(CONFIG_DIR,ROOT_DIR."/Config/");
include_once(CONFIG_DIR."Config.php");
include_once(INCLUDE_DIR."/smarty/Smarty.class.php");
define(THEMES_DIR,ROOT_DIR."/templates/".$Themes."/");
$__Lang__ = array();
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir=THEMES_DIR;
$smarty->compile_dir=ROOT_DIR."/templates_c";
class FlushPHP
{

	function FlushPHP()
	{
		global $__Lang__;
		$LangObj = $this->loadApp("Language");
		$__Lang__ = $LangObj->initLanguage();
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
}
?>