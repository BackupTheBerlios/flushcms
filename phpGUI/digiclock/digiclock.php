<?php
/**
 *
 * digiclock.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: digiclock.php,v 1.5 2006/12/13 11:09:07 arzen Exp $
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

$label = wb_create_control($mainwin, Label, getTimeShotFormat (date("h:i:s")), 0, 12, 112, 20, 0, WBC_CENTER);
wb_set_font($label, wb_create_font("Tahoma", 11, null, FTA_BOLD));

// Create status bar

$statusbar = wb_create_control($mainwin, StatusBar, formatLocalDate (date("Y-m-d H:i:s")));
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
	global $label, $statusbar;
	static $pos;
	$news_str="";
	if (ereg("([0-5]0)",date("i"))) 
	{
		$news_str="滚动新闻:".getNews ();
	}
	$news_str=$news_str?$news_str:"滚动新闻:".getNews ();
	
	switch($id) {

		case ID_APP_TIMER:

			// Show the current time in hours, minutes and seconds

			wb_set_text($label, getTimeShotFormat (date("h:i:s A")));

			// Truncate text
			$text = formatLocalDate (date("Y-m-d H:i:s")).$news_str;//.$news_str;//date(LONG_FMT);
			if(ereg("11:4([0-9])",date("H:i")))
			{
					$text = "吃中午饭时间      ";
			}
			if(ereg("12:([0-9]{2})",date("H:i")))
			{
					$text = "中午休息时间      ";
			}
			if(ereg("17:([2-3][0-9])",date("H:i")))
			{
					$text = "记得写每日工作报告      ";
			}
			$len = strlen($text);
			wb_set_text($statusbar, mb_substr($text . $text, $pos, $len,"gb2312"));//substr($text . $text, $pos, $len) mb_substr($text . $text, $pos, $len,"gb2312")
			$pos = $pos < $len ? $pos + 2 : 0;
			break;
		case IDCLOSE:

			wb_destroy_window($window);
			break;
    }
}

//------------------------------------------------------------------ END OF FILE

function getNews () 
{
	$news_arr = array(
		'http://rss.sina.com.cn/news/marquee/ddt.xml'=>'新浪新闻',
		'http://rss.sina.com.cn/news/china/focus15.xml'=>'新浪国内',
	);
	$news_str = "";
	foreach ($news_arr as $rss_url=>$pervider)
	{
		$rss_content=mb_convert_encoding(getContentByCURL($rss_url), "GB2312", "UTF-8");;
		$news_str .=parseRssXML($rss_content,$pervider)  ;

	}
	return $news_str;
}

function getContentByCURL($request)
{
//	$session = curl_init($request);
//	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//	$response = curl_exec($session);
//	curl_close($session);

	$response = file_get_contents($request);
	return $response;
}

function parseRssXML($rss_content,$pervider)
{
	$match = array();
	$patten ="/<title>(.*)<\/title>/i";	
	preg_match_all ($patten,$rss_content, $match);
	$title_arr = $match[1];

	$patten ="/<pubDate>(.*)<\/pubDate>/i";	
	preg_match_all ($patten,$rss_content, $match_date);
	$date_arr = $match_date[1];

	$data = "";
	$i=0;
	foreach($title_arr as $key=>$value)
	{
		$data .=$value."(".date("Y-m-d H:i:s",strtotime($date_arr[$i]))."[{$pervider}])   ";
		$i++;
	}


	return $data;
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

?>