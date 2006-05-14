<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the BSD License.
 *
 * Copyright(c) 2004 by Qiang Xue. All rights reserved.
 *
 * To contact the author write to {@link mailto:qiang.xue@gmail.com Qiang Xue}
 * The latest version of PRADO can be obtained from:
 * {@link http://prado.sourceforge.net/}
 *
 * @author John.meng <john.meng@achievo.com>
 * @version $id$
 * @package System.Web.UI.WebControlsExt
 */
 
require_once(dirname(__FILE__).'/PNavMenuItemContainer.php');
require_once(dirname(__FILE__).'/PNavMenuItem.php');
/**
 * TControl class
 *
 * TControl comment write here.
 *
 * Namespace: System.Web.UI.WebControls
 *
 * Properties
 * - <b>Text</b>, string, kept in viewstate
 *   <br />Returns result.
 *
 * Events
 * - <b>OnEvents</b> Events comment write here.
 *
 * @author John.meng <john.meng@achievo.com>
 * @version v1.0, last update on May 11, 2006 1:47:15 PM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuPanel extends TWebControl  implements IActiveControl
{
	/**
	 * list of TListItem controls
	 */
	protected $menuItemContainer;
	/**
	* Constructor.
	*/
	function __construct()
	{
		parent::__construct();
		$this->setTagName('div');
		$this->menuItemContainer = new TCollection();
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getDisplayMode () 
	{
		return $this->getViewState('DisplayMode', 'Horizontal');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setDisplayMode ($value) 
	{
		if($value!=='Vertical')
			$value='Horizontal';
		$this->setViewState('DisplayMode',$value,'Horizontal');
		
	}
	/**
	 * This method overrides the parent implementation to handle TListItem.
	 * @param TComponent|string the newly parsed object
	 * @param TComponent the template owner
	 */
	public function addParsedObject($object,$context)
	{
		if($object instanceof PNavMenuItemContainer)
			$this->menuItemContainer->add($object);
	}
	/**
	 * @return ArrayObject list of TListItem components
	 */
	public function getMenuItemContainer()
	{
		return $this->menuItemContainer;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getHorizontalCSS () 
	{
		return $this->getViewState('CSSFile', 'menu_styles.css');		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 12, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setHorizontalCSS ($value) 
	{
        $this->setViewState('CSSFile',$value,'menu_styles.css');
	}
	
	
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function renderBody () 
	{
		$content=$this->getDisplayMode ();
		$content.=$this->parsedContainer ($this-> getMenuItemContainer(),$level=0);		
//		$x=0;
//		foreach($this-> getMenuItemContainer() as $menuItemContainer)
//		{
//			$content.="<div><ul>父层开始：内容是$x";
//			$y=0;		
//			foreach($menuItemContainer->getMenuItems() as $menuItems)
//			{
//				if ($menuItems instanceof PNavMenuItem) 
//				{
//					$text=$menuItems->getText();
//					$content.="<li>子层$y 内容是=> $text <br/>";
//					$content.=$this->parsedContainer ($menuItems);
////					foreach($menuItems->getSubMenuItemContainer() as $subMenuItemContainer)
////					{
////						$content.="&nbsp;&nbsp;父类 <br/>";
////						foreach($subMenuItemContainer->getMenuItems() as $subMenuItems)
////						{
////							$text=$subMenuItems->getText();
////							$content.="&nbsp;&nbsp;&nbsp;&nbsp;子子层$y 内容是=> $text <br/>";
////						}
////						
////					}
//					
//					
//				} 
//				$y++;
//			}
//			$x++;
//			$content.="父层结束<=<br/></div>";
//		}
		
		
//		$x=0;
//		foreach($this-> getMenuItemContainer() as $menuItemContainer)
//		{
//			$content.="<div><ul>父层开始：内容是$x";
//			$y=0;		
//			foreach($menuItemContainer->getMenuItems() as $menuItems)
//			{
//				if ($menuItems instanceof PNavMenuItem) 
//				{
//					$text=$menuItems->getText();
//					$content.="<li>子层$y 内容是=> $text <br/>";
//					foreach($menuItems->getMenuItemContainer() as $subMenuItemContainer)
//					{
//						$content.="&nbsp;&nbsp;父类 <br/>";
//						foreach($subMenuItemContainer->getMenuItems() as $subMenuItems)
//						{
//							$text=$subMenuItems->getText();
//							$content.="&nbsp;&nbsp;&nbsp;&nbsp;子子层$y 内容是=> $text <br/>";
//						}
//						
//					}
//					
//					
//				} 
//				$y++;
//			}
//			$x++;
//			$content.="父层结束<=<br/></div>";
//		}
		$content.='';
		return $content;		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - 2006-5-14
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function parsedContainer ($ContainerCollection,$level=0) 
	{
		if ($ContainerCollection->length()>0) 
		{
			$z=0;
			foreach($ContainerCollection as $menuItemContainer)
			{
				$content.="<div><ul>父层 $z _ $level 开始</br>";
				$y=0;
				foreach($menuItemContainer->getMenuItems() as $menuItems)
				{
					$text=$menuItems->getText();
					$content.="<li>子层 $z _ $y 内容是=> $text <br/>";
					
					//递归子菜单包含容器
					if ($menuItems->getSubMenuItemContainer()->length()>0) 
					{
						$level++;
						$content.=$this->parsedContainer ($menuItems->getSubMenuItemContainer(),$level);
					}
					
					$y++;
				}
				$content.="父层结束<=<br/></div>";
				$z++;
			}
			
		}

		return $content;

	}
	
	
}

?>
