<?php
$categoryId = $product->getCategory();
$c = new Criteria();
$c->add(ProductCategoryPeer::ID, $categoryId);
$data = ProductCategoryPeer::doSelect($c);
echo $data[0]->getCategoryName();
?>
