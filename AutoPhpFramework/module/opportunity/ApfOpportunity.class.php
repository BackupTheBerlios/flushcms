<?php

/**
 *
 * ApfOpportunity.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfOpportunity.class.php,v 1.6 2006/12/08 10:10:55 arzen Exp $
 */

class ApfOpportunity  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir,$ActiveOption,$StateOption;

		$template->setFile(array (
			"MAIN" => "apf_opportunity_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,"new"),
			"STATE_OPTION" => radioTag("state",$StateOption,"pending"),
			"MEMO_TEXT" => textareaTag ("memo",null,false,"ROWS=\"15\" COLS=\"60\" "),
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n,$ActiveOption,$StateOption;
		$template->setFile(array (
			"MAIN" => "apf_opportunity_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");


		$apf_opportunity = DB_DataObject :: factory('ApfOpportunity');
		$apf_opportunity->get($apf_opportunity->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_opportunity->getId(),"TITLE" => $apf_opportunity->getTitle(),"ADDREES" => $apf_opportunity->getAddrees(),"PHONE" => $apf_opportunity->getPhone(),"FAX" => $apf_opportunity->getFax(),"EMAIL" => $apf_opportunity->getEmail(),"HOMEPAGE" => $apf_opportunity->getHomepage(),"LINK_MAN" => $apf_opportunity->getLinkMan(),"MEMO" => $apf_opportunity->getMemo(),"STATE" => $apf_opportunity->getState(),"ACTIVE" => $apf_opportunity->getActive(),"ADD_IP" => $apf_opportunity->getAddIp(),"CREATED_AT" => $apf_opportunity->getCreatedAt(),"UPDATE_AT" => $apf_opportunity->getUpdateAt(),));

		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"ACTIVEOPTION" => radioTag("active",$ActiveOption,$apf_opportunity->getActive()),
			"STATE_OPTION" => radioTag("state",$StateOption,$apf_opportunity->getState()),
			"MEMO_TEXT" => textareaTag ("memo",$apf_opportunity->getMemo(),false,"ROWS=\"15\" COLS=\"60\" "),
			"DOACTION" => "updatesubmit"
		));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$ActiveOption,$StateOption,$AddIP,$userid,$group_ids;
		$apf_opportunity = DB_DataObject :: factory('ApfOpportunity');

		if ($edit_submit) 
		{
			$apf_opportunity->get($apf_opportunity->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_opportunity->setTitle(stripslashes(trim($_POST['title'])));
		$apf_opportunity->setAddrees(stripslashes(trim($_POST['addrees'])));
		$apf_opportunity->setPhone(stripslashes(trim($_POST['phone'])));
		$apf_opportunity->setFax(stripslashes(trim($_POST['fax'])));
		$apf_opportunity->setEmail(stripslashes(trim($_POST['email'])));
		$apf_opportunity->setHomepage(stripslashes(trim($_POST['homepage'])));
		$apf_opportunity->setLinkMan(stripslashes(trim($_POST['link_man'])));
		$apf_opportunity->setMemo(stripslashes(trim($_POST['memo'])));
		$apf_opportunity->setState(stripslashes(trim($_POST['state'])));
		$apf_opportunity->setActive(stripslashes(trim($_POST['active'])));

		$apf_opportunity->setAddIp($AddIP);
		$apf_opportunity->setGroupid($group_ids);
		$apf_opportunity->setUserid($userid);

				
		$val = $apf_opportunity->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_opportunity->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_opportunity->update();

				$log_string = $i18n->_("Update").$i18n->_("Opportunity")."\t{$_POST['title']}=>{$_POST['ID']}";
				logFileString ($log_string);

				$this->forward("opportunity/apf_opportunity/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_opportunity->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_opportunity->insert();
	
				$log_string = $i18n->_("Create").$i18n->_("Opportunity")."\t{$_POST['title']}";
				logFileString ($log_string);
				
				$this->forward("opportunity/apf_opportunity/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_opportunity_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			array_shift($ActiveOption);
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"ACTIVEOPTION" => radioTag("active",$ActiveOption,$_POST['active']),
				"STATE_OPTION" => radioTag("state",$StateOption,$_POST['state']),
				"MEMO_TEXT" => textareaTag ("memo",$_POST['memo'],false,"ROWS=\"15\" COLS=\"60\" "),
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
				"ID" => $_POST['id'],"TITLE" => $_POST['title'],"ADDREES" => $_POST['addrees'],"PHONE" => $_POST['phone'],"FAX" => $_POST['fax'],"EMAIL" => $_POST['email'],"HOMEPAGE" => $_POST['homepage'],"LINK_MAN" => $_POST['link_man'],"MEMO" => $_POST['memo'],"STATE" => $_POST['state'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_opportunity = DB_DataObject :: factory('ApfOpportunity');
		$apf_opportunity->get($apf_opportunity->escape($controller->getID()));
		$apf_opportunity->setActive('deleted');
		$apf_opportunity->update();
		$this->forward("opportunity/apf_opportunity/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$i18n,$ActiveOption,$StateOption,$userid;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_opportunity_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 10;
		$apf_opportunity = DB_DataObject :: factory('ApfOpportunity');

		$apf_opportunity->orderBy('id desc');
		$apf_opportunity->setUserid($userid);
		$ToltalNum = $apf_opportunity->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_opportunity->limit($start_num,$max_row);

		$apf_opportunity->find();
		
		$myData=array();
		while ($apf_opportunity->fetch())
		{
			$myData[] = $apf_opportunity->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"TITLE" => $data['title'],"ADDREES" => $data['addrees'],"PHONE" => $data['phone'],"FAX" => $data['fax'],"EMAIL" => $data['email'],"HOMEPAGE" => $data['homepage'],"LINK_MAN" => $data['link_man'],"MEMO" => $data['memo'],"STATE" => $StateOption[$data['state']],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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