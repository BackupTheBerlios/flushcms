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
   | Author: John.meng(цот╤РШ)  2006-1-19 21:13:28                        
   +----------------------------------------------------------------------+
 */

/* $Id: ModuleNewsDAO.class.php,v 1.2 2006/01/22 05:59:52 arzen Exp $ */

include_once(APP_DIR."DBApp.class.php");

class ModuleNewsDAO extends DBApp
{

	function ModuleNewsDAO()
	{
	}
	/**
	 *
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version - 2006-1-22 13:25:05
	 * @param   string  
	 *
	 */
	function getMenuIDNews ($MenuID) 
	{
		return $this->getRows (SITE_NEWS_TABLE," SiteMenuID= '$MenuID' ORDER BY CreateTime DESC ");
	}
	
	
}
?>