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
   | Author: John.meng(ÃÏÔ¶òû)  2006-1-8 11:14:45                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: AboutUs.php,v 1.1 2006/01/08 05:33:34 arzen Exp $ */

if (empty($__Version__))
{
	echo "Big error! ";
	exit;
}
include_once (PEAR_DIR.'HTML/QuickForm.php');
$form = new HTML_QuickForm('firstForm');

$renderer =& $form->defaultRenderer();
$renderer->setFormTemplate("\n<form{attributes}>\n<table border=\"0\" class=\"new_table\">\n{content}\n</table>\n</form>");
$renderer->setHeaderTemplate("\n\t<tr>\n\t\t<td class=\"grid_table_head\" align=\"left\" valign=\"top\" colspan=\"2\"><b>{header}</b></td>\n\t</tr>");
$form->addElement('header', null, $__Lang__['langGeneralAbout']);
$form->addElement('static', NULL,NULL, $__Lang__['langGeneralAboutUsInfo']);


$smarty->assign("Main", $form->toHTML());

?>
