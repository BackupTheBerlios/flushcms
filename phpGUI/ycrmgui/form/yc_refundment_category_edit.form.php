<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 2971);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 2972);
if(!defined('IDC_CATEGORY_NAME')) define('IDC_CATEGORY_NAME', 2973);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_refundment"]}{$wb->vars["Lang"]["lang_category"]}", WBC_CENTER, WBC_CENTER, 370, 160, 0x00000000, 0);

// Insert controls

wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 145, 80, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 250, 80, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 30, 80, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_category"]}{$wb->vars["Lang"]["lang_name"]}", 35, 20, 80, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 140, 20, 130, 20, IDC_CATEGORY_NAME, 0x00000000, 0, 0);

// End controls

?>