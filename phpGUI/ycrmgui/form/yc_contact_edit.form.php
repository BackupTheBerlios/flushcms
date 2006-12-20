<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_CONTACT_USERNAME')) define('IDC_CONTACT_USERNAME', 1101);
if(!defined('IDC_GENDER_MALE')) define('IDC_GENDER_MALE', 1102);
if(!defined('IDC_GENDER_FEMALE')) define('IDC_GENDER_FEMALE', 1103);
if(!defined('IDC_CONTACT_SAVE')) define('IDC_CONTACT_SAVE', 1104);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_contact"]}", WBC_CENTER, WBC_CENTER, 540, 470, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_name"]}", 20, 20, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 70, 20, 90, 20, IDC_CONTACT_USERNAME, 0x00000000, 0, 0);
wb_create_control($winmain, Frame, "{$wb->vars["Lang"]["lang_gender"]}", 20, 40, 180, 60, 0, 0x00000000, 0, 0);
wb_create_control($winmain, RadioButton, "{$wb->vars["Lang"]["lang_male"]}", 30, 70, 120, 15, IDC_GENDER_MALE, 0x00000000, 0, 0);
wb_create_control($winmain, RadioButton, "{$wb->vars["Lang"]["lang_female"]}", 100, 70, 120, 15, IDC_GENDER_FEMALE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 140, 385, 90, 25, IDC_CONTACT_SAVE, 0x00000000, 0, 0);

// End controls

?>