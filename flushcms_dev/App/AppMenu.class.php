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

/* $Id: AppMenu.class.php,v 1.2 2005/12/14 15:16:16 arzen Exp $ */
/**
 * Load language file
 * @package	App
 */

require_once PEAR_DIR.'HTML/Menu.php';
require_once PEAR_DIR.'HTML/Menu/DirectRenderer.php';
class AppMenu
{
	var $_type='sitemap';
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
		$menu =& new HTML_Menu($MainMenu);
		$menu->forceCurrentUrl("?".$_SERVER["QUERY_STRING"]);
		$type = $this->_type;
		$renderer =& new HTML_Menu_DirectRenderer();
		$renderer->setMenuTemplate("<table border=0>","</table>");
		$menu->render($renderer,$type);
		$smarty->assign('MainMenu',$renderer->toHtml());
	}
	
	
}
?>