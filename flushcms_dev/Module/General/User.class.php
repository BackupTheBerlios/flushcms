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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 13, 2005 4:35:41 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: User.class.php,v 1.8 2005/12/21 14:48:23 arzen Exp $ */

/**
 * User class handle
 * @package	Module
 */

include_once("DAO/UserDAO.class.php");
class User
{

	function User()
	{
		$this->subNavigator();
	}
	/**
	 * Add user
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version 1.0 - 2005-12-14 22:27:14
	 * @param   string  
	 *
	 */
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm');
		
		if ($_REQUEST['Action']=='Update') 
		{
			$this->opUpdate();
		}
		
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
			$record["CreateTime"] = time();
			$dbAppObj = $FlushPHPObj->loadApp("DBApp");
			if ($_POST['ID'] && $_POST['Action']=='Update') 
			{
				$thisDAO = &new UserDAO();
				$thisDAO->opUpdate(USERS_TABLE,$record," UsersID = ".$_POST['ID']);
				$form->setElementError('user_name',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
				$form->freeze();
				
			} 
			else 
			{
				if ($dbAppObj->checkExists(USERS_TABLE," UserName='".$record["UserName"]."' ")) 
				{
					$form->setElementError('user_name',$__Lang__['langUserNameExist']);
				}
				 else
				{
					$userDAO = new UserDAO();
					$userDAO->addUser($record);
					$form->setElementError('user_name',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
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
		
		$thisDao = &new UserDAO();
		$this_data = $thisDao->getRowByID(USERS_TABLE,"UsersID",$_REQUEST['ID']);
		$form->setDefaults(array(
							"user_name"=>$this_data['UserName']
							)
						   );
		$form->addElement('hidden', 'ID', $this_data['UsersID']); 
		
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
		require_once PEAR_DIR.'Pager/Pager.php';
		
		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);
		$table->setAutoGrow(true);
		$table->setAutoFill("n/a");
		$table->setHeaderContents(0, 0, $__Lang__['langMenuUser'].$__Lang__['langGeneralName']);
		$table->setHeaderContents(0, 1, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralAddIP']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralStatus']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralOperation']);

		$userDAO = new UserDAO();
		$all_user_arr = $userDAO->getAllUsers();
		
		$params = array(
		    'itemData' => $all_user_arr,
		    'perPage' => 10,
		    'delta' => 8,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    //'separator' => ' | ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		
		);
		$pager = & Pager::factory($params);
		$page_data = $pager->getPageData();
		$links = $pager->getLinks();
		$selectBox = $pager->getPerPageSelectBox();
		foreach($page_data as $key=>$data )
		{
			$user_id = $data['UsersID'];
			$table->addRow(array($data['UserName'],$data['CreateTime'],$data['AddIP'],""," <table><tr><td><a href='?Module=General&Page=User&Action=Update&ID=".$user_id."'><img src='".THEMES_DIR."images/edit.gif' border='0'><br />".$__Lang__['langGeneralUpdate']."</a></td><td><a href='?Module=General&Page=User&Action=Update&ID=".$user_id."' onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\"><img src='".THEMES_DIR."images/delete.gif' border='0'><br />".$__Lang__['langGeneralCancel']."</a></td></tr></table>"));
		}
		
		$altRow = array ("class" => "grid_table_tr_alternate");
		$table->altRowAttributes(1, null, $altRow);
		
		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);
		$html_grib = $table->toHtml();
		
		$smarty->assign("Main", $html_grib.$links['all']);
		
	}
	/**
	* sub navigator html code
	*
	* @author	John.meng
	* @since    version 1.0- Dec 20, 2005
	* @return   html code
	*/
	function subNavigator () 
	{
		global $__Lang__,$smarty;
		
		$str_html = "<td align='center' ><a href='?Module=General&Page=User&Action=Add'><img src='".THEMES_DIR."images/new_f2.png' border='0' ><br />".$__Lang__['langGeneralAdd']."</a></td>";
		$str_html .= "<td><a href='?Module=General&Page=User' ><img src='".THEMES_DIR."images/publish_f2.png' border='0' ><br />".$__Lang__['langGeneralList']."</a></td>";
		
		$smarty->assign("subNavigator", $str_html);
	}
	
	
}
?>