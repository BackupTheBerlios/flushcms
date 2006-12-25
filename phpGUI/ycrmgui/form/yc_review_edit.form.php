<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_REVIEW_COMPANY')) define('IDC_REVIEW_COMPANY', 3071);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 3072);
if(!defined('IDC_REVIEW_LINKMAN')) define('IDC_REVIEW_LINKMAN', 3073);
if(!defined('IDC_REVIEW_MEMO')) define('IDC_REVIEW_MEMO', 3074);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 3075);
if(!defined('IDC_REVIEW_REVIEWDATE')) define('IDC_REVIEW_REVIEWDATE', 3076);
if(!defined('IDC_REVIEW_CATEGORY')) define('IDC_REVIEW_CATEGORY', 3077);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_review"]}", WBC_CENTER, WBC_CENTER, 592, 320, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_company"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 490, 20, IDC_REVIEW_COMPANY, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 140, 250, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_linkman"]}", 5, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 45, 200, 20, IDC_REVIEW_LINKMAN, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_reviewnote"]}", 0, 130, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 115, 510, 125, IDC_REVIEW_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 250, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 380, 250, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_reviewdate"]}", 5, 90, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 90, 200, 20, IDC_REVIEW_REVIEWDATE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_category"]}", 295, 90, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, ComboBox, "", 360, 90, 120, 105, IDC_REVIEW_CATEGORY, 0x00000040, 0, 0);

// End controls

?>