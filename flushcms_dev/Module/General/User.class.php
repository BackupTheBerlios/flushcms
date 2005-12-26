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

/* $Id: User.class.php,v 1.13 2005/12/26 09:49:23 arzen Exp $ */

/**
 * User class handle
 * @package	Module
 */

include_once("DAO/UserDAO.class.php");
include_once(APP_DIR."UI.class.php");
class User extends UI
{

	function User()
	{
		$this->toolBars ();
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
		
		parent::opAdd();
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
		global $__Lang__, $MessageObj,$smarty;
		$userDAO = new UserDAO();
		if ($delNum = $userDAO->delRowsByID(USERS_TABLE,"UsersID",$_REQUEST['ID'])) 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"MSG"));
		}
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 23, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opCancelSelected () 
	{
		global $__Lang__, $MessageObj,$smarty;
		
		$userDAO = &new UserDAO();
		if (is_array($_POST['CheckID'])) 
		{
			$check_ids = implode(",",$_POST['CheckID']);
			if ($delNum = $userDAO->delRowsByID(USERS_TABLE,"UsersID",$check_ids)) 
			{
				$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"MSG"));
			}
		}else 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"NOTICE"));
		}
		
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
		global $__Lang__,$UrlParameter,$FlushPHPObj,$table,$page_data,$all_data,$links,$form, $smarty;

		$userDAO = new UserDAO();
		$all_data = $userDAO->getAllUsers();

		parent::viewList();
		$table->setHeaderContents(0, 0,NULL);
		$table->setHeaderContents(0, 1, $__Lang__['langMenuUser'].$__Lang__['langGeneralName']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralAddIP']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralStatus']);
		$table->setHeaderContents(0, 5, $__Lang__['langGeneralOperation']);

		foreach($page_data as $key=>$data )
		{
			$user_id = $data['UsersID'];
			$table->addRow(array("<INPUT TYPE=\"checkbox\" NAME=\"CheckID[]\" value=\"$user_id\">",$data['UserName'],$data['CreateTime'],$data['AddIP'],"",$this->_actionBars($user_id)));
		}
		
		$altRow = array ("class" => "grid_table_tr_alternate");
		$table->altRowAttributes(1, null, $altRow);
		
		$form->addElement('static', 'fieldsAssoc','',$table->toHtml());
		$form->addElement('submit', NULL,$__Lang__['langGeneralCancel'].$__Lang__['langGeneralSelect']);
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', 'CancelSelected'); 
		$html_grib = $form->toHtml();          
		
		$smarty->assign("Main", $html_grib.$links['all']);
		
	}
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2005-12-25 20:48:48
	 * @param   string  
	 *
	 */
	function toolBars () 
	{
		global $__Lang__,$MenuObj,$smarty;
		$toolbar = array(
			'new'=>array(
				'title'=>$__Lang__['langGeneralAdd'].$__Lang__['langMenuUser'],
				'url'=>'?Module=General&Page=User&Action=Add',
				'imgName'=>'new_f2.png',
				'desc'=>$__Lang__['langGeneralAdd'].$__Lang__['langMenuUser']
			),
			'list'=>array(
				'title'=>$__Lang__['langMenuUser'].$__Lang__['langGeneralList'],
				'url'=>'?Module=General&Page=User',
				'imgName'=>'publish_f2.png',
				'desc'=>$__Lang__['langMenuUser'].$__Lang__['langGeneralList']
			),
			'config'=>array(
				'title'=>'Users List',
				'url'=>'?Module=General&Page=User',
				'imgName'=>'publish_f2.png',
				'desc'=>'Open an existing document.'
			),
		);
		$smarty->assign("_toolbars",$MenuObj->_toolbars($toolbar));
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 26, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function &_actionBars ($id) 
	{
		global $__Lang__,$MenuObj;
		
		$action_data = array(
			'update'=>array(
				'title'=>$__Lang__['langGeneralUpdate'],
				'url'=>'?Module=General&Page=User&Action=Update&ID='.$id,
				'imgName'=>'edit.gif'
			),
			'del'=>array(
				'title'=>$__Lang__['langGeneralCancel'],
				'url'=>'?Module=General&Page=User&Action=Cancel&ID='.$id,
				'js'=>" onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\" ",
				'imgName'=>'delete.gif'
			)
		);
		return $MenuObj->_actionBars(&$action_data);
	}
	
	
	
}
?>