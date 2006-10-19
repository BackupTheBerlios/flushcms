<?php
/**
 *
 * ContentParse.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ContentParse.php,v 1.3 2006/10/19 02:31:16 arzen Exp $
 */
function parseTag ($pattren,$content,$back_num=1) 
{
	preg_match("/".$pattren."/isU",$content,$match);
	$data = trim($match[$back_num]);
	return $data;
}

function getContent ($url="") 
{
	global $logger;
	$content=($data=@file_get_contents($url))?$data:"";
	if ($content != "" ) 
	{
		$logger->log("Get {$url} content.");
	}
	return $content;
}


?>
