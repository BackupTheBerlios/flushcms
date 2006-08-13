<?php
$categoryId = $question->getCategory();
$c = new Criteria();
$c->add(QuestionCategoryPeer::ID, $categoryId);
//$c->add(QuestionCategoryPeer::ACTIVE, array('active'=>1));
$data = QuestionCategoryPeer::doSelect($c);
echo $data[0]->getCategoryName();
?>
