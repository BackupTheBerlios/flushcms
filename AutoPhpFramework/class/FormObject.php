<?php
/**
 *
 * FormObject.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    CVS: $Id: FormObject.php,v 1.5 2006/10/01 12:04:52 arzen Exp $
 */

/**
 * @author John.meng
 * @example 
 * textTag ('q','php')
 * 
 */ 
function textTag ($name,$value="",$extend="") 
{
	$html_code="<INPUT TYPE=\"text\" NAME=\"{$name}\" VALUE=\"{$value}\" {$extend} >";
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
?>
