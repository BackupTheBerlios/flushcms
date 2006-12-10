<?php

/**
 *
 * ApfRefundment.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfRefundment.class.php,v 1.2 2006/12/10 00:29:56 arzen Exp $
 */

class ApfRefundment  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$AccessOption,$ComplaintsStateOption;

		$template->setFile(array (
			"MAIN" => "apf_refundment_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		array_shift($AccessOption);
		array_shift($ComplaintsStateOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"STATE_OPTION" => radioTag("state",$ComplaintsStateOption,"handling"),
			"HANDLE_DATE" => inputDateTag ("handledate",date("Y-m-d")),
			"REASONS_TEXT" => textareaTag ('reasons',"",false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$AccessOption,$ComplaintsStateOption;
		$template->setFile(array (
			"MAIN" => "apf_refundment_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
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
		
		array_shift($AccessOption);
		array_shift($ComplaintsStateOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACCESSOPTION" => radioTag("access",$AccessOption,$apf_refundment->getAccess()),
			"STATE_OPTION" => radioTag("state",$ComplaintsStateOption,$apf_refundment->getState()),
			"HANDLE_DATE" => inputDateTag ("handledate",$apf_refundment->getHandledate()),
			"REASONS_TEXT" => textareaTag ('reasons',$apf_refundment->getReasons(),false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids,$AccessOption,$ComplaintsStateOption;
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
		$apf_refundment->setAccess(stripslashes(trim($_POST['access'])));
		$apf_refundment->setActive(stripslashes(trim($_POST['active'])));

		$apf_refundment->setAddIp($AddIP);
		$apf_refundment->setGroupid($group_ids);
		$apf_refundment->setUserid($userid);

				
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
			array_shift($AccessOption);
			array_shift($ComplaintsStateOption);
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"ACCESSOPTION" => radioTag("access",$AccessOption,$_POST['access']),
				"STATE_OPTION" => radioTag("state",$ComplaintsStateOption,$_POST['state']),
				"HANDLE_DATE" => inputDateTag ("handledate",$_POST['handledate']),
				"REASONS_TEXT" => textareaTag ('reasons',$_POST['reasons'],false,"ROWS=\"8\" COLS=\"40\""),
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
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption,$ComplaintsStateOption;

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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $data['category'],"COMPANY" => $data['company'],"REFUNDMENTER" => $data['refundmenter'],"REASONS" => $data['reasons'],"REPLY" => $data['reply'],"HANDLEMAN" => $data['handleman'],"HANDLEDATE" => $data['handledate'],"STATE" => $ComplaintsStateOption[$data['state']],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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