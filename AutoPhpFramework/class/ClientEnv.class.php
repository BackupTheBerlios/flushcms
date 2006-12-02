<?php

/**
 *
 * ClientEnv.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: ClientEnv.class.php,v 1.1 2006/12/02 02:16:02 arzen Exp $
 */

class ClientEnv
{

	/**
	* Client IP
	* @return $AddIP;
	*/
	function getTrueIP() 
	{
		if($_SERVER["HTTP_X_FORWARDED_FOR"]) //if client use poxry
		{
			if($leng = strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",")) 
			{
				$AddIP = substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$leng);//if client use poxry,get the first one is client IP
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
		return $AddIP;
	}

}
?>