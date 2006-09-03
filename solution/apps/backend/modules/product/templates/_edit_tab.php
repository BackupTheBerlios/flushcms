<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("企业名录列表"),'company');
	$top_tab->setItem (__("添加企业"),'company/create');
	$top_tab->setItem (__("产品列表"),'product');
	$top_tab->setItem (__("添加产品"),'product/create');
	$top_tab->setItem (__("产品分类列表"),'productcategory');
	$top_tab->setItem (__("添加产品分类"),'productcategory/create');
	$top_tab->setDefaultItem (__("添加产品"));
	$top_tab->renderHtml();

?>
