<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers


// Create window

$winmain = wb_create_window($wb->mainwin, ModalDialog, "{$wb->vars["Lang"]["system_name"]}", WBC_CENTER, WBC_CENTER, 258, 273, 0x00000001, 0);

// Insert controls

wb_create_control($winmain, PushButton, "{$wb->vars["Lang"]["lang_exit"]}", 80, 215, 90, 25, IDCANCEL, 0x00000000, 0, 0);
wb_create_control($winmain, Frame, "{$wb->vars["Lang"]["lang_about"]}", 5, 5, 240, 195, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["system_name"]}", 10, 55, 225, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_copyright"]}", 15, 90, 225, 35, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_copyright_phone"]}", 25, 135, 215, 15, 0, 0x00000000, 0, 0);
wb_create_control($winmain, Label, "{$wb->vars["Lang"]["lang_copyright_email"]}", 25, 170, 220, 15, 0, 0x00000000, 0, 0);

// End controls

?>