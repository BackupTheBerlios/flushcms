<?php
/**
 *
 * Controller.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: Controller.class.php,v 1.1 2006/10/29 09:21:14 arzen Exp $
 */

class Controller
{
	var $path_info;
	var $default_module="default";
	var $default_page="index";
	var $default_action="list";
	
	function parseURI () 
	{
		$query_uri = getenv("REQUEST_URI");
	}
	
	function dispatch () 
	{
		global $ModuleDir,$ClassDir,$template,$DefaultModule,$DefaultPage,$timer;
		$this->path_info = ltrim(getenv("PATH_INFO"), "/");
		
		$this->setDefualtModule($DefaultModule);
		$this->setDefualtPage($DefaultPage);
		
		$module_name = $this->getModuleName()?$this->getModuleName():$this->getDefualtModule();
		$page_name = $this->getPageName()?$this->getPageName():$this->getDefualtPage();
		$action_name = $this->getActionName()?$this->getActionName():$this->default_action;
		
		include_once($ClassDir."StringHelper.class.php");
		$page_class_name = StringHelper::CamelCaseFromUnderscore($page_name);
		$include_file = $ModuleDir.$module_name.DIRECTORY_SEPARATOR.$page_class_name.".class.php";
		
		if (file_exists($include_file)) 
		{
			include_once($include_file);
			
			$TempObj = new $page_class_name;
			$Action = "execute".ucfirst($action_name);
			$TempObj->$Action();
			
		}
		
//		printf("module %s/ page %s/ action %s/ ",$module_name,$page_name,$action_name);
		$template->setFile(array (
			"TAB" => "tab.html",
		));
		$template->setBlock("TAB", "tab");
		
		$this->parseTemplateLang(true);
		
		$template->parse("OUT", array (
			"LAOUT",
		));
		$template->p("OUT");
		
		if (defined('APF_DEBUG') && (APF_DEBUG==true) ) 
		{
			$timer->stop();
			$timer->display();
		}

	}
	
	function parseTemplateLang ($parse_tab=false) 
	{
		global $template,$i18n,$WebTemplateFullPath,$WebBaseDir;
		$lang_arr = array_merge($template->getUndefined("MAIN"),$parse_tab?$template->getUndefined("TAB"):array(),
			is_array($template->getUndefined("list_block"))?$template->getUndefined("list_block"):array(),is_array($template->getUndefined("product_list_block"))?$template->getUndefined("product_list_block"):array(),$template->getUndefined("FOOT")
			);
		foreach($lang_arr as $key=>$value)
		{
			if (eregi("lang_",$key)) 
			{
				$lang_key = ltrim($key,"lang_");
				$template->setVar($key,$i18n->_($lang_key));
			}
		}
		$template->setVar(array (
			"TEMPLATEDIR" => $WebTemplateFullPath, 
			"WEBBASEDIR" => $WebBaseDir, "SITETITLE" => $i18n->_('site_title'), "CHARSET" => $i18n->getCharset(),));
//		Var_Dump::display($template->getUndefined("MAIN"));
	}
	
	function getModuleName () 
	{
		$path_arr = explode("/",$this->path_info);
		return $path_arr[0];
	}
	
	function getPageName () 
	{
		$path_arr = explode("/",$this->path_info);
		return $path_arr[1];
	}

	function getActionName () 
	{
		$path_arr = explode("/",$this->path_info);
		return $path_arr[2];
	}
	
	function getID () 
	{
		$path_arr = explode("/",$this->path_info);
		return $path_arr[3];
	}
	
	function getURLParam ($num) 
	{
		$path_arr = explode("/",$this->path_info);
//		Var_Dump::display($path_arr);
		return $path_arr[3+$num];
	}
	
	function getDefualtModule () 
	{
		return $this->default_module;
	}
	
	function setDefualtModule ($value) 
	{
		$this->default_module = $value;
	}
	
	function getDefualtPage () 
	{
		return $this->default_page;
	}
	
	function setDefualtPage ($value) 
	{
		$this->default_page = $value;
	}
}
?>