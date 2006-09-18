<?php
/**
 *
 * StringHelper.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: StringHelper.class.php,v 1.1 2006/09/18 05:22:44 arzen Exp $
 */

class StringHelper 
{

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
	
	function CamelCaseFromUnderscore($strName) 
	{
		$strToReturn = '';
	
		// If entire underscore string is all uppercase, force to all lowercase
		// (mixed case and all lowercase can remain as is)
		if ($strName == strtoupper($strName))
			$strName = strtolower($strName);
	
		while (($intPosition = strpos($strName, "_")) !== false) {
			// Use 'ucfirst' to create camelcasing
			$strName = ucfirst($strName);
			if ($intPosition == 0) {
				$strName = substr($strName, 1);
			} else {
				$strToReturn .= substr($strName, 0, $intPosition);
				$strName = substr($strName, $intPosition + 1);
			}
		}
	
		$strToReturn .= ucfirst($strName);
		return $strToReturn;
	}
	
	function FirstCharacter($strString) 
	{
		if (strlen($strString) > 0)
			return substr($strString, 0 , 1);
		else
			return null;
	}

}


?>
