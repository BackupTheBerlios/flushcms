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
   | Author: John.meng(孟远螓)  2005-12-2 7:39:31                        
   +----------------------------------------------------------------------+
 */

/* $Id: FileUploader.class.php,v 1.2 2006/01/16 01:43:01 arzen Exp $ */

/**
 * @package	Utility
 */
class FileUploader
{
	var $mediaName;
	var $mediaType;
	var $mediaSize;
	var $mediaDimension;
	var $mediaTmpName;
	var $mediaError;

	var $uploadDir = '';

	var $allowedMimeTypes = array ();

	var $maxFileSize = 0;
	var $maxWidth;
	var $maxHeight;

	var $targetFileName;

	var $prefix;

	var $errors = array ();

	var $savedDestination;

	var $savedFileName;

	var $addLogo = false;
	var $smallLogoType = false;
	var $newWidth = "";
	var $newHeight = "";

	var $CreateIco = "";
	var $IcoWidth = "";
	var $IcoHeight = "";

	/**
	 * Constructor
	 * 
	 * @param   string  $uploadDir
	 * @param   array   $allowedMimeTypes
	 * @param   int     $maxFileSize
	 * @param   int     $maxWidth
	 * @param   int     $maxHeight
	 **/
	function FileUploader($uploadDir, $allowedMimeTypes, $maxFileSize, $maxWidth = null, $maxHeight = null)
	{
		if (is_array($allowedMimeTypes))
		{
			$this->allowedMimeTypes = & $allowedMimeTypes;
		}
		$this->uploadDir = $uploadDir;
		$this->maxFileSize = intval($maxFileSize);
		if (isset ($maxWidth))
		{
			$this->maxWidth = intval($maxWidth);
		}
		if (isset ($maxHeight))
		{
			$this->maxHeight = intval($maxHeight);
		}
	}

	/**
	 * Fetch the uploaded file
	 * 
	 * @param   string  $media_name Name of the file field
	 * @param   int     $index      Index of the file (if more than one uploaded under that name)
	 * @global  $HTTP_POST_FILES
	 * @return  bool
	 **/
	function fetchMedia($media_name, $index = null)
	{
		if (!isset ($_FILES[$media_name]))
		{
			$this->setErrors('File not found');
			return false;
		}
		elseif (is_array($_FILES[$media_name]['name']) && isset ($index))
		{
			$index = intval($index);
			$this->mediaName = $_FILES[$media_name]['name'][$index];
			$this->mediaType = $_FILES[$media_name]['type'][$index];
			$this->mediaSize = $_FILES[$media_name]['size'][$index];
			$this->mediaTmpName = $_FILES[$media_name]['tmp_name'][$index];
			$this->mediaError = !empty ($_FILES[$media_name]['error'][$index]) ? $_FILES[$media_name]['errir'][$index] : 0;
		}
		else
		{
			$media_name = & $_FILES[$media_name];
			$this->mediaName = $media_name['name'];
			$this->mediaType = $media_name['type'];
			$this->mediaSize = $media_name['size'];
			$this->mediaTmpName = $media_name['tmp_name'];
			$this->mediaError = !empty ($media_name['error']) ? $media_name['error'] : 0;
		}
		$this->errors = array ();
		if (intval($this->mediaSize) < 0)
		{
			$this->setErrors('Invalid media size');
			return false;
		}
		if ($this->mediaName == '')
		{
			$this->setErrors('Invalid media name');
			return false;
		}
		if ($this->mediaTmpName == 'none' || !is_uploaded_file($this->mediaTmpName))
		{
			$this->setErrors('No file uploaded');
			return false;
		}
		if ($this->mediaError > 0)
		{
			$this->setErrors('Error occurred: Error #'.$this->mediaError);
			return false;
		}
		if (isset ($this->maxWidth) || isset ($this->maxHeight))
		{
			if (false === ($this->mediaDimension = getimagesize($this->mediaTmpName)))
			{
				$this->setErrors('Invalid image file');
				return false;
			}
		}
		return true;
	}

	/**
	 * Set the target filename
	 * 
	 * @param   string  $value
	 **/
	function setTargetFileName($value)
	{
		$this->targetFileName = strval(trim($value));
	}

	/**
	 * Set the prefix
	 * 
	 * @param   string  $value
	 **/
	function setPrefix($value)
	{
		$this->prefix = strval(trim($value));
	}

	/**
	 * Get the uploaded filename
	 * 
	 * @return  string 
	 **/
	function getMediaName()
	{
		return $this->mediaName;
	}

	/**
	 * Get the type of the uploaded file
	 * 
	 * @return  string 
	 **/
	function getMediaType()
	{
		return $this->mediaType;
	}

	/**
	 * Get the size of the uploaded file
	 * 
	 * @return  int 
	 **/
	function getMediaSize()
	{
		return $this->mediaSize;
	}

	/**
	 * Get the temporary name that the uploaded file was stored under
	 * 
	 * @return  string 
	 **/
	function getMediaTmpName()
	{
		return $this->mediaTmpName;
	}

	/**
	 * Get the Dimensions of the uploaded file
	 * 
	 * Returns an array with 4 elements. Index 0 contains the width of the image in pixels. Index 1 contains the height. Index 2 is a flag indicating the type of the image: 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF. These values correspond to the IMAGETYPE constants that were added in PHP 4.3. Index 3 is a text string with the correct height="yyy" width="xxx" string that can be used directly in an IMG tag.
	 * 
	 * @return  array    
	 **/
	function getMediaDimension()
	{
		return $this->mediaDimension;
	}

	/**
	 * Get the saved filename
	 * 
	 * @return  string 
	 **/
	function getSavedFileName()
	{
		return $this->savedFileName;
	}

	/**
	 * Get the destination the file is saved to
	 * 
	 * @return  string
	 **/
	function getSavedDestination()
	{
		return $this->savedDestination;
	}

	/**
	 * Check the file and copy it to the destination
	 * 
	 * @return  bool
	 **/
	function upload()
	{
		if ($this->uploadDir == '')
		{
			$this->setErrors('Upload directory not set');
			return false;
		}
		if (!is_dir($this->uploadDir))
		{
			$this->setErrors('Failed opening directory: '.$this->uploadDir);
		}
		if (!is_writeable($this->uploadDir))
		{
			$this->setErrors('Failed opening directory with write permission: '.$this->uploadDir);
		}
		if (!$this->checkMaxFileSize())
		{
			$this->setErrors('File size too large: '.$this->mediaSize);
		}
		if (!$this->checkMaxWidth())
		{
			$this->setErrors('File width too large: '.$this->mediaDimension[0]);
		}
		if (!$this->checkMaxHeight())
		{
			$this->setErrors('File height too large: '.$this->mediaDimension[1]);
		}
		if (!$this->checkMimeType())
		{
			$this->setErrors('MIME type not allowed: '.$this->mediaType);
		}
		if (count($this->errors) > 0)
		{
			return false;
		}
		if (!$this->copyFile())
		{
			$this->setErrors('Failed uploading file: '.$this->mediaName);
			return false;
		}
		return true;
	}

	/**
	 * Copy the file to its destination
	 * 
	 * @return  bool 
	 **/
	function copyFile()
	{
		$matched = array ();
		if (!preg_match("/\.([a-zA-Z0-9]+)$/", $this->mediaName, $matched))
		{
			return false;
		}
		if (isset ($this->targetFileName))
		{
			$this->savedFileName = $this->targetFileName;
		}
		elseif (isset ($this->prefix))
		{
			$this->savedFileName = uniqid($this->prefix).'.'.strtolower($matched[1]);
		}
		else
		{
			$this->savedFileName = strtolower($this->mediaName);
		}
		$this->savedDestination = $this->uploadDir.'/'.$this->savedFileName;
		$this->savedIcoDestination = $this->uploadDir.'/Ico_'.$this->savedFileName;
		if (!move_uploaded_file($this->mediaTmpName, $this->savedDestination))
		{
			return false;
		}
		if ($this->newWidth || $this->newHeight)
		{
			$this->createThumbImages($this->savedDestination, $this->savedDestination, $this->newWidth, $this->newHeight);
		}
		if (($this->CreateIco == true) && ($this->IcoWidth || $this->IcoHeight))
		{
			$this->createThumbImages($this->savedDestination, $this->savedIcoDestination, $this->IcoWidth, $this->IcoHeight);
		}
		@ chmod($this->savedDestination, 0644);
		@ chmod($this->savedIcoDestination, 0644);
		return true;
	}

	/**
	 * Is the file the right size?
	 * 
	 * @return  bool 
	 **/
	function checkMaxFileSize()
	{
		if ($this->mediaSize > $this->maxFileSize)
		{
			return false;
		}
		return true;
	}

	/**
	 * Is the picture the right width?
	 * 
	 * @return  bool 
	 **/
	function checkMaxWidth()
	{
		if (!isset ($this->maxWidth))
		{
			return true;
		}
		if ($this->mediaDimension[0] > $this->maxWidth)
		{
			return false;
		}
		return true;
	}

	/**
	 * Is the picture the right height?
	 * 
	 * @return  bool 
	 **/
	function checkMaxHeight()
	{
		if (!isset ($this->maxHeight))
		{
			return true;
		}
		if ($this->mediaDimension[1] > $this->maxHeight)
		{
			return false;
		}
		return true;
	}

	/**
	 * Is the file the right Mime type 
	 * 
	 * (is there a right type of mime? ;-)
	 * 
	 * @return  bool
	 **/
	function checkMimeType()
	{
		if (count($this->allowedMimeTypes) > 0 && !in_array($this->mediaType, $this->allowedMimeTypes))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Add an error
	 * 
	 * @param   string  $error
	 **/
	function setErrors($error)
	{
		$this->errors[] = trim($error);
	}

	/**
	 * Get generated errors
	 * 
	 * @param	bool    $ashtml Format using HTML?
	 * 
	 * @return	array|string    Array of array messages OR HTML string
	 */
	function & getErrors($ashtml = true)
	{
		if (!$ashtml)
		{
			return $this->errors;
		}
		else
		{
			$ret = '';
			if (count($this->errors) > 0)
			{
				$ret = '<h4>Media Upload Errors</h4>';
				foreach ($this->errors as $error)
				{
					$ret .= $error.'<br />';
				}
			}
			return $ret;
		}
	}
	/**
	 * 根据上传的图片类型来改变大小
	 */
	function createThumbImages($savedDestination, $saveNewName, $newWidth, $newHeight)
	{
		switch ($this->mediaType)
		{
			case 'image/jpeg' :
				$photoImage = ImageCreateFromJPEG($savedDestination);
				$im = $this->makeThumb($photoImage, $newWidth, $newHeight);
				ImageJPEG($im, $saveNewName);
				break;
			case 'image/pjpeg' :
				$photoImage = ImageCreateFromJPEG($savedDestination);
				$im = $this->makeThumb($photoImage, $newWidth, $newHeight);
				ImageJPEG($im, $saveNewName);
				break;
			case 'image/gif' :
				$photoImage = ImageCreateFromGIF($savedDestination);
				$im = $this->makeThumb($photoImage, $newWidth, $newHeight);
				if (function_exists(imagegif))
				{
					imagegif($photoImage, $savedDestination);
				}
				else
				{
					ImageJPEG($im, $saveNewName);
				}
				break;
			case 'image/x-png' :
				$photoImage = ImageCreateFromPNG($savedDestination);
				$im = $this->makeThumb($photoImage, $newWidth, $newHeight);
				ImagePNG($im, $saveNewName);
				break;
		}
		ImageDestroy($photoImage);
	}
	/**
	 * 根据比例进行图像的缩放
	 */
	function makeThumb($im, $newWidth = "", $newHeight = "")
	{
		$logoW = ImageSX($im);
		$logoH = ImageSY($im);
		if (($newWidth || $newHeight) && (($logoW > $newWidth) || ($logoH > $newHeight)))
		{
			if ($newHeight && $newWidth)
			{
				if (($logoH / $logoW) > ($newHeight / $newWidth))
				{
					$newHeight = $newHeight;
					$newWidth = round(($logoW / $logoH) * $newHeight, 0);
					$flag = true;
				}
				if (($logoW / $logoH) > ($newWidth / $newHeight))
				{
					$newWidth = $newWidth;
					$newHeight = round(($logoH / $logoW) * $newHeight, 0);
					$flag = true;
				}
			}
			if ($newWidth && ($logoW > $newWidth))
			{
				$newWidth = $newWidth;
				$newHeight = round(($logoH / $logoW) * $newWidth, 0);
				$flag = true;
			}
			if ($newHeight && ($logoH > $newHeight))
			{
				$newHeight = $newHeight;
				$newWidth = round(($logoW / $logoH) * $newHeight, 0);
				$flag = true;
			}
			if ($flag)
			{
				if (function_exists("ImageCreateTrueColor"))
				{

					$im2 = ImageCreateTrueColor($newWidth, $newHeight);

				}
				else
				{
					$im2 = ImageCreate($newWidth, $newHeight);
				}
				if (function_exists("ImageCopyResampled"))
				{
					ImageCopyResampled($im2, $im, 0, 0, 0, 0, $newWidth, $newHeight, $logoW, $logoH);
				}
				else
				{
					ImageCopyResized($im2, $im, 0, 0, 0, 0, $newWidth, $newHeight, $logoW, $logoH);
				}
				Return $im2;
			}
			else
			{
				Return $im;
			}
		}
		else
		{
			Return $im;
		}
	}
}
?>