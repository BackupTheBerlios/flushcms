<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_KEYWORD')) define('IDC_KEYWORD', 1551);
if(!defined('IDC_SEARCH_SUBMIT')) define('IDC_SEARCH_SUBMIT', 1552);

// Create window

$search_form = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_search"]}{$wb->vars["Lang"]["lang_agreement"]}", WBC_CENTER, WBC_CENTER, 258, 118, 0x00000001, 0);

// Insert controls

wb_create_control($search_form, Label, "{$wb->vars["Lang"]["lang_keyword"]}", 20, 20, 35, 15, 0, 0x00000000, 0, 0);
wb_create_control($search_form, EditBox, "", 75, 15, 160, 25, IDC_KEYWORD, 0x00000000, 0, 0);
wb_create_control($search_form, PushButton, "{$wb->vars["Lang"]["lang_search"]}", 90, 55, 90, 25, IDC_SEARCH_SUBMIT, 0x00000000, 0, 0);

// End controls

?>