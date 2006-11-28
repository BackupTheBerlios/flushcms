<?php
/**
 *
 * index.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: index.php,v 1.1 2006/11/28 23:12:44 arzen Exp $
 */
$language_string = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$language_arr = explode(",",$language_string);
$this_language = $language_arr[0];
switch ($this_language) {
	case "zh-cn":
		header("location:web/front.php");
		break;

	default:
		header("location:web/front_en.php");
		break;
}
?>
