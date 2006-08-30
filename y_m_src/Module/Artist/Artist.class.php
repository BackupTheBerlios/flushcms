<?php

/**
 *
 * Artist.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Artist.class.php,v 1.3 2006/08/30 10:58:36 arzen Exp $
 */

class Artist extends Actions
{
	function displayAddForm()
	{
		global $template;

		$template->setFile(array (
			"Main" => "artist_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "AddSubmit"
		));

		$template->parse("OUT", array (
			"Main"
		));
		$template->parse("OUT", array (
			"Header",
			"Foot",
			"Page"
		));
		$template->p("OUT");

	}

	function addSubmit()
	{
		global $template;
		$artist = DB_DataObject :: factory('artist');

		$artist->setArtistcode($_POST['artistcode']);
		$artist->setArtistname($_POST['artistname']);
		$artist->setArtistnameEng($_POST['artistname_eng']);
		$artist->setGender($_POST['gender']);
		$artist->setLang($_POST['lang']);
		$artist->setInitial($_POST['initial']);
		$artist->setImage($_POST['image']);

		$artist->setCreateTime(time());

		$val = $artist->validate();
		if ($val === TRUE)
		{
			$artist->insert();
			$this->forward('artist.php');
		}
		else
		{
			$template->setFile(array (
				"Main" => "artist_edit.html"
			));
			$template->setBlock("Main", "edit_block");
			$template->setVar(array (
				"DoAction" => "AddSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " Please check here "
					));

				}
			}
			$template->parse("OUT", array (
				"Main"
			));
			$template->parse("OUT", array (
				"Header",
				"Foot",
				"Page"
			));
			$template->p("OUT");

		}

	}

	function displayUpdateForm()
	{
		global $template;
		$template->setFile(array (
			"Main" => "artist_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "UpdateSubmit"
		));

		$artist = DB_DataObject :: factory('artist');
		$artist->get($artist->escape($_GET['ID']));

		$template->setVar(array (
		"ARTISTID" => $artist->getArtistid(), "ARTISTCODE" => $artist->getArtistcode(), "ARTISTNAME" => $artist->getArtistname(), "ARTISTNAME_ENG" => $artist->getArtistnameEng(), "GENDER" => $artist->getGender(), "LANG" => $artist->getLang(), "INITIAL" => $artist->getInitial()));

		$template->parse("OUT", array (
			"Main"
		));
		$template->parse("OUT", array (
			"Header",
			"Foot",
			"Page"
		));
		$template->p("OUT");

	}

	function updateSubmit()
	{
		$artist = DB_DataObject :: factory('artist');

		$artist->get($artist->escape($_POST['ID']));
		$original = clone ($artist);

		$artist->setArtistcode($_POST['artistcode']);
		$artist->setArtistname($_POST['artistname']);
		$artist->setArtistnameEng($_POST['artistname_eng']);
		$artist->setGender($_POST['gender']);
		$artist->setLang($_POST['lang']);
		$artist->setInitial($_POST['initial']);

		$artist->setLastUpdated(time());
		$artist->update($original);

		$this->forward('artist.php');

	}

	function delOne()
	{
		$artist = DB_DataObject :: factory('artist');
		$artist->setArtistid($artist->escape($_GET['ID']));
		$artist->delete();

		$this->forward('artist.php');
	}

	function displayList()
	{
		global $template;

		$template->setFile(array (
			"Main" => "artist_list.html"
		));

		$template->setBlock("Main", "main_list", "list_block");

		$artist = DB_DataObject :: factory('artist');
		$ToltalNum = $artist->count();

		$artist->orderBy('artistid desc');
		$artist->find();

		$i = 0;
		while ($artist->fetch())
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";

			$template->setVar(array (
			"ARTISTID" => $artist->getArtistid(), "ARTISTCODE" => $artist->getArtistcode(), "ARTISTNAME" => $artist->getArtistname(), "ARTISTNAME_ENG" => $artist->getArtistnameEng(), "GENDER" => $artist->getGender(), "LANG" => $artist->getLang(), "INITIAL" => $artist->getInitial()));

			$template->setVar(array (
				"ListTdClass" => $list_td_class
			));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		$template->setVar(array (
			"ToltalNum" => $ToltalNum
		));

		$template->parse("OUT", array (
			"Main"
		));
		$template->parse("OUT", array (
			"Header",
			"Foot",
			"Page"
		));
		$template->p("OUT");

	}

}
?>