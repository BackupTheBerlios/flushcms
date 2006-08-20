<?php
/**
 *
 * sfDropDownMenu class.
 * 
 * Usage:
 * 
 * $dropdown_menu = new sfDropDownMenu();
 * $menu_array=array(
 *     1 => array(
 *         'title' => 'System', 
 *         'url' => '',
 *         'sub' => array(
 *                     11 => array('title' => 'Add user', 'url' => 'users/create'),
 *                     12 => array('title' => 'User list', 'url' => 'users')
 *         )
 *     ),
 *     2 => array(
 *         'title' => 'Quit', 
 *         'url' => 'security/logout'
 *     )
 * );
 * $dropdown_menu->setMenuArray($menu_array);
 * $dropdown_menu->renderFootJs () ; 
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfDropDownMenu.class.php,v 1.1 2006/08/20 05:27:51 arzen Exp $
 */
require_once(sfConfig::get('sf_symfony_lib_dir').'/helper/JavascriptHelper.php');
class sfDropDownMenu
{

	private $menu_array;
	
	function renderMenu()
	{
	
		echo stylesheet_tag('sfDropDownMenu/vertical.css');
		echo javascript_include_tag('sfDropDownMenu/ie5.js');
		echo javascript_include_tag('sfDropDownMenu/XulMenu.js');
		$image_arrow1 = image_path('sfDropDownMenu/arrow1.gif');
		$image_arrow2 = image_path('sfDropDownMenu/arrow2.gif');
		
		$preload_image_js = <<<EOD
		
    /* preload images */
    var arrow1 = new Image(4, 7);
    arrow1.src = "{$image_arrow1}";
    var arrow2 = new Image(4, 7);
    arrow2.src = "{$image_arrow2}";
		
EOD;

		echo javascript_tag($preload_image_js);
		
		
		echo $this->renderMenuData();

	
	}
	
	function renderFootJs () 
	{
		$image_arrow1 = image_path('sfDropDownMenu/arrow1.gif');
		$image_arrow2 = image_path('sfDropDownMenu/arrow2.gif');
		$parse_menu_js = <<<EOD
		
    var menu1 = new XulMenu("menu1");
    menu1.type = "vertical";
    menu1.position.level1.left = 2;
    menu1.arrow1 = "{$image_arrow1}";
    menu1.arrow2 = "{$image_arrow2}";
    menu1.init();
		
EOD;
		echo javascript_tag($parse_menu_js);
		
	}
	
	function setMenuArray ($menu_array="") 
	{
		$this->menu_array = $menu_array;
	}
	
	function parseMenuArray ($menu_array,$level = 0) 
	{
		$html_code ="";
		$image_arrow1 = image_path('sfDropDownMenu/arrow1.gif');
		
		$class_name = $level>0?"item":"button";
		if (is_array($menu_array)) 
		{
			foreach($menu_array as $key=>$value)
			{
				$title = $value['title'];
				$link = url_for($value['url'], true);
				if (is_array($value['sub'])) 
				{
					$html_code .= <<<EOD
                    <a class="{$class_name}" href="javascript:void(0)">{$title}<img class="arrow" src="{$image_arrow1}" width="4" height="7" alt="" /></a>
                    <div class="section">
EOD;
					$level++;
					$html_code .=$this->parseMenuArray($value['sub'],$level);
					$level=0;
					
					$html_code .="</div>";
				} 
				else 
				{
					$html_code .= "<a class=\"$class_name\" href=\"{$link}\">{$title}</a>";
				}
			}
		}
		
		return $html_code;
	}
	
	function renderMenuData () 
	{
		
		$menu_array=$this->parseMenuArray($this->menu_array);
		
		$menu_data = <<<EOD
    <table cellspacing="0" cellpadding="0" height="100%"><tr><td id="bar">
        
        <table cellspacing="0" cellpadding="0" id="menu1" class="XulMenu">
        <tr>
            <td>
				{$menu_array}
            </td>
        </tr>
        </table>
    </td></tr></table>
 		
EOD;
		return $menu_data;
	}
	
}
?>