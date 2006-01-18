<?php

	// english
	// 03.09.2003

	$rich_lang = array(
//'Charset' => 'iso-8859-1',
'Charset' => 'windows-1251',
'Direction' => '', //set to 'rtl' if language direction is right to left
'Multibyte' => '', //set to not empty string if language is multibyte

'FullScreen' => 'Full screen',

'Preview' => 'Preview',

'Cut' => 'Cut', 'Copy' => 'Copy', 'Paste' => 'Paste',
'Undo' => 'Undo', 'Redo' => 'Redo',

'Bold' => 'Bold', 'Italic' => 'Italic', 'Underline' => 'Underline',
'Strikethrough' => 'Strikethrough',

'SuperScript' => 'SuperScript', 'SubScript'=>'SubScript',

'JustifyLeft' => 'Justify Left', 'JustifyCenter' => 'Justify Center',
'JustifyRight' => 'Justify Right', 'JustifyFull' => 'Justify Full',

'InsertOrderedList' => 'Insert Ordered List',
'InsertUnorderedList' => 'Insert Unordered List',
'Outdent' => 'Outdent', 'Indent' => 'Indent',

'InsertHorizontalRule' => 'Insert Horizontal Line',
'RemoveFormat' => 'Remove Formatting',

'CreateTable' => 'Create Table',
'InsertRow' => 'Insert Row', 'DeleteRow' => 'Delete Row',
'InsertColumn' => 'Insert Column', 'DeleteColumn' => 'Delete Column',

'CreateForm' => 'Create Form',
'CreateText' => 'Create Text Field', 'CreateTextArea' => 'Create Text Area',
'CreateButton' => 'Create Button', 'CreateHidden' => 'Create Hidden Field',
'CreateCheckBox' => 'Create CheckBox', 'CreateRadio' => 'Create Radio Button',

'InsertCell' => 'Insert Cell', 'DeleteCell' => 'Delete Cell',
'MergeCells' => 'Merge Cells', 'SplitCell' => 'Split Cell',

'FormatBlock' => 'Paragraph', 'FontName' => 'Font',
'ClassName' => 'Class', 'FontSize' => 'Size',

'ForeColor' => 'Text Color', 'BackColor' => 'Backgroung Color',

'CreateImage' => 'Create Image', 'CreateFlash' => 'Create Flash',
'CreateLink' => 'Create Link',

'PasteWord' => 'Paste from Word', 'SwitchBorders' => 'Switch Borders',
'InsertChar' => 'Insert Char', 'InsertSnippet' => 'Insert Snippet',
'PageProperties' => 'Page Properties',

'Help' => 'Help',

'Source' => 'Source',

//Context menu items
'EditTable' => 'Edit Table',
'EditImage' => 'Edit Image',
'EditFlash' => 'Edit Flash',
'EditText' => 'Edit Text Field',
'EditTextArea' => 'Edit Text Area',
'EditButton' => 'Edit Button',
'EditHidden' => 'Edit Hidden Field',
'EditCheckBox' => 'Edit CheckBox',
'EditRadio' => 'Edit Radio Button',
'EditLink' => 'Edit Link',
'EditForm' => 'Edit Form',
'EditCell' => 'Edit Cell',


//dialog texts
'Table' => array(
	'Title' => 'Create/Edit Table',
	'Sizes' => 'Sizes',
	'Rows' => 'Rows',
	'Columns' => 'Columns',
	'Width' => 'Width',
	'Height' => 'Height',
	'Background' => 'Background',
	'Color' => 'Color',
	'Image' => 'Image',
	'Padding&Spacing' => 'Padding&Spacing',
	'Padding' => 'Padding',
	'Spacing' => 'Spacing',
	'Border' => 'Border',
	'Colorlight' => 'Colorlight',
	'Colordark' => 'Colordark'
),

'TableCell' => array(
    'Title' => 'Edit Table Cell',
	'Sizes' => 'Sizes',
	'Width' => 'Width',
	'Height' => 'Height',
	'Align&Color' => 'Align&Color',
	'vAlign' => 'vAlign',
	'Color' => 'Color'
),

'ColorPicker' => array(
	'Title' => 'Color picker'
),

'RemoteFiles' => array(
	'root' => 'root',
	'CreateFolder' => 'create folder',
	'CreateFolderIn' => 'Create folder in',
	'NewNameFor' => 'New name for',
	'Delete' => 'Delete',
	'CannotCreateFolder' => 'Cannot create folder',
	'CannotRename' => 'Cannot rename',
	'CannotDelete' => 'Cannot delete',
	'InputAName' => 'Input a name!'
),

'Align' => array(
	'left' => 'left',
	'center' => 'center',
	'right' => 'right'
),

'vAlign' => array(
	'top' => 'top',
	'middle' => 'center',
	'bottom' => 'bottom'
),

'Image' => array(
	'Title' => 'Create/Edit Image',
	'Align' => 'Align',
	'Width' => 'Width',
	'Height' => 'Height',
	'Border' => 'Border',
	'Vspace' => 'Vspace',
	'Hspace' => 'Hspace',
	'Alt' => 'Alt'
),

'Flash' => array(
	'Title' => 'Create/Edit Flash',
	'Align' => 'Align',
	'Width' => 'Width',
	'Height' => 'Height',
	'Play' => 'Play',
	'Loop' => 'Loop',
	'Menu' => 'Menu',
	'BGColor' => 'BGColor',
	'Quality' => 'Quality'
),

'Link' => array(
	'Title' => 'Create/Edit Link',
	'Target' => 'Target',
	'Link' => 'Link',

	'Targets' => array(
		'_self' => 'current window',
		'_blank'=> 'new window'
	)
),

'form' => array(
	'Title' => 'Create/Edit Form',
	'Legend' => 'Form properties',
	'Name' => 'Name',
	'Method' => 'Method',
	'Action' => 'Action'
),

'text' => array(
	'Title' => 'Create/Edit Text Field',
	'Legend' => 'Text Field properties',
	'Name' => 'Name',
	'Value' => 'Value',
	'Type' => 'Type',
	'MaxChars' => 'Maximum characters',
	'CharWidth' => 'Character width'
),

'textarea' => array(
	'Title' => 'Create/Edit Text Area',
	'Legend' => 'Text Area properties',
	'Name' => 'Name',
	'Rows' => 'Rows',
	'Columns' => 'Columns',
	'Value' => 'Value'
),

'button' => array(
	'Title' => 'Create/Edit Button',
	'Legend' => 'Button properties',
	'Name' => 'Name',
	'Value' => 'Value',
	'Type' => 'Type'
),

'hidden' => array(
	'Title' => 'Create/Edit Hidden Field',
	'Legend' => 'Hidden Field properties',
	'Name' => 'Name',
	'Value' => 'Value'
),

'checkbox' => array(
	'Title' => 'Create/Edit CheckBox',
	'Legend' => 'CheckBox properties',
	'Name' => 'Name',
	'Value' => 'Value',
	'Checked' => 'Checked'
),

'radio' => array(
	'Title' => 'Create/Edit Radio Button',
	'Legend' => 'Radio Button properties',
	'Name' => 'Name',
	'Value' => 'Value',
	'Checked' => 'Checked'
),

'snippet' => array(
	'Title' => 'Insert a custom html code',
	'Legend' => 'HTML snippets',
	'Preview' => 'Preview',
	'Snippet' => 'Snippet'
),

'Page' => array(
	'Title' => 'Edit Page Properties',
	'Info' => 'Info',
	'Title_prop' => 'Title',
	'Description' => 'Description',
	'Keywords' => 'Keywords',
	'Background' => 'Background',
	'Color' => 'Color',
	'Image' => 'Image',
	'Colors' => 'Colors',
	'Text' => 'Text',
	'Link' => 'Link',
	'VisitedLink' => 'Visited link',
	'ActiveLink' => 'Active link'
),

'CharacterMap' => array(
	'Title' => 'Character Map'
),

'Ok' => 'Ok',
'Cancel' => 'Cancel'

	);

?>
