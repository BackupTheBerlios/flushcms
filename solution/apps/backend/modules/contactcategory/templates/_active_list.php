<?php
$check_value = $contact_category->getActive();
if ($check_value=='1') 
{
	echo __("ÊÇ");
}
else
{
	echo __("·ñ");
	
}
?>
