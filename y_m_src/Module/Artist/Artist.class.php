<?php
/**
 *
 * Artist.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Artist.class.php,v 1.2 2006/08/29 23:23:44 arzen Exp $
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
			"Main" => "main.html"
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

		$template->parse("OUT", array("Header","Foot","Main","Page"));
		$template->p("OUT");
	}

}
?>