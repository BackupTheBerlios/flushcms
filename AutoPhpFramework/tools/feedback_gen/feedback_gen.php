<?php
/**
 *
 * feedback_gen.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: feedback_gen.php,v 1.1 2006/11/11 06:21:48 arzen Exp $
 */

$item_arr = array(
	"姓名",
	"性别",
	"反馈主题",
	"反馈内容",
);
$start_num = 550;
$max_field = $start_num+count($item_arr);

$feed_back_html="<table><FORM METHOD=\"POST\" ACTION=\"feedback.php\">\r\n<tr><td>发送人:</td><td><input type=\"text\" name=\"mail_from\"></td></tr>\r\n"; 
for ($index = $start_num; $index < $max_field; $index++) 
{
	$item_title = $item_arr[$index-$start_num];
	$feed_back_html .="<tr><td><label for=\"value_{$index}\">{$item_title}:</label></td><td><INPUT TYPE=\"text\" NAME=\"value_{$index}\" ID=\"value_{$index}\">";
	$feed_back_html .="<INPUT TYPE=\"hidden\" NAME=\"key_{$index}\" VALUE=\"{$item_title}\" ID=\"key_{$index}\" ></td></tr>\r\n";
}
$feed_back_html .="<tr><td></td><td><input type=\"hidden\" name=\"mail_to\" value=\"arzen1013@gmail.com\"><input name=\"submit\" type=\"submit\" value=\"Submit\"></td></tr>\r\n";
$feed_back_html .="</FORM></table>";
$form_html = htmlspecialchars($feed_back_html);
echo nl2br($form_html);
?>
