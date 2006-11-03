<?php

/**
 *
 * index.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: index.class.php,v 1.1 2006/11/03 06:46:12 arzen Exp $
 */

class index
{

	function executeList()
	{
		global $template;
		$template->setFile(array (
			"MAIN" => "main_index.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
	
	}
}
?>