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
   | Author: John.meng(��Զ��)  Dec 12, 2005 8:52:17 AM                        
   +----------------------------------------------------------------------+
 */

/* $Id: Model.class.php,v 1.3 2005/12/12 14:13:07 arzen Exp $ */

class Model
{

	function Model()
	{
	}
	/**
	* View list
	*
	* @author	John.meng
	* @since    version1.0 - Dec 12, 2005
	*/
	function viewList()
	{
		global $__Lang__, $FlushPHPObj, $smarty;

		include_once (PEAR_DIR."HTML/Table.php");
		include_once (PEAR_DIR."HTML/QuickForm.php");
		include_once (APP_DIR."UI.class.php");
		
		$form = & new HTML_QuickForm();
		
		$FilesDirsObj = $FlushPHPObj->loadUtility("FilesDirs");
		$FilesDirsObj->FilesDirs(ROOT_DIR, 1, "CVS,General");
		$model_arr = $FilesDirsObj->listDirs();
		asort($model_arr);
		reset($model_arr);
		$data = array ();
		$installImageObj =  new UIImage(THEMES_DIR."images/install.gif");
		$unInstallImageObj =  new UIImage(THEMES_DIR."images/uninstall.gif");
		if (sizeof($model_arr))
		{
			foreach ($model_arr as $key => $value)
			{
				
				$data[$key] = array ($value, '',$unInstallImageObj->toHTML()."<br/>".$__Lang__['langGeneralUnInstall'], $installImageObj->toHTML()."<br/>".$__Lang__['langGeneralInstall']);
			}
		}

		$tableAttrs = array ("class" => "grid_table");
		$table = new HTML_Table($tableAttrs);
		$table->setAutoGrow(true);
		$table->setAutoFill("n/a");

		for ($nr = 0; $nr < count($data); $nr ++)
		{
			$table->setHeaderContents($nr +1, 0, (string) $nr);
			for ($i = 0; $i < 4; $i ++)
			{
				if ("" != $data[$nr][$i])
					$table->setCellContents($nr +1, $i +1, $data[$nr][$i]);
			}
		}
		$table->setColAttributes (2,array (" align"=>"center"));
		$table->setColAttributes (3,array (" align"=>"center"));

		$altRow = array ("class" => "grid_table_tr_alternate");
		$table->altRowAttributes(1, null, $altRow);

		$table->setHeaderContents(0, 0, "");
		$table->setHeaderContents(0, 1, $__Lang__['langMenuModel']);
		$table->setHeaderContents(0, 2, $__Lang__['langGeneralSummary']);
		$table->setHeaderContents(0, 3, $__Lang__['langGeneralStatus']);
		$table->setHeaderContents(0, 4, $__Lang__['langGeneralOperation']);

		$hrAttrs = array ("class" => "grid_table_head");
		$table->setRowAttributes(0, $hrAttrs, true);
		$table->setColAttributes(0, $hrAttrs);
		
		$smarty->assign("Main", $table->toHtml());
	}

}
?>