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
//$menu->setMainItem(__("管理员"),"submenu1");
//$menu->setMainItem(__("解决方案"),"submenu2");
//$menu->setMainItem(__("财务"),"submenu3");
//$menu->setMainItem(__("公司事务"),"submenu4");
//
//$menu->setSubItem(__("用户管理"),"submenu1","submenu1_1",false,"MenuItem2");
//$menu->setSubItem(__("添加用户"),"submenu1_1","",false,"MenuItem2",'users/create');
//$menu->setSubItem(__("用户列表"),"submenu1_1","",false,"MenuItem2",'users');
//
//
//$menu->setSubItem(__("权限管理"),"submenu1","submenu1_2",$role_operation,"MenuItem2");
//$menu->setSubItem(__("添加权限"),"submenu1_2","",$role_operation,"MenuItem2",'role/create');
//$menu->setSubItem(__("权限列表"),"submenu1_2","",$role_operation,"MenuItem2",'role');
//
//$menu->setSubItem("","submenu1","",false,"MenuSeparator2");
//
//$menu->setSubItem(__("退出系统"),"submenu1","",false,"MenuItem2",'security/logout');
//
//$menu->setSubItem(__("问题分类"),"submenu2","submenu2_1",false,"MenuItem2");
//$menu->setSubItem(__("添加问题分类"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
//$menu->setSubItem(__("问题分类列表"),"submenu2_1","",false,"MenuItem2",'questioncategory');
//
//$menu->setSubItem(__("问题"),"submenu2","submenu2_2",false,"MenuItem2");
//$menu->setSubItem(__("添加问题"),"submenu2_2","",false,"MenuItem2",'question/create');
//$menu->setSubItem(__("问题列表"),"submenu2_2","",false,"MenuItem2",'question');
//
////$menu->setSubItem(__("解决方案"),"submenu2","submenu2_3",false,"MenuItem2");
////$menu->setSubItem(__("添加解决方案"),"submenu2_3","",false,"MenuItem2",'solution/create');
////$menu->setSubItem(__("解决方案列表"),"submenu2_3","",false,"MenuItem2",'solution');
//
//$menu->setSubItem(__("凭证分类"),"submenu3","submenu3_1",false,"MenuItem2");
//$menu->setSubItem(__("添加凭证分类"),"submenu3_1","",false,"MenuItem2",'financecategory/create');
//$menu->setSubItem(__("凭证分类列表"),"submenu3_1","",false,"MenuItem2",'financecategory');
//
//$menu->setSubItem(__("凭证"),"submenu3","submenu3_2",false,"MenuItem2");
//$menu->setSubItem(__("添加凭证"),"submenu3_2","",false,"MenuItem2",'finance/create');
//$menu->setSubItem(__("凭证列表"),"submenu3_2","",false,"MenuItem2",'finance');
//
//$menu->setSubItem(__("联系人分类"),"submenu4","submenu4_1",false,"MenuItem2");
//$menu->setSubItem(__("添加联系人分类"),"submenu4_1","",false,"MenuItem2",'contactcategory/create');
//$menu->setSubItem(__("联系人分类列表"),"submenu4_1","",false,"MenuItem2",'contactcategory');
//
//$menu->setSubItem(__("联系人"),"submenu4","submenu4_2",false,"MenuItem2");
//$menu->setSubItem(__("添加联系人"),"submenu4_2","",false,"MenuItem2",'contact/create');
//$menu->setSubItem(__("联系人列表"),"submenu4_2","",false,"MenuItem2",'contact');
//
//$menu->setSubItem(__("产品分类"),"submenu4","submenu4_3",false,"MenuItem2");
//$menu->setSubItem(__("添加产品分类"),"submenu4_3","",false,"MenuItem2",'productcategory/create');
//$menu->setSubItem(__("产品分类列表"),"submenu4_3","",false,"MenuItem2",'productcategory');
//
//$menu->setSubItem(__("产品"),"submenu4","submenu4_4",false,"MenuItem2");
//$menu->setSubItem(__("添加产品"),"submenu4_4","",false,"MenuItem2",'product/create');
//$menu->setSubItem(__("产品列表"),"submenu4_4","",false,"MenuItem2",'product');
//
//$menu->setSubItem(__("企业名录"),"submenu4","submenu4_5",false,"MenuItem2");
//$menu->setSubItem(__("添加企业"),"submenu4_5","",false,"MenuItem2",'company/create');
//$menu->setSubItem(__("企业名录列表"),"submenu4_5","",false,"MenuItem2",'company');



//echo $menu->renderMenu();

?>
<?php
//$msn_menu = new sfMsnMenu();
//$msn_menu->setMenuItem (__("管理员"),"","0");
//
//$msn_menu->setMenuItem (__("添加用户"),'users/create',"0_0");
//$msn_menu->setMenuItem (__("用户列表"),'users',"0_1");
//
//$msn_menu->setMenuItem (__("添加权限"),'role/create',"0_2");
//$msn_menu->setMenuItem (__("权限列表"),'role',"0_3");
//
//$msn_menu->setMenuItem (__("退出系统"),'security/logout',"0_4");
//
//$msn_menu->setMenuItem (__("解决方案"),"","1");
//
//$msn_menu->setMenuItem (__("添加问题分类"),'questioncategory/create',"1_0");
//$msn_menu->setMenuItem (__("问题分类列表"),'questioncategory',"1_1");
//
//$msn_menu->setMenuItem (__("添加问题"),'question/create',"1_2");
//$msn_menu->setMenuItem (__("问题列表"),'question',"1_3");
//
//
//$msn_menu->setMenuItem (__("财务"),"","2");
//
//$msn_menu->renderMenu();

$click_menu = new sfShowHideMenu();

$click_menu->setMenuSection(__("解决方案"),__("添加问题分类"),'questioncategory/create');
$click_menu->setMenuSection(__("解决方案"),__("问题分类列表"),'questioncategory');
$click_menu->setMenuSection(__("解决方案"),__("添加问题"),'question/create');
$click_menu->setMenuSection(__("解决方案"),__("问题列表"),'question');

$click_menu->setMenuSection(__("财务"),__("添加凭证分类"),'financecategory/create');
$click_menu->setMenuSection(__("财务"),__("问题分类列表"),'financecategory');
$click_menu->setMenuSection(__("财务"),__("添加凭证"),'finance/create');
$click_menu->setMenuSection(__("财务"),__("凭证列表"),'finance');

$click_menu->setMenuSection(__("公司事务"),__("添加联系人分类"),'contactcategory/create');
$click_menu->setMenuSection(__("公司事务"),__("联系人分类列表"),'contactcategory');
$click_menu->setMenuSection(__("公司事务"),__("添加联系人"),'contact/create');
$click_menu->setMenuSection(__("公司事务"),__("联系人列表"),'contact');
$click_menu->setMenuSection(__("公司事务"),__("添加产品分类"),'productcategory/create');
$click_menu->setMenuSection(__("公司事务"),__("产品分类列表"),'productcategory');
$click_menu->setMenuSection(__("公司事务"),__("添加产品"),'product/create');
$click_menu->setMenuSection(__("公司事务"),__("产品列表"),'product');
$click_menu->setMenuSection(__("公司事务"),__("添加企业"),'company/create');
$click_menu->setMenuSection(__("公司事务"),__("企业名录列表"),'company');

$click_menu->setMenuSection(__("系统管理"),__("添加用户"),'users/create');
$click_menu->setMenuSection(__("系统管理"),__("用户列表"),'users');
$click_menu->setMenuSection(__("系统管理"),__("添加权限"),'role/create');
$click_menu->setMenuSection(__("系统管理"),__("权限"),'role');
$click_menu->setMenuSection(__("系统管理"),__("退出系统"),'security/logout');

$click_menu->renderMenu();

//$tree_menu = new sfTreeMenu();
//$menu_array=array(
//    1 => array(
//        'title' => '管理员', 
//        'url' => '',
//        'sub' => array(
//                    11 => array('title' => '添加用户', 'url' => 'users/create'),
//                    12 => array('title' => '用户列表', 'url' => 'users')
//        )
//    ),
//    2 => array(
//        'title' => '退出系统', 
//        'url' => 'security/logout'
//    )
//);
//
//$tree_menu->setMenuArray($menu_array);
//$tree_menu->renderMenu();


?>
