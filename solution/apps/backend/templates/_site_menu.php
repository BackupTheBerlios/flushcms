<?php
$click_menu = new sfShowHideMenu();

$click_menu->setMenuSection(__("�������"),__("����������"),'questioncategory/create');
$click_menu->setMenuSection(__("�������"),__("��������б�"),'questioncategory');
$click_menu->setMenuSection(__("�������"),__("�������"),'question/create');
$click_menu->setMenuSection(__("�������"),__("�����б�"),'question');

$click_menu->setMenuSection(__("����"),__("���ƾ֤����"),'financecategory/create');
$click_menu->setMenuSection(__("����"),__("��������б�"),'financecategory');
$click_menu->setMenuSection(__("����"),__("���ƾ֤"),'finance/create');
$click_menu->setMenuSection(__("����"),__("ƾ֤�б�"),'finance');

$click_menu->setMenuSection(__("��˾����"),__("�����ϵ�˷���"),'contactcategory/create');
$click_menu->setMenuSection(__("��˾����"),__("��ϵ�˷����б�"),'contactcategory');
$click_menu->setMenuSection(__("��˾����"),__("�����ϵ��"),'contact/create');
$click_menu->setMenuSection(__("��˾����"),__("��ϵ���б�"),'contact');
$click_menu->setMenuSection(__("��˾����"),__("��Ӳ�Ʒ����"),'productcategory/create');
$click_menu->setMenuSection(__("��˾����"),__("��Ʒ�����б�"),'productcategory');
$click_menu->setMenuSection(__("��˾����"),__("��Ӳ�Ʒ"),'product/create');
$click_menu->setMenuSection(__("��˾����"),__("��Ʒ�б�"),'product');
$click_menu->setMenuSection(__("��˾����"),__("�����ҵ"),'company/create');
$click_menu->setMenuSection(__("��˾����"),__("��ҵ��¼�б�"),'company');

$click_menu->setMenuSection(__("ϵͳ����"),__("����û�"),'users/create');
$click_menu->setMenuSection(__("ϵͳ����"),__("�û��б�"),'users');
$click_menu->setMenuSection(__("ϵͳ����"),__("���Ȩ��"),'role/create');
$click_menu->setMenuSection(__("ϵͳ����"),__("Ȩ��"),'role');
$click_menu->setMenuSection(__("ϵͳ����"),__("�˳�ϵͳ"),'security/logout');

$click_menu->renderMenu();

?>
