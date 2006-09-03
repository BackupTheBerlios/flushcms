<?php
$categoryId = $contact->getCategory();
$c = new Criteria();
$c->add(ContactCategoryPeer::ID, $categoryId);
$data = ContactCategoryPeer::doSelect($c);
echo $data[0]->getCategoryName();
?>
