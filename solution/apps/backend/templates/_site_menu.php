<?php
$menu = new sfDojoApplicationMenu();
$menu->setMainItem(__("����Ա"),"submenu1");
$menu->setMainItem(__("�������"),"submenu2");

$menu->setSubItem(__("�û�����"),"submenu1","submenu1_1",false,"MenuItem2");
$menu->setSubItem(__("����û�"),"submenu1_1","",false,"MenuItem2",'users/create');
$menu->setSubItem(__("�û��б�"),"submenu1_1","",false,"MenuItem2",'users');

$menu->setSubItem("","submenu1","",false,"MenuSeparator2");

$menu->setSubItem(__("Ȩ�޹���"),"submenu1","submenu1_2",false,"MenuItem2");
$menu->setSubItem(__("���Ȩ��"),"submenu1_2","",false,"MenuItem2",'role/create');
$menu->setSubItem(__("Ȩ���б�"),"submenu1_2","",false,"MenuItem2",'role');

$menu->setSubItem(__("�������"),"submenu2","submenu2_1",false,"MenuItem2");
$menu->setSubItem(__("����������"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
$menu->setSubItem(__("��������б�"),"submenu2_1","",false,"MenuItem2",'questioncategory');

$menu->setSubItem(__("����"),"submenu2","submenu2_2",false,"MenuItem2");
$menu->setSubItem(__("�������"),"submenu2_2","",false,"MenuItem2",'question/create');
$menu->setSubItem(__("�����б�"),"submenu2_2","",false,"MenuItem2",'question');


echo $menu->renderMenu();
?>
