<?php

/**
 *
 * ApfRefundment.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfRefundment.class.php,v 1.1 2006/12/09 04:17:35 arzen Exp $
 */

class ApfRefundment  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_refundment_edit.html"
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
			"MAIN" => "apf_refundment_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_refundment = DB_DataObject :: factory('ApfRefundment');
		$apf_refundment->get($apf_refundment->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_refundment->getId(),"CATEGORY" => $apf_refundment->getCategory(),"COMPANY" => $apf_refundment->getCompany(),"REFUNDMENTER" => $apf_refundment->getRefundmenter(),"REASONS" => $apf_refundment->getReasons(),"REPLY" => $apf_refundment->getReply(),"HANDLEMAN" => $apf_refundment->getHandleman(),"HANDLEDATE" => $apf_refundment->getHandledate(),"STATE" => $apf_refundment->getState(),"GROUPID" => $apf_refundment->getGroupid(),"USERID" => $apf_refundment->getUserid(),"ACCESS" => $apf_refundment->getAccess(),"ACTIVE" => $apf_refundment->getActive(),"ADD_IP" => $apf_refundment->getAddIp(),"CREATED_AT" => $apf_refundment->getCreatedAt(),"UPDATE_AT" => $apf_refundment->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_refundment = DB_DataObject :: factory('ApfRefundment');

		if ($edit_submit) 
		{
			$apf_refundment->get($apf_refundment->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_refundment->setCategory(stripslashes(trim($_POST['category'])));
		$apf_refundment->setCompany(stripslashes(trim($_POST['company'])));
		$apf_refundment->setRefundmenter(stripslashes(trim($_POST['refundmenter'])));
		$apf_refundment->setReasons(stripslashes(trim($_POST['reasons'])));
		$apf_refundment->setReply(stripslashes(trim($_POST['reply'])));
		$apf_refundment->setHandleman(stripslashes(trim($_POST['handleman'])));
		$apf_refundment->setHandledate(stripslashes(trim($_POST['handledate'])));
		$apf_refundment->setState(stripslashes(trim($_POST['state'])));
		$apf_refundment->setGroupid(stripslashes(trim($_POST['groupid'])));
		$apf_refundment->setUserid(stripslashes(trim($_POST['userid'])));
		$apf_refundment->setAccess(stripslashes(trim($_POST['access'])));
		$apf_refundment->setActive(stripslashes(trim($_POST['active'])));
		$apf_refundment->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_refundment->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_refundment->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_refundment->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_refundment->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_refundment->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("refundment/apf_refundment/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_refundment->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_refundment->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("refundment/apf_refundment/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_refundment_edit.html"
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
				"ID" => $_POST['id'],"CATEGORY" => $_POST['category'],"COMPANY" => $_POST['company'],"REFUNDMENTER" => $_POST['refundmenter'],"REASONS" => $_POST['reasons'],"REPLY" => $_POST['reply'],"HANDLEMAN" => $_POST['handleman'],"HANDLEDATE" => $_POST['handledate'],"STATE" => $_POST['state'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_refundment = DB_DataObject :: factory('ApfRefundment');
		$apf_refundment->get($apf_refundment->escape($controller->getID()));
		$apf_refundment->setActive('deleted');
		$apf_refundment->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("refundment/apf_refundment/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_refundment_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_refundment = DB_DataObject :: factory('ApfRefundment');
		$apf_refundment->orderBy('id desc');

		$max_row = 10;
		$ToltalNum = $apf_refundment->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_refundment->limit($start_num,$max_row);
		$apf_refundment->whereAdd(" userid = '$userid' OR access = 'public' ");

		$apf_refundment->find();
		
		$myData=array();
		while ($apf_refundment->fetch())
		{
			$myData[] = $apf_refundment->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $data['category'],"COMPANY" => $data['company'],"REFUNDMENTER" => $data['refundmenter'],"REASONS" => $data['reasons'],"REPLY" => $data['reply'],"HANDLEMAN" => $data['handleman'],"HANDLEDATE" => $data['handledate'],"STATE" => $data['state'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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