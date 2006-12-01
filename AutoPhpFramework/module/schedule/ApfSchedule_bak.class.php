<?php

/**
 *
 * ApfSchedule.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfSchedule_bak.class.php,v 1.2 2006/12/01 15:13:36 arzen Exp $
 */

class ApfSchedule  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_schedule_edit.html"
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
			"MAIN" => "apf_schedule_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_schedule = DB_DataObject :: factory('ApfSchedule');
		$apf_schedule->get($apf_schedule->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("ID" => $apf_schedule->getId(),"TITLE" => $apf_schedule->getTitle(),"DESCRIPTION" => $apf_schedule->getDescription(),"PUBLISH_DATE" => $apf_schedule->getPublishDate(),"PUBLISH_STARTTIME" => $apf_schedule->getPublishStarttime(),"PUBLISH_ENDTIME" => $apf_schedule->getPublishEndtime(),"IMAGE" => $apf_schedule->getImage(),"ACTIVE" => $apf_schedule->getActive(),"ADD_IP" => $apf_schedule->getAddIp(),"CREATED_AT" => $apf_schedule->getCreatedAt(),"UPDATE_AT" => $apf_schedule->getUpdateAt(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');

		if ($edit_submit) 
		{
			$apf_schedule->get($apf_schedule->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_schedule->setTitle(stripslashes(trim($_POST['title'])));
		$apf_schedule->setDescription(stripslashes(trim($_POST['description'])));
		$apf_schedule->setPublishDate(stripslashes(trim($_POST['publish_date'])));
		$apf_schedule->setPublishStarttime(stripslashes(trim($_POST['publish_starttime'])));
		$apf_schedule->setPublishEndtime(stripslashes(trim($_POST['publish_endtime'])));
		$apf_schedule->setImage(stripslashes(trim($_POST['image'])));
		$apf_schedule->setActive(stripslashes(trim($_POST['active'])));
		$apf_schedule->setAddIp(stripslashes(trim($_POST['add_ip'])));
		$apf_schedule->setCreatedAt(stripslashes(trim($_POST['created_at'])));
		$apf_schedule->setUpdateAt(stripslashes(trim($_POST['update_at'])));

				
		$val = $apf_schedule->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_schedule->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_schedule->update();
				$this->forward("schedule/apf_schedule/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_schedule->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_schedule->insert();
				$this->forward("schedule/apf_schedule/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_schedule_edit.html"
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
				"ID" => $_POST['id'],"TITLE" => $_POST['title'],"DESCRIPTION" => $_POST['description'],"PUBLISH_DATE" => $_POST['publish_date'],"PUBLISH_STARTTIME" => $_POST['publish_starttime'],"PUBLISH_ENDTIME" => $_POST['publish_endtime'],"IMAGE" => $_POST['image'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');
		$apf_schedule->get($apf_schedule->escape($controller->getID()));
		$apf_schedule->setActive('deleted');
		$apf_schedule->update();
		$this->forward("schedule/apf_schedule/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		require_once 'Pager/Pager.php';
		$template->setFile(array (
			"MAIN" => "apf_schedule_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$max_row = 10;
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');

		$apf_schedule->orderBy('id desc');
		$ToltalNum = $apf_schedule->count();
		$start_num = !isset($_GET['entrant'])?0:($_GET['entrant']-1)*$max_row;
		$apf_schedule->limit($start_num,$max_row);

		$apf_schedule->find();
		
		$i=0;
		$myData=array();
		while ($apf_schedule->fetch())
		{
			$myData[] = $apf_schedule->toArray();
			$i++;
		}		$params = array(
		    'totalItems' => $ToltalNum,
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
			
			$template->setVar(array ("ID" => $data['id'],"TITLE" => $data['title'],"DESCRIPTION" => $data['description'],"PUBLISH_DATE" => $data['publish_date'],"PUBLISH_STARTTIME" => $data['publish_starttime'],"PUBLISH_ENDTIME" => $data['publish_endtime'],"IMAGE" => $data['image'],"ACTIVE" => $ActiveOption[$data['active']],"ADD_IP" => $data['add_ip'],"CREATED_AT" => $data['created_at'],"UPDATE_AT" => $data['update_at'],));

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