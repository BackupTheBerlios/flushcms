<?php 
	$check_value = $solution->getActive();
	$check_value?$check_value=$check_value:$check_value='1';
	echo radiobutton_tag('active', '1', ($check_value=='1')?true:false);
?>
<?=__("��")?>
<?php echo radiobutton_tag('active', '2', ($check_value=='2')?true:false) ?>
<?=__("��")?>