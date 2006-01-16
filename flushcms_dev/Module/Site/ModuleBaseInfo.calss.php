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
   | Author: John.meng(ÃÏÔ¶òû)  Jan 16, 2006 12:29:55 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id$ */

include_once (APP_DIR."UI.class.php");
include_once ("DAO/WizardDAO.class.php");

class ModuleBaseInfo extends UI
{
	var $_DAO;

	function ModuleBaseInfo()
	{
		$this->_DAO = & new WizardDAO();
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 16, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opUpdate () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$FlushPHPObj,$thisDAO,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langGeneralUpdate']." ".$__Lang__['langBaseInfo']);

		$form->addElement('text', 'SiteName', $__Lang__['langSite'].$__Lang__['langGeneralName'].' : ',array('size'=>40));
		$form->addElement('text', 'SiteKeyword', $__Lang__['langSite'].$__Lang__['langKeyword'].' : ',array('size'=>40));
		$form->addElement('textarea', 'SiteCopyright', $__Lang__['langSite'].$__Lang__['langSiteCopyRight'].' : ',array('rows' => 8, 'cols' => 40));
		
		$site_logo_group[] = &HTML_QuickForm::createElement('file', 'Pic', $__Lang__['langSite'].$__Lang__['langSiteLogo'].' : ');
		if ($site_logo = $this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_LOGO'])) 
		{
			$swf_image_obj = $FlushPHPObj->loadUtility("ViewImgSwf");
			$site_logo_group[] = &HTML_QuickForm::createElement('static', '_SiteLogo',NULL,$swf_image_obj->displayIt($site_logo,NULL,NULL,NULL,HTML_IMAGES_DIR));
			$site_logo_group[] = &HTML_QuickForm::createElement('checkbox', 'del_site_logo',NULL,$__Lang__['langGeneralCancel'].$__Lang__['langSiteLogo']);
			$site_logo_group[] = &HTML_QuickForm::createElement('hidden', 'old_site_logo', $site_logo);
		}					
		$form->addGroup($site_logo_group, NULL,$__Lang__['langSite'].$__Lang__['langSiteLogo'].' : ',"    ");

		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->setDefaults(array(
								'SiteName'=>$this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_NAME']),
								'SiteKeyword'=>$this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_KEYWORD']),
								'SiteCopyright'=>$this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_COPYRIGHT'])
								)
							);
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step','Step3'); 

		$form->addRule('SiteName', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langSite'].$__Lang__['langGeneralName'], 'required');
		$form->addRule('SiteKeyword', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langSite'].$__Lang__['langKeyword'], 'required');
		
		if ($form->validate()) 
		{
			$record["VarName"] = $__SITE_VAR__['SITE_NAME'];
			$record["VarValue"] = $form->exportValue('SiteName');
			
			$record = $record + $this->_DAO->baseField();

			$this->_DAO->autoInsertOrUpdate (SITE_CONFIG_TABLE,$record,array('VersionCode','VarName'));
			
			$record["VarName"] = $__SITE_VAR__['SITE_KEYWORD'];
			$record["VarValue"] = $form->exportValue('SiteKeyword');
			$this->_DAO->autoInsertOrUpdate (SITE_CONFIG_TABLE,$record,array('VersionCode','VarName'));

			$record["VarName"] = $__SITE_VAR__['SITE_COPYRIGHT'];
			$record["VarValue"] = $form->exportValue('SiteCopyright');
			$this->_DAO->autoInsertOrUpdate (SITE_CONFIG_TABLE,$record,array('VersionCode','VarName'));
			
			if ($_FILES['Pic']['name'] != "") 
			{
				$file_upload_obj = $FlushPHPObj->loadApp("FileUploadHandle");
				$StrPic = $file_upload_obj->uploadMedia(HTML_IMAGES_DIR);
				
				$record["VarName"] = $__SITE_VAR__['SITE_LOGO'];
				$record["VarValue"] = $StrPic;
				$this->_DAO->autoInsertOrUpdate (SITE_CONFIG_TABLE,$record,array('VersionCode','VarName'));
			}
			if ($_POST['del_site_logo']==1 && $old_site_logo=$_POST['old_site_logo']) 
			{
				unlink(HTML_IMAGES_DIR.$old_site_logo);
				$record["VarName"] = $__SITE_VAR__['SITE_LOGO'];
				$record["VarValue"] = '';
				$this->_DAO->autoInsertOrUpdate (SITE_CONFIG_TABLE,$record,array('VersionCode','VarName'));
				
			}
			echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}

		$smarty->assign("Main", $form->toHTML());
		
	}
	
}
?>

