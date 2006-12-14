<?php

/**
 *
 * ApfSelfproduct.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfSelfproduct.class.php,v 1.2 2006/12/14 23:37:25 arzen Exp $
 */

class ApfSelfproduct  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_selfproduct_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"RELEASE_DATE" => inputDateTag ("releasedate",date("Y-m-d")),
			"FILEPHOTO" => fileTag("photo"),
			"MEMOTEXT" => textareaTag ('memo',"",false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_selfproduct_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_selfproduct = DB_DataObject :: factory('ApfSelfproduct');
		$apf_selfproduct->get($apf_selfproduct->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_selfproduct->getId(),"PRODUCTNAME" => $apf_selfproduct->getProductname(),"RETAILPRICE" => $apf_selfproduct->getRetailprice(),"WHOLESALEPRICE" => $apf_selfproduct->getWholesaleprice(),"COSTPRICE" => $apf_selfproduct->getCostprice(),"PHOTO" => $apf_selfproduct->getPhoto(),"RELEASEDATE" => $apf_selfproduct->getReleasedate(),"MEMO" => $apf_selfproduct->getMemo(),"ACCESS" => $apf_selfproduct->getAccess(),"ACTIVE" => $apf_selfproduct->getActive(),"GROUPID" => $apf_selfproduct->getGroupid(),"USERID" => $apf_selfproduct->getUserid(),"ADD_IP" => $apf_selfproduct->getAddIp(),"CREATED_AT" => $apf_selfproduct->getCreatedAt(),"UPDATE_AT" => $apf_selfproduct->getUpdateAt(),));
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"RELEASE_DATE" => inputDateTag ("releasedate",$apf_selfproduct->getReleasedate()),
			"FILEPHOTO" => fileTag("photo",$apf_selfproduct->getPhoto()),
			"MEMOTEXT" => textareaTag ('memo',$apf_selfproduct->getMemo(),false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$UploadDir,$ClassDir,$group_ids;
		$apf_selfproduct = DB_DataObject :: factory('ApfSelfproduct');

		if ($edit_submit) 
		{
			$apf_selfproduct->get($apf_selfproduct->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_selfproduct->setProductname(stripslashes(trim($_POST['productname'])));
		$apf_selfproduct->setRetailprice(stripslashes(trim($_POST['retailprice'])));
		$apf_selfproduct->setWholesaleprice(stripslashes(trim($_POST['wholesaleprice'])));
		$apf_selfproduct->setCostprice(stripslashes(trim($_POST['costprice'])));
		$apf_selfproduct->setReleasedate(stripslashes(trim($_POST['releasedate'])));
		$apf_selfproduct->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_selfproduct->setAccess(stripslashes(trim($_POST['access'])));
		$apf_selfproduct->setActive(stripslashes(trim($_POST['active'])));

		$apf_selfproduct->setAddIp($AddIP);
		$apf_selfproduct->setGroupid($group_ids);
		$apf_selfproduct->setUserid($userid);

		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_selfproduct->setPhoto("");
			$_POST['photo_old']="";
		}
		if($_POST['upload_temp'])
		{
			$apf_selfproduct->setPhoto($_POST['upload_temp']);	
		}
		$allow_upload_file = TRUE;
		if($_FILES['photo']['name'])
		{
			require_once ($ClassDir."FileHelper.class.php");
			$upload_data = FileHelper::uploadFile ("product");
			$allow_upload_file = $upload_data["upload_state"];
			if ($allow_upload_file) 
			{
				$photos_arr = $upload_data["upload_msg"];
				if ($photo_pic = $photos_arr['photo']) 
				{
					$apf_selfproduct->setPhoto($photo_pic);
					$_POST['upload_temp'] = $photo_pic;
				}
			}
			else
			{
				$upload_error_msg = $upload_data["upload_msg"];
			}

		}
				
		$val = $apf_selfproduct->validate();
		if (($val === TRUE) && ($allow_upload_file === TRUE))
		{
			if ($edit_submit) 
			{
				$apf_selfproduct->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_selfproduct->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("selfproduct/apf_selfproduct/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_selfproduct->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_selfproduct->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("selfproduct/apf_selfproduct/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_selfproduct_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"RELEASE_DATE" => inputDateTag ("releasedate",$_POST['releasedate']),
				"FILEPHOTO" => fileTag("photo",$_POST['photo']),
				"MEMOTEXT" => textareaTag ('memo',$_POST['memo'],false,"ROWS=\"8\" COLS=\"40\""),
				"DOACTION" => $do_action
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " &darr; ".$i18n->_("Please check here")." &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"PRODUCTNAME" => $_POST['productname'],"RETAILPRICE" => $_POST['retailprice'],"WHOLESALEPRICE" => $_POST['wholesaleprice'],"COSTPRICE" => $_POST['costprice'],"PHOTO" => $_POST['photo'],"RELEASEDATE" => $_POST['releasedate'],"MEMO" => $_POST['memo'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_selfproduct = DB_DataObject :: factory('ApfSelfproduct');
		$apf_selfproduct->get($apf_selfproduct->escape($controller->getID()));
		$apf_selfproduct->setActive('deleted');
		$apf_selfproduct->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("selfproduct/apf_selfproduct/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_selfproduct_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_selfproduct = DB_DataObject :: factory('ApfSelfproduct');
		$apf_selfproduct->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_selfproduct->limit($start_num,$max_row);
		$apf_selfproduct->whereAdd(" userid = '$userid' OR access = 'public' ");
		$ToltalNum = $apf_selfproduct->count();

		$apf_selfproduct->find();
		
		$myData=array();
		while ($apf_selfproduct->fetch())
		{
			$myData[] = $apf_selfproduct->toArray();
		}
		$params = array(
		    'totalItems' => $ToltalNum,
		    'perPage' => $max_row,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    'prevImg'=>$i18n->_("PrevPage"),
		    'nextImg'=>$i18n->_("NextPage"),
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
		    ),
		
		);
		$pager = & Pager::factory($params);
		$links = $pager->getLinks();
		$current_page = $pager->getCurrentPageID();		
		$selectBox = $pager->getPageSelectBox(array('autoSubmit'=>true));
		$i = 0;
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"PRODUCTNAME" => $data['productname'],"RETAILPRICE" => $data['retailprice'],"WHOLESALEPRICE" => $data['wholesaleprice'],"COSTPRICE" => $data['costprice'],"PHOTO" => imageTag ($data['photo']),"RELEASEDATE" => $data['releasedate'],"MEMO" => $data['memo'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));

	}
	
}
?>