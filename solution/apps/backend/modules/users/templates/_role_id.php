<?php

$c = new Criteria();
$c->add(RolePeer::ACTIVE, array('active'=>1));
$roles = RolePeer::doSelect($c);
$roles_array = array();
for ($index = 0; $index < sizeof($roles); $index++) 
{
	$id = $roles[$index]->getId();
	$label = $roles[$index]->getRoleLable();
	$roles_array[$id]=$label;
}
$selected_id =  $users->getRoleId();
$selected_id?$selected_id=$selected_id:$selected_id='2';
echo select_tag('role_id', 
	options_for_select($roles_array, $selected_id)
	); 
?>
