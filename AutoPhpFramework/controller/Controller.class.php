<?php
/**
 *
 * Controller.class.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: Controller.class.php,v 1.1 2006/09/17 13:48:01 arzen Exp $
 */

class Controller
{
	var $path_info;
	var $default_module;
	var $default_page;
	var $default_action="list";
	
	function parseURI () 
	{
		$query_uri = getenv("REQUEST_URI");
	}
	
	function dispatch () 
	{
		global $DefaultModule,$DefaultPage;
		$this->path_info = ltrim(getenv("PATH_INFO"), "/");
		
		$this->setDefualtModule($DefaultModule);
		$this->setDefualtPage($DefaultPage);
		
		$module_name = $this->getModuleName()?$this->getModuleName():$this->getDefualtModule();
		$page_name = $this->getPageName()?$this->getPageName():$this->getDefualtPage();
		$action_name = $this->getActionName()?$this->getActionName():$this->default_action;
		printf("module %s/ page %s/ action %s/ ",$module_name,$page_name,$action_name);
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