<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_DB_HOST')) define('IDC_DB_HOST', 4001);
if(!defined('IDC_DB_USERNAME')) define('IDC_DB_USERNAME', 4002);
if(!defined('IDC_DB_PASSWORD')) define('IDC_DB_PASSWORD', 4003);
if(!defined('IDC_DB_NAME')) define('IDC_DB_NAME', 4004);
if(!defined('IDC_LANGUAGE')) define('IDC_LANGUAGE', 4005);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_setting"]}", WBC_CENTER, WBC_CENTER, 339, 407, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_host"]}", 25, 20, 90, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 120, 20, 175, 20, IDC_DB_HOST, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_db_username"]}", 25, 75, 90, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 120, 70, 175, 20, IDC_DB_USERNAME, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_db_password"]}", 25, 125, 90, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 120, 125, 175, 20, IDC_DB_PASSWORD, 0x00000100, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_db_name"]}", 25, 185, 90, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 120, 185, 175, 20, IDC_DB_NAME, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_language"]}", 20, 250, 90, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, ListBox, "Chinese,English", 120, 230, 150, 60, IDC_LANGUAGE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 55, 330, 90, 25, IDOK, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 185, 330, 90, 25, IDCANCEL, 0x00000000, 0, 0);

// End controls

?>