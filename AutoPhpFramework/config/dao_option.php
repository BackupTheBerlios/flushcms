<?php
/**
 *
 * dao_option.php.
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ÃÏÔ¶òû
 * @author     QQ:3440895
 * @version    CVS: $Id: dao_option.php,v 1.3 2006/12/10 00:29:56 arzen Exp $
 */
$opts = & PEAR :: getStaticProperty('DB_DataObject', 'options');
$opts = array (
	'database' => $dsn,
	'class_location' => $RootDir . '/dao/',
	'class_prefix' => 'Dao',
	'extends_location' => '',
	'template_location' => $TemplateDir,
	'actions_location' => $RootDir,
	'modules_location' => $RootDir . '/module/users/',
	
	$users_table.'_modules_location' => $RootDir . '/module/users/',
	$users_table.'_modules_name_location' => 'users',
	$users_table . '_fields_list' => 'id,user_name,user_pwd,gender,phone,role_id,active',
	$users_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$users_table.'_generator_add_validate_stubs' => 'user_name:empty',

	$groups_table.'_modules_location' => $RootDir . '/module/users/',
	$groups_table.'_modules_name_location' => 'users',
	$groups_table . '_fields_list' => 'group_id,group_type,group_define_name,is_active,owner_user_id,owner_group_id',
	$groups_table . '_except_fields' => '',
	$groups_table.'_generator_add_validate_stubs' => 'group_define_name:empty',

	$rights_table.'_modules_location' => $RootDir . '/module/users/',
	$rights_table.'_modules_name_location' => 'users',
	$rights_table . '_fields_list' => 'right_id,right_define_name',
	$rights_table . '_except_fields' => 'area_id,has_implied',
	$rights_table.'_generator_add_validate_stubs' => 'right_define_name:empty',
	
	$news_category_table.'_modules_location' => $RootDir . '/module/news/',
	$news_category_table.'_modules_name_location' => 'news',
	$news_category_table . '_fields_list' => 'id,category_name,active',
	$news_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$news_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$news_table.'_modules_location' => $RootDir . '/module/news/',
	$news_table.'_modules_name_location' => 'news',
	$news_table . '_fields_list' => 'id,title,category_id,active',
	$news_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$news_table.'_generator_add_validate_stubs' => 'title:empty',

	$finance_category_table.'_modules_location' => $RootDir . '/module/finance/',
	$finance_category_table.'_modules_name_location' => 'finance',
	$finance_category_table . '_fields_list' => 'id,category_name,active',
	$finance_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$finance_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$finance_table.'_modules_location' => $RootDir . '/module/finance/',
	$finance_table.'_modules_name_location' => 'finance',
	$finance_table . '_fields_list' => 'id,category,amount,debit,money,active',
	$finance_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$finance_table.'_generator_add_validate_stubs' => 'money:empty',

	$order_category_table.'_modules_location' => $RootDir . '/module/order/',
	$order_category_table.'_modules_name_location' => 'order',
	$order_category_table . '_fields_list' => 'id,category_name,active',
	$order_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$order_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$order_table.'_modules_location' => $RootDir . '/module/order/',
	$order_table.'_modules_name_location' => 'order',
	$order_table . '_fields_list' => 'id,noid,category,contactid,amount,discount,money,deliverydatetime,state,created_at,userid',
	$order_table . '_except_fields' => 'id,add_ip,groupid,userid,created_at,update_at',
	$order_table.'_generator_add_validate_stubs' => 'money:empty',

	$agreement_category_table.'_modules_location' => $RootDir . '/module/agreement/',
	$agreement_category_table.'_modules_name_location' => 'agreement',
	$agreement_category_table . '_fields_list' => 'id,category_name,active',
	$agreement_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$agreement_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$agreement_table.'_modules_location' => $RootDir . '/module/agreement/',
	$agreement_table.'_modules_name_location' => 'agreement',
	$agreement_table . '_fields_list' => 'id,noid,category,effectdate,expireddate,buyer,vender,buyersignature,vendersignature,created_at,userid',
	$agreement_table . '_except_fields' => 'id,add_ip,groupid,userid,created_at,update_at',
	$agreement_table.'_generator_add_validate_stubs' => 'money:empty',

	$complaints_category_table.'_modules_location' => $RootDir . '/module/complaints/',
	$complaints_category_table.'_modules_name_location' => 'complaints',
	$complaints_category_table . '_fields_list' => 'id,category_name,active',
	$complaints_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$complaints_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$complaints_table.'_modules_location' => $RootDir . '/module/complaints/',
	$complaints_table.'_modules_name_location' => 'complaints',
	$complaints_table . '_fields_list' => 'id,category,complainanter,title,reply,handleman,handledate,state,created_at,userid',
	$complaints_table . '_except_fields' => 'id,add_ip,groupid,userid,created_at,update_at',
	$complaints_table.'_generator_add_validate_stubs' => 'title:empty',

	$refundment_category_table.'_modules_location' => $RootDir . '/module/refundment/',
	$refundment_category_table.'_modules_name_location' => 'refundment',
	$refundment_category_table . '_fields_list' => 'id,category_name,active',
	$refundment_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$refundment_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$refundment_table.'_modules_location' => $RootDir . '/module/refundment/',
	$refundment_table.'_modules_name_location' => 'refundment',
	$refundment_table . '_fields_list' => 'id,category,company,refundmenter,reasons,reply,handleman,handledate,state,created_at,userid',
	$refundment_table . '_except_fields' => 'id,add_ip,groupid,userid,created_at,update_at',
	$refundment_table.'_generator_add_validate_stubs' => 'title:empty',

	$review_table.'_modules_location' => $RootDir . '/module/review/',
	$review_table.'_modules_name_location' => 'review',
	$review_table . '_fields_list' => 'id,category,company,linkman,reviewdate,created_at,userid',
	$review_table . '_except_fields' => 'id,add_ip,groupid,userid,created_at,update_at',
	$review_table.'_generator_add_validate_stubs' => 'content:empty',

	$contact_category_table.'_modules_location' => $RootDir . '/module/contact/',
	$contact_category_table.'_modules_name_location' => 'contact',
	$contact_category_table . '_fields_list' => 'id,category_name,active',
	$contact_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$contact_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$contact_table.'_modules_location' => $RootDir . '/module/contact/',
	$contact_table.'_modules_name_location' => 'contact',
	$contact_table . '_fields_list' => 'id,category,company_id,name,gender,mobile,phone,active',
	$contact_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$contact_table.'_generator_add_validate_stubs' => 'name:empty',


	$company_table.'_modules_location' => $RootDir . '/module/company/',
	$company_table.'_modules_name_location' => 'company',
	$company_table . '_fields_list' => 'id,name,phone,fax,link_man,addrees,active',
	$company_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$company_table.'_generator_add_validate_stubs' => 'name:empty',

	$product_category_table.'_modules_location' => $RootDir . '/module/product/',
	$product_category_table.'_modules_name_location' => 'product',
	$product_category_table . '_fields_list' => 'id,category_name,active',
	$product_category_table . '_except_fields' => 'id,add_ip,created_at,update_at,orderid',
	$product_category_table.'_generator_add_validate_stubs' => 'category_name:empty',

	$product_table.'_modules_location' => $RootDir . '/module/product/',
	$product_table.'_modules_name_location' => 'product',
	$product_table . '_fields_list' => 'id,category,company_id,name,price,photo,active',
	$product_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$product_table.'_generator_add_validate_stubs' => 'name:empty',

	$company_product_table.'_modules_location' => $RootDir . '/module/company_product/',
	$company_product_table.'_modules_name_location' => 'company_product',
	$company_product_table . '_fields_list' => 'id,category,company_id,name,price,photo,active',
	$company_product_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$company_product_table.'_generator_add_validate_stubs' => 'name:empty',

	$company_contact_table.'_modules_location' => $RootDir . '/module/company_contact/',
	$company_contact_table.'_modules_name_location' => 'company_contact',
	$company_contact_table . '_fields_list' => 'id,category,company_id,name,price,photo,active',
	$company_contact_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$company_contact_table.'_generator_add_validate_stubs' => 'name:empty',

	$product_price_table.'_modules_location' => $RootDir . '/module/product/',
	$product_price_table.'_modules_name_location' => 'product',
	$product_price_table . '_fields_list' => 'id,company_id,product_id,price,created_at',
	$product_price_table . '_except_fields' => 'id,add_ip,company_id,product_id,created_at,update_at',
	$product_price_table.'_generator_add_validate_stubs' => 'price:empty',

	$opportunity_table.'_modules_location' => $RootDir . '/module/opportunity/',
	$opportunity_table.'_modules_name_location' => 'opportunity',
	$opportunity_table . '_fields_list' => 'id,title,phone,link_man,state,addrees',
	$opportunity_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$opportunity_table.'_generator_add_validate_stubs' => 'title:empty,link_man:empty',

	$schedule_table.'_modules_location' => $RootDir . '/module/schedule/',
	$schedule_table.'_modules_name_location' => 'schedule',
	$schedule_table . '_fields_list' => 'id,title,phone,link_man,state,addrees',
	$schedule_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$schedule_table.'_generator_add_validate_stubs' => 'title:empty',

	$folders_table.'_modules_location' => $RootDir . '/module/document/',
	$folders_table.'_modules_name_location' => 'document',
	$folders_table . '_fields_list' => 'id,name,description,password,state',
	$folders_table . '_except_fields' => 'id,add_ip,created_at,update_at',
	$folders_table.'_generator_add_validate_stubs' => 'name:empty',

	$files_table.'_modules_location' => $RootDir . '/module/document/',
	$files_table.'_modules_name_location' => 'document',
	$files_table . '_fields_list' => 'id,name,description,password,state',
	$files_table . '_except_fields' => 'id,parent,checked_out,f_size,add_ip,groupid,userid,created_at,update_at',
	$files_table.'_generator_add_validate_stubs' => 'name:empty',

	'require_prefix' => 'dataobjects/',
	'class_prefix' => 'Dao',
	'extends' => 'DB_DataObject',
	'generate_setters' => '1',
	'generate_getters' => '1',

	'generator_include_regex' => '/^' . $review_table . 'none$/',
	'generator_no_ini' => '1',
	
);
?>
