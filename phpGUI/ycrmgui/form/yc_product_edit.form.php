<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_PRODUCT_NAME')) define('IDC_PRODUCT_NAME', 1371);
if(!defined('IDC_SAVE')) define('IDC_SAVE', 1372);
if(!defined('IDC_PRODUCT_PRICE')) define('IDC_PRODUCT_PRICE', 1373);
if(!defined('IDC_PRODUCT_MEMO')) define('IDC_PRODUCT_MEMO', 1374);
if(!defined('IDC_UPDATE')) define('IDC_UPDATE', 1375);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_new"]}/{$wb->vars["Lang"]["lang_edit"]} {$wb->vars["Lang"]["lang_product"]}", WBC_CENTER, WBC_CENTER, 505, 274, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_name"]}", 10, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 80, 5, 395, 20, IDC_PRODUCT_NAME, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 135, 215, 90, 25, IDC_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_price"]}", 10, 45, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 80, 40, 120, 20, IDC_PRODUCT_PRICE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 10, 80, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 80, 70, 405, 120, IDC_PRODUCT_MEMO, 0x00000080, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 255, 215, 90, 25, IDC_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 370, 215, 90, 25, IDCANCEL, 0x00000000, 0, 0);

// End controls

?>