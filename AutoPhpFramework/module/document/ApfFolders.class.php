<?php

/**
 *
 * ApfFolders.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfFolders.class.php,v 1.2 2006/12/05 23:26:35 arzen Exp $
 */

class ApfFolders  extends Actions
{
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeCreatefolder () 
	{
		global $template,$WebBaseDir,$controller,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_folders_edit.html"
		));
		$template->setBlock("MAIN", "add_block");

		$params_id=$controller->getID();
		$PID = $params_id;
				
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "addsubmit",
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"PID" => $PID,
		));
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_folders_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->get($apf_folders->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_folders->getId(),"NAME" => $apf_folders->getName(),"PARENT" => $apf_folders->getParent(),"DESCRIPTION" => $apf_folders->getDescription(),"PASSWORD" => $apf_folders->getPassword(),"GROUPID" => $apf_folders->getGroupid(),"USERID" => $apf_folders->getUserid(),"ACTIVE" => $apf_folders->getActive(),"ADD_IP" => $apf_folders->getAddIp(),"CREATED_AT" => $apf_folders->getCreatedAt(),"UPDATE_AT" => $apf_folders->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids;
		$apf_folders = DB_DataObject :: factory('ApfFolders');

		if ($edit_submit) 
		{
			$apf_folders->get($apf_folders->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_folders->setName(stripslashes(trim($_POST['name'])));
		$apf_folders->setParent(stripslashes(trim($_POST['parent'])));
		$apf_folders->setDescription(stripslashes(trim($_POST['description'])));
		$apf_folders->setPassword(stripslashes(trim($_POST['password'])));
		$apf_folders->setActive(stripslashes(trim($_POST['active'])));

		$apf_folders->setAddIp($AddIP);
		$apf_folders->setGroupid($group_ids);
		$apf_folders->setUserid($userid);

		$this->createFolderByPID ($_POST['parent'],$_POST['name']);
				
		$val = $apf_folders->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_folders->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_folders->update();
				$this->forward("document/apf_folders/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_folders->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_folders->insert();
				$this->forward("document/apf_folders/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_folders_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
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
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"PARENT" => $_POST['parent'],"DESCRIPTION" => $_POST['description'],"PASSWORD" => $_POST['password'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->get($apf_folders->escape($controller->getID()));
		$apf_folders->setActive('deleted');
		$apf_folders->update();
		$this->forward("document/apf_folders/");
	}
	
	function executeList()
	{
		global $template,$controller,$WebBaseDir,$WebTemplateDir,$ClassDir,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_folders_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		
		$params_id=$controller->getID();
		$PID = $params_id?$params_id:0;
		
		$apf_folders = DB_DataObject :: factory('ApfFolders');
		$apf_folders->orderBy('id desc');
		$ToltalNum = $apf_folders->count();
		$apf_folders->find();
		
		$myData=array();
		while ($apf_folders->fetch())
		{
			$row = $apf_folders->toArray();
			$row['name']=$this->getFolderIco().$row['name'];
			$myData[] = $row;
		}

		$i = 0;
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"NAME" => $data['name'],"PARENT" => $data['parent'],"DESCRIPTION" => $data['description'],"PASSWORD" => $data['password'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PID" => $PID,
		));

	}
	
	function createFolderByPID ($pid,$name) 
	{
		global $DocumentDir;
		if (!file_exists($DocumentDir)) 
		{
			@mkdir($DocumentDir,0777);
		}
		if ($pid==0) 
		{
			$new_folder_name = $DocumentDir.$name;
			@mkdir($new_folder_name,0777);
			
		} 
		else 
		{
			
		}
	}
	
	function getFolderIco () 
	{
		global $WebTemplateFullPath;
		
		return "<img src=\"".$WebTemplateFullPath."images/fileico/folder_closed.gif\" />";
	}
	
}
?>