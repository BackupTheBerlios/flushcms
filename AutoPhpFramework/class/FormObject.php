<?php
/**
 *
 * FormObject.php class.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @version    CVS: $Id: FormObject.php,v 1.21 2006/12/11 23:40:53 arzen Exp $
 */

/**
 * @author John.meng
 * @example 
 * textTag ('q','php')
 * 
 */ 
function textTag ($name,$value="",$extend="") 
{

	$html_code ="<INPUT TYPE=\"text\" NAME=\"{$name}\" VALUE=\"{$value}\" {$extend} >";
	return $html_code;
	
}

function textareaTag ($name,$value="",$rich=false,$extend=" ROWS=\"30\" COLS=\"110\" ") 
{
	global $WebJSToolkitPath;
	$html_code = "";
	if ($rich) 
	{
		$tiny_mce_dir = $WebJSToolkitPath."tiny_mce/";
		$html_code .= <<<EOD
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="{$tiny_mce_dir}tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
	});

	// Custom event handler
	function myCustomExecCommandHandler(editor_id, elm, command, user_interface, value) {
		var linkElm, imageElm, inst;

		switch (command) {
			case "mceLink":
				inst = tinyMCE.getInstanceById(editor_id);
				linkElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "a");

				if (linkElm)
					alert("Link dialog has been overriden. Found link href: " + tinyMCE.getAttrib(linkElm, "href"));
				else
					alert("Link dialog has been overriden.");

				return true;

			case "mceImage":
				inst = tinyMCE.getInstanceById(editor_id);
				imageElm = tinyMCE.getParentElement(inst.selection.getFocusElement(), "img");

				if (imageElm)
					alert("Image dialog has been overriden. Found image src: " + tinyMCE.getAttrib(imageElm, "src"));
				else
					alert("Image dialog has been overriden.");

				return true;
		}

		return false; // Pass to next handler in chain
	}

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinyfck_field = field_name;
		tinyfck = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinyfck", "modal,width=600,height=400");
	}
	
	// Custom save callback, gets called when the contents is to be submitted
	function customSave(id, content) 
	{
	
	}
</script>
EOD;
		
	}
	$html_code .="<textarea NAME=\"{$name}\" {$extend} >{$value}</textarea>";
	return $html_code;
	
}
/**
 * @author John.meng
 * @example
 * radioTag ('gender',array('M'=>'Male','F'=>'Female'),'M')
 */
function radioTag ($name,$options,$selected="",$extend="") 
{
	$html_code="";
	if (is_array($options)) 
	{
		foreach($options as $key=>$value)
		{
			($key==$selected)?$option_selected="checked":$option_selected="";
			$html_code .= "<INPUT TYPE=\"radio\" NAME=\"{$name}\" VALUE=\"{$key}\" {$extend} {$option_selected}>{$value} &nbsp;\n";
		}
	}
	return $html_code;
	
}
/**
 * @author John.meng
 * @example 
 * selectTag ('gender',array('M'=>'Male','F'=>'Female'),'M')
 */
function selectTag ($name,$options,$selected="",$extend="") 
{
	$html_code="";
	if (is_array($options)) 
	{
		$html_code = "<select id = \"{$name}\" name=\"{$name}\" {$extend}> \n";
		foreach($options as $key=>$value)
		{
			($key==$selected)?$option_selected="selected":$option_selected="";
			$html_code .= "<option value=\"{$key}\" $option_selected >{$value}</option>\n";
		}
		$html_code .= "</select>\n";
	}
	return $html_code;
}

/**
 * @author John.meng
 *
 */
function fileTag ($name,$oldfile="", $delete=true, $ext="jpg") 
{
	global $WebUploadDir;
//	include_once 'HTTP/UploadProgressMeter.class.php';
//	$fileWidget = new UploadProgressMeter();
//	$fileWidget->name=$name;
	
	if ($oldfile) 
	{
		if ($ext == "swf")
		{
			$html_code = showFlash($WebUploadDir . $oldfile, 80, 60) . "<br>" . 
		  			"<a target='_blank' href={$WebUploadDir}{$oldfile}>Full Screen</a>";
		}
		else
		{
			$html_code="<a target='_blank' href={$WebUploadDir}{$oldfile}><IMG SRC=\"{$WebUploadDir}{$oldfile}\" WIDTH=\"80\" BORDER=\"0\" ></a> &nbsp;";
		}
		
		if ($delete) {
			$html_code .= "<INPUT TYPE=\"checkbox\" NAME=\"{$name}_del\" value=\"Y\">Delete";
		}
		$html_code .= "<INPUT TYPE=\"hidden\" NAME=\"{$name}_old\" value=\"{$oldfile}\">" ;
		$html_code .= "<br/>";
	}
	$html_code .= "<INPUT TYPE=\"file\" NAME=\"{$name}\" > &nbsp;\n";
//	if ($fileWidget->uploadComplete()) 
//	{
//		$html_code .= $fileWidget->finalStatus();
//	}
//	$html_code .= $fileWidget->renderHidden();
//	$html_code .= $fileWidget->render();//"<INPUT TYPE=\"file\" NAME=\"{$name}\" > &nbsp;\n";
//	$html_code .= $fileWidget->renderProgressBar();
	return $html_code;
	
}

function imageTag ($filename) 
{
	global $WebUploadDir;
	return $filename?"<a target='_blank' href={$WebUploadDir}{$filename}><IMG SRC=\"{$WebUploadDir}{$filename}\" WIDTH=\"80\" BORDER=\"0\" ></a> &nbsp;":"";
}

function inputDateTag ($name, $value="",$show_time=false) 
{
	global $WebJSToolkitPath;
	$html_code = "";
	$js_key="DATA_INPUT_JS";
	if (!isGlobalVarRegisted ($js_key)) 
	{
		$html_code .= "
	<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"{$WebJSToolkitPath}calendar/calendar-win2k-cold-1.css\" title=\"win2k-cold-1\" />
	<script type=\"text/javascript\" src=\"{$WebJSToolkitPath}calendar/calendar.js\"></script>
	<script type=\"text/javascript\" src=\"{$WebJSToolkitPath}calendar/lang/calendar-en.js\"></script>
	<script type=\"text/javascript\" src=\"{$WebJSToolkitPath}calendar/calendar-setup.js\"></script>
		";
		registerGlobalVar ($js_key,true);	
	} 
	if ($show_time) 
	{
		$input_size="16";
		$date_format="yyyy-MM-dd";
		$cal_setup = "
	    Calendar.setup({
	      inputField : \"{$name}\",
	      ifFormat : \"%Y-%m-%d  %H:%M\",
	      showsTime      :    true,
	      timeFormat     :    '24',
	      showsTime      :    true,button : \"trigger_{$name}\"
	    });";
	} 
	else 
	{
		$input_size="9";
		$date_format="yyyy-MM-dd";
		$cal_setup = "
	    Calendar.setup({
	      inputField : \"{$name}\",
	      ifFormat : \"%Y-%m-%d\",
	      button : \"trigger_{$name}\"
	    });";
		
	}
	$html_code .= "
	<input type=\"text\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" calendar_button_img=\"{$WebJSToolkitPath}calendar/images/date.png\" date_format=\"{$date_format}\" size=\"{$input_size}\" /><img id=\"trigger_{$name}\" style=\"cursor: pointer; vertical-align: middle\" src=\"{$WebJSToolkitPath}calendar/images/date.png\" alt=\"Date\" /><script type=\"text/javascript\">
    document.getElementById(\"trigger_{$name}\").disabled = false;
	{$cal_setup}
  	</script>";
	return $html_code;
}

function navButtonTag ($name,$title="",$url="",$css="admin_action_list") 
{
	$html_code="<li><input name=\"{$name}\" class=\"{$css}\" value=\"{$title}\" type=\"button\" onclick=\"document.location='{$url}';\" /></li>\n";
	return $html_code;
	
}

function popFile($url, $width=80, $ext="jpg")
{
	if ($ext == "swf")
	{
		$url = showFlash($url, $width, 60) . "<br>" . 
		  "<a target='_blank' href={$url}>Full Screen</a>";
	}
	else
	{
		$url = "<a target='_blank' href={$url}>" .showImage($url, 80) . "</a>";
	}
	return $url;
}


function showFlash($url, $width, $heigth)
{
	return 
	"<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=$width height=$heigth>" . 
	  "<param name=\"movie\" value=$url> " . 
	  "<param name=\"quality\" value=\"high\"> " . 
	  "<embed src=$url quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=$width height=$heigth> " .
	  "</embed>" . 
	"</object> ";
}

function showImage($url, $width)
{
	return "<IMG SRC=\"{$url}\" WIDTH=\"$width\" BORDER=\"0\" >";
}

function showEmail ($email) 
{
	global $WebBaseDir;
	return "<a href=\"".$WebBaseDir."/utility/MailSender/WriteMail/".$email."\" >".$email."</a>";
	
}

function showHeaderLink ($orderBy,$title,$getFieldName,$direction,$linkExten,$current_url) 
{
	if ($direction && ($getFieldName==$orderBy)) 
	{
		$append_flag = $direction!="ASC"?"&uArr":"&dArr";
		$direction= ($direction=="ASC")?"DESC":"ASC";
	}
	else 
	{
		$direction="ASC";
	}
	$patten = array("/orderfield=([^\&]*)/","/order=([^\&]*)/");
	$replace = array("orderfield=$orderBy","order=$direction");
	$url_string = preg_replace($patten,$replace,$linkExten);
	$url =$current_url."?".$url_string;
	return "<a href=".$url.">" .$title.$append_flag. "</a>";
}

?>
