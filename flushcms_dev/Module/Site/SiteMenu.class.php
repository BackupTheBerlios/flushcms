<?php

/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005-2006 The FlushPHP Group                           |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-8 15:32:49                        
   +----------------------------------------------------------------------+
 */

/* $Id: SiteMenu.class.php,v 1.5 2006/01/24 04:32:21 arzen Exp $ */

include_once ('DAO/SiteMenuDAO.class.php');
include_once(APP_DIR."UI.class.php");
class SiteMenu extends UI
{

	var $_DAO;

	function SiteMenu()
	{
		$this->_DAO = & new SiteMenuDAO();
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty,$__MODULE__,$__TEMPLATES__;
		
		parent::opAdd();
		$sysMenuDao = &new SiteMenuDAO();
		$data_menu = $sysMenuDao->getMenuArr();
		$form->addElement('header', null, $__Lang__['langMenuHeader']);
		$menu_array = array("0"=>$__Lang__['langGeneralNone']);
		$menu_all = $menu_array+$data_menu;
		
		if ($_REQUEST['Action']=='Update') 
		{
			$this->opUpdate();
		}

		$form->addElement('select', 'PID', $__Lang__['langMenuCategory'].$__Lang__['langGeneralName'].' : ',$menu_all);
		$form->addElement('text', 'Title', $__Lang__['langMenu'].$__Lang__['langGeneralName'].' : ');
		$form->addElement('text', 'URL', $__Lang__['langMenu'].$__Lang__['langGeneralURL'].' : ');
		$form->addElement('select', 'SiteModule', $__Lang__['langMenu'].$__Lang__['langSiteModule'].' : ',$__MODULE__);
		$form->addElement('select', 'SiteTemplate', $__Lang__['langMenu'].$__Lang__['langSiteTemplate'].' : ',$__TEMPLATES__);
		$form->addElement('checkbox', 'CopyTemplate', null, $__Lang__['langSiteCopyTemplate']);

		$form->setDefaults(array("CopyTemplate"=>1));

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', $_REQUEST['Action']); 
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->addRule('PID', 'Please enter a username.', 'required');
		$form->addRule('Title', 'Please enter a password.', 'required');

		if ($form->validate()) 
		{
			$record["PID"] = $form->exportValue('PID');
			$record["Title"] = $form->exportValue('Title');
			$record["URL"] = $form->exportValue('URL');
			$record["Module"] = $form->exportValue('SiteModule');
			$record["Template"] = $form->exportValue('SiteTemplate');
			$record = $record + $this->_DAO->baseField();
			$dbAppObj = $FlushPHPObj->loadApp("DBApp");
			if ($_POST['ID'] && $_POST['Action']=='Update') 
			{
				$this->_DAO->opUpdate(SITE_MENU_TABLE,$record," SiteMenuID = ".$_POST['ID']);
				$form->setElementError('Title',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
				$form->freeze();
				if ($form->exportValue('CopyTemplate')==1) 
				{
					$this->_copyTemplate($record["Template"],$_POST['ID']);
				}
				echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
				
			} 
			else 
			{
				if ($dbAppObj->checkExists(SITE_MENU_TABLE," Title='".$record["Title"]."' ")) 
				{
					$form->setElementError('Title',$__Lang__['langSameRecordExist']);
				}
				 else
				{
					$menu_id = $this->_DAO->opAdd(SITE_MENU_TABLE,$record);
					$form->setElementError('Title',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
					$form->freeze();
					if ($form->exportValue('CopyTemplate')==1) 
					{
						$this->_copyTemplate($record["Template"],$menu_id);
					}
					echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
				}
			}
		}
		
		$smarty->assign("Main", $form->toHTML());
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opUpdate () 
	{
		global $__Lang__, $FlushPHPObj,$form, $smarty;
		
		$user_data = $this->_DAO->getRowByID(SITE_MENU_TABLE,"SiteMenuID",$_REQUEST['ID']);
		$form->setDefaults(array("PID"=>$user_data['PID'],
							"Title"=>$user_data['Title'],
							"URL"=>$user_data['URL'],
							"SiteModule"=>$user_data['Module'],
							"SiteTemplate"=>$user_data['Template']
							)
						  );
		$form->addElement('hidden', 'ID', $user_data['SiteMenuID']); 
		
	}
	
	/**
	* Cancel operation
	*
	* @author	John.meng
	* @since    version - Dec 21, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opCancel () 
	{
		global $__Lang__, $MessageObj,$smarty;
		if ($delNum = $this->_DAO->delRowsByID(SITE_MENU_TABLE,"SiteMenuID",$_REQUEST['ID'])) 
		{
				echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}
	}
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-15 14:35:22
	 * @param   string  
	 *
	 */
	function _copyTemplate ($temp_name,$menu_id) 
	{
		
		$source_template = MODULE_DIR."Site/TemplateResource/".$temp_name.".tpl.htm";
		$target_template = HTML_THEMES_DIR."/Menu.".$menu_id.".tpl.htm";
		@copy($source_template,$target_template);
	}
	
	
}
?>