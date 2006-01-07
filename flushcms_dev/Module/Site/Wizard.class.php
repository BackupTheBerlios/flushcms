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
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-5 22:37:21                        
   +----------------------------------------------------------------------+
 */

/* $Id: Wizard.class.php,v 1.4 2006/01/07 05:02:37 arzen Exp $ */

include_once(APP_DIR."UI.class.php");
include_once("DAO/WizardDAO.class.php");
global $FlushPHPObj;
$LangObj = $FlushPHPObj->loadApp("Language");
$__ModuleLang__ = $LangObj->initLanguage(MODULE_DIR."Site/Language/");
$__Lang__ = $__ModuleLang__+$__Lang__;
class Wizard extends UI
{
	var $_DAO;
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-7 10:54:15
	 * @param   string  
	 *
	 */
	function Wizard () 
	{
		global $__SITE_VAR__;
		include_once("ModuleConfig.php");
		
		$this->_DAO = & new WizardDAO();
	}
	
	function opStep1()
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 1 ");

		$radio[] = &HTML_QuickForm::createElement('radio', null, null, $__Lang__['langVersionEn-us'], 'en-us');
		$radio[] = &HTML_QuickForm::createElement('radio', null, null, $__Lang__['langVersionZh-cn'], 'zh-cn');
		$form->addGroup($radio, 'site_version', $__Lang__['langSiteVersion']." : ");

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action', $_REQUEST['Action']); 
		
		$LangObj = $FlushPHPObj->loadApp("Language");
		$lang_code = $LangObj->getFirstLanguage();
		$current_lang = $_SESSION['CURRENT_LANG']?$_SESSION['CURRENT_LANG']:$lang_code; 
		$form->setDefaults(array('site_version'=>$current_lang));

		$form->addElement('submit', null, $__Lang__['langNexStep']);
		
		$form->addRule('site_version', $__Lang__['langGeneralPleaseSelect']." ".$__Lang__['langSiteVersion'], 'required');
		
		if ($form->validate()) 
		{
			$_SESSION['CURRENT_LANG'] = $_POST['site_version'];
			$this->_initSiteDir($_POST['site_version']);
			$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step2");
		}		
		$smarty->assign("Main", $form->toHTML());
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 6, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opStep2 () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$thisDAO,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 2 ");

		$form->addElement('text', 'SiteName', $__Lang__['langSite'].$__Lang__['langGeneralName'].' : ',array('size'=>40));
		$form->addElement('text', 'SiteKeyword', $__Lang__['langSite'].$__Lang__['langKeyword'].' : ',array('size'=>40));
		$form->addElement('textarea', 'SiteCopyright', $__Lang__['langSite'].$__Lang__['langSiteCopyRight'].' : ',array('rows' => 8, 'cols' => 40));
		$form->addElement('file', 'SiteLogo', $__Lang__['langSite'].$__Lang__['langSiteLogo'].' : ');
		
		$step_nav[] = &HTML_QuickForm::createElement('button', 'btnPre', $__Lang__['langPreStep'],"onclick=window.location='?Module=".$_REQUEST['Module']."&amp;Page=".$_REQUEST['Page']."&amp;Action=Step1' ");
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnNext', $__Lang__['langNexStep']);
		
		$form->addGroup($step_nav, 'step_navigation',"    ");
		
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
			
			$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step3");
		}

		$smarty->assign("Main", $form->toHTML());
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 6, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opStep3 () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 3 ");
		
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnPre', $__Lang__['langPreStep'],"onclick=document.forms[0].Step.value='Step2' ");
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnNext', $__Lang__['langNexStep'],"onclick=document.forms[0].Step.value='Step4' ");
		
		$form->addGroup($step_nav, 'step_navigation',"    ");
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step'); 
		
		if ($form->validate()) 
		{
			if ($_POST['Step'] == 'Step2') 
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step2");
			}
			 else
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step4");
				
			}
		}

		$smarty->assign("Main", $form->toHTML());
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 6, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opStep4 () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 3 ");
		
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnPre', $__Lang__['langPreStep'],"onclick=document.forms[0].Step.value='Step3' ");
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnNext', $__Lang__['langNexStep'],"onclick=document.forms[0].Step.value='Step5' ");
		
		$form->addGroup($step_nav, 'step_navigation',"    ");
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step'); 
		
		if ($form->validate()) 
		{
			if ($_POST['Step'] == 'Step3') 
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step3");
			}
			 else
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step5");
				
			}
		}

		$smarty->assign("Main", $form->toHTML());
		
	}
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 6, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function _redirectURL ($URL) 
	{
		echo "<SCRIPT LANGUAGE=\"JavaScript\">window.location='".$URL."'</SCRIPT>";
	}
	
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2006-1-7 12:37:43
	 * @param   string  
	 *
	 */
	function _initSiteDir ($version_code) 
	{
		$_version_root = HTML_DIR."/".$version_code."/";
		$_version_image = $_version_root."images/";
		$_create_mod = 0755;
		if (!file_exists($_version_root)) 
		{
			mkdir($_version_root,$_create_mod);
		}
		if (!file_exists($_version_image)) 
		{
			mkdir($_version_image,$_create_mod);
		}
		return ;
	}
	
	
	
}
?>