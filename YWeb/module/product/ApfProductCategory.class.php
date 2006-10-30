<?php

/**
 *
 * ApfProductCategory.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfProductCategory.class.php,v 1.4 2006/10/30 04:26:16 arzen Exp $
 */

include_once("ApfProduct.class.php");
class ApfProductCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption,$i18n,$controller;

		$template->setFile(array (
			"MAIN" => "apf_product_category_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$category_arr =array("0"=>$i18n->_("None"))+ApfProduct::getCategory();
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
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption;
		$template->setFile(array (
			"MAIN" => "apf_product_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->get($apf_product_category->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$category_arr =array("0"=>$i18n->_("None"))+ApfProduct::getCategory();
		unset($category_arr[$apf_product_category->getId()]);
		$template->setVar(array ("ID" => $apf_product_category->getId(),"CATEGORY_NAME" => $apf_product_category->getCategoryName(),"ACTIVE" => $apf_product_category->getActive(),"ADD_IP" => $apf_product_category->getAddIp(),"CREATED_AT" => $apf_product_category->getCreatedAt(),"UPDATE_AT" => $apf_product_category->getUpdateAt(),));
		array_shift($ActiveOption);
		$template->setVar(array (
			"PID" => $apf_product_category->getPid(),
			"CATEGORYOPTION" => selectTag("pid",$category_arr,$apf_product_category->getPid()),
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_product_category->getActive()),
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
		global $template,$WebBaseDir,$i18n,$ActiveOption;
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');

		if ($edit_submit) 
		{
			$apf_product_category->get($apf_product_category->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_product_category->setPid(stripslashes(trim($_POST['pid'])));
		$apf_product_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_product_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_product_category->setAddIp(stripslashes(trim($_POST['add_ip'])));

				
		$val = $apf_product_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_product_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_product_category->update();
				$this->forward("product/apf_product_category/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_product_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$insert_id = $apf_product_category->insert();
				$apf_product_category->get($insert_id);
				$apf_product_category->setOrderid($insert_id);
				$apf_product_category->update();
				$this->forward("product/apf_product_category/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_product_category_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$category_arr =array("0"=>$i18n->_("None"))+ApfProduct::getCategory();
			unset($category_arr[$_POST['ID']]);
			array_shift($ActiveOption);
			$template->setVar(array (
				"CATEGORYOPTION" => selectTag("pid",$category_arr,$_POST['pid']),
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
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
				"ID" => $_POST['id'],"CATEGORY_NAME" => $_POST['category_name'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->get($apf_product_category->escape($controller->getID()));
		$apf_product_category->setActive('deleted');
		$apf_product_category->update();
		$this->forward("product/apf_product_category/");
	}
	
	function executeMoveup () 
	{
		global $controller;
		
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->get($apf_product_category->escape($controller->getID()));
		$apf_product_category->find();
		
		$pre_item = DB_DataObject :: factory('ApfProductCategory');
		$pre_item->setPid($apf_product_category->getPid());
		$pre_item->whereAdd('orderid < '.$apf_product_category->getOrderid());
		$pre_item->orderBy('orderid DESC ');
		$pre_item->limit(1);
		$pre_item->find();
		$pre_item->fetch();
		if ($pre_item->getOrderid()>0) 
		{
			$apf_product_category->swapWith($pre_item);
		}
		$this->forward("product/apf_product_category/list/".$apf_product_category->getPid());
	}
	
	function executeMovedown () 
	{
		global $controller;
		
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->get($apf_product_category->escape($controller->getID()));
		$apf_product_category->find();
		
		$next_item = DB_DataObject :: factory('ApfProductCategory');
		$next_item->setPid($apf_product_category->getPid());
		$next_item->whereAdd('orderid > '.$apf_product_category->getOrderid());
		$next_item->orderBy('orderid ASC ');
		$next_item->limit(1);
		$next_item->find();
		$next_item->fetch();
		if ($next_item->getOrderid()>0) 
		{
			$apf_product_category->swapWith($next_item);
		}
		$this->forward("product/apf_product_category/list/".$apf_product_category->getPid());
	}

	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$i18n,$ClassDir,$controller,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_product_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 10;
		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');

		if (($pid = trim($controller->getID())) != "") 
		{
			$apf_product_category->whereAdd("pid = '".$apf_product_category->escape($pid) . "' ");
			$template->setVar(array (
				"P_ID" => $pid
			));
		}
		else 
		{
			$apf_product_category->whereAdd("pid = '0' ");
		}

		$apf_product_category->orderBy('orderid ASC');
		
		$ToltalNum = $apf_product_category->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_product_category->limit($start_num,$max_row);
//		$apf_product_category->debugLevel(4);
		$apf_product_category->find();
		
		$i=0;
		$myData=array();
		while ($apf_product_category->fetch())
		{
			$myData[] = $apf_product_category->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY_NAME" => $data['category_name'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));
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
			
			$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
			$apf_product_category->get($parent_id);
			$template->setVar(array (
				"PARENTLIST" => navButtonTag ("parent_id",$i18n->_("Parent Listing"),$WebBaseDir."/product/apf_product_category/list/".$apf_product_category->getPid())
			));
		}
		else if($controller->getID())
		{
			$template->setVar(array (
				"PARENTLIST" => navButtonTag ("parent_id",$i18n->_("Parent Listing"),$WebBaseDir."/product/apf_product_category/list")
			));
		}

	}
	
}
?>