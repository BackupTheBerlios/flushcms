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
   | Author: John.meng(цот╤РШ)  2006-1-5 22:37:21                        
   +----------------------------------------------------------------------+
 */

/* $Id: Wizard.class.php,v 1.2 2006/01/06 05:32:11 arzen Exp $ */

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

		$form->addElement('submit', null, $__Lang__['langNexStep']);
		
		$form->addRule('site_version', $__Lang__['langGeneralPleaseSelect']." ".$__Lang__['langSiteVersion'], 'required');
		
		if ($form->validate()) 
		{
			$_SESSION['CURRENT_LANG'] = $_POST['site_version'];
		}		
		$smarty->assign("Main", $form->toHTML());
	}
	
}
?>