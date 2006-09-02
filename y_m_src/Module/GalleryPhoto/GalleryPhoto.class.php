<?php

/**
 * Copyright Yahoo! Hong Kong Limited. (c) 2006. All rights reserved.
 *
 * GalleryPhoto.class.php class
 *  
 * Created on 2006-9-1
 * Modify List as below:
 * Date        Author    Version  Changes
 * 2006-09-01  Harry Lu  1.0      Initial    
 * 
 */

class GalleryPhoto extends Actions
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
		global $template, $StatusOption;		
		
		array_shift($StatusOption);
		$statusDropDownStr = selectTag ("status",$StatusOption,"","");
		$eventDropDownStr = selectTag("gal_eventid", $this->getGelleryEventArr(),"","");
		
		$template->setFile(array (
			"Main" => "gallery_photo_edit.html"
		));
		$template->setBlock("Main", "add_block");
		
		$template->setVar(array (
			"DoAction" => "AddSubmit",
			"ARTISTID" => $this->artistid,
			"EVENTS_DROP_DOWN_STR" => $eventDropDownStr,
			"STATUS_DROP_DOWN_STR" => $statusDropDownStr
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
		
		$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');
		$galleryPhoto->setArtistid($this->artistid);
		$galleryPhoto->setGalEventid($_POST["gal_eventid"]);		
		$galleryPhoto->setImage($_POST["image"]);
		$galleryPhoto->setCaption($_POST["caption"]);
		$galleryPhoto->setStatus($_POST["status"]);
		
		
		$galleryPhoto->setCreateTime(DB_DataObject_Cast::DateTime());
		
		$val = $galleryPhoto->validate();
		if ($val === TRUE)
		{
			$galleryPhoto->insert();
			$this->forward("gallery_photo.php?artistid={$this->artistid}");
		}
		else
		{
			$template->setFile(array (
				"Main" => "gallery_photo_edit.html"
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
		global $StatusOption;
		
				
		$template->setFile(array (
			"Main" => "gallery_photo_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		
		$template->setVar(array (
			"DoAction" => "UpdateSubmit"
		));

		$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');
		$galleryPhoto->get($galleryPhoto->escape($_GET['ID']));
		
		array_shift($StatusOption);
		$statusDropDownStr = selectTag ("status",$StatusOption,$galleryPhoto->getStatus(),"");		
		$eventDropDownStr = selectTag("gal_eventid", $this->getGelleryEventArr(),$galleryPhoto->getGalEventid(),"");
		
		$template->setVar(array (
			"GAL_PHOTOID"=>$galleryPhoto->getGalPhotoid(),
			"GAL_EVENTID"=>$galleryPhoto->getGalEventid(),
			"ARTISTID" => $this->artistid, 
			"IMAGE"=>$galleryPhoto->getImage(),
			"CAPTION"=>$galleryPhoto->getCaption(),
			"STATUS"=>$galleryPhoto->getStatus(),
			"STATUS_DROP_DOWN_STR"=>$statusDropDownStr,
			"EVENTS_DROP_DOWN_STR"=>$eventDropDownStr
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
		$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');
		
		$galleryPhoto->get($galleryPhoto->escape($_POST['ID']));		
		$original = clone ($galleryPhoto);
		$galleryPhoto->setGalEventid($_POST["gal_eventid"]);
		$galleryPhoto->setArtistid($_POST["artistid"]);
		$galleryPhoto->setImage($_POST["image"]);		
		$galleryPhoto->setCaption($_POST["caption"]);		
		$galleryPhoto->setLastUpdated(DB_DataObject_Cast::DateTime());
		$galleryPhoto->setStatus($_POST["status"]);
		$galleryPhoto->update($original);
		
		$this->forward("gallery_photo.php?artistid=$this->artistid");
	}


	/*
	 * batch update gallery photo's status
	 */
	function batchUpdateStatus($status)
	{
		
		$gal_photoids = $_REQUEST["gal_photoid"];
		if (!empty($gal_photoids)) {
			foreach ($gal_photoids as $gal_photoid) 
			{
				$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');	
				
				$galleryPhoto->get($galleryPhoto->escape($gal_photoid));		
				$original = clone ($galleryPhoto);
				
				$galleryPhoto->setStatus($status);			
				$galleryPhoto->setLastUpdated(DB_DataObject_Cast::DateTime());
				$galleryPhoto->update($original);
			}
		}
		$this->forward("gallery_photo.php?artistid=$this->artistid");

	}
	
	function delOne()
	{
		$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');
		$galleryPhoto->setGalPhotoid($galleryPhoto->escape($_GET['ID']));
		$galleryPhoto->delete();
		$this->forward("gallery_photo.php?artistid=$this->artistid");
	}

	function displayList()
	{
		global $template, $StatusOption;
		
		require_once 'Pager/Pager.php';
		
		$template->setFile(array (
			"Main" => "gallery_photo_list.html"
		));


		$template->setBlock("Main", "main_list", "list_block");

		$galleryPhoto = DB_DataObject :: factory('GalleryPhoto');				
		$galleryPhoto->setArtistid($this->artistid);		
		if ($gal_eventid=$_REQUEST['gal_eventid']) 
		{
			$galleryPhoto->setGalEventid($gal_eventid);
		}
			
		if ($status=$_REQUEST['status']) 
		{
			$galleryPhoto->setStatus($status);
		}
		$galleryPhoto->buildArtistJoin();
		$galleryPhoto->selectAs(array('image'),'photo_%s');
		$galleryPhoto->orderBy('gal_photoid desc');
		$galleryPhoto->find();
						
		$i=0;
		while ($galleryPhoto->fetch())
		{
			$myData[] = $galleryPhoto->toArray();
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

//		echo "<pre>";
//		var_dump($myData);
//		echo "</pre>";
		
		$i = 0;
		foreach($page_data as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";

			$template->setVar(array (
				"GAL_PHOTOID"=>$data['gal_photoid'],
				"GAL_EVENTID"=>$data['gal_eventid'],
				"IMAGE"=>$data['photo_image'],
				"CAPTION"=>$data['caption'],
				"STATUS"=>$data['status']
			));
			
			$template->setVar(array (
				"ListTdClass" => $list_td_class
			));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
				
		$template->setVar(array (			
			"GAL_EVENT_OPTION" => selectTag ('gal_eventid', $this->getGelleryEventArr('list'), $_REQUEST['gal_eventid']),			
			"STATUS_OPTION" => selectTag ('status',$StatusOption,$_REQUEST['status']),
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

	function getGelleryEventArr($act='') 
	{
		$galleryEvent = DB_DataObject :: factory('GalleryEvent');
		$galleryEvent->setArtistid($this->artistid);
		$galleryEvent->find();
		
		if ($act=='list') {
			$record_arr["0"]="All";			
		} else {
			$record_arr["0"]="--Please select--";
		}
		while ($galleryEvent->fetch())
		{
			$record_arr[$galleryEvent->getGalEventid()] = $galleryEvent->getGalEventname();
		}	
		return $record_arr;
	}
}
?>