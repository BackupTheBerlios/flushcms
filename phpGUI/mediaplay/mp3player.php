<?php
/**
 *
 * mp3player.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: mp3player.php,v 1.1 2006/12/15 02:39:52 arzen Exp $
 */
//------------------------------------------------------------ SYSTEM PARAMETERS

define("PATH_SCRIPT",   dirname(__FILE__) . "/");
define("PATH_DATA",      PATH_SCRIPT);
define("PATH_INC",      PATH_SCRIPT . "include/");
define("PATH_RES",      PATH_SCRIPT . "resources/");

//----------------------------------------------------------------- DEPENDENCIES

include_once "include/winbinder.php";

//-------------------------------------------------------------------- CONSTANTS

define("APPNAME",           "MP3");    // Application name

// Control identifiers

define("ID_OPEN",           101);

//-------------------------------------------------------------- EXECUTABLE CODE

// Create main window, then assign a procedure and an icon to it

$mainwin = wb_create_window(NULL, AppWindow, APPNAME, 220, 100);
wb_set_handler($mainwin, "process_main");

// Create menu

wb_create_control($mainwin, Menu, array(
    "&File",
        array(ID_OPEN,  "&Open...\tCtrl+O", NULL, NULL, "Ctrl+O"),
        null,           // Separator
        array(IDCLOSE,  "E&xit\tAlt+F4",    NULL, NULL, "Alt+F4"),
));


// Enter application loop

wb_main_loop();

//-------------------------------------------------------------------- FUNCTIONS

/* Process main window commands */

function process_main($window, $id)
{
    // Try to load the multimedia dll
   $winmmlib = wb_load_library("winmm");
   $mciSendString = wb_get_function_address("mciSendString", $winmmlib);

    static $file_filter = array(
        array("MP3 file",    "*.mp3")
    );

    switch($id) {

        case ID_OPEN:
            $filename = wb_sys_dlg_open($window, "Get It", $file_filter);
            if($filename)
            wb_call_function($mciSendString, array("open \"" . $filename . "\" type mpegvideo alias " . $filename, NULL,0,0));
            wb_call_function($mciSendString, array("play \"" . $filename ."\" from 0 notify", NULL,0,0));
            break;

        case IDCLOSE:       // IDCLOSE is predefined
            wb_destroy_window($window);
            break;
    }
}

//------------------------------------------------------------------ END OF FILE

?>

