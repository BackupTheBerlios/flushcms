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

/* $Id: Wizard.class.php,v 1.8 2006/01/08 07:36:21 arzen Exp $ */

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
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$FlushPHPObj,$thisDAO,$smarty;
		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 2 ");

		$form->addElement('text', 'SiteName', $__Lang__['langSite'].$__Lang__['langGeneralName'].' : ',array('size'=>40));
		$form->addElement('text', 'SiteKeyword', $__Lang__['langSite'].$__Lang__['langKeyword'].' : ',array('size'=>40));
		$form->addElement('textarea', 'SiteCopyright', $__Lang__['langSite'].$__Lang__['langSiteCopyRight'].' : ',array('rows' => 8, 'cols' => 40));
		
		$site_logo_group[] = &HTML_QuickForm::createElement('file', 'Pic', $__Lang__['langSite'].$__Lang__['langSiteLogo'].' : ');
		if ($site_logo = $this->_DAO->getSiteVarValue($__SITE_VAR__['SITE_LOGO'])) 
		{
			$swf_image_obj = $FlushPHPObj->loadUtility("ViewImgSwf");
			$site_logo_group[] = &HTML_QuickForm::createElement('static', '_SiteLogo',NULL,$swf_image_obj->displayIt($site_logo,NULL,NULL,NULL,HTML_IMAGES_DIR));
			$site_logo_group[] = &HTML_QuickForm::createElement('checkbox', 'del_site_logo',NULL,$__Lang__['langGeneralCancel']);
			$site_logo_group[] = &HTML_QuickForm::createElement('hidden', 'old_site_logo', $site_logo);
		}					
		$form->addGroup($site_logo_group, NULL,$__Lang__['langSite'].$__Lang__['langSiteLogo'].' : ',"    ");

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
		include_once (PEAR_DIR."HTML/Table.php");
		include_once (MODULE_DIR."General/DAO/SystemMenuDAO.class.php");

		parent::opAdd();
		$form->addElement('header', null, $__Lang__['langSite'].$__Lang__['langWizard'].$__Lang__['langStep']." 3 ");

		$sysMenuDao = new SystemMenuDAO();
		$data_menu = $sysMenuDao->getMenuArr();

		$tableAttrs = array ("class" => "grid_sub_table",'cellspacing'=>"0");
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
		$hrAttrs = array ("class" => "grid_sub_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);

		$table->setHeaderContents(0, 0, $__Lang__['langMenu']);
		$table->setHeaderContents(0, 1, $__Lang__['langGeneralOperation']);

		$form->addElement('static', NULL, NULL,$table->toHtml()); 
		
		$step_nav[] = &HTML_QuickForm::createElement('submit', 'btnPre', $__Lang__['langPreStep'],"onclick=document.forms[0].Step.value='Step2' ");
		$step_nav[] = &HTML_QuickForm::createElement('button', 'btnNew', $__Lang__['langGeneralAdd'].$__Lang__['langMenu'],"onclick=\"popOpenWindow('PopupWindow.php', '', 'Module=".$_REQUEST['Module']."&Page=SiteMenu', 450, 450)\" ");
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