<?php
/**
 *
 * Artist.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Artist.class.php,v 1.1 2006/08/29 10:19:11 arzen Exp $
 */

class Artist
{
	function displayAddForm () 
	{
		
	}
	
	function addSubmit () 
	{
		
	}
	
	function displayUpdateForm () 
	{
		
	}
	
	function updateSubmit () 
	{
		
	}
	
	function displayList()
	{
		global $template;
		
		$template->setFile(array (
			"main" => "main.html"
		));

		$template->setVar(array (
			"TITLE" => "Yahoo Music",
			"BGCOLOR" => "#cccccc",
		));

		$template->setBlock("main", "mainlist", "ar");

		$artist = DB_DataObject :: factory('artist');
		$artist->query("SELECT * FROM {$artist->__table} ");
		while ($artist->fetch())
		{
			$template->setVar(array (
				"ID" => $artist->artistid,
				"ANAME" => $artist->artistcode
			));
			$template->parse("ar", "mainlist", TRUE);
		}

		$template->pparse("out", array ("main"));
	}

}
?>