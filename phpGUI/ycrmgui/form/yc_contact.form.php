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

$contact_tab = wb_create_control($wb->mainwin, TabControl,  "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}",  160, 30, $wb->winwidth-160, $wb->winheight-40, IDC_CONTACT_FORM, WBC_VISIBLE);
$wb->right_control = $contact_tab;
$dim = wb_get_size($contact_tab, true);
// contact
$contact_list = wb_create_control($contact_tab, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-120, 	IDC_CONTACT_DATA_LIST, WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);
$wb->contact_list = $contact_list;


// contact category
$wb->contact_category_list = wb_create_control($contact_tab, ListView,		"",	   0, 10,$dim[0]-10, $dim[1]-120, 	IDC_CONTACT_CATEGORY_DATA_LIST, WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 1);

// End controls

?>