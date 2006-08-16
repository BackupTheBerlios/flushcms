<?php
$check_value = $finance->getDebit();
if ($check_value=='1') 
{
	echo __("½è");
}
else
{
	echo __("´û");
	
}
?>
