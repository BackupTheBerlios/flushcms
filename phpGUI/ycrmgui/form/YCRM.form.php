<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_TREEVIEW')) define('IDC_TREEVIEW', 1001);

// Create window
$dim = explode(" ", wb_get_system_info("workarea"));

$wb->mainwin = wb_create_window(null, AppWindow|ResizableWindow, $wb->vars["Lang"]["system_name"], 0, 0, $dim[2], $dim[3],  WBC_NOTIFY, WBC_RESIZE | WBC_REDRAW);

$dim = wb_get_size($wb->mainwin, true);
$wb->winwidth = $dim[0];
$wb->winheight = $dim[1];

// Insert controls

$wb->tree_view = wb_create_control($wb->mainwin, TreeView, 'TreeView1', 1, 2, 150, $wb->winheight-40, IDC_TREEVIEW, WBC_LINES);
wb_set_image($wb->tree_view, PATH_RES . "treeview.bmp", GREEN, 0, 10);
$items = wb_create_items($wb->tree_view, array(
	array($wb->vars["Lang"]["lang_cust"].$wb->vars["Lang"]["lang_manage"],  2001),				// Default insertion level is 0
	array($wb->vars["Lang"]["lang_contact"], 2002, 1),
	array($wb->vars["Lang"]["lang_company"], 2003, 1),
	array($wb->vars["Lang"]["lang_product"], 2004, 1),

	array($wb->vars["Lang"]["lang_sale"].$wb->vars["Lang"]["lang_manage"],  2005),
	array($wb->vars["Lang"]["lang_opportunity"], 2006, 1),
	array($wb->vars["Lang"]["lang_order"], 2007, 1),
	array($wb->vars["Lang"]["lang_agreement"], 2008, 1),
	
	array($wb->vars["Lang"]["lang_afterservice"].$wb->vars["Lang"]["lang_manage"],  2009),
	array($wb->vars["Lang"]["lang_complaints"], 2010, 1),
	array($wb->vars["Lang"]["lang_refundment"], 2011, 1),
	array($wb->vars["Lang"]["lang_review"], 2012, 1),
	
));

// End controls

?>