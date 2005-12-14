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
   | Author: John.meng(цот╤РШ)  Dec 13, 2005 4:35:41 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: User.class.php,v 1.3 2005/12/14 13:46:32 arzen Exp $ */

class User
{

	function User()
	{
	}
	
	/**
	* View list
	*
	* @author	John.meng
	* @since    version 1.0 - Dec 13, 2005
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function viewList () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj, $smarty;
		include_once (PEAR_DIR."HTML/Table.php");
		require_once PEAR_DIR.'HTML/QuickForm/link.php';
		
		$test = new HTML_QuickForm_link(null,null,"test.php","test");
		
		$tableAttrs1 = array ("boder" => "0","width"=>"100%");
		$table2 = new HTML_Table($tableAttrs1);
		$table2->setHeaderContents(0, 0, $test->toHTML());
		$table2->setRowAttributes(0, array("align"=>"right"));
		$add_str = $table2->toHtml();
		
		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);
		$table->setAutoGrow(true);
		$table->setAutoFill("n/a");
		$table->setHeaderContents(0, 0, "");
		$table->setHeaderContents(0, 1, $__Lang__['langMenuUser'].$__Lang__['langGeneralName']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralCreateTime']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralAddIP']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralStatus']);
		$table->setHeaderContents(0, 5, $__Lang__['langGeneralOperation']);

		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);
		$table->setColAttributes(0, $hrAttrs);
		$html_grib = $table->toHtml();
		
		$head_tabs = $this->headTabs();
		$smarty->assign("Main", $head_tabs.$add_str.$html_grib);
		
	}
	/**
	 * Display head tabs
	 *
	 * @author  John.meng (цот╤РШ)
	 * @since   version 1.0 - 2005-12-14 21:00:50
	 * @param   string  
	 *
	 */
	function headTabs () 
	{
		global $__Lang__,$UrlParameter,$FlushPHPObj, $smarty;
		include_once (APP_DIR."UI.class.php");
		
	    $tabs = array(
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralList'], $UrlParameter."&Action=UserList"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langGeneralList'], $UrlParameter."&Action=GroupList"),
	                  array($__Lang__['langUserGroup'].$__Lang__['langMenuUser'], $UrlParameter."&Action=GroupUser"),  
	                  array($__Lang__['langMenuUser'].$__Lang__['langGeneralConfigure'], $UrlParameter."&Action=Configure")
	                  ); 
	    switch ($_REQUEST['Action']) 
		{
			case 'UserList':
					$select_tab = 0;
				break;
				
			case 'GroupList':
					$select_tab = 1;
				break;

			case 'GroupUser':
					$select_tab = 2;
				break;

			case 'Configure':
					$select_tab = 3;
				break;
		
			default:
					$select_tab = 0;
				break;
		}
		       
	    $tab = new Tabset($tabs, $select_tab);
		return $tab->toHtml();
	}
	
	
}
?>