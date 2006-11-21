<?php

/**
 *
 * DiaryEvent.class.php class.
 *
 * @package    core
 * @author     John.meng <john.meng@achievo.com>
 * @version    SVN: $Id: DiaryEvent.class.php,v 1.1 2006/11/21 16:00:22 arzen Exp $
 */

class DiaryEvent extends Calendar_Decorator
{
	var $entry;
	var $end_hour;
	var $statu;
	var $images;
	var $id;
	var $item_num;
	function DiaryEvent($calendar)
	{
		Calendar_Decorator :: Calendar_Decorator($calendar);
	}
	
	function setEntry($entry)
	{
		$this->entry = $entry;
	}
	function getEntry()
	{
		return $this->entry;
	}
	
	function setEndHour($end_hour)
	{
		$this->end_hour = $end_hour;
	}
	function getEndHour()
	{
		return $this->end_hour;
	}
	
	function setStatu($statu)
	{
		$this->statu = $statu;
	}
	function getStatu()
	{
		return $this->statu;
	}
	
	function setImages($images)
	{
		$this->images = $images;
	}
	function getImages()
	{
		return $this->images;
	}
	
	function setID($id)
	{
		$this->id = $id;
	}
	
	function getID()
	{
		return $this->id;
	}
	
	function setItemNum($item_num)
	{
		$this->item_num = $item_num;
	}
	
	function getItemNum()
	{
		return $this->item_num;
	}
	
}
?>