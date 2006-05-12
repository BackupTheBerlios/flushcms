
<?php
/**
* TCssDropDownMenuNode class file
*
* This program is free software; you can redistribute it and/or modify it
* under the terms of the GNU Lesser General Public License (LGPL) as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
* FITNESS FOR A PARTICULAR PURPOSE.  See the LGPL for more details.
*
* Copyright(c) 2004 - 2005 by Scott Fuelberth.
*
* To contact the author write to {@link mailto:skot@bastardcat.org Scott Fuelberth}
* The latest version of PRADO can be obtained from:
* {@link http://prado.sourceforge.net/}
*
* @author Scott Fuelberth <skot@bastardcat.org>
* @version $Revision$  $Date$
* @package System.Web.UI.WebControls
*/

/**
* TCssDropDownMenuNode class
*
* TCssDropDownMenuNode displays a css driven menu item. You can set the link through the   
* through the <b>LinkUrl</b> property. You can set the Text displayed for the item through the <b>Text</b> property.
* You can set the roles that are allowed to access the item through the <b>Roles</b> property.
*
* Example: <code><com:TCssDropDownMenuNode ID="ViewUsers" LinkUrl="?page=ViewUsersPage"
* Text="View Users" Roles="root,admin" BorderColor="green" BorderStyle="solid" BorderWidth="1" BackColor="white"/></code>
*
* Namespace: System.Web.UI.WebControls
*
* Properties
* - <b>LinkUrl</b>, string, kept in viewstate
*   <br/>Set the link for the item.
* - <b>Text</b>, string, kept in viewstate
*   <br/>Set the text for the item.
* - <b>Roles</b>, string, kept in viewstate
*   <br/>The user roles allowed to view the item.
*/
class TCssDropDownMenuNode extends TWebControl {
    
    const UNITS = 'em';
    
    /**
     * top parent flag
     * @var boolean
     */
    private $isTopParent = false;
    
    /**
     * top parent css class name
     * @var string
     */
    private $topParentNodeCssClass = '';
    
    /**
     * parent node css class name
     * @var string
     */
    private $parentNodeCssClass = '';
    
    /**
     * node css class name
     * @var string
     */
    private $nodeCssClass = '';
    
    /**
     * disabled node css class name
     * @var string
     */
    private $disabledNodeCssClass = '';
    
    private $cssFile;
    private $jsFile;
    private $level;
    
    /**
     * Constructor.
     * Sets TagName property to 'li'
     */
    function __construct() {
        parent::__construct();
        $this->setTagName('li');
    }
    
    /**
     * @return string the Roles allowd to view this element
     */
    public function getRoles() {
        return $this->getViewState('Roles', '');
    }    
    
    /**
     * @param string the Roles allowed to view this element
     */
    public function setRoles($value) {
        $this->setViewState('Roles',$value,'');
    }
    
    /**
     * @return string the LinkUrl of the node
     */
    public function getLinkUrl() {
        return $this->getViewState('LinkUrl', '');
    }
    
    /**
     * @param string the LinkUrl of the node
     */
    public function setLinkUrl($value) {
        $this->setViewState('LinkUrl',$value,'');
    }
    
    /**
     * @return string the Text of the node
     */
    public function getText() {
        return $this->getViewState('Text', '');
    }
    
    /**
     * @param string the Text of the node
     */
    public function setText($value) {
        $this->setViewState('Text',$value,'');
    }
    
    /**
     * @return string the link Target
     */
    public function getTarget() {
        return $this->getViewState('Target', '');
    }
    
    /**
     * @param string the link target
     */
    public function setTarget($value) {
        $this->setViewState('Target',$value,'');
    }
    
    /**
     * @return bool top parent flag
     */
    public function isTopParent() {
        return $this->isTopParent;
    }
    
    /**
     * @param bool the top parent flag
     */
    public function setTopParent($value) {
        $this->isTopParent = $value;
    }
    
    /**
     *  @return string the top parent css class
     */
    public function getTopParentNodeCssClass() {
        return $this->topParentNodeCssClass;
    }
    
    /**
     * #param string the top parent css class
     */
    public function setTopParentNodeCssClass($value) {
        $this->topParentNodeCssClass = $value;
    }
    
    /**
     * @return string the parent css class
     */
    public function getParentNodeCssClass() {
        return $this->parentNodeCssClass;
    }
    
    /**
     * @param string the parent css class
     */
    public function setParentNodeCssClass($value) {
        $this->parentNodeCssClass = $value;
    }
    
    /**
     * @param string the node css class
     */
    public function setNodeCssClass($value) {
        $this->nodeCssClass = $value;
    }
    
    /**
     * @return string the node css class
     */
    public function getNodeCssClass() {
        return $this->nodeCssClass;
    }
    
    /**
     * @param string the node css class
     */
    public function setDisabledNodeCssClass($value) {
        $this->disabledNodeCssClass = $value;
    }
    
    /**
     * @return string the node css class
     */
    public function getDisabledNodeCssClass() {
        return $this->disabledNodeCssClass;
    }
    
    public function setCssFile($value) {
        $this->cssFile = $value;
    }
    
    public function setJsFile($value) {
        $this->jsFile = $value;
    }
    
    /**
     * @return string the node css class name
     */
    function getPadding() {
        return $this->getViewState('Padding', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setPadding($value) {
        $this->setViewState('Padding',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getAlign() {
        return $this->getViewState('Align', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setAlign($value) {
        $this->setViewState('Align',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getSubMenuWidth() {
        return $this->getViewState('SubMenuWidth', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setSubMenuWidth($value) {
        $this->setViewState('SubMenuWidth',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getSubMenuBackColor() {
        return $this->getViewState('SubMenuBackColor', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setSubMenuBackColor($value) {
        $this->setViewState('SubMenuBackColor',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getHoverBack() {
        return $this->getViewState('HoverBack', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setHoverBack($value) {
        $this->setViewState('HoverBack',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getHoverColor() {
        return $this->getViewState('HoverColor', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setHoverColor($value) {
        $this->setViewState('HoverColor',$value,'');
    }
    
    function getLevel() {
        return $this->level;
    }
    
    function setLevel($value) {
        $this->level = $value;
    }
    
    /**
     * @return string the node css class name
     */
    function getFontWeight() {
        return $this->getViewState('FontWeight', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setFontWeight($value) {
        $this->setViewState('FontWeight',$value,'');
    }
    
    /**
     * Renders the menu.
     * Will go through all TCssDropDownMenuNode children and render them
     * at the correct place.
     * @return string the rendering result
     */
    protected function renderBody() {
        $content = '';
      
        $user = $this->getPage()->getUser();
      
        if (!is_null($user)) {
            if (!$user->isInRole($this->getRoles())) {
                return null;
                //return $content;   
            }
        }
      
        if ($this->isEnabled()) {
            if ($this->isTopParent())
                $cssClass = $this->getTopParentNodeCssClass();         
            elseif ($this->getBodies()->length())
                $cssClass = $this->getParentNodeCssClass();
            else
                $cssClass = $this->getNodeCssClass();
        } else {
            $cssClass = $this->getDisabledNodeCssClass();
        }
        
        $style=$this->getStyle();
        if(($width=$this->getWidth())>0) {
            if ($this->cssFile == null) {
                print "STYLE WIDTH SET!!!!</br>";
                $style['width']=$width.'px';
            }
        }
           
        if(($height=$this->getHeight())>0) {
            if ($this->cssFile == null)
                $style['height']=$height.'px';
        }
        
        $foreColor=$this->getForeColor();
        if(strlen($foreColor))
            $style['color']=$foreColor;
        $s='';
        if(count($style)>0) {
            foreach($style as $k=>$v)
                $s.="$k:$v;";
        }
      
        if ($s == null || $s == "") {
            $styleString = '';
        } else {
            $styleString = 'style="'.$s.'"';
        }
        
        if ($cssClass == null || $cssClass == "") {
            $cssString = '';
        } else {
            $cssString = 'class="'.$cssClass.'"';
        }
        
        if (strlen($this->getLinkUrl()) && $this->isEnabled()) {
            if (strlen($this->getTarget())) {
                $content .= '<a id="' . $this->getID() . 'A" href="'.$this->getLinkUrl().'" '.$styleString.' '.$cssString.' target="'.$this->getTarget().'" >'.$this->getText().'</a>';    
            } else {
                $content .= '<a id="' . $this->getID() . 'A" href="'.$this->getLinkUrl().'" '.$styleString.' '.$cssString.' >'.$this->getText().'</a>';    
            }
        } else {
            /* $content .= '<a href="#" style="'.$s.'" class="emptyNode">'.$this->getText().'</a>';    */
            $content .= '<a id="' . $this->getID() . 'A" href="#" '.$styleString.' '.$cssString.' >'.$this->getText().'</a>';
        }
      
        $body=$this->getBodies();
        if ($body->length()) {
            if ($this->cssFile != null) {
                $subMenu = true;
                $content .= "\n<ul id=" . $this->getID() . "SubMenu/>\n";
            } else {
                $subMenu = false;
                $content .= "\n<ul>\n";
            }
            foreach ($body as $item) {
                if ($item instanceof TCssDropDownMenuNode) {
                    $item->setTopParent(false);
                    $item->setTopParentNodeCssClass($this->getTopParentNodeCssClass());   
                    $item->setParentNodeCssClass($this->getParentNodeCssClass());
                    $item->setNodeCssClass($this->getNodeCssClass());
                    $item->setDisabledNodeCssClass($this->getDisabledNodeCssClass());
                    $item->setLevel($this->getLevel() + 1);
                    if ($item->getSubMenuWidth() != null || $item->getSubMenuWidth() != '') {
                        if ($this->getSubMenuWidth() == null || $this->getSubMenuWidth() == '') {
                            $this->setSubMenuWidth($item->getWidth());
                        }
                    } else {
                        if ($this->getSubMenuWidth() != null || $this->getSubMenuWidth() != '') {
                            $item->setSubMenuWidth($this->getSubMenuWidth());
                        }
                    }
                    if ($item->getAlign() == null || $item->getAlign() == '')
                        if ($this->getAlign() != null || $this->getAlign() != '')
                            $item->setAlign($this->getAlign());
                    if ($this->cssFile != null) {
                        $item->setCssFile($this->cssFile);
                        $item->setJsFile($this->jsFile);
                    }
                    if (!$this->isEnabled())
                        $item->setEnabled(false);
                    if ($this->getForeColor() != null || $this->getForeColor() != '')
                        if ($item->getForeColor() == null || $item->getForeColor() == '')
                            $item->setForeColor($item->getForeColor());
                    if ($this->getFontWeight() != null || $this->getFontWeight() != '')
                        if ($item->getFontWeight() == null || $item->getFontWeight() == '')
                            $item->setFontWeight($this->getFontWeight());
                    if ($item->isVisible()) {
                        $content .= $item->render();
                    }
                }
            }   
            $content .= "</ul>\n";
            
            
            
            
        }  
        
        if ($this->cssFile != null) {
            $this->getCssAttributesToRender();
        }
         
        return $content;
    }
    
    /**
     * Renders the menu item.
     * @return string the rendering result
     */
    function render() {
        $content = parent::render();
        $content .= "\n";
        $user = $this->getPage()->getUser();
        if (!is_null($user)) {
            if (!$user->isInRole($this->getRoles())) {
                $content = '';
            }
        }
        return $content;    
    }
    
    /**
     * This overrides the parent implementation by rendering more TWebControl-specific attributes.
     * @return ArrayObject the attributes to be rendered
     */
    protected function getAttributesToRender()
    {
        $attributes=parent::getAttributesToRender();
        if ($this->cssFile != null)
            if (isset($attributes['style']))
                unset($attributes['style']);
        if(!$this->isEnabled())
            $attributes['disabled']="disabled";
        $tabIndex=$this->getTabIndex();
        if(!empty($tabIndex))
            $attributes['tabindex']=$tabIndex;
        $toolTip=$this->getToolTip();
        if(strlen($toolTip))
            $attributes['title']=$toolTip;
        $accessKey=$this->getAccessKey();
        if(strlen($accessKey))
            $attributes['accesskey']=$accessKey;
        $cssClass=$this->getCssClass();
        if(strlen($cssClass))
            $attributes['class']=$cssClass;
        
        return $attributes;
    }
    
    protected function getCssAttributesToRender() {
        $subMenuWidth=$this->getSubMenuWidth();
        
        
        $selector = new Selector($this->getID() . ' ul','id');
        $selector->addStyle('position','absolute');
        $selector->addStyle('left','-999'.'em');
        if (strlen($subMenuWidth)) {
            if (is_numeric($subMenuWidth))
                $selector->addStyle('width',$subMenuWidth.'em');
            else
                $selector->addStyle('width',$subMenuWidth);
        }
        $borderWidth=$this->getBorderWidth();
        $topBorder = -1;
        if (strlen($borderWidth)) {
            if (!stripos($borderWidth,'px')) {
                if (is_numeric($borderWidth)) {
                    $topBorder -= $borderWidth;
                } else {
                    $topBorder -= (rtrim($borderWidth,'em'));
                }
            }
        }
        $borderWidth=$this->getBorderWidth();
        if (!strlen($borderWidth)) {
            $borderWidth = '0px';
        }
        $borderColor=$this->getBorderColor();
        if (strlen($borderColor))
            $borderColor = '#' . $borderColor;
        $borderStyle=$this->getBorderStyle();
        $selector->addStyle('border',$borderWidth.' '.$borderStyle.' '.$borderColor);
        $selector->addStyle('height','auto');
        $selector->setLevel($this->getLevel());
        $background=$this->getSubMenuBackColor();
        if (strlen($background))
            $selector->addStyle('background','#'.$background);
        $this->cssFile->addSelector($selector);
        
        //position the third lists on down
        $selector = new Selector($this->getID() . ' li ul','id');
        
        if (strlen($subMenuWidth))
            $selector->addStyle('margin',$topBorder.'em 0 0 '.$subMenuWidth);
        $selector->setLevel($this->getLevel());
        $this->cssFile->addSelector($selector);
        
        $selector = new Selector($this->getID() . ' ul a','id');
        if (strlen($subMenuWidth)) {
            if (is_numeric($subMenuWidth))
                $selector->addStyle('width',$subMenuWidth.'em');
            else
                $selector->addStyle('width',$subMenuWidth);
        }
        $selector->setLevel($this->getLevel());
        $this->cssFile->addSelector($selector);
        
        $selector = new Selector($this->getID().'A','id');
        $background=$this->getBackColor();
        if (strlen($background))
            $selector->addStyle('background','#'.$background.' !important');
        $color=$this->getForeColor();
        if (strlen($color))
            $selector->addStyle('color','#'.$color);
        $enabled=$this->isEnabled();
        if (!$enabled) {
            $selector->addStyle('font-weight','lighter !important');
        }
        $padding=$this->getPadding();
        if (strlen($padding))
            $selector->addStyle('padding',$padding);
        $fontWeight=$this->getFontWeight();
        if (strlen($fontWeight) && $this->isEnabled())
            $selector->addStyle('font-weight',$fontWeight);
        $selector->setLevel($this->getLevel());
        $this->cssFile->addSelector($selector);
        
        $selector = new Selector($this->getID().' :hover','id');
        $color=$this->getHoverColor();
        if (strlen($color))
            $selector->addStyle('color','#'.$color.' !important');
        $background=$this->getHoverBack();
        if (strlen($background))
            $selector->addStyle('background','#'.$background.' !important');
        $selector->setLevel($this->getLevel());
        $this->cssFile->addSelector($selector);
        
        $selector = new Selector($this->getID(),'id');
        $selector->setLevel($this->getLevel());
        $this->cssFile->addSelector($selector);
    }
}
?>
