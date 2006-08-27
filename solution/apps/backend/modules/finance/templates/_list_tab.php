<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("凭证列表"),'finance');
	$top_tab->setItem (__("添加凭证"),'finance/create');
	$top_tab->setItem (__("凭证分类列表"),'financecategory');
	$top_tab->setItem (__("添加凭证分类"),'financecategory/create');
	$top_tab->setDefaultItem (__("凭证列表"));
	$top_tab->renderHtml();

?>