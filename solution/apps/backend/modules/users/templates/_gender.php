<?php 
	$user_gender = $users->getGender();
	$user_gender?$user_gender=$user_gender:$user_gender='M';
	echo radiobutton_tag('gender', 'M', ($user_gender=='M')?true:false);
?>
<?=__("ÄÐ")?>
<?php echo radiobutton_tag('gender', 'F', ($user_gender=='F')?true:false) ?>
<?=__("Å®")?>