<?php
$categoryId = $finance->getCategory();
$c = new Criteria();
$c->add(FinanceCategoryPeer::ID, $categoryId);
//$c->add(FinanceCategoryPeer::ACTIVE, array('active'=>1));
$data = FinanceCategoryPeer::doSelect($c);
echo $data[0]->getCategoryName();
?>
