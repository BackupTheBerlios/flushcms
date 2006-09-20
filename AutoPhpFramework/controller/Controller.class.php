<?php
/**
 *
 * Controller.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: Controller.class.php,v 1.7 2006/09/20 10:53:03 arzen Exp $
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
		
		$template->parse("OUT", array (
			"TAB",
			"FOOT",
			"MAIN",
			"LAOUT",
		));
		$template->p("OUT");
		Var_Dump::display(array_keys($template->getVars()));
		
		if (defined('APF_DEBUG') && (APF_DEBUG==true) ) 
		{
			$timer->stop();
			$timer->display();
		}

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