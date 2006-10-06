<?php
/**
 *
 * Actions.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: Actions.class.php,v 1.2 2006/10/06 10:50:39 arzen Exp $
 */

class Actions
{

	function forward($page_name="")
	{
		include_once("URLHelper.class.php");
		$url_link = URLHelper::getBaseURL()."/".$page_name;
		header("location:$url_link");
	}
	
	function notPermit () 
	{
		global $template,$WebBaseDir,$LU;

		$template->setFile(array (
			"MAIN" => "apf_not_permit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
		));
		
	}
	
}
?>