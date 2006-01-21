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
   | Author: John.meng  (цот╤РШ) Dec 5, 2005 11:20:44 AM                             
   +----------------------------------------------------------------------+
 */
 
/* $Id: Language.class.php,v 1.7 2006/01/21 09:16:48 arzen Exp $ */

/**
 * Load language file
 * @package	App
 */
include_once(UTIL_DIR."Browser.class.php");
class Language extends Browser
{
	function Language () 
	{
	}
	/**
	* Init Language
	*
	* @author	John.meng (цот╤РШ)
	* @date		Dec 5, 2005 12:56:16 PM
	* @param	datatype paramname	
	* @return	
	*/
	function initLanguage ($lang_dir = LANG_DIR)
	{
		
		if ($_SESSION['CURRENT_LANG']) 
		{
			$lang_code = $_SESSION['CURRENT_LANG'];
		}
		else if ($_GET["Ver"]) 
		{
			$lang_code = $_GET["Ver"];
		}
		else 
		{
			$_SESSION['CURRENT_LANG'] = $lang_code = $this->getFirstLanguage();
		}
		$lang_file_name=$lang_dir.$lang_code.".lang.txt";
		$default_lang_file_name = $lang_dir."en-us.lang.txt";
		if (file_exists($lang_file_name)) 
		{
			$lang_temp_arr = $this->loadLanguageFile($lang_file_name);
		}
		else 
		{
			$lang_temp_arr = $this->loadLanguageFile($default_lang_file_name);
		}
		return $lang_temp_arr;
		
	}
	
	/**
	* Load language file
	*
	* @author	John.meng
	* @date		Dec 5, 2005 12:25:11 PM
	* @param	sting $lang_file_name	
	* @return	array $lang_file_arr
	*/
	function loadLanguageFile ($lang_file_name)
	{
		global $smarty;
		$lang_file_arr = file($lang_file_name);
		$Lang = array();
		foreach ($lang_file_arr as $line_num => $txt) 
		{
		    $tmp_arr = explode("=",$txt);
		    $left = trim($tmp_arr[0]);
		    $right = trim($tmp_arr[1]);
		    $Lang[$left] = $right;
		    $smarty->assign($left,$right);
		}
		return $Lang;
	}
	
}

?>