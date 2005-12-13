<?php
/*
   +----------------------------------------------------------------------+
   | FlushPHP                                                             |
   +----------------------------------------------------------------------+
   | Copyright (c) 2005 The FlushPHP Group                                |
   +----------------------------------------------------------------------+
   | This library is free software; you can redistribute it and/or        |
   | modify it under the terms of the GNU Lesser General Public           |
   | License as published by the Free Software Foundation; either         |
   | version 2.1 of the License, or (at your option) any later version.   |
   +----------------------------------------------------------------------+
   | Author: John.meng(ÃÏÔ¶òû)  2005-12-11 20:07:45                        
   +----------------------------------------------------------------------+
 */

/* $Id: Messages.class.php,v 1.2 2005/12/13 01:16:25 arzen Exp $ */

/**
 * Load language file
 * @package	App
 */

class Messages
{

	function Messages()
	{
	}
	/**
	 * Display message
	 *
	 * @author  John.meng (ÃÏÔ¶òû)
	 * @since   version1.0 - 2005-12-11 20:14:48
	 * @param   string  $Content Message contemt
	 * @param   string  $Level   Message type MSG/WARNNING/ERROR/NOTICE
	 * @return  string  message table html code
	 */
	function displayMsg ($Content,$Level="MSG") 
	{
		global $__Lang__;
		
		$msg_table_class = "msg_table_head_msg";
		$msg_td_class = "msg_td_msg";
		switch ($Level) 
		{
			case "MSG":
				$msg_prefix = $__Lang__['langMessageMsg'];
				$msg_head_class = "msg_td_head_msg";
				break;
		
			case "WARNNING":
				$msg_prefix = $__Lang__['langMessageWarnning'];
				$msg_head_class = "msg_td_head_warnning";
				
				break;
				
			case "ERROR":
				$msg_prefix = $__Lang__['langMessageError'];
				$msg_head_class = "msg_td_head_error";
				break;

			case "NOTICE":
				$msg_prefix = $__Lang__['langMessageNotice'];
				$msg_head_class = "msg_td_head_notice";
				break;
		}
		$template_dir = THEMES_DIR;
		$html_code = <<<EOT
		<link href="$template_dir/style.css" rel="stylesheet" type="text/css">
		<table border="0" class = "$msg_table_class" align="center">
		  <tr>
		    <td class = "$msg_head_class" >&nbsp;&nbsp;<strong> $msg_prefix </strong> : </td>
		  </tr>
		  <tr>
		    <td class = "$msg_td_class" >&nbsp;&nbsp;$Content</td>
		  </tr>
		</table>
EOT;
		return $html_code;

	}
	
	
}
?>