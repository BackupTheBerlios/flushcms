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
<?php
$dropdown_menu = new sfDropDownMenu();
$menu_array=array(
    1 => array(
        'title' => '����Ա', 
        'url' => '',
        'sub' => array(
                    11 => array('title' => '�����û�', 'url' => 'users/create'),
                    12 => array('title' => '�û��б�', 'url' => 'users')
        )
    ),
    2 => array(
        'title' => '�˳�ϵͳ', 
        'url' => 'security/logout'
    )
);

$dropdown_menu->setMenuArray($menu_array);

?>
<TABLE width="100%" >
<TR valign="top" >
	<TD width="120px" >
	  <?php
	   if($sf_user->isAuthenticated())
	   include_partial('global/site_menu'); 
	   $dropdown_menu->renderMenu();
	   ?>
	
	</TD>
	<TD>
	<?php echo $sf_data->getRaw('sf_content') ?>
	</TD>
</TR>
</TABLE>
<?php
$dropdown_menu->renderFootJs () ;

?>


</body>
</html>