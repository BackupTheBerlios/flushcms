<?php

/**
 *
 * ImageMagickUtility.class.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     цот╤РШ
 * @author     QQ:3440895
 * @version    CVS: $Id: ImageMagickUtility.class.php,v 1.2 2006/10/25 10:50:47 arzen Exp $
 */

class ImageMagickUtility
{

	function addText($source_name,$string,$save_name="",$font_height=30,$text_align="center",$color="#ff0000",$font="Arial",$Antialias=true)
	{
		$resource = NewMagickWand();
		$drw_wnd = NewDrawingWand();
		MagickReadImage( $resource, $source_name );
		//MagickResizeImage( $resource, 160, 120 ,MW_BoxFilter,1);
	
		DrawSetFillColor($drw_wnd, $color);
		DrawSetFontSize($drw_wnd, $font_height);
		DrawSetFont($drw_wnd, $font);
		DrawSetTextAntialias($drw_wnd, $Antialias);
		
		$src_image_x = MagickGetImageWidth($resource);
		$src_image_y = MagickGetImageHeight($resource);
		
		$string_width = MagickGetStringWidth($resource, $drw_wnd, $string, FALSE);
		$string_height = MagickGetStringHeight($resource, $drw_wnd, $string, FALSE);
		
		switch ($text_align) {
			case "center":
				$text_x=($src_image_x/2)-($string_width/2);
				$text_y=($src_image_y/2)-($string_height/2);
				break;
		
			default:
				break;
		}
		
		DrawAnnotation($drw_wnd, $text_x, $text_y, $string);
		
		MagickDrawImage($resource, $drw_wnd);
		
		if ($save_name) 
		{
			MagickWriteImage($resource, $save_name);
		}
		else
		{
			header( 'Content-Type: image/jpeg' );
			MagickEchoImageBlob( $resource );
		}
		
		DestroyDrawingWand($drw_wnd);
		DestroymagickWand($resource);
	
	}
	
	function resize ($source_name,$width="",$height="",$save_name="") 
	{
		$resource = NewMagickWand();
		MagickReadImage( $resource, $source_name );
		$src_image_x = MagickGetImageWidth($resource);
		$src_image_y = MagickGetImageHeight($resource);
		$src_image_scale = $src_image_x/$src_image_y;
		
		if ($width && $height ) 
		{
			$new_image_x = $width;
			$new_image_y = $height;
		}
		else
		{
			if ($width) 
			{
				$new_image_x = $width;
				$new_image_y = $src_image_y*($src_image_y/$src_image_x);
			}
			else
			{
				$new_image_x = $src_image_x*($src_image_x/$src_image_y);
				$new_image_y = $height;
			}
		}
		
		MagickResizeImage( $resource, $new_image_x, $new_image_y ,MW_BoxFilter,1);

		if ($save_name) 
		{
			MagickWriteImage($resource, $save_name);
		}
		else
		{
			header( 'Content-Type: image/jpeg' );
			MagickEchoImageBlob( $resource );
		}

		DestroymagickWand($resource);
		
	}

}
?>