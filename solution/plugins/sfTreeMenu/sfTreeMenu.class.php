<?php
/**
 *
 * sfTreeMenu class.
 * 
 * Usage:
 * 
 * $tree_menu = new sfTreeMenu();
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
 * $tree_menu->setMenuArray($menu_array);
 * $tree_menu->renderMenu () ; 
 *
 * @package    symfony.runtime.plugin
 * @author     John.meng <arzen1013@gmail.com>
 * @version    SVN: $Id: sfTreeMenu.class.php,v 1.1 2006/08/20 10:00:20 arzen Exp $
 */

class sfTreeMenu
{

	private $menu_array;

	function renderMenu () 
	{
		echo stylesheet_tag('sfTreeMenu/DynamicTree.css');
		echo javascript_include_tag('sfTreeMenu/ie5.js');
		echo javascript_include_tag('sfTreeMenu/DynamicTree.js');
		
		echo $this->renderMenuData();
		
		
		$append_js = <<<EOD
		
    var tree = new DynamicTree("tree");
    tree.init();
		
EOD;

		echo javascript_tag($append_js);
		
	}
	
	function setMenuArray ($menu_array="") 
	{
		$this->menu_array = $menu_array;
	}
	
	function parseMenuArray ($menu_array) 
	{
		
		$html_code ="";
		if (is_array($menu_array)) 
		{
			foreach($menu_array as $key=>$value)
			{
				$title = $value['title'];
				$link = url_for($value['url'], true);
				if (is_array($value['sub'])) 
				{
					
					$html_code .="<div class=\"folder\">{$title}";
					
					$html_code .=$this->parseMenuArray($value['sub']);
					
					$html_code .="</div>";
				} 
				else 
				{
					$html_code .= " <div class=\"doc\"><a href=\"{$link}\">{$title}</a></div> \n ";
				}
			}
			
		}
		
		return $html_code;
	} 
	
	function renderMenuData () 
	{
		$menu_array=$this->parseMenuArray($this->menu_array);
		$menu_data = <<<EOD
		
    <div class="DynamicTree">
        <div class="wrap" id="tree">
            {$menu_array}
        </div>
    </div>

 		
EOD;
		return $menu_data;
		
	}
	
}
?>