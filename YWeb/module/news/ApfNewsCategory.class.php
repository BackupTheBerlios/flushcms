<?php

/**
 *
 * ApfNewsCategory.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfNewsCategory.class.php,v 1.3 2006/10/29 12:28:41 arzen Exp $
 */
include_once("ApfNews.class.php");
class ApfNewsCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$controller,$WebBaseDir,$ActiveOption,$i18n;

		$template->setFile(array (
			"MAIN" => "apf_news_category_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =array("0"=>$i18n->_("None"))+ApfNews::getCategory();
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"CATEGORYOPTION" => selectTag("pid",$category_arr,$controller->getID()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"live"),
			"DOACTION" => "addsubmit"
		));
		if (($pid = trim($controller->getID())) != "") 
		{
			$template->setVar(array (
				"PID" => $pid
			));
		}

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$ActiveOption,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_news_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");


		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->get($apf_news_category->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$category_arr =array("0"=>$i18n->_("None"))+ApfNews::getCategory();
		unset($category_arr[$apf_news_category->getId()]);
		$template->setVar(array ("ID" => $apf_news_category->getId(),"PID" => $apf_news_category->getPid(),"CATEGORY_NAME" => $apf_news_category->getCategoryName(),"ORDERID" => $apf_news_category->getOrderid(),"ACTIVE" => $apf_news_category->getActive(),"ADD_IP" => $apf_news_category->getAddIp(),"CREATED_AT" => $apf_news_category->getCreatedAt(),"UPDATE_AT" => $apf_news_category->getUpdateAt(),));
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"PID" => $apf_news_category->getPid(),
			"CATEGORYOPTION" => selectTag("pid",$category_arr,$apf_news_category->getPid()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_news_category->getActive()),
			"DOACTION" => "updatesubmit"
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption;
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

		$apf_news_category->setPid(stripslashes(trim($_POST['pid'])));
		$apf_news_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_news_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_news_category->setAddIp(stripslashes(trim($_POST['add_ip'])));

				
		$val = $apf_news_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_news_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_news_category->update();
				$this->forward("news/apf_news_category/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_news_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$insert_id = $apf_news_category->insert();
				$apf_news_category->get($insert_id);
				$apf_news_category->setOrderid($insert_id);
				$apf_news_category->update();
				$this->forward("news/apf_news_category/list/".$_POST['pid']);
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_news_category_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			array_shift($ActiveOption);
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
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
				"ID" => $_POST['id'],"PID" => $_POST['pid'],"CATEGORY_NAME" => $_POST['category_name'],"ORDERID" => $_POST['orderid'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
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
	
	function executeMoveup () 
	{
		global $controller;
		
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->get($apf_news_category->escape($controller->getID()));
		$apf_news_category->find();
		
		$pre_item = DB_DataObject :: factory('ApfNewsCategory');
		$pre_item->setPid($apf_news_category->getPid());
		$pre_item->whereAdd('orderid < '.$apf_news_category->getOrderid());
		$pre_item->orderBy('orderid DESC ');
		$pre_item->limit(1);
		$pre_item->find();
		$pre_item->fetch();
		if ($pre_item->getOrderid()>0) 
		{
			$apf_news_category->swapWith($pre_item);
		}
		$this->forward("news/apf_news_category/list/".$apf_news_category->getPid());
	}
	
	function executeMovedown () 
	{
		global $controller;
		
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		$apf_news_category->get($apf_news_category->escape($controller->getID()));
		$apf_news_category->find();
		
		$next_item = DB_DataObject :: factory('ApfNewsCategory');
		$next_item->setPid($apf_news_category->getPid());
		$next_item->whereAdd('orderid > '.$apf_news_category->getOrderid());
		$next_item->orderBy('orderid ASC ');
		$next_item->limit(1);
//		$next_item->debugLevel(4);
		$next_item->find();
		$next_item->fetch();
		if ($next_item->getOrderid()>0) 
		{
			$apf_news_category->swapWith($next_item);
		}
		$this->forward("news/apf_news_category/list/".$apf_news_category->getPid());
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$i18n,$ClassDir,$controller,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_news_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 10;
		$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
		
		if (($pid = trim($controller->getID())) != "") 
		{
			$apf_news_category->whereAdd("pid = '".$apf_news_category->escape($pid) . "' ");
			$template->setVar(array (
				"P_ID" => $pid
			));
		}
		else 
		{
			$apf_news_category->whereAdd("pid = '0' ");
		}

		$apf_news_category->orderBy('orderid ASC');
		$ToltalNum = $apf_news_category->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_news_category->limit($start_num,$max_row);

		$apf_news_category->find();
		
		$i=0;
		$myData=array();
		while ($apf_news_category->fetch())
		{
			$myData[] = $apf_news_category->toArray();
			$i++;
		}
		$tmpData = ($ToltalNum>$max_row)?array_pad($myData, $ToltalNum, array()):$myData;
		$params = array(
		    'itemData' => $tmpData,
		    'perPage' => $max_row,
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
		foreach($myData as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['id'],"PID" => $data['pid'],"CATEGORY_NAME" => $data['category_name'],"ORDERID" => $data['orderid'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));
			$parent_id = $data['pid'];
			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
			"PAGINATION" => $links['all']
		));
		if ($parent_id) 
		{
			
			$apf_news_category = DB_DataObject :: factory('ApfNewsCategory');
			$apf_news_category->get($parent_id);
			$template->setVar(array (
				"PARENTLIST" => navButtonTag ("parent_id",$i18n->_("Parent Listing"),$WebBaseDir."/news/apf_news_category/list/".$apf_news_category->getPid())
			));
		}
		else if($controller->getID())
		{
			$template->setVar(array (
				"PARENTLIST" => navButtonTag ("parent_id",$i18n->_("Parent Listing"),$WebBaseDir."/news/apf_news_category/list")
			));
		}

	}
	
}
?>