<?php
/**
 *
 * URLHelper.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: URLHelper.class.php,v 1.2 2006/09/20 04:44:18 arzen Exp $
 */

class URLHelper
{

	function getBaseURL () 
	{
		return getenv("SCRIPT_NAME");
	}
	
	function getWebBaseURL () 
	{
		return dirname(getenv("SCRIPT_NAME"))."/";
	}

}
?>