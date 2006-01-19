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
   | Author: John.meng(√œ‘∂Ú˚)  Jan 19, 2006 12:13:26 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id$ */

include_once (APP_DIR."UI.class.php");
include_once ("DAO/ModuleNewsDAO.class.php");

class ModuleNews extends UI
{

	var $_DAO;
	function ModuleNews()
	{
		$this->_DAO = new ModuleNewsDAO();
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
		$Content = $_POST['Content'];
		$ed_4 = & new rich("", 'Content', $Content,
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
		
		$form->addRule('Title', $__Lang__['langGeneralPleaseEnter']." ".$__Lang__['langModuleNewsTitle'], 'required');

		$form->addElement('hidden', 'Module', $_REQUEST['Module']); 
		$form->addElement('hidden', 'Page', $_REQUEST['Page']); 
		$form->addElement('hidden', 'Action',$_REQUEST['Action']); 
		$form->addElement('hidden', 'MenuID',$_GET['MenuID']); 

		if ($form->validate()) 
		{
			$record["Title"] = $_POST['Title'];
			$record["Summary"] = $_POST['Summary'];
			$record["Content"] = $_POST['Content'];
			$record["Source"] = $_POST['Source'];
			$record["Author"] = $_POST['Author'];
			$record["SiteMenuID"] = $_POST['MenuID'];

			$record = $record + $this->_DAO->baseField();
			$this->_DAO->opAdd (SITE_NEWS_TABLE,$record);

			echo "<SCRIPT LANGUAGE='JavaScript'>opener.window.location.reload();window.close();</SCRIPT>";
		}
		$html_code = "<link rel=\"StyleSheet\" type=\"text/css\" href=\"".$class_path."rich_files/rich.css\"><script language=\"JScript.Encode\" src=\"".$class_path."rich_files/rich.js\"></script>".$form->toHTML();
		$smarty->assign("Main", str_replace(ROOT_DIR,"../",$html_code));
	}
	/**
	 *
	 *
	 * @author  John.meng (√œ‘∂Ú˚)
	 * @since   version - 2006-1-19 21:40:54
	 * @param   string  
	 *
	 */
	function getNewsAll ($MenuID) 
	{
		global $SiteDB;
		$Sql = " SELECT * FROM ".SITE_MENU_TABLE." WHERE SiteMenuID = '$MenuID' ";
		return $SiteDB->GetAll($Sql);
	}
	
	/**
	 *
	 *
	 * @author  John.meng (√œ‘∂Ú˚)
	 * @since   version - 2006-1-19 21:43:38
	 * @param   string  
	 *
	 */
	function displayFormat1 (&$NewsArray) 
	{
		$html_code = "<TABLE>";
		for ($index = 0; $index < sizeof($NewsArray); $index++) 
		{
			$html_code = "<TR><TD>".$NewsArray[$index]['Title']."</TD></TR>";
		}
		$html_code .= "</TABLE>";
		
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
		global $__Lang__,$smarty_site,$smarty;
		include_once("DAO/SiteMenuDAO.class.php");
		$siteMenuDAO = & new SiteMenuDAO();
		if ($_GET['MenuID'] && $_GET['PID']==0) 
		{
			$top_pid = $_GET['MenuID'];
		}else 
		{
			$top_pid = $_GET['PID'];
		}
		$smarty->assign("__MenuID__",$_GET['MenuID']);
		$smarty_site->assign("__site_sub_menu__",$siteMenuDAO->getSubMenu($top_pid));
		$smarty_site->assign("__site_main__",$this->displayFormat1());
		
		var_dump($this->getNewsAll ($_GET['MenuID']));
		
	}
	
	
}
?>