<?php

/**
 *
 * ApfSelfcompany.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfSelfcompany.class.php,v 1.3 2006/12/14 23:37:25 arzen Exp $
 */

class ApfSelfcompany  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_selfcompany_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"FILEPHOTO" => fileTag("photo"),
			"BANKACCOUNTS_TEXT" => textareaTag ('bankaccounts','',false,"ROWS=\"4\" COLS=\"40\""),
			"PRODUCTS_TEXT" => textareaTag ('products','',false,"ROWS=\"4\" COLS=\"40\""),
			"MEMO_TEXT" => textareaTag ('memo','',false,"ROWS=\"8\" COLS=\"40\""),
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
			"MAIN" => "apf_selfcompany_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_selfcompany = DB_DataObject :: factory('ApfSelfcompany');
//		$apf_selfcompany->get($apf_selfcompany->escape($controller->getID()));
		$apf_selfcompany->find();
		$apf_selfcompany->fetch();

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_selfcompany->getId(),"NAME" => $apf_selfcompany->getName(),"ADDREES" => $apf_selfcompany->getAddrees(),"PHONE" => $apf_selfcompany->getPhone(),"FAX" => $apf_selfcompany->getFax(),"EMAIL" => $apf_selfcompany->getEmail(),"PHOTO" => $apf_selfcompany->getPhoto(),"HOMEPAGE" => $apf_selfcompany->getHomepage(),"EMPLOYEE" => $apf_selfcompany->getEmployee(),"BANKROLL" => $apf_selfcompany->getBankroll(),"LINK_MAN" => $apf_selfcompany->getLinkMan(),"INCORPORATOR" => $apf_selfcompany->getIncorporator(),"INDUSTRY" => $apf_selfcompany->getIndustry(),"TAXACCOUNTS" => $apf_selfcompany->getTaxaccounts(),"BANKACCOUNTS" => $apf_selfcompany->getBankaccounts(),"PRODUCTS" => $apf_selfcompany->getProducts(),"MEMO" => $apf_selfcompany->getMemo(),"ACTIVE" => $apf_selfcompany->getActive(),"ACCESS" => $apf_selfcompany->getAccess(),"GROUPID" => $apf_selfcompany->getGroupid(),"USERID" => $apf_selfcompany->getUserid(),"ADD_IP" => $apf_selfcompany->getAddIp(),"CREATED_AT" => $apf_selfcompany->getCreatedAt(),"UPDATE_AT" => $apf_selfcompany->getUpdateAt(),));
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"FILEPHOTO" => fileTag("photo",$apf_selfcompany->getPhoto()),
			"BANKACCOUNTS_TEXT" => textareaTag ('bankaccounts',$apf_selfcompany->getBankaccounts(),false,"ROWS=\"4\" COLS=\"40\""),
			"PRODUCTS_TEXT" => textareaTag ('products',$apf_selfcompany->getProducts(),false,"ROWS=\"4\" COLS=\"40\""),
			"MEMO_TEXT" => textareaTag ('memo',$apf_selfcompany->getMemo(),false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$UploadDir,$ClassDir,$AddIP,$userid,$group_ids;
		$apf_selfcompany = DB_DataObject :: factory('ApfSelfcompany');

		if ($edit_submit) 
		{
			$apf_selfcompany->get($apf_selfcompany->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_selfcompany->setName(stripslashes(trim($_POST['name'])));
		$apf_selfcompany->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_selfcompany->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_selfcompany->setFax(stripslashes(trim($_POST['fax'])));
		$apf_selfcompany->setEmail(stripslashes(trim($_POST['email'])));
		$apf_selfcompany->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_selfcompany->setEmployee(stripslashes(trim($_POST['employee'])));
		$apf_selfcompany->setBankroll(stripslashes(trim($_POST['bankroll'])));
		$apf_selfcompany->setLinkMan(stripslashes(trim($_POST['link_man'])));
		$apf_selfcompany->setIncorporator(stripslashes(trim($_POST['incorporator'])));
		$apf_selfcompany->setIndustry(stripslashes(trim($_POST['industry'])));
		$apf_selfcompany->setTaxaccounts(stripslashes(trim($_POST['taxaccounts'])));
		$apf_selfcompany->setBankaccounts(stripslashes(trim($_POST['bankaccounts'])));
		$apf_selfcompany->setProducts(stripslashes(trim($_POST['products'])));
		$apf_selfcompany->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_selfcompany->setActive(stripslashes(trim($_POST['active'])));
		$apf_selfcompany->setAccess(stripslashes(trim($_POST['access'])));

		$apf_selfcompany->setAddIp($AddIP);
		$apf_selfcompany->setGroupid($group_ids);
		$apf_selfcompany->setUserid($userid);

		if ($_POST['photo_del']=='Y') 
		{
			unlink($UploadDir.$_POST['photo_old']);
			$apf_selfcompany->setPhoto("");
			$_POST['photo_old']="";
		}
		if($_POST['upload_temp'])
		{
			$apf_selfcompany->setPhoto($_POST['upload_temp']);	
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
					$apf_selfcompany->setPhoto($photo_pic);
					$_POST['upload_temp'] = $photo_pic;
				}
			}
			else
			{
				$upload_error_msg = $upload_data["upload_msg"];
			}

		}
				
		$val = $apf_selfcompany->validate();
		if (($val === TRUE) && ($allow_upload_file === TRUE))
		{
			if ($edit_submit) 
			{
				$apf_selfcompany->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_selfcompany->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("selfcompany/apf_selfcompany/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_selfcompany->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_selfcompany->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("selfcompany/apf_selfcompany/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_selfcompany_edit.html"
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
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"HOMEPAGE" => $_POST['homepage'],"EMPLOYEE" => $_POST['employee'],"BANKROLL" => $_POST['bankroll'],"LINK_MAN" => $_POST['link_man'],"INCORPORATOR" => $_POST['incorporator'],"INDUSTRY" => $_POST['industry'],"TAXACCOUNTS" => $_POST['taxaccounts'],"BANKACCOUNTS" => $_POST['bankaccounts'],"PRODUCTS" => $_POST['products'],"MEMO" => $_POST['memo'],"ACTIVE" => $_POST['active'],"ACCESS" => $_POST['access'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_selfcompany = DB_DataObject :: factory('ApfSelfcompany');
		$apf_selfcompany->get($apf_selfcompany->escape($controller->getID()));
		$apf_selfcompany->setActive('deleted');
		$apf_selfcompany->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("selfcompany/apf_selfcompany/");
	}
	
	function executeList()
	{
		
		$apf_selfcompany = DB_DataObject :: factory('ApfSelfcompany');
//		$apf_selfcompany->debugLevel(4);
		$apf_selfcompany->find();
		$apf_selfcompany->fetch();
		if ($apf_selfcompany->getId()) 
		{
			$this->executeUpdate();
		} 
		else 
		{
			$this->executeCreate();
		}
	}
	
}
?>