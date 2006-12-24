<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_OPPORTUNITY_TITLE')) define('IDC_OPPORTUNITY_TITLE', 1371);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 1372);
if(!defined('IDC_OPPORTUNITY_LINK_MAN')) define('IDC_OPPORTUNITY_LINK_MAN', 1373);
if(!defined('IDC_OPPORTUNITY_ADDREES')) define('IDC_OPPORTUNITY_ADDREES', 1374);
if(!defined('IDC_OPPORTUNITY_STATE')) define('IDC_OPPORTUNITY_STATE', 1375);
if(!defined('IDC_OPPORTUNITY_PHONE')) define('IDC_OPPORTUNITY_PHONE', 1376);
if(!defined('IDC_OPPORTUNITY_FAX')) define('IDC_OPPORTUNITY_FAX', 1377);
if(!defined('IDC_OPPORTUNITY_EMAIL')) define('IDC_OPPORTUNITY_EMAIL', 1378);
if(!defined('IDC_OPPORTUNITY_HOMEPAGE')) define('IDC_OPPORTUNITY_HOMEPAGE', 1379);
if(!defined('IDC_OPPORTUNITY_MEMO')) define('IDC_OPPORTUNITY_MEMO', 1380);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 1381);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_opportunity"]}", WBC_CENTER, WBC_CENTER, 597, 404, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_name"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 510, 20, IDC_OPPORTUNITY_TITLE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 145, 340, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_contact"]}", 10, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 40, 200, 20, IDC_OPPORTUNITY_LINK_MAN, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_addrees"]}", 10, 135, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_state"]}", 270, 40, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 130, 510, 20, IDC_OPPORTUNITY_ADDREES, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 340, 45, 200, 20, IDC_OPPORTUNITY_STATE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_phone"]}", 10, 85, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 80, 200, 20, IDC_OPPORTUNITY_PHONE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_fax"]}", 270, 75, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 340, 75, 235, 20, IDC_OPPORTUNITY_FAX, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_email"]}", 10, 175, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 170, 205, 20, IDC_OPPORTUNITY_EMAIL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_homepage"]}", 275, 170, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 340, 170, 230, 20, IDC_OPPORTUNITY_HOMEPAGE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 5, 230, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 205, 510, 125, IDC_OPPORTUNITY_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 340, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 390, 340, 90, 25, IDCANCEL, 0x00000000, 0, 0);

// End controls

?>