<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>
<?php use_helper('I18N') ?>
<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
<?php
if($sf_user->isAuthenticated())
{
	$toolbar = new sfToolbar();
	$toolbar->setButton ('sharing.png','question',__("�������"));
	$toolbar->setButton ('calc.png','finance',__("����"));
	$toolbar->setButton ('authorise.png','users',__("�û��б�"));
	$toolbar->setButton ('--');
	$toolbar->setButton ('exit_small.png','security/logout',__("�˳�ϵͳ"));
	$toolbar->renderHtml();
}
?>
<TABLE width="100%" >
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

	  <?php
	   if($sf_user->isAuthenticated())
	   include_partial('global/foot'); 
	   ?>


</body>
</html>
