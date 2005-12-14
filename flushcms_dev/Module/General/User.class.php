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
   | Author: John.meng(цот╤РШ)  Dec 13, 2005 4:35:41 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: User.class.php,v 1.4 2005/12/14 15:16:16 arzen Exp $ */

class User
{

	function User()
	{
	}
	/**
	 * Add user
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version 1.0 - 2005-12-14 22:27:14
	 * @param   string  
	 *
	 */
	function opAddUser () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj, $smarty;
		
		$head_tabs = $this->headTabs();
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm');
		$form->addElement('header', null, $__Lang__['langUserAddHeader']);
		$form->addElement('text', 'user_name', $__Lang__['langMenuUser'].$__Lang__['langGeneralName'].' : ');
		$form->addElement('password', 'user_passwd', $__Lang__['langMenuUser'].$__Lang__['langGeneralPassword'].' : ');
		$form->addElement('password', 'user_passwd2', $__Lang__['langGeneralConfirm'].$__Lang__['langGeneralPassword'].' : ');

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', $_REQUEST['Action']); 
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->addRule('user_name', 'Please enter a username.', 'required');
		$form->addRule('user_passwd', 'Please enter a password.', 'required');
		$form->addRule('user_passwd2', 'Please enter a confirm password.', 'required');
		$form->addRule(array('user_passwd2', 'user_passwd'), 'The passwords do not match', 'compare');
		
		if ($form->validate()) 
		{
			$record["UserName"] = $form->exportValue('user_name');
			$record["Passwd"] = md5($form->exportValue('user_passwd'));
			$record["AddIP"] = $AddIPObj->getTrueIP();
			$SiteDB->AutoExecute(USERS_TABLE,$record,'INSERT');
			
			$form->freeze();
		}
		
		$smarty->assign("Main", $head_tabs.$form->toHTML());
	}
	
	/**
	* View list
	*
	* @author	John.meng
	* @since    version 1.0 - Dec 13, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj, $smarty;
		include_once (PEAR_DIR."HTML/Table.php");
		
		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);
		$table->setAutoGrow(true);
		$table->setAutoFill("n/a");
		$table->setHeaderContents(0, 0, "");
		$table->setHeaderContents(0, 1, $__Lang__['langMenuUser'].$__Lang__['langGeneralName']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralAddIP']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralStatus']);
		$table->setHeaderContents(0, 5, $__Lang__['langGeneralOperation']);

		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);
		$table->setColAttributes(0, $hrAttrs);
		$html_grib = $table->toHtml();
		
		$head_tabs = $this->headTabs();
		$smarty->assign("Main", $head_tabs.$html_grib);
		
	}
	/**
	 * Display head tabs
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version 1.0 - 2005-12-14 21:00:50
	 * @param   string  
	 *
	 */
	function headTabs () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj, $smarty;
		include_once (APP_DIR."UI.class.php");
		
	    $tabs = array(
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralList'], $UrlParameter."&Action=UserList"),
	                  array($__Lang__['langGeneralAdd'].$__Lang__['langMenuUser'], $UrlParameter."&Action=AddUser"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langGeneralList'], $UrlParameter."&Action=GroupList"),
	                  array($__Lang__['langGeneralAdd'].$__Lang__['langUserGroup'], $UrlParameter."&Action=AddGroup"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langMenuUser'], $UrlParameter."&Action=GroupUser"),  
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralConfigure'], $UrlParameter."&Action=Configure")
	                  ); 
	    switch ($_REQUEST['Action']) 
		{
			case 'UserList':
					$select_tab = 0;
				break;
				
			case 'AddUser':
					$select_tab = 1;
				break;
				
			case 'GroupList':
					$select_tab = 2;
				break;
				
			case 'AddGroup':
					$select_tab = 3;
				break;

			case 'GroupUser':
					$select_tab = 4;
				break;

			case 'Configure':
					$select_tab = 5;
				break;
		
			default:
					$select_tab = 0;
				break;
		}
		       
	    $tab = new Tabset($tabs, $select_tab);
		return $tab->toHtml();
	}
	
	
}
?>