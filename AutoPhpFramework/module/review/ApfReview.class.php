<?php

/**
 *
 * ApfReview.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfReview.class.php,v 1.1 2006/12/09 04:17:35 arzen Exp $
 */

class ApfReview  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_review_edit.html"
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
			"MAIN" => "apf_review_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_review = DB_DataObject :: factory('ApfReview');
		$apf_review->get($apf_review->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_review->getId(),"COMPANY" => $apf_review->getCompany(),"LINKMAN" => $apf_review->getLinkman(),"REVIEWDATE" => $apf_review->getReviewdate(),"CONTENT" => $apf_review->getContent(),"GROUPID" => $apf_review->getGroupid(),"USERID" => $apf_review->getUserid(),"ACCESS" => $apf_review->getAccess(),"ACTIVE" => $apf_review->getActive(),"ADD_IP" => $apf_review->getAddIp(),"CREATED_AT" => $apf_review->getCreatedAt(),"UPDATE_AT" => $apf_review->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_review = DB_DataObject :: factory('ApfReview');

		if ($edit_submit) 
		{
			$apf_review->get($apf_review->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_review->setCompany(stripslashes(trim($_POST['company'])));
		$apf_review->setLinkman(stripslashes(trim($_POST['linkman'])));
		$apf_review->setReviewdate(stripslashes(trim($_POST['reviewdate'])));
		$apf_review->setContent(stripslashes(trim($_POST['CONTENT'])));
		$apf_review->setGroupid(stripslashes(trim($_POST['groupid'])));
		$apf_review->setUserid(stripslashes(trim($_POST['userid'])));
		$apf_review->setAccess(stripslashes(trim($_POST['access'])));
		$apf_review->setActive(stripslashes(trim($_POST['active'])));
		$apf_review->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_review->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_review->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_review->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_review->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_review->update();

				$log_string = $i18n->_("Update").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['ID']}";
				logFileString ($log_string);
				
				$this->forward("review/apf_review/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_review->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_review->insert();

				$log_string = $i18n->_("Create").$i18n->_("ModuleName")."	{$_POST['name']}=>{$_POST['create_date']}";
				logFileString ($log_string);

				$this->forward("review/apf_review/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_review_edit.html"
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
				"ID" => $_POST['id'],"COMPANY" => $_POST['company'],"LINKMAN" => $_POST['linkman'],"REVIEWDATE" => $_POST['reviewdate'],"CONTENT" => $_POST['CONTENT'],"GROUPID" => $_POST['groupid'],"USERID" => $_POST['userid'],"ACCESS" => $_POST['access'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$i18n;
		$apf_review = DB_DataObject :: factory('ApfReview');
		$apf_review->get($apf_review->escape($controller->getID()));
		$apf_review->setActive('deleted');
		$apf_review->update();

		$log_string = $i18n->_("Delete").$i18n->_("File")."	{$filename}";
		logFileString ($log_string);

		$this->forward("review/apf_review/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$i18n,$WebTemplateDir,$ClassDir,$userid,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_review_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$apf_review = DB_DataObject :: factory('ApfReview');
		$apf_review->orderBy('id desc');

		$max_row = 10;
		$ToltalNum = $apf_review->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_review->limit($start_num,$max_row);
		$apf_review->whereAdd(" userid = '$userid' OR access = 'public' ");

		$apf_review->find();
		
		$myData=array();
		while ($apf_review->fetch())
		{
			$myData[] = $apf_review->toArray();
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
			
			$template->setVar(array ("ID" => $data['id'],"COMPANY" => $data['company'],"LINKMAN" => $data['linkman'],"REVIEWDATE" => $data['reviewdate'],"CONTENT" => $data['CONTENT'],"GROUPID" => $data['groupid'],"USERID" => $data['userid'],"ACCESS" => $data['access'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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