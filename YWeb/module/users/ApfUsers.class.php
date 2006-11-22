<?php

/**
 *
 * ApfUsers.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfUsers.class.php,v 1.2 2006/11/22 05:45:34 arzen Exp $
 */

class ApfUsers  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$LU,$GenderOption,$ActiveOption;
		
		if ($LU->checkRight(array(CREATE))) 
		{
			$template->setFile(array (
				"MAIN" => "apf_users_edit.html"
			));
			$template->setBlock("MAIN", "add_block");
			
			array_shift($GenderOption);
			array_shift($ActiveOption);
			$template->setVar(array (
				"GENDEROPTION" => radioTag("gender",$GenderOption,"m"),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
				"FILEPHOTO" => fileTag("photo"),
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => "addsubmit"
			));
		} 
		else 
		{
			$this->notPermit();
		}


	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$GenderOption,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_users_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_users = DB_DataObject :: factory('ApfUsers');
		$apf_users->get($apf_users->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}

		array_shift($GenderOption);
		array_shift($ActiveOption);
		$template->setVar(array ("ID" => $apf_users->getId(),"USER_NAME" => $apf_users->getUserName(),"OLD_PASSWORD" => $apf_users->getUserPwd(),"GENDER" => $apf_users->getGender(),"ADDREES" => $apf_users->getAddrees(),"PHONE" => $apf_users->getPhone(),"EMAIL" => $apf_users->getEmail(),"PHOTO" => $apf_users->getPhoto(),"ROLE_ID" => $apf_users->getRoleId(),"ACTIVE" => $apf_users->getActive(),"ADD_IP" => $apf_users->getAddIp(),"CREATED_AT" => $apf_users->getCreatedAt(),"UPDATE_AT" => $apf_users->getUpdateAt(),));
		$template->setVar(array (
			"GENDEROPTION" => radioTag("gender",$GenderOption,$apf_users->getGender()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_users->getActive()),
			"FILEPHOTO" => fileTag("photo",$apf_users->getPhoto()),
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$PhpbbDir,$i18n,$luadmin,$ClassDir,$AllowUploadFilesType,$UploadDir;
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

		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_users->setPhoto("");
			$_POST['photo_old']="";
		}

		$allow_upload_file = TRUE;
		if($_FILES['photo']['name'])
		{
			require_once 'HTTP/Upload.php';
			require_once ($ClassDir."FileHelper.class.php");
			$upload = new http_upload();
			$file = $upload->getFiles('photo');
			$file->setValidExtensions($AllowUploadFilesType,'accept');
			if (PEAR::isError($file)) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->getMessage();
			}
			if ($file->isValid()) 
			{
				$file->setName('uniq');
				$current_date = FileHelper::createCategoryDir($UploadDir,"users");
				$date_photo_dir = $UploadDir.$current_date;
				$dest_name = $file->moveTo($date_photo_dir);
				if (PEAR::isError($dest_name)) 
				{
					$allow_upload_file = FALSE;
					$upload_error_msg = $dest_name->getMessage();
				}
				else 
				{
					$real = $file->getProp('real');
					$apf_users->setPhoto($current_date.$dest_name);
				}
			} 
			elseif ($file->isError()) 
			{
				$allow_upload_file = FALSE;
				$upload_error_msg = $file->errorMsg();
			}			
		}
				
		$val = $apf_users->validate();
//		Var_Dump($val);
		if ( ($val === TRUE) && ($allow_upload_file === TRUE) )
		{
			if ($edit_submit) 
			{
			    
				$apf_users->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_users->update();
				$password = stripslashes(trim($_POST['user_pwd']))?stripslashes(trim($_POST['user_pwd'])):stripslashes(trim($_POST['old_password']));
			    if (stripslashes(trim($_POST['user_pwd']))) 
				{
				    $data = array(
				        'handle' => stripslashes(trim($_POST['user_name'])),
				        'passwd' => $password,
				    );
			    	$updated = $luadmin->updateUser($data, $_POST['ID']);
				}

				$this->forward("users/apf_users/update/".$_POST['ID']."/ok");
			}
			else 
			{
			    $data = array(
			        'handle' => stripslashes(trim($_POST['user_name'])),
			        'passwd' => stripslashes(trim($_POST['user_pwd'])),
			        'perm_type'  => 1,
			    );
			    $user_id = $luadmin->addUser($data);
				$apf_users->get($apf_users->escape($user_id));
//				$apf_users->debugLevel(4);
				$apf_users->update();
				include_once($PhpbbDir.'/hook.php');
				$phpbb_action = 'insert';
				$phpbb_user['user_id'] = $user_id; // $uid变量是您要整合的系统中用户ID变量，根据系统不同自行修改，下同
				$phpbb_user['username'] = stripslashes(trim($_POST['user_name'])); // 用户名
				$phpbb_user['user_password'] = md5(stripslashes(trim($_POST['user_pwd']))); // 密码，注意必须是已经经过md5加密的密码
				$phpbb_user['user_email'] = stripslashes(trim($_POST['email'])); // email
				phpbb_user($phpbb_action, $phpbb_user);

				$this->forward("users/apf_users/");
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
			if ($allow_upload_file !== TRUE) 
			{
				$template->setVar(array (
					"PHOTO_ERROR_MSG" => " &darr; {$upload_error_msg} &darr; "
				));
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
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$GenderOption;

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
			
			$template->setVar(array ("ID" => $data['id'],"USER_NAME" => $data['user_name'],"USER_PWD" => $data['user_pwd'],"GENDER" => $GenderOption[$data['gender']],"ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"ROLE_ID" => $data['role_id'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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