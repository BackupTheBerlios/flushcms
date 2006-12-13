<?php

/**
 *
 * ApfUsers.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfUsers.class.php,v 1.22 2006/12/13 02:23:51 arzen Exp $
 */

class ApfUsers  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$LU,$GenderOption,$ActiveOption,$luadmin,$i18n;
		
		if ($LU->checkRight(array(CREATE))) 
		{
			$template->setFile(array (
				"MAIN" => "apf_users_edit.html"
			));
			$template->setBlock("MAIN", "add_block");
			
			$groups = $luadmin->perm->getGroups();
			foreach($groups as $data)
			{
				$category_arr[$data['group_id']] = $data['group_define_name'];
			}
			
			array_shift($GenderOption);
			array_shift($ActiveOption);
			$template->setVar(array (
				"GENDEROPTION" => radioTag("gender",$GenderOption,"m"),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
				"FILEPHOTO" => fileTag("photo"),
				"MEMO_TEXT" => textareaTag ('memo','',false,"ROWS=\"8\" COLS=\"40\""),
				"GROUPOPTION" => selectTag("group",$category_arr,""),
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
		global $template,$userid,$luadmin,$LU,$i18n,$WebBaseDir,$ClassDir,$controller,$GenderOption,$ActiveOption,$WebTemplateDir;
		
		include_once($ClassDir."URLHelper.class.php");
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
		$groups = $luadmin->perm->getGroups();
		foreach($groups as $data)
		{
			$category_arr[$data['group_id']] = $data['group_define_name'];
		}

		$params = array('fields' => array('perm_user_id',
										  'auth_user_id',
										  'group_id'),
						'filters'=> array('auth_user_id'=>$controller->getID()),
										  
						);
		$users = $luadmin->perm->getUsers($params);
		$group_id = 0;

		if ($users && is_array($users)) 
		{
			$group_id=$users[0]['group_id'];
		}
//		Var_Dump::display($users[0]['group_id']);	
		
		array_shift($GenderOption);
		array_shift($ActiveOption);
		$template->setVar(array ("ID" => $apf_users->getId(),"USER_NAME" => $apf_users->getUserName(),"REALNAME" => $apf_users->getRealname(),"OLD_PASSWORD" => $apf_users->getUserPwd(),"GENDER" => $apf_users->getGender(),"ADDREES" => $apf_users->getAddrees(),"PHONE" => $apf_users->getPhone(),"EMAIL" => $apf_users->getEmail(),"PHOTO" => $apf_users->getPhoto(),"ROLE_ID" => $apf_users->getRoleId(),"ACTIVE" => $apf_users->getActive(),"ADD_IP" => $apf_users->getAddIp(),"CREATED_AT" => $apf_users->getCreatedAt(),"UPDATE_AT" => $apf_users->getUpdateAt(),));
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"GENDEROPTION" => radioTag("gender",$GenderOption,$apf_users->getGender()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_users->getActive()),
			"FILEPHOTO" => fileTag("photo",$apf_users->getPhoto()),
			"MEMO_TEXT" => textareaTag ('memo',$apf_users->getMemo(),false,"ROWS=\"8\" COLS=\"40\""),
			"GROUPOPTION" => selectTag("group",$category_arr,$group_id),
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
		global $template,$WebBaseDir,$i18n,$luadmin,$ClassDir,$AllowUploadFilesType,$UploadDir;
		
		include_once 'HTTP/UploadProgressMeter.class.php';
		$fileWidget = new UploadProgressMeter();
		$fileWidget->name='photo';
		if ($fileWidget->uploadComplete()) 
		{
			$fileWidget->finalStatus();
		}
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
		$apf_users->setRealname(stripslashes(trim($_POST['realname'])));
		$apf_users->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_users->setGender(stripslashes(trim($_POST['gender'])));
		$apf_users->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_users->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_users->setEmail(stripslashes(trim($_POST['email'])));
		$apf_users->setRoleId(stripslashes(trim($_POST['role_id'])));
		$apf_users->setActive(stripslashes(trim($_POST['active'])));


		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_users->setPhoto("");
			$_POST['photo_old']="";
		}
		if($_POST['upload_temp'])
		{
			$apf_users->setPhoto($_POST['upload_temp']);	
		}
		$allow_upload_file = TRUE;
		if($_FILES['photo']['name'])
		{
			require_once ($ClassDir."FileHelper.class.php");
			$upload_data = FileHelper::uploadFile ("users");
			$allow_upload_file = $upload_data["upload_state"];
			if ($allow_upload_file) 
			{
				$photos_arr = $upload_data["upload_msg"];
				if ($photo_pic = $photos_arr['photo']) 
				{
					$apf_users->setPhoto($photo_pic);
					$_POST['upload_temp'] = $photo_pic;
				}
			}
			else
			{
				$upload_error_msg = $upload_data["upload_msg"];
			}

		}

				
		$val = $apf_users->validate();
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
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$GenderOption,$i18n,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_users_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_users = DB_DataObject :: factory('ApfUsers');

		$apf_users->orderBy('id desc');

		$max_row = 30;
		$ToltalNum = $apf_users->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_users->limit($start_num,$max_row);
		
		$apf_users->find();
		
		while ($apf_users->fetch())
		{
			$myData[] = $apf_users->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"USER_NAME" => $data['user_name'],"REALNAME" => $data['realname'],"USER_PWD" => $data['user_pwd'],"GENDER" => $GenderOption[$data['gender']],"ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"EMAIL" => showEmail ($data['email']),"PHOTO" => $data['photo'],"ROLE_ID" => $data['role_id'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"CURRENT_PAGE" => $current_page,
			"SELECT_BOX" => $selectBox,
			"PAGINATION" => $links['all']
		));

	}
	
	
}
?>