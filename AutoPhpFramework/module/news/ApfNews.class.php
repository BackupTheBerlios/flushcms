<?php

/**
 *
 * ApfNews.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfNews.class.php,v 1.3 2006/09/23 06:58:46 arzen Exp $
 */

class ApfNews  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_news_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =$this->getCategory();
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("category_id",$category_arr),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_news_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->get($apf_news->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_news->getId(),"CATEGORY_ID" => $apf_news->getCategoryId(),"TITLE" => $apf_news->getTitle(),"CONTENT" => $apf_news->getContent(),"ACTIVE" => $apf_news->getActive(),"ADD_IP" => $apf_news->getAddIp(),"CREATED_AT" => $apf_news->getCreatedAt(),"UPDATE_AT" => $apf_news->getUpdateAt(),));

		$category_arr =$this->getCategory();
		array_shift($ActiveOption);
		$template->setVar(array (
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_news->getActive()),
			"CATEGORYOPTION" => selectTag("category_id",$category_arr,$apf_news->getCategoryId()),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption;
		$apf_news = DB_DataObject :: factory('ApfNews');

		if ($edit_submit) 
		{
			$apf_news->get($apf_news->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_news->setCategoryId(stripslashes(trim($_POST['category_id'])));
		$apf_news->setTitle(stripslashes(trim($_POST['title'])));
		$apf_news->setContent(stripslashes(trim($_POST['content'])));
		$apf_news->setActive(stripslashes(trim($_POST['active'])));
		$apf_news->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_news->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_news->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_news->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_news->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_news->update();
				$this->forward("news/apf_news/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_news->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_news->insert();
				$this->forward("news/apf_news/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_news_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			$category_arr =$this->getCategory();
			array_shift($ActiveOption);
			$template->setVar(array (
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
				"CATEGORYOPTION" => selectTag("category_id",$category_arr,$_POST['category_id']),
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
				"ID" => $_POST['id'],"CATEGORY_ID" => $_POST['category_id'],"TITLE" => $_POST['title'],"CONTENT" => $_POST['content'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->get($apf_news->escape($controller->getID()));
		$apf_news->setActive('deleted');
		$apf_news->update();
		$this->forward("news/apf_news/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_news_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_news = DB_DataObject :: factory('ApfNews');
		$apf_news->orderBy('apf_news.id desc');
		$apf_news->buildCategroyJoin();
		$apf_news->selectAs(array('id','active'), 'n_%s','apf_news');
//		$apf_news->debugLevel(4);
		$apf_news->find();
		
		$i=0;
		while ($apf_news->fetch())
		{
			$myData[] = $apf_news->toArray();
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
			
			$template->setVar(array ("ID" => $data['n_id'],"CATEGORY_ID" => $data['category_name'],"TITLE" => $data['title'],"CONTENT" => $data['content'],"ACTIVE" => $data['n_active'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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
	
	function getCategory () 
	{
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->orderBy('orderid ASC');
		$apf_news_category->find();
		$myData = array();
		while ($apf_news_category->fetch())
		{
			$myData[$apf_news_category->getId()] = $apf_news_category->getCategoryName();
		}
		return $myData;
	}
	
}
?>