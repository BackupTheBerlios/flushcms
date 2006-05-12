
<?php
/**
* TCssDropDownMenu class file
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
* TCssDropDownMenu class file class
*
* TCssDropDownMenu class file displays a css driven menu on a Web page. You can set the alignment of the menu  
* through the <b>Horizontal</b> property.
*
* Example: <code><com:TCssDropDownMenu Horizontal="false" /></code>
*
* Namespace: System.Web.UI.WebControls
*
* Properties
* - <b>Horizontal</b>, boolean, kept in viewstate
*   <br>Sets the alignment of the menu, true = horizontal and false = vertical.
* - <b>CssHorizontalFile</b>, string, kept in view state
*   <br>Sets the css file to be used for horizontal menus
* - <b>CssVerticalFile</b>, string, kept in view state
*   <br>Sets the css file to be used for vertical menus  
* - <b>CssDirectory</b>, string, kept in view state
*   <br>Sets the css file directory  
* - <b>JsDirectory</b>, string, kept in view state
*   <br>Set the javascript directory
* - <b>JsFile</b>, string, kept in view state
*   <br>Set the javascript filename
* - <b>TopParentNodeCssClass</b>, string, kept in view state
*   <br>Set the css class name of the top most TCssDropDownMenuNode
* - <b>ParentNodeCssClass<b>, string, kept in view state
*   <br>Set the css class name of parent (nodes with children nodes) TCssDropDownMenuNodes
* - <b>NodeCssClass</b>, string, kept in view state
*   <br>Set the node css class name of ending TCssDropDownMenuNodes
* - <b>DisabledCssClass</b>, string kept in view state
*      <br>Set the node css class name of disabled TCssDropDownMenuNodes
*   
* Note, that the default css files need to be located under the root of your site unders js/cssdropdownmenu/css with
* cssdropdownmenu-horizontal.css and cssdropdownmenu-vertical.css controlling the aligments.  There is also a small
* javascript file for IE non-support of the virtual tage hover.  Based off the work of Son of Suckerfish by
* Patrick Griffiths and Dan Webb, see http://www.htmldog.com/articles/suckerfish/dropdowns/
*/

class TCssDropDownMenu extends TWebControl {
    
    private $cssFile;
    
    /**
     * Constructor.
     * Sets TagName property to 'ul'
     */
    function __construct() {
        parent::__construct();
        $this->setTagName('ul');
    }
    
    /**
     * @return string the disabled menu node css class
     * the css class name
     */
    function getDisabledCssClass() {
        return $this->getViewState('DisabledCssClass', '');
    }
    
    /**
     * @param string the menu alignment
     * css class name
     */
    function setDisabledCssClass($value) {
        $this->setViewState('DisabledCssClass',$value,'');
    }
    
    /**
     * @return boolean the menu alignment
     * true means a horizontal menu, false means a vertical menu
     */
    function getHorizontal() {
        return $this->getViewState('Horizontal', '');
    }
    
    /**
     * @param boolean the menu alignment
     * true means a horizontal menu, false means a vertical menu
     */
    function setHorizontal($value) {
        $this->setViewState('Horizontal',$value,'cssdropdownmenu-horizontal.css');
    }
    
    /**
     * @return string the name of the css horizontal file
     */
    function getCssHorizontalFile() {
        return $this->getViewState('CssHorizontalFile', 'cssdropdownmenu-horizontal.css');
    }
    
    /**
     * @param boolean the name of the css horizontal file
     */
    function setCssHorizontalFile($value) {
        $this->setViewState('CssHorizontalFile',$value,'cssdropdownmenu-vertical.css');
    }
    
    /**
     * @return string the name of the css vertical file
     */
    function getCssVerticalFile() {
        return $this->getViewState('CssVerticalFile', 'cssdropdownmenu-vertical.css');
    }
    
    /**
     * @param boolean the name of the css vertical file
     */
    function setCssVerticalFile($value) {
        $this->setViewState('CssVerticalFile',$value,'');
    }
    
    /**
     * @return string the name of the css directory
     */
    function getCssDirectory() {
        return $this->getViewState('CssDirectory', 'js/cssdropdownmenu/css');
    }
    
    /**
     * @param boolean the name of the css directory
     */
    function setCssDirectory($value) {
        $this->setViewState('CssDirectory',$value,'js/cssdropdownmenu/css');
    }
    
    /**
     * @return string the name of the js directory
     */
    function getJsDirectory() {
        return $this->getViewState('JsDirectory', 'js/cssdropdownmenu');
    }
    
    /**
     * @param boolean the name of the js directory
     */
    function setJsDirectory($value) {
        $this->setViewState('JsDirectory',$value,'js/cssdropdownmenu');
    }
    
    /**
     * @return string the name of the js file
     */
    function getJsFile() {
        return $this->getViewState('JsFile', 'cssdropdownmenu.js');
    }
    
    /**
     * @param boolean the name of the js file
     */
    function setJsFile($value) {
        $this->setViewState('JsFile',$value,'cssdropdownmenu.js');
    }
    
    /**
     * @return string the top level parent node css class name
     */
    function getTopParentNodeCssClass() {
        return $this->getViewState('TopParentNodeCssClass', '');
    }
    
    /**
     * @param string the top level parent node css class name
     */
    function setTopParentNodeCssClass($value) {
        $this->setViewState('TopParentNodeCssClass',$value,'');
    }
    
    /**
     * @return string the parent node css class name
     */
    function getParentNodeCssClass() {
        return $this->getViewState('ParentNodeCssClass', '');
    }
    
    /**
     * @param string the parent node css class name
     */
    function setParentNodeCssClass($value) {
        $this->setViewState('ParentNodeCssClass',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getNodeCssClass() {
        return $this->getViewState('NodeCssClass', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setNodeCssClass($value) {
        $this->setViewState('NodeCssClass',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getGenerateCss() {
        return $this->getViewState('GenerateCss', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setGenerateCss($value) {
        $this->setViewState('GenerateCss',$value,'');
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
    function getPadding() {
        return $this->getViewState('Padding',null);
    }
    
    /**
     * @param string the node css class name
     */
    function setPadding($value) {
        $this->setViewState('Padding',$value,null);
    }
    
    /**
     * @return string the node css class name
     */
    function getMargin() {
        return $this->getViewState('Margin', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setMargin($value) {
        $this->setViewState('Margin',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getHeadingWidth() {
        return $this->getViewState('AnchorWidth', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setHeadingWidth($value) {
        $this->setViewState('AnchorWidth',$value,'');
    }
    
    /**
     * @return string the node css class name
     */
    function getTextDecoration() {
        return $this->getViewState('TextDecoration', '');
    }
    
    /**
     * @param string the node css class name
     */
    function setTextDecoration($value) {
        $this->setViewState('TextDecoration',$value,'');
    }
    
    /**
     * Renders the menu, and itinitialize top parent nodes css.
     * @return string the rendering result
     */
    function render() {
        $page=$this->getPage();
        
        if ($this->getGenerateCss()) {
            $cssPath = rtrim($this->getCssDirectory(),'/\\').'/';
            $cssPath = ltrim($cssPath);
            
            $this->cssFile = new CssStyleSheet();
            $this->cssFile->setFile($cssPath.$this->getID().'.css');
            
            $scriptFile = $this->getID().'.js';
            $jsScript = new JsScript();
            $jsScript->setFile($this->getJsDirectory().'/'.$scriptFile);
        }
        
        $body = $this->getBodies();
        foreach ($body as $item) {
            if ($item instanceof TCssDropDownMenuNode) {
                if ($item->getAlign() == null || $item->getAlign() == '')
                    $item->setAlign($this->getAlign());
                $item->setTopParent(true);
                $item->setTopParentNodeCssClass($this->getTopParentNodeCssClass());    
                $item->setParentNodeCssClass($this->getParentNodeCssClass());
                $item->setNodeCssClass($this->getNodeCssClass());
                $item->setDisabledNodeCssClass($this->getDisabledCssClass());
                if ($this->getHeadingWidth() != null || $this->getHeadingWidth() != '')
                    if ($item->getSubMenuWidth() == null || $item->getSubMenuWidth() == '')
                        $item->setSubMenuWidth($this->getHeadingWidth());
                $item->setLevel(1);
                if(!$this->isEnabled())
                    $item->setEnabled(false);
                if ($this->getGenerateCss()) {
                    $item->setCssFile($this->cssFile);
                    $item->setJsFile($jsScript);
                }
                if ($this->getForeColor() != null || $this->getForeColor() != '')
                    if ($item->getForeColor() == null || $item->getForeColor() == '')
                        $item->setForeColor($item->getForeColor());
                if ($this->getFontWeight() != null || $this->getFontWeight() != '')
                    if ($item->getFontWeight() == null || $item->getFontWeight() == '')
                        $item->setFontWeight($this->getFontWeight());
            }        
        }
        
        if ($this->getGenerateCss()) {
            
            $this->getCssAttributesToRender();
            
            //$cssStyleSheet->generateCss();
            if(!$page->isScriptFileRegistered('CssDropDownMenuJS')) {
                $scriptPath=rtrim(dirname($_SERVER['PHP_SELF']),'/\\').'/'.$this->getJsDirectory().'/';
                
                $page->registerScriptFile('CssDropDownMenuJS',$scriptPath.$scriptFile);
                $page->registerStyleFile('CssDropDownMenuCss',$cssPath.$this->getID().'.css');
            }
        } else {
            if(!$page->isScriptFileRegistered('CssDropDownMenuJS')) {
                $scriptPath=rtrim(dirname($_SERVER['PHP_SELF']),'/\\').'/'.$this->getJsDirectory().'/';
                
                
                $cssPath = rtrim($this->getCssDirectory(),'/\\').'/';
                $cssPath = ltrim($cssPath);
                if ($this->getHorizontal()) {    
                    $cssFile = $this->getCssHorizontalFile();
                } else {
                    $cssFile = $this->getCssVerticalFile();    
                }
                $scriptFile = $this->getJsFile();
                $page->registerStyleFile('CssDropDownMenuCSS',$cssPath.$cssFile);
                $page->registerScriptFile('CssDropDownMenuJS',$scriptPath.$scriptFile);
            }
        }
        
        
        
        $result =  parent::render();
        if ($this->getGenerateCss()) {
            $jsScript->addElement($this->getID());
            $jsScript->generateJs();
            $this->cssFile->generateCss();
            $this->cssFile->close();
        }
        return $result;
        
        
    }
    
    
    
    
    /**
     * This overrides the parent implementation by rendering more TWebControl-specific attributes.
     * @return ArrayObject the attributes to be rendered
     */
    protected function getAttributesToRender()
    {
        $attributes=parent::getAttributesToRender();
        if ($this->getGenerateCss())
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
        
        //ORDER OF THE SELECTORS IS IMPORTANT!!!!!
        //main menu selector and first un-ordered list
        $selector = new Selector($this->getID(),'id');
        $selector->addId($this->getID() . ' ul');
        $selector->addStyle('list-style','none');                    //list style
        $selector->addStyle('line-height','1');                        //this makes sure lines are 1em and not 1+.
        $borderWidth=$this->getBorderWidth();
        if (strlen($borderWidth)) {
            $borderWidth = $this->formatTRBL($borderWidth);
        }
        $borderColor=$this->getBorderColor();
        $borderStyle=$this->getBorderStyle();
        $selector->addStyle('border',$borderWidth.' '.$borderStyle.' '.'#'.$borderColor);
        $padding=$this->getPadding();
        if (strlen($padding))
            $selector->addStyle('padding',$this->formatTRBL($padding));
        $width=$this->getWidth();
        if (strlen($width))
            if (is_numeric($width))
                $selector->addStyle('width',$width.'em');    //defaults to em
            else
                $selector->addStyle('width',$width);
        $selector->addStyle('margin','0');                            //eliminate the margin
        $selector->addStyle('float','left');
        $background=$this->getBackColor();
        if (strlen($background))
            $selector->addStyle('background','#'.$background);
        $this->cssFile->addSelector($selector);
            
        //get the main navigation items width
        $headingWidth=$this->getHeadingWidth();
        
        //main menu anchor
        $selector = new Selector($this->getID() . ' a','id');
        $selector->addStyle('display','block');
        if (strlen($headingWidth))
            $selector->addStyle('width',$headingWidth);
        $textDecoration=$this->getTextDecoration();
        if (strlen($textDecoration))
            $selector->addStyle('text-decoration',$textDecoration);
        $color=$this->getForeColor();
        if (strlen($color))
            $selector->addStyle('color','#'.$color);
        $fontWeight=$this->getFontWeight();
        if (strlen($fontWeight))
            $selector->addStyle('font-weight',$fontWeight);
        $this->cssFile->addSelector($selector);
                                    
        //main menu li
        //width is for opera
        $selector = new Selector($this->getID() . ' li', 'id');
        $selector->addStyle('float','left');
        if (strlen($headingWidth))
            $selector->addStyle('width',$headingWidth);
        //$selector->addStyle('float','left');
        $this->cssFile->addSelector($selector);
        
        //hide the third list
        $selector = new Selector($this->getID() . ' li:hover ul ul','id');
        $selector->addId($this->getID() . ' li:hover ul ul ul');
        $selector->addId($this->getID() . ' li.sfhover ul ul');
        $selector->addId($this->getID() . ' li.sfhover ul ul ul');
        $selector->addStyle('left','-999'.'em');
        $this->cssFile->addSelector($selector);
                                
        //unhide the second list
        $selector = new Selector($this->getID() . ' li:hover ul','id');
        $selector->addId($this->getID() . ' li li:hover ul','id');
        $selector->addId($this->getID() . ' li li li:hover ul');
        $selector->addId($this->getID() . ' li.sfhover ul');
        $selector->addId($this->getID() . ' li li.sfhover ul');
        $selector->addId($this->getID() . ' li li li.sfhover ul');
        $selector->addStyle('left','auto');
        $this->cssFile->addSelector($selector);            
    }
    
    private function formatTRBL($trbl) {
        if (stripos($trbl,'px')) {
            return $trbl;
        }
        
        $trbls = split(' ',$trbl);
        $returnStr = '';
        
        foreach ($trbls as $value)
            if (stripos($value,'em'))
                $returnStr .= $value . ' ';
            else
                $returnStr .= $value . 'em ';
        
        return $returnStr;
    }
}

class JsScript {
    
    private $selectors = array();
    private $generate;
    private $file;
    private $handle;
    private $elements = array();
    
    function addElement($id) {
        $this->elements[] = $id;
    }
    
    /**
     * @return string the working directory to build the css
     */
    function getFile() {
        return $this->file;
    }
    
    /**
     * Sets the location of the working directory to build the css
     * @param string the working directory used to build the css
     */
    function setFile($value) {
        $this->file = $value;
    }
    
    private function open($mode = 'w+') {
        if($this->handle = @fopen($this->file, $mode)) {
            return true;
        }

        return false;
    }
    
    /*public function generateJs() {
        
        $this->open();
        
        $data = 'startList = function() {'."\n".
                '    if (document.all&&document.getElementById) {'."\n";
        foreach ($this->elements as $element) {
        $data .='        navRoot = document.getElementById("'.$element.'");'."\n".
                '        for (i=0; i<navRoot.childNodes.length; i++) {'."\n".
                '            node = navRoot.childNodes[i];'."\n".
                '            if (node.nodeName=="LI") {'."\n".
                '                node.onmouseover=function() {'."\n".
                '                    this.className+=" sfhover";'."\n".
                '                }'."\n".
                '                node.onmouseout=function() {'."\n".
                '                    this.className=this.className.replace(" sfhover", "");'."\n".
                '                }'."\n".
                '            }'."\n".
                '        }'."\n";
        }
        $data .='    }'."\n".
                '}'."\n".
                'window.attachEvent("onload", startList);'."\n";
        fwrite($this->handle, $data);
    }*/
    public function generateJs() {
        $this->open();
        
        $data = 'sfHover = function() {'."\n".
                '    var sfEls = document.getElementById("'.$this->elements[0].'").getElementsByTagName("LI");'."\n".
                '    for (var i=0; i<sfEls.length; i++) {'."\n".
                '        sfEls[i].onmouseover=function() {'."\n".
                '            this.className+=" sfhover";'."\n".
                '        }'."\n".
                '        sfEls[i].onmouseout=function() {'."\n".
                '            this.className=this.className.replace(new RegExp(" sfhover"), "");'."\n".
                //'            alert(this.className)'."\n".        
                '        }'."\n".
                '    }'."\n".
                '}'."\n".
                'if (window.attachEvent) window.attachEvent("onload", sfHover);';
        fwrite($this->handle, $data);

    }
    
    public function close() {
        print "close </br>";
        fclose($this->handle);
    }
    
    
    
}


class CssStyleSheet {
    
    private $selectors = array();
    private $file;
    private $handle;
    
    /**
     * @return string the working directory to build the css
     */
    function getFile() {
        return $this->file;
    }
    
    /**
     * Sets the location of the working directory to build the css
     * @param string the working directory used to build the css
     */
    function setFile($value) {
        $this->file = $value;
    }
    
    private function open($mode = 'w+') {
        if($this->handle = @fopen($this->file, $mode)) {
            return true;
        }

        return false;
    }
    
    public function addSelector($selector) {
        //print ' add selector ' . $selector->getId() . ' </br>';
        $this->selectors[] = $selector;
    }
    
    public function generateCss() {
        
        if ($this->handle == null)
            $this->open();
            
        //this is ugly but the selectors render order is important!!!!
        $top = 0;
        foreach ($this->selectors as $selector) {
            if($top < $selector->getLevel())
                $top = $selector->getLevel();
        }
        for ($i=0;$i<=$top;$i++) {
            foreach ($this->selectors as $selector) {
                if ($selector->getLevel() == $i) {
                    $data = $selector->generateSelector();
                    if ($data != null) {
                        //print " DATA: $data </br>";
                        fwrite($this->handle, $data);
                    }
                }
            }
        }
    }
    
    public function close() {
        fclose($this->handle);
    }
    
    
    
}

class Selector {

    private $ids = array();
    private $type;
    private $level;
    private $styles = array();
    
    public function __construct($id, $type) {
        $this->ids[] = $id;
        $this->type = $type;
        $this->level= 0;
    }
    
    public function addId($id) {
        $this->ids[] = $id;
    }
    
    public function setType($value) {
        $this->type = $value;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function addStyle($key, $value) {
        $this->styles[$key] = $value;
    }    
    
    public function setLevel($value) {
        $this->level = $value;
    }
    
    public function getLevel() {
        return $this->level;
    }
    
    public function generateSelector() {
        $data = false;
        $selector = '';
        switch ($this->type) {
            case 'id':
                foreach ($this->ids as $id) {
                    $selector .= '#' . $id . ', ';
                }
                $selector = rtrim($selector,', ');
                $selector .= ' ';
                $selector .= " {\n";
                foreach ($this->styles as $key => $value) {
                    $data = true;
                    $selector .= '    ' .$key . ': ' . $value . ";\n";
                }
                $selector .= "}\n";
                break;
            default:
        }
        
        if ($data)
            return $selector;
        
        return null;
    }
    
}
?>
