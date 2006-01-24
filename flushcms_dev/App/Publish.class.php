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
   | Author: John.meng(цот╤РШ)  2006-1-24 22:16:56                        
   +----------------------------------------------------------------------+
 */

/* $Id: Publish.class.php,v 1.1 2006/01/24 14:38:08 arzen Exp $ */

class Publish
{

	function Publish()
	{
	}
	/**
	* Data write to file
	* @param $desination	file name
	* @param $souce		data
	*/
	function writeFileText ($desination,$souce) 
	{
		$fp = fopen ($desination, "w+");
		$str = fwrite($fp , $souce);
		fclose ($fp);
	}	
}
?>