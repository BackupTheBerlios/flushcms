<?php

/**
 *
 * ApfGroups.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfGroups.class.php,v 1.2 2006/12/11 14:47:37 arzen Exp $
 */

class ApfGroups  extends Actions
{
	function executeCreate()
	{
		global $template,$WebBaseDir;

		$template->setFile(array (
			"MAIN" => "apf_groups_edit.html"
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
	    $data = array('group_id' => $_POST['group_id'],
	                  'group_define_name' => $_POST['group_define_name'],
	                  'is_active' => $_POST['is_active']);
	    $groupId = $luadmin->perm->addGroup($data);
		$this->forward("users/apf_groups/");
//		$this->handleFormData();
	}
	
	function executeUpdate()
	{
		global $template,$WebBaseDir,$controller,$i18n;
		$template->setFile(array (
			"MAIN" => "apf_groups_edit.html"
		));
		$template->setBlock("MAIN", "edit_block");
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"DOACTION" => "updatesubmit"
		));

		$apf_groups = DB_DataObject :: factory('ApfGroups');
		$apf_groups->get($apf_groups->escape($controller->getID()));

		if ($controller->getURLParam(1)=="ok") 
		{
			$template->setVar(array (
				"SUCCESS_CLASS" => "save-ok",
				"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
			));
		}

		$template->setVar(array ("GROUP_ID" => $apf_groups->getGroupId(),"GROUP_TYPE" => $apf_groups->getGroupType(),"GROUP_DEFINE_NAME" => $apf_groups->getGroupDefineName(),"IS_ACTIVE" => $apf_groups->getIsActive(),"OWNER_USER_ID" => $apf_groups->getOwnerUserId(),"OWNER_GROUP_ID" => $apf_groups->getOwnerGroupId(),));
		
	}
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n;
		$apf_groups = DB_DataObject :: factory('ApfGroups');

		if ($edit_submit) 
		{
			$apf_groups->get($apf_groups->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_groups->setGroupType(stripslashes(trim($_POST['group_type'])));
		$apf_groups->setGroupDefineName(stripslashes(trim($_POST['group_define_name'])));
		$apf_groups->setIsActive(stripslashes(trim($_POST['is_active'])));
		$apf_groups->setOwnerUserId(stripslashes(trim($_POST['owner_user_id'])));
		$apf_groups->setOwnerGroupId(stripslashes(trim($_POST['owner_group_id'])));
				
		$val = $apf_groups->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_groups->update();
				$this->forward("users/apf_groups/update/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_groups->insert();
				$this->forward("users/apf_groups/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_groups_edit.html"
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
				"GROUP_ID" => $_POST['group_id'],"GROUP_TYPE" => $_POST['group_type'],"GROUP_DEFINE_NAME" => $_POST['group_define_name'],"IS_ACTIVE" => $_POST['is_active'],"OWNER_USER_ID" => $_POST['owner_user_id'],"OWNER_GROUP_ID" => $_POST['owner_group_id'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller,$luadmin;
		
	    $group_id = $controller->getID();
	    $filter = array('group_id' => $group_id);
	    $removed = $luadmin->perm->removeGroup($filter);

		$this->forward("users/apf_groups/");
	}
	
	function executeList()
	{
		global $template,$WebBaseDir,$WebTemplateDir,$ClassDir,$luadmin;
		
		$groups = $luadmin->perm->getGroups();
//		Var_Dump::display($groups);
		
		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_groups_list.html"
		));

		$template->setBlock("MAIN", "main_list", "list_block");

		$i = 0;
		foreach($groups as $data)
		{
			(($i % 2) == 0) ? $list_td_class = "admin_row_0" : $list_td_class = "admin_row_1";
			
			$template->setVar(array (
				"LIST_TD_CLASS" => $list_td_class
			));
			
			$template->setVar(array ("ID" => $data['group_id'],"GROUP_ID" => $data['group_id'],"GROUP_TYPE" => $data['group_type'],"GROUP_DEFINE_NAME" => $data['group_define_name'],"IS_ACTIVE" => $data['is_active'],"OWNER_USER_ID" => $data['owner_user_id'],"OWNER_GROUP_ID" => $data['owner_group_id'],));

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