//id of active editor
var active_rich = null;

//prevent error messaging
window.onerror = no_error;

//context menu parser
function parse_context_ie5(){
var mode;
var sel;
var r;
var td;
var form;

	eval('mode = '+active_rich.name+'_rich_mode;'); //current mode

	//do nothing in source text editing mode
	if(!mode) return;

	sel = active_rich.document.selection;
	r = sel.createRange();

	if(sel.type == 'Control'){

		switch(r(0).tagName){
			case 'TABLE':
				show_dialog("EditTable", r(0)); //edit table
				break;
			case 'IMG':
				show_dialog("EditImage", r(0)); //edit image
				break;
			case 'OBJECT':
				show_dialog("EditFlash", r(0)); //edit flash
				break;
			case 'INPUT':
				switch(r(0).type.toUpperCase()){
					case 'HIDDEN':
						show_dialog("EditHidden", r(0)); //edit hidden field
						break;
					case 'TEXT':
					case 'PASSWORD':
						show_dialog("EditText", r(0));//edit common input field
						break;
					case 'BUTTON':
					case 'RESET':
					case 'SUBMIT':
						show_dialog("EditButton", r(0)); //edit button
						break;
					case 'CHECKBOX':
						show_dialog("EditCheckBox", r(0)); //edit checkbox
						break;
					case 'RADIO':
						show_dialog("EditRadio", r(0)); //edit radio button
						break;
					default:
						break;
				}
				break;
			case 'TEXTAREA':
				show_dialog("EditTextArea", r(0)); //edit text area
				break;
			default:
				break;
		}

	}else{

		if(r.parentElement){ //edit table cell
			td = get_previous_object(r.parentElement(),'TD');
			if(td != null) show_dialog("EditCell", td);

			form = get_previous_object(r.parentElement(),'FORM');
			if(form != null) show_dialog("EditForm", form);
		}

	}

	change_toolbar_state(); //set new states of toolbar buttons

}

//parses toolbar button press event
function do_action(action,value){
var mode;
var sel;
var r;
var is_control;
var found;
var button_object;

  eval('mode = '+active_rich.name+'_rich_mode;'); //current mode

  active_rich.focus(); //set focus on active editor

  //in source mode buttons do not work
//  if(!mode) return;

  //hide popup menu if exists
//  if(rich_popup) rich_popup.hide();

  button_object = get_button_object(action);
  if(!active_button(button_object)){ //button is inactive
    return;
  }

  //check if any control element is active, e.g. image or table
  sel = active_rich.document.selection;
  r = sel.createRange();
  if(sel.type == 'Control') is_control = true;
    else is_control = false;

  found = true;
  switch(action){
    case 'Cut':                 //cut
    case 'Copy':                //copy
    case 'Paste':               //paste
    case 'Undo':                //undo previous action
    case 'Redo':                //redo last cancelled action
      break;
    case 'Bold':                //set/unset bold style
    case 'Italic':              //set/unset italic style
    case 'Underline':           //set/unset undeline style
    case 'Strikethrough':       //set/unset strikethrough style
    case 'SuperScript':         //set/unset superscript style
    case 'SubScript':           //set/unset subscript style
    case 'JustifyLeft':         //justify left
    case 'JustifyCenter':       //justify center
    case 'JustifyRight':        //justify right
    case 'JustifyFull':         //justify full
    case 'InsertOrderedList':   //insert ordered list
    case 'InsertUnorderedList': //insert unordered list
    case 'Outdent':             //decrease indention
    case 'Indent':              //increase indention
    case 'InsertHorizontalRule'://insert horizontal line
    case 'RemoveFormat':        //remove text formatting
      if(is_control) found = false;
      break;
    case 'FormatBlock':         //set paragraph style
    case 'FontName':            //set font
    case 'FontSize':            //set font size
      if(is_control) found = false;
        else value = value[value.selectedIndex].value;
      break;
    case 'ClassName':           //set class
      set_class(value[value.selectedIndex].value);
      break;
    case 'ForeColor':           //set foreground color
    case 'BackColor':           //set background color
      if(is_control){
        found = false;
        break;
      }
      value = pick_color();
      break;
    case 'InsertRow':           //insert row in table
      if(is_control) break;
      insert_row();
      switch_borders(false); //redraw borders under current border mode
      found = false;
      break;
    case 'DeleteRow':           //delete row from table
      if(is_control) break;
      delete_row();
      found = false;
      break;
    case 'InsertColumn':        //insert column in table
      if(is_control) break;
      insert_column();
      switch_borders(false); //redraw borders under current border mode
      found = false;
      break;
    case 'DeleteColumn':        //delete column from table
      if(is_control) break;
      delete_column();
      found = false;
      break;
    case 'PasteWord':           //paste text from MSWord
      paste_word();
      found = false;
      break;
    case 'SwitchBorders':       //show invisible table borders
      switch_borders(true);
      found = false;
      break;
    case 'InsertChar':          //insert a special character
      if(is_control) break;
      insert_char();
      found = false;
      break;
    case 'InsertCell':          //insert cell
      if(is_control) break;
      insert_cell();
      switch_borders(false); //redraw borders under current border mode
      found = false;
      break;
    case 'DeleteCell':          //delete cell
      if(is_control) break;
      delete_cell();
      found = false;
      break;
    case 'MergeCells':          //merge cells
      if(is_control) break;
      merge_cells();
      found = false;
      break;
    case 'SplitCell':           //split cell
      if(is_control) break;
      split_cell();
      switch_borders(false); //redraw borders under current border mode
      found = false;
      break;
    case 'FullScreen':          //switch on/off fullscreen mode
      full_screen(get_editor_name(button_object));
      found = false;
      break;
    case 'InsertSnippet':      //show snippet popup menu/insert a snippet
      if(value) insert_snippet(value);
        else show_snippet_menu();
      found = false;
      break;
    default:
      found = false;
      break;
  }

  if(found) active_rich.document.execCommand(action, false, value);

  change_toolbar_state(); //set new states of toolbar buttons

}

//changes states of toolbar buttons, when they are pressed/released
function mouse_down(down){
var element;
var mode;
var name;
var obj;

	element = window.event.srcElement;

	if(element && element.tagName=='IMG'){
		name = get_editor_name(element);
		eval('mode = '+name+'_rich_mode;'); //current mode

		if(!active_button(element)){ //button is inactive
			eval('obj = '+name+'_id;'); //editor of the current button
			if(obj) obj.focus();
			return;
		}

		if(down){ //pressed
			element.style.borderTop = '1px solid buttonshadow';
			element.style.borderLeft = '1px solid buttonshadow';
			element.style.borderBottom = '1px solid buttonhighlight';
			element.style.borderRight = '1px solid buttonhighlight';
		}else{ //released
			element.style.borderTop = '1px solid buttonhighlight';
			element.style.borderLeft = '1px solid buttonhighlight';
			element.style.borderBottom = '1px solid buttonshadow';
			element.style.borderRight = '1px solid buttonshadow';
		}

	}

}

//changes state of toolbar button, when mouse is over it
function mouse_over(over){
var element;
var name;
var mode;
var obj;
var id_name;
var acrion_name;
var old_active_rich;
var button_name;
var changing_button;
var mode_name;

	element = window.event.srcElement;

	if(element && element.tagName=='IMG'){
		name = get_editor_name(element);
		eval('mode = '+name+'_rich_mode;'); //current mode

		eval('obj = '+name+'_id;'); //editor of the current button
		if(!obj) return;

    //in source mode toolbar buttons do not work
//    if(!mode) return;

		if(!active_button(element)) return; //button is inactive

		if(over){ //mouse is over button
			element.style.borderTop = '1px solid buttonhighlight';
			element.style.borderLeft = '1px solid buttonhighlight';
			element.style.borderBottom = '1px solid buttonshadow';
			element.style.borderRight = '1px solid buttonshadow';
		}else{    //mouse is moved from the button
			id_name = String(element.id);
			action_name = id_name.substring(0,id_name.length-name.length-1);

			if(action_name == 'SwitchBorders' ||
				action_name == 'FullScreen'){//switch borders button

				if(action_name == 'SwitchBorders') mode_name = 'border';
					else mode_name = 'full_screen';

				eval('border_mode = '+obj.name+'_rich_'+mode_name+'_mode;');
				old_active_rich = active_rich;
				active_rich = obj;
				set_state(action_name, border_mode);
				active_rich = old_active_rich;
			}else{//common buttons

				button_name = (id_name.split('_'))[0];
				if(button_name == 'Bold' || button_name == 'Italic' ||
				button_name == 'Underline'|| button_name == 'Strikethrough' ||
				button_name == 'SuperScript' || button_name == 'SubScript' ||
				button_name == 'JustifyLeft' || button_name == 'JustifyCenter' ||
				button_name == 'JustifyRight' || button_name == 'JustifyFull' ||
				button_name == 'InsertOrderedList' ||
				button_name == 'InsertUnorderedList'){
					//button changing its state accordingly to text formatting
					changing_button = true;
				}else{
					changing_button = false;
				}
				if(!changing_button ||
					!obj.document.queryCommandValue(action_name)){
					element.style.borderTop = '1px solid buttonface';
					element.style.borderLeft = '1px solid buttonface';
					element.style.borderBottom = '1px solid buttonface';
					element.style.borderRight = '1px solid buttonface';
				}else{ //do button pressed
					element.style.borderTop = '1px solid buttonshadow';
					element.style.borderLeft = '1px solid buttonshadow';
					element.style.borderBottom = '1px solid buttonhighlight';
					element.style.borderRight = '1px solid buttonhighlight';
				}

			}

		}

	}

}

//change current editor mode
function change_mode(){
var obj;
var mode;
var page_mode;
var active_mode;
var border_mode;
var i;
var text;
var button_id_parts;
var button_name;
var editror_name;
var full_screen_mode;
var abs_path;

  eval('obj = '+active_rich.name+'_id;');           //editor
  eval('mode = '+active_rich.name+'_rich_mode;');   //current mode
  eval('page_mode = '+active_rich.name+'_rich_page_mode;'); //current page mode
  eval('active_mode = '+active_rich.name+'_rich_active_mode;'); //active mode
  //current border mode
  eval('border_mode = '+active_rich.name+'_rich_border_mode;');
  //current fullscreen mode
  eval('full_screen_mode = '+active_rich.name+'_rich_full_screen_mode;');
  //absolute paths
  eval('abs_path = '+active_rich.name+'_rich_absolute_path;');

  if(mode){ //switch in source mode

    //unset borders
    if(border_mode){
      set_borders(false);
    }

    //set font and text colors for source code
    active_rich.document.body.runtimeStyle.fontFamily = 'Courier';
    active_rich.document.body.runtimeStyle.fontSize = '12px';
    active_rich.document.body.runtimeStyle.bgColor = '#FFFFFF';
    active_rich.document.body.runtimeStyle.color = '#000000';
    active_rich.document.body.runtimeStyle.background = '';

    if(!page_mode){
      active_rich.document.body.innerText = active_rich.document.body.innerHTML;
    }else{
      active_rich.document.body.innerText = active_rich.document.documentElement.outerHTML;
    }

    //color html tags in source mode
    text = color_source(active_rich.document.body.innerHTML);
//    active_rich.document.body.innerHTML = color_source(active_rich.document.body.innerHTML);

	if(abs_path) active_rich.document.body.innerHTML = text;
      else active_rich.document.body.innerHTML = del_base_url(text);

    //do toolbar buttons inactive
    for(i=0;i<document.images.length;i++){

      button_id_parts = document.images(i).id.match(/([^_]+)_(.+)$/);
      if(button_id_parts){
        button_name = button_id_parts[1];
        editor_name = button_id_parts[2];
        if(editor_name == active_rich.name){
          if(button_name != 'Cut' && button_name != 'Copy' &&
             button_name !=  'Paste' && button_name != 'Help' &&
             button_name != 'Preview'){
            show_button(button_name, false);
          }

        }
      }

    }

    //do all select elements inactive
    show_select('FormatBlock', false);
    show_select('FontName', false);
    show_select('FontSize', false);
    show_select('ClassName', false);

    eval(active_rich.name+'_rich_mode = false;');
  }else{    //switch in wysiwyg mode

    //unset font and text colors for source code
    active_rich.document.body.runtimeStyle.cssText = ""
//    active_rich.document.body.runtimeStyle.fontFamily = '';
//    active_rich.document.body.runtimeStyle.fontSize = '';

    if(!page_mode){
      active_rich.document.body.innerHTML = '<body>'+active_rich.document.body.innerText+'</body>';
    }else{
      active_rich.document.write(active_rich.document.body.innerText);
      active_rich.document.close();

      add_handlers(active_rich);
//      active_rich.document.body.innerHTML = active_rich.document.body.innerText;
    }

    //set borders
    if(border_mode){
      set_borders(true);
    }

    //do toolbar buttons active
    for(i=0;i<document.images.length;i++){

      button_id_parts = document.images(i).id.match(/([^_]+)_(.+)$/);
      if(button_id_parts){
        button_name = button_id_parts[1];
        editor_name = button_id_parts[2];
        if(editor_name == active_rich.name){
          show_button(button_name, true);
        }
      }

    }

    //redraw 'show borders' button
    set_state('SwitchBorders', border_mode);

    //redraw 'full screen' button
    set_state('FullScreen', full_screen_mode);

    //do all select elements active
    show_select('FormatBlock', true);
    show_select('FontName', true);
    show_select('FontSize', true);
    show_select('ClassName', true);

    eval(active_rich.name+'_rich_mode = true;');

    set_stylesheet_rules();//update class info

  }

  if(active_mode || mode){
    //do fullscreen mode button active/inactive
    show_button('FullScreen', full_screen_mode || document.all.rich_fs_iframe.style.display!='');
  }

  set_state('FullScreen', full_screen_mode);

  if(active_mode) change_toolbar_state(); //refresh toolbar buttons states

}

//changes current states of toolbar buttons
//according to style of text in current position of cursor
function change_toolbar_state(what){
var mode;
var active_mode;
var full_screen_mode;

	eval('active_mode = '+active_rich.name+'_rich_active_mode;'); //if active mode
	eval('mode = '+active_rich.name+'_rich_mode;'); //current mode
	//current fullscreen mode
	eval('full_screen_mode = '+active_rich.name+'_rich_full_screen_mode;');

	set_state('FullScreen', full_screen_mode);

	//in source mode toolbar buttons do not work
	if(!mode){
		if(active_mode){
			//make only clipboard buttons active/inactive
			show_clipboard_buttons();
		} 
		return;
	}

	if(!what || what == "FormatBlock")         set_style("FormatBlock", active_rich.document.queryCommandValue('FormatBlock'));
	if(!what || what == "FontName")            set_style("FontName", active_rich.document.queryCommandValue('FontName'));
	if(!what || what == "FontSize")            set_style("FontSize", active_rich.document.queryCommandValue('FontSize'));
	if(!what || what == "ClassName")           set_style("ClassName", get_class());

	if(!what || what == "Bold")                set_state("Bold", active_rich.document.queryCommandValue('Bold'));
	if(!what || what == "Italic")              set_state("Italic", active_rich.document.queryCommandValue('Italic'));
	if(!what || what == "Underline")           set_state("Underline", active_rich.document.queryCommandValue('Underline'));
	if(!what || what == "Strikethrough")       set_state("Strikethrough", active_rich.document.queryCommandValue('Strikethrough'));
	if(!what || what == "SuperScript")         set_state("SuperScript", active_rich.document.queryCommandValue('SuperScript'));
	if(!what || what == "SubScript")           set_state("SubScript", active_rich.document.queryCommandValue('SubScript'));
	if(!what || what == "JustifyLeft")         set_state("JustifyLeft", active_rich.document.queryCommandValue('JustifyLeft'));
	if(!what || what == "JustifyCenter")       set_state("JustifyCenter", active_rich.document.queryCommandValue('JustifyCenter'));
	if(!what || what == "JustifyRight")        set_state("JustifyRight", active_rich.document.queryCommandValue('JustifyRight'));
	if(!what || what == "JustifyFull")         set_state("JustifyFull", active_rich.document.queryCommandValue('JustifyFull'));
	if(!what || what == "InsertOrderedList")   set_state("InsertOrderedList", active_rich.document.queryCommandValue('InsertOrderedList'));
	if(!what || what == "InsertUnorderedList") set_state("InsertUnorderedList", active_rich.document.queryCommandValue('InsertUnorderedList'));

	if(active_mode){
		show_active_buttons();//make all buttons active/inactive
	}

}

//changes state of button 'what' to value
function set_state(what, value){
var element;

	//object to change
	eval('element = document.all.'+what+'_'+active_rich.name+';');

	if(element){
		if(value){ //pressed
			element.style.borderTop = '1px solid buttonshadow';
			element.style.borderLeft = '1px solid buttonshadow';
			element.style.borderBottom = '1px solid buttonhighlight';
			element.style.borderRight = '1px solid buttonhighlight';
		}else{    //released
			element.style.borderTop = '1px solid buttonface';
			element.style.borderLeft = '1px solid buttonface';
			element.style.borderBottom = '1px solid buttonface';
			element.style.borderRight = '1px solid buttonface';
		}
	}

}

//changes state of select element 'what' in value
function set_style(what, value){
var element;
var param = null;

	//correct format block name
	param = String(value).match(/Heading (.+)/);
	if(param) value = '<H'+param[1]+'>';

	if(value == 'Normal') value = '<P>';
	if(value == 'Formatted') value = '<PRE>';

	//object to change
	eval('element = document.all.'+what+'_'+active_rich.name+';');
	if(element) element.value = value;
}

//show dialog window to pick color
function pick_color(name){
	if(!name) var name = active_rich.name; //name of current editor

	return showModalDialog(rich_path+"pick_color.php?lang="+eval(name+"_lang")+"&110903", "",
                         "dialogWidth:445px; dialogHeight:140px; status:no; scroll:no; help:no");
}

//show dialog window to create/edit objects (table, image)
function show_dialog(action, object){
var mode;
var sel;
var r;
var is_control;
var attrib;
var parameters;
var link_text;
var element;
var link;
var i;
var param;
var outerHTML = '';
var text_class;
var element_type;
var button_object;

  eval('mode = '+active_rich.name+'_rich_mode;'); //current mode

  active_rich.focus(); //set focus on active editor

  //hide popup menu if exists
  if(rich_popup) rich_popup.hide();

  //in source mode toolbar dialog buttons do not work
  if(!mode && !(action == 'Help' || action == 'Preview')) return;

  //check, if any control element is active (i.e. image or table)
  sel = active_rich.document.selection;
  r = sel.createRange();
  if(sel.type == 'Control') is_control = true;
    else is_control = false;

  switch(action){
    case "CreateTable": //create table
      if(is_control && r.commonParentElement){ //table already exists
        element = r.commonParentElement();
        if(element.tagName != 'TABLE') break;
        show_dialog("EditTable", element);
        break;
      }

      parameters = show_table_dialog("");

      if(parameters) create_table(parameters);
      break;

    case "EditTable": //edit table

      attrib = get_table(object); //get values of table attributes
      parameters = show_table_dialog(attrib);

      if(parameters) edit_object(object, parameters);
      break;

    case "EditCell": //edit table cell

      if(object == null && r.parentElement) //edit table cell
        object = get_previous_object(r.parentElement(),'TD');

      attrib = get_cell(object); //get values of table cell attributes
      parameters = showModalDialog(rich_path+"dialog_cell.php?lang="+eval(active_rich.name+"_lang")+"&110903", attrib,
                                   "dialogWidth:310px; dialogHeight:180px; status:no; scroll:no; help:no");
      if(parameters) edit_object(object, parameters);
      break;

    case "CreateImage": //create image
      if(is_control && r.commonParentElement){ //image already exists
        element = r.commonParentElement();
        if(element.tagName != 'IMG') break;
        show_dialog("EditImage", element);
        break;
      }

      parameters = show_image_dialog("");

      if(parameters) create_image(parameters);
      break;

    case "EditImage": //edit image

      attrib = get_image(object); //get values of image attributes
      parameters = show_image_dialog(attrib);

      if(parameters) edit_object(object, parameters);
      break;

    case "CreateFlash": //create flash
      if(is_control && r.commonParentElement){ //flash already exists
        element = r.commonParentElement();
        if(element.tagName != 'OBJECT') break;
        show_dialog("EditFlash", element);
        break;
      }

      parameters = show_flash_dialog("");

      if(parameters) create_flash(parameters);
      break;

    case "EditFlash": //edit flash

      edit_flash(object);

      break;

    case "CreateLink": //create reference

      //no selected text or controls
      if(!is_control && sel.type != 'Text') break;

      if(r.parentElement){ //check, if text is inside a reference
        link = get_previous_object(r.parentElement(),'A');
      }else{
        if(r.commonParentElement){ //check, if control is inside a reference
          link = get_previous_object(r.commonParentElement(),'A');
        }else link = null;
      }

      if(link){ //it is a reference yet - edit it
        show_dialog("EditLink", link);
        break;
      }

      if(!is_control){
        link_text = r.htmlText;
        if(link_text.match(/<\/?A/i)) break; //there is a link inside
      }

      parameters = show_link_dialog("");

      if(parameters) create_link(parameters);
      break;

    case "EditLink": //edit reference

      attrib = get_link(object); //get values of image attributes
      parameters = show_link_dialog(attrib);

      if(parameters) edit_object(object, parameters);
      break;

    case "Help": //show help window

	  var name = active_rich.name;
	  var lang = eval(name+"_lang");
      window.open(rich_path+"lang/help_"+lang+".php?lang="+lang,"re_help_"+lang,
                  "toolbar=0,scrollbars=yes,resizable=yes");
      break;

    case "Preview": //preview of the current editor content
      var pre_window;
      var editor_content;
      var page_mode;
      var border_mode;
      var name;
      var abs_path;

      //get the current editor content
      name = active_rich.name;
      //current page mode
      eval('page_mode = '+name+'_rich_page_mode;');
      //current border mode
      eval('border_mode = '+active_rich.name+'_rich_border_mode;');
      //absolute paths
      eval('abs_path = '+active_rich.name+'_rich_absolute_path;');
      //default stypesheets
      eval('var rich_css = '+active_rich.name+'_rich_css;');

      if(!mode){ //source code mode

        editor_content = active_rich.document.body.innerText;

      }else{

        if(border_mode){
          set_borders(false);
        }

        if(!page_mode){
          editor_content = active_rich.document.body.innerHTML;
        }else{
          editor_content = active_rich.document.documentElement.outerHTML;
        }

		if(!abs_path) editor_content = del_base_url(editor_content);

        if(border_mode){
          set_borders(true);
        }

      }

      pre_window = window.open('', '', 'toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,titlebar=1');
      pre_window.document.write(editor_content);
      pre_window.document.close();

      if (!page_mode) { //add default css if not page mode
		for (i in rich_css) {
		  pre_window.document.createStyleSheet(rich_css[i]);
		}
      }

      break;

    case "CreateForm": //create form
      if(!is_control){
        element = get_previous_object(r.parentElement(),'FORM');
        if(element){ //form already exists
          show_dialog("EditForm", element);
          break;
        }

        parameters = show_form_dialog("", "form");
  
        if(parameters) create_form(parameters);
      }
      break;

    case "EditForm": //edit form

      if(!object) object = get_previous_object(r.parentElement(),'FORM');

      attrib = get_form(object); //get values of form attributes
      parameters = show_form_dialog(attrib, "form");

      if(parameters) edit_object(object, parameters);
      break;

    case "CreateHidden": //create hidden field
      if(is_control && r.commonParentElement){ //hidden element already exists
        element = r.commonParentElement();
        if(element.tagName != 'INPUT' ||
           element.type.toUpperCase() != 'HIDDEN'){
          break;
        }
        show_dialog("EditHidden", element);
        break;
      }

      parameters = show_form_dialog("", "hidden");

      if(parameters) create_hidden(parameters);
      break;

    case "EditHidden": //edit hidden field

      attrib = get_hidden(object); //get values of hidden field attributes
      parameters = show_form_dialog(attrib, "hidden");

      if(parameters) edit_object(object, parameters);
      break;

    case "CreateText": //create text field
      if(is_control && r.commonParentElement){ //text field already exists
        element = r.commonParentElement();
        if(element.tagName != 'INPUT' ||
           element.type.toUpperCase() != 'TEXT' &&
           element.type.toUpperCase() != 'PASSWORD'){
          break;
        }
        show_dialog("EditText", element);
        break;
      }

      parameters = show_form_dialog("", "text");

      if(parameters) create_input(parameters);
      break;

    case "EditText": //edit text field

      attrib = get_text_field(object); //get values of text field attributes
      parameters = show_form_dialog(attrib, "text");

      if(parameters){

        outerHTML = get_input_attributes(parameters);
        outerHTML = '<INPUT '+outerHTML+'>';
        object.outerHTML = outerHTML;

      }
      break;

    case "CreateTextArea": //create text area
      if(is_control && r.commonParentElement){ //text area already exists
        element = r.commonParentElement();
        if(element.tagName != 'TEXTAREA'){
          break;
        }
        show_dialog("EditTextArea", element);
        break;
      }

      parameters = show_form_dialog("", "textarea");

      if(parameters) create_textarea(parameters);
      break;

    case "EditTextArea": //edit text area

      attrib = get_textarea(object); //get values of text area attributes
      parameters = show_form_dialog(attrib, "textarea");

      if(parameters) edit_object(object, parameters);
      break;

    case "CreateButton": //create button
      if(is_control && r.commonParentElement){ //button already exists
        element = r.commonParentElement();
        if(element.tagName != 'INPUT' ||
           element.type.toUpperCase() != 'BUTTON' &&
           element.type.toUpperCase() != 'RESET' &&
           element.type.toUpperCase() != 'SUBMIT'){
          break;
        }
        show_dialog("EditButton", element);
        break;
      }

      parameters = show_form_dialog("", "button");

      if(parameters) create_input(parameters);
      break;

    case "EditButton": //edit text field

      attrib = get_form_button(object); //get values of button attributes
      parameters = show_form_dialog(attrib, "button");

      if(parameters){
        outerHTML = get_input_attributes(parameters);

        //...and restore old style settings
        outerHTML = '<INPUT '+outerHTML+' style="'+object.style.cssText+'">';
        object.outerHTML = outerHTML;
      }
      break;

    case "CreateCheckBox": //create checkbox
    case "CreateRadio":   //create radiobutton
      if(action == 'CreateCheckBox'){
        element_type = 'checkbox';
        action = 'EditCheckBox';
      }else{
        element_type = 'radio';
        action = 'EditRadio';
      }

      if(is_control && r.commonParentElement){ //button already exists
        element = r.commonParentElement();
        if(element.tagName != 'INPUT' ||
           element.type.toUpperCase() != element_type.toUpperCase()){
          break;
        }
        show_dialog(action, element);
        break;
      }

      parameters = show_form_dialog("", element_type);

      if(parameters) create_input(parameters);
      break;

    case "EditCheckBox": //edit checkbox
    case "EditRadio": //edit radio

      attrib = get_form_checkbox(object); //get values of checkbox attributes
      parameters = show_form_dialog(attrib, object.type.toLowerCase());

      if(parameters){
        outerHTML = get_input_attributes(parameters);

        //...and restore old style settings
        outerHTML = '<INPUT '+outerHTML+' style="'+object.style.cssText+'">';
        object.outerHTML = outerHTML;
      }
      break;

    case "InsertSnippet": //insert a snippet
      if(!is_control && r.parentElement){

        var snippets;
        eval('snippets = '+active_rich.name+'_snippets;');
  
        parameters = show_form_dialog(snippets, "snippet");
        if(parameters){
        var param;
          for(i=0;i<parameters.length;i++){
            param = parameters[i].match(/([^=]*)=(.*)/);
            if(param[1] == 'snippet'){
              do_action(action, param[2]);
            }
          }
        }

      }
      break;

    case "PageProperties": //page properties

      attrib = get_page_properties(); //get values of page properties
      parameters = show_page_dialog(attrib);
//for(i in parameters){
//	alert(i+' | '+ parameters[i]);
//}
      if(parameters) edit_page(parameters);
      break;

    default:
      break;
  }

}

//creates table using parameter array params
function create_table(params){
var table;
var param;
var rows;
var columns;
var width;
var height;
var cell;
var row;
var selection;
var range;
var i;
var border_mode;

  table = document.createElement("TABLE"); //create object - tag table

  //set values of given attributes
  for(i=0;i<params.length;i++){
    param = params[i].match(/([^=]*)=(.*)/);
    if(param[1] != 'rows' && param[1] != 'columns' &&
       param[1] != 'width' && param[1] != 'height'){
      if(param[2]) table.setAttribute(param[1], param[2]);
    }else{
      if(param[1] == 'rows') rows = param[2];
      if(param[1] == 'columns') columns = param[2];
      if(param[1] == 'width') width = param[2];
      if(param[1] == 'height') height = param[2];
    }
  }

  if( !(rows > 0 && columns > 0) ) return;

  if(width) table.style.width = width;
  if(height) table.style.height = height;

  table.removeAttribute('width');
  table.removeAttribute('height');

  //create necessary quantity of rows and columns
  for(i=0;i<rows;i++){
    row = document.createElement("TR");
    for(j=0;j<columns;j++){
      cell = document.createElement("TD");
      row.appendChild(cell);
    }
    table.appendChild(row);
  }

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(table.outerHTML);

  //current border mode
  eval('border_mode = '+active_rich.name+'_rich_border_mode;');
  //make table borders visible if necessary
  set_borders(border_mode);

}

//creates form using parameter array params
function create_form(params){
var param;
var selection;
var range;
var i;
var border_mode;
var outerHTML = '';

  //set values of given attributes
  for(i=0;i<params.length;i++){
    param = params[i].match(/([^=]*)=(.*)/);
    if(param[2]) outerHTML += ' '+param[1]+'='+'"'+param[2]+'"';
  }

  outerHTML = '<FORM'+outerHTML+'>&nbsp;</FORM>';

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(outerHTML);

  //current border mode
  eval('border_mode = '+active_rich.name+'_rich_border_mode;');
  //make form borders visible if necessary
  set_borders(border_mode);

}

//creates hidden using parameter array params
function create_hidden(params){
var param;
var selection;
var range;
var i;
var hidden;
var outerHTML = '';

  //set values of given attributes
  for(i=0;i<params.length;i++){
    param = params[i].match(/([^=]*)=(.*)/);
    if(param[2]) outerHTML += ' '+param[1]+'='+'"'+param[2]+'"';
  }

  outerHTML = '<INPUT type="hidden" size="1" '+outerHTML+'>';

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(outerHTML);

}

//creates text area using parameter array params
function create_textarea(params){
var param;
var selection;
var range;
var i;
var textarea;
var value = '';
var outerHTML = '';

  //set values of given attributes
  for(i=0;i<params.length;i++){
//    param = params[i].match(/([^=]*)=(.*)/);
    param = params[i].match(/([^=]*)=([\s|\S|\n]*)/);
    if(param[2]){
      if(param[1] == 'value') value = param[2];
        else outerHTML += ' '+param[1]+'='+'"'+param[2]+'"';
    }
  }

  outerHTML = '<TEXTAREA '+outerHTML+'>'+value+'</TEXTAREA>';

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(outerHTML);

}

//creates common input field using parameter array params
function create_input(params){
var param;
var selection;
var range;
var i;
var hidden;
var outerHTML = '';
var checked = '';

  //set values of given attributes
  for(i=0;i<params.length;i++){
    param = params[i].match(/([^=]*)=(.*)/);
    if(param[2]){
      if(param[1] == 'checked'){
        if(param[2]=='true') checked = ' CHECKED';
      }else outerHTML += ' '+param[1]+'='+'"'+param[2]+'"';
    }
  }

  outerHTML = '<INPUT '+outerHTML+checked+'>';

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(outerHTML);

}

//search among parents an object with tag tag_name
function get_previous_object(obj,tag_name) {
  if(obj){

    //to prevent search outside editor
    if(obj.className == "editor") return null;

    if(obj.tagName != tag_name){
      obj = get_previous_object(obj.parentNode, tag_name);
    }
  }
  return(obj);
}

//get values of attributes of table 'table'
function get_table(table){
  var attrib;
  attrib = new Array();

  attrib['rows'] = table.rows.length;
  attrib['columns'] = table.rows(0).cells.length;
  attrib['width'] = table.style.width;
  attrib['height'] = table.style.height;
  attrib['border'] = table.getAttribute('border');
  attrib['align'] = table.getAttribute('align');
  attrib['cellSpacing'] = table.getAttribute('cellspacing');
  attrib['cellPadding'] = table.getAttribute('cellpadding');
  attrib['background'] = table.getAttribute('background');
  attrib['bgColor'] = table.getAttribute('bgColor');
  attrib['borderColor'] = table.getAttribute('borderColor');
  attrib['borderColorLight'] = table.getAttribute('borderColorLight');
  attrib['borderColorDark'] = table.getAttribute('borderColorDark');
  return attrib;
}

//get values of attributes of form 'form'
function get_form(form){
  var attrib;
  attrib = new Array();

  attrib['name'] = form.name;
  attrib['action'] = form.action;
  attrib['method'] = form.method;
  return attrib;
}

//get values of attributes of hidden field 'hidden'
function get_hidden(hidden){
  var attrib;
  attrib = new Array();

  attrib['name'] = hidden.name;
  attrib['value'] = hidden.value;
  return attrib;
}

//get values of attributes of text area 'textarea'
function get_textarea(textarea){
  var attrib;
  attrib = new Array();

  attrib['name'] = textarea.name;
  attrib['value'] = textarea.value;
  attrib['rows'] = textarea.rows;
  attrib['cols'] = textarea.cols;
  return attrib;
}

//get values of attributes of text field 'textfield'
function get_text_field(textfield){
  var attrib;
  attrib = new Array();

  attrib['name'] = textfield.name;
  attrib['value'] = textfield.value;
  attrib['type'] = textfield.type;
  attrib['maxLength'] = textfield.maxLength;
  attrib['size'] = textfield.size;
  attrib['className'] = textfield.className;
  return attrib;
}

//get values of attributes of button 'button'
function get_form_button(button){
  var attrib;
  attrib = new Array();

  attrib['name'] = button.name;
  attrib['value'] = button.value;
  attrib['type'] = button.type;
  attrib['className'] = button.className;
  return attrib;
}

//get values of attributes of checkbox/radio button 'button'
function get_form_checkbox(button){
  var attrib;
  attrib = new Array();

  attrib['name'] = button.name;
  attrib['value'] = button.value;
  attrib['checked'] = button.checked;
  attrib['type'] = button.type;
  attrib['className'] = button.className;
  return attrib;
}

//get values of page properties
function get_page_properties(){
var attrib = new Array();
var meta;
var meta_length;
var i;
var name;

	if(!active_rich) return;

	attrib['title'] = active_rich.document.title;
	attrib['background'] = active_rich.document.body.background;
	attrib['bgColor'] = active_rich.document.body.bgColor;
	attrib['text'] = active_rich.document.body.text;
	attrib['link'] = active_rich.document.body.link;
	attrib['aLink'] = active_rich.document.body.aLink;
	attrib['vLink'] = active_rich.document.body.vLink;

	//page's meta tags
	meta = active_rich.document.getElementsByTagName('META');
	meta_length = meta.length;
	for(i=0;i<meta_length;i++){
		name = meta[i].name.toLowerCase();
		if(name == 'keywords' || name == 'description'){
			attrib[name] = meta[i].content;
		}
	}

	return attrib;
}

//modify page properties
function edit_page(params){
var param;
var i;
var meta = new Array();
var meta_length;
var keywords = null;
var description = null;
var name;
var obj;
var head;
var new_meta;

	if(!active_rich) return;

	//page's meta tags
	meta = active_rich.document.getElementsByTagName('META');
	meta_length = meta.length;
	for(i=0;i<meta_length;i++){
		name = meta[i].name.toLowerCase();
		if(name == 'keywords' || name == 'description'){
			eval(name+'=meta[i]');
		}
	}

	for(i=0;i<params.length;i++){
		param = params[i].match(/([^=]*)=([\s|\S|\n]*)/);
		switch(param[1]){
			case 'title':
				active_rich.document.title = param[2];
				break;
			case 'background':
			case 'bgColor':
			case 'text':
			case 'link':
			case 'aLink':
			case 'vLink':
				if(param[2]) active_rich.document.body.setAttribute(param[1], param[2]);
					else active_rich.document.body.removeAttribute(param[1]);
				break;
			case 'keywords':
			case 'description':
				eval('obj='+param[1]);
				if(obj){
					obj.content = param[2];
				}else{
					head = active_rich.document.getElementsByTagName('HEAD');
					new_meta = active_rich.document.createElement("META");
					new_meta.name = param[1];
					new_meta.content = param[2];
					head(0).appendChild(new_meta);
				}
				break;
			default:
				break;
		}
	}
}

//changes attributes of an object
function edit_object(object, params){
var param;
var i;

  //set values of given attributes
  for(i=0;i<params.length;i++){
//    param = params[i].match(/([^=]*)=(.*)/);
    param = params[i].match(/([^=]*)=([\s|\S|\n]*)/);
    if(param[1] != 'rows' && param[1] != 'columns' ||
       object.tagName == "TEXTAREA"){

      if((object.tagName == "TABLE" || object.tagName == "IMG") &&
         (param[1]=='width' || param[1]=='height')){
        //set width and height for image in style
        if(param[2]){
          eval("object.style."+param[1]+" = param[2];");
        }
      }else{
        if(param[2]){
          object.setAttribute(param[1], param[2]);
        }else{
          object.removeAttribute(param[1]);
        }

        //if href attribute is empty, delete link
        if(param[1] == 'href' && !param[2]){
          object.removeNode(false);
          return;
        }
      }

    }
  }

  //removes style attribute of text area, unless width and height parameters
  //set there will define size of text area, not rows and cols
  if(object.tagName == 'TEXTAREA'){
    object.removeAttribute('style');
  }
}

//gets values of table cell 'object'
function get_cell(object){
  var attrib;
  attrib = new Array();

  attrib['width'] = object.getAttribute('width');
  attrib['height'] = object.getAttribute('height');
  attrib['vAlign'] = object.getAttribute('vAlign');
  attrib['bgColor'] = object.getAttribute('bgColor');
  return attrib;
}


//prepare parameters of dialog window to return in parent window
function get_parameters(){
var parameters;
var radio_done;
var i,j,k;
var name;

  parameters = new Array();

  //array of flags for radio elements, to prevent multiple
  //writing information about chosen item of a radio item
  radio_done = new Array();

  j=0;
  for(i=0;i<form_name.length;i++){
    name = form_name[i].name;

    if(name){
      switch(form_name[i].type){
        case 'text':
        case 'textarea':
        case 'select-one':
          parameters[j] = name+"="+(eval("form_name."+name+".value"));
          j++;
          break;
        case 'checkbox':
          parameters[j] = name+"=";
          is_checked = eval("form_name."+name+".checked");

          if(name == 'block_announce' || name == 'Play' || name == 'Loop' ||
             name == 'Menu' || name == 'checked'){
            parameters[j] += is_checked;
          }else{
            if(is_checked){
              if(name == "background"){
                parameters[j] += (eval("form_name."+name+"_image.src"));
              }else{
                parameters[j] += (eval(name+"_table.bgColor"));
              }
            }
          }

          j++;
          break;
        case 'radio':
          if(!radio_done[name]){
            object = eval("form_name."+name);
  
            for(k=0;k<object.length;k++){
              if(object[k].checked){
                parameters[j] = name+"="+object[k].value;
                j++;
                break;
              }
            }
            radio_done[name] = true;
          }
          break;
        default:
          break;
      }
    }

  }

  return parameters;
}

//set color of the current element
function set_color(){
var name;
var obj;
var color;

  if(window.event.srcElement.name){
    name = window.event.srcElement.name;
  }else{
    obj = get_previous_object(window.event.srcElement, "TABLE");
    name = obj.id;
    name = (name.split('_'))[0];
  }

  color = pick_color("dialog");
  if(color){
    eval(name+"_table.bgColor = '"+color+"';");
    eval("form_name."+name+".checked = true;");
  }
}

//choose image for table background
function set_image(){
var name;
var old_src;
var old_params;
var params;
var src;
var width;
var height;
var param;
var i;

  name = window.event.srcElement.name;
  if(window.event.srcElement.tagName == 'IMG'){
    name = (name.split('_'))[0];
  }else{
    name = window.event.srcElement.name;
  }

  eval("old_src = form_name."+name+"_image.src;");
  if(old_src.search("images/space.gif") < 0){
    old_params = new Array();
    old_params['src'] = old_src;
  }else old_params = "";

  params = show_image_dialog(old_params, "dialog");

  if(params){
    src = '';
    width = 0;
    height = 0;

    for(i=0;i<params.length;i++){
      param = params[i].match(/([^=]*)=(.*)/);
      switch(param[1]){
        case 'width':
        case 'height':
          if(param[2]) eval(param[1]+"="+param[2]+";");
          break;
        case 'src':
          eval(param[1]+"='"+param[2]+"';");
          break;
        default:
          break;
      }
  
    }

    if(src && width && height){
      set_preview_table_image(eval("form_name."+name+"_image"),
                              src, width, height);
      eval("form_name."+name+".checked = true;");
    }
  }
}

//initialize dialog window according to received parameters, if available
function init_dialog(form){
var parameters;
var name;
var i;

  resize_dialog(); //correct window size

  if(!window.dialogArguments) return false; //no parameters - creation mode

  //editing mode
  parameters = window.dialogArguments;

  for(i=0;i<form_name.length;i++){
    name = form_name[i].name;

    if(name){
      switch(form_name[i].type) {
        case 'text':
        case 'textarea':
        case 'select-one':
          if(parameters[name]){

            if(name == 'width' || name == 'height'){
              parameters[name] = parameters[name].replace('px', '');
            }

//            eval("form_name."+name+".value = '"+parameters[name]+"';");
            eval("form_name."+name+".value = parameters[name];");

            //make fields for setting numbers of rows and columns inactive
            if(name == "rows" || name == "columns"){
              eval("form_name."+name+".disabled=true;");
            }
          }
          break;
        case 'checkbox':
          if(parameters[name]){
            eval("form_name."+name+".checked = true;");
            if(name == "background"){ //load image for table background
              window.is_init = true;
              form_name.temp_image.src = parameters[name];
              //then parameters of preview image will be set
              //on parsing of event 'onload' for image 'temp_image'
            }else{
              if(!(name == 'Play' || name == 'Loop' || name == 'Menu' ||
                   name == 'checked')){
                eval(name+"_table.bgColor = '"+parameters[name]+"';");
              }
            }
          }
          break;
        case 'radio':
          if(parameters[name]){
            eval("document.all."+name+"_"+parameters[name]+".checked=true;");
          }
          break;
        default:
          break;
      }
    }

  }

  return true; //editing mode

}

//inserts row into current table just after current row
function insert_row(){
var range;
var tr;
var table;
var row;
var i;
var curr_colspan;

  range = active_rich.document.selection.createRange();

  tr = get_previous_object(range.parentElement(),'TR');
  table = get_previous_object(tr,'TABLE');

  if(table != null){

    row = table.insertRow(tr.rowIndex+1); //create new row
    for(i=0;i<tr.cells.length;i++){ //fill the row with columns
      row.insertCell(i);

      //take colspan values from the previous row cells
      curr_colspan = tr.cells(i).colSpan;
      if(curr_colspan > 1){
        row.cells(i).colSpan = curr_colspan;
      }
    }

  }

}

//deletes current row from current table
function delete_row(){
var range;
var tr;
var table;

  range = active_rich.document.selection.createRange();

  tr = get_previous_object(range.parentElement(),'TR');
  table = get_previous_object(tr,'TABLE');

  if(table != null){
    if(table.rows.length <= 1){
      table.removeNode(true); //it is the last row - delete whole table
    }else{
      table.deleteRow(tr.rowIndex); //delete row
    }

  }

}

//insert column in current table just after current column
function insert_column(){
var range;
var td;
var table;
var i;
var curr_rowspan;
var cell_index;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  table = get_previous_object(td,'TABLE');

  if(table != null){

    //insert new cells in each row
    for(i=0;i<table.rows.length;i++){
      if(td.cellIndex+1 > table.rows(i).cells.length){
        cell_index = table.rows(i).cells.length;
      }else{
        cell_index = td.cellIndex+1;
      }
      table.rows(i).insertCell(cell_index);

      //take rowspan values from current column cells
      if(cell_index > 0){
        curr_rowspan = table.rows(i).cells(cell_index-1).rowSpan;
      }else curr_rowspan = 1;

      if(curr_rowspan > 1){
        table.rows(i).cells(cell_index).rowSpan = curr_rowspan;
        i += curr_rowspan-1; //next curr_rowspan-1 cells are from another column
      }
    }

  }

}

//delete current column from current table
function delete_column(){
var range;
var td;
var table;
var i;
var tr;
var cell_index;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  table = get_previous_object(td,'TABLE');

  if(table != null){
    cell_index = td.cellIndex;

    //insert new cells in each row
    for(i=0;i<table.rows.length;i++){

      tr = table.rows(i);
      if(tr.cells.length<=1){
        //it is the last column in the row - delete table
        table.removeNode(true);
      }else{
        if(cell_index < tr.cells.length){
          if(tr.cells(cell_index).rowSpan>1) i+=tr.cells(cell_index).rowSpan-1;
          tr.deleteCell(cell_index);
        }
      }

    }

  }

}

//insert cell in current table just after current cell
function insert_cell(){
var range;
var td;
var tr;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  tr = get_previous_object(td,'TR');

  if(tr != null){
    //insert new cell after current one
    tr.insertCell(td.cellIndex+1);
  }

}

//delete current cell from current table
function delete_cell(){
var range;
var td;
var table;
var tr;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  tr = get_previous_object(range.parentElement(),'TR');
  table = get_previous_object(td,'TABLE');

  if(table != null){

    if(tr.cells.length<=1){
      //it is the last cell in the row - delete row
      table.deleteRow(tr.rowIndex); //delete row

      if(table.rows.length == 0){
        //there are no rows - delete table
        table.removeNode(true);
      }
    }else{
      tr.deleteCell(td.cellIndex);
    }

  }

}

//merge cells
function merge_cells(){ 
var range;
var td;
var tr;
var next_td;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  tr = get_previous_object(range.parentElement(),'TR');

  //check if the current cell is not last in the row
  if(tr != null && td.cellIndex < tr.cells.length-1){ 
    //increase current cell colspan value by next cell colspan value
    //and delete the next cell
    next_td = tr.cells(td.cellIndex+1);
    td.innerHTML += next_td.innerHTML; 
    td.colSpan += next_td.colSpan;
    tr.deleteCell(td.cellIndex+1); 
  } 

} 

//split cell
function split_cell(){
var range;
var td;
var tr;

  range = active_rich.document.selection.createRange();

  td = get_previous_object(range.parentElement(),'TD');
  tr = get_previous_object(range.parentElement(),'TR');

  //split cells with colSpan > 1 only
  if(tr != null && td.colSpan > 1){
     td.colSpan--;
     tr.insertCell(td.cellIndex+1);
  }

} 

//creates image using array of parameters 'params'
function create_image(params){
var image;
var param;
var width;
var height;
var selection;
var range;
var i;

  image = document.createElement("IMG"); //create object - tag IMG

  //set values of the given attributes
  for(i=0;i<params.length;i++){
    param = params[i].match(/([^=]*)=(.*)/);

    if(param[1] != 'width' && param[1] != 'height'){
      if(param[2]) image.setAttribute(param[1], param[2]);
    }else{
      if(param[1] == 'width') width = param[2];
      if(param[1] == 'height') height = param[2];
    }

  }

  if(width) image.style.width = width;
  if(height) image.style.height = height;

  image.removeAttribute('width');
  image.removeAttribute('height');

  selection = active_rich.document.selection;
  range = selection.createRange();
  range.pasteHTML(image.outerHTML);

}

//get values of attributes of image 'image'
function get_image(image){
var attrib;
var width;
var height;

  attrib = new Array();

  width = image.style.width;
  height = image.style.height;

  if(width) attrib['width'] = width;
  if(height) attrib['height'] = height;

  attrib['src'] = image.getAttribute('src');
  attrib['border'] = image.getAttribute('border');
  attrib['align'] = image.getAttribute('align');
  attrib['hspace'] = image.getAttribute('hspace');
  attrib['vspace'] = image.getAttribute('vspace');
  attrib['alt'] = image.getAttribute('alt');

  return attrib;
}

//make preview of the image chosen with size not exceeding 100x100
function set_preview_image(url, w, h){
var preview_size;

  preview_size = 100;

  w = parseInt(w);
  h = parseInt(h);

  if(!w || !h) return;

  if(w > h){ //width > height
    document.form_name.preview_image.width = preview_size;
    document.form_name.preview_image.height = preview_size*h/w;
  }else{ //height > width
    document.form_name.preview_image.height = preview_size;
    document.form_name.preview_image.width = preview_size*w/h;
  }

  document.form_name.preview_image.src = url;

}

//make preview of the image chosen for table backbround
//with size not exceeding 100x100
function set_preview_table_image(object, url, w, h){
var preview_size;
var name;

  preview_size = 100;

  w = parseInt(w);
  h = parseInt(h);

  if(w > h){ //width > height
    object.width = preview_size;
    object.height = preview_size*h/w;
  }else{ //height > width
    object.height = preview_size;
    object.width = preview_size*w/h;
  }

  object.src = url;

  name = (object.name.split('_'))[0];
  eval("form_name."+name+".checked = true;");

}

//creates flash using array of parameters 'params'
function create_flash(params){
var param;
var flash;
var selection;
var range;

var aligh = '';
var height = '';
var width = '';
var src = '';
var Play = '';
var Loop = '';
var Quality = '';
var Menu = '';
var BGColor = '';

  if(params){

    //set values of the given attributes
    for(i=0;i<params.length;i++){
      param = params[i].match(/([^=]*)=(.*)/);
  
      eval(param[1]+' = "'+param[2]+'";');
    }

    if(Play != 'false') Play = -1;
      else Play = 0;
    if(Loop != 'false') Loop = -1;
      else Loop = 0;
    if(Menu != 'false') Menu = -1;
      else Menu = 0;

    selection = active_rich.document.selection;
    range = selection.createRange();

    flash = '<OBJECT style="width:'+width+'; height:'+height+'"'+
'    align="'+align+'" src="'+src+'" codebase='+
'    "http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab"'+
'    height="'+height+'" width="'+width+'" classid='+
'    "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'+
'      <PARAM name="Movie" value="'+src+'">'+
'      <PARAM name="Src" value="'+src+'">'+
'      <PARAM name="WMode" value="Window">'+
'      <PARAM name="Play" value="'+Play+'">'+
'      <PARAM name="Loop" value="'+Loop+'">'+
'      <PARAM name="Quality" value="'+Quality+'">'+
'      <PARAM name="SAlign" value="">'+
'      <PARAM name="Menu" value="'+Menu+'">'+
'      <PARAM name="Base" value="">'+
'      <PARAM name="AllowScriptAccess" value="always">'+
'      <PARAM name="Scale" value="ShowAll">'+
'      <PARAM name="DeviceFont" value="0">'+
'      <PARAM name="EmbedMovie" value="0">'+
'      <PARAM name="BGColor" value="'+BGColor+'">'+
'      <PARAM name="SWRemote" value="">'+
'    </OBJECT>';

    //insert flash body
    range.pasteHTML(flash);

  }

}

//edit flash object
function edit_flash(flash){
var width;
var height;
var attrib = new Array();
var parameters;
var i;
var child;
var src = '';

//  attrib = get_flash(object); //get values of flash attributes

  if(flash.style.width) width = flash.style.width;
  if(flash.style.height) height = flash.style.height;

  if(!width) width = flash.width;
  if(!height) height = flash.height;

  if(width) attrib['width'] = width;
  if(height) attrib['height'] = height;

  attrib['align'] = flash.align;

  //look through PARAM tags
  for(i=0;i<flash.childNodes.length;i++){
    child = flash.childNodes(i);
    if(child.tagName == 'PARAM'){
      child_name = child.name;
      switch(child_name){
        case 'Play':
        case 'Loop':
        case 'Menu':
          child_val  = Number(child.value);
          break;
        case 'Movie':
          if(src){
            break;
          }
        case 'Src':
          child_name = 'src';
          child_val  = child.value;
          break;
        default:
          child_val  = child.value;
          break;
      }
      attrib[child_name] = child_val;
    }
  }

  parameters = show_flash_dialog(attrib);

  if(parameters){ //substitute an existing flash for the new one
    flash.removeNode(true);
    create_flash(parameters);
  }

}

//make preview of the flash chosen
function set_preview_flash(url, w, h){
var preview_size;
var flash;
var width;
var height;

	preview_size = 100;

	w = parseInt(w);
	h = parseInt(h);

	if(w > h){ //width > height
		width = preview_size;
		height = preview_size*h/w;
	}else{ //height > width
		height = preview_size;
		width = preview_size*w/h;
	}

	flash = '<OBJECT align="" src="'+url+'" codebase='+
'"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab"'+
' height="'+height+'" width="'+width+'" classid='+
'"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">'+
' <PARAM name="_cx" value="4180">'+
' <PARAM name="_cy" value="1455">'+
' <PARAM name="FlashVars" value="4180">'+
' <PARAM name="Movie" value="'+url+'">'+
' <PARAM name="Src" value="'+url+'">'+
' <PARAM name="WMode" value="Window">'+
' <PARAM name="Play" value="-1">'+
' <PARAM name="Loop" value="-1">'+
' <PARAM name="Quality" value="High">'+
' <PARAM name="SAlign" value="">'+
' <PARAM name="Menu" value="-1">'+
' <PARAM name="Base" value="">'+
' <PARAM name="AllowScriptAccess" value="always">'+
' <PARAM name="Scale" value="ShowAll">'+
' <PARAM name="DeviceFont" value="0">'+
' <PARAM name="EmbedMovie" value="0">'+
' <PARAM name="BGColor" value="d1d1cc">'+
' <PARAM name="SWRemote" value="">'+
'</OBJECT>';

	document.all.flash_div.innerHTML = flash;

}

//show dialog window to create/edit table
function show_table_dialog(attrib){
	return show_object_dialog('table', attrib);

}

//show dialog window to create/edit image
function show_image_dialog(attrib, name){
	return show_object_dialog('image', attrib, name);
}

//show dialog window to create/edit flash
function show_flash_dialog(attrib, name){
	return show_object_dialog('flash', attrib, name);
}

//show dialog window to create/edit reference
function show_link_dialog(attrib, name){
	return show_object_dialog('link', attrib, name);
}

//show dialog window to edit page properties
function show_page_dialog(attrib){
	return show_object_dialog('page', attrib);
}

//show dialog window to create/edit various objects
function show_object_dialog(object, attrib, name){
var w;
var h;

	if(!object) return;
	if(!name) var name = active_rich.name; //name of current editor

	switch(object){
		case 'table':
			w = 350;
			h = 430;
			break;
		case 'image':
			w = 410;
			h = 440;
			break;
		case 'flash':
			w = 410;
			h = 440;
			break;
		case 'link':
			w = 410;
			h = 440;
			break;
		case 'page':
			w = 350;
			h = 430;
			break;
		default:
			return;
	}

	return showModalDialog(rich_path+"dialog_"+object+".php?files_path="+eval(name+"_files_path")+"&files_url="+eval(name+"_files_url")+"&lang="+eval(name+"_lang")+"&110903aaaaaaaaaaaaaaaaaaaaaaaaaa", attrib,
                           "dialogWidth:"+w+"px; dialogHeight:"+h+"px; status:no; scroll:no; help:no");

}

//show dialog window to create/edit form
function show_form_dialog(attrib, action){
var w;
var h;

  switch(action){
    case 'form':
      w = 331;
      h = 170;
      break;
    case 'text':
      w = 243;
      h = 305;
      break;
    case 'textarea':
      w = 250;
      h = 295;
      break;
    case 'button':
      w = 253;
      h = 210;
      break;
    case 'hidden':
      w = 300;
      h = 170;
      break;
    case 'checkbox':
      w = 253;
      h = 215;
      break;
    case 'radio':
      w = 253;
      h = 215;
      break;

    case 'snippet':
      w = 305;
      h = 343;
      break;
    default:
      w = 331;
      h = 200;
      break;
  }
	return showModalDialog(rich_path+"dialog_form.php?action="+action+"&lang="+eval(active_rich.name+"_lang")+"&110903aaaaaa", attrib,
                           "dialogWidth:"+w+"px; dialogHeight:"+h+"px; status:no; scroll:no; help:no");

}

//create reference using array of parameters 'params'
function create_link(params){
var i;
var param;
var selection;
var range;
var object;
var link = Array();

	link = document.createElement("A"); //create object - tag A

	//set values of the attributes given
	for(i=0;i<params.length;i++){
		param = params[i].match(/([^=]*)=(.*)/);

		if(param[1] == 'href' && !param[2]) return; //empty reference
			else link[param[1]] = param[2];

	}

	selection = active_rich.document.selection;
	range = selection.createRange();

	range.execCommand("CreateLink", false, link['href']);

	if(selection.type == 'Control'){//get html text of the control
		object = range(0).parentNode;
//		object = range.commonParentElement();
	}else{//get html text of the selection
		object = range.parentElement();
	}

	if(object && link.target) object.target = link['target'];
}

//gets values of attributes of reference 'link'
function get_link(link){
	var attrib = new Array();
	var abs_path;

	eval('abs_path = '+active_rich.name+'_rich_absolute_path;');//1-absolute paths

	attrib['target'] = link.getAttribute('target');
	attrib['href'] = link.getAttribute('href', 2);
	if(!abs_path) attrib['href'] = del_base_url(attrib['href']);

	return attrib;
}

//saves text of all editors in textarea objects (for form submit)
function save_in_textarea_all(){
var i;
var mode;
var page_mode;
var border_mode;
var name;
var text;

	for(i=0;i<document.all.length;i++){
		if(document.all(i).className == 'editor'){
			eval('mode = '+document.all(i).name+'_rich_mode;'); //current mode
			//current page mode
			eval('page_mode = '+document.all(i).name+'_rich_page_mode;');
			//current border mode
			eval('border_mode = '+document.all(i).name+'_rich_border_mode;');
			//absolute paths
			eval('abs_path = '+document.all(i).name+'_rich_absolute_path;');
			
			name = document.all(i).name;
			eval("active_rich = "+document.all(i).id+";");
			if(!mode){ //jump in wysiwyg mode
				change_mode();
			}
			
			if(border_mode) switch_borders(true); //turn borders off
			
			if(!page_mode){
				eval("text="+name+"_id.document.body.innerHTML");
			}else{
				eval("text="+name+"_id.document.documentElement.outerHTML");
			}
			
			if(!abs_path) text = del_base_url(text);
			
			eval("document.all['"+name+"_area_id'].value=text");
		
		  }
	}
}

//find all document stylesheet rules and add their names to select object
function set_stylesheet_rules(){
//asdf.document.body.innerText = asdf.document.body.outerHTML;
var rule_values = new Array();
var rule_found = false;
var sheets;
var sheets_num;
var i,j,k;
var rules;
var rules_num;
var rule_value;
var rule_found;
var rules_select;
var option;
var old_rule_value;

  sheets = active_rich.document.styleSheets;
  sheets_num = sheets.length;

  //there are some stylesheets
  if(sheets_num > 0){

    for(i=0;i<sheets_num;i++){
      rules = sheets(i).rules;
      rules_num = rules.length;

      for(j=0;j<rules_num;j++){
        rule_value = rules(j).selectorText
        //in rules of the type 'td.toolbar span.delimiter{...}'
        //ignore all chars after space char
        rule_value = (rule_value.split(' '))[0];

        //rules MUST have '.' in their names, as it is user defined rules
        if(rule_value.indexOf(".") >= 0){

          //there is ':' char found in the rule name
          if(rule_value.indexOf(":") >= 0){

            //there are both '.' and ':' chars in the rule name
            rule_value = rule_value.substring(rule_value.indexOf(".")+1,rule_value.indexOf(":"));

          }else{

            //name begins with '.'
            if(rule_value.indexOf(".") == 0){
              rule_value = rule_value.substring(1,rule_value.length);
            }else{
              //name do not begins with '.'
              if(rule_value.indexOf(".") > 0){
                rule_value = rule_value.substring(rule_value.indexOf(".")+1,rule_value.length);
              }
            }

          }

          //prevent adding the the same rule names
          for(k=0;k<rule_values.length;k++){
            if(rule_value == rule_values[k]){
              rule_found = true;
              break;
            }
          }

          //new rule
          if(rule_found != true){
            rule_values[rule_values.length] = rule_value;
          }
          rule_found = false;

        }

      }

    }

    //select object
    eval('rules_select = document.all.ClassName_'+active_rich.name+';');

    if(rules_select){

      //store selecter rule name
      old_rule_value = rules_select[rules_select.selectedIndex].value;

      //delete old classes from the select object, except first
      while(rules_select.options[1] != null){
        rules_select.options[1].removeNode(true);
      }
  
      for(i=0;i<rule_values.length;i++){
        if(rule_values[i] != ''){
          option = document.createElement("option");
          option.value = rule_values[i];
          option.text = rule_values[i];
          rules_select.add(option);
        }
      }

      rules_select.value = old_rule_value;

    }

  }

}

//set class attribute for current text or control element
function set_class(rule_value){
var sel = active_rich.document.selection;
var range = sel.createRange();
var is_set;
var object;
var parentTagName;

  if(sel.type == "Control"){
    object = range.commonParentElement();
  }else{

    if(range.parentElement != null){

      parentTagName = range.parentElement().tagName.toUpperCase();

      if(range.htmlText == ""){
        object = range.parentElement();
      }else{
        if(parentTagName=="SPAN" || parentTagName=="A"){
  
          object = range.parentElement();
  
        }else{
          if(rule_value != ""){
            try{
              range.pasteHTML("<span class=" + rule_value + ">" + range.htmlText + "</span>");
            }catch(error){
              //do nothing on error, just prevent error message to user
            }
          }
          is_set = true
        }
  
      }
  
      if(rule_value == "" && parentTagName == "SPAN"){
        object.removeNode(false);
        is_set = true;
      }

    }

  }

  if(object != null && is_set != true && object.tagName != 'BODY'){
    object.className = rule_value;
  }

}

//get class attribute for current text cursor position
function get_class(){
var sel = active_rich.document.selection;
var range = sel.createRange();
var object = null;

  if(sel.type == "Control"){
    object = range.commonParentElement();
  }else{
    object = range.parentElement();
  }

  if(object != null){

    //to prevent search outside editor
    if(object.className == "editor") return "";

    //search class name among parents
    while(object.className == ""){
      object = object.parentElement;
      if(object == null) return "";
    }

    return object.className;
  }
  return "";
}

function clean_code(code) {    
  // get rid of silly space tags
  code = code.replace(/&nbsp;/gi, "")
  // gets rid of all xml stuff... <xml>,<\xml>,<?xml> or <\?xml>
  code = code.replace(/<\\?\??xml[^>]*>/gi, "")
  // get rid of ugly colon tags <a:b> or </a:b>
  code = code.replace(/<\/?\w+:[^>]*>/gi, "")
  // removes all empty <p> tags
  code = code.replace(/<p([^>])*>(&nbsp;)*\s*<\/p>/gi,"")
  // removes all span tags
  code = code.replace(/<span[^>]*>([^<]*)<\/span>/gi,"$1")
  // removes all Class attributes on a tag eg. '<p class=asdasd>xxx</p>' returns '<p>xxx</p>'
  code = code.replace(/<([\w]+) class=([^ |>]*)([^>]*)/gi, "<$1$3")
  // removes all style attributes eg. '<tag style="asd asdfa aasdfasdf" something else>' returns '<tag something else>'
  code = code.replace(/<([^>]+) style="([^"]*)"([^>]*)/gi, "<$1$3")   

  return code
}

//paste MSWord formatted text from clipboard
function paste_word(){
var sel = active_rich.document.selection.createRange();
var temp_obj;

  if(sel.parentElement){
    //paste in temporary element
    temp_obj = rich_temp_iframe;
    temp_obj.focus();
    temp_obj.document.execCommand("SelectAll");
    temp_obj.document.execCommand("Paste");


    sel.pasteHTML(clean_code(temp_obj.document.body.innerHTML));
  }

  active_rich.focus(); //set focus on active editor

}

//show/hide borders of invisible objects
function set_borders(border_mode){
var tables = active_rich.document.body.getElementsByTagName("TABLE");
var forms = active_rich.document.body.getElementsByTagName("FORM");
var page_mode;
var i,j,k;
var width;
var height;
var rows;
var cells;

  eval('page_mode = '+active_rich.name+'_rich_page_mode;'); //current page mode

  for(i=0;i<tables.length;i++){

    if(border_mode){
      tables[i].style.border = '1px dashed #CCCCCC';
    }else{

      width = tables[i].style.width;
      height = tables[i].style.height;

      tables[i].removeAttribute("style");

      if(width) tables[i].style.width = width;
      if(height) tables[i].style.height = height;

    }

    rows = tables[i].rows;
    for(j=0;j<rows.length;j++){
      cells = rows[j].cells;
      for(k=0;k<cells.length;k++){
        if(border_mode){
          cells[k].style.border = '1px dashed #CCCCCC';
        }else{
          cells[k].removeAttribute("style");
        }
      }
    }

  }

  //show form borders
  for(i=0;i<forms.length;i++){
    if(border_mode){
      forms[i].style.border = '1px dotted #FF0000';
    }else{
      forms[i].removeAttribute("style");
    }
  }

  if(!page_mode){
    active_rich.document.body.innerHTML = '<body>'+active_rich.document.body.innerHTML+'</body>';
  }else{
    active_rich.document.body.innerHTML = active_rich.document.documentElement.outerHTML;
  }
}

//change border mode
function switch_borders(change){
var border_mode;

  //current border mode
  eval('border_mode = '+active_rich.name+'_rich_border_mode;');

  if(change){//change border visibility
    border_mode = border_mode==true?false:true;
    set_state('SwitchBorders', border_mode);
    eval(active_rich.name+'_rich_border_mode = border_mode;');
  }

  set_borders(border_mode);

}

//insert a special character
function insert_char(){
var sel = active_rich.document.selection.createRange();
var char;

  //get character selected in the dialog window
  char = showModalDialog(rich_path+"dialog_char.php?lang="+eval(active_rich.name+"_lang")+"&110903", "",
                         "dialogWidth:450px; dialogHeight:320px; status:no; scroll:no; help:no");

  if(char && sel.parentElement){
   sel.pasteHTML(char); //insert the character in editor
  }

  active_rich.focus(); //set focus on active editor

}

//color html tags in source code
function color_source(code){

  var parameter = /=("[^\"]*"|'[^\']*'|[^\"\'\s\&]*)(\s|&gt;)/gi;
  code = code.replace(parameter,"=<font color=#0000F0>$1</font>$2");

  var html_tag = /(&lt;([^&]*)&gt;)/gi;
  code = code.replace(html_tag,"<font color=\"#000080\">$1</font>");

  var img_tag = /<font color=\"#000080\">(&lt;IMG([^&]*)&gt;)<\/font>/gi;
  code = code.replace(img_tag,"<font color=\"#800080\">$1</font>");

  var table_tag = /<font color=\"#000080\">(&lt;[\/]?(table|tbody|th|tr|td){1}([^&]*)&gt;)<\/font>/gi;
  code = code.replace(table_tag,"<font color=\"#008080\">$1</font>");

  var link_tag = /<font color=\"#000080\">(&lt;[\/]?a([^&]*)&gt;)<\/font>/gi;
  code = code.replace(link_tag,"<font color=\"#008000\">$1</font>");

  var object_tag = /<font color=\"#000080\">(&lt;[\/]?object([^&]*)&gt;)<\/font>/gi;
  code = code.replace(object_tag,"<font color=\"#808000\">$1</font>");

  var param_tag = /<font color=\"#000080\">(&lt;[\/]?param([^&]*)&gt;)<\/font>/gi;
  code = code.replace(param_tag,"<font color=\"#B00000\">$1</font>");

  var comment_tag = /(&lt;\!--([^&]*)&gt;)/gi;
  code = code.replace(comment_tag,"<font color=#808080>$1</font>");

  var form_tag = /(&lt;[\/]?(form|input|textarea)([^&]*)&gt;)/gi;
  code = code.replace(form_tag,"<font color=#FF8000>$1</font>");

  var script_tag = /(&lt;[\/]?script([^&]*)&gt;)/gi
  code = code.replace(script_tag,"<font color=#800000>$1</font>")

  return code;
}

/*
//color html tags in source code (for use in MSIE 5.5+ only) recommended!
function color_source55(code){

  var parameter = /=("[\s\S]*?"|'[\s\S]*?'|[\s\S]*?)(\s|&gt;)/gi;
  code = code.replace(parameter,"=<font color=#0000F0>$1</font>$2");

  var html_tag = /(&lt;([\s\S]*?)&gt;)/gi;
  code = code.replace(html_tag,"<font color=\"#000080\">$1</font>");

  var img_tag = /<font color=\"#000080\">(&lt;IMG([\s\S]*?)&gt;)<\/font>/gi;
  code = code.replace(img_tag,"<font color=\"#800080\">$1</font>");

  var table_tag = /<font color=\"#000080\">(&lt;[\/]?(table|tbody|th|tr|td){1}([\s\S]*?)&gt;)<\/font>/gi;
  code = code.replace(table_tag,"<font color=\"#008080\">$1</font>");

  var link_tag = /<font color=\"#000080\">(&lt;[\/]?a([\s\S]*?)&gt;)<\/font>/gi;
  code = code.replace(link_tag,"<font color=\"#008000\">$1</font>");

  var object_tag = /<font color=\"#000080\">(&lt;[\/]?object([^&]*)&gt;)<\/font>/gi;
  code = code.replace(object_tag,"<font color=\"#808000\">$1</font>");

  var param_tag = /<font color=\"#000080\">(&lt;[\/]?param([^&]*)&gt;)<\/font>/gi;
  code = code.replace(param_tag,"<font color=\"#B00000\">$1</font>");

  var comment_tag = /(&lt;\!--([\s\S]*?)&gt;)/gi;
  code = code.replace(comment_tag,"<font color=#808080>$1</font>");

  var form_tag = /(&lt;[\/]?(form|input|textarea)([\s\S]*?)&gt;)/gi;
  code = code.replace(form_tag,"<font color=#FF8000>$1</font>");

  var script_tag = /(&lt;[\/]?script([\s\S]*?)&gt;)/gi
  code = code.replace(script_tag,"<font color=#800000>$1</font>")

  return code;
}
*/

//show/hide button 'what'
function show_button(what, show){
var element;

  //get button element
  eval('element = document.all.'+what+'_'+active_rich.name+';');

  if(!element) return; //the button is absent

  if(show){
    element.className = '';
  }else{
    element.style.borderTop = '1px solid buttonface';
    element.style.borderLeft = '1px solid buttonface';
    element.style.borderBottom = '1px solid buttonface';
    element.style.borderRight = '1px solid buttonface';

    element.className = 'img_off';
  }

}

//show/hide select control 'what'
function show_select(what, show){
var element;

  eval('element = document.all.'+what+'_'+active_rich.name);

  if(!element) return; //the button is absent
  element.disabled=!show;

}

//get editor name of button 'element'
function get_editor_name(element){
var pos;
var button_id_parts;

  if(!element) return '';

  button_id_parts = element.id.match(/([^_]+)_(.+)$/);
  if(button_id_parts) return button_id_parts[2];
  return '';
}

//show/hide buttons depending on the current cursor position
function show_active_buttons(){
var sel;
var range;
var is_control;
var i;
var text_button = Array('Bold', 'Italic', 'Underline', 'Strikethrough',
                        'SuperScript', 'SubScript', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyFull',
                        'InsertOrderedList', 'InsertUnorderedList',
                        'Indent', 'Outdent', 'RemoveFormat',
                        'ForeColor', 'BackColor', 'PasteWord', 'InsertChar');
var button_length = text_button.length;
var text_select = Array('FormatBlock', 'FontName', 'FontSize');
var select_length = text_select.length;
var td;
var tr;
var table_button = Array('InsertRow', 'DeleteRow', 'InsertColumn',
                         'DeleteColumn', 'InsertCell', 'DeleteCell');
var table_length = table_button.length;
var form_button = Array('CreateText', 'CreateTextArea', 'CreateButton',
                        'CreateHidden', 'CreateCheckBox', 'CreateRadio');
var form_length = form_button.length;
var visible;
var element;

var create_table = false;
var create_image = false;
var create_flash = false;

var create_textfield = false;
var create_textarea = false;
var create_button = false;
var create_hidden = false;
var create_checkbox = false;
var create_radio = false;

var prev_is_control;
var full_screen_mode;

  if(!active_rich) return;

  sel = active_rich.document.selection;
  range = sel.createRange();
  if(sel.type == 'Control') is_control = true;
    else is_control = false;

  //if previous  selection was a control
  eval('prev_is_control = '+active_rich.name+'_prev_is_control;');
  //store current is_control value
  eval(active_rich.name+'_prev_is_control = '+is_control+';');

  if(!is_control){ //no controls are selected
    show_button('CreateLink', range.htmlText&&sel.type=='Text'?true:false);

    td = get_previous_object(range.parentElement(),'TD');
    tr = get_previous_object(td,'TR');

    //do cell buttons active/inactive
    for(i=0;i<table_length;i++){
      show_button(table_button[i], td?true:false);
    }

    //do MergeCells button active/inactive
    visible = tr && td.cellIndex<tr.cells.length-1;
    show_button('MergeCells', visible);
    //do SplitCell button active/inactive
    visible = tr && td.colSpan > 1;
    show_button('SplitCell', visible);

    //redraw 'create control' buttons only if they actually changed
    //to accelerate editor
    if(prev_is_control != is_control){
      show_button('CreateTable', true);
      show_button('CreateImage', true);
      show_button('CreateFlash', true);
      show_button('InsertHorizontalRule', true);
      show_button('CreateForm', true);
      show_button('InsertSnippet', true);

      //do form controls active
      for(i=0;i<form_length;i++){
        show_button(form_button[i], true);
      }
    }

  }else{ //a control element selected

    //do cell buttons inactive
    for(i=0;i<table_length;i++){
      show_button(table_button[i], false);
    }
    //do MergeCells button inactive
    show_button('MergeCells', false);
   
    element = range.commonParentElement(); //the selected control element
    if(element){
      switch(element.tagName){
        case 'TABLE':
          create_table = true;
          break;
        case 'IMG':
          create_image = true;
          break;
        case 'OBJECT':
         create_flash = true;
          break;
        case 'INPUT':
          switch(element.type.toUpperCase()){
            case 'HIDDEN':
              create_hidden = true;
              break;
            case 'TEXT':
            case 'PASSWORD':
              create_textfield = true;
              break;
            case 'BUTTON':
            case 'RESET':
            case 'SUBMIT':
              create_button = true;
              break;
            case 'CHECKBOX':
              create_checkbox = true;
              break;
            case 'RADIO':
              create_radio = true;
              break;
            default:
              break;
          }
          break;
        case 'TEXTAREA':
          create_textarea = true;
          break;
        default:
          break;
      }
      show_button('CreateTable', create_table);
      show_button('CreateImage', create_image);
      show_button('CreateFlash', create_flash);
      show_button('CreateLink', true);
      show_button('InsertHorizontalRule', false);
      show_button('InsertSnippet', false);

      //change states of form buttons
      show_button('CreateForm', false);
      show_button('CreateHidden', create_hidden);
      show_button('CreateText', create_textfield);
      show_button('CreateTextArea', create_textarea);
      show_button('CreateButton', create_button);
      show_button('CreateCheckBox', create_checkbox);
      show_button('CreateRadio', create_radio);

    }

  }

  //redraw text buttons and selects only if they actually changed
  //to accelerate editor
  if(prev_is_control != is_control){
    //do text buttons active/inactive
    for(i=0;i<button_length;i++){
      show_button(text_button[i], !is_control);
    }
  
    //do selects active/inactive
    for(i=0;i<select_length;i++){
      show_select(text_select[i], !is_control);
    }

  }

  //make clipboard buttons active/inactive
  show_clipboard_buttons();

  //undo and redo buttons
  visible = active_rich.document.queryCommandEnabled('Undo');
  show_button('Undo', visible);
  visible = active_rich.document.queryCommandEnabled('Redo');
  show_button('Redo', visible);

  //current fullscreen mode
  eval('full_screen_mode = '+active_rich.name+'_rich_full_screen_mode;');

  //do fullscreen mode button active/inactive
  show_button('FullScreen', full_screen_mode || document.all.rich_fs_iframe.style.display!='');
}

//make clipboard buttons active/inactive
function show_clipboard_buttons(){
var cut_copy_visible;
var paste_visible;
var success = true;

  if(!active_rich) return;

  //cut, copy and paste buttons
  try{
    cut_copy_visible = active_rich.document.queryCommandEnabled('Cut');
    paste_visible = active_rich.document.queryCommandEnabled('Paste');
  }catch(error){
    cut_copy_visible = false
    paste_visible = false;
    success = false;
  }

  if(success){
    show_button('Copy', cut_copy_visible);
    show_button('Cut', cut_copy_visible);
    show_button('Paste', paste_visible);
    show_button('PasteWord', paste_visible);
  }
}

//check if button 'element' is active
function active_button(element){
//  if(element && element.name != 'off') return true;
  if(element && element.className != 'img_off') return true;
  return false;
}

//get object of button 'what'
function get_button_object(what){
var obj;

  //get button element
  eval('obj = document.all.'+what+'_'+active_rich.name+';');
  return obj;
}

//switch on/off fullscreen mode
function full_screen(editor_name){
var full_screen_mode;
var i;
var obj;
var table_name = editor_name+'_table_id';
var div_name = editor_name+'_div_id';

	//current border mode
	eval('full_screen_mode = '+active_rich.name+'_rich_full_screen_mode;');

	if(!active_button('FullScreen') ||
		(!full_screen_mode && document.all.rich_fs_iframe.style.display == '')){
		return;
	}

	full_screen_mode = full_screen_mode==true?false:true;
	set_state('FullScreen', full_screen_mode);
	eval(active_rich.name+'_rich_full_screen_mode = full_screen_mode;');

	if(full_screen_mode){

		document.getElementById(div_name).runtimeStyle.position = "Absolute";
		document.getElementById(div_name).runtimeStyle.zIndex = "999";
		document.getElementById(div_name).runtimeStyle.posTop = 0;
		document.getElementById(div_name).runtimeStyle.posLeft = 0;
		document.getElementById(div_name).runtimeStyle.width = document.body.clientWidth - 0;
		document.getElementById(div_name).runtimeStyle.height = document.body.offsetHeight - 4;

		document.getElementById(table_name).runtimeStyle.position = "Absolute";
		document.getElementById(table_name).runtimeStyle.zIndex = "999";
		document.getElementById(table_name).runtimeStyle.posTop = 0;
		document.getElementById(table_name).runtimeStyle.posLeft = 0;
		document.getElementById(table_name).runtimeStyle.width = document.body.clientWidth - 0;
		document.getElementById(table_name).runtimeStyle.height = document.body.offsetHeight - 4;

		document.all.rich_fs_iframe.style.display = '';
		document.getElementById('rich_fs_iframe').runtimeStyle.position = "Absolute";
		document.getElementById('rich_fs_iframe').runtimeStyle.zIndex = "998";
		document.getElementById('rich_fs_iframe').runtimeStyle.posTop = 0;
		document.getElementById('rich_fs_iframe').runtimeStyle.posLeft = 0;
		document.getElementById('rich_fs_iframe').runtimeStyle.width = document.body.clientWidth - 0;
		document.getElementById('rich_fs_iframe').runtimeStyle.height = document.body.offsetHeight - 4;
	}else{
		document.getElementById(table_name).runtimeStyle.cssText = "";
		document.getElementById(div_name).runtimeStyle.cssText = "";

		document.all.rich_fs_iframe.style.display = 'none';
	}

	active_rich.focus();

}

//prepare list of attributes for input element,
//using array of attributes 'parameters'
function get_input_attributes(parameters){
var i;
var param;
var outerHTML = '';
var checked = '';

	//set values of given attributes
	for(i=0;i<parameters.length;i++){
		param = parameters[i].match(/([^=]*)=(.*)/);
		if(param[2]){
			if (param[1] == 'className'){ //restore class attribute
				outerHTML += ' class='+'"'+param[2]+'"';
			}else{
				if(param[1] == 'checked'){
					if(param[2]=='true') checked = ' CHECKED';
				}else outerHTML += ' '+param[1]+'='+'"'+param[2]+'"';
			}
		}
	}

	return outerHTML+checked;
}

//show snippet popup menu
function parse_context(){
var i;
var innerHTML = '';
var event;
var sel;
var range;
var mode;
var element;
var td;
var tr;
var link_name;
var flag = false;
var flag2 = false;
var do_hr = false;
var width = 0;
var height = 4;
var td_height = 20;
var hr_height = 4;
var char_width = 8;//13
var max_chars = 0;
var chars;
var lang;

	if(!rich_popup) return;

	sel = active_rich.document.selection;
	range = sel.createRange();

	eval('mode = '+active_rich.name+'_rich_mode;'); //current mode
	eval('lang = '+active_rich.name+'_lang;'); //language
	eval('var dir = '+active_rich.name+'_rich_dir;'); //direction of language
	eval('var mb = '+active_rich.name+'_rich_mb;'); //if multibyte language
	if (mb != '') char_width = 13;

	eval('var rich_cx = rich_cx_'+lang);
	eval('var rich_cx_item = rich_cx_item_'+lang);
	eval('var rich_cx_name = rich_cx_name_'+lang);
	eval('var rich_cx_image = rich_cx_image_'+lang);
	eval('var rich_cx_length = rich_cx_length_'+lang);

	//cut, copy and paste items
	try{
		if(active_rich.document.queryCommandEnabled('Cut')){
			if(get_button_object('Cut')){
				innerHTML += get_popup_menu_item(rich_cx['CUT'], 'Cut', 'cut');
				max_chars=Math.max(max_chars, rich_cx['CUT'].length);
				height += td_height;
			}
			if(get_button_object('Copy')){
				innerHTML += get_popup_menu_item(rich_cx['COPY'], 'Copy', 'copy');
				max_chars=Math.max(max_chars, rich_cx['COPY'].length);
				height += td_height;
			}
    
			do_hr = true;
		}
		if(active_rich.document.queryCommandEnabled('Paste')){
			if(get_button_object('Paste')){
				innerHTML += get_popup_menu_item(rich_cx['PASTE'], 'Paste', 'paste');
				max_chars=Math.max(max_chars, rich_cx['PASTE'].length);
				height += td_height;
			}
			if(range.parentElement && get_button_object('PasteWord')){
				innerHTML += get_popup_menu_item(rich_cx['PASTEWORD'], 'PasteWord', 'paste_word');
				max_chars=Math.max(max_chars, rich_cx['PASTEWORD'].length);
				height += td_height;
			}
    
			do_hr = true;
		}
	}catch(error){
	}

	if(mode){ //only clipboard items are visible in source mode

		if(sel.type != 'Control'){ //no controls are selected
  
			var do_image = get_button_object('CreateImage');
			var do_link = range.htmlText&&sel.type=='Text'  &&
							get_button_object('CreateLink');
			var do_table = get_button_object('CreateTable');
			var do_flash = get_button_object('CreateFlash');
			var do_form = get_previous_object(range.parentElement(),'FORM') &&
							get_button_object('CreateForm');

			//insert control items
			if(do_image || do_link || do_table || do_flash || do_form){
				if(do_hr){
					innerHTML += get_popup_menu_item('<HR>');
					height += hr_height;
				}
				do_hr = true;
			}
			if(do_image){
				innerHTML += get_popup_menu_item(rich_cx['ADDIMAGE'], 'CreateImage', 'image', null, true);
				max_chars=Math.max(max_chars, rich_cx['ADDIMAGE'].length);
				height += td_height;
			}
			if(do_link){
				if(get_previous_object(range.parentElement(),'A')){
					link_name = rich_cx['EDITLINK']; //if link exists - edit it
					chars = rich_cx['EDITLINK'].length;
				}else{
					link_name = rich_cx['ADDLINK'];
					chars = rich_cx['ADDLINK'].length;
				}
				innerHTML += get_popup_menu_item(link_name, 'CreateLink', 'link', null, true);
				max_chars=Math.max(max_chars, chars);
				height += td_height;
			}
			if(do_flash){
				innerHTML += get_popup_menu_item(rich_cx['ADDFLASH'], 'CreateFlash', 'flash', null, true);
				max_chars=Math.max(max_chars, rich_cx['ADDFLASH'].length);
				height += td_height;
			}
			if(do_form){
				innerHTML += get_popup_menu_item(rich_cx['EDITFORM'], 'EditForm', 'form', null, true);
				max_chars=Math.max(max_chars, rich_cx['EDITFORM'].length);
				height += td_height;
			}
    
			if(do_table){
				innerHTML += get_popup_menu_item(rich_cx['ADDTABLE'], 'CreateTable', 'table', null, true);
				max_chars=Math.max(max_chars, rich_cx['ADDTABLE'].length);
				height += td_height;
    
				td = get_previous_object(range.parentElement(),'TD');
				tr = get_previous_object(td,'TR');
    
				if(td){
					innerHTML += get_popup_menu_item(rich_cx['EDITCELL'], 'EditCell', null, null, true);
					max_chars=Math.max(max_chars, rich_cx['EDITCELL'].length);
					height += td_height;
    
					//add cell items
					for(i=0;i<rich_cx_length;i++){
						if(get_button_object(rich_cx_item[i])){
							//first common table button
							if(i<=3 && do_hr && !flag2){
								innerHTML += get_popup_menu_item('<HR>');
								height += hr_height;
								flag2 = true;
							}
							//common table buttons passed
							if(i>3 && do_hr && !flag){
								innerHTML += get_popup_menu_item('<HR>');
								height += hr_height;
								flag = true;
							}
							innerHTML += get_popup_menu_item(rich_cx_name[i],
										rich_cx_item[i], rich_cx_image[i]);
							max_chars=Math.max(max_chars, rich_cx_name[i].length);
							height += td_height;
							do_hr = true;
						}
					}
    
				}
    
				//add MergeCells item
				if(tr && td.cellIndex<tr.cells.length-1 &&
					get_button_object('MergeCells')){
					if(!flag){
						innerHTML += get_popup_menu_item('<HR>');
						height += hr_height;
						flag = true;
					}
					innerHTML += get_popup_menu_item(rich_cx['MERGE'], 'MergeCells', 'mergecells');
					max_chars=Math.max(max_chars, rich_cx['MERGE'].length);
					height += td_height;
				}
				//add SplitCell item
				if(tr && td.colSpan > 1 && get_button_object('SplitCell')){
					if(!flag){
						innerHTML += get_popup_menu_item('<HR>');
						height += hr_height;
					}
					innerHTML += get_popup_menu_item(rich_cx['SPLIT'], 'SplitCell', 'splitcell');
					max_chars=Math.max(max_chars, rich_cx['SPLIT'].length);
					height += td_height;
				}
    
			}
      
		}else{//a control selected
			if(get_button_object('CreateLink')){
				if(do_hr){
					innerHTML += get_popup_menu_item('<HR>');
					height += hr_height;
				}
			//check, if control is inside a reference
			if(get_previous_object(range.commonParentElement(),'A')){
				link_name = rich_cx['EDITLINK'];
			}else link_name = rich_cx['ADDLINK'];
				innerHTML += get_popup_menu_item(link_name, 'CreateLink', 'link', null, true);
				max_chars=Math.max(max_chars, link_name.length);
				height += td_height;
				do_hr = true;
			}
    
			element = range.commonParentElement(); //the selected control element
			var tag_name = element.tagName;
			if(tag_name == 'INPUT') tag_name = element.type.toUpperCase();

			//insert the control's 'Edit' item
			if(rich_cx[tag_name] && get_button_object(rich_cx[tag_name][1])){
				if(do_hr){
					innerHTML += get_popup_menu_item('<HR>');
					height += hr_height;
				}
				innerHTML += get_popup_menu_item(rich_cx[tag_name][0],
					rich_cx[tag_name][1], rich_cx[tag_name][2], null, true);
				max_chars=Math.max(max_chars, rich_cx[tag_name][0].length);
				height += td_height;
				do_hr = true;
			}
  
		}

	}

	//show the popup context window
	if(innerHTML != ''){

		//form the final popup menu code
		innerHTML = get_popup_menu_body(innerHTML);

		active_rich.frameWindow = active_rich;
		event = active_rich.frameWindow.event;

		//set width of content in popup window
		width = max_chars*char_width+40;

		//set popup content and show the menu
		rich_popup.document.body.innerHTML = innerHTML;
		rich_popup.document.body.dir = dir;
		rich_popup.show(event.clientX, event.clientY, width, height,
						active_rich.document.body);
	}

}

//get html code of popup item with name 'name'
//if the item is chosen, an event action is generated with value 'value'
//ie if is_dialog null or false do_action(action,value) called
//otherwise show_dialog(action) called
function get_popup_menu_item(name, action, img_name, value, is_dialog){
var code = '';

	code += '<tr>';
	if(name != '<HR>'){
		code += '<td id="rich_cx_'+action+'" onclick="eval(\'var active_mode = parent.\'+parent.active_rich.name+\'_rich_active_mode;\'); if(active_mode) parent.show_active_buttons(); parent.';
		if(is_dialog){
			code += 'show_dialog(\''+action+'\')';
		}else{
			code += 'do_action(\''+action+'\'';
			if(value != null) code += ',\''+value+'\'';
			code += '); if(parent.rich_popup) parent.rich_popup.hide();';
		}
		code += '" style="cursor:hand; font-family:Courier; font-size:13px;"';
		code += ' onmouseover="parent.context_over(this, true);"';
		code += ' onmouseout="parent.context_over(this);">';
	}else{
		code += '<td>';
	}

	code += '<nobr>';
	if(img_name){
		code += '<img src="'+rich_path+'images/'+img_name+'.gif" width="20" height="20" alt="'+name+'" align="absmiddle" hspace="4">';
	}else{
		code += '<img src="'+rich_path+'images/space.gif" width="20" height="1" hspace="4">';
	}

	if(name != '<HR>'){
		code += name;
	}else{
		code += '<br><img src="'+rich_path+'images/space.gif" width="100%" height="1" style="BACKGROUND-COLOR: buttonshadow"><br>';
		code += '<img src="'+rich_path+'images/space.gif" width="100%" height="1" style="BACKGROUND-COLOR: buttonhighlight"><br>';
	}

	code += '<img src="'+rich_path+'images/space.gif" width="8" height="1"></nobr>';
	code += '</td></tr>';

	return code;
}

//add to popup content innerHTML outer code
function get_popup_menu_body(innerHTML){
var code = '';

	code += '<table cellspacing="0" cellpadding="0" border="0" style="BORDER-LEFT: 1px solid buttonface; BORDER-RIGHT: 1px solid black; BORDER-TOP: 1px solid buttonface; BORDER-BOTTOM: 1px solid black;" bgcolor="buttonface" width="100%" height="100%">';
	code += '<tr><td>';
	code += '<table id="popup_table" cellspacing="0" cellpadding="0" border="0" style="BORDER-LEFT: 1px solid buttonhighlight; BORDER-RIGHT: 1px solid buttonshadow; BORDER-TOP: 1px solid buttonhighlight; BORDER-BOTTOM: 1px solid buttonshadow;" bgcolor="buttonface" width="100%" height="100%">';
	code += innerHTML;
	code += '</table>';
	code += '</td></tr>';
	code += '</table>';

	return code;
}

//highlight context menu item
function context_over(obj, over){
	if(over){
		obj.style.backgroundColor = 'Highlight';
		obj.style.color = 'HighlightText';
	}else{
		obj.style.backgroundColor = '';
		obj.style.color = '';
	}
}

//insert a snippet value in the editor
function insert_snippet(value){
var selection = active_rich.document.selection;
var range;
var snippets;
var border_mode;

	if(selection) range = selection.createRange();

	if(value && range && range.parentElement){

		eval('snippets = '+active_rich.name+'_snippets;'); //array of snippets
		if(snippets && snippets[value] && snippets[value][1]){
			range.pasteHTML(snippets[value][1]);

			//current border mode
			eval('border_mode = '+active_rich.name+'_rich_border_mode;');
			//make borders visible if necessary
			set_borders(border_mode);
		}

	}

}

//add to editor event handlers
function add_handlers(editor){
	if(rich_msie_version < 5.5){
		editor.document.oncontextmenu = function(){
			active_rich=editor;
			parse_context_ie5();
			return false;
		}
	}else{
		editor.document.oncontextmenu = function(){
			active_rich=editor;
			parse_context();
			return false;
		}
	}
	editor.document.onkeyup = function(){
		active_rich=editor;
		change_toolbar_state();
	}
	editor.document.onclick = function(){
		active_rich=editor;
		change_toolbar_state();
	}
	editor.document.onmouseup = function(){
		active_rich = editor;
		active_rich.frameWindow = active_rich;
		if(active_rich.frameWindow.event.button != 2){
			change_toolbar_state();
		}
	}
}

//delete base url from link
function del_base_url(text){
var re = new RegExp(rich_base_url,'gi');

	RegExp.multiline = true;
	return String(text).replace(re, '');

}

//resize dialog window to fit its content
function resize_dialog(){

  window.dialogWidth = window.document.body.scrollWidth -
						window.document.body.clientWidth +
						parseInt(window.dialogWidth) + 'px';
  window.dialogHeight = window.document.body.scrollHeight -
						window.document.body.clientHeight +
						parseInt(window.dialogHeight) + 'px';
}

//error message handler
function no_error(){
  return true;
} 