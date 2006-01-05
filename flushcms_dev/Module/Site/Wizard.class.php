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

/* $Id: Wizard.class.php,v 1.1 2006/01/05 15:34:39 arzen Exp $ */

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
		$form->addElement('text', 'GroupName', $__Lang__['langUserGroup'].$__Lang__['langGeneralName'].' : ');
		
		$form->addElement('submit', null, $__Lang__['langNexStep']);
		
		$smarty->assign("Main", $form->toHTML());
	}
	
}
?>