<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005 The FlushPHP Group                                |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  Dec 20, 2005 10:57:44 AM                        
   +----------------------------------------------------------------------+
 */

/* $Id: SystemMenu.class.php,v 1.7 2005/12/22 15:04:06 arzen Exp $ */

/**
 * Menu class handle
 * @package	Module
 */

include_once ('DAO/SystemMenuDAO.class.php');
include_once(APP_DIR."UI.class.php");

class SystemMenu extends UI
{

	function SystemMenu()
	{
		$this->subNavigator();
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
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		
		parent::opAdd();
		$sysMenuDao = &new SystemMenuDAO();
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
			$record["AddIP"] = $AddIPObj->getTrueIP();
			$record["CreateTime"] = time();
			$dbAppObj = $FlushPHPObj->loadApp("DBApp");
			if ($_POST['ID'] && $_POST['Action']=='Update') 
			{
				$thisDAO = &new SystemMenuDAO();
				$thisDAO->opUpdate(SYSMENU_TABLE,$record," SysmenuID = ".$_POST['ID']);
				$form->setElementError('Title',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
				$form->freeze();
				
			} 
			else 
			{
				if ($dbAppObj->checkExists(SYSMENU_TABLE," Title='".$record["Title"]."' ")) 
				{
					$form->setElementError('Title',$__Lang__['langUserNameExist']);
				}
				 else
				{
					$thisDAO = &new SystemMenuDAO();
					$thisDAO->opAdd(SYSMENU_TABLE,$record);
					$form->setElementError('Title',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
					$form->freeze();
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
		
		$sysMenuDao = &new SystemMenuDAO();
		$user_data = $sysMenuDao->getRowByID(SYSMENU_TABLE,"SysmenuID",$_REQUEST['ID']);
		$form->setDefaults(array("PID"=>$user_data['PID'],
							"Title"=>$user_data['Title'],
							"URL"=>$user_data['URL']));
		$form->addElement('hidden', 'ID', $user_data['SysmenuID']); 
		
	}
	
	/**
	* View list
	*
	* @author	John.meng
	* @since    version 1.0- Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__, $FlushPHPObj, $smarty;
		
		include_once (PEAR_DIR."HTML/Table.php");

		$sysMenuDao = new SystemMenuDAO();
		$data_menu = $sysMenuDao->getMenuArr();

		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);
		$table->setAutoGrow(true);
		$table->setAutoFill("n/a");
		$cell_x=0;
		
		foreach ($data_menu as $key=>$value)
		{
			$table->addRow(array($value, " <table><tr><td><a href='?Module=General&Page=SystemMenu&Action=Update&ID=".$key."'><img src='".THEMES_DIR."images/edit.gif' border='0'><br />".$__Lang__['langGeneralUpdate']."</a></td><td><a href='?Module=General&Page=SystemMenu&Action=Update&ID=".$key."' onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\"><img src='".THEMES_DIR."images/delete.gif' border='0'><br />".$__Lang__['langGeneralCancel']."</a></td></tr></table>"));
			$cell_x++;
		}
		
		$altRow = array ("class" => "grid_table_tr_alternate");
		$table->altRowAttributes(1, null, $altRow);
		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);
//		$table->setColAttributes(0, $hrAttrs);

		$table->setHeaderContents(0, 0, $__Lang__['langMenu']);
		$table->setHeaderContents(0, 1, $__Lang__['langGeneralOperation']);
		
		$smarty->assign("Main", $table->toHtml());
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 20, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function subNavigator () 
	{
		global $__Lang__,$smarty;
		
		$str_html = "<td align='center' ><a href='?Module=General&Page=SystemMenu&Action=Add'><img src='".THEMES_DIR."images/new_f2.png' border='0' ><br />".$__Lang__['langGeneralAdd']."</a></td>";
		$str_html .= "<td><a href='?Module=General&Page=SystemMenu' ><img src='".THEMES_DIR."images/publish_f2.png' border='0' ><br />".$__Lang__['langGeneralList']."</a></td>";
		
		$smarty->assign("subNavigator", $str_html);
	}
	
	
}
?>