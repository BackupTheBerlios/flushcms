<?php

/**
 *
 * ApfSelfcompany.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfSelfcompany.class.php,v 1.1 2006/12/10 23:23:34 arzen Exp $
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
		$apf_selfcompany->get($apf_selfcompany->escape($controller->getID()));

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
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
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
		$apf_selfcompany->setPhoto(stripslashes(trim($_POST['photo'])));
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
		$apf_selfcompany->setGroupid(stripslashes(trim($_POST['groupid'])));
		$apf_selfcompany->setUserid(stripslashes(trim($_POST['userid'])));
		$apf_selfcompany->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_selfcompany->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_selfcompany->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_selfcompany->validate();
		if ($val === TRUE)
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
		$this->executeUpdate();
	}
	
}
?>