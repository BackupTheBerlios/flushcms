<?php

/**
 *
 * Actions.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Actions.class.php,v 1.1 2006/08/30 10:58:36 arzen Exp $
 */

class Actions
{

	function forward ($filename="",$action="") 
	{
		$action?$url="{$filename}?act={$action}":$url="{$filename}?act={$action}";
		echo "<script LANGUAGE=\"JavaScript\">document.location.href='{$url}'</script>";
	}
}
?>