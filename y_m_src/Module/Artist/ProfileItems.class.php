<?php
/**
 *
 * ProfileItems.class.php
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: ProfileItems.class.php,v 1.2 2006/09/07 05:34:59 arzen Exp $
 */
class ProfileItems extends Actions
{
	function displayAddForm()
	{
		global $template;

		$template->setFile(array (
			"Main" => "profile_items_edit.html"
		));
		$template->setBlock("Main", "add_block");
		
		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->whereAdd("artistid =".$profile_items->escape($_GET['artistid']));
		$profile_items->orderBy('ordr DESC');
		
		$profile_items->find();
		$profile_items->fetch();
		
		$last_order_id=$profile_items->getOrdr()?$profile_items->getOrdr()+1:"1";
		
		$template->setVar(array (
			"ORDR" => $last_order_id,
			"PARTISTID" => $_GET['artistid'],
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
		$profile_items = DB_DataObject :: factory('ProfileItems');

		$profile_items->setArtistid($_POST['artistid']);
		$profile_items->setOrdr($_POST['ordr']);
		$profile_items->setItemName(trim($_POST['item_name']));
		$profile_items->setItemValue(trim($_POST['item_value']));
		
		$profile_items->setCreateTime(DB_DataObject_Cast::dateTime());

		$val = $profile_items->validate();
		if ($val === TRUE)
		{
			$profile_items->insert();
			$this->forward('profile_items.php',"artistid={$_POST['artistid']}");
		}
		else
		{
			$template->setFile(array (
				"Main" => "profile_items_edit.html"
			));
			$template->setBlock("Main", "edit_block");
			$template->setVar(array (
				"PARTISTID" => $_POST['artistid'],
				"DoAction" => "AddSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => "&darr; Please fill up here &darr;"
					));

				}
			}
			$template->setVar(
				array (
				"ITEM_NAME" => $_POST['item_name'],
				"ITEM_VALUE" => $_POST['item_value'], 
				"ORDR" => $_POST['ordr']
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
		global $template;
		$template->setFile(array (
			"Main" => "profile_items_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"PARTISTID" => $_GET['artistid'],
			"DoAction" => "UpdateSubmit"
		));

		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->get($profile_items->escape($_GET['ID']));

		if ($_GET['view_status']=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}

		$template->setVar(array ("ITEMID" => $profile_items->getItemid(),"ARTISTID" => $profile_items->getArtistid(),"ITEM_NAME" => stripslashes($profile_items->getItemName()),"ITEM_VALUE" => stripslashes($profile_items->getItemValue())));
		
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
		global $template;
		$profile_items = DB_DataObject :: factory('ProfileItems');

		$profile_items->get($profile_items->escape($_POST['ID']));
		$original = clone ($profile_items);

		$profile_items->setItemName(trim($_POST['item_name']));
		$profile_items->setItemValue(trim($_POST['item_value']));

		$profile_items->setLastUpdated(DB_DataObject_Cast::dateTime());

		$val = $profile_items->validate();
		if ($val === TRUE)
		{
			$profile_items->update($original);
			$this->forward('profile_items.php',"act=Update&artistid={$_POST['artistid']}&ID={$_POST['ID']}&view_status=ok");
		}
		else
		{
			$template->setFile(array (
				"Main" => "profile_items_edit.html"
			));
			$template->setBlock("Main", "edit_block");
			$template->setVar(array (
				"PARTISTID" => $_POST['artistid'],
				"DoAction" => "UpdateSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => "&darr; Please fill up here &darr;"
					));

				}
			}
			$template->setVar(
				array (
				"ITEM_NAME" => $_POST['item_name'],
				"ITEM_VALUE" => $_POST['item_value'], 
				"ITEMID" => $_POST['ID'],
				"ORDR" => $_POST['ordr']
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
	
	function delOne()
	{
		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->setItemid($profile_items->escape($_GET['ID']));
		$profile_items->delete();

		$this->forward('profile_items.php',"artistid={$_GET['artistid']}");
	}
	
	function executeUp () 
	{
		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->get($profile_items->escape($_GET['ID']));
		
		$previous_item = DB_DataObject :: factory('ProfileItems');
		$previous_item->setArtistid($profile_items->escape($_GET['artistid']));
		
		$previous_item->whereAdd('ordr < '.$profile_items->getOrdr());
		$previous_item->orderBy('ordr desc');
		
		$previous_item->find();
		$previous_item->fetch();
		if ($previous_item->getItemid()) 
		{
			$profile_items->swapWith($previous_item);
		}
		
		
		$this->forward('profile_items.php',"artistid={$_GET['artistid']}");
	}
	
	function executeDown () 
	{
		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->get($profile_items->escape($_GET['ID']));
		
		$next_item = DB_DataObject :: factory('ProfileItems');

		$next_item->setArtistid($profile_items->escape($_GET['artistid']));
		$next_item->whereAdd('ordr > '.$profile_items->getOrdr());
		$next_item->orderBy('ordr asc');
		
		$next_item->find();
		$next_item->fetch();
		if ($next_item->getItemid()) 
		{
			$profile_items->swapWith($next_item);
		}
		
		
		$this->forward('profile_items.php',"artistid={$_GET['artistid']}");
		
	}
	
	function displayList()
	{
		global $template,$ClassDir;

		require_once 'Pager/Pager.php';
		include_once($ClassDir."StringHelper.php");
		$template->setFile(array (
			"Main" => "profile_items_list.html"
		));

		$template->setBlock("Main", "main_list", "list_block");

		$profile_items = DB_DataObject :: factory('ProfileItems');
		$profile_items->setArtistid($profile_items->escape($_GET['artistid']));
		$profile_items->buildArtistJoin(); 

		$profile_items->orderBy('ordr');
		
		$profile_items->find();
		
		
		$i=0;
		while ($profile_items->fetch())
		{
			$myData[] = $profile_items->toArray();
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
		        'artistid'  => $_GET['artistid'],
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
			
			$template->setVar(array ("ITEMID" => $data['itemid'],"ARTISTID" => cutString(stripslashes($data['artistname']),20),"ORDR" => $data['ordr'],"ITEM_NAME" => "<a href=\"profile_items.php?act=Update&artistid={$_GET['artistid']}&ID={$data['itemid']}\">".wordwrap(stripslashes($data['item_name']),40,"<br/>\n")."</a>","ITEM_VALUE" => wordwrap(stripslashes($data['item_value']),40,"<br/>\n"),"CREATE_TIME" => $data['create_time'],"LAST_UPDATED" => $data['last_updated'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"PARTISTID" => $_GET['artistid'],
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