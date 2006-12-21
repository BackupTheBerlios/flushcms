<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_CONTACT_CATEGORY_UPDATE')) define('IDC_CONTACT_CATEGORY_UPDATE', 1201);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_contact"]}{$wb->vars["Lang"]["lang_category"]}", WBC_CENTER, WBC_CENTER, 605, 492, 0x00000000, 0);

// Insert controls

wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 425, 90, 25, IDC_CONTACT_CATEGORY_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 385, 425, 90, 25, IDCANCEL, 0x00000000, 0, 0);

// End controls

?>