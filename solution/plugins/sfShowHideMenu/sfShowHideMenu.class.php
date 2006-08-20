<?php
/**
 *
 * sfShowHideMenu class.
 * 
 * Useage:
 * 
 * $click_menu = new sfShowHideMenu();
 * $click_menu->setMenuSection(__("System"),__("Add User"),'users/create');
 * $click_menu->setMenuSection(__("System"),__("User List"),'users');
 * $click_menu->renderMenu();
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfShowHideMenu.class.php,v 1.1 2006/08/20 05:27:50 arzen Exp $
 */
require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/JavascriptHelper.php');

class sfShowHideMenu
{
	private $menu_data;
	
	function renderMenu()
	{
		echo javascript_include_tag('sfShowHideMenu/ClickShowHideMenu.js');
		echo stylesheet_tag('sfShowHideMenu/ClickShowHideMenu.css');
		echo $this->buildMenuData();
		$menu_js = "var clickMenu1 = new ClickShowHideMenu('click-menu1');\n clickMenu1.init();\n";
		echo javascript_tag($menu_js);
	}
	
	function setMenuBox ($title) 
	{
		$this->menu_data[] = $title;
	}
	
	function setMenuSection ($box_name="",$section_name="",$section_link="") 
	{
		$this->menu_data[$box_name][] = array('name'=>$section_name,'link'=>url_for($section_link, true));
	}
	
	function renderMenuItem () 
	{
		$html_code = "";
		
		foreach ($this->menu_data as $key => $value) 
		{
			$box_name = $key;
			$html_code .= <<<EOD
    
    <tr>
        <td>
            <div class="box1">{$box_name} </div>
			<div class="section">	
EOD;
			for ($y = 0; $y < sizeof($value); $y++) 
			{
				$section_name = $value[$y]['name'];
				$section_link = $value[$y]['link'];
				$html_code .= <<<EOD
				
				<div class="box2"><a href="{$section_link}">{$section_name}</a></div>		

EOD;
				
			}

			$html_code .= <<<EOD
			
			</div>
        </td>
    </tr>
    <tr><td height="2"></td></tr>
 		
EOD;
			
		}
		return $html_code;
	}
	
	function buildMenuData () 
	{
		$item_data = $this->renderMenuItem();
		$menu_data = <<<EOD
    <table cellspacing="0" cellpadding="0" id="click-menu1" class="click-menu">
		{$item_data}
    </table>
EOD;
		return $menu_data;
	}
	
}
?>