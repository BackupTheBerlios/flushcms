<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("��ϵ���б�"),'contact');
	$top_tab->setItem (__("�����ϵ��"),'contact/create');
	$top_tab->setItem (__("��ϵ�˷����б�"),'contactcategory');
	$top_tab->setItem (__("�����ϵ�˷���"),'contactcategory/create');
	$top_tab->setDefaultItem (__("��ϵ�˷����б�"));
	$top_tab->renderHtml();

?>