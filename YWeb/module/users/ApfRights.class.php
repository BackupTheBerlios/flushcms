<?php

/**
 *
 * ApfRights.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfRights.class.php,v 1.1 2006/10/29 09:21:15 arzen Exp $
 */

class ApfRights  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_rights_edit.html"
		));
		$template->setBlock("MAIN", "add_block");
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "addsubmit"
		));

	}
	
	function executeAddsubmit()
	{
		global $luadmin;
	    $data = array('area_id' => 0,
	                  'right_id' => $_POST['right_id'],
	                  'right_define_name' => $_POST['right_define_name'],
	                  'has_implied' => 0);
	    $groupId = $luadmin->perm->addRight($data);
		$this->forward("users/apf_rights/");
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_rights_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_rights = DB_DataObject :: factory('ApfRights');
		$apf_rights->get($apf_rights->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("RIGHT_ID" => $apf_rights->getRightId(),"AREA_ID" => $apf_rights->getAreaId(),"RIGHT_DEFINE_NAME" => $apf_rights->getRightDefineName(),"HAS_IMPLIED" => $apf_rights->getHasImplied(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_rights = DB_DataObject :: factory('ApfRights');

		if ($edit_submit) 
		{
			$apf_rights->get($apf_rights->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_rights->setAreaId(stripslashes(trim($_POST['area_id'])));
		$apf_rights->setRightDefineName(stripslashes(trim($_POST['right_define_name'])));
		$apf_rights->setHasImplied(stripslashes(trim($_POST['has_implied'])));

				
		$val = $apf_rights->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_rights->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_rights->update();
				$this->forward("users/apf_rights/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_rights->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_rights->insert();
				$this->forward("users/apf_rights/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_rights_edit.html"
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
				"RIGHT_ID" => $_POST['right_id'],"AREA_ID" => $_POST['area_id'],"RIGHT_DEFINE_NAME" => $_POST['right_define_name'],"HAS_IMPLIED" => $_POST['has_implied'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$luadmin;
		
	    $right_id = $controller->getID();
	    $filter = array('right_id' => $right_id);
	    $removeRight = $luadmin->perm->removeRight($filter);
      
		$this->forward("users/apf_rights/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$luadmin;

		$rights = $luadmin->perm->getRights();

		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_rights_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		
		$i = 0;
		foreach($rights as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['right_id'],"RIGHT_ID" => $data['right_id'],"AREA_ID" => $data['area_id'],"RIGHT_DEFINE_NAME" => $data['right_define_name'],"HAS_IMPLIED" => $data['has_implied'],));

			$template->parse("list_block", "main_list", TRUE);
			$i++;
		}
		$ToltalNum =$i;
		
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"TOLTAL_NUM" => $ToltalNum,
		));

	}
	
}
?>