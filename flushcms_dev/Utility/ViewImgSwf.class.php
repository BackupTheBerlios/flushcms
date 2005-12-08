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
   | Author: John.meng(孟远螓)  2005-12-5 7:36:56                        
   +----------------------------------------------------------------------+
 */
 
/* $Id: ViewImgSwf.class.php,v 1.1 2005/12/08 08:52:35 arzen Exp $ */

/**
 * Display images or flash media
 * @package	Utility
 */
class ViewImgSwf 
{
	var $File_Name;
	var $File_Path;
	var $width;
	var $height;
	var $loop;
	var $Alt;

	function displayIt($File_Name,$Alt="",$width="",$height="",$File_Path="") 
	{
		$this->File_Name= $File_Name;
		$this->File_Path= $File_Path;
		$ThisFileType = ViewImgSwf::_GetFiletype();
		ViewImgSwf::setDimensions( $this->File_Name );
		$this->Alt = $Alt;
		if ($width) 
		{
			$this->width = $width;
		}
		if ($height) 
		{
			$this->height = $height;
		}
		ViewImgSwf::setLoop( true );
		switch($ThisFileType) 
		{
			case swf:
				$displayHtml = ViewImgSwf::getFlashHtml();
				break;
			case gif:
				$displayHtml = ViewImgSwf::getImgHtml();
				break;
			case jpg:
				$displayHtml = ViewImgSwf::getImgHtml();
				break;
			case jpeg:
				$displayHtml = ViewImgSwf::getImgHtml();
				break;
			case png:
				$displayHtml = ViewImgSwf::getImgHtml();
				break;
			default:
				$displayHtml = "";
		
		}
		Return $displayHtml;
	}

	function _GetFiletype() 
	{ 
		if (substr_count($this->File_Name, ".") == 0) 
		{        // 检查文件名中是否有.号。 
			return;                // 返回空
		} 
		else if (substr($this->File_Name, -1) == ".") 
		{        // 检查是否以.结尾，即无扩展名 
			return;// 返回空 
		} 
		else 
		{ 
			$FileType = strrchr ($this->File_Name, ".");    // 从.号处切割
			$FileType = substr($FileType, 1);    // 去除.号 
			return  strtolower(trim($FileType));
		}
	}

	function setLoop( $bool ) 
	{
		assert( is_bool( $bool ) );
		$this->loop = $bool;
	}

	function setDimensions( $File_Name ) 
	{
		global $CurrentUserPathImages;
		if ($this->File_Path != "") 
		{
			$CurrentUserPathImages = $this->File_Path;
		}
		list( $this->width, $this->height ) = 
			@GetImageSize( $CurrentUserPathImages."/".$File_Name );
		$this->File_Name = $CurrentUserPathImages."/".$File_Name;
	}

	function getImgHtml() 
	{
		$File_Name = str_replace(ROOT_PATH,"../../",$this->File_Name);
		Return '<!-- Image -->' . "\n" .
			'<img src="' . $File_Name . '" ' .
			'width="' . $this->width . '" ' .
			'height="' . $this->height . '" ' .
			'border="' . 0 . '" ' .
			'alt="' . $this->Alt . '">' . "\n" .
			'<!-- END Image -->';

	}

	function getFlashHtml() 
	{
		$File_Name = str_replace(ROOT_PATH,"../../",$this->File_Name);
		$codeBase = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0';

		$pluginsPage = 'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash';

		return '<!-- FLASH MOVIE -->' . "\n" .
			'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ' .
			'codebase="' . $codeBase . '" ' .
			'id="flash" ' .
			'width="' . $this->width . '" ' .
			'height="' . $this->height . '">' . "\n" .

		'<param name="movie" value="' . $File_Name . '">' . "\n" .
		'<param name="loop" value="' . $this->loop . '">' . "\n" .
		'<param name="quality" value="high">' . "\n" .
		'<param name="bgcolor" value="#ffffff">' . "\n" .

		'<embed src="' . $File_Name . '" ' . "\n" .
		'loop="' . $this->loop . '" ' .
		'quality="high" ' .
		'bgcolor="#ffffff" ' .
		'swliveconnect="false" ' .
		'width="' . $this->width .'" ' .
		'height="' . $this->height . '" ' .
		'type="application/x-shockwave-flash" ' .
		'pluginspage="' . $pluginsPage . '">' .
		'</embed>' . "\n" .
		'</object>' . "\n" .
		'<!-- END OF FLASH MOVIE -->';
	}


}
?>