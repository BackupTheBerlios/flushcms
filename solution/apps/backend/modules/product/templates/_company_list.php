<?php
$categoryId = $product->getCompanyId();
$c = new Criteria();
$c->add(CompanyPeer::ID, $categoryId);
$data = CompanyPeer::doSelect($c);
echo $data[0]->getName();
?>
