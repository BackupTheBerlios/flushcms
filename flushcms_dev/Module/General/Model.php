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
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-11 21:18:52                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: Model.php,v 1.2 2005/12/11 15:06:01 arzen Exp $ */
include_once(PEAR_DIR."HTML/QuickForm.php");
$form =& new HTML_QuickForm('frmTest', 'get');

// Add some elements to the form
$form->addElement('header', null, 'QuickForm tutorial example');
$form->addElement('text', 'name', 'Enter your name:', array('size' => 50, 'maxlength' => 255));
$form->addElement('submit', null, 'Send');
$form->addElement('hidden', 'Model', 'General');
$form->addElement('hidden', 'Page', 'Model');
// Define filters and validation rules
$form->applyFilter('name', 'trim');
$form->addRule('name', 'Please enter your name', 'required');

// Try to validate a form 
if ($form->validate()) {
    echo '<h1>Hello, ' . htmlspecialchars($form->exportValue('name')) . '!</h1>';

}

$smarty->assign("Main",$form->toHtml());
?>
