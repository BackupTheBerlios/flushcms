<?php
$check_value = $finance_category->getActive();
if ($check_value=='1') 
{
	echo __("ÊÇ");
}
else
{
	echo __("·ñ");
	
}
?>
