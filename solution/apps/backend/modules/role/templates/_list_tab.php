<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("�û��б�"),'users');
	$top_tab->setItem (__("����û�"),'users/create');
	$top_tab->setItem (__("Ȩ��"),'role');
	$top_tab->setItem (__("���Ȩ��"),'role/create');
	$top_tab->setDefaultItem (__("Ȩ��"));
	$top_tab->renderHtml();

?>