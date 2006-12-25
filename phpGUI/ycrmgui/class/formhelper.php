<?php
/**
 *
 * formhelper.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: formhelper.php,v 1.2 2006/12/25 14:53:35 arzen Exp $
 */
function empty_message_box ($parent,$message) 
{
	global $wb;
	wb_message_box($parent, $message,$wb->vars["Lang"]["system_name"],WBC_WARNING);
}
?>
