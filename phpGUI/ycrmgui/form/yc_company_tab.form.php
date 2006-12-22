<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_COMPANY_LIST')) define('IDC_COMPANY_LIST', 1301);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 1302);
if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 1303);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 1304);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 1305);
if(!defined('IDC_NAV_BAR')) define('IDC_NAV_BAR', 1306);

// Insert controls

wb_create_control($maintab, ListView, "Head1,Head2,Head3,Head4", 0, 10, 630, 425, IDC_COMPANY_LIST, 0x00010080, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_first_page"]}", 190, 450, 90, 25, IDC_NAV_FIRST, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_pre_page"]}", 300, 450, 90, 25, IDC_NAV_PRE, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_next_page"]}", 410, 450, 90, 25, IDC_NAV_NEXT, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_last_page"]}", 515, 450, 90, 25, IDC_NAV_LAST, 0x00000000, 0, 0);
wb_create_control($maintab, Label, "Label6", 25, 455, 155, 15, IDC_NAV_BAR, 0x00000000, 0, 0);

// End controls

?>