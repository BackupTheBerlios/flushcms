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
$menu->setMainItem(__("管理员"),"submenu1");
$menu->setMainItem(__("解决方案"),"submenu2");
$menu->setMainItem(__("财务"),"submenu3");

$menu->setSubItem(__("用户管理"),"submenu1","submenu1_1",false,"MenuItem2");
$menu->setSubItem(__("添加用户"),"submenu1_1","",false,"MenuItem2",'users/create');
$menu->setSubItem(__("用户列表"),"submenu1_1","",false,"MenuItem2",'users');


$menu->setSubItem(__("权限管理"),"submenu1","submenu1_2",$role_operation,"MenuItem2");
$menu->setSubItem(__("添加权限"),"submenu1_2","",$role_operation,"MenuItem2",'role/create');
$menu->setSubItem(__("权限列表"),"submenu1_2","",$role_operation,"MenuItem2",'role');

$menu->setSubItem("","submenu1","",false,"MenuSeparator2");

$menu->setSubItem(__("退出系统"),"submenu1","",false,"MenuItem2",'security/logout');

$menu->setSubItem(__("问题分类"),"submenu2","submenu2_1",false,"MenuItem2");
$menu->setSubItem(__("添加问题分类"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
$menu->setSubItem(__("问题分类列表"),"submenu2_1","",false,"MenuItem2",'questioncategory');

$menu->setSubItem(__("问题"),"submenu2","submenu2_2",false,"MenuItem2");
$menu->setSubItem(__("添加问题"),"submenu2_2","",false,"MenuItem2",'question/create');
$menu->setSubItem(__("问题列表"),"submenu2_2","",false,"MenuItem2",'question');

//$menu->setSubItem(__("解决方案"),"submenu2","submenu2_3",false,"MenuItem2");
//$menu->setSubItem(__("添加解决方案"),"submenu2_3","",false,"MenuItem2",'solution/create');
//$menu->setSubItem(__("解决方案列表"),"submenu2_3","",false,"MenuItem2",'solution');

$menu->setSubItem(__("凭证分类"),"submenu3","submenu3_1",false,"MenuItem2");
$menu->setSubItem(__("添加凭证分类"),"submenu3_1","",false,"MenuItem2",'financecategory/create');
$menu->setSubItem(__("凭证分类列表"),"submenu3_1","",false,"MenuItem2",'financecategory');

$menu->setSubItem(__("凭证"),"submenu3","submenu3_2",false,"MenuItem2");
$menu->setSubItem(__("添加凭证"),"submenu3_2","",false,"MenuItem2",'finance/create');
$menu->setSubItem(__("凭证列表"),"submenu3_2","",false,"MenuItem2",'finance');


echo $menu->renderMenu();
?>
