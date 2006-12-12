<?php

/*******************************************************************************

 WINBINDER - A native Windows binding for PHP

 Copyright © 2004-2006 Hypervisual - see LICENSE.TXT for details
 Author: Rubem Pechansky (http://www.hypervisual.com/winbinder/contact.php)

 Code sample: A simple digital clock with scrolling text

*******************************************************************************/

//------------------------------------------------------------ SYSTEM PARAMETERS

//----------------------------------------------------------------- DEPENDENCIES

include_once "include/winbinder.php";

//-------------------------------------------------------------------- CONSTANTS

define("ID_APP_TIMER",	201);
define("SHORT_FMT",		"h:i:s A");
define("LONG_FMT",		"l, F dS, Y --- ");
define("WIDTH", 				150);
define("HEIGHT",				90);

//-------------------------------------------------------------- EXECUTABLE CODE

// Create main window, then assign a procedure to it
$dim = explode(" ", wb_get_system_info("workarea"));

$mainwin = wb_create_window(NULL, PopupWindow, "ÏÖÔÚÊ±¼ä", $dim[2] - WIDTH-30, $dim[3] -HEIGHT,WIDTH, HEIGHT, WBC_TOP | WBC_TASKBAR);
wb_set_handler($mainwin, "process_main");

// Create label control inside the window

$label = wb_create_control($mainwin, Label, getTimeShotFormat (date("h:i:s")), 0, 12, 112, 20, 0, WBC_CENTER);
wb_set_font($label, wb_create_font("Tahoma", 11, null, FTA_BOLD));

// Create status bar

$statusbar = wb_create_control($mainwin, StatusBar, formatLocalDate (date("Y-m-d H:i:s")));
wb_set_font($statusbar, wb_create_font("Courier New", 8));

// Create the timer

wb_create_timer($mainwin, ID_APP_TIMER, 520);

// Enter application loop

wb_main_loop();

//-------------------------------------------------------------------- FUNCTIONS

/* Process main window commands */

function process_main($window, $id)
{
	global $label, $statusbar;
	static $pos;

	switch($id) {

		case ID_APP_TIMER:

			// Show the current time in hours, minutes and seconds

			wb_set_text($label, getTimeShotFormat (date("h:i:s")));

			// Truncate text

			$text = formatLocalDate (date("Y-m-d H:i:s"));//date(LONG_FMT);
			if(ereg("11:4([0-9])",date("H:i")))
			{
					$text = "³ÔÖÐÎç·¹Ê±¼ä      ";
			}
			if(ereg("12:([0-9]{2})",date("H:i")))
			{
					$text = "ÖÐÎçÐÝÏ¢Ê±¼ä      ";
			}
			if(ereg("17:([4-5][0-9])",date("H:i")))
			{
					$text = "¼ÇµÃÐ´Ã¿ÈÕ¹¤×÷±¨¸æ      ";
			}
			$len = strlen($text);
			wb_set_text($statusbar, substr($text . $text, $pos, $len));//substr($text . $text, $pos, $len)
			$pos = $pos < $len ? $pos + 2 : 0;
			break;

		case IDCLOSE:

			wb_destroy_window($window);
			break;
    }
}

//------------------------------------------------------------------ END OF FILE

function getTimeShotFormat ($source_time,$en=false) 
{
	$patten = array("AM","PM");
	$replace = array("ÉÏÎç","ÏÂÎç");
	if ($en) 
	{
		return date("g:i:s A",strtotime($source_time)) ;
	}
	else
	{
		return str_replace($patten,$replace,date("A g:i:s ",strtotime($source_time))) ;
	}
} 

function formatLocalDate ($source_date) 
{
	$WeekOption = array(
				'0'=>"ÐÇÆÚÈÕ",
				'1'=>"ÐÇÆÚÒ»",
				'2'=>"ÐÇÆÚ¶þ",
				'3'=>"ÐÇÆÚÈý",
				'4'=>"ÐÇÆÚËÄ",
				'5'=>"ÐÇÆÚÎå",
				'6'=>"ÐÇÆÚÁù",
				);
	$unix_time = strtotime($source_date);
	$week = date("w");
	return date("YÄêmÔÂdÈÕ  ",$unix_time).$WeekOption[$week]."       ";
}

?>