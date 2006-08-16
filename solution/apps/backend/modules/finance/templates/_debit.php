<?php 
	$check_value = $finance->getDebit();
	$check_value?$check_value=$check_value:$check_value='1';
	echo radiobutton_tag('debit', '1', ($check_value=='1')?true:false);
?>
<?=__("½è")?>
<?php echo radiobutton_tag('debit', '2', ($check_value=='2')?true:false) ?>
<?=__("´û")?>