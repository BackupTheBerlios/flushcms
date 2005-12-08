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
   | Author: John.meng(цот╤РШ)  2005-12-2 7:13:26                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: WorkTime.class.php,v 1.1 2005/12/08 08:52:35 arzen Exp $ */

/**
 * Program exec spend time
 * @package	Utility
 */

class WorkTime
{
	var $starttime;
	var $endtime;
	/**
	* Program start time
	*/
	function startTime()
	{
		list ($usec, $sec) = explode(" ", microtime());
		$this->starttime = ((float) $usec + (float) $sec);
	}
	/**
	* Program end time
	*/
	function endTime()
	{
		list ($usec, $sec) = explode(" ", microtime());
		$this->endtime = ((float) $usec + (float) $sec);
	}
	/**
	* Program spend time
	*/
	function workTime()
	{
		$time = $this->endtime - $this->starttime;
		Return round($time, 6);
	}
}?>