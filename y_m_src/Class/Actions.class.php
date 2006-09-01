<?php

/**
 *
 * Actions.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Actions.class.php,v 1.2 2006/09/01 10:48:12 arzen Exp $
 */

class Actions
{

	function forward ($filename="",$action="") 
	{
		$action?$url="{$filename}?act={$action}":$url="{$filename}";
		header("location:{$url}");
//		echo "<script LANGUAGE=\"JavaScript\">window.location.href='{$url}'</script>";
	}
}
?>