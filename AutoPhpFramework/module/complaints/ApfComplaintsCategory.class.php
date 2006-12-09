<?php

/**
 *
 * ApfComplaintsCategory.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfComplaintsCategory.class.php,v 1.2 2006/12/09 14:31:35 arzen Exp $
 */

class ApfComplaintsCategory  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption;

		$template->setFile(array (
			"MAIN" => "apf_complaints_category_edit.html"
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
			"MAIN" => "apf_complaints_category_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_complaints_category = DB_DataObject :: factory('ApfComplaintsCategory');
		$apf_complaints_category->get($apf_complaints_category->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_complaints_category->getId(),"CATEGORY_NAME" => $apf_complaints_category->getCategoryName(),"ACTIVE" => $apf_complaints_category->getActive(),"ADD_IP" => $apf_complaints_category->getAddIp(),"CREATED_AT" => $apf_complaints_category->getCreatedAt(),"UPDATE_AT" => $apf_complaints_category->getUpdateAt(),));
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_complaints_category->getActive()),
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
		$apf_complaints_category = DB_DataObject :: factory('ApfComplaintsCategory');

		if ($edit_submit) 
		{
			$apf_complaints_category->get($apf_complaints_category->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_complaints_category->setCategoryName(stripslashes(trim($_POST['category_name'])));
		$apf_complaints_category->setActive(stripslashes(trim($_POST['active'])));
		$apf_complaints_category->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_complaints_category->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_complaints_category->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_complaints_category->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_complaints_category->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_complaints_category->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("complaints/apf_complaints_category/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_complaints_category->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_complaints_category->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("complaints/apf_complaints_category/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_complaints_category_edit.html"
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
		$apf_complaints_category = DB_DataObject :: factory('ApfComplaintsCategory');
		$apf_complaints_category->get($apf_complaints_category->escape($controller->getID()));
		$apf_complaints_category->setActive('deleted');
		$apf_complaints_category->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("complaints/apf_complaints_category/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_complaints_category_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_complaints_category = DB_DataObject :: factory('ApfComplaintsCategory');
		$apf_complaints_category->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_complaints_category->limit($start_num,$max_row);
		$ToltalNum = $apf_complaints_category->count();

		$apf_complaints_category->find();
		
		$myData=array();
		while ($apf_complaints_category->fetch())
		{
			$myData[] = $apf_complaints_category->toArray();
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