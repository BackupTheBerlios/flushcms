<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_REVIEW_LIST')) define('IDC_REVIEW_LIST', 3051);
if(!defined('IDC_NAV_FIRST')) define('IDC_NAV_FIRST', 3052);
if(!defined('IDC_NAV_PRE')) define('IDC_NAV_PRE', 3053);
if(!defined('IDC_NAV_NEXT')) define('IDC_NAV_NEXT', 3054);
if(!defined('IDC_NAV_LAST')) define('IDC_NAV_LAST', 3055);
if(!defined('IDC_NAV_BAR')) define('IDC_NAV_BAR', 3056);

// Insert controls

wb_create_control($maintab, ListView, "Head1,Head2,Head3,Head4", 0, 10, 625, 425, IDC_REVIEW_LIST, 0x00050080, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_first_page"]}", 215, 450, 90, 25, IDC_NAV_FIRST, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_pre_page"]}", 320, 450, 90, 25, IDC_NAV_PRE, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_next_page"]}", 425, 450, 90, 25, IDC_NAV_NEXT, 0x00000000, 0, 0);
wb_create_control($maintab, PushButton, "{$wb->vars["Lang"]["lang_last_page"]}", 525, 450, 90, 25, IDC_NAV_LAST, 0x00000000, 0, 0);
wb_create_control($maintab, Label, "", 5, 455, 210, 15, IDC_NAV_BAR, 0x00000000, 0, 0);

// End controls

?>