<?php
/**
 *
 * sfToolbar class.
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfToolbar.class.php,v 1.2 2006/08/26 04:45:04 arzen Exp $
 */

require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/JavascriptHelper.php');
class sfToolbar
{
	private $buttons ;
	private $display_mode=0 ;
	private $bar_width='100%' ;
	private $button_width=25 ;
	private $button_height=25 ;
	
	function renderHtml()
	{
		echo stylesheet_tag('sfToolbar/dhtmlXToolbar.css');
		echo javascript_include_tag('sfToolbar/dhtmlXProtobar.js');
		echo javascript_include_tag('sfToolbar/dhtmlXToolbar.js');
		echo javascript_include_tag('sfToolbar/dhtmlXCommon.js');
		echo $this->renderTable();
		echo javascript_tag($this->buildData());
	}
	
	function setButton ($image="",$url="",$tooltip="") 
	{
		$image = ($image=='--')?$image:image_path("sfToolbar/{$image}");
		$url = url_for($url, true);;
		$this->buttons[]=array('Image'=>$image,'Url'=>$url,'ToolTip'=>$tooltip);
	}
	
	function parseButtons () 
	{
		$html_code="";
		foreach($this->buttons as $button)
		{
			if ($button["Image"]=='--') 
			{
				$html_code.="aToolBar.addItem(new dhtmlXToolbarDividerXObject('b_'+(new Date()).valueOf())); \n";
				
			} 
			else 
			{
				$html_code.=" aToolBar.addItem(new dhtmlXImageButtonObject('{$button["Image"]}',{$this->button_width},{$this->button_height},1,'{$button["Url"]}','{$button["ToolTip"]}')); \n";
			}
		}
		return $html_code;
	}
	
	function setBarWidth ($value='100%') 
	{
		$this->bar_width=$value;
	}
	
	function setButtonHW ($width,$height) 
	{
		$this->button_width=$width;
		$this->button_height=$height;
	}
	
	function setDisplayMode ($mode='horizontal') 
	{
		$this->display_mode=($mode=='vertical')?1:0;
	}
	
	function buildData () 
	{
		
		$buttons_js = $this->parseButtons();
		$html_code = <<<EOD
		
	//init toolbar 
	aToolBar=new dhtmlXToolbarObject('toolbar_zone','{$this->bar_width}',20,"",{$this->display_mode});
	// set processing function 
	aToolBar.setOnClickHandler(onOpenURL); 
	//load toolbar from xml
	{$buttons_js}
	//show toolbar 
	aToolBar.showBar(); 
	function onOpenURL(itemId,itemValue)
	{ 
//		alert("Button "+itemId+" was pressed");
		window.location=itemId;
	}; 

EOD;
		return $html_code;
	}
	
	function renderTable () 
	{
		$html_code = <<<EOD
		
	<table width="100%">
		<tr>
			<td>
				<div id="toolbar_zone" style="width:100%; border :1px solid Silver;"/>
			</td>
		</tr>
	</table>

EOD;
		return $html_code;
		
	}

}
?>