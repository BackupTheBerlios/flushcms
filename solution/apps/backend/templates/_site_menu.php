<?php
$menu = new sfDojoApplicationMenu();
$menu->setMainItem(__("管理员"),"submenu1");
$menu->setMainItem(__("解决方案"),"submenu2");

$menu->setSubItem(__("用户管理"),"submenu1","submenu1_1",false,"MenuItem2");
$menu->setSubItem(__("添加用户"),"submenu1_1","",false,"MenuItem2",'users/create');
$menu->setSubItem(__("用户列表"),"submenu1_1","",false,"MenuItem2",'users');

$menu->setSubItem("","submenu1","",false,"MenuSeparator2");

$menu->setSubItem(__("权限管理"),"submenu1","submenu1_2",false,"MenuItem2");
$menu->setSubItem(__("添加权限"),"submenu1_2","",false,"MenuItem2",'role/create');
$menu->setSubItem(__("权限列表"),"submenu1_2","",false,"MenuItem2",'role');

$menu->setSubItem(__("问题分类"),"submenu2","submenu2_1",false,"MenuItem2");
$menu->setSubItem(__("添加问题分类"),"submenu2_1","",false,"MenuItem2",'questioncategory/create');
$menu->setSubItem(__("问题分类列表"),"submenu2_1","",false,"MenuItem2",'questioncategory');

$menu->setSubItem(__("问题"),"submenu2","submenu2_2",false,"MenuItem2");
$menu->setSubItem(__("添加问题"),"submenu2_2","",false,"MenuItem2",'question/create');
$menu->setSubItem(__("问题列表"),"submenu2_2","",false,"MenuItem2",'question');


echo $menu->renderMenu();
?>
