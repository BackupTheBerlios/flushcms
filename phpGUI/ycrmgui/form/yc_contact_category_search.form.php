<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_KEYWORD')) define('IDC_KEYWORD', 1001);
if(!defined('IDC_SEARCH_SUBMIT')) define('IDC_SEARCH_SUBMIT', 1002);

// Create window

$wb->contact_search = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_search"]}{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}", WBC_CENTER, WBC_CENTER, 258, 118, 0x00000001, 0);

// Insert controls

wb_create_control($wb->contact_search, Label, "{$wb->vars["Lang"]["lang_keyword"]}", 20, 20, 35, 15, 0, 0x00000000, 0, 0);
wb_create_control($wb->contact_search, EditBox, "", 75, 15, 160, 25, IDC_KEYWORD, 0x00000000, 0, 0);
wb_create_control($wb->contact_search, PushButton, "{$wb->vars["Lang"]["lang_search"]}", 90, 55, 90, 25, IDC_SEARCH_SUBMIT, 0x00000000, 0, 0);

// End controls

?>