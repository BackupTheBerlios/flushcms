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
 * @version v1.0, last update on May 19, 2006 9:52:39 AM
 * @package System.Web.UI.WebControlsExt
 */

class PNavMenuCommandItem extends TWebControl implements IPostBackEventHandler 
{
	private $text='';
	private $itemID='';
	/**
	* Constructor.
	*/
	function __construct($text='')
	{
		$this->text = $text;
		parent::__construct();
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
		$text = $this->text;
		if(empty($text))
			$text = $this->renderBody();
		return $text;
		
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
		$this->text=$value;
		
	}
	/**
	 * @return boolean whether the text should be HTML encoded before rendering
	 */
	public function isEncodeText()
	{
		return $this->getViewState('EncodeText',true);
	}

	/**
	 * Sets the value indicating whether the text should be HTML encoded before rendering
	 * @param boolean whether the text should be HTML encoded before rendering
	 */
	public function setEncodeText($value)
	{
		$this->setViewState('EncodeText',$value,true);
	}
	/**
	 * @return string the command name associated with the <b>OnCommand</b> event.
	 */
	public function getCommandName()
	{
		return $this->getViewState('CommandName','');
	}

	/**
	 * Sets the command name associated with the <b>OnCommand</b> event.
	 * @param string the text caption to be set
	 */
	public function setCommandName($value)
	{
		$this->setViewState('CommandName',$value,'');
	}

	/**
	 * @return string the parameter associated with the <b>OnCommand</b> event
	 */
	public function getCommandParameter()
	{
		return $this->getViewState('CommandParameter','');
	}

	/**
	 * Sets the parameter associated with the <b>OnCommand</b> event.
	 * @param string the text caption to be set
	 */
	public function setCommandParameter($value)
	{
		$this->setViewState('CommandParameter',$value,'');
	}
	/**
	 * @return boolean whether postback event trigger by this button will cause input validation
	 */
	public function causesValidation()
	{
		return $this->getViewState('CausesValidation',true);
	}

	/**
	 * Sets the value indicating whether postback event trigger by this button will cause input validation.
	 * @param string the text caption to be set
	 */
	public function setCausesValidation($value)
	{
		$this->setViewState('CausesValidation',$value,true);
	}

	/**
	 * @return string the group of validators which the button causes validation upon postback
	 */
	public function getValidationGroup()
	{
		return $this->getViewState('ValidationGroup','');
	}

	/**
	 * @param string the group of validators which the button causes validation upon postback
	 */
	public function setValidationGroup($value)
	{
		$this->setViewState('ValidationGroup',$value,'');
	}
	/**
	 * Raises postback event.
	 * The implementation of this function should raise appropriate event(s) (e.g. OnClick, OnCommand)
	 * indicating the component is responsible for the postback event.
	 * This method is primarily used by framework developers.
	 * @param string the parameter associated with the postback event
	 */
	public function raisePostBackEvent($param)
	{
		$this->onClick(new TEventParameter);
		$cmdParam=new TCommandEventParameter;
		$cmdParam->name=$this->getCommandName();
		$cmdParam->parameter=$this->getCommandParameter();
		$this->onCommand($cmdParam);
	}

	/**
	 * This method is invoked when the component is clicked.
	 * The method raises 'OnClick' event to fire up the event delegates.
	 * If you override this method, be sure to call the parent implementation
	 * so that the event delegates can be invoked.
	 * @param TEventParameter event parameter to be passed to the event handlers
	 */
	public function onClick($param)
	{
		$this->raiseEvent('OnClick',$this,$param);
	}

	/**
	 * This method is invoked when the component is clicked.
	 * The method raises 'OnCommand' event to fire up the event delegates.
	 * If you override this method, be sure to call the parent implementation
	 * so that the event delegates can be invoked.
	 * @param TCommandEventParameter event parameter to be passed to the event handlers
	 */
	public function onCommand($param)
	{
		$this->raiseEvent('OnCommand',$this,$param);
		$this->raiseBubbleEvent($this,$param);
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
	* @since    version - May 19, 2006
	* @param	datatype paramname description
	* @return   datatype description
	*/
//	function getItemID () 
//	{
//		return $this->ClientID;
//	}
//	
//	protected function renderBody()
//	{
//		$text=$this->isEncodeText()?pradoEncodeData($this->getText()):$this->getText();
//		$text.=$this->getID();
//		return strlen($text)?$text:parent::renderBody();
//	}
	
	
	
}

?>
