<?php

$c = new Criteria();
$c->add(QuestionCategoryPeer::ACTIVE, array('active'=>1));
$data = QuestionCategoryPeer::doSelect($c);
$data_array = array();
for ($index = 0; $index < sizeof($data); $index++) 
{
	$id = $data[$index]->getId();
	$label = $data[$index]->getCategoryName();
	$data_array[$id]=$label;
}
$selected_id =  $question->getCategory();
$selected_id?$selected_id=$selected_id:$selected_id='2';
echo select_tag('category', 
	options_for_select($data_array, $selected_id)
	); 
?>