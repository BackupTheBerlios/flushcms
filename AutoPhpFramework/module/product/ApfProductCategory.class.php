<?php

/**
 *
 * ApfProductCategory.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfProductCategory.class.php,v 1.4 2006/12/08 10:10:55 arzen Exp $
 */

class ApfProductCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_product_category_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"live"),
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
			"MAIN" => "apf_product_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');
		$apf_product_category->get($apf_product_category->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_product_category->getId(),"CATEGORY_NAME" => $apf_product_category->getCategoryName(),"ACTIVE" => $apf_product_category->getActive(),"ADD_IP" => $apf_product_category->getAddIp(),"CREATED_AT" => $apf_product_category->getCreatedAt(),"UPDATE_AT" => $apf_product_category->getUpdateAt(),));
		array_shift($ActiveOption);
		$template->setVar(array (
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_product_category->getActive()),
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
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

		$apf_product_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_product_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_product_category->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_product_category->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_product_category->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_product_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_product_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_product_category->update();

				$log_string = $i18n->_("Update").$i18n->_("ProductCategory")."\t{$_POST['category_name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("product/apf_product_category/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_product_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_product_category->insert();

				$log_string = $i18n->_("Create").$i18n->_("ProductCategory")."\t{$_POST['category_name']}";
				logFileString ($log_string);

				$this->forward("product/apf_product_category/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_product_category_edit.html"
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
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$i18n,$ClassDir,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_product_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_product_category = DB_DataObject :: factory('ApfProductCategory');

		$apf_product_category->orderBy('id desc');

		$max_row = 30;
		$ToltalNum = $apf_product_category->count();
		
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_product_category->limit($start_num,$max_row);
		
		$apf_product_category->find();
		
		while ($apf_product_category->fetch())
		{
			$myData[] = $apf_product_category->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY_NAME" => $data['category_name'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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