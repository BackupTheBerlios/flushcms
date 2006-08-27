<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("问题列表"),'question');
	$top_tab->setItem (__("添加问题"),'question/create');
	$top_tab->setItem (__("问题分类列表"),'questioncategory');
	$top_tab->setItem (__("添加问题分类"),'questioncategory/create');
	$top_tab->setDefaultItem (__("添加问题分类"));
	$top_tab->renderHtml();

?>