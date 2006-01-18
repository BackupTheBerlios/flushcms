<?php

//language class
require_once('lang/class.rich_lang.php');

	//extract variables submitted to this page
	@extract($_GET);
	@extract($_POST);

	$rich_lang = new rich_lang($lang); //text data in current language
	$text = $rich_lang->item('RemoteFiles');

	if(isset($action)){
		if(isset($file)) $file = stripslashes($file);
		if(isset($del_path)) $del_path = stripslashes($del_path);
		if(isset($name)) $name = stripslashes($name);

/**/

		//deletes files and directories
		if($action == 'delete' && $file){
			if(is_file($del_path.$file)){ //file
				$delete_result = @unlink($del_path.$file);
			}else{ //directory
				$delete_result = @rmdir($del_path.$file);
			}
		}
    
		if($action == 'save_create_dir'){
			$dir_path = $del_path.$name;
    
			$oldmask = umask(0);
			$dir_exists = @mkdir($dir_path, 0777);
			umask($oldmask);
		}
    
		if($action == 'save_rename'){
			$rename_result = @rename($del_path.$file, $del_path.$name);
			$del_path = $del_path.$file;
		}
	}

//fix path with national symbols inside
function correct_path($path){
	$parts = split("/",$path);
	foreach ($parts as $k=>$val) {
		if (isset($result)) {
			$result .= '/';
		} else {
			if (substr($val, strlen($val)-1, 1) == ':') { //leave protocol prefix unchanged
				$result .= $val;
				continue;
			}
		}
		$result .= rawurlencode(stripslashes($val));
	}
	return $result;
}
?>
<html>
<head>
<title>Remote Files</title>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $rich_lang->item("Charset"); ?>">

<link rel="StyleSheet" type="text/css" href="rich.css">

<script language="JScript.Encode" src="rich.js"></script>

<script language="JavaScript">

  //load images in cash
  $temp_img = new Image();
  $temp_img.src = 'images/minus.gif';
  $temp_img.src = 'images/plus.gif';

  rich_path = ''; //path to directory with editor files, here - current directory

//calls parser of remote files select
function select_remote_file(url, width, height){
  window.top.window.parse_select_remote_file(url, width, height);
}

//switch visibility of id-th directory content
function switch_div(id, path, url){
  eval("obj = document.all.dir_div"+id+";"); //div of directory
  eval("obj_img = document.all.dir_img"+id+";"); //image of directory

  if(obj.style.display){
    obj.style.display='';
    obj_img.src = 'images/minus.gif';
  }else{
    if(id>1){
      obj.style.display='none';
      obj_img.src = 'images/plus.gif';
    }
  }
}

//set current directory for file uploading
function set_cur_dir(id, path, url){
  eval("obj_a = document.all.dir_a"+id+";"); //link of directory

  if(window.top.local_files.window &&
     window.top.local_files.window.local_files_form){

    window.top.local_files.window.local_files_form.files_path.value = path;
    window.top.local_files.window.local_files_form.files_url.value = url;

  }

  //save path to parent dir in a form hidden
  window.remote_files_form.del_path.value = path;

  //highlight name of last clicked directory
  for(i=1;i<=id_number;i++){
    eval("document.all.dir_a"+i+".style.color = '';");
  }
  obj_a.style.color = 'red';

}

//check if value is not empty
function not_empty(value){
  return !value.match(/^\s*$/g);
}

//check if dir name not empty
function validate_dir_name(form){
  if(form.action.value != 'cancel' && !not_empty(form.name.value)){
    form.name.focus();
    alert('<?php echo $text['InputAName']; ?>');
    return false;
  }
  return true;
}

</script>

</head>

<body bgcolor="buttonface" topmargin="0" leftmargin="0" rightmargin="0">

<form name="remote_files_form" onsubmit="return validate_dir_name(this);">
<input type="hidden" name="files_path" value="<?php echo $files_path; ?>">
<input type="hidden" name="files_url" value="<?php echo $files_url; ?>">
<input type="hidden" name="file_type" value="<?php echo $file_type; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">

<!-- list of remote files -->
<table border="0" cellspacing="0" cellpadding="2" width="100%" height="100%" class="dialog"><tr vAlign="top"><td>

<?php if(isset($action) && ($action == 'rename' || $action == 'create_dir')) : ?>

<input type="hidden" name="action" value="save_<?php echo $action; ?>">
<input type="hidden" name="del_path" value="<?php echo $del_path; ?>">
<input type="hidden" name="file" value="<?php echo $file; ?>">

<table border="0" cellspacing="0" cellpadding="0" width="100%" align="top">
<tr><td colspan="3">
<?php
  $dir = str_replace($files_path, $text['root'].'/', $del_path);
  if($action == 'rename') echo $text['NewNameFor'].' \''.$file.'\'';
    else echo $text['CreateFolderIn'].' '.$dir;
?>
:</td></tr>
<tr>
<td width="100%"><input name="name" type="text" value="<?php echo $file; ?>" style="width=100%;height=22"></td>
<tr>
</tr>
<td align="center"><input type="submit" value="<?php echo $rich_lang->item('Ok'); ?>" style="height=22">
<input type="button" value="<?php echo $rich_lang->item('Cancel'); ?>" style="height=22" onclick="form.action.value='cancel'; form.submit();"></td>
</tr>
</table>

<?php else : ?>

<input type="hidden" name="action" value="create_dir">
<input type="hidden" name="del_path" value="<?php echo $files_path; ?>">

<table border="0" cellspacing="0" cellpadding="0" width="100%" style="font:14;">

<!--<tr><td colspan="2"><b>File name:</b></td></tr>-->

<?php
  //draw tree of directories and files from $files_path directory
  //$level - level of the current directory, id - unique number for divs
  function draw_dir_tree($files_path, $files_url, $file_type='', &$id, $level=1){
    global $initial_files_path;
    global $initial_files_url;
    global $del_path;
	global $text;
	global $lang;

//    global $last_id;
//    global $last_path;
//    global $last_url;

    //prepare list of files and directories
    $entries = array();
    $files  = array();
    $indx = 1;

    $handle=opendir($files_path);
    if($handle){
  
      while($file = readdir($handle)){
  
        if($file != '.' && $file != '..'){
          if(is_file($files_path.$file)){ //files
            $files[] = $file;
          }else{ //directory
            $entries[$indx][name] = $file;
            $entries[$indx][is_dir] = true;
            $indx++;
          }
  
        }
  
      }
      closedir($handle);
  
    }
  
    //add list of files to list of directories
    while(list($k,$val)=each($files)){
      $entries[$indx++][name] = $val;
    }

    if( $level>1 && !($del_path && ereg("^$files_path(.*)",$del_path)) ){
      $closed = true;
    }else $closed = false;

    if($level == 1){
      echo '<tr>';
      echo '<td>';

      echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';

      echo '<b><a class="remote" id="dir_a'.$id.'" href="javascript: set_cur_dir('.$id.',\''.$initial_files_path.'\',\''.$initial_files_url.'\');" style="color:red">'.$text['root'].'</a></b>';
// style="color:red"
      echo '</td>';
      echo '<td align="right"><a class="remote" href="#" onclick="window.remote_files_form.submit(); return false;">'.$text['CreateFolder'].'</a></td>';

      echo '</tr>';
      echo '</table>';

      echo '</td>';
      echo '</tr>';
    }

    echo '<tr height=0><td height=0><div id="dir_div'.$id.'"';
    //if just created/renamed or deleted file/dir, make all parent dirs visible
    if($closed){
      echo 'style="display:none;"';
    }
    echo '>';

    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">';

    //adjust row heights
    echo '<tr><td>';
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';
    echo '</td></tr></table>';
    echo '</td></tr>';

    //draw content of the current directory
    if($entries){
  
      while(list($k,$val)=each($entries)){
        $file = $val[name];
    
        if(!$val[is_dir]){ //files

          switch($file_type){
    
            case "image":
            case "flash":
              $size = @getimagesize($files_path.$file);
              if($size[2]!=4 && $size[2]!=13 && $file_type=='image' && $size[2] ||
                 ($size[2]==4 || $size[2]==13) && $file_type=='flash'){ //image&flash
                echo "<tr onmouseover=\"bgColor='#6699CC';\" onmouseout=\"bgColor='';\"><td width=\"100%\">\n";

                echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';

                echo indent($level);
                echo '<a class="remote" href="#" onClick="select_remote_file(\''.correct_path($files_url.$file).'\','.$size[0].','.$size[1].'); return false;">'.$file.'</a>&nbsp;';
                echo "</td>";
                echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'">r</a>&nbsp;</td>';
                echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'" onclick="javascript: if (window.confirm(\''.$text['Delete'].' \\\''.str_replace('\'', '\\\'', $file).'\\\'?\')) return true; else return false;">x</a></td>';
//                echo '<td width="1"><a class="remote" href="javascript: window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.$file.'&lang='.$lang.'\';">r</a>&nbsp;</td>';
//                echo '<td width="1"><a class="remote" href="javascript: if (window.confirm(\'Delete \\\''.$file.'\\\'?\')) window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.$file.'&lang='.$lang.'\';">x</a></td>';

                echo '</tr></table></td>';

                echo "</tr>\n";

                //adjust row heights
                echo '<tr><td>';
                echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';
                echo '</td></tr></table>';
                echo '</td></tr>';
              }
              break;
    
            default:
              echo "<tr onmouseover=\"bgColor='#6699CC';\" onmouseout=\"bgColor='';\"><td width=\"100%\">\n";

              echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';

              echo indent($level);
              echo '<a class="remote" href="#" onClick="select_remote_file(\''.correct_path($files_url.$file).'\'); return false;">'.$file.'</a>&nbsp;';
              echo "</td>";
              echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'">r</a>&nbsp;</td>';
              echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'" onclick="javascript: if (window.confirm(\''.$text['Delete'].' \\\''.str_replace('\'', '\\\'', $file).'\\\'?\')) return true; else return false;">x</a></td>';
//              echo '<td width="1"><a class="remote" href="javascript: window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'\';">r</a>&nbsp;</td>';
//              echo '<td width="1"><a class="remote" href="javascript: if (window.confirm(\'Delete \\\''.$file.'\\\'?\')) window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.$file.'&lang='.$lang.'\';">x</a></td>';

              echo '</tr></table></td>';

              echo "</tr>\n";

              //adjust row heights
              echo '<tr><td>';
              echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';
              echo '</td></tr></table>';
              echo '</td></tr>';

              break;
    
          }//switch
    
        }else{ //directories

          if( !($del_path && ereg("^$files_path$file/(.*)",$del_path)) ){
            $closed = true;
          }else $closed = false;

          $id++; //get unique div id

          echo "<tr onmouseover=\"bgColor='#6699CC';\" onmouseout=\"bgColor='';\"><td width=\"100%\">\n";

          echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>';

          echo indent($level);

          echo '<img width="11" height="11" id="dir_img'.$id.'" style="cursor:hand" onclick="switch_div('.$id.');" src="images/';
          if(!$closed) echo 'minus.gif';
            else echo 'plus.gif';
          echo '">&nbsp;';

          echo '<b><a class="remote" id="dir_a'.$id.'" href="javascript: set_cur_dir('.$id.',\''.str_replace('\'', '\\\'', $files_path.$file).'/\',\''.str_replace('\'', '\\\'', $files_url.$file).'/\');">'.$file.'</a></b>&nbsp;</td>';
          echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'">r</a>&nbsp;</td>';
          echo '<td width="1"><a class="remote" href="?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'" onclick="javascript: if (window.confirm(\''.$text['Delete'].' \\\''.str_replace('\'', '\\\'', $file).'\\\'?\')) return true; else return false;">x</a></td>';
//          echo '<td width="1"><a class="remote" href="javascript: window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=rename&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'\';">r</a>&nbsp;</td>';
//          echo '<td width="1"><a class="remote" href="javascript: if (window.confirm(\'Delete \\\''.$file.'\\\'?\')) window.location = \'?files_path='.$initial_files_path.'&files_url='.$initial_files_url.'&file_type='.$file_type.'&action=delete&del_path='.$files_path.'&file='.rawurlencode($file).'&lang='.$lang.'\';">x</a></td>';

          echo '</tr></table></td>';

          echo "</tr>\n";

          draw_dir_tree($files_path.$file.'/', $files_url.$file.'/', $file_type,
                        $id, $level+1);
        }
    
      }

    }

    echo '</table></div></td></tr>';

   }

  //to see different directory levels
  function indent($level){
    $symb = '&nbsp;&nbsp;';
    for($i=0;$i<$level;$i++){
      $result .= $symb;
    }

    return $result;
  }

  $initial_files_path = $files_path;
  $initial_files_url = $files_url;

  $id = 1;
  draw_dir_tree($files_path, $files_url, $file_type, $id);

?>

</table>

<?php endif; ?>

</td></tr>

</table>
<!-- !list of remote files -->

</form>

<script language="JavaScript">
  id_number = <?php echo (int)$id; ?>; //number of divs

<?php
//  if($last_id){
//    echo 'set_cur_dir('.$last_id.',\''.$last_path.'\',\''.$last_url.'\');';
//  }
?>

<?php if(isset($action)) : ?>
//actions denied
<?php if($action == 'save_create_dir' && !$dir_exists) :?>
  alert('<?php echo $text['CannotCreateFolder']; ?> \'<?php echo str_replace('\'', '\\\'', $name); ?>\'!');
<?php endif; ?>

<?php if($action == 'save_rename' && !$rename_result) :?>
  alert('<?php echo $text['CannotRename']; ?> \'<?php echo str_replace('\'', '\\\'', $file); ?>\'!');
<?php endif; ?>

<?php if($action == 'delete' && !$delete_result) :?>
  alert('<?php echo $text['CannotDelete']; ?> \'<?php echo str_replace('\'', '\\\'', $file); ?>\'!');
<?php endif; ?>
<?php endif; ?>

</script>

</body>
</html>