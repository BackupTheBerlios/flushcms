<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_REFUNDMENT_CATEGORY_LIST')) define('IDC_REFUNDMENT_CATEGORY_LIST', 2901);
if(!defined('IDC_CATEGORY_NAV_FIRST')) define('IDC_CATEGORY_NAV_FIRST', 2902);
if(!defined('IDC_CATEGORY_NAV_PRE')) define('IDC_CATEGORY_NAV_PRE', 2903);
if(!defined('IDC_CATEGORY_NAV_NEXT')) define('IDC_CATEGORY_NAV_NEXT', 2904);
if(!defined('IDC_CATEGORY_NAV_LAST')) define('IDC_CATEGORY_NAV_LAST', 2905);
if(!defined('IDC_CATEGORY_NAV_BAR')) define('IDC_CATEGORY_NAV_BAR', 2906);

// Insert controls

wb_create_control($maintab, ListView, "Head1,Head2,Head3,Head4", 0, 10, 625, 425, IDC_REFUNDMENT_CATEGORY_LIST, 0x00050080, 0, 1);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_first_page"]}", 215, 450, 90, 25, IDC_CATEGORY_NAV_FIRST, 0x00000000, 0, 1);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_pre_page"]}", 320, 450, 90, 25, IDC_CATEGORY_NAV_PRE, 0x00000000, 0, 1);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_next_page"]}", 425, 450, 90, 25, IDC_CATEGORY_NAV_NEXT, 0x00000000, 0, 1);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_last_page"]}", 525, 450, 90, 25, IDC_CATEGORY_NAV_LAST, 0x00000000, 0, 1);
wb_create_control($maintab, Label, "", 5, 455, 210, 15, IDC_CATEGORY_NAV_BAR, 0x00000000, 0, 1);

// End controls

?>