<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_COMPLAINTS_TITLE')) define('IDC_COMPLAINTS_TITLE', 2571);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 2572);
if(!defined('IDC_COMPLAINTS_COMPLAINANTER')) define('IDC_COMPLAINTS_COMPLAINANTER', 2573);
if(!defined('IDC_COMPLAINTS_REPLY')) define('IDC_COMPLAINTS_REPLY', 2574);
if(!defined('IDC_COMPLAINTS_HANDLEMAN')) define('IDC_COMPLAINTS_HANDLEMAN', 2575);
if(!defined('IDC_COMPLAINTS_MEMO')) define('IDC_COMPLAINTS_MEMO', 2576);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 2577);
if(!defined('IDC_COMPLAINTS_HANDLEDATE')) define('IDC_COMPLAINTS_HANDLEDATE', 2578);
if(!defined('IDC_COMPLAINTS_STATE')) define('IDC_COMPLAINTS_STATE', 2579);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_complaints"]}", WBC_CENTER, WBC_CENTER, 597, 313, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_title"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 490, 20, IDC_COMPLAINTS_TITLE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 140, 250, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_complainanter"]}", 5, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 45, 200, 20, IDC_COMPLAINTS_COMPLAINANTER, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_reply"]}", 280, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 45, 35, 20, IDC_COMPLAINTS_REPLY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_handleman"]}", 5, 85, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 85, 200, 20, IDC_COMPLAINTS_HANDLEMAN, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 0, 130, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 115, 510, 125, IDC_COMPLAINTS_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 250, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 380, 250, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_handledate"]}", 285, 85, 70, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 85, 195, 20, IDC_COMPLAINTS_HANDLEDATE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_state"]}", 405, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 475, 45, 75, 20, IDC_COMPLAINTS_STATE, 0x00000000, 0, 0);

// End controls

?>