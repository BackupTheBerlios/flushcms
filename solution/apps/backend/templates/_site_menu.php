<?php
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

?>
