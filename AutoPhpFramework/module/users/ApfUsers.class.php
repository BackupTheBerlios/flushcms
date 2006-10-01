<?php

/**
 *
 * ApfUsers.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfUsers.class.php,v 1.10 2006/10/01 12:04:52 arzen Exp $
 */

class ApfUsers  extends Actions
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
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller;
		$template->setFile(array (
			"MAIN" => "apf_users_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_users = DB_DataObject :: factory('ApfUsers');
		$apf_users->get($apf_users->escape($controller->getID()));

		if ($_GET['view_status']=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_users->getId(),"USER_NAME" => $apf_users->getUserName(),"USER_PWD" => $apf_users->getUserPwd(),"GENDER" => $apf_users->getGender(),"ADDREES" => $apf_users->getAddrees(),"PHONE" => $apf_users->getPhone(),"EMAIL" => $apf_users->getEmail(),"PHOTO" => $apf_users->getPhoto(),"ROLE_ID" => $apf_users->getRoleId(),"ACTIVE" => $apf_users->getActive(),"ADD_IP" => $apf_users->getAddIp(),"CREATED_AT" => $apf_users->getCreatedAt(),"UPDATE_AT" => $apf_users->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$luadmin;
		$apf_users = DB_DataObject :: factory('ApfUsers');

		if ($edit_submit) 
		{
			$apf_users->get($apf_users->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_users->setUserName(stripslashes(trim($_POST['user_name'])));
		$apf_users->setUserPwd(stripslashes(trim($_POST['user_pwd'])));
		$apf_users->setGender(stripslashes(trim($_POST['gender'])));
		$apf_users->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_users->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_users->setEmail(stripslashes(trim($_POST['email'])));
		$apf_users->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_users->setRoleId(stripslashes(trim($_POST['role_id'])));
		$apf_users->setActive(stripslashes(trim($_POST['active'])));
		$apf_users->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_users->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_users->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_users->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
			    
				$apf_users->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_users->update();
				
			    $data = array(
			        'handle' => 'johndoe' . rand(),
			        'passwd' => 'test',
			        'perm_type'  => 1,
			    );
			    $user_id = $luadmin->addUser($data);
			    if ($user_id === false) {
			        echo '<strong>Error on line: '.__LINE__.'</strong><br />';
			        print_r($luadmin->getErrors());
			    } else {
			        echo 'Created User Id <strong>' . $user_id . '</strong><br />';
			    }

//				$this->forward("users/apf_users/update/".$_POST['ID']);
			}
			else 
			{
				$apf_users->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_users->insert();
				

//				$this->forward("users/apf_users/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_users_edit.html"
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
				"ID" => $_POST['id'],"USER_NAME" => $_POST['user_name'],"USER_PWD" => $_POST['user_pwd'],"GENDER" => $_POST['gender'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"ROLE_ID" => $_POST['role_id'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_users = DB_DataObject :: factory('ApfUsers');
		$apf_users->get($apf_users->escape($controller->getID()));
		$apf_users->setActive('deleted');
		$apf_users->update();
		$this->forward("users/apf_users/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_users_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_users = DB_DataObject :: factory('ApfUsers');

		$apf_users->orderBy('id desc');
		
		$apf_users->find();
		
		$i=0;
		while ($apf_users->fetch())
		{
			$myData[] = $apf_users->toArray();
			$i++;
		}
		$ToltalNum =$i;
		
		$params = array(
		    'itemData' => $myData,
		    'perPage' => 10,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'extraVars' => array(
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
			
			$template->setVar(array ("ID" => $data['id'],"USER_NAME" => $data['user_name'],"USER_PWD" => $data['user_pwd'],"GENDER" => $data['gender'],"ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"ROLE_ID" => $data['role_id'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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