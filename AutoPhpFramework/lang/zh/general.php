<?php
/**
 *
 * general.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟远螓
 * @author     QQ:3440895
 * @version    CVS: $Id: general.php,v 1.24 2006/12/09 14:31:35 arzen Exp $
 */
$this->setCharset('gb2312'); 
$messages = array(
	'site_title' => 'YCRM客户关系管理系统',
	'Copyright' => '&copy; 2006 版权所有 AutoPHPFramework 团队。',
	'Home' => '首页',
	'Users' => '公司员工',
	'News' => '公司活动',
	'NewsCategory' => '公司活动类别',
	'Product' => '产品',
	'ProductCategory' => '产品类别',
	'Logout' => '退出',
	'Sale' => '销售',
	'Costs' => '费用',
	'Customer' => '客户',
	'Workbench' => '工作台',

	'PrevPage' => '上页',
	'NextPage' => '下页',
	'Page' => '页',
	'JumpTo' => '跳到',
	'Listing' => '列表',
	'Parent Listing' => '上级列表',
	'Search' => '搜索',
	'Create' => '新增',
	'MoveUp' => '上移',
	'MoveDown' => '下移',
	'Action' => '操作',
	'Active' => '状态',
	'Edit' => '修改',
	'Delete' => '删除',
	'Close' => '关闭',
	'List' => '返回列表',
	'Save' => '保存',
	'All' => '所有',
	'New' => '新增',
	'Live' => '已公布',
	'Deleted' => '已撤销',
	'Access' => '访问',
	'Public' => '公共',
	'Private' => '私有',
	'Rename' => '重命名',

	'Male' => '男',
	'Female' => '女',
	'Category' => '类别',
	'CategoryId' => '类别',
	'CategoryName' => '类别名',
	'ParentCategory' => '父类别',
	'DeleteSelected' => '删除所选',
//news	
	'Content' => '内容',

//contact
	'ExportAll' => '导出所有',
	'Export' => '导出',
	'Import' => '导入',
	'File' => '文件',
	
//users
	'Name' => '名称',
	'Gender' => '性别',
	'Birthday' => '生日',
	'Phone' => '电话',
	'User' => '用户',
	'UserName' => '用户名',
	'UserPwd' => '用户密码',
	'Password' => '密码',
	'Addrees' => '地址',
	'Photo' => '图片',
	'Phone' => '电话',
	'Email' => '电子邮箱',

	'Remember' => '记住',
	'Login' => '登录',

	'EditInfo' => '编辑信息',
	'GeneralInfo' => '基本信息',
//group
	'GroupId' => 'ID',
	'GroupDefineName' => '组名',
	'IsActive' => '是/否激活',
	'Rights' => '权限',
	'RightId' => 'ID',
	'RightDefineName' => '权限名',

	'Group' => '组',
	'Groups' => '组',
	'GroupUsers' => '组用户',
	'Rights' => '权限',
	'GroupRights' => '组权限',
	'NotInGroup' => '不在组内',
	'InGroup' => '在组内',
	'Price' => '价格',
	'Title' => '标题',

	'Result' => '条记录',

	'ALLOWDELETE' => '允许删除',
	'ALLOWUPDATE' => '允许修改',
	'Memo' => '备注',

// finance
	'Finance' => '财务',
	'FinanceCategory' => '财务分类',
	'Amount' => '张数',
	'Debit' => '借/贷',
	'Money' => '金额(元)',
	'CreateDate' => '日期',
	'Income' => '收入',
	'Payout' => '支出',
	'DayMoneyRecord' => '现金日记帐',
//contact
	'Contact' => '联系人',
	'CompanyId' => '公司',
	'Id' => 'ID',
	'Mobile' => '手机',
	'OfficePhone' => '公司电话',
	'Fax' => '传真',
	'Homepage' => '主页',
	'ContactCategory' => '联系人分类',
//company
	'Company' => '公司',
	'LinkMan' => '联系人',
	'Employee' => '雇员',
	'Bankroll' => '固定资金',
	'Incorporator' => '法人代表',
	'Industry' => '所属行业',
	'Products' => '产品',
	'DetailInfo' => '详细信息',
	'Relationship' => '关系',
	'Manage' => '管理',
	'Company Contact Relation' => '公司联系人关系管理',
	'Company Products Relation' => '公司产品关系管理',
//opportunity
	'Opportunity' => '机会',
	'State' => '状态',
	'Pending' => '未决定',
	'Start' => '开始',
//Schedule
	'Schedule' => '计划事件',
	'CreateSchedule' => '新增计划事件',
	'Title' => '标题',
	'PublishDate' => '预定日期',
	'StartTime' => '起始时间',
	'EndTime' => '结束时间',
	'Description' => '描述',
	'Status' => '状态',
	'WarmTips' => '温馨提示',
	'WarmTipsString' => '点击日历上的图标,将导出当周的事件.',
	'Today' => '今日',
	'Time' => '时间',
	'Entry' => '条目',
	'Image' => '图片',
	'YourScheduleFor' => '你的计划事件于',
	'Sun' => '日',
	'Mon' => '一',
	'Tue' => '二',
	'Wed' => '三',
	'Thu' => '四',
	'Fri' => '五',
	'Sat' => '六',
	'wk' => '周',
//send mail
	'MailSender' => '邮件发送',
	'WriteMail' => '写邮件',
	'To' => '到',
	'Send' => '发送',
//document
	'Document' => '文档',
	'CreateFolder' => '创建目录',
	'Folder' => '文件夹',
	'CreateFile' => '上传文件',
	'Position' => '目录位置',
	'Root' => '根目录',
	'Filename' => '文件',
	'MajorRevision' => '主版本号',
	'MinorRevision' => '副版本号',
//order
	'Order' => '订单',
	
	'StateHandling' => '处理中',
	'StateDelivery' => '已发货',
	'StateCancel' => '已取消',
	'StateFinish' => '已完成',
	'StatePrepay' => '已预付',
	'StateWaitpay' => '等款到',

	'PaywayCash' => '现金',
	'PaywayWeek' => '周结',
	'PaywayMonth' => '月结',
	'PaywayQuarter' => '季度结',
	'PaywayYear' => '年结',

	'DeliverywayVisiting' => '上门提货',
	'DeliverywayNetwork' => '通过网络',
	'DeliverywayLand' => '陆运',
	'DeliverywayOcean' => '海运',
	'DeliverywayAir' => '空运',
	
	'Noid' => '编号',
	'Contactid' => '联系人',
	'Discount' => '折扣(%)',
	'Payway' => '付款方式',
	'Deliveryway' => '交货方式',
	'Deliverydatetime' => '交货日期',
	'OrderCategory' => '订单分类',
	'Userid' => '拥有者',
	'CreatedAt' => '创建日期',
//agreement
	'Agreement' => '合同',
	'Effectdate' => '生效日期',
	'Expireddate' => '失效日期',
	'Buyer' => '甲方',
	'Vender' => '乙方',
	'Buyersignature' => '甲方签约人',
	'Vendersignature' => '乙方签约人',

//afterService
	'AfterService' => '售后',
//Complaints
	'Complaints' => '投诉',
	'Complainanter' => '投诉人',
	'Reply' => '回复',
	'Handleman' => '处理人',
	'Handledate' => '处理日期',
//Refundment
	'Refundment' => '退货',
	'Refundmenter' => '退货人',
	'Reasons' => '退货原因',
//Review
	'Review' => '回访',
	'Linkman' => '接待人',
	'Reviewdate' => '回访日期',
	
//Permit
	'NotPermit' => '权限不足',
	'NotPermitMessage' => '对不起，你的权限不足，无法进行此操作。',

	'Please check here' => '请检查此处',
	'Your modifications have been saved' => '您的更改已保存',
);
$this->set($messages);

?>
