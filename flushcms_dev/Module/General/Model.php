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
 
/* $Id: Model.php,v 1.3 2005/12/11 15:19:55 arzen Exp $ */
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

$data = array(
 '0' => array("Bakken", "Stig", "", "stig@example.com"),
 '1' => array("Merz", "Alexander", "alex.example.com", "alex@example.com"),
 '2' => array("Daniel", "Adam", "", "")
);

require_once PEAR_DIR."HTML/Table.php";      

$tableAttrs = array("width" => "600");
$table = new HTML_Table($tableAttrs);
$table -> setAutoGrow(true);
$table -> setAutoFill("n/a");

for($nr = 0; $nr < count($data); $nr++) {
 $table -> setHeaderContents( $nr+1, 0, (string)$nr); 
 for($i = 0; $i < 4; $i++) {  
  if("" != $data[$nr][$i])
   $table -> setCellContents( $nr+1, $i+1, $data[$nr][$i]);
 }
}
$altRow = array("bgcolor"=>"red");
$table -> altRowAttributes(1, null, $altRow);

$table -> setHeaderContents(0, 0, ""); 
$table -> setHeaderContents(0, 1, "Surname");
$table -> setHeaderContents(0, 2, "Name");
$table -> setHeaderContents(0, 3, "Website");
$table -> setHeaderContents(0, 4, "EMail");
$hrAttrs = array("bgcolor" => "silver");
$table -> setRowAttributes(0, $hrAttrs, true);
$table -> setColAttributes(0, $hrAttrs);

$smarty->assign("Main",$table->toHTML());
?>
