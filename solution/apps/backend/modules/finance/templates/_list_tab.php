<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("ƾ֤�б�"),'finance');
	$top_tab->setItem (__("���ƾ֤"),'finance/create');
	$top_tab->setItem (__("ƾ֤�����б�"),'financecategory');
	$top_tab->setItem (__("���ƾ֤����"),'financecategory/create');
	$top_tab->setDefaultItem (__("ƾ֤�б�"));
	$top_tab->renderHtml();

?>