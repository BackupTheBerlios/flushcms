<?php

//language class
require_once('lang/class.rich_lang.php');

	//extract variables submitted to this page
	@extract($_GET);

	$rich_lang = new rich_lang($lang); //text data in current language
	$text = $rich_lang->item('Flash');
	$align = $rich_lang->item('Align');

?><html>
<head>
<title><?php echo $text['Title']; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $rich_lang->item("Charset"); ?>">

<link rel="StyleSheet" type="text/css" href="rich.css">

<script language="JScript.Encode" src="rich.js"></script>

<script  language="JavaScript">

  var rich_path = ''; //path to directory with editor files, here - current directory

  var is_local_file = false; //=true, if upload local file
//  var is_init = false; //=true, if image load window initialization is performed

  var loaded = false; //=true if window is created

  var flash_src = null; //flash source

function return_flash_parameters(){
  if(flash_src == null) return; //nothing chosen

  //upload a local file
  if(window.is_local_file){
    window.is_local_file = false;
    document.local_files.local_files_form.submit();

    return;
  }

  parameters = get_parameters();

  //add one more parameter - path to flash
  parameters[parameters.length] = "src="+flash_src;

  window.returnValue = parameters;

  window.close();
}

//makes flash preview when dialog window opens
function on_flash_load(){
  if(loaded) return;

  init_dialog();
  if(window.dialogArguments['src']){

    if(window.dialogArguments['width'] && window.dialogArguments['height']){
      document.all['width'].value = window.dialogArguments['width'];
      document.all['height'].value = window.dialogArguments['height'];
  
      set_preview_flash(window.dialogArguments['src'],
                        window.dialogArguments['width'],
                        window.dialogArguments['height']);
      flash_src = window.dialogArguments['src'];

    }
  }

}

//parses remote file select
function parse_select_remote_file(url, width, height){
  window.is_local_file = false;

  document.all['width'].value = width;
  document.all['height'].value = height;

  set_preview_flash(url, width, height);

  flash_src = url;
}

function select_local_file(){
var preview_size = 100;
var url = window.local_files.window.local_files_form.local_file.value;
var flash_form;

  if(!url) return;

  window.is_local_file = true;

  document.all['width'].value = preview_size;
  document.all['height'].value = preview_size;
  
  set_preview_flash(url, preview_size, preview_size);

  flash_src = url;
}

<?php
	if(isset($lang)) echo "var dialog_lang = '$lang';\n";
?>

</script>

</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="buttonface" onload="on_flash_load(); loaded = true;">

<form name="form_name">

<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%" class="dialog">

<tr>

<!-- window for remote files select  -->
<td width="100%" height="100%">

<iframe src="remote_files.php?initial_files_path=<?php echo $files_path; ?>&files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&lang=<?php echo $lang; ?>&file_type=flash" name="remote_files" id="remote_files_id" border="0" scrolling="yes" style="width:100%; height:100%"></iframe>

</td>
<!-- !window for remote files select -->

<!-- window of preview and attributes of flash -->
<td vAlign="top">

<table border="0" cellspacing="0" cellpadding="0" height="100%">

<tr><td height="100%" colspan="2" align="center" vAlign="center">
<table border="1" cellspacing="0" cellpadding="0" width="100%" height="100%"><tr><td align="center" vAlign="center">
<div id="flash_div" width="150" height="150">&nbsp;</div>
</td></tr></table>
</td></tr>

<!-- flash attributes -->
<tr>
<td><?php echo $text['Align']; ?>:</td>
<td>
<select name="align" style="width:70">
  <option value=""></option>
<?php
	foreach ($align as $k=>$val) {
		echo '<option value="'.$k.'">'.$val.'</option>';
	}
?>
</select>
</td>
</tr>

<tr>
<td><?php echo $text['Width']; ?>:</td>
<td><input name="width" type="text" value="" size="4" maxlength="5" style="width:50"></td>
</tr>

<tr>
<td><?php echo $text['Height']; ?>:</td>
<td><input name="height" type="text" value="" size="4" maxlength="5" style="width:50"></td>
</tr>

<tr>
<td><?php echo $text['Play']; ?>:</td>
<td><input name="Play" type="checkbox"></td>
</tr>

<tr>
<td><?php echo $text['Loop']; ?>:</td>
<td><input name="Loop" type="checkbox"></td>
</tr>

<tr>
<td><?php echo $text['Menu']; ?>:</td>
<td><input name="Menu" type="checkbox"></td>
</tr>


<tr>
<td><?php echo $text['BGColor']; ?>:</td>
<td>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table id="BGColor_table" bgColor="#ffffff" height="15" width="15" onClick="set_color();"><tr><td></td></tr></table></td>
<td><input type="checkbox" name="BGColor" onClick="if(checked) set_color();"></td>
</tr>
</table>

</td>
</tr>

<tr>
<td><?php echo $text['Quality']; ?>:</td>
<td>
<select name="Quality" style="width:70">
  <option value=""></option>
  <option value="High">High</option>
  <option value="Best">Best</option>
  <option value="Low">Low</option>
  <option value="AutoLow">AutoLow</option>
  <option value="AutoHigh">AutoHigh</option>
  <option value="Medium">Medium</option>
</select>
</td>
</tr>

</td>
</tr>

<!-- flash attributes -->

</table>

</td>
<!-- !window of preview and attributes of flash -->

</tr>

<!-- window for local files select -->
<tr><td colspan="2" width="100%" height="27">

<iframe src="local_files.php?files_path=<?php echo $files_path; ?>&files_url=<?php echo $files_url; ?>&file_type=flash" name="local_files" id="local_files_id" border="0" scrolling="no" style="width:100%; height:100%;"></iframe>

</td></tr>
<!-- !window for local files select -->

<tr><td colspan="2" height="1">
<center>
<input type="Button" value="<?php echo $rich_lang->item('Ok'); ?>" onclick="return_flash_parameters();">
<input type="Button" value="<?php echo $rich_lang->item('Cancel'); ?>" onclick="window.close();">
</center>
</td></tr>

</table>

</form>

</body>
</html>
