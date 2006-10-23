<?php
/**
 *
 * ContentParse.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ContentParse.php,v 1.5 2006/10/23 13:08:01 arzen Exp $
 */
function parseTag ($pattren,$content,$back_num=1) 
{
	preg_match("/".$pattren."/isU",$content,$match);
	$data = trim($match[$back_num]);
	return $data;
}

function parseTagAll ($pattren,$content) 
{
	preg_match_all("/".$pattren."/isU",$content,$match);
	return $match[1];
}

function getContent ($url="") 
{
	$content=($data=@file_get_contents($url))?$data:"";
	return $content;
}


?>
