<?php
/**
 * TTabPanel class file
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the BSD License.
 *
 * Copyright(c) 2004 by Vegard Hanssen.
 *
 * To contact the author write to {@link mailto:Vegard@menneske.no Vegard Hanssen}
 * The latest version of PRADO can be obtained from:
 * {@link http://prado.sourceforge.net/}
 *
 * @author Vegard Hanssen <Vegard@menneske.no>
 * @version $Revision$  $Date$
 * @package prado
 */

/**
 * TTabPanel class
 *
 * This is a class to make tab panels. It uses visibility on the TPanel
 * components to show or hide them. You need to put a TForm around it
 * to make it work.
 *
 * You can only fill the TTabPanel with TPanel components. (You can fill
 * those TPanel components with whatever you want)
 *
 * You can override renderTab(TLinkButton) to make your own look. You can
 * also override getTabHeader(), getPanelHeader() and getPanelFooter().
 *
 * Here is a little example of the use, <page>.tpl
 * <code>
 * <html>
 * <link rel="stylesheet" type="text/css" href="css/tab.css">
 * <body>
 * <com:TForm>
 * <com:TTabPanel ShowPage="psecond" Pages="pfirst:First,psecond:Second">
 * <com:TPanel ID="pfirst">
 * This is the first panel
 * </com:TPanel>
 * <com:TPanel ID="psecond">
 * This is the second panel
 * </com:TPanel>
 * </com:TTabPanel>
 * </com:TForm>
 * </body>
 * </html>
 * </code>
 *
 * Note: Since the standard TTabPanel component uses <li> as setting
 * up the tabs you should use a css to show it correctly
 *
 * Namespace: System.Web.UI.WebControls
 *
 * Properties
 * - <b>ShowPage</b>, string, kept in viewstate
 *   <br>Gets or sets the name of the TPanel which will be visible
 * - <b>Pages</b>, string, kept in viewstate
 *   <br>Gets or sets the pages.
 *   The format is <tpanel-id>:<text>,...
 * - <b>DivId</b>, string
 *   <br>This set a div id tag around the panel. Default "tabpanel"
 * - <b>DivMenuId</b>, string
 *   <br>This set a div id tag around the menu of the panel. Default "tabmenu"
 * - <b>UlNavId</b>, string
 *   <br>This set a div id tag on the ul element of the menu. Default "tabnav"
 * - <b>DivBodyId</b>, string
 *   <br>This set a div id tag around the body of the panel. Default "tabbody"
 *
 * @author Vegard Hanssen <Vegard@menneske.no>
 * @version v0.71, last update on 2004/12/13 12:00:00
 * @package prado
 */


class TTabPanel extends TWebControl
{
  protected $pages = array();
  protected $divid = 'tabpanel';
  protected $divmenuid = 'tabmenu';
  protected $ulnavid = 'tabnav';
  protected $divbodyid = 'tabbody';

  /**
   * @return string TPanel name to show
   */
  public function getShowPage() {
    return $this->getViewState('ShowPage', 'default');
  }

  /**
   * @param string TPanel name to show
   */
  public function setShowPage($value)
  {
    $this->setViewState('ShowPage',$value, 'default');
    $this->updatePanelVisibility();
  }

  /**
   * @return string TPanel name to show
   */
  public function getPages() {
    return $this->getViewState('Pages', '');
  }

  /**
   * @param string TPanel name to show
   */
  public function setPages($value) {
    $this->setViewState('Pages',$value,'');
    // cache data for easier access later
    $pages = split(',', $value);
    foreach($pages as $page) {
      list($tpanel, $text) = split(':', $page);
      $this->pages[] = array($tpanel, $text);
    }
  }

  /**
   * @return string the div id for the panel
   */
  public function getDivId() {
    return $this->divid;
  }

  /**
   * @param string the div id for the panel
   */
  public function setDivId($value) {
    $this->divid = $value;
  }

  /**
   * @return string the div id for the menu
   */
  public function getDivMenuId() {
    return $this->divmenuid;
  }

  /**
   * @param string the div id for the menu
   */
  public function setDivMenuId($value) {
    $this->divmenuid = $value;
  }

  /**
   * @return string the div id for the ul
   */
  public function getUlNavId() {
    return $this->ulnavid;
  }

  /**
   * @param string the div id for the ul
   */
  public function setUlNavId($value) {
    $this->ulnavnid = $value;
  }

  /**
   * @return string the div id for the body
   */
  public function getDivBodyId() {
    return $this->divbodyid;
  }

  /**
   * @param string the div id for the body
   */
  public function setDivBodyId($value) {
    $this->divbodyid = $value;
  }

  /**
	 * Only allow TPanel and TLinkButton components as childs
	 * @param mixed the object to be added
	 * @return boolean
	 */
	public function allowBody($object)
	{
    if (($object instanceof TPanel)
      || ($object instanceof TLinkButton)) {
      return true;
    }
    
		return false;
	}

  public function onLoad($param) {
    parent::onLoad($param);

    // Create all page links
    foreach($this->pages as $page) {
      $link = $this->createComponent("TLinkButton");
      
      // Tabbing should not cause validation
      $link->setCausesValidation(false);
      
      $link->setText($page[1]);
      $link->attachEventHandler("OnCommand", "doPageChange", $this);
      $link->setCommandName('__pagechange');
      $link->setCommandParameter($page[0]);
      $this->addBody($link);
      $link->onInit($param);
      $link->onLoad($param);
      $link->initProperties();
    }
  }

  /**
   * Sets the new page to show
   */
  public function doPageChange($sender, $param) {
    $oldPage = $this->getShowPage();
    $newPage = $param->parameter;

    if ($newPage != $oldPage) {
      if ($param->name === '__pagechange') {
        $this->setShowPage($newPage);
      }

      $panelParam = new TTabPanelEventParameter;
      $panelParam->oldPage = $oldPage;
      $panelParam->newPage = $newPage;
      $this->raiseEvent('OnPageChange',$this,$panelParam);
    }
  }

  protected function updatePanelVisibility() {
    $children = $this->getBodies();
    if ($children->length() == 0) {
      return;
    }
  
    $visibleId = $this->getShowPage();
    foreach ($children as $child) {
      if ($child instanceof TPanel) {
        $child->setVisible(false);
        if ($child->getID() === $visibleId) {
          $child->setVisible(true);
        }
      }
    }
  }

  public function onPreRender()
  {
    $this->updatePanelVisibility();
  }

  /**
   * Render the panel
   * Will call renderTab() on every tab and
   * set all other TPanels than the ShowPage to invisible
   */
  public function render() {
    $content = '';

    $children = $this->getBodies();
    if ($children->length() > 0) {
      // Show all tabs
      $content .= $this->getTabHeader();
      foreach($children as $child) {
        if($child instanceof TLinkButton)
          $content .= $this->renderTab($child);
      }
      $content .= $this->getPanelHeader();

      // Render panels
      foreach($children as $child) {
        if (($child instanceof TPanel) &&
          ($child->isVisible ()))
          $content .= $child->render();
      }
      $content .= $this->getPanelFooter();
    }
    return $content;
  }

  /**
   * Render a tab
   * Override this to make your own presentation
   */
  protected function renderTab($link) {
    if ($link->getCommandParameter() === $this->getShowPage())
      $link->setCssClass("active");

    $content = '<li>'.$link->render().'</li>'."\n";
    return $content;
  }

  /**
   * Return the text before the tabs are rendered
   * Can be overridden to make your own layout.
   * Standard it sets a <div id="tabmenu"> and a
   * <ul id="tabnav"> around the tabs
   */
  protected function getTabHeader() {
    return '<div id="'.$this->getDivId().'">'.
      '<div id="'.$this->getDivMenuId().'">'.
      '<ul id="'.$this->getUlNavId().'">'."\n";
  }

  /**
   * Return the text after tabs are rendered and before
   * the panel are rendered.
   * Can be overriden to make your own layout.
   * Standard it sets <td class="tabbody"> around the panel
   */
  protected function getPanelHeader() {
    return '</ul></div>'."\n".'<div id="'.$this->getDivBodyId().'">'."\n";
  }

  /**
   * Return the text after the panel
   * Can be overriden to make your own layout.
   */
  protected function getPanelFooter() {
    return '</div></div>'."\n";
  }
}

?>
