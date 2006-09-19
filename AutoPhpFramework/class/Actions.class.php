<?php
/**
 *
 * Actions.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: Actions.class.php,v 1.1 2006/09/19 23:30:36 arzen Exp $
 */

class Actions
{

	function forward($page_name="")
	{
		include_once("URLHelper.class.php");
		$url_link = URLHelper::getBaseURL()."/".$page_name;
		header("location:$url_link");
	}
}
?>