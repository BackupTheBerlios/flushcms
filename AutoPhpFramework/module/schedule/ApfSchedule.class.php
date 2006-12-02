<?php

/**
 *
 * ApfSchedule.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: ApfSchedule.class.php,v 1.3 2006/12/02 02:16:01 arzen Exp $
 */
require_once 'Calendar'.DIRECTORY_SEPARATOR.'Calendar.php';
require_once 'Calendar'.DIRECTORY_SEPARATOR.'Day.php';
require_once 'Calendar'.DIRECTORY_SEPARATOR.'Hour.php';
require_once 'Calendar'.DIRECTORY_SEPARATOR.'Decorator.php';
require_once 'DiaryEvent.class.php';

class ApfSchedule  extends Actions
{
	
	function executeAddsubmit()
	{
		$this->handleFormData();
	}
	
	
	function executeUpdatesubmit () 
	{
		$this->handleFormData(true);
	}

	function handleFormData($edit_submit=false)
	{
		global $template,$WebBaseDir,$i18n,$AddIP,$userid,$group_ids;
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');

		if ($edit_submit) 
		{
			$apf_schedule->get($apf_schedule->escape($_POST['ID']));
			$do_action = "updatesubmit";
		}
		else 
		{
			$do_action = "addsubmit";
		}

		$apf_schedule->setTitle(stripslashes(trim($_POST['title'])));
		$apf_schedule->setDescription(stripslashes(trim($_POST['description'])));
		$apf_schedule->setPublishDate(DB_DataObject_Cast::date(stripslashes(trim($_POST['publish_date']))));
		$apf_schedule->setPublishStarttime(DB_DataObject_Cast::time(stripslashes(trim($_POST['publish_starttime']))));
		$apf_schedule->setPublishEndtime(DB_DataObject_Cast::time(stripslashes(trim($_POST['publish_endtime']))));
		$apf_schedule->setImage(stripslashes(trim($_POST['image'])));
		$apf_schedule->setActive(stripslashes(trim($_POST['active'])));

		$apf_schedule->setAddIp($AddIP);
		$apf_schedule->setGroupid($group_ids);
		$apf_schedule->setUserid($userid);
				
		$val = $apf_schedule->validate();
		if ($val === TRUE)
		{
			if ($edit_submit) 
			{
				$apf_schedule->setUpdateAt(DB_DataObject_Cast::dateTime());
				$apf_schedule->update();
				$this->forward("schedule/apf_schedule/list/".$_POST['ID']."/ok");
			}
			else 
			{
				$apf_schedule->setCreatedAt(DB_DataObject_Cast::dateTime());
				$apf_schedule->insert();
				$this->forward("schedule/apf_schedule/");
			}
		}
		else
		{
			$template->setFile(array (
				"MAIN" => "apf_schedule_edit.html"
			));
			$template->setBlock("MAIN", "edit_block");
			$template->setVar(array (
				"WEBDIR" => $WebBaseDir,
				"DOACTION" => $do_action
			));
			foreach ($val as $k => $v)
			{
				if ($v == false)
				{
					$template->setVar(array (
						strtoupper($k)."_ERROR_MSG" => " &darr; ".$i18n->_("Please check here")." &darr; "
					));

				}
			}
			$template->setVar(
				array (
				"ID" => $_POST['id'],"TITLE" => $_POST['title'],"DESCRIPTION" => $_POST['description'],"PUBLISH_DATE" => $_POST['publish_date'],"PUBLISH_STARTTIME" => $_POST['publish_starttime'],"PUBLISH_ENDTIME" => $_POST['publish_endtime'],"IMAGE" => $_POST['image'],"ACTIVE" => $_POST['active'],"ADD_IP" => $_POST['add_ip'],"CREATED_AT" => $_POST['created_at'],"UPDATE_AT" => $_POST['update_at'],
				)
			 );

		}
	}
	
	function executeDel()
	{
		global $controller;
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');
		$apf_schedule->get($apf_schedule->escape($controller->getID()));
		$apf_schedule->setActive('deleted');
		$apf_schedule->update();
		$this->forward("schedule/apf_schedule/");
	}
	
	function executeList()
	{
		global $template,$i18n,$WebBaseDir,$WebTemplateDir,$controller,$ClassDir,$TemplateDir,$TimeOption,$ActiveOption;

		include_once($ClassDir."URLHelper.class.php");
		$template->setFile(array (
			"MAIN" => "apf_schedule_list.html"
		));
		$do_action = "AddSubmit";

		$template->setBlock("MAIN", "main_list", "list_block");
//		set default day or get select day
		if ($_REQUEST['y'] && $_REQUEST['m'] && $_REQUEST['d']) 
		{
			$select_y=$_REQUEST['y'];
			$select_m=$_REQUEST['m'];
			$select_d=$_REQUEST['d'];
		}
		else
		{
			$next_week_time = $this->getDefaultDate ();
			$select_y=date("Y",$next_week_time);
			$select_m=date("m",$next_week_time);
			$select_d=date("d",$next_week_time);
		}
		
		$start_time = "";
		$end_time = "";
		$image_string = "";
		$active = "new";
		$used_hours_arr=array();
		$CalDailyView = $this->renderDayView($select_y,$select_m,$select_d,$used_hours_arr);
		$un_use_hour_arr = array_diff($TimeOption,$used_hours_arr);
		
		if ($controller->getID()) 
		{
			$un_use_hour_arr = $TimeOption;
			$apf_schedule = DB_DataObject :: factory('ApfSchedule');
			$apf_schedule->get($apf_schedule->escape($controller->getID()));
			$do_action = "UpdateSubmit";
	
			if ($controller->getURLParam(1)=="ok") 
			{
				$template->setVar(array (
					"SUCCESS_CLASS" => "save-ok",
					"SUCCESS_MSG" => "<h2>".$i18n->_("Your modifications have been saved")."</h2>"
				));
			}
			
			$template->setVar(array ("ID" => $apf_schedule->getId(),"TITLE" => $apf_schedule->getTitle(),"DESCRIPTION" => $apf_schedule->getDescription(),"PUBLISH_DATE" => $apf_schedule->getPublishDate(),"PUBLISH_STARTTIME" => $apf_schedule->getPublishStarttime(),"PUBLISH_ENDTIME" => $apf_schedule->getPublishEndtime(),"IMAGE" => $apf_schedule->getImage(),"ACTIVE" => $apf_schedule->getActive(),"ADD_IP" => $apf_schedule->getAddIp(),"CREATED_AT" => $apf_schedule->getCreatedAt(),"UPDATE_AT" => $apf_schedule->getUpdateAt(),));			$start_time = $this->shorTimeFormat($apf_schedule->getPublishStarttime());
			$end_time = $this->shorTimeFormat($apf_schedule->getPublishEndtime());
			$image_string= $apf_schedule->getImage();
			$active = $apf_schedule->getActive();
		}
		else if ($_REQUEST['act'] =="ExportWeek") 
		{
			$this->exportWeek();
		}
		array_shift($ActiveOption);
		$template->setVar(array (
			"WEBDIR" => $WebBaseDir,
			"WEBTEMPLATEDIR" => URLHelper::getWebBaseURL ().$WebTemplateDir,
			"PUBLISHDATE" => inputDateTag ("publish_date","{$select_y}-{$select_m}-{$select_d}"),
			"IMAGES_FILE" => fileTag ('image',$image_string),
			"STATUS_FIELD" => selectTag ('active',$ActiveOption,$active),
			"PUBLISH_STARTTIME_OPTION" => selectTag ('publish_starttime',$un_use_hour_arr,$start_time),
			"PUBLISH_ENDTIME_OPTION" => selectTag ('publish_endtime',$un_use_hour_arr,$end_time),
			"DOACTION" => $do_action,
			"LEFT_CALENDAR" => $this->renderMonthView(),
			"DAY_VIEW" => $CalDailyView,
			"PUBLISH_DATE" => "{$select_y}-{$select_m}-{$select_d}",
			"Y" => $select_y,
			"M" => $select_m,
			"D" => $select_d,
		));
	}
	
	function renderDayView ($y,$m,$d,&$used_hours_arr) 
	{
		global $TemplateDir,$template,$Upload_Dir,$WebTemplateDir,$WebBaseDir,$ClassDir,$ActiveOption,$userid;
		
		include_once($ClassDir."URLHelper.class.php");
		// Create a day to view the hours for
		$Day = & new Calendar_Day($y,$m,$d);
		$selection = array();
		// search specify day webcasts
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');
		$apf_schedule->setPublishDate(DB_DataObject_Cast::date($y,$m,$d));
//		$apf_schedule->debugLevel(4);
		$apf_schedule->setUserid($userid);
		$apf_schedule->find();
		$result=array();
		$SHOW_CONFIRM_BUTTON = true;
		$selected_hours=0;
		while ($apf_schedule->fetch())
		{
		    $row = $apf_schedule->toArray();
		    $start_hour=$this->getHourByTime($apf_schedule->getPublishStarttime());
		    $end_hour=$this->getHourByTime($apf_schedule->getPublishEndtime());
		    if ($row['webcast_status']!='file' && !$row['webcast_file']) 
			{
				$SHOW_CONFIRM_BUTTON = false;
			}
			for ($index = $start_hour; $index <= $end_hour; $index++) 
			{
				$used_hours_arr["{$index}:00:00"]="{$index}:00";
			}
			$selected_hours +=$end_hour-$start_hour+1;
		    $Hour = new Calendar_Hour(2000,1,1,1); // Create Hour with dummy values
		    $Hour->setTimeStamp(mktime($start_hour,0,0,$m,$d,$y)); // Set the real time with setTimeStamp

		    // Create the decorator, passing it the Hour
		    $DiaryEvent = new DiaryEvent($Hour);
		    // Attach the payload
		    $DiaryEvent->setEndHour($end_hour);
		    $DiaryEvent->setID($row['webcast_id']);
		    $DiaryEvent->setItemNum($row['NUM']);
		    $DiaryEvent->setStatu($row['active']);
		    $DiaryEvent->setImages($row['image']?popFile($Upload_Dir.$row['image']):"");
		    $DiaryEvent->setEntry("<a href=\"{$WebBaseDir}/schedule/apf_schedule/list/".$row['id']."\">".$apf_schedule->getTitle()."</a>");
		
		    // Add the decorator to the selection
		    $selection[] = $DiaryEvent;

		}
		if ($selected_hours<24) 
		{
			$SHOW_CONFIRM_BUTTON = false;
		}
		if ($SHOW_CONFIRM_BUTTON) 
		{
			$template->setVar(array (
				"CONFIRM_LINK" => '<li><input type="submit" name="save" value="Status To Confirm" class="admin_action_cancel" onclick="if (confirm(\'Are you sure?\')) { document.admin_list_form.todo.value=\'confirm\';document.admin_list_form.submit(); };return false;" /></li>',
			));
			
		}
		$Day->build($selection);
		
		$Day_String = "";
		$DayViewTitle =  date('D d F Y',$Day->thisDay(TRUE));
		$temp_end_hour = "";
		while ( $Hour = & $Day->fetch() ) {
		
		    $hour = $Hour->thisHour();
		    $minute = $Hour->thisMinute();
		
		    // Office hours only...
		    if ( $hour >= 0 && $hour <= 24 ) {
		        $Day_String .= ( "<tr class=\"calnone\">\n" );
		        $Day_String .= ( "<td>$hour:$minute</td>\n" );
		
		        // If the hour is selected, call the decorator method...
		        
		        if ( $Hour->isSelected() ) {
		            $temp_end_hour = $Hour->getEndHour();
		            $merge_hour=$temp_end_hour-$hour+1;
		            $css_class_name = "calentryfilled_".$Hour->getStatu();
		            $Day_String .= ( "<td rowspan=\"{$merge_hour}\" class=\"{$css_class_name}\"><INPUT TYPE=\"checkbox\" NAME=\"SelectID[]\" value=\"".$Hour->getID()."\"></td><td class=\"{$css_class_name}\" rowspan=\"{$merge_hour}\">".$Hour->getEntry()."</td><td rowspan=\"{$merge_hour}\">&nbsp;".$Hour->getItemNum()."</td><td rowspan=\"{$merge_hour}\">&nbsp;".$Hour->getImages()."</td><td rowspan=\"{$merge_hour}\">&nbsp;".$ActiveOption[$Hour->getStatu()]."</td><td rowspan=\"{$merge_hour}\"><ul class=\"admin_td_actions\">
  <li><a href=\"webcast.php?act=Update&y={$y}&m={$m}&d={$d}&ID=".$Hour->getID()."\"><img alt=\"edit\" title=\"edit\" src=\"".URLHelper::getWebBaseURL ().$WebTemplateDir."/images/edit_icon.png\" /></a></li>
  <li><a onclick=\"if (confirm('Are you sure?')) { f = document.createElement('form'); document.body.appendChild(f); f.method = 'POST'; f.action = this.href; f.submit(); };return false;\" href=\"webcast.php?act=Del&y={$y}&m={$m}&d={$d}&ID=".$Hour->getID()."\"><img alt=\"delete\" title=\"delete\" src=\"".URLHelper::getWebBaseURL ().$WebTemplateDir."/images/delete_icon.png\" /></a></li>
</ul></td>\n" );
		        } 
		        else if ($temp_end_hour && $hour<=$temp_end_hour) 
				{
					$Day_String .="";
				} 
		        else
		        {
		            $Day_String .= ( "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>\n" );
		        }
		        $Day_String .= ( "</tr>\n" );
		    }
		}
		$calendar_str = <<<EOD
<table>
<caption><b>Your Schedule for {$DayViewTitle} </b></caption>
<tr class="calentryhead">
<th width="5%">Time</th>
<th width="1%">&nbsp;<input type="checkbox" onClick="selectAll(this.checked,'SelectID[]')"/></th>
<th>Entry</th>
<th width="3%">Items</th>
<th width="10%">Image</th>
<th width="5%">Status</th>
<th width="5%">Action</th>
</tr>
{$Day_String}
</table>
EOD;
		return $calendar_str;
	}
	
	function renderMonthView () 
	{
		global $TemplateDir,$ClassDir,$WebTemplateDir,$userid;
		require_once 'Calendar'.DIRECTORY_SEPARATOR.'Month/Weeks.php';
		require_once 'Calendar'.DIRECTORY_SEPARATOR.'Util'.DIRECTORY_SEPARATOR.'Textual.php';
		include_once($ClassDir."URLHelper.class.php");
		
		// Initialize GET variables if not set
		if (!isset($_GET['y'])) $_GET['y'] = date('Y');
		if (!isset($_GET['m'])) $_GET['m'] = date('m');
		if (!isset($_GET['d'])) $_GET['d'] = date('d');
		
		// Build a month object
		$Month = new Calendar_Month_Weeks($_GET['y'], $_GET['m'],0);
		
		// count select month webcasts
		$apf_schedule = DB_DataObject :: factory('ApfSchedule');
		$apf_schedule->selectAdd('publish_date , COUNT(*) AS NUM');
		$apf_schedule->whereAdd(" DATE_FORMAT(publish_date,'%Y-%m') = '{$_GET['y']}-{$_GET['m']}' ");
//		$apf_schedule->whereAdd("userid='{$userid}'");
		$apf_schedule->setUserid($userid);
		$apf_schedule->groupBy('publish_date');
//		$apf_schedule->debugLevel(4);
		$apf_schedule->find();
		$month_webcast=array();
		while ($apf_schedule->fetch())
		{
			$month_webcast[date("Y-m-j",strtotime($apf_schedule->getPublishDate()))]=$apf_schedule->NUM;
		}
//		Var_Dump::display($month_webcast);
		// Used for Week::build() below
		$selectedDays = array (
		    new Calendar_Day(date('Y'), date('m'), date('d')),
		    );
		
		// Instruct month to build Week objects
		$Month->build();
		
		// Construct strings for next/previous links
		$PMonth = $Month->prevMonth('object'); // Get previous month as object
		$prev = $_SERVER['PHP_SELF'].'?y='.$PMonth->thisYear().'&m='.$PMonth->thisMonth().'&d='.$PMonth->thisDay();
		$NMonth = $Month->nextMonth('object');
		$next = $_SERVER['PHP_SELF'].'?y='.$NMonth->thisYear().'&m='.$NMonth->thisMonth().'&d='.$NMonth->thisDay();
		$today_link = $_SERVER['PHP_SELF'].'?y='.date("Y").'&m='.date("m").'&d='.date("d");
		
		$calendar_title = date('F Y', $Month->getTimeStamp());
		$main_calendar = "";
		while ($Week = $Month->fetch()) {
		    $main_calendar .= "<tr valign='top'>\n";
		    // Build the days in the week, passing the selected days
		    $Week->build($selectedDays);
		    $i=0;
		    $temp_week_string = "";
		    $week_days = array();
		    while ($Day = $Week->fetch()) {
		
		        // Build a link string for each day
		        $link = $_SERVER['PHP_SELF'].
		                    '?y='.$Day->thisYear().
		                    '&m='.$Day->thisMonth().
		                    '&d='.$Day->thisDay();
		        $data_string = $Day->thisYear()."-".$Day->thisMonth()."-".$Day->thisDay();
				$apf_schedule_num = $month_webcast["{$data_string}"]?$month_webcast["{$data_string}"]:0;
				$week_days[] = $data_string;
		        // Check to see if day is selected
		        if ($Day->isSelected()) {
		            $temp_week_string .= '<td class="calCellBusy"><div class="dayNumber"><a href="'.$link.'">'.$Day->thisDay().'</a></div><div class="dayContents">'.$apf_schedule_num.'</div></td>'."\n";
		        // Check to see if day is empty
		        } else if ($Day->isEmpty()) {
		            $temp_week_string .= '<td class="calCellEmpty"><div class="dayNumber">'.$Day->thisDay().'</div></td>'."\n";
		        } else {
		            $temp_week_string .= '<td class="calCell" ><div class="dayNumber"><a href="'.$link.'" >'.$Day->thisDay().'</a></div><div class="dayContents">'.$apf_schedule_num.'</div></td>'."\n";
		        }
		        $i++;
		    }
		    $WeekNum = (date('W',strtotime($week_days[0])));
            $main_calendar .= '<td class="week"><a href="###" onclick="document.admin_left_cal.act.value=\'ExportWeek\';document.admin_left_cal.weekdays.value=\''.implode(",",$week_days).'\';document.admin_left_cal.week.value=\''.$WeekNum.'\';document.admin_left_cal.submit();" ><img src="'.URLHelper::getWebBaseURL ().$WebTemplateDir.'/images/xls_image_inline.gif" border="0" valign="middle" />'.$WeekNum.'</a></td>'."\n";//"-".$Week->thisDay().
		    $main_calendar .=$temp_week_string;
		    $main_calendar .= '</tr>'."\n";
		}
		
		$cal_header_string = "";
		$dayheaders = Calendar_Util_Textual::orderedWeekdays($Month,'short');
	    $cal_header_string .= '<th class="week">wk</th>';
	    $i=0;
		foreach ($dayheaders as $dayheader) 
		{
		    if ($i==0 || $i==6) 
			{
				$head_class= "class=\"calholiday\"";
			}
			else
			{
				$head_class="";
			}
		    $cal_header_string .= '<th '.$head_class.'>'.$dayheader.'</th>';
		    $i++;
		}
		
		$calendar_str = <<<EOD
<table class="month" cellspacing="0" cellpadding="0">
<caption>
<a href="{$prev}" > << </a> <b>{$calendar_title} <A href="{$today_link}" class="calholiday">Today</a> </b> <a href="{$next}"> >> </a>
</caption>
<tr class="calheader">
{$cal_header_string}
</tr>
{$main_calendar}
</table>
EOD;
		return $calendar_str;
	}
	
	function getHourByTime ($time) 
	{
		return date("G",strtotime($time));
	}
	
	function shorTimeFormat ($time) 
	{
		return date("G:i:s",strtotime($time));
	}
	
	function formatWeekDays ($source) 
	{
		$pattern = "/([^,]*)/";
		$replace="\"\\1";
		return preg_replace($pattern,$replace,$source);
	}
	
	function stringUtf8ToBig5 ($source) 
	{
		return mb_convert_encoding($source, "BIG-5", "UTF-8");
	}
	
	function getDefaultDate () 
	{
		return strtotime("This Sunday");
	}	
	
}
?>