<?php

/**
 *
 * ApfContact.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfContact.class.php,v 1.2 2006/09/23 04:47:29 arzen Exp $
 */

class ApfContact  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_contact_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"BIRTHDAYDATE" => inputDateTag ("birthday"),
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
			"MAIN" => "apf_contact_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_contact->getId(),"CATEGORY" => $apf_contact->getCategory(),"COMPANY_ID" => $apf_contact->getCompanyId(),"NAME" => $apf_contact->getName(),"GENDER" => $apf_contact->getGender(),"BIRTHDAY" => $apf_contact->getBirthday(),"ADDREES" => $apf_contact->getAddrees(),"OFFICE_PHONE" => $apf_contact->getOfficePhone(),"PHONE" => $apf_contact->getPhone(),"FAX" => $apf_contact->getFax(),"MOBILE" => $apf_contact->getMobile(),"EMAIL" => $apf_contact->getEmail(),"PHOTO" => $apf_contact->getPhoto(),"HOMEPAGE" => $apf_contact->getHomepage(),"ACTIVE" => $apf_contact->getActive(),"ADD_IP" => $apf_contact->getAddIp(),"CREATED_AT" => $apf_contact->getCreatedAt(),"UPDATE_AT" => $apf_contact->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_contact = DB_DataObject :: factory('ApfContact');

		if ($edit_submit) 
		{
			$apf_contact->get($apf_contact->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_contact->setCategory(stripslashes(trim($_POST['category'])));
		$apf_contact->setCompanyId(stripslashes(trim($_POST['company_id'])));
		$apf_contact->setName(stripslashes(trim($_POST['name'])));
		$apf_contact->setGender(stripslashes(trim($_POST['gender'])));
		$apf_contact->setBirthday(stripslashes(trim($_POST['birthday'])));
		$apf_contact->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_contact->setOfficePhone(stripslashes(trim($_POST['office_phone'])));
		$apf_contact->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_contact->setFax(stripslashes(trim($_POST['fax'])));
		$apf_contact->setMobile(stripslashes(trim($_POST['mobile'])));
		$apf_contact->setEmail(stripslashes(trim($_POST['email'])));
		$apf_contact->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_contact->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_contact->setActive(stripslashes(trim($_POST['active'])));
		$apf_contact->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_contact->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_contact->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_contact->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_contact->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_contact->update();
				$this->forward("contact/apf_contact/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_contact->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_contact->insert();
				$this->forward("contact/apf_contact/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_contact_edit.html"
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
				"ID" => $_POST['id'],"CATEGORY" => $_POST['category'],"COMPANY_ID" => $_POST['company_id'],"NAME" => $_POST['name'],"GENDER" => $_POST['gender'],"BIRTHDAY" => $_POST['birthday'],"ADDREES" => $_POST['addrees'],"OFFICE_PHONE" => $_POST['office_phone'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"MOBILE" => $_POST['mobile'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"HOMEPAGE" => $_POST['homepage'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_contact = DB_DataObject :: factory('ApfContact');
		$apf_contact->get($apf_contact->escape($controller->getID()));
		$apf_contact->setActive('deleted');
		$apf_contact->update();
		$this->forward("contact/apf_contact/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_contact_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_contact = DB_DataObject :: factory('ApfContact');

		$apf_contact->orderBy('id desc');
		
		$apf_contact->find();
		
		$i=0;
		while ($apf_contact->fetch())
		{
			$myData[] = $apf_contact->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $data['category'],"COMPANY_ID" => $data['company_id'],"NAME" => $data['name'],"GENDER" => $data['gender'],"BIRTHDAY" => $data['birthday'],"ADDREES" => $data['addrees'],"OFFICE_PHONE" => $data['office_phone'],"PHONE" => $data['phone'],"FAX" => $data['fax'],"MOBILE" => $data['mobile'],"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"HOMEPAGE" => $data['homepage'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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