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
   | Author: John.meng(ÃÏÔ¶òû)  Jan 19, 2006 12:13:26 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id$ */

include_once (APP_DIR."UI.class.php");
include_once ("DAO/WizardDAO.class.php");

class ModuleNews extends UI
{

	var $_DAO;
	function ModuleNews()
	{
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$__SITE_VAR__,$form,$FlushPHPObj,$thisDAO,$smarty,$class_path;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm','post','','_self' ,"onsubmit='save_in_textarea_all();'");

		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"new_table\">\n{content}\n</table>\n</form>");
		$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"grid_table_head\" align=\"left\" valign=\"top\" colspan=\"2\"><b>{header}</b></td>\n\t</tr>");

		
		$class_path =INCLUDE_DIR. "editor/";
		$CurrentUserPathImages=HTML_IMAGES_DIR;
		$SiteCssFile = CURRENT_HTML_DIR."style.css";
		$Content = "";
		$ed_4 = & new rich("", 'SiteQuickLink', $Content,
				 "380", "350","../../".$CurrentUserPathImages,
				   "../../".$CurrentUserPathImages, false, false);
		$ed_4->set_default_stylesheet($SiteCssFile);
		$ed_4->myModule(true);
		$editors=$ed_4->draw();
		$smarty->assign("class_path_editor",$class_path);

		$form->addElement('header', null, $__Lang__['langGeneralUpdate']." ".$__Lang__['langBaseInfo']);
		
		$form->addElement('text', 'Title', $__Lang__['langModuleNewsTitle'].' : ',array('size'=>40));
		$form->addElement('textarea', 'Summary', $__Lang__['langModuleNewsSummary'].' : ',array('rows' => 5, 'cols' => 40));
		$form->addElement('static', 'Content', NULL,$editors);
		$form->addElement('text', 'Source', $__Lang__['langModuleNewsSource'].' : ',array('size'=>30));
		$form->addElement('text', 'Author', $__Lang__['langModuleNewsAuthor'].' : ',array('size'=>20));
		
		$form->addElement('submit', null, $__Lang__['langGeneralSubmit']);
		
		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'Step','Step3'); 

		if ($form->validate()) 
		{
			$record["VarName"] = $__SITE_VAR__['SITE_QUICKLINK'];
			$record["VarValue"] = $_POST['Content'];
			$record = $record + $this->_DAO->baseField();
			$this->_DAO->autoInsertOrUpdate (SITE_LARGE_CONFIG_TABLE,$record,array('VersionCode','VarName'));

			echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}
		$html_code = "<link rel=\"StyleSheet\" type=\"text/css\" href=\"".$class_path."rich_files/rich.css\"><script language=\"JScript.Encode\" src=\"".$class_path."rich_files/rich.js\"></script>".$form->toHTML();
		$smarty->assign("Main", str_replace(ROOT_DIR,"../",$html_code));
	}
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - Jan 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function toHtml () 
	{
		global $__Lang__,$smarty_site;
		include_once("DAO/SiteMenuDAO.class.php");
		$siteMenuDAO = & new SiteMenuDAO();
		$smarty_site->assign("__site_sub_menu__",$siteMenuDAO->getSubMenu($_GET['MenuID']));
		
	}
	
}
?>