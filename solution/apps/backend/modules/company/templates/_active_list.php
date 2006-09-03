<?php
$check_value = $company->getActive();
if ($check_value=='1') 
{
	echo __("ÊÇ");
}
else
{
	echo __("·ñ");
	
}
?>
