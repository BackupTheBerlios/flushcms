<?php

/**
 *
 * ApfUsers.class.php
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: ApfUsers.class.php,v 1.4 2006/09/18 15:12:48 arzen Exp $
 */

class ApfUsers 
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_users_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "AddSubmit"
		));


	}
	
	function executeAddSubmit()
	{
		$this->handleFormData();
	}
	
	function handleFormData ($edit_submit=false) 
	{
		global $template;
		$apf_users = DB_DataObject :: factory('ApfUsers');

		$apf_users->setUserName(stripslashes(trim($_POST['user_name'])));
		$apf_users->setUserPwd(stripslashes(trim($_POST['user_pwd'])));
		$apf_users->setGender(stripslashes(trim($_POST['gender'])));
		$apf_users->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_users->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_users->setEmail(stripslashes(trim($_POST['email'])));
		$apf_users->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_users->setActive(stripslashes(trim($_POST['active'])));
		$apf_users->setAddIp(stripslashes(trim($_POST['add_ip'])));
		
		$val = $apf_users->validate();
		if ($val === TRUE)
		{
			$apf_users->insert();
		}
		else
		{
			$template->setFile(array (
				"Main" => "apf_users_edit.html"
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
						strtoupper($k)."_ERROR_MSG" => " &darr; Please check here &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"USER_NAME" => $_POST['user_name'],"USER_PWD" => $_POST['user_pwd'],"GENDER" => $_POST['gender'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
		
	}
	
	function executeUpdateForm()
	{
		global $template;
		$template->setFile(array (
			"Main" => "apf_users_edit.html"
		));
		$template->setBlock("Main", "edit_block");
		$template->setVar(array (
			"DoAction" => "UpdateSubmit"
		));

		$apf_users = DB_DataObject :: factory('ApfUsers');
		$apf_users->get($apf_users->escape($_GET['ID']));

		if ($_GET['view_status']=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_users->getId(),"USER_NAME" => $apf_users->getUserName(),"USER_PWD" => $apf_users->getUserPwd(),"GENDER" => $apf_users->getGender(),"ADDREES" => $apf_users->getAddrees(),"PHONE" => $apf_users->getPhone(),"EMAIL" => $apf_users->getEmail(),"PHOTO" => $apf_users->getPhoto(),"ACTIVE" => $apf_users->getActive(),"ADD_IP" => $apf_users->getAddIp(),"CREATED_AT" => $apf_users->getCreatedAt(),"UPDATE_AT" => $apf_users->getUpdateAt(),));
		
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
		$apf_users = DB_DataObject :: factory('ApfUsers');

		$apf_users->get($apf_users->escape($_POST['ID']));
		$original = clone ($apf_users);

		$apf_users->setId(stripslashes(trim($_POST['id'])));
		$apf_users->setUserName(stripslashes(trim($_POST['user_name'])));
		$apf_users->setUserPwd(stripslashes(trim($_POST['user_pwd'])));
		$apf_users->setGender(stripslashes(trim($_POST['gender'])));
		$apf_users->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_users->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_users->setEmail(stripslashes(trim($_POST['email'])));
		$apf_users->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_users->setActive(stripslashes(trim($_POST['active'])));
		$apf_users->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_users->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_users->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$apf_users->setLastUpdated(DB_DataObject_Cast::dateTime());
		
		$val = $apf_users->validate();
		if ($val === TRUE)
		{
			$apf_users->update($original);
			$this->forward('apf_users.php',"act=Update&ID={$_POST['ID']}&view_status=ok");
		}
		else
		{
			$template->setFile(array (
				"Main" => "apf_users_edit.html"
			));
			$template->setBlock("Main", "edit_block");
			$template->setVar(array (
				"DoAction" => "UpdateSubmit"
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " &darr; Please check here &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"USER_NAME" => $_POST['user_name'],"USER_PWD" => $_POST['user_pwd'],"GENDER" => $_POST['gender'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
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
		$apf_users = DB_DataObject :: factory('ApfUsers');
		$apf_users->get($apf_users->escape($_GET['ID']));
		$apf_users->setStatus('deleted');
		$apf_users->update();

		$this->forward('apf_users.php');
	}
	
	function executeList()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_users_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
		));

	}
	
}
?>	