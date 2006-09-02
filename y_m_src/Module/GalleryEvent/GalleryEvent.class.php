<?php

/**
 * Copyright Yahoo! Hong Kong Limited. (c) 2006. All rights reserved.
 *
 * GalleryEvent.class.php class
 *  
 * Created on 2006-9-1
 * Modify List as below:
 * Date        Author    Version  Changes
 * 2006-09-01  Harry Lu  1.0      Initial    
 * 
 */
 
class GalleryEvent extends Actions
{
	private $artistid; 
	
	function getArtistid() 
	{
		return $this->artistid ;	
	}
		
	function setArtistid($artistid) 
	{
		$this->artistid = $artistid;	
	}
	
	function displayAddForm()
	{
		global $template;		
		
		$template->setFile(array (
			"Main" => "gallery_event_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "AddSubmit",
			"ARTISTID" => $this->artistid			
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
		$galleryEvent = DB_DataObject :: factory('GalleryEvent');

		$galleryEvent->setArtistid($this->artistid);		
		$galleryEvent->setGalEventname($_POST["gal_eventname"]);		
		$galleryEvent->setCreateTime(time());	
		
		$val = $galleryEvent->validate();
		if ($val === TRUE)
		{
			$galleryEvent->insert();
			$this->forward("gallery_event.php?artistid={$this->artistid}");
		}
		else
		{
			$template->setFile(array (
				"Main" => "gallery_event_edit.html"
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
			"Main" => "gallery_event_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "UpdateSubmit"
		));

		$galleryEvent = DB_DataObject :: factory('GalleryEvent');
		$galleryEvent->get($galleryEvent->escape($_GET['ID']));

		$template->setVar(array (
			"GAL_EVENTID"=>$galleryEvent->getGalEventid(), 
			"ARTISTID" => $galleryEvent->getArtistid(), 
			"GAL_EVENTNAME" => $galleryEvent->getGalEventname() 
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

	function updateSubmit()
	{
		$galleryEvent = DB_DataObject :: factory('GalleryEvent');

		$galleryEvent->get($galleryEvent->escape($_POST['ID']));
		
		$original = clone ($galleryEvent);

		$galleryEvent->setArtistid($this->artistid);
		$galleryEvent->setGalEventname($_POST["gal_eventname"]);		
		
		$galleryEvent->setLastUpdated(time());
		$galleryEvent->update($original);
		
		$this->forward("gallery_event.php?artistid={$this->artistid}");

	}

	function delOne()
	{
		$galleryEvent = DB_DataObject :: factory('GalleryEvent');
		$galleryEvent->setGalEventid($galleryEvent->escape($_GET['ID']));
		$galleryEvent->delete();
		$this->forward("gallery_event.php?artistid={$this->artistid}");
	}

	function displayList()
	{
		global $template;
		require_once 'Pager/Pager.php';
		
		$template->setFile(array (
			"Main" => "gallery_event_list.html"
		));


		$template->setBlock("Main", "main_list", "list_block");

		$galleryEvent = DB_DataObject :: factory('GalleryEvent');
		$galleryEvent->orderBy('gal_eventid desc');
		$galleryEvent->setArtistid($this->artistid);
		if ($keyword=$_REQUEST['keyword']) 
		{
			$galleryEvent->whereAdd(" (gal_eventname LIKE '%{$keyword}%' )");
		}
		$galleryEvent->find();

		$i=0;
		while ($galleryEvent->fetch())
		{
			$myData[] = $galleryEvent->toArray();
			$i++;
		}
		$ToltalNum =$i;

		$params = array(
		    'itemData' => $myData,
		    'perPage' => PER_PAGE_NUM_20,
		    'delta' => DISPLAY_PAGE_NUM,             // for 'Jumping'-style a lower number is better
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
				"GAL_EVENTID"=>$data['gal_eventid'],
				"GAL_EVENTNAME" => $data['gal_eventname'] 
			));
			
			$template->setVar(array (
				"ListTdClass" => $list_td_class
			));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"KEYWORD_TEXT" => textTag ('keyword',$_REQUEST['keyword']),		
			"ARTISTID" => $this->artistid,
			"TOLTAL_NUM" => $ToltalNum,
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