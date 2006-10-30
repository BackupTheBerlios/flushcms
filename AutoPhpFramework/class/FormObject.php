<?php
/**
 *
 * FormObject.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: FormObject.php,v 1.11 2006/10/30 09:54:29 arzen Exp $
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
	global $WebTemplateFullPath;
	$html_code = "";
	if ($rich) 
	{
		$tiny_mce_dir = $WebTemplateFullPath."tiny_mce/";
		$html_code .= <<<EOD
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="{$tiny_mce_dir}tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		theme : "advanced",
		mode : "exact",
		elements : "{$name}",
		save_callback : "customSave",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		extended_valid_elements : "a[href|target|name]",
		plugins : "table,save,advhr,advimage,advlink,emotions,ibrowser,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect,ibrowser",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,insertdate,inserttime",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,forecolor,backcolor",
		//invalid_elements : "a",
		theme_advanced_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1", // Theme specific setting CSS classes
		//execcommand_callback : "myCustomExecCommandHandler",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		debug : false
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
			$html_code .= "<INPUT TYPE=\"checkbox\" NAME=\"{$name}_del\" value=\"Y\">Delete".
				"<INPUT TYPE=\"hidden\" NAME=\"{$name}_old\" value=\"{$oldfile}\">" ;
		}
		$html_code .= "<br/>";
	}
	
	$html_code .="<INPUT TYPE=\"file\" NAME=\"{$name}\" > &nbsp;\n";
	return $html_code;
	
}

function imageTag ($filename) 
{
	global $WebUploadDir;
	return $filename?"<a target='_blank' href={$WebUploadDir}{$filename}><IMG SRC=\"{$WebUploadDir}{$filename}\" WIDTH=\"80\" BORDER=\"0\" ></a> &nbsp;":"";
}

function inputDateTag ($name, $value="") 
{
	global $WebTemplateFullPath;
	$html_code = "";
	$html_code .="  <input type=\"text\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" calendar_button_img=\"{$WebTemplateFullPath}images/date.png\" date_format=\"yyyy-MM-dd\" size=\"9\" /><img id=\"trigger_{$name}\" style=\"cursor: pointer; vertical-align: middle\" src=\"{$WebTemplateFullPath}images/date.png\" alt=\"Date\" /><script type=\"text/javascript\">
    document.getElementById(\"trigger_{$name}\").disabled = false;
    Calendar.setup({
      inputField : \"{$name}\",
      ifFormat : \"%Y-%m-%d\",
      button : \"trigger_{$name}\"
    });
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

?>
