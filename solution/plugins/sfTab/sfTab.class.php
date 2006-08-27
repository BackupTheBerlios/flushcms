<?php
/**
 *
 * sfTab class.
 * 
 * Usage:
 * $top_tab = new sfTab();
 * $top_tab->setItem (__("Users Listing"),'users');
 * $top_tab->setDefaultItem (__("Users Listing"));
 * $top_tab->renderHtml();
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfTab.class.php,v 1.1 2006/08/27 05:47:05 arzen Exp $
 */

class sfTab
{
	private $item_data;
	private $default_item;
	
	function renderHtml	()
	{
		echo stylesheet_tag('sfTab/ajaxtabs.css');
		echo javascript_include_tag('sfTab/ajaxtabs.js');
		echo $this->parseItemData();
	}
	
	function setItem ($Title="",$Url="") 
	{
		$this->item_data[]=array('Title'=>$Title,'Url'=>url_for($Url, true));
	}
	
	function setDefaultItem ($value) 
	{
		$this->default_item = $value;
	}
	
	function parseItemData () 
	{
		$html_code="<ul id=\"maintab\" class=\"shadetabs\">";
		
		foreach($this->item_data as $item)
		{
			if ($item['Title']==$this->default_item) 
			{
				$class_name = "class=\"selected\"";
			} 
			else 
			{
				$class_name = "";
			}
			$html_code.="<li {$class_name} ><a href=\"{$item['Url']}\" rel=\"ajaxcontentarea\">{$item['Title']}</a></li>";
		}
		
		$html_code.="</ul>";
		
		return $html_code;
	}
	
}
?>