<?php

/**
 *
 * ApfCompany.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfCompany.class.php,v 1.1 2006/09/23 03:18:56 arzen Exp $
 */

class ApfCompany  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_company_edit.html"
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
			"MAIN" => "apf_company_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_company = DB_DataObject :: factory('ApfCompany');
		$apf_company->get($apf_company->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_company->getId(),"NAME" => $apf_company->getName(),"ADDREES" => $apf_company->getAddrees(),"PHONE" => $apf_company->getPhone(),"FAX" => $apf_company->getFax(),"EMAIL" => $apf_company->getEmail(),"PHOTO" => $apf_company->getPhoto(),"HOMEPAGE" => $apf_company->getHomepage(),"EMPLOYEE" => $apf_company->getEmployee(),"BANKROLL" => $apf_company->getBankroll(),"LINK_MAN" => $apf_company->getLinkMan(),"INCORPORATOR" => $apf_company->getIncorporator(),"INDUSTRY" => $apf_company->getIndustry(),"PRODUCTS" => $apf_company->getProducts(),"MEMO" => $apf_company->getMemo(),"ACTIVE" => $apf_company->getActive(),"ADD_IP" => $apf_company->getAddIp(),"CREATED_AT" => $apf_company->getCreatedAt(),"UPDATE_AT" => $apf_company->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_company = DB_DataObject :: factory('ApfCompany');

		if ($edit_submit) 
		{
			$apf_company->get($apf_company->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_company->setName(stripslashes(trim($_POST['name'])));
		$apf_company->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_company->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_company->setFax(stripslashes(trim($_POST['fax'])));
		$apf_company->setEmail(stripslashes(trim($_POST['email'])));
		$apf_company->setPhoto(stripslashes(trim($_POST['photo'])));
		$apf_company->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_company->setEmployee(stripslashes(trim($_POST['employee'])));
		$apf_company->setBankroll(stripslashes(trim($_POST['bankroll'])));
		$apf_company->setLinkMan(stripslashes(trim($_POST['link_man'])));
		$apf_company->setIncorporator(stripslashes(trim($_POST['incorporator'])));
		$apf_company->setIndustry(stripslashes(trim($_POST['industry'])));
		$apf_company->setProducts(stripslashes(trim($_POST['products'])));
		$apf_company->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_company->setActive(stripslashes(trim($_POST['active'])));
		$apf_company->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_company->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_company->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_company->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_company->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_company->update();
				$this->forward("company/apf_company/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_company->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_company->insert();
				$this->forward("company/apf_company/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_company_edit.html"
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
				"ID" => $_POST['id'],"NAME" => $_POST['name'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"EMAIL" => $_POST['email'],"PHOTO" => $_POST['photo'],"HOMEPAGE" => $_POST['homepage'],"EMPLOYEE" => $_POST['employee'],"BANKROLL" => $_POST['bankroll'],"LINK_MAN" => $_POST['link_man'],"INCORPORATOR" => $_POST['incorporator'],"INDUSTRY" => $_POST['industry'],"PRODUCTS" => $_POST['products'],"MEMO" => $_POST['memo'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_company = DB_DataObject :: factory('ApfCompany');
		$apf_company->get($apf_company->escape($controller->getID()));
		$apf_company->setActive('deleted');
		$apf_company->update();
		$this->forward("company/apf_company/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_company_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_company = DB_DataObject :: factory('ApfCompany');

		$apf_company->orderBy('id desc');
		
		$apf_company->find();
		
		$i=0;
		while ($apf_company->fetch())
		{
			$myData[] = $apf_company->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"NAME" => $data['name'],"ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"FAX" => $data['fax'],"EMAIL" => $data['email'],"PHOTO" => $data['photo'],"HOMEPAGE" => $data['homepage'],"EMPLOYEE" => $data['employee'],"BANKROLL" => $data['bankroll'],"LINK_MAN" => $data['link_man'],"INCORPORATOR" => $data['incorporator'],"INDUSTRY" => $data['industry'],"PRODUCTS" => $data['products'],"MEMO" => $data['memo'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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