<?php

function cutString($string, $length)
{
	$strcut = '';
	if (strlen($string) > $length)
	{
		preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);
		for ($i = 0; $i < count($info[0]); $i++)
		{
			$strcut .= $info[0][$i];
			$j = ord($info[0][$i]) > 127 ? $j +2 : $j +1;
			if ($j > $length -3)
			{
				return $strcut . "...";
			}
		}
		return join('', $info[0]);
	}
	else
	{
		return $string;
	}
}
?>
