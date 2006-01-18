<?php
/*
Rich Editor, Version 1.6
Copyright (c) 2002-2003 V. Smolin All rights reserved.
http://www.chel.tv/rich/
smolin@chel.tv
*/

//language class
require_once($class_path.'rich_files/lang/class.rich_lang.php');

$rich_flag = false;
$rich_lang = array();

class rich{
  var $caption;			//string, appearing before editor body
  var $name;			//unique name of the editor control
  var $value;			//initial editor content
  var $width;			//width of the editor (% or absolute values)
  var $height;			//height of the editor (% or absolute values)
  var $files_path;		//path to top folder for uploaded files
  var $files_url;		//url to top folder for uploaded files
  var $page_mode;   	//=true, if whole page is edited
  var $absolute_path;	//=true, if absolute path used
  var $settings;		//editor settings

  var $classname;

  function rich($caption, $name, $value='', $width='', $height='',
				$files_path='/', $files_url='/', $page_mode=false,
				$absolute_path=true){
    $this->caption = $caption;
    $this->name = $name;
    $this->width = $width;
    $this->height = $height;

	$this->absolute_path = $absolute_path;
//	if($this->absolute_path) $this->files_path = "../".$files_path;
//		else $this->files_path = $_SERVER['DOCUMENT_ROOT'].$files_path;
	$this->files_path = $files_path;
    $this->files_url = $files_url;

    $this->page_mode = $page_mode;
//    if(!$this->page_mode) $value = '<body>'.$value.'</body>';
//    $this->value = htmlspecialchars($value);
    $this->value = $value;

    //editor settings
    $this->settings = array();
    //all buttons (and groups) visible - by default
    $this->settings['hidden_tb'] = array();
    //all buttons are allways active - by default
    $this->settings['active_tb'] = false;
    //default language is english
    $this->settings['lang'] = 'en';

    //default stylesheets
    $this->default_stylesheet = array();
    //editor snippets
    $this->snippets = array();

    $this->classname = "rich";
  }
  function draw(){

    global $class_path;
    global $rich_flag;
    global $rich_lang;

	$files_path = $this->files_path;
	if($this->absolute_path) $this->files_path = $files_path;//"../".
		else $this->files_path = $files_path;//$_SERVER['DOCUMENT_ROOT'].

    //name of textarea element for sending text from form
    $name_area = $this->name;

    $name = $this->name."_ed"; //editor name
    $name_id = $name."_id";    //id of editor element

    //text data in current language
    $lang = new rich_lang($this->settings['lang'], false);

    if($this->caption) $editor_string.=  $this->caption.":<br>";

    $user_agent = @$_SERVER["HTTP_USER_AGENT"];
    if(!$user_agent) $user_agent = $GLOBALS["HTTP_USER_AGENT"];

    //$is_msie == true, if current brouser is MSIE
    if(ereg("MSIE ([0-9|\.]+)", $user_agent, $regs) &&
       ereg("Win", $user_agent)){
      $is_msie = true;
      $msie_version = (double)$regs[1];
    }else $is_msie = false;

	$value = $this->value;
    if(!$this->page_mode && $is_msie) $value = '<body>'.$value.'</body>';
    $this->value = htmlspecialchars($value);

    if(!$rich_flag){
      $editor_string.=  '<iFrame id="rich_fs_iframe" style="display:none;z-index:999"></iFrame>';
    }

    $editor_string.=  '<!-- editor body -->

<div id="'.$name.'_div_id" name="rich_table">
<table id="'.$name.'_table_id" border="1" cellspacing="0" cellpadding="0" width="'.$this->width.'" height="'.$this->height.'">
';

    if($is_msie){

      $editor_string.=  '<tr><td>

<!-- toolbar -->
<table bgcolor="buttonface" border="0" cellspacing="0" cellpadding="0" width="100%">
<tr onmousedown="mouse_down(true);" onmouseup="mouse_down(false);" onmouseover="mouse_over(true);" onmouseout="mouse_over(false);" ondragstart="return false;"><td class="toolbar">
      ';

    if($this->is_visible('fullscreen') && $msie_version >= 5.5 ||
       $this->is_visible('preview')){

      if($this->is_visible('fullscreen') && $msie_version >= 5.5){
          $editor_string.=  '
  <img id="FullScreen_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'FullScreen\');" alt="'.$lang->item('FullScreen').'" src="'.$class_path.'rich_files/images/fullscreen.gif" align="absMiddle" width="20" height="20">
</nobr>';
        }

        if($this->is_visible('preview')){
          $editor_string.=  '
  <img id="Preview_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'Preview\')" alt="'.$lang->item('Preview').'" src="'.$class_path.'rich_files/images/preview.gif" align="absMiddle" width="20" height="20">
</nobr>';
        }

        $editor_string.=  '
</nobr>
        ';
      }

      if($this->is_visible('clipboard')){
      $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
      ';

        $editor_string.=  '
<nobr>
  <img id="Cut_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Cut\')" alt="'.$lang->item('Cut').'" src="'.$class_path.'rich_files/images/cut.gif" align="absMiddle" width="20" height="20">
  <img id="Copy_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Copy\')" alt="'.$lang->item('Copy').'" src="'.$class_path.'rich_files/images/copy.gif" align="absMiddle" width="20" height="20">
  <img id="Paste_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Paste\')" alt="'.$lang->item('Paste').'" src="'.$class_path.'rich_files/images/paste.gif" align="absMiddle" width="20" height="20">
</nobr>
        ';
      }

      if($this->is_visible('history')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="Undo_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Undo\')" alt="'.$lang->item('Undo').'" src="'.$class_path.'rich_files/images/undo.gif" align="absMiddle" width="20" height="20">
  <img id="Redo_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Redo\')" alt="'.$lang->item('Redo').'" src="'.$class_path.'rich_files/images/redo.gif" align="absMiddle" width="20" height="20">
</nobr>
        ';
      }

      if($this->is_visible('text')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="Bold_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Bold\')" alt="'.$lang->item('Bold').'" src="'.$class_path.'rich_files/images/bold.gif" align="absMiddle" width="20" height="20">
  <img id="Italic_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Italic\')" alt="'.$lang->item('Italic').'" src="'.$class_path.'rich_files/images/italic.gif" align="absMiddle" width="20" height="20">
  <img id="Underline_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Underline\')" alt="'.$lang->item('Underline').'" src="'.$class_path.'rich_files/images/underline.gif" align="absMiddle" width="20" height="20">
  <img id="Strikethrough_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Strikethrough\')" alt="'.$lang->item('Strikethrough').'" src="'.$class_path.'rich_files/images/strikethrough.gif" align="absMiddle" width="20" height="20">
</nobr>
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="SuperScript_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'SuperScript\')" alt="'.$lang->item('SuperScript').'" src="'.$class_path.'rich_files/images/superscript.gif" align="absMiddle" width="20" height="20">
  <img id="SubScript_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'SubScript\')" alt="'.$lang->item('SubScript').'" src="'.$class_path.'rich_files/images/subscript.gif" align="absMiddle" width="20" height="20">
</nobr>
        ';
      }

      if($this->is_visible('align')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="JustifyLeft_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyLeft\')" alt="'.$lang->item('JustifyLeft').'" src="'.$class_path.'rich_files/images/left.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyCenter_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyCenter\')" alt="'.$lang->item('JustifyCenter').'" src="'.$class_path.'rich_files/images/center.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyRight_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyRight\')" alt="'.$lang->item('JustifyRight').'" src="'.$class_path.'rich_files/images/right.gif" align="absMiddle" width="20" height="20">
  <img id="JustifyFull_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'JustifyFull\')" alt="'.$lang->item('JustifyFull').'" src="'.$class_path.'rich_files/images/justify.gif" align="absMiddle" width="20" height="20">
</nobr>
        ';
      }

      if($this->is_visible('list') || $this->is_visible('indent')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
        ';

        if($this->is_visible('list')){
          $editor_string.=  '
  <img id="InsertOrderedList_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertOrderedList\')" alt="'.$lang->item('InsertOrderedList').'" src="'.$class_path.'rich_files/images/numlist.gif" align="absMiddle" width="20" height="20">
  <img id="InsertUnorderedList_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertUnorderedList\')" alt="'.$lang->item('InsertUnorderedList').'" src="'.$class_path.'rich_files/images/bullist.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('indent')){
          $editor_string.=  '
  <img id="Outdent_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Outdent\')" alt="'.$lang->item('Outdent').'" src="'.$class_path.'rich_files/images/outdent.gif" align="absMiddle" width="20" height="20">
  <img id="Indent_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'Indent\')" alt="'.$lang->item('Indent').'" src="'.$class_path.'rich_files/images/indent.gif" align="absMiddle" width="20" height="20">
          ';
        }

        $editor_string.=  '
</nobr>
        ';
      }

      if($this->is_visible('hr') || $this->is_visible('remove_format')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
        ';

        if($this->is_visible('hr')){
          $editor_string.=  '
  <img id="InsertHorizontalRule_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertHorizontalRule\')" alt="'.$lang->item('InsertHorizontalRule').'" src="'.$class_path.'rich_files/images/h_line.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('remove_format')){
          $editor_string.=  '
  <img id="RemoveFormat_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'RemoveFormat\')" alt="'.$lang->item('RemoveFormat').'" src="'.$class_path.'rich_files/images/rem_format.gif" align="absMiddle" width="20" height="20">
          ';
        }

          $editor_string.=  '
</nobr>
          ';
      }

      if($this->is_visible('table')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="CreateTable_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateTable\')" alt="'.$lang->item('CreateTable').'" src="'.$class_path.'rich_files/images/table.gif" align="absMiddle" width="20" height="20">
  <img id="InsertRow_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertRow\')" alt="'.$lang->item('InsertRow').'" src="'.$class_path.'rich_files/images/insrow.gif" align="absMiddle" width="20" height="20">
  <img id="DeleteRow_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'DeleteRow\')" alt="'.$lang->item('DeleteRow').'" src="'.$class_path.'rich_files/images/delrow.gif" align="absMiddle" width="20" height="20">
  <img id="InsertColumn_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertColumn\')" alt="'.$lang->item('InsertColumn').'" src="'.$class_path.'rich_files/images/inscol.gif" align="absMiddle" width="20" height="20">
  <img id="DeleteColumn_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'DeleteColumn\')" alt="'.$lang->item('DeleteColumn').'" src="'.$class_path.'rich_files/images/delcol.gif" align="absMiddle" width="20" height="20">
</nobr>
          ';
      }

      if($this->is_visible('table') && $this->is_visible('adv_table')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="InsertCell_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertCell\')" alt="'.$lang->item('InsertCell').'" src="'.$class_path.'rich_files/images/inscell.gif" align="absMiddle" width="20" height="20">
  <img id="DeleteCell_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'DeleteCell\')" alt="'.$lang->item('DeleteCell').'" src="'.$class_path.'rich_files/images/delcell.gif" align="absMiddle" width="20" height="20">
  <img id="MergeCells_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'MergeCells\')" alt="'.$lang->item('MergeCells').'" src="'.$class_path.'rich_files/images/mergecells.gif" align="absMiddle" width="20" height="20">
  <img id="SplitCell_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'SplitCell\')" alt="'.$lang->item('SplitCell').'" src="'.$class_path.'rich_files/images/splitcell.gif" align="absMiddle" width="20" height="20">
</nobr>
          ';
      }

      if($this->is_visible('form')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="CreateForm_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateForm\')" alt="'.$lang->item('CreateForm').'" src="'.$class_path.'rich_files/images/form.gif" align="absMiddle" width="20" height="20">
  <img id="CreateText_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateText\')" alt="'.$lang->item('CreateText').'" src="'.$class_path.'rich_files/images/text.gif" align="absMiddle" width="20" height="20">
  <img id="CreateTextArea_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateTextArea\')" alt="'.$lang->item('CreateTextArea').'" src="'.$class_path.'rich_files/images/textarea.gif" align="absMiddle" width="20" height="20">
  <img id="CreateButton_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateButton\')" alt="'.$lang->item('CreateButton').'" src="'.$class_path.'rich_files/images/button.gif" align="absMiddle" width="20" height="20">
  <img id="CreateHidden_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateHidden\')" alt="'.$lang->item('CreateHidden').'" src="'.$class_path.'rich_files/images/hidden.gif" align="absMiddle" width="20" height="20">
  <img id="CreateCheckBox_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateCheckBox\')" alt="'.$lang->item('CreateCheckBox').'" src="'.$class_path.'rich_files/images/checkbox.gif" align="absMiddle" width="20" height="20">
  <img id="CreateRadio_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateRadio\')" alt="'.$lang->item('CreateRadio').'" src="'.$class_path.'rich_files/images/radio.gif" align="absMiddle" width="20" height="20">
</nobr>
          ';
      }

      if($this->is_visible('paragraph')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="rich_text">'.$lang->item('FormatBlock').':</span>
<select class="rich_text" id="FormatBlock_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FormatBlock\',this)">';

        if(1 || $msie_version < 6){
          $editor_string.=  '
  <option value="<P>">Normal (P)</option>
  <option value="<H1>">Heading 1 (H1)</option>
  <option value="<H2>">Heading 2 (H2)</option>
  <option value="<H3>">Heading 3 (H3)</option>
  <option value="<H4>">Heading 4 (H4)</option>
  <option value="<H5>">Heading 5 (H5)</option>
  <option value="<H6>">Heading 6 (H6)</option>
  <option value="<PRE>">Preformatted (PRE)</option>';
        }else{
          $editor_string.=  '
  <option value="Normal">Normal (P)</option>
  <option value="Heading 1">Heading 1 (H1)</option>
  <option value="Heading 2">Heading 2 (H2)</option>
  <option value="Heading 3">Heading 3 (H3)</option>
  <option value="Heading 4">Heading 4 (H4)</option>
  <option value="Heading 5">Heading 5 (H5)</option>
  <option value="Heading 6">Heading 6 (H6)</option>
  <option value="Formatted">Preformatted (PRE)</option>';
        }

        $editor_string.=  '
</select>
</nobr>
        ';
      }

      if($this->is_visible('font')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="rich_text">'.$lang->item('FontName').':</span>
<select class="rich_text" id="FontName_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FontName\',this)">
  <option value="Arial">Arial</option>
  <option value="Arial Black">Arial Black</option>
  <option value="Garamond">Garamond</option>
  <option value="Comic Sans MS">Comic Sans MS</option>
  <option value="Courier">Courier</option>
  <option value="Courier New">Courier New</option>
  <option value="Symbol">Symbol</option>
  <option value="Times New Roman" selected>Times New Roman</option>
  <option value="Verdana">Verdana</option>
  <option value="Webdings">Webdings</option>
  <option value="Wingdings">Wingdings</option>
</select>
</nobr>
        ';
      }
      
      if($this->is_visible('style')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="rich_text">'.$lang->item('ClassName').':</span>
<select class="rich_text" id="ClassName_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'ClassName\',this)" onmouseenter="active_rich = '.$name_id.'; set_stylesheet_rules();">
  <option value=""></option>
</select>
</nobr>
        ';
      }

      if($this->is_visible('size')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="rich_text">'.$lang->item('FontSize').':</span>
<select class="rich_text" id="FontSize_'.$name.'" onchange="active_rich = '.$name_id.'; do_action(\'FontSize\',this)">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3" selected>3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
</select>
</nobr>
        ';
      }

      if($this->is_visible('color')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <img id="ForeColor_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'ForeColor\')" alt="'.$lang->item('ForeColor').'" src="'.$class_path.'rich_files/images/fgcolor.gif" align="absMiddle" width="20" height="20">
  <img id="BackColor_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'BackColor\')" alt="'.$lang->item('BackColor').'" src="'.$class_path.'rich_files/images/bgcolor.gif" align="absMiddle" width="20" height="20">
</nobr>
        ';
      }

      if($this->is_visible('image') || $this->is_visible('flash') ||
         $this->is_visible('link')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
        ';

        if($this->is_visible('image')){
          $editor_string.=  '
  <img id="CreateImage_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateImage\')" alt="'.$lang->item('CreateImage').'" src="'.$class_path.'rich_files/images/image.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('flash')){
          $editor_string.=  '
  <img id="CreateFlash_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateFlash\')" alt="'.$lang->item('CreateFlash').'" src="'.$class_path.'rich_files/images/flash.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('link')){
          $editor_string.=  '
  <img id="CreateLink_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'CreateLink\')" alt="'.$lang->item('CreateLink').'" src="'.$class_path.'rich_files/images/link.gif" align="absMiddle" width="20" height="20">
          ';
        }

      $editor_string.=  '
</nobr>
        ';
      }

      if($this->is_visible('paste_word') || $this->is_visible('switch_borders') ||
         $this->is_visible('special_chars') || $this->is_visible('snippets') ||
         $this->page_mode && $this->is_visible('page_properties')){
        $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
        ';

        if($this->is_visible('paste_word')){
          $editor_string.=  '
  <img id="PasteWord_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'PasteWord\')" alt="'.$lang->item('PasteWord').'" src="'.$class_path.'rich_files/images/paste_word.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('switch_borders')){
          $editor_string.=  '
  <img id="SwitchBorders_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'SwitchBorders\')" alt="'.$lang->item('SwitchBorders').'" src="'.$class_path.'rich_files/images/borders.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->is_visible('special_chars')){
          $editor_string.=  '
  <img id="InsertChar_'.$name.'" onclick="active_rich = '.$name_id.'; do_action(\'InsertChar\')" alt="'.$lang->item('InsertChar').'" src="'.$class_path.'rich_files/images/inschar.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->snippets && $this->is_visible('snippets')){
          $editor_string.=  '
  <img id="InsertSnippet_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'InsertSnippet\')" alt="'.$lang->item('InsertSnippet').'" src="'.$class_path.'rich_files/images/snippet.gif" align="absMiddle" width="20" height="20">
          ';
        }

        if($this->page_mode && $this->is_visible('page_properties')){
          $editor_string.=  '
  <img id="PageProterties_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'PageProperties\')" alt="'.$lang->item('PageProperties').'" src="'.$class_path.'rich_files/images/page.gif" align="absMiddle" width="20" height="20">
          ';
        }

      if(isset($cms_curr_user) && $cms_curr_user && $cms_curr_user->id){
        $editor_string.=  '<img onclick="active_rich = '.$name_id.'; show_dialog(\'CreateBlock\')" alt="Create Block" src="'.$class_path.'rich_files/images/block.gif" align="absMiddle" width="20" height="20">';
      }

      $editor_string.=  '
</nobr>
        ';
    }

    if($this->is_visible('help')){
      $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
      ';

        $editor_string.=  '
  <img id="Help_'.$name.'" onclick="active_rich = '.$name_id.'; show_dialog(\'Help\')" alt="'.$lang->item('Help').'" src="'.$class_path.'rich_files/images/help.gif" align="absMiddle" width="20" height="20">
</nobr>';
    }

    if($this->is_visible('source')){
      $editor_string.=  '
<nobr>
  <span class="delimiter"></span><span class="space"></span>
  <span class="rich_text">'.$lang->item('Source').':</span><input type="checkbox" name="edit_mode" onClick="active_rich = '.$name_id.'; change_mode();">
</nobr>
      ';
    }

    $editor_string.=  '

</td></tr>
</table>
<!-- toolbar -->

</td></tr>';

    }

$editor_string.=  '

<tr><td height="100%">

<!-- text -->
';

    if($is_msie){
      $editor_string.=  '<iframe class="editor" name="'.$name.'" id="'.$name_id.'" style="border: black thin; width:100%; height:100%">&nbsp;</iframe>';
    }

    $editor_string.=  '

<textarea name="'.$name_area.'" id="'.$name.'_area_id" rows="20" cols="60" style="';
    if($is_msie) $editor_string.=  'display:none; ';
    $editor_string.=  'border: black thin; height='.$this->height.'; width='.$this->width.'">'.$this->value.'</textarea>
<!-- text -->

</td></tr>
</table>
</div>
<!-- editor body -->
';

    if($is_msie){

      if(!$rich_flag){
        $editor_string.=  '<iframe id="rich_temp_iframe" style="width:1; height:1;">&nbsp;</iframe>';
      }

      $editor_string.=  '

<script language="javascript">
	var '.$name.'_area_id = document.all.'.$name.'_area_id;

	'.$name.'_id.document.designMode = "On";

	'.$name.'_id.document.open();
	'.$name.'_id.document.write('.$name.'_area_id.value);
	'.$name.'_id.document.close();

	'.$name.'_id.document.body.dir = "'.$lang->item('Direction').'";
	var '.$name.'_rich_dir = "'.$lang->item('Direction').'";
	var '.$name.'_rich_mb = "'.$lang->item('Multibyte').'";

	var '.$name.'_rich_css = Array();
      ';

      //draw stylesheet loading code
      if($this->default_stylesheet){
        $editor_string.=  "\n";
        foreach($this->default_stylesheet as $k=>$val){
          $editor_string.=  $name.'_id.document.createStyleSheet("'.$val.'");'."\n";
          $editor_string.=  $name.'_rich_css['.$k.'] = "'.$val.'";'."\n";
        }

      }

      if(!$rich_flag){
		$editor_string.=  '
      var rich_msie_version = "'.$msie_version.'";
        ';

		//url of root dir of site
		if(@$_SERVER['HTTPS'] == "on"){
			$base_url = "https";
		}else{
			$base_url = "http";
		}
		$base_url .= '://'.$_SERVER["HTTP_HOST"];
		$editor_string.=  '
  var rich_base_url = "'.$base_url.'";
		';
      }

      $editor_string.=  '

  active_rich = '.$name_id.';';

      if($this->is_visible('style')){
        $editor_string.=  'set_stylesheet_rules();';
      }

      $editor_string.=  '
  add_handlers('.$name_id.');

  '.$name.'_rich_mode = true;
  '.$name.'_rich_page_mode = '.(int)$this->page_mode.';
  '.$name.'_rich_border_mode = false;
  '.$name.'_rich_active_mode = '.(int)$this->settings[active_tb].';
  '.$name.'_prev_is_control = null;
  '.$name.'_rich_full_screen_mode = false;
  '.$name.'_rich_absolute_path = '.(int)$this->absolute_path.';

  '.$name.'_lang = "'.$this->settings['lang'].'";
  '.$name.'_files_path = "'.$this->files_path.'";
  '.$name.'_files_url = "'.$this->files_url.'";';

      //draw snippets
      $editor_string.=  "\n\n".'  var '.$name.'_snippets = new Array();'."\n";
      if($this->snippets && $this->is_visible('snippets')){
        foreach($this->snippets as $k=>$val){
          $snippet_name = str_replace("'", "\'", $val[name]);
          $snippet_code = str_replace("'", "\'", $val[code]);
          $editor_string.=  '  '.$name.'_snippets['.$k.'] = Array(\''.$snippet_name.'\', \''.$snippet_code.'\');'."\n";
        }

      }

	  $lang_name = $this->settings['lang'];
	  if(!isset($rich_lang[$lang_name])){
		$rich_lang[$lang_name] = true;

        //context menu data
		$cx_name = 'rich_cx_'.$lang_name;
		$editor_string.=  "
var rich_cx_item_$lang_name = Array('InsertRow', 'DeleteRow', 'InsertColumn',
						'DeleteColumn', 'InsertCell', 'DeleteCell');
var rich_cx_name_$lang_name = Array('".$lang->item('InsertRow')."', '".$lang->item('DeleteRow')."', '".$lang->item('InsertColumn')."',
						'".$lang->item('DeleteColumn')."', '".$lang->item('InsertCell')."', '".$lang->item('DeleteCell')."');
var rich_cx_image_$lang_name = Array('insrow', 'delrow', 'inscol',
						'delcol', 'inscell', 'delcell');
var rich_cx_length_$lang_name = rich_cx_item_".$lang_name.".length;
var $cx_name = Array();
".$cx_name."['TABLE'] = Array('".$lang->item('EditTable')."', 'CreateTable', 'table');
".$cx_name."['IMG'] = Array('".$lang->item('EditImage')."', 'CreateImage', 'image');
".$cx_name."['OBJECT'] = Array('".$lang->item('EditFlash')."', 'CreateFlash', 'flash');
".$cx_name."['HIDDEN'] = Array('".$lang->item('EditHidden')."', 'CreateHidden', 'hidden');
".$cx_name."['TEXT'] = ".$cx_name."['PASSWORD'] =
Array('".$lang->item('EditText')."', 'CreateText', 'text');
".$cx_name."['BUTTON'] = ".$cx_name."['RESET'] = ".$cx_name."['SUBMIT'] =
Array('".$lang->item('EditButton')."', 'CreateButton', 'button');
".$cx_name."['CHECKBOX'] = Array('".$lang->item('EditCheckBox')."', 'CreateCheckBox', 'checkbox');
".$cx_name."['RADIO'] = Array('".$lang->item('EditButton')."', 'CreateRadio', 'radio');
".$cx_name."['TEXTAREA'] = Array('".$lang->item('EditTextArea')."', 'CreateTextArea', 'textarea');
".$cx_name."['CUT'] = '".$lang->item('Cut')."';
".$cx_name."['COPY'] = '".$lang->item('Copy')."';
".$cx_name."['PASTE'] = '".$lang->item('Paste')."';
".$cx_name."['PASTEWORD'] = '".$lang->item('PasteWord')."';
".$cx_name."['ADDIMAGE'] = '".$lang->item('CreateImage')."';
".$cx_name."['ADDLINK'] = '".$lang->item('CreateLink')."';
".$cx_name."['EDITLINK'] = '".$lang->item('EditLink')."';
".$cx_name."['ADDFLASH'] = '".$lang->item('CreateFlash')."';
".$cx_name."['EDITFORM'] = '".$lang->item('EditForm')."';
".$cx_name."['ADDTABLE'] = '".$lang->item('CreateTable')."';
".$cx_name."['EDITCELL'] = '".$lang->item('EditCell')."';
".$cx_name."['MERGE'] = '".$lang->item('MergeCells')."';
".$cx_name."['SPLIT'] = '".$lang->item('SplitCell')."';
		";
	  }

    }

    if($is_msie){
      if(!$rich_flag){

        $editor_string.=  '
/* copyright

Rich Editor, Version 1.6
Copyright (c) 2002-2003 V. Smolin All rights reserved.
http://www.chel.tv/rich/
smolin@chel.tv

copyright */
        ';

        $editor_string.=  '
	  rich_temp_iframe.document.designMode = "On";

	  var rich_path = "'.$class_path.'rich_files/";

        ';

		$editor_string.=  'var rich_popup = ';
        if($msie_version >= 5.5){
          $editor_string.=  'window.createPopup();
          ';
        }else{
          $editor_string.=  'null;
          ';
		}

        $rich_flag = true;
      }
    }

    $editor_string.=  '</script>';
    
    Return $editor_string;

  }

  //hide/show button or group of buttons
  //possible item names:
  //clipboard, history, text, align, list, indent, hr, remove_format, source,
  //table, adv_table, paragraph, font, style, size, color, image, flash, link,
  //paste_word, switch_borders, special_chars, form, snippets, page_properties,
  function hide_tb($name, $hide=true){
    $this->settings['hidden_tb'][$name] = $hide;
  }

  //check if button or group $name is visible
  function is_visible($name){
    return !$this->settings['hidden_tb'][$name];
  }

  //switch to simple mode (minimum buttons)
  function simple_mode($mode=true){
    if($mode){
      $this->hide_tb('list');
      $this->hide_tb('indent');
      $this->hide_tb('hr');
      $this->hide_tb('remove_format');
      $this->hide_tb('table');
      $this->hide_tb('paragraph');
      $this->hide_tb('font');
      $this->hide_tb('size');
      $this->hide_tb('style');
      $this->hide_tb('image');
      $this->hide_tb('flash');
      $this->hide_tb('link');
      $this->hide_tb('paste_word');
      $this->hide_tb('switch_borders');
      $this->hide_tb('special_chars');
      $this->hide_tb('form');
      $this->hide_tb('snippets');
      $this->hide_tb('page_properties');
    }else $this->settings['hidden_tb'] = array(); //show all buttons
  }

  function myModule ($mode=true) 
  {
  	if ($mode) 
  	{
  		$this->hide_tb('form');
		$this->hide_tb('special_chars');

  	}
	else 
	{
		$this->settings['hidden_tb'] = array();
	}
  }

  //in active mode a button, clicking on who will do no effect, get inactive
  function active_mode($active=true){
    $this->settings['active_tb'] = $active;
  }

  //sets path to stylesheet file to be loaded in editor body
  function set_default_stylesheet($style_path){
    if(gettype($style_path) == "array"){

      foreach($style_path as $k=>$val){
        $this->default_stylesheet[] = $val;
      }

    }else{
      $this->default_stylesheet[] = $style_path;
    }
  }

  //sets snippets ($snippets - an array of pairs $name/$code)
  function set_snippets($snippets){

    if($snippets[name]){ //only one snippet

      $this->snippets[] = $snippets;

    }else{ //array of snippets

      foreach($snippets as $k=>$val){
        //if name has any symbols and code not empty
        if(ereg("[^[[:space:]]]*", $val[name]) && $val[code]){
          $this->snippets[] = $val;
        }
      }

    }

  }

  //set language
  function set_lang($lang='en'){
    $this->settings['lang'] = $lang;
  }

}

?>