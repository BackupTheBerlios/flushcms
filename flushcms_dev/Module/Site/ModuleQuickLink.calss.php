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
   | Author: John.meng(ÃÏÔ¶òû)  Jan 18, 2006 12:30:39 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id$ */
if (empty ($__Version__))
{
	echo "Big error! ";
	exit;
}

include_once (APP_DIR."UI.class.php");
include_once ("DAO/WizardDAO.class.php");

class ModuleQuickLink extends UI
{
	var $_DAO;

	function ModuleQuickLink()
	{
		$this->_DAO = & new WizardDAO();

	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 18, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$FlushPHPObj,$thisDAO,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langGeneralUpdate']." ".$__Lang__['langBaseInfo']);
		$form->addElement('textarea', 'SiteQuickLink', $__Lang__['langSite'].$__Lang__['langQuickLink'].' : ',array('rows' => 8, 'cols' => 40));
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->setDefaults(array(
								'SiteQuickLink'=>$this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_QUICKLINK'],SITE_LARGE_CONFIG_TABLE)
								)
							);
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step','Step3'); 

		if ($form->validate()) 
		{
			$record["VarName"] = $__SITE_VAR__['SITE_QUICKLINK'];
			$record["VarValue"] = $form->exportValue('SiteQuickLink');
			$record = $record + $this->_DAO->baseField();
			$this->_DAO->autoInsertOrUpdate (SITE_LARGE_CONFIG_TABLE,$record,array('VersionCode','VarName'));

			echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}
		$smarty->assign("Main", $form->toHTML());
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 18, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function toHtml () 
	{
		global $__Lang__,$__SITE_VAR__,$smarty_site;
		
		$smarty_site->assign("__site_quick_link__",$this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_QUICKLINK'],SITE_LARGE_CONFIG_TABLE));
	}
	
	
}
?>

