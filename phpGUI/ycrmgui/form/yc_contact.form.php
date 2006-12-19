<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_CONTACT_FORM')) define('IDC_CONTACT_FORM', 1101);
if(!defined('IDC_CONTACT_DATA_LIST')) define('IDC_CONTACT_DATA_LIST', 1102);
if(!defined('IDC_CONTACT_SEARCH')) define('IDC_CONTACT_SEARCH', 1120);

if(!defined('IDC_CONTACT_CATEGORY_DATA_LIST')) define('IDC_CONTACT_CATEGORY_DATA_LIST', 1103);

if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 2101);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 2102);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 2103);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 2104);

if(!defined('IDC_CATEGORY_NAV_PRE')) define('IDC_CATEGORY_NAV_PRE', 2105);
if(!defined('IDC_CATEGORY_NAV_NEXT')) define('IDC_CATEGORY_NAV_NEXT', 2106);
if(!defined('IDC_CATEGORY_NAV_FIRST')) define('IDC_CATEGORY_NAV_FIRST', 2107);
if(!defined('IDC_CATEGORY_NAV_LAST')) define('IDC_CATEGORY_NAV_LAST', 2108);


// Insert controls

$contact_tab = wb_create_control($wb->mainwin, TabControl,  "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}",  160, 30, $wb->winwidth-160, $wb->winheight-40, IDC_CONTACT_FORM, 0x00000000, 0, 0);
$wb->right_control = $contact_tab;
$dim = wb_get_size($contact_tab, true);
// contact
$contact_list = wb_create_control($contact_tab, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-120, 	IDC_CONTACT_DATA_LIST, WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);
$wb->contact_list = $contact_list;
//$btn = wb_create_control($contact_tab, ImageButton, "Button 1",  0, 0, 24, 24,10 , WBC_IMAGE);
//$img = wb_load_image(PATH_RES . "ctrl_calendar3.bmp");
//wb_set_image($btn, $img, NOCOLOR, 0, 1);
//wb_set_image($btn, PATH_RES . "ctrl_calendar3.bmp",  0, 0, 3);
//wb_set_image($btn, PATH_RES."favicon.ico");
//wb_destroy_image($img);
//$img = wb_load_image(PATH_RES . 'treeview.bmp');
//wb_draw_image($btn, $img, 0, 0, 16, 15, NOCOLOR, 16, 0);
//wb_destroy_image($img);

//$contact_toolbar = wb_create_control($contact_tab, Label, '', 0, 5,$dim[0]-10, 30,  0, WBC_VISIBLE,0,0);
//wb_create_control($wb->right_control, ToolBar, array(
//    null,                                   // Toolbar separator
//    array(ID_OPEN,  NULL,   "Open a file",              0),
//    null,                                   // Toolbar separator
//    array(IDC_CONTACT_SEARCH, NULL,   $wb->vars["Lang"]["lang_search"],   5),
//    array(IDCLOSE,  NULL,   "Exit this application",    12),
//), 0, 10, 16, 15, 0, 1, PATH_RES . "toolbar.bmp");

// contact category
$wb->contact_category_list = wb_create_control($contact_tab, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-120, 	IDC_CONTACT_CATEGORY_DATA_LIST, WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 1);
//$contact_category_toolbar = wb_create_control($contact_tab, Label, '', 0, 5,$dim[0]-10, 30,  0, WBC_VISIBLE,0,1);
//wb_create_control($contact_category_toolbar, ToolBar, array(
//    null,                                   // Toolbar separator
//    array(ID_OPEN,  NULL,   "Open a file",              0),
//    null,                                   // Toolbar separator
//    array(ID_ABOUT, NULL,   "About this application",   5),
//    array(IDCLOSE,  NULL,   "Exit this application",    12),
//), 0, 10, 16, 15, 0, 0, PATH_RES . "toolbar.bmp");

// End controls

?>