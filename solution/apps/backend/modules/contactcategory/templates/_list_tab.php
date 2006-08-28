<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("联系人列表"),'contact');
	$top_tab->setItem (__("添加联系人"),'contact/create');
	$top_tab->setItem (__("联系人分类列表"),'contactcategory');
	$top_tab->setItem (__("添加联系人分类"),'contactcategory/create');
	$top_tab->setDefaultItem (__("联系人分类列表"));
	$top_tab->renderHtml();

?>