<?php
//if ($sf_user->hasCredential("admin")) 
//{
//	$role_operation = false;
//} 
//else 
//{
//	$role_operation = true;
//	
//}
//$menu = new sfDojoApplicationMenu();
//$menu->setMainItem(__("����Ա"),"submenu1");
//$menu->setMainItem(__("�������"),"submenu2");
//$menu->setMainItem(__("����"),"submenu3");
//$menu->setMainItem(__("��˾����"),"submenu4");
//
//$menu->setSubItem(__("�û�����"),"submenu1","submenu1_1",false,"MenuItem2");
//$menu->setSubItem(__("����û�"),"submenu1_1","",false,"MenuItem2",'users/create');
//$menu->setSubItem(__("�û��б�"),"submenu1_1","",false,"MenuItem2",'users');
//
//
//$menu->setSubItem(__("Ȩ�޹���"),"submenu1","submenu1_2",$role_operation,"MenuItem2");
//$menu->setSubItem(__("���Ȩ��"),"submenu1_2","",$role_operation,"MenuItem2",'role/create');
//$menu->setSubItem(__("Ȩ���б�"),"submenu1_2","",$role_operation,"MenuItem2",'role');
//
//$menu->setSubItem("","submenu1","",false,"MenuSeparator2");
//
//$menu->setSubItem(__("�˳�ϵͳ"),"submenu1","",false,"MenuItem2",'security/logout');
//
//$menu->setSubItem(__("�������"),"submenu2","submenu2_1",false,"MenuItem2");
//$menu->setSubItem(__("����������"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
//$menu->setSubItem(__("��������б�"),"submenu2_1","",false,"MenuItem2",'questioncategory');
//
//$menu->setSubItem(__("����"),"submenu2","submenu2_2",false,"MenuItem2");
//$menu->setSubItem(__("�������"),"submenu2_2","",false,"MenuItem2",'question/create');
//$menu->setSubItem(__("�����б�"),"submenu2_2","",false,"MenuItem2",'question');
//
////$menu->setSubItem(__("�������"),"submenu2","submenu2_3",false,"MenuItem2");
////$menu->setSubItem(__("��ӽ������"),"submenu2_3","",false,"MenuItem2",'solution/create');
////$menu->setSubItem(__("��������б�"),"submenu2_3","",false,"MenuItem2",'solution');
//
//$menu->setSubItem(__("ƾ֤����"),"submenu3","submenu3_1",false,"MenuItem2");
//$menu->setSubItem(__("���ƾ֤����"),"submenu3_1","",false,"MenuItem2",'financecategory/create');
//$menu->setSubItem(__("ƾ֤�����б�"),"submenu3_1","",false,"MenuItem2",'financecategory');
//
//$menu->setSubItem(__("ƾ֤"),"submenu3","submenu3_2",false,"MenuItem2");
//$menu->setSubItem(__("���ƾ֤"),"submenu3_2","",false,"MenuItem2",'finance/create');
//$menu->setSubItem(__("ƾ֤�б�"),"submenu3_2","",false,"MenuItem2",'finance');
//
//$menu->setSubItem(__("��ϵ�˷���"),"submenu4","submenu4_1",false,"MenuItem2");
//$menu->setSubItem(__("�����ϵ�˷���"),"submenu4_1","",false,"MenuItem2",'contactcategory/create');
//$menu->setSubItem(__("��ϵ�˷����б�"),"submenu4_1","",false,"MenuItem2",'contactcategory');
//
//$menu->setSubItem(__("��ϵ��"),"submenu4","submenu4_2",false,"MenuItem2");
//$menu->setSubItem(__("�����ϵ��"),"submenu4_2","",false,"MenuItem2",'contact/create');
//$menu->setSubItem(__("��ϵ���б�"),"submenu4_2","",false,"MenuItem2",'contact');
//
//$menu->setSubItem(__("��Ʒ����"),"submenu4","submenu4_3",false,"MenuItem2");
//$menu->setSubItem(__("��Ӳ�Ʒ����"),"submenu4_3","",false,"MenuItem2",'productcategory/create');
//$menu->setSubItem(__("��Ʒ�����б�"),"submenu4_3","",false,"MenuItem2",'productcategory');
//
//$menu->setSubItem(__("��Ʒ"),"submenu4","submenu4_4",false,"MenuItem2");
//$menu->setSubItem(__("��Ӳ�Ʒ"),"submenu4_4","",false,"MenuItem2",'product/create');
//$menu->setSubItem(__("��Ʒ�б�"),"submenu4_4","",false,"MenuItem2",'product');
//
//$menu->setSubItem(__("��ҵ��¼"),"submenu4","submenu4_5",false,"MenuItem2");
//$menu->setSubItem(__("�����ҵ"),"submenu4_5","",false,"MenuItem2",'company/create');
//$menu->setSubItem(__("��ҵ��¼�б�"),"submenu4_5","",false,"MenuItem2",'company');



//echo $menu->renderMenu();

?>
<?php
//$msn_menu = new sfMsnMenu();
//$msn_menu->setMenuItem (__("����Ա"),"","0");
//
//$msn_menu->setMenuItem (__("����û�"),'users/create',"0_0");
//$msn_menu->setMenuItem (__("�û��б�"),'users',"0_1");
//
//$msn_menu->setMenuItem (__("���Ȩ��"),'role/create',"0_2");
//$msn_menu->setMenuItem (__("Ȩ���б�"),'role',"0_3");
//
//$msn_menu->setMenuItem (__("�˳�ϵͳ"),'security/logout',"0_4");
//
//$msn_menu->setMenuItem (__("�������"),"","1");
//
//$msn_menu->setMenuItem (__("����������"),'questioncategory/create',"1_0");
//$msn_menu->setMenuItem (__("��������б�"),'questioncategory',"1_1");
//
//$msn_menu->setMenuItem (__("�������"),'question/create',"1_2");
//$msn_menu->setMenuItem (__("�����б�"),'question',"1_3");
//
//
//$msn_menu->setMenuItem (__("����"),"","2");
//
//$msn_menu->renderMenu();

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

//$tree_menu = new sfTreeMenu();
//$menu_array=array(
//    1 => array(
//        'title' => '����Ա', 
//        'url' => '',
//        'sub' => array(
//                    11 => array('title' => '����û�', 'url' => 'users/create'),
//                    12 => array('title' => '�û��б�', 'url' => 'users')
//        )
//    ),
//    2 => array(
//        'title' => '�˳�ϵͳ', 
//        'url' => 'security/logout'
//    )
//);
//
//$tree_menu->setMenuArray($menu_array);
//$tree_menu->renderMenu();


?>
