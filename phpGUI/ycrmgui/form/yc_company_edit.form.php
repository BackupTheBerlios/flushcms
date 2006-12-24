<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_COMPANY_NAME')) define('IDC_COMPANY_NAME', 1371);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 1372);
if(!defined('IDC_COMPANY_LINK_MAN')) define('IDC_COMPANY_LINK_MAN', 1373);
if(!defined('IDC_COMPANY_ADDREES')) define('IDC_COMPANY_ADDREES', 1374);
if(!defined('IDC_COMPANY_EMPLOYEE')) define('IDC_COMPANY_EMPLOYEE', 1375);
if(!defined('IDC_COMPANY_PHONE')) define('IDC_COMPANY_PHONE', 1376);
if(!defined('IDC_COMPANY_FAX')) define('IDC_COMPANY_FAX', 1377);
if(!defined('IDC_COMPANY_INDUSTRY')) define('IDC_COMPANY_INDUSTRY', 1378);
if(!defined('IDC_COMPANY_EMAIL')) define('IDC_COMPANY_EMAIL', 1379);
if(!defined('IDC_COMPANY_HOMEPAGE')) define('IDC_COMPANY_HOMEPAGE', 1380);
if(!defined('IDC_COMPANY_MEMO')) define('IDC_COMPANY_MEMO', 1381);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 1382);
if(!defined('IDC_COMPANY_BANKROLL')) define('IDC_COMPANY_BANKROLL', 1383);
if(!defined('IDC_COMPANY_INCORPORATOR')) define('IDC_COMPANY_INCORPORATOR', 1384);
if(!defined('IDC_COMPANY_PRODUCT')) define('IDC_COMPANY_PRODUCT', 1385);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_company"]}", WBC_CENTER, WBC_CENTER, 597, 493, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_name"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 510, 20, IDC_COMPANY_NAME, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 145, 425, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_contact"]}", 10, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 40, 120, 20, IDC_COMPANY_LINK_MAN, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_addrees"]}", 5, 235, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_employee"]}", 195, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 235, 510, 20, IDC_COMPANY_ADDREES, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 255, 40, 95, 20, IDC_COMPANY_EMPLOYEE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_phone"]}", 5, 195, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 195, 200, 20, IDC_COMPANY_PHONE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_fax"]}", 280, 195, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 340, 195, 235, 20, IDC_COMPANY_FAX, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_industry"]}", 355, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 420, 40, 155, 20, IDC_COMPANY_INDUSTRY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_email"]}", 5, 280, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 275, 205, 20, IDC_COMPANY_EMAIL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_homepage"]}", 280, 280, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 345, 275, 230, 20, IDC_COMPANY_HOMEPAGE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 5, 325, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 310, 510, 110, IDC_COMPANY_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 425, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 385, 425, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_bankroll"]}", 10, 90, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 90, 120, 20, IDC_COMPANY_BANKROLL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_incorporator"]}", 240, 90, 80, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 345, 85, 230, 20, IDC_COMPANY_INCORPORATOR, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_product"]}", 10, 135, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 130, 510, 50, IDC_COMPANY_PRODUCT, 0x00000080, 0, 0);

// End controls

?>