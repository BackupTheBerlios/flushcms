<?php

/**
 *
 * ApfNewsCategory.class.php
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: ApfNewsCategory.class.php,v 1.5 2006/09/21 04:23:15 arzen Exp $
 */

class ApfNewsCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_news_category_edit.html"
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
			"MAIN" => "apf_news_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->get($apf_news_category->escape($controller->getID()));

		if ($_GET['view_status']=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>Your modifications have been saved</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_news_category->getId(),"CATEGORY_NAME" => $apf_news_category->getCategoryName(),"ACTIVE" => $apf_news_category->getActive(),"ADD_IP" => $apf_news_category->getAddIp(),"CREATED_AT" => $apf_news_category->getCreatedAt(),"UPDATE_AT" => $apf_news_category->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir;
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');

		if ($edit_submit) 
		{
			$apf_news_category->get($apf_news_category->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_news_category->setId(stripslashes(trim($_POST['id'])));
		$apf_news_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_news_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_news_category->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_news_category->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_news_category->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_news_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_news_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_news_category->update();
				$this->forward("news/apf_news_category/update/".$_POST['ID']);
			}
			else 
			{
				$apf_news_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_news_category->insert();
				$this->forward("news/apf_news_category/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_news_category_edit.html"
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
						strtoupper($k)."_ERROR_MSG" => " &darr; Please check here &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"CATEGORY_NAME" => $_POST['category_name'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->get($apf_news_category->escape($controller->getID()));
		$apf_news_category->setActive('deleted');
		$apf_news_category->update();
		$this->forward("news/apf_news_category/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_news_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');

		$apf_news_category->orderBy('id desc');
		
		$apf_news_category->find();
		
		$i=0;
		while ($apf_news_category->fetch())
		{
			$myData[] = $apf_news_category->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY_NAME" => $data['category_name'],"ACTIVE" => $data['active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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