<?php

/**
 *
 * ApfDailyreport.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfDailyreport.class.php,v 1.1 2006/12/10 12:09:33 arzen Exp $
 */

class ApfDailyreport  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_dailyreport_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"FILL_DATE" => inputDateTag ("filldate",date("Y-m-d H:i:s")),
			"TEXTAREACONTENT" => textareaTag ("content","",true),
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
			"MAIN" => "apf_dailyreport_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_dailyreport = DB_DataObject :: factory('ApfDailyreport');
		$apf_dailyreport->get($apf_dailyreport->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_dailyreport->getId(),"TITLE" => $apf_dailyreport->getTitle(),"CONTENT" => $apf_dailyreport->getContent(),"FILLDATE" => $apf_dailyreport->getFilldate(),"ACTIVE" => $apf_dailyreport->getActive(),"GROUPID" => $apf_dailyreport->getGroupid(),"USERID" => $apf_dailyreport->getUserid(),"ADD_IP" => $apf_dailyreport->getAddIp(),"CREATED_AT" => $apf_dailyreport->getCreatedAt(),"UPDATE_AT" => $apf_dailyreport->getUpdateAt(),));
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"FILL_DATE" => inputDateTag ("filldate",$apf_dailyreport->getFilldate()),
			"TEXTAREACONTENT" => textareaTag ("content",$apf_dailyreport->getContent(),true),
			"DOACTION" => "updatesubmit"
		));

	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids
		;
		$apf_dailyreport = DB_DataObject :: factory('ApfDailyreport');

		if ($edit_submit) 
		{
			$apf_dailyreport->get($apf_dailyreport->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_dailyreport->setTitle(stripslashes(trim($_POST['title'])));
		$apf_dailyreport->setContent(stripslashes(trim($_POST['content'])));
		$apf_dailyreport->setFilldate(stripslashes(trim($_POST['filldate'])));
		$apf_dailyreport->setActive(stripslashes(trim($_POST['active'])));

		$apf_dailyreport->setAddIp($AddIP);
		$apf_dailyreport->setGroupid($group_ids);
		$apf_dailyreport->setUserid($userid);

				
		$val = $apf_dailyreport->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_dailyreport->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_dailyreport->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("dailyreport/apf_dailyreport/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_dailyreport->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_dailyreport->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("dailyreport/apf_dailyreport/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_dailyreport_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"FILL_DATE" => inputDateTag ("filldate",$_POST['filldate']),
				"TEXTAREACONTENT" => textareaTag ("content",$_POST['content'],true),
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
				"ID" => $_POST['id'],"TITLE" => $_POST['title'],"CONTENT" => $_POST['content'],"FILLDATE" => $_POST['filldate'],"ACTIVE" => $_POST['active'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_dailyreport = DB_DataObject :: factory('ApfDailyreport');
		$apf_dailyreport->get($apf_dailyreport->escape($controller->getID()));
		$apf_dailyreport->setActive('deleted');
		$apf_dailyreport->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("dailyreport/apf_dailyreport/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_dailyreport_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_dailyreport = DB_DataObject :: factory('ApfDailyreport');
		$apf_dailyreport->orderBy('id desc');

		$max_row = 10;
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_dailyreport->limit($start_num,$max_row);
		$apf_dailyreport->whereAdd(" userid = '$userid' ");
		$ToltalNum = $apf_dailyreport->count();

		$apf_dailyreport->find();
		
		$myData=array();
		while ($apf_dailyreport->fetch())
		{
			$myData[] = $apf_dailyreport->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"TITLE" => $data['title'],"CONTENT" => $data['content'],"FILLDATE" => $data['filldate'],"ACTIVE" => $ActiveOption[$data['active']],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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