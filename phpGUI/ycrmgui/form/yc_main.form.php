<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_LEFT_TREE')) define('IDC_LEFT_TREE', 1001);

// Create window

$wb->mainwin = wb_create_window(null, AppWindow, $wb->vars["Lang"]["system_name"], WBC_CENTER, WBC_CENTER, 839, 645, 0x00000200, 0);

// Insert controls
$dim = wb_get_size($wb->mainwin, true);
$wb->winwidth = $dim[0];
$wb->winheight = $dim[1];


$wb->tree_view = wb_create_control($wb->mainwin, TreeView, 'TreeView1', 1, 15, 150, $wb->winheight-40, IDC_LEFT_TREE, 0x00000000, 0, 0);
$wb->statusbar = wb_create_control($wb->mainwin, StatusBar, "");
// End controls

?>