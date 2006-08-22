<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>
<?php use_helper('I18N') ?>
<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
<TABLE width="100%" >
  <tr>
    <td colspan="2">
    
<?php
$toolbar = new sfToolbar();
$toolbar->renderHtml();
?>
    
    </td>
  </tr>

<TR valign="top" >
	<TD width="120px" >
	  <?php
	   if($sf_user->isAuthenticated())
	   include_partial('global/site_menu'); 
	   ?>
	
	</TD>
	<TD>
	<?php echo $sf_data->getRaw('sf_content') ?>
	</TD>
</TR>
</TABLE>


</body>
</html>
