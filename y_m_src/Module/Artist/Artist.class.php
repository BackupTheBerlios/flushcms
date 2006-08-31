<?php

/**
 *
 * Artist.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Artist.class.php,v 1.5 2006/08/31 10:48:34 arzen Exp $
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
		$artist->insert();

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
		$artist->get($artist->escape($_GET['ID']));
		$artist->setStatus('deleted');
		$artist->update();

		$this->forward('artist.php');
	}

	function displayList()
	{
		global $template;

		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"Main" => "artist_list.html"
		));

		$template->setBlock("Main", "main_list", "list_block");

		$artist = DB_DataObject :: factory('artist');
		$ToltalNum = $artist->count();

		$artist->orderBy('artistid desc');
		$artist->find();
		
		while ($artist->fetch())
		{
			$myData[] = $artist->toArray();
		}

		$params = array(
		    'itemData' => $myData,
		    'perPage' => 5,
		    'delta' => 5,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		
		);
		$pager = & Pager::factory($params);
		$page_data = $pager->getPageData();
		$links = $pager->getLinks();
		
		$selectBox = $pager->getPerPageSelectBox();
		$i = 0;
		foreach($page_data as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));

			$template->setVar(array (
			"ARTISTID" => $data['artistid'], "ARTISTCODE" =>$data['artistcode'], "ARTISTNAME" => $data['artistname'], 
			"ARTISTNAME_ENG" => $data['artistname_eng'], "GENDER" => $data['gender'], "LANG" => $data['lang'], 
			"INITIAL" => $data['initial'],"STATUS" => $data['status']
			));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"TOLTAL_NUM" => $ToltalNum
		));
		$template->setVar(array (
			"PAGINATION" => $links['all']
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