<?php

	$top_tab = new sfTab();
	$top_tab->setItem (__("��ҵ��¼�б�"),'company');
	$top_tab->setItem (__("�����ҵ"),'company/create');
	$top_tab->setItem (__("��Ʒ�б�"),'product');
	$top_tab->setItem (__("��Ӳ�Ʒ"),'product/create');
	$top_tab->setItem (__("��Ʒ�����б�"),'productcategory');
	$top_tab->setItem (__("��Ӳ�Ʒ����"),'productcategory/create');
	$top_tab->setDefaultItem (__("��Ӳ�Ʒ"));
	$top_tab->renderHtml();

?>
