<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("�����б�"),'question');
	$top_tab->setItem (__("�������"),'question/create');
	$top_tab->setItem (__("��������б�"),'questioncategory');
	$top_tab->setItem (__("����������"),'questioncategory/create');
	$top_tab->setDefaultItem (__("����������"));
	$top_tab->renderHtml();

?>