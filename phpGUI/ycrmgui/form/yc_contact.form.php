<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_CONTACT_FORM')) define('IDC_CONTACT_FORM', 1101);
if(!defined('IDC_CONTACT_DATA_LIST')) define('IDC_CONTACT_DATA_LIST', 1102);

if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 2101);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 2102);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 2103);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 2104);


// Insert controls

$contact_tab = wb_create_control($wb->mainwin, TabControl,  "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}",  160, 15, $wb->winwidth-160, $wb->winheight-40, IDC_CONTACT_FORM, 0x00000000, 0, 0);
$wb->right_control = $contact_tab;
$dim = wb_get_size($contact_tab, true);
$contact_list = wb_create_control($contact_tab, ListView,		"",	   0, 30,$dim[0]-10, $dim[1]-120, 	IDC_CONTACT_DATA_LIST,WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);
$wb->contact_list = $contact_list;
// End controls

?>