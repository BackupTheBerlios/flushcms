<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("用户列表"),'users');
	$top_tab->setItem (__("添加用户"),'users/create');
	$top_tab->setItem (__("权限"),'role');
	$top_tab->setItem (__("添加权限"),'role/create');
	$top_tab->setDefaultItem (__("权限"));
	$top_tab->renderHtml();

?>