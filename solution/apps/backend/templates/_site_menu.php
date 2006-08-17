<?php
if ($sf_user->hasCredential("admin")) 
{
	$role_operation = false;
} 
else 
{
	$role_operation = true;
	
}
$menu = new sfDojoApplicationMenu();
$menu->setMainItem(__("����Ա"),"submenu1");
$menu->setMainItem(__("�������"),"submenu2");
$menu->setMainItem(__("����"),"submenu3");
$menu->setMainItem(__("��˾����"),"submenu4");

$menu->setSubItem(__("�û�����"),"submenu1","submenu1_1",false,"MenuItem2");
$menu->setSubItem(__("����û�"),"submenu1_1","",false,"MenuItem2",'users/create');
$menu->setSubItem(__("�û��б�"),"submenu1_1","",false,"MenuItem2",'users');


$menu->setSubItem(__("Ȩ�޹���"),"submenu1","submenu1_2",$role_operation,"MenuItem2");
$menu->setSubItem(__("���Ȩ��"),"submenu1_2","",$role_operation,"MenuItem2",'role/create');
$menu->setSubItem(__("Ȩ���б�"),"submenu1_2","",$role_operation,"MenuItem2",'role');

$menu->setSubItem("","submenu1","",false,"MenuSeparator2");

$menu->setSubItem(__("�˳�ϵͳ"),"submenu1","",false,"MenuItem2",'security/logout');

$menu->setSubItem(__("�������"),"submenu2","submenu2_1",false,"MenuItem2");
$menu->setSubItem(__("����������"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
$menu->setSubItem(__("��������б�"),"submenu2_1","",false,"MenuItem2",'questioncategory');

$menu->setSubItem(__("����"),"submenu2","submenu2_2",false,"MenuItem2");
$menu->setSubItem(__("�������"),"submenu2_2","",false,"MenuItem2",'question/create');
$menu->setSubItem(__("�����б�"),"submenu2_2","",false,"MenuItem2",'question');

//$menu->setSubItem(__("�������"),"submenu2","submenu2_3",false,"MenuItem2");
//$menu->setSubItem(__("��ӽ������"),"submenu2_3","",false,"MenuItem2",'solution/create');
//$menu->setSubItem(__("��������б�"),"submenu2_3","",false,"MenuItem2",'solution');

$menu->setSubItem(__("ƾ֤����"),"submenu3","submenu3_1",false,"MenuItem2");
$menu->setSubItem(__("���ƾ֤����"),"submenu3_1","",false,"MenuItem2",'financecategory/create');
$menu->setSubItem(__("ƾ֤�����б�"),"submenu3_1","",false,"MenuItem2",'financecategory');

$menu->setSubItem(__("ƾ֤"),"submenu3","submenu3_2",false,"MenuItem2");
$menu->setSubItem(__("���ƾ֤"),"submenu3_2","",false,"MenuItem2",'finance/create');
$menu->setSubItem(__("ƾ֤�б�"),"submenu3_2","",false,"MenuItem2",'finance');

$menu->setSubItem(__("��ϵ�˷���"),"submenu4","submenu4_1",false,"MenuItem2");
$menu->setSubItem(__("�����ϵ�˷���"),"submenu4_1","",false,"MenuItem2",'contactcategory/create');
$menu->setSubItem(__("��ϵ�˷����б�"),"submenu4_1","",false,"MenuItem2",'contactcategory');

$menu->setSubItem(__("��ϵ��"),"submenu4","submenu4_2",false,"MenuItem2");
$menu->setSubItem(__("�����ϵ��"),"submenu4_2","",false,"MenuItem2",'contact/create');
$menu->setSubItem(__("��ϵ���б�"),"submenu4_2","",false,"MenuItem2",'contact');

$menu->setSubItem(__("��Ʒ����"),"submenu4","submenu4_3",false,"MenuItem2");
$menu->setSubItem(__("��Ӳ�Ʒ����"),"submenu4_3","",false,"MenuItem2",'productcategory/create');
$menu->setSubItem(__("��Ʒ�����б�"),"submenu4_3","",false,"MenuItem2",'productcategory');

$menu->setSubItem(__("��Ʒ"),"submenu4","submenu4_4",false,"MenuItem2");
$menu->setSubItem(__("��Ӳ�Ʒ"),"submenu4_4","",false,"MenuItem2",'product/create');
$menu->setSubItem(__("��Ʒ�б�"),"submenu4_4","",false,"MenuItem2",'product');

$menu->setSubItem(__("��ҵ��¼"),"submenu4","submenu4_5",false,"MenuItem2");
$menu->setSubItem(__("�����ҵ"),"submenu4_5","",false,"MenuItem2",'company/create');
$menu->setSubItem(__("��ҵ��¼�б�"),"submenu4_5","",false,"MenuItem2",'company');



echo $menu->renderMenu();
?>
