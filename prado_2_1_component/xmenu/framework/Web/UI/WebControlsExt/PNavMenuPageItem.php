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
 * @version v1.0, last update on May 19, 2006 9:23:31 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuPageItem extends TWebControl
{
	private $text='';
	private $page='';
	private $module='';
	/**
	* Constructor.
	*/
	function __construct($text='',$page='',$module='')
	{
		$this->text = $text;
		$this->page = $page;
		$this->module = $module;
		parent::__construct();
		$this->setTagName('li');		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getText () 
	{
		return $this->getViewState('Text', '');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 11, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setText ($value) 
	{
		$this->setViewState('Text',$value,'');
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getPages () 
	{
		$page = $this->page;
		if(empty($page))
			$page = $this->renderBody();
		return $page;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setPages ($value) 
	{
		$this->page=$value;
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function getModules () 
	{
		$module = $this->module;
		if(empty($module))
			$module = $this->renderBody();
		return $module;
		
	}
	/**
	* function_description
	*
	* @author	John.meng
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
	function setModules ($value) 
	{
		$this->module=$value;
		
	}
	
//	public function addParsedObject($object,$context)
//	{
//		if( ($object instanceof PNavMenuPageItem) || ($object instanceof PNavMenuCommandItem) )
//			$this->menuItems->add($object);
//	}
	/**
	 * function_description
	 *
	 * @author	John.meng
	 * @since    version - Sat May 20 10:20:45 CST 2006
	 * @param	datatype paramname description
	 * @return   datatype description
	 */
//	 function renderBody () 
//	 {
//	 	$body=$this->getBodies();
//	 	$text = $this->getText();
//	 	$content.=$text;
//	 	foreach ($body as $item) 
//	 	{
//	 		if ($item instanceof PNavMenuPageItem) 
//	 		{
////	 			$id = $item->getID();
////			 	$text = $item->getText();
////			 	$content.="<br/>{$text}{$id}<br/>";
//				if ($item->getBodies()->getDa) {
//					
//				}
//			 	$content.=$this->renderBody();
//	 			
//	 		}
//	 		
//	 	}
//	 	return $content;
//	 }
	  
	
	
	
	

	
}
?>
