<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_LEFT_TREE')) define('IDC_LEFT_TREE', 1011);
if(!defined('IDC_TOOLBAR_SEARCH')) define('IDC_TOOLBAR_SEARCH', 1012);
define("ID_DELETE",          1013);
define("ID_CREATE",           1014);
define("ID_HELP",           1015);
define("ID_ABOUT",           1016);

// Create window

$wb->mainwin = wb_create_window(null, AppWindow, $wb->vars["Lang"]["system_name"], WBC_CENTER, WBC_CENTER, 800, 600, 0x00000200|WBC_NOTIFY, WBC_HEADERSEL|WBC_DBLCLICK);

// Insert controls
$dim = wb_get_size($wb->mainwin, true);
$wb->winwidth = $dim[0];
$wb->winheight = $dim[1];
//main menu
$wb->mainmenu = wb_create_control($wb->mainwin, Menu, array(
    $wb->vars["Lang"]["lang_file"],
        array(IDCLOSE,  $wb->vars["Lang"]["lang_exit"]."\t",    NULL, NULL),
    $wb->vars["Lang"]["lang_help"],
        array(ID_ABOUT, $wb->vars["Lang"]["lang_about"]."...",        NULL, NULL)
));
//main toolbar
//$wb->toolbar = null;
$wb->toolbar = wb_create_control($wb->mainwin, ToolBar, array(
    null,                                   // Toolbar separator
    array(ID_CREATE,  NULL,   $wb->vars["Lang"]["lang_new"],     0),
    null,                                   // Toolbar separator
    array(IDC_TOOLBAR_SEARCH, NULL, $wb->vars["Lang"]["lang_search"],   5),
    array(ID_DELETE,  NULL,   $wb->vars["Lang"]["lang_delete"],    12),
    array(ID_HELP,  NULL,   $wb->vars["Lang"]["lang_help"],    13),
), 0, 10, 16, 15, 0, 0, PATH_RES . "toolbar.bmp");


//left tree view
$wb->tree_view = wb_create_control($wb->mainwin, TreeView, 'TreeView1', 1, 30, 150, $wb->winheight-80, IDC_LEFT_TREE, 0x00000000, 0, 0);
$wb->statusbar = wb_create_control($wb->mainwin, StatusBar, "");
// End controls

?>