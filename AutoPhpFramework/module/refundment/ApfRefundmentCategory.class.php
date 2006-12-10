<?php

/**
 *
 * ApfRefundmentCategory.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfRefundmentCategory.class.php,v 1.2 2006/12/10 00:29:56 arzen Exp $
 */

class ApfRefundmentCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_refundment_category_edit.html"
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
			"MAIN" => "apf_refundment_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$apf_refundment_category = DB_DataObject :: factory('ApfRefundmentCategory');
		$apf_refundment_category->get($apf_refundment_category->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_refundment_category->getId(),"CATEGORY_NAME" => $apf_refundment_category->getCategoryName(),"ACTIVE" => $apf_refundment_category->getActive(),"ADD_IP" => $apf_refundment_category->getAddIp(),"CREATED_AT" => $apf_refundment_category->getCreatedAt(),"UPDATE_AT" => $apf_refundment_category->getUpdateAt(),));

		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_refundment_category->getActive()),
			"DOACTION" => "updatesubmit"
		));

		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$ActiveOption;
		$apf_refundment_category = DB_DataObject :: factory('ApfRefundmentCategory');

		if ($edit_submit) 
		{
			$apf_refundment_category->get($apf_refundment_category->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_refundment_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_refundment_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_refundment_category->setAddIp($AddIP);

				
		$val = $apf_refundment_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_refundment_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_refundment_category->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("refundment/apf_refundment_category/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_refundment_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_refundment_category->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("refundment/apf_refundment_category/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_refundment_category_edit.html"
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
				"ID" => $_POST['id'],"CATEGORY_NAME" => $_POST['category_name'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_refundment_category = DB_DataObject :: factory('ApfRefundmentCategory');
		$apf_refundment_category->get($apf_refundment_category->escape($controller->getID()));
		$apf_refundment_category->setActive('deleted');
		$apf_refundment_category->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("refundment/apf_refundment_category/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_refundment_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_refundment_category = DB_DataObject :: factory('ApfRefundmentCategory');
		$apf_refundment_category->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_refundment_category->limit($start_num,$max_row);
		$ToltalNum = $apf_refundment_category->count();

		$apf_refundment_category->find();
		
		$myData=array();
		while ($apf_refundment_category->fetch())
		{
			$myData[] = $apf_refundment_category->toArray();
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
			"PAGINATION" => $links['all']
		));

	}
	
}
?>