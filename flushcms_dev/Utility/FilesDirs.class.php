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
   | Author: John.meng(цот╤РШ)  Dec 12, 2005 12:14:25 PM                        
   +----------------------------------------------------------------------+
 */

/* $Id: FilesDirs.class.php,v 1.2 2006/01/24 14:38:08 arzen Exp $ */
/**
 * Program exec spend time
 * @package	Utility
 */

class FilesDirs
{
	var $dir_patch;
	var $depth;
	var $tmp_depth=0;
	var $mask;
	var $dir_array;
	
	/**
	* Construct class
	*
	* @author	John.meng
	* @since    version1.0 - Dec 12, 2005
	* @param	string   $DirPath  dir path
	* @param	string   $Depth    seach dir depth 0 is unlimit
	* @param	string   $Mask     Mask name space out ","
	*/
	function FilesDirs($DirPath="./",$Depth="0",$Mask="")
	{
		$this->dir_patch = $DirPath;
		$this->mask = explode(',',$Mask);
		$this->depth = $Depth;
	}
	/**
	* Get path all dir name
	*
	* @author	John.meng
	* @since    version1.0 - Dec 12, 2005
	* @return   array 
	*/
	function listDirs () 
	{
		if (is_dir($this->dir_patch)) 
		{
	        $tmp_dir_fp=opendir ($this->dir_patch);
	        while ($file = readdir ($tmp_dir_fp)) 
	        {
	            if ($file != "." && $file != ".." && !in_array($file,$this->mask)) 
	            {
	                $tmp = $this->dir_patch."/".$file;
	                if (is_dir($tmp))
	                {
	                   $this->dir_array[] = $file;
	                } 
	             }
	        }
	        closedir($tmp_dir_fp);
		}
		return $this->dir_array;
	}
}
?>