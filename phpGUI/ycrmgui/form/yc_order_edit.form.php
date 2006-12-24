<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_ORDER_NOID')) define('IDC_ORDER_NOID', 1371);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 1372);
if(!defined('IDC_ORDER_LINK_MAN')) define('IDC_ORDER_LINK_MAN', 1373);
if(!defined('IDC_ORDER_PAYWAY')) define('IDC_ORDER_PAYWAY', 1374);
if(!defined('IDC_ORDER_PRODUCT')) define('IDC_ORDER_PRODUCT', 1375);
if(!defined('IDC_ORDER_AMOUNT')) define('IDC_ORDER_AMOUNT', 1376);
if(!defined('IDC_ORDER_MONEY')) define('IDC_ORDER_MONEY', 1377);
if(!defined('IDC_ORDER_DELIVERYWAY')) define('IDC_ORDER_DELIVERYWAY', 1378);
if(!defined('IDC_ORDER_DELIVERYDATETIME')) define('IDC_ORDER_DELIVERYDATETIME', 1379);
if(!defined('IDC_ORDER_MEMO')) define('IDC_ORDER_MEMO', 1380);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 1381);
if(!defined('IDC_ORDER_DISCOUNT')) define('IDC_ORDER_DISCOUNT', 1382);
if(!defined('IDC_ORDER_STATE')) define('IDC_ORDER_STATE', 1383);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_order"]}", WBC_CENTER, WBC_CENTER, 597, 404, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_noid"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 200, 20, IDC_ORDER_NOID, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 145, 340, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_contact"]}", 285, 5, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 5, 200, 20, IDC_ORDER_LINK_MAN, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_payway"]}", 10, 135, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_product"]}", 5, 45, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 130, 180, 20, IDC_ORDER_PAYWAY, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 45, 200, 20, IDC_ORDER_PRODUCT, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_amount"]}", 280, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 45, 200, 20, IDC_ORDER_AMOUNT, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_money"]}", 5, 85, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 85, 200, 20, IDC_ORDER_MONEY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_deliveryway"]}", 280, 130, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 130, 205, 20, IDC_ORDER_DELIVERYWAY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_deliverydatetime"]}", 5, 165, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 165, 190, 20, IDC_ORDER_DELIVERYDATETIME, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 5, 230, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 205, 510, 125, IDC_ORDER_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 340, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 390, 340, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_money"]}{$wb->vars["Lang"]["lang_discount"]}", 285, 85, 70, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 85, 195, 20, IDC_ORDER_DISCOUNT, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_state"]}", 285, 165, 60, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 355, 165, 200, 20, IDC_ORDER_STATE, 0x00000000, 0, 0);

// End controls

?>