<?php
/**
 *
 * sfToolbar class.
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfToolbar.class.php,v 1.1 2006/08/22 23:34:20 arzen Exp $
 */

require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/JavascriptHelper.php');
class sfToolbar
{

	function renderHtml()
	{
		echo stylesheet_tag('sfToolbar/dhtmlXToolbar.css');
		echo javascript_include_tag('sfToolbar/dhtmlXProtobar.js');
		echo javascript_include_tag('sfToolbar/dhtmlXToolbar.js');
		echo javascript_include_tag('sfToolbar/dhtmlXCommon.js');
		echo $this->renderTable();
		echo javascript_tag($this->buildData());
	}
	
	function buildData () 
	{
		
		$image1 = image_path('sfToolbar/iconSave.gif');
		$html_code = <<<EOD
		
	//init toolbar 
	aToolBar=new dhtmlXToolbarObject('toolbar_zone','100%',30,"dddd");
	// set processing function 
	aToolBar.setOnClickHandler(onButtonClick); 
	//load toolbar from xml
	aToolBar.addItem(new dhtmlXImageButtonObject('{$image1}',20,18,0,'new_Id','New tooltip'));
	aToolBar.addItem(new dhtmlXToolbarDividerXObject('b_'+(new Date()).valueOf()));
	//show toolbar 
	aToolBar.showBar(); 
	function onButtonClick(itemId,itemValue)
	{ 
		alert("Button "+itemId+" was pressed");
	}; 

EOD;
		return $html_code;
	}
	
	function renderTable () 
	{
		$html_code = <<<EOD
		
	<table>
		<tr>
			<td>
				<div id="toolbar_zone" style="width:600; border :1px solid Silver;"/>
			</td>
		</tr>
		<tr>
		<td>
			
		</td>
		</tr>
	</table>

EOD;
		return $html_code;
		
	}

}
?>