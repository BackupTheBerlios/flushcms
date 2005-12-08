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
   | Author: John.meng(цот╤РШ)  2005-12-3 23:05:50                        
   +----------------------------------------------------------------------+
 */

/* $Id: Browser.class.php,v 1.1 2005/12/08 08:52:35 arzen Exp $ */

class Browser
{

	function Browser()
	{
	}
	/**
	 * Get client browser use first language
	 *
	 * @author  John.meng (цот╤РШ)
	 * @date    2005-12-3 23:07:02
	 * @param   void  
	 * @return  language sting 
	 *
	 */
	function getFirstLanguage () 
	{
		$language_string = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
		$language_arr = explode(",",$language_string);
		return $language_arr[0];
	}
	
}
?>