<?php

/**
 *
 * Artist.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: Artist.class.php,v 1.9 2006/09/07 05:34:59 arzen Exp $
 */

class Artist extends Actions
{
	function displayAddForm()
	{
		global $template,$GenderOption,$LangOption;

		$template->setFile(array (
			"Main" => "artist_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		
		array_shift($GenderOption);
		array_shift($LangOption);
		$template->setVar(array (
			"GENDER_OPTION" => radioTag ('gender',$GenderOption,$_REQUEST['gender']),
			"LANG_OPTION" => radioTag ('lang',$LangOption,$_REQUEST['lang']),
			"IMAGES_FILE" => fileTag ('image'),
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
		global $template,$UploadDir,$GenderOption,$LangOption;
		$artist = DB_DataObject :: factory('artist');

		$artist->setArtistcode(trim($_POST['artistcode']));
		$artist->setArtistname(trim($_POST['artistname']));
		$artist->setArtistnameEng(trim($_POST['artistname_eng']));
		$artist->setGender(trim($_POST['gender']));
		$artist->setLang(trim($_POST['lang']));
		$artist->setInitial(trim($_POST['initial']));
		if($_FILES['image']['name'])
		{
			require_once 'HTTP/Upload.php';
			$upload = new http_upload();
			$file = $upload->getFiles('image');
			if (PEAR::isError($file)) 
			{
				die ($file->getMessage());
			}
			if ($file->isValid()) 
			{
				$file->setName('uniq');
				$dest_name = $file->moveTo($UploadDir);
				if (PEAR::isError($dest_name)) {
					die ($dest_name->getMessage());
				}
				$real = $file->getProp('real');
				$artist->setImage($dest_name);
			} 
			elseif ($file->isError()) 
			{
				echo $file->errorMsg() . "\n";
			}			
		}
		

		$artist->setCreateTime(DB_DataObject_Cast::dateTime());

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
			array_shift($GenderOption);
			array_shift($LangOption);
			$template->setVar(array (
				"GENDER_OPTION" => radioTag ('gender',$GenderOption,$_REQUEST['gender']),
				"LANG_OPTION" => radioTag ('lang',$LangOption,$_REQUEST['lang']),
				"IMAGES_FILE" => fileTag ('image'),
				"DoAction" => "AddSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					if ($k=="initial") 
					{
						$template->setVar(array (
							strtoupper($k)."_ERROR_MSG" => " &darr; Please fill up less than 4 char here &darr; "
						));
					}
					else
					{
						$template->setVar(array (
							strtoupper($k)."_ERROR_MSG" => " &darr; Please fill up here &darr; "
						));
					}

				}
				
			}
			$template->setVar(
				array (
				"ARTISTCODE" => $_POST['artistcode'],
				"ARTISTNAME" => $_POST['artistname'], 
				"ARTISTNAME_ENG" => $_POST['artistname_eng'],
				"INITIAL" => $_POST['initial']
				)
			 );
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
		global $template,$GenderOption,$LangOption;
		$template->setFile(array (
			"Main" => "artist_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "UpdateSubmit"
		));

		$artist = DB_DataObject :: factory('artist');
		$artist->get($artist->escape($_GET['ID']));
		
		if ($_GET['view_status']=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}
		$template->setVar(array (
		"ARTISTID" => $artist->getArtistid(), "ARTISTCODE" => stripslashes($artist->getArtistcode()), "ARTISTNAME" => stripslashes($artist->getArtistname()), "ARTISTNAME_ENG" => stripslashes($artist->getArtistnameEng()), "GENDER" => $artist->getGender(), "LANG" => $artist->getLang(), "INITIAL" => stripslashes($artist->getInitial())));
		
		array_shift($GenderOption);
		array_shift($LangOption);
		$template->setVar(array (
			"PROFILE_ITEMS_LINK" => navButtonTag ('profile_items_link',"Profile Items Listing","profile_items.php?artistid=".$_GET['ID'],"admin_action_save_and_add"),
			"GALLERY_EVENT_LINK" => navButtonTag ('gal_event',"Galley Event","gallery_event.php?artistid=".$_GET['ID'],"admin_action_save_and_add"),
			"GALLERY_PHOTO_LINK" => navButtonTag ('gallery_photo',"Galley Photo","gallery_photo.php?artistid=".$_GET['ID'],"admin_action_save_and_add"),
			"GENDER_OPTION" => radioTag ('gender',$GenderOption,$artist->getGender()),
			"LANG_OPTION" => radioTag ('lang',$LangOption,$artist->getLang()),
			"IMAGES_FILE" => fileTag ('image',$artist->getImage())
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
		global $UploadDir,$template,$GenderOption,$LangOption;
		$artist = DB_DataObject :: factory('artist');

		$artist->get($artist->escape($_POST['ID']));
		$original = clone ($artist);

		$artist->setArtistcode(trim($_POST['artistcode']));
		$artist->setArtistname(trim($_POST['artistname']));
		$artist->setArtistnameEng(trim($_POST['artistname_eng']));
		$artist->setGender(trim($_POST['gender']));
		$artist->setLang(trim($_POST['lang']));
		$artist->setInitial(trim($_POST['initial']));
		
		if ($_POST['image_del']=='Y') 
		{
			unlink($UploadDir.$_POST['image_old']);
			$artist->setImage("");
			$artist->setImageStatus('deleted');
		}
		
		if($_FILES['image']['name'])
		{
			require_once 'HTTP/Upload.php';
			$upload = new http_upload();
			$file = $upload->getFiles('image');
			if (PEAR::isError($file)) 
			{
				die ($file->getMessage());
			}
			if ($file->isValid()) 
			{
				$file->setName('uniq');
				$dest_name = $file->moveTo($UploadDir);
				if (PEAR::isError($dest_name)) {
					die ($dest_name->getMessage());
				}
				$real = $file->getProp('real');
				$artist->setImage($dest_name);
				$artist->setImageStatus('new');
			} 
			elseif ($file->isError()) 
			{
				echo $file->errorMsg() . "\n";
			}			
		}

		$artist->setLastUpdated(DB_DataObject_Cast::dateTime());
		
		$val = $artist->validate();
		if ($val === TRUE)
		{
			$artist->update($original);
			$this->forward('artist.php',"act=Update&ID={$_POST['ID']}&view_status=ok");
		}
		else
		{
			$template->setFile(array (
				"Main" => "artist_edit.html"
			));
			$template->setBlock("Main", "edit_block");
			array_shift($GenderOption);
			array_shift($LangOption);
			$template->setVar(array (
				"GENDER_OPTION" => radioTag ('gender',$GenderOption,$_REQUEST['gender']),
				"LANG_OPTION" => radioTag ('lang',$LangOption,$_REQUEST['lang']),
				"IMAGES_FILE" => fileTag ('image',$_POST['image_old']),
				"DoAction" => "UpdateSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					if ($k=="initial") 
					{
						$template->setVar(array (
							strtoupper($k)."_ERROR_MSG" => " &darr; Please fill up less than 4 char here &darr; "
						));
					}
					else
					{
						$template->setVar(array (
							strtoupper($k)."_ERROR_MSG" => " &darr; Please fill up here &darr; "
						));
					}
				}
			}
			$template->setVar(
				array (
				"ARTISTID" => $_POST['ID'],
				"ARTISTCODE" => $_POST['artistcode'],
				"ARTISTNAME" => $_POST['artistname'], 
				"ARTISTNAME_ENG" => $_POST['artistname_eng'],
				"INITIAL" => $_POST['initial']
				)
			 );
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
	
	function updateSelected () 
	{
		if (is_array($_POST['SelectID'])) 
		{
			$selected_id = implode(",",$_POST['SelectID']);
			$status = $_POST['todo'];
			
			$artist = DB_DataObject :: factory('artist');
//			DB_DataObject::debugLevel(2);
			$artist->whereAdd(" artistid IN (".$artist->escape($selected_id).") ");
			$artist->find();
			while ($artist->fetch())
			{
				$artist->setStatus($artist->escape($status));
				$artist->update();
			}
			

			
		}
		
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
		global $template,$LangOption,$GenderOption,$StatusOption,$ClassDir;

		require_once 'Pager/Pager.php';
		include_once($ClassDir."StringHelper.php");
		$template->setFile(array (
			"Main" => "artist_list.html"
		));

		$template->setBlock("Main", "main_list", "list_block");

		$artist = DB_DataObject :: factory('artist');

		$artist->orderBy('artistid desc');
		
		if ($status=$_REQUEST['status']) 
		{
			$artist->setStatus($status);
		}
		
		if ($lang=$_REQUEST['lang']) 
		{
			$artist->setLang($lang);
		}
		
		if ($gender=$_REQUEST['gender']) 
		{
			$artist->setGender($gender);
		}
		
		if (($q=trim($_REQUEST['q'])) != "") 
		{
			$artist->whereAdd(" ( (artistcode LIKE '%{$q}%'  ) OR (artistname LIKE '%{$q}%' ) ) ");
		}
		
		$artist->find();
		
		$i=0;
		while ($artist->fetch())
		{
			$myData[] = $artist->toArray();
			$i++;
		}
		$ToltalNum =$i;
		
		$params = array(
		    'itemData' => $myData,
		    'perPage' => PER_PAGE_NUM,
		    'delta' => DISPLAY_PAGE_NUM,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
		        'status'  => $_REQUEST['status'],
		        'lang'  => $_REQUEST['lang'],
		        'gender'  => $_REQUEST['gender'],
		        'q'  => $_REQUEST['q'],
		    ),
		
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
			
			if (strlen($data['artistcode'])>20) 
			{
				$data['artistcode'] = cutString($data['artistcode'],20);
			}
			if (strlen($data['artistname'])>20) 
			{
				$data['artistname'] = cutString($data['artistname'],20);
			}
			if (strlen($data['artistname_eng'])>20) 
			{
				$data['artistname_eng'] = cutString($data['artistname_eng'],20);
			}
			
			$gender = $GenderOption[$data['gender']];
			$lang = $LangOption[$data['lang']];
			$template->setVar(array (
			"ARTISTID" => $data['artistid'], "ARTISTCODE" =>"<a href=\"artist.php?act=Update&ID={$data['artistid']}\">".stripslashes($data['artistcode'])."</a>", "ARTISTNAME" => stripslashes($data['artistname']), 
			"ARTISTNAME_ENG" => stripslashes($data['artistname_eng']), "GENDER" => $gender, "LANG" => $lang, 
			"INITIAL" => $data['initial'],"STATUS" => $data['status']
			));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"KEYWORD_TEXT" => textTag ('q',$_REQUEST['q']),
			"GENDER_OPTION" => selectTag ('gender',$GenderOption,$_REQUEST['gender']),
			"LANG_OPTION" => selectTag ('lang',$LangOption,$_REQUEST['lang']),
			"STATUS_OPTION" => selectTag ('status',$StatusOption,$_REQUEST['status']),
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