<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_TABCONTROL')) define('IDC_TABCONTROL', 1002);

// Insert controls

$wb->left_control = wb_create_control($wb->mainwin, TabControl, "{$wb->vars["Lang"]["lang_contact"]},{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}", 160, 2, $wb->winwidth-160, $wb->winheight-40, IDC_TABCONTROL, 0x00000000, 0|WBC_RESIZE, 0);
$dim = wb_get_size($wb->left_control, true);

$data_list = wb_create_control($wb->left_control, ListView,		"",	   0, 10,$dim[0], $dim[1]-50, 	102,WBC_VISIBLE | WBC_ENABLED | WBC_SORT | WBC_LINES | WBC_CHECKBOXES, 0, 0);

// Create ListView header

wb_set_text($data_list, array(
   array("File", 	100),
   array(null, 		80),
   array("Name",	140),
   array("Update",	200),
));

reset_listview($data_list);

function reset_listview($list)
{
	// Empty listview

	wb_delete_items($list, null);

	// Create listview items

	wb_create_items($list, array(
		array("1,000",	"Bob",		"John",		"Peter"),
		array(0,		"Sue",		"Paul",		"Mary"),
		array("200",	null,		300/2,		pi()),
	));

	// Set listview images

	wb_set_item_image($list, 5, 0, 1);
	wb_set_item_image($list, 2, 2, 3);
}

// End controls

?>