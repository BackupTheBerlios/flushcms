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
   | Author: John.meng(ÃÏÔ¶òû)  Dec 26, 2005 6:04:12 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: Group.class.php,v 1.6 2005/12/28 05:45:55 arzen Exp $ */

/**
 * Group class handle
 * @package	Module
 */

include_once("DAO/GroupDAO.class.php");
include_once("DAO/UserDAO.class.php");
include_once(APP_DIR."UI.class.php");
class Group  extends UI
{

	function Group()
	{
		$this->toolBars ();
	}
	/**
	 * Add Group
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
		
		$form->addElement('header', null, $__Lang__['langGroupAddHeader']);
		$form->addElement('text', 'GroupName', $__Lang__['langUserGroup'].$__Lang__['langGeneralName'].' : ');
		$form->addElement('text', 'Descrition', $__Lang__['langUserGroup'].$__Lang__['langGeneralDescrition'].' : ');

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', $_REQUEST['Action']); 
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->addRule('GroupName', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langUserGroup'].$__Lang__['langGeneralName'], 'required');
		
		if ($form->validate()) 
		{
			$record["GroupName"] = $form->exportValue('GroupName');
			$record["Descrition"] = $form->exportValue('Descrition');
			$record["AddIP"] = $AddIPObj->getTrueIP();
			$record["CreateTime"] = time();
			$dbAppObj = $FlushPHPObj->loadApp("DBApp");
			if ($_POST['ID'] && $_POST['Action']=='Update') 
			{
				$thisDAO = &new GroupDAO();
				$thisDAO->opUpdate(GROUPS_TABLE,$record," GroupsID = ".$_POST['ID']);
				$form->setElementError('GroupName',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
				$form->freeze();
				
			} 
			else 
			{
				if ($dbAppObj->checkExists(GROUPS_TABLE," GroupName='".$record["GroupName"]."' ")) 
				{
					$form->setElementError('GroupName',$__Lang__['langUserNameExist']);
				}
				 else
				{
					$thisDAO = new GroupDAO();
					$thisDAO->opAdd(GROUPS_TABLE,$record);
					$form->setElementError('GroupName',$__Lang__['langGeneralOperation'].$__Lang__['langGeneralSuccess']);
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
		
		$thisDao = &new GroupDAO();
		$this_data = $thisDao->getRowByID(GROUPS_TABLE,"GroupsID",$_REQUEST['ID']);
		$form->setDefaults(array(
							"GroupName"=>$this_data['GroupName'],
							"Descrition"=>$this_data['Descrition']
							)
						   );
		$form->addElement('hidden', 'ID', $this_data['GroupsID']); 
		
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
		$GroupDAO = new GroupDAO();
		if ($delNum = $GroupDAO->delRowsByID(GROUPS_TABLE,"GroupsID",$_REQUEST['ID'])) 
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
		
		$GroupDAO = &new GroupDAO();
		if (is_array($_POST['CheckID'])) 
		{
			$check_ids = implode(",",$_POST['CheckID']);
			if ($delNum = $GroupDAO->delRowsByID(GROUPS_TABLE,"GroupsID",$check_ids)) 
			{
				$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"MSG"));
			}
		}else 
		{
			$smarty->assign("Main",$MessageObj->displayMsg($__Lang__['langGeneralCancel']." <font color='red' > <b> $delNum </b> </font> ".$__Lang__['langGeneralRecord'],"NOTICE"));
		}
		
	}
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2005-12-26 21:02:50
	 * @param   string  
	 *
	 */
	function opGroupUser () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;

		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langUserGroup'].$__Lang__['langMenuUser'].$__Lang__['langGeneralList']);
		
		$thisDAO = new GroupDAO();
		$all_group = $thisDAO->getAllGroup();
		
		$userDAO = new UserDAO();
		$from_arr =  $userDAO->getNotGroupUsers();
        $tmp = &$form->addElement('multiChooser', 'users', 'Select '.$__Lang__['langUserGroup'].$__Lang__['langMenuUser'], array("All Users", "Group Users"), $from_arr, array('bbsss'=>'test','bbs22'=>'test23'));
        $tmp->addOptionPicker("From Group",array('?test'=>'test','?test2'=>'test2') ); //$all_group
        
 		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', $_REQUEST['Action']);
		 
        $form->addElement('submit', 'btnSubmit', $__Lang__['langGeneralSubmit']);
        
        $_ScriptCode = <<<EOT
        
<SCRIPT LANGUAGE="JavaScript">
var subcat = new Array();
</SCRIPT>
        
EOT;
         		
		$smarty->assign("Main", $_ScriptCode.$form->toHTML());
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

		$allDAO = new GroupDAO();
		$all_data = $allDAO->getRows(GROUPS_TABLE);

		parent::viewList();
		$table->setHeaderContents(0, 0,NULL);
		$table->setHeaderContents(0, 1, $__Lang__['langUserGroup'].$__Lang__['langGeneralName']);
		$table->setHeaderContents(0, 2, $__Lang__['langUserGroup'].$__Lang__['langGeneralDescrition']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralAddIP']);
		$table->setHeaderContents(0, 5, $__Lang__['langGeneralOperation']);
		if (is_array($page_data)) 
		{
			foreach($page_data as $key=>$data )
			{
				$user_id = $data['GroupsID'];
				$table->addRow(array("<INPUT TYPE=\"checkbox\" NAME=\"CheckID[]\" value=\"$user_id\">",$data['GroupName'],$data['Descrition'],$data['CreateTime'],$data['AddIP'],$this->_actionBars($user_id)));
			}
			
			$altRow = array ("class" => "grid_table_tr_alternate");
			$table->altRowAttributes(1, null, $altRow);
			
			$form->addElement('static', 'fieldsAssoc','',$table->toHtml());
			$form->addElement('submit', NULL,$__Lang__['langGeneralCancel'].$__Lang__['langGeneralSelect']);
			$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
			$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
			$form->addElement('hidden', 'Action', 'CancelSelected'); 
		
		}
		
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
				'title'=>$__Lang__['langGeneralAdd'].$__Lang__['langUserGroup'],
				'url'=>'?Module=General&Page=Group&Action=Add',
				'imgName'=>'new_f2.png',
				'desc'=>$__Lang__['langGeneralAdd'].$__Lang__['langUserGroup']
			),
			
			'list'=>array(
				'title'=>$__Lang__['langUserGroup'].$__Lang__['langGeneralList'],
				'url'=>'?Module=General&Page=Group',
				'imgName'=>'publish_f2.png',
				'desc'=>$__Lang__['langUserGroup'].$__Lang__['langGeneralList']
			),

			'group_user'=>array(
				'title'=>$__Lang__['langUserGroup'].$__Lang__['langMenuUser'],
				'url'=>'?Module=General&Page=Group&Action=GroupUser',
				'imgName'=>'user.png',
				'desc'=>$__Lang__['langUserGroup'].$__Lang__['langMenuUser']
			)
			
		);
		$smarty->assign("_toolbars",$MenuObj->_toolbars(&$toolbar));
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
				'url'=>'?Module=General&Page=Group&Action=Update&ID='.$id,
				'imgName'=>'edit.gif'
			),
			'del'=>array(
				'title'=>$__Lang__['langGeneralCancel'],
				'url'=>'?Module=General&Page=Group&Action=Cancel&ID='.$id,
				'js'=>" onclick=\"return confirm ( '".$__Lang__['langGeneralCancelConfirm']."');\" ",
				'imgName'=>'delete.gif'
			)
		);
		return $MenuObj->_actionBars(&$action_data);
	}
	
}
?>