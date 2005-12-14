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
   | Author: John.meng(цот╤РШ)  2005-12-14 23:05:13                        
   +----------------------------------------------------------------------+
 */

/* $Id: ClientIP.class.php,v 1.1 2005/12/14 15:16:16 arzen Exp $ */

/**
 * Load language file
 * @package	App
 */

class ClientIP
{

	function ClientIP()
	{
	}
	/**
	* Get client true IP though client use proxy
	* @return $AddIP;
	*/
	function getTrueIP() 
	{
		if($_SERVER["HTTP_X_FORWARDED_FOR"]) //check is use proxy
		{
			if($leng = strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",")) 
			{
				$AddIP = substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$leng);//if use proxy,get the first client IP
			}
			else
			{
				$AddIP =$_SERVER["HTTP_X_FORWARDED_FOR"];
			}
		}
		else
		{
			$AddIP = $_SERVER["REMOTE_ADDR"];
		}
		Return $AddIP;
	}	
}
?>