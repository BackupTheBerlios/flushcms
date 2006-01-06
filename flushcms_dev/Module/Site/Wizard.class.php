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

/* $Id: Wizard.class.php,v 1.3 2006/01/06 10:29:04 arzen Exp $ */

include_once(APP_DIR."UI.class.php");
include_once("ModuleConfig.php");
global $FlushPHPObj;
$LangObj = $FlushPHPObj->loadApp("Language");
$__ModuleLang__ = $LangObj->initLanguage(MODULE_DIR."Site/Language/");
$__Lang__ = $__ModuleLang__+$__Lang__;

class Wizard extends UI
{

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
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 2 ");
		
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnPre', $__Lang__['langPreStep'],"onclick=document.forms[0].Step.value='Step1' ");
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnNext', $__Lang__['langNexStep'],"onclick=document.forms[0].Step.value='Step3' ");
		
		$form->addGroup($step_nav, 'step_navigation',"    ");
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step'); 
		
		if ($form->validate()) 
		{
			if ($_POST['Step'] == 'Step1') 
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step1");
			}
			 else
			{
				$this->_redirectURL("?Module=".$_REQUEST['Module']."&Page=".$_REQUEST['Page']."&Action=Step3");
				
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
	
	
	
}
?>