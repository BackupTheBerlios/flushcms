<?php
/**
 *
 * Actions.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Actions.class.php,v 1.4 2006/09/07 05:29:26 arzen Exp $
 */

class Actions
{

	function forward ($filename="",$extend="") 
	{
		$extend?$url="{$filename}?{$extend}":$url="{$filename}";
		header("location:{$url}");
	}
	
	
}
?>