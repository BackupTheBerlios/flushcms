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
 * @version v1.0, last update on May 19, 2006 10:04:34 AM
 * @package System.Web.UI.WebControlsExt
 */

class PActiveNavMenuCommandItem extends PNavMenuCommandItem implements ICallbackEventHandler, IActiveControl
{
	/**
	 * Sets the callback options control ID. {@see getRequestOptions()}
	 * @param string TCallbackOptions control ID.
	 */
	public function setCallbackOptions($value)
	{
		$this->setViewState('CallbackOptions', $value, '');
	}
	
	/**
	* Gets the callback options control ID. {@see getRequestOptions()}. 
	 * @return CallbackOptions ID
	 */
	public function getCallbackOptions()
	{
		return $this->getViewState('CallbackOptions', '');
	}

	/**
	 * Get callback request
	 */
	protected function getRequestOptions($options=array())
	{
		$id = $this->getCallbackOptions();
		if(strlen(trim($id)) <= 0) return;
		$request = $this->Parent->findObject($id);
		if($request instanceof TCallbackOptions )
		{
			$options['CausesValidation'] = $this->causesValidation();
			$options['ValidationGroup'] = $this->getValidationGroup();
			return $request->getOptions($options);
		}
		else
			throw new TException("'{$id}' is not a valid TCallbackOptions component");
	}

	/**
	 * Raised when the button is clicked or when a callback is requested.
	 * Raises the parent PostBackEvent. 
	 * @see TButton::raisePostBackEvent()
	 */
	public function raiseCallbackEvent($param)
	{
		$this->raisePostBackEvent($param);
	}

	/**
	 * Sets the text of the button using the callback client.
	 * @param string new text value
	 */
	public function setText($text)
	{
		parent::setText($text);
		if($this->Page && $this->Page->IsActiveAction)
		{
			$text = $this->isEncodeText()?pradoEncodeData($text):$text;
			$this->Page->CallbackClient->Element->update($this, $text);
		}
	}

	/**
     * Appends the callback javascript statement to the input button html.
	 * @return string TActiveButton html output.
	 */
	public function render()
	{
		$contents = parent::render();
		$js = $this->Page->getCallbackReference($this,null,null,$this->getRequestOptions());
		$script = $this->Page->getClientEventScript($this, "click", $js);
		$contents .= TJavascript::render($script);
		return $contents;
	}
}
?>
