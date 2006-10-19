<?php
/**
 *
 * ContentParse.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: ContentParse.php,v 1.4 2006/10/19 08:27:09 arzen Exp $
 */
function parseTag ($pattren,$content,$back_num=1) 
{
	preg_match("/".$pattren."/isU",$content,$match);
	$data = trim($match[$back_num]);
	return $data;
}

function getContent ($url="") 
{
	$content=($data=@file_get_contents($url))?$data:"";
	return $content;
}


?>
