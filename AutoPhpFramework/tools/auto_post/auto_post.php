<?php


/**
 *
 * auto_post.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: auto_post.php,v 1.1 2006/10/25 08:55:54 arzen Exp $
 */
set_time_limit(0);
define('APF_ROOT_DIR', realpath(dirname(__FILE__) . '/../..'));
require_once (APF_ROOT_DIR . DIRECTORY_SEPARATOR . 'init.php');
require_once 'HTTP/Client.php';

$fields = array (
	'handle' => 'admin',//login user name
	'passwd' => 'admin',//login password
	'category' => '1',// form field
	'name' => 'product'.mt_rand(5000,99999),// form field
	'price' => '5.23',// form field
);

// uploade file
$files = array();
$files[] = array (
	'name' =>'photo',// file field name
	'filename'=>'C:/Documents and Settings/john.meng/My Documents/My Pictures/001004183175_tb.jpg',// local file name
);

$search_action = 'http://localhost/dev/AutoPhpFramework/web/backend.php/product/apf_product/addsubmit';

$headers = array (
	'User-Agent' => 'Mozilla/4.0 (compatible; MSIE 6.0)',
	'Accept-Language' => 'zh-cn'
);
$h = new HTTP_Client(NULL, $headers);
$code = $h->post($search_action, $fields, false,$files);//false,$files

if ($code == 200)
{
	$resp = $h->currentResponse();
	$body = $resp['body'];

	echo $body;

}
else
{
	echo "fetch the result error.";
}
?>
