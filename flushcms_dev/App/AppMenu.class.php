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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-14 20:28:38                        
   +----------------------------------------------------------------------+
 */

/* $Id: AppMenu.class.php,v 1.6 2005/12/26 09:49:23 arzen Exp $ */

/**
 * Load language file
 * @package	App
 */

class AppMenu
{
	var $_type='topdropdown';
	var $_menu_html='';
	function AppMenu()
	{

	}
	/**
	 * Set menu type
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version 1.0 - 2005-12-14 20:32:02
	 * @param   string  $type
	 *
	 */
	function setMenuType ($type) 
	{
		$this->_type=$type;
	}
	/**
	 * Load the menu
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version 1.0- 2005-12-14 20:33:40
	 * @param   string  
	 *
	 */
	function loadMenu ($MainMenu) 
	{
		global $smarty;
		switch ($this->_type) 
		{
			case 'topdropdown':
				$this->_topDropDown($MainMenu);
				break;
		}
		$smarty->assign('MainMenu',$this->_menu_html);
	}
	/**
	* On top dropdown menu 
	*
	* @author	John.meng
	* @since    version 1.0- Dec 21, 2005
	* @param	array    $menu    menu array
	* @param	int      $level   menu node level
	* @return   HTML code
	*/
	function _topDropDown ($menu,$level = 0) 
	{
		foreach($menu as $node_id => $node)
		{
			$_url = $node['url']?$node['url']:'javascript:void(0)';
			$_title = $node['title'];
			$_ico = $node['ico']?"<img src='".THEMES_DIR."images/".$node['ico']."' alt='' border='0' align='absmiddle' />":"";
			if ($level==0) 
			{
				$this->_menu_html .= "<td ><a class='button' href=\"$_url\"> $_ico $_title</a>";
			}else 
			{
				if (isset($node['sub']) && $level>=1) 
				{
					$this->_menu_html .= "<a class='item' href='$_url'> $_ico $_title <img class='arrow' src='".THEMES_DIR."images/arrow1.gif' width='4' height='7' alt='' /></a>";
				}else 
				{
					$this->_menu_html .= "<a class='item' href='$_url'> $_ico $_title</a>";
				}
			}
			if (isset($node['sub'])) 
			{
				$this->_menu_html .="<div class='section'>";
				$this->_topDropDown($node['sub'], $level + 1);
			}
		}
        $this->_menu_html .="</div>";
        if (0 == $level) 
        {
            $this->_menu_html .="</td>";
        }
		
	}
	/**
	 * on top right toolbar html code
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2005-12-25 20:57:21
	 * @param   string  
	 *
	 */
	function _toolbars ($toolbars_data) 
	{
		$x=0;
		$_html_code="";
		foreach($toolbars_data as $key=>$value)
		{
			$x++;
			$_name = "b".$x;
			$_title = $value['title'];
			$_url = $value['url'];
			$_imgName = THEMES_DIR."images/".$value['imgName'];
			$_desc = $value['desc'];
			$_html_code .= <<<EOT
			
  $_name = new Bs_Button();
  $_name.title = '$_title';
  $_name.url = '$_url';
  $_name.imgName = '$_imgName';
  $_name.attachEvent(btnClicked);
  bar.addButton($_name, '$_desc');
			
EOT;
		}
		return $_html_code;
	}
	/**
	* on list grid action ico
	*
	* @author	John.meng
	* @since    version - Dec 26, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function &_actionBars (&$action_data) 
	{
		global $__Lang__;
		$_html_code="";
		if (is_array($action_data)) 
		{
			$_html_code .="<table><tr>";
			foreach($action_data as $key=>$value)
			{
				$_title = $value['title'];
				$_url = $value['url'];
				$_imgName = THEMES_DIR."images/".$value['imgName'];
				$_js = $value['js'];
				$_html_code .="<td><a href='$_url' $_js>";
				if($value['imgName'])$_html_code .="<img src='$_imgName' border='0'><br />";
				$_html_code .=$_title."</a></td>";
			}
			$_html_code .="</tr></table>";
		}
		return $_html_code;
	}
	
	
}
?>