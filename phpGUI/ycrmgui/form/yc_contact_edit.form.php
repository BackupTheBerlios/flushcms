<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_CONTACT_USERNAME')) define('IDC_CONTACT_USERNAME', 1101);
if(!defined('IDC_GENDER_MALE')) define('IDC_GENDER_MALE', 1102);
if(!defined('IDC_GENDER_FEMALE')) define('IDC_GENDER_FEMALE', 1103);
if(!defined('IDC_CONTACT_SAVE')) define('IDC_CONTACT_SAVE', 1104);
if(!defined('IDC_CONTACT_BIRTHDAY')) define('IDC_CONTACT_BIRTHDAY', 1105);
if(!defined('IDC_CONTACT_ADDREES')) define('IDC_CONTACT_ADDREES', 1106);
if(!defined('IDC_CONTACT_OFFICEPHONE')) define('IDC_CONTACT_OFFICEPHONE', 1107);
if(!defined('IDC_CONTACT_PHONE')) define('IDC_CONTACT_PHONE', 1108);
if(!defined('IDC_CONTACT_FAX')) define('IDC_CONTACT_FAX', 1109);
if(!defined('IDC_CONTACT_MOBILE')) define('IDC_CONTACT_MOBILE', 1110);
if(!defined('IDC_CONTACT_EMAIL')) define('IDC_CONTACT_EMAIL', 1111);
if(!defined('IDC_CONTACT_HOMEPAGE')) define('IDC_CONTACT_HOMEPAGE', 1112);
if(!defined('IDC_CONTACT_MEMO')) define('IDC_CONTACT_MEMO', 1113);
if(!defined('IDC_CONTACT_UPDATE')) define('IDC_CONTACT_UPDATE', 1114);

// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["lang_contact"]}", WBC_CENTER, WBC_CENTER, 605, 492, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_name"]}", 5, 5, 45, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 5, 200, 20, IDC_CONTACT_USERNAME, 0x00000000, 0, 0);
wb_create_control($winmain, Frame, "{$wb->vars["Lang"]["lang_gender"]}", 80, 25, 150, 35, 0, 0x00000000, 0, 0);
wb_create_control($winmain, RadioButton, "{$wb->vars["Lang"]["lang_male"]}", 95, 40, 60, 15, IDC_GENDER_MALE, 0x00000000, 0, 0);
wb_create_control($winmain, RadioButton, "{$wb->vars["Lang"]["lang_female"]}", 160, 40, 60, 15, IDC_GENDER_FEMALE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_save"]}", 145, 425, 90, 25, IDC_CONTACT_SAVE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_birthday"]}", 5, 65, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 65, 200, 20, IDC_CONTACT_BIRTHDAY, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_addrees"]}", 5, 235, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_officephone"]}", 5, 185, 60, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 235, 510, 20, IDC_CONTACT_ADDREES, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 185, 200, 20, IDC_CONTACT_OFFICEPHONE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_phone"]}", 5, 110, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 110, 200, 20, IDC_CONTACT_PHONE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_fax"]}", 285, 185, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 340, 185, 235, 20, IDC_CONTACT_FAX, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_mobile"]}", 5, 145, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 145, 200, 20, IDC_CONTACT_MOBILE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_email"]}", 5, 275, 50, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 275, 205, 20, IDC_CONTACT_EMAIL, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_homepage"]}", 280, 275, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 345, 275, 230, 20, IDC_CONTACT_HOMEPAGE, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_memo"]}", 5, 325, 55, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, EditBox, "", 65, 310, 510, 110, IDC_CONTACT_MEMO, 0x00000000, 0, 0);
wb_create_control($winmain, Frame, "{$wb->vars["Lang"]["lang_photo"]}", 350, 0, 180, 130, 0, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_edit"]}", 265, 425, 90, 25, IDC_CONTACT_UPDATE, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_cancel"]}", 385, 425, 90, 25, IDCANCEL, 0x00000000, 0, 0);

// End controls

?>