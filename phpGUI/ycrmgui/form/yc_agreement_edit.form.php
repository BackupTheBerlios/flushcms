<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_AGREEMENT_NOID')) define('IDC_AGREEMENT_NOID', 1371);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 1372);
if(!defined('IDC_AGREEMENT_CATEGORY')) define('IDC_AGREEMENT_CATEGORY', 1373);
if(!defined('IDC_AGREEMENT_BUYERSIGNATURE')) define('IDC_AGREEMENT_BUYERSIGNATURE', 1374);
if(!defined('IDC_AGREEMENT_EFFECTDATE')) define('IDC_AGREEMENT_EFFECTDATE', 1375);
if(!defined('IDC_AGREEMENT_EXPIREDDATE')) define('IDC_AGREEMENT_EXPIREDDATE', 1376);
if(!defined('IDC_AGREEMENT_BUYER')) define('IDC_AGREEMENT_BUYER', 1377);
if(!defined('IDC_AGREEMENT_VENDERSIGNATURE')) define('IDC_AGREEMENT_VENDERSIGNATURE', 1378);
if(!defined('IDC_AGREEMENT_MEMO')) define('IDC_AGREEMENT_MEMO', 1379);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 1380);
if(!defined('IDC_AGREEMENT_VENDER')) define('IDC_AGREEMENT_VENDER', 1381);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_agreement"]}", WBC_CENTER, WBC_CENTER, 597, 372, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_noid"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 200, 20, IDC_AGREEMENT_NOID, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 145, 310, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_category"]}", 285, 5, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 5, 200, 20, IDC_AGREEMENT_CATEGORY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_buyersignature"]}", 5, 130, 65, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_effectdate"]}", 5, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 75, 130, 180, 20, IDC_AGREEMENT_BUYERSIGNATURE, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 45, 200, 20, IDC_AGREEMENT_EFFECTDATE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_expireddate"]}", 280, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 45, 200, 20, IDC_AGREEMENT_EXPIREDDATE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_buyer"]}", 5, 85, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 85, 200, 20, IDC_AGREEMENT_BUYER, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_vendersignature"]}", 280, 130, 70, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 130, 205, 20, IDC_AGREEMENT_VENDERSIGNATURE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 0, 180, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 60, 165, 510, 125, IDC_AGREEMENT_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 260, 310, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 380, 310, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_vender"]}", 285, 85, 70, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 85, 195, 20, IDC_AGREEMENT_VENDER, 0x00000000, 0, 0);

// End controls

?>