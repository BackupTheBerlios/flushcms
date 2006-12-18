<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_TREEVIEW1001')) define('IDC_TREEVIEW1001', 1001);

// Create window

$wb->mainwin = wb_create_window(null, AppWindow, $wb->vars["Lang"]["system_name"], WBC_CENTER, WBC_CENTER, 839, 645, 0x00000200, 0);

// Insert controls

$wb->tree_view = wb_create_control($wb->mainwin, TreeView, 'TreeView1', 15, 15, 180, 545, IDC_TREEVIEW1001, 0x00000000, 0, 0);
$wb->statusbar = wb_create_control($wb->mainwin, StatusBar, "");
// End controls

?>