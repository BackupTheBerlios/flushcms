<?php
$categoryId = $product->getCompanyId();
if ($categoryId) 
{
	$c = new Criteria();
	$c->add(CompanyPeer::ID, $categoryId);
	$data = CompanyPeer::doSelect($c);
	echo $data[0]->getName();
}
else 
{
	echo "-";
}
?>
