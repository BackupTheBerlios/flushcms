<?php

/**
 *
 * ApfComplaints.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfComplaints.class.php,v 1.2 2006/12/09 14:31:35 arzen Exp $
 */

class ApfComplaints  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$AccessOption,$ComplaintsStateOption;

		$template->setFile(array (
			"MAIN" => "apf_complaints_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		array_shift($AccessOption);
		array_shift($ComplaintsStateOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"HANDLE_DATE" => inputDateTag ("handledate",date("Y-m-d")),
			"ACCESSOPTION" => radioTag("access",$AccessOption,"public"),
			"STATE_OPTION" => radioTag("state",$ComplaintsStateOption,"handling"),
			"CONTENT_TEXT" => textareaTag ('content',"",false,"ROWS=\"8\" COLS=\"40\""),
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
			"MAIN" => "apf_complaints_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");

		$apf_complaints = DB_DataObject :: factory('ApfComplaints');
		$apf_complaints->get($apf_complaints->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_complaints->getId(),"CATEGORY" => $apf_complaints->getCategory(),"COMPLAINANTER" => $apf_complaints->getComplainanter(),"TITLE" => $apf_complaints->getTitle(),"CONTENT" => $apf_complaints->getContent(),"REPLY" => $apf_complaints->getReply(),"HANDLEMAN" => $apf_complaints->getHandleman(),"HANDLEDATE" => $apf_complaints->getHandledate(),"STATE" => $apf_complaints->getState(),"GROUPID" => $apf_complaints->getGroupid(),"USERID" => $apf_complaints->getUserid(),"ACCESS" => $apf_complaints->getAccess(),"ACTIVE" => $apf_complaints->getActive(),"ADD_IP" => $apf_complaints->getAddIp(),"CREATED_AT" => $apf_complaints->getCreatedAt(),"UPDATE_AT" => $apf_complaints->getUpdateAt(),));
		
		array_shift($AccessOption);
		array_shift($ComplaintsStateOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACCESSOPTION" => radioTag("access",$AccessOption,$apf_complaints->getAccess()),
			"STATE_OPTION" => radioTag("state",$ComplaintsStateOption,$apf_complaints->getState()),
			"HANDLE_DATE" => inputDateTag ("handledate",$apf_complaints->getHandledate()),
			"CONTENT_TEXT" => textareaTag ('content',$apf_complaints->getContent(),false,"ROWS=\"8\" COLS=\"40\""),
			"DOACTION" => "updatesubmit"
		));

		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids;
		$apf_complaints = DB_DataObject :: factory('ApfComplaints');

		if ($edit_submit) 
		{
			$apf_complaints->get($apf_complaints->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_complaints->setCategory(stripslashes(trim($_POST['category'])));
		$apf_complaints->setComplainanter(stripslashes(trim($_POST['complainanter'])));
		$apf_complaints->setTitle(stripslashes(trim($_POST['title'])));
		$apf_complaints->setContent(stripslashes(trim($_POST['content'])));
		$apf_complaints->setReply(stripslashes(trim($_POST['reply'])));
		$apf_complaints->setHandleman(stripslashes(trim($_POST['handleman'])));
		$apf_complaints->setHandledate(stripslashes(trim($_POST['handledate'])));
		$apf_complaints->setState(stripslashes(trim($_POST['state'])));

		$apf_complaints->setAccess(stripslashes(trim($_POST['access'])));
		$apf_complaints->setActive(stripslashes(trim($_POST['active'])));

		$apf_complaints->setAddIp($AddIP);
		$apf_complaints->setGroupid($group_ids);
		$apf_complaints->setUserid($userid);
				
		$val = $apf_complaints->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_complaints->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_complaints->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("complaints/apf_complaints/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_complaints->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_complaints->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("complaints/apf_complaints/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_complaints_edit.html"
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
				"ID" => $_POST['id'],"CATEGORY" => $_POST['category'],"COMPLAINANTER" => $_POST['complainanter'],"TITLE" => $_POST['title'],"content" => $_POST['content'],"REPLY" => $_POST['reply'],"HANDLEMAN" => $_POST['handleman'],"HANDLEDATE" => $_POST['handledate'],"STATE" => $_POST['state'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_complaints = DB_DataObject :: factory('ApfComplaints');
		$apf_complaints->get($apf_complaints->escape($controller->getID()));
		$apf_complaints->setActive('deleted');
		$apf_complaints->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("complaints/apf_complaints/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption,$ComplaintsStateOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_complaints_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_complaints = DB_DataObject :: factory('ApfComplaints');
		$apf_complaints->orderBy('id desc');

		$max_row = 10;
		$ToltalNum = $apf_complaints->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_complaints->limit($start_num,$max_row);
		$apf_complaints->whereAdd(" userid = '$userid' OR access = 'public' ");

		$apf_complaints->find();
		
		$myData=array();
		while ($apf_complaints->fetch())
		{
			$myData[] = $apf_complaints->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"CATEGORY" => $data['category'],"COMPLAINANTER" => $data['complainanter'],"TITLE" => $data['title'],"content" => $data['content'],"REPLY" => $data['reply'],"HANDLEMAN" => $data['handleman'],"HANDLEDATE" => $data['handledate'],"STATE" => $ComplaintsStateOption[$data['state']],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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