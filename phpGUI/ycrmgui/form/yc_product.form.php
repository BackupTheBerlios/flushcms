<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_PRODUCTS_TAB')) define('IDC_PRODUCTS_TAB', 1501);

// Create window

//$mainwin = wb_create_window($wb->mainwin, AppWindow, "{$wb->vars["Lang"]["lang_contact"]}", WBC_CENTER, WBC_CENTER, 617, 511, 0x00000001, 0);

// Insert controls

$tab = wb_create_control($wb->mainwin, TabControl, "{$wb->vars["Lang"]["lang_products"]},{$wb->vars["Lang"]["lang_products"]}{$wb->vars["Lang"]["lang_category"]}",  160, 30, $wb->winwidth-160, $wb->winheight-40, IDC_PRODUCTS_TAB, 0x00000000, 0, 0);

// End controls

?>