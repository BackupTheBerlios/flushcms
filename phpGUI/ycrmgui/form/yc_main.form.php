<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_LEFT_TREE')) define('IDC_LEFT_TREE', 1001);
define("ID_ABOUT",          101);
define("ID_OPEN",           102);

// Create window

$wb->mainwin = wb_create_window(null, AppWindow, $wb->vars["Lang"]["system_name"], WBC_CENTER, WBC_CENTER, 800, 600, 0x00000200, 0);

// Insert controls
$dim = wb_get_size($wb->mainwin, true);
$wb->winwidth = $dim[0];
$wb->winheight = $dim[1];
//main menu
$wb->mainmenu = wb_create_control($wb->mainwin, Menu, array(
    "&File",
        array(ID_OPEN,  "&Open...\tCtrl+O", NULL, NULL, "Ctrl+O"),
        null,           // Separator
        array(IDCLOSE,  "E&xit\tAlt+F4",    NULL, NULL),
    "&Help",
        array(ID_ABOUT, "&About...",        NULL, NULL)
));
//main toolbar
//$wb->toolbar = null;
$wb->toolbar = wb_create_control($wb->mainwin, ToolBar, array(
    null,                                   // Toolbar separator
    array(ID_OPEN,  NULL,   "Open a file",              0),
    null,                                   // Toolbar separator
    array(ID_ABOUT, NULL,   "About this application",   5),
    array(IDCLOSE,  NULL,   "Exit this application",    12),
    array(IDCLOSE,  NULL,   "Exit this application",    13),
), 0, 10, 16, 15, 0, 0, PATH_RES . "toolbar.bmp");

//$wb->toolbar = wb_create_control($wb->mainwin, ToolBar, array(
//    null,                                   // Toolbar separator
//    array(ID_OPEN,  NULL,   "Open a file",              0),
//    null,                                   // Toolbar separator
//    array(ID_ABOUT, NULL,   "About this application",   12),
//    array(IDCLOSE,  NULL,   "Exit this application",    13),
//), 0, 0, 16, 15, 0, 0, PATH_RES . "toolbar.bmp");

//left tree view
$wb->tree_view = wb_create_control($wb->mainwin, TreeView, 'TreeView1', 1, 30, 150, $wb->winheight-40, IDC_LEFT_TREE, 0x00000000, 0, 0);
$wb->statusbar = wb_create_control($wb->mainwin, StatusBar, "");
// End controls

?>