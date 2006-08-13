<?php
/**
 *
 * ApplicationMenu.php class.
 *
 * @package    symfony.runtime.addon
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfDojoApplicationMenu.class.php,v 1.1 2006/08/13 04:57:29 arzen Exp $
 */
require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/JavascriptHelper.php');
class sfDojoApplicationMenu
{
	private $main_item = array();
	private $sub_item = array();
	private $item_html = "";
	/**
	 * @author John.meng
	 *
	 */
	public function renderMenu ($items=null) 
	{
	    $response = sfContext::getInstance()->getResponse();
	    $response->addJavascript('/sfdojo/dojo');
	    $header_js = "dojo.require(\"dojo.widget.Menu2\");\n dojo.hostenv.writeIncludes();\n";
	    $js_data = javascript_tag($header_js);
//	    $menu_data = $items;
		$this->renderMainContianer();
		$menu_data = $this->renderMainItem().$this->item_html;
		
    	return $js_data.$menu_data;
	}
	/**
	 * @author John.meng
	 *
	 */
	public function setMainItem($title,$sub_item,$disabled=false,$type='MenuBarItem2') 
	{
		$this->main_item[]=array('caption'=>$title,'submenuId'=>$sub_item,'dojoType'=>$type,'disabled'=>$disabled);
	}
	
	private function renderMainItem () 
	{
		$main_item_html = "\r\n <div dojoType=\"MenuBar2\">";
		foreach($this->main_item as $main_item)
		{
			$main_item_html .=$this->renderItem($main_item);
		}
		$main_item_html .="</div> \r\n";
		return $main_item_html;
	}
	/**
	 * @author John.meng
	 *
	 */
	public function setSubItem($title,$parent_name,$sub_item=null,$disabled=false,$type='MenuBarItem2',$url="") 
	{
		$this->sub_item[]=array('caption'=>$title,'widgetId'=>$parent_name,'submenuId'=>$sub_item,'dojoType'=>$type,'disabled'=>$disabled,'url'=>$url);
	}
	/**
	 * @author John.meng
	 *
	 */
	function renderMainContianer () 
	{
		$item_html = "";
		foreach($this->main_item as $item)
		{
			if ($item['submenuId']) 
			{
				$item_html .= $this->renderSubContainer($item['submenuId']);
			}
		}
		$item_html .="";
		return $item_html ;
	}
	
	function renderSubContainer ($container_name) 
	{
		$item_html = $tmp_html="";
		foreach($this->sub_item as $item)
		{
			if ($item['widgetId']== $container_name) 
			{
//				echo $item['widgetId']."<br/>";
				if ($item['submenuId']) 
				{
					$tmp_html .=$this->renderItem($item);
					$this->item_html .= $this->renderSubContainer($item['submenuId']);
				} 
				else 
				{
					$tmp_html .=$this->renderItem($item);
				}
			}
		}
		if ($tmp_html) 
		{
			$item_html = "\r\n <div dojoType=\"PopupMenu2\" widgetId=\"{$container_name}\" > \n";
			$item_html .=$tmp_html;
			$item_html .="</div> \r\n";
			
		}
		$this->item_html .= $item_html;
	}
	
	function renderItem ($item) 
	{
		$item_html =" \r\n <div dojoType=\"{$item['dojoType']}\" caption=\"{$item['caption']}\"";
		$item_html .=$item['submenuId']? "submenuId=\"{$item['submenuId']}\" ":"";
		$item_html .=$item['disabled']? "disabled=\"{$item['disabled']}\" ":"";
		$item_html .=$item['url']? "onClick=\"window.location='".url_for($item['url'], true)."' \" ":"";
		$item_html .= " ></div> \r\n";
		return $item_html;
	}
	
	
}
?>
