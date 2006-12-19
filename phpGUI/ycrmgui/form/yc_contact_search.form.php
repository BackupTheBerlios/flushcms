<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_KEYWORD')) define('IDC_KEYWORD', 1001);
if(!defined('IDC_PUSHBUTTON1002')) define('IDC_PUSHBUTTON1002', 1002);

// Create window

$wb->contact_search = wb_create_window($wb->mainwin, ModalDialog, 'Search', WBC_CENTER, WBC_CENTER, 258, 118, 0x00000001, 0);

// Insert controls

wb_create_control($wb->contact_search, Label, 'Label1', 20, 20, 35, 15, 0, 0x00000000, 0, 0);
wb_create_control($wb->contact_search, EditBox, '', 80, 10, 145, 30, IDC_KEYWORD, 0x00000000, 0, 0);
wb_create_control($wb->contact_search, PushButton, 'PushButton3', 90, 55, 90, 25, IDC_PUSHBUTTON1002, 0x00000000, 0, 0);

// End controls

?>