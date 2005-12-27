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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-12 21:25:26                        
   +----------------------------------------------------------------------+
 */

/* $Id: UI.class.php,v 1.8 2005/12/27 13:47:55 arzen Exp $ */

/**
 * class_description
 * @package	package_name
 */

class UI 
{
	  function UI() 
	  {
		  
	  }
  
	/**
	 *
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version - 2005-12-22 22:44:07
	 * @param   string  
	 *
	 */
	function opAdd () 
	{
		global $__Lang__,$UrlParameter,$SiteDB,$AddIPObj,$FlushPHPObj,$form,$smarty;

		include_once (PEAR_DIR.'HTML/QuickForm.php');
		$form = new HTML_QuickForm('firstForm');

		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"new_table\">\n{content}\n</table>\n</form>");
		$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"grid_table_head\" align=\"left\" valign=\"top\" colspan=\"2\"><b>{header}</b></td>\n\t</tr>");
		
	}
	/**
	* View list
	*
	* @author	John.meng
	* @since    version - Dec 23, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj,$table,$page_data,$all_data,$links,$form, $smarty;
		
		include_once (PEAR_DIR.'HTML/QuickForm.php');
		include_once (PEAR_DIR."HTML/Table.php");
		require_once PEAR_DIR.'Pager/Pager.php';
		
		$form = new HTML_QuickForm('viewList');
		$renderer =& $form->defaultRenderer();
		$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" width=\"99%\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">\n{content}\n</table>\n</form>");
		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);

		$table->setAutoGrow(true);
//		$table->setAutoFill("n/a");

		
		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);

		$params = array(
		    'itemData' => $all_data,
		    'perPage' => 10,
		    'delta' => 3,             // for 'Jumping'-style a lower number is better
		    'append' => true,
		    'separator' => ' . ',
		    'clearIfVoid' => false,
		    'urlVar' => 'entrant',
		    'useSessions' => true,
		    'closeSession' => true,
		    //'mode'  => 'Sliding',    //try switching modes
		    'mode'  => 'Jumping',
		    'prevImg'=>$__Lang__['langPaginationPrev'],
		    'nextImg'=>$__Lang__['langPaginationNext']
		
		);
		$pager = & Pager::factory($params);
		$page_data = $pager->getPageData();
		$links = $pager->getLinks();
		$selectBox = $pager->getPerPageSelectBox();
	}
	

  
}

?>