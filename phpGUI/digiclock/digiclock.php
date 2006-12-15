<?php
/**
 *
 * digiclock.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: digiclock.php,v 1.9 2006/12/15 02:39:53 arzen Exp $
 */
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

$mainwin = wb_create_window(NULL, PopupWindow, "现在时间", $dim[2] - WIDTH-30, $dim[3] -HEIGHT,WIDTH, HEIGHT, WBC_TOP | WBC_TASKBAR);
wb_set_handler($mainwin, "process_main");

// Create label control inside the window

$label = wb_create_control($mainwin, Label, getTimeShotFormat (date("h:i:s")), 0, 15, 108, 20, 0, WBC_CENTER);
wb_set_font($label, wb_create_font("Tahoma", 11, null, FTA_BOLD));

$label_week = wb_create_control($mainwin, Label, formatLocalWeek (date("Y-m-d H:i:s")), 102, 2, 50, 15, 0, WBC_CENTER);
$label_day = wb_create_control($mainwin, Label, date("m月d"), 102, 15, 50, 15, 0, WBC_CENTER);
$label_year = wb_create_control($mainwin, Label, date("Y年"), 102, 30, 50, 15, 0, WBC_CENTER);
wb_set_font($label_week, wb_create_font("Tahoma", 8));
wb_set_font($label_day, wb_create_font("Tahoma", 8));
wb_set_font($label_year, wb_create_font("Tahoma", 8));

// Create status bar
$top_bar = wb_create_control($mainwin, Label, "", 10, 2, 100, 10, 0, WBC_CENTER);
wb_set_font($top_bar, wb_create_font("Simsun", 8));

$foot_bar = wb_create_control($mainwin, Label, '', 0, 35, 100, 10, 0, WBC_CENTER);
wb_set_font($foot_bar, wb_create_font("Simsun", 8));

$statusbar = wb_create_control($mainwin, StatusBar, "");
wb_set_font($statusbar, wb_create_font("Simsun", 10));

// Create the timer

wb_create_timer($mainwin, ID_APP_TIMER, 500);

// Enter application loop
wb_set_image($mainwin,"resource/time.ico");
wb_main_loop();
//-------------------------------------------------------------------- FUNCTIONS

/* Process main window commands */

function process_main($window, $id)
{
	global $label, $statusbar,$top_bar,$foot_bar,$news_str;
	static $pos,$top_pos,$foot_pos;

	$disks_str = "";
	if ((date("H")/2)==0) 
	{
		$news_str="滚动新闻:".getNews ();
		
		$disks = explode(" ", wb_get_system_info("diskdrives"));
		for ($index = 0; $index < sizeof($disks); $index++) 
		{
			$disks_str .= getTotalDiskSpace ($disks[$index]);
		}
		
	}
	$news_str=$news_str?$news_str:"滚动新闻:".getNews ();
	
	switch($id) {

		case ID_APP_TIMER:

			// Show the current time in hours, minutes and seconds

			wb_set_text($label, getTimeShotFormat (date("h:i:s A")));

			// Truncate text
			$text = $news_str;
//			$text = formatLocalDate (date("Y-m-d H:i:s")).$news_str;//.$news_str;//date(LONG_FMT);
			$len = strlen($text);
			wb_set_text($statusbar, mb_substr($text . $text, $pos, $len,"gb2312"));//substr($text . $text, $pos, $len) mb_substr($text . $text, $pos, $len,"gb2312")
			$pos = $pos < $len ? $pos + 2 : 0;
	
			$top_text="....>........";
			if(ereg("11:4([0-9])",date("H:i")))
			{
					$top_text = "吃中午饭时间";
			}
			if(ereg("12:([0-9]{2})",date("H:i")))
			{
					$top_text = "中午休息时间";
			}
			if(ereg("17:([2-3][0-9])",date("H:i")))
			{
					$top_text = "记得写每日工作报告";
			}
			$top_len = strlen($top_text);
			wb_set_text($top_bar, mb_substr($top_text . $top_text, $top_pos, $top_len,"gb2312"));//substr($text . $text, $pos, $len) mb_substr($text . $text, $pos, $len,"gb2312")
			$top_pos = $top_pos > 0 ? $top_pos - 1 : $top_len;

			$foot_len = strlen($disks_str);
			wb_set_text($foot_bar, mb_substr($disks_str . $disks_str, $foot_pos, $foot_len,"gb2312"));//substr($text . $text, $pos, $len) mb_substr($text . $text, $pos, $len,"gb2312")
			$foot_pos = $foot_pos < $foot_len  ? $foot_pos +1 : 0;
			
			break;
		case IDCLOSE:

			wb_destroy_window($window);
			break;
    }
}

//------------------------------------------------------------------ END OF FILE

function getTotalDiskSpace ($disk) 
{
	$M = 1024*1024*1024;
	$total = round(disk_total_space($disk)/$M, 2);
	$free = round(disk_free_space($disk)/$M, 2);
	return "$disk{$free}/$totalG";
}

function getNews () 
{
	if (file_exists("news.txt")) 
	{
		$news_str = file_get_contents("news.txt");
	}
	else 
	{
		$news_str = "无新闻.......";
	}
	return $news_str;
}



function getTimeShotFormat ($source_time,$en=false) 
{
	$patten = array("AM","PM");
	$replace = array("上午","下午");
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
				'0'=>"星期日",
				'1'=>"星期一",
				'2'=>"星期二",
				'3'=>"星期三",
				'4'=>"星期四",
				'5'=>"星期五",
				'6'=>"星期六",
				);
	$unix_time = strtotime($source_date);
	$week = date("w");
	return date("Y年m月d日  ",$unix_time).$WeekOption[$week]."       ";
}

function formatLocalWeek ($source_date) 
{
	$WeekOption = array(
				'0'=>"星期日",
				'1'=>"星期一",
				'2'=>"星期二",
				'3'=>"星期三",
				'4'=>"星期四",
				'5'=>"星期五",
				'6'=>"星期六",
				);
	$unix_time = strtotime($source_date);
	$week = date("w");
	return $WeekOption[$week];
}

?>