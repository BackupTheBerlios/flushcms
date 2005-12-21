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

/* $Id: AppMenu.class.php,v 1.3 2005/12/21 07:20:17 arzen Exp $ */

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
	* function_description
	*
	* @author	John.meng
	* @since    version - Dec 21, 2005
	* @param	datatype paramname description
	* @return   datatype description
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
	
}
?>