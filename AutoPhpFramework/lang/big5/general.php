<?php
/**
 *
 * general.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     孟遠螓
 * @author     QQ:3440895
 * @version    CVS: $Id: general.php,v 1.6 2006/12/09 14:31:35 arzen Exp $
 */
$this->setCharset('big5'); 
$messages = array(
	'site_title' => 'YCRM客戶關系管理系統',
	'Copyright' => '&copy; 2006 版權所有 AutoPHPFramework 團隊。',
	'Home' => '首頁',
	'Users' => '公司員工',
	'News' => '公司活動',
	'NewsCategory' => '公司活動類別',
	'Product' => '產品',
	'ProductCategory' => '產品類別',
	'Logout' => '退出',
	'Sale' => '銷售',
	'Costs' => '費用',
	'Customer' => '客戶',
	'Workbench' => '工作台',

	'PrevPage' => '上頁',
	'NextPage' => '下頁',
	'Page' => '頁',
	'JumpTo' => '跳到',
	'Listing' => '列表',
	'Parent Listing' => '上級列表',
	'Search' => '搜索',
	'Create' => '新增',
	'MoveUp' => '上移',
	'MoveDown' => '下移',
	'Action' => '操作',
	'Active' => '狀態',
	'Edit' => '修改',
	'Delete' => '刪除',
	'Close' => '關閉',
	'List' => '返回列表',
	'Save' => '保存',
	'All' => '所有',
	'New' => '新增',
	'Live' => '已公布',
	'Deleted' => '已撤銷',
	'Access' => '訪問',
	'Public' => '公共',
	'Private' => '私有',
	'Rename' => '重命名',

	'Male' => '男',
	'Female' => '女',
	'Category' => '類別',
	'CategoryId' => '類別',
	'CategoryName' => '類別名',
	'ParentCategory' => '父類別',
	'DeleteSelected' => '刪除所選',
//news	
	'Content' => '內容',

//contact
	'ExportAll' => '導出所有',
	'Export' => '導出',
	'Import' => '導入',
	'File' => '文件',
	
//users
	'Name' => '名稱',
	'Gender' => '性別',
	'Birthday' => '生日',
	'Phone' => '電話',
	'User' => '用戶',
	'UserName' => '用戶名',
	'UserPwd' => '用戶密碼',
	'Password' => '密碼',
	'Addrees' => '地址',
	'Photo' => '圖片',
	'Phone' => '電話',
	'Email' => '電子郵箱',

	'Remember' => '記住',
	'Login' => '登錄',

	'EditInfo' => '編輯信息',
	'GeneralInfo' => '基本信息',
//group
	'GroupId' => 'ID',
	'GroupDefineName' => '組名',
	'IsActive' => '是/否激活',
	'Rights' => '權限',
	'RightId' => 'ID',
	'RightDefineName' => '權限名',

	'Group' => '組',
	'Groups' => '組',
	'GroupUsers' => '組用戶',
	'Rights' => '權限',
	'GroupRights' => '組權限',
	'NotInGroup' => '不在組內',
	'InGroup' => '在組內',
	'Price' => '價格',
	'Title' => '標題',

	'Result' => '條記錄',

	'ALLOWDELETE' => '允許刪除',
	'ALLOWUPDATE' => '允許修改',
	'Memo' => '備注',

// finance
	'Finance' => '財務',
	'FinanceCategory' => '財務分類',
	'Amount' => '張數',
	'Debit' => '借/貸',
	'Money' => '金額(元)',
	'CreateDate' => '日期',
	'Income' => '收入',
	'Payout' => '支出',
	'DayMoneyRecord' => '現金日記帳',
//contact
	'Contact' => '聯系人',
	'CompanyId' => '公司',
	'Id' => 'ID',
	'Mobile' => '手機',
	'OfficePhone' => '公司電話',
	'Fax' => '傳真',
	'Homepage' => '主頁',
	'ContactCategory' => '聯系人分類',
//company
	'Company' => '公司',
	'LinkMan' => '聯系人',
	'Employee' => '雇員',
	'Bankroll' => '固定資金',
	'Incorporator' => '法人代表',
	'Industry' => '所屬行業',
	'Products' => '產品',
	'DetailInfo' => '詳細信息',
	'Relationship' => '關系',
	'Manage' => '管理',
	'Company Contact Relation' => '公司聯系人關系管理',
	'Company Products Relation' => '公司產品關系管理',
//opportunity
	'Opportunity' => '機會',
	'State' => '狀態',
	'Pending' => '未決定',
	'Start' => '開始',
//Schedule
	'Schedule' => '計劃事件',
	'CreateSchedule' => '新增計劃事件',
	'Title' => '標題',
	'PublishDate' => '預定日期',
	'StartTime' => '起始時間',
	'EndTime' => '結束時間',
	'Description' => '描述',
	'Status' => '狀態',
	'WarmTips' => '溫馨提示',
	'WarmTipsString' => '點擊日歷上的圖標,將導出當周的事件.',
	'Today' => '今日',
	'Time' => '時間',
	'Entry' => '條目',
	'Image' => '圖片',
	'YourScheduleFor' => '你的計劃事件于',
	'Sun' => '日',
	'Mon' => '一',
	'Tue' => '二',
	'Wed' => '三',
	'Thu' => '四',
	'Fri' => '五',
	'Sat' => '六',
	'wk' => '周',
//send mail
	'MailSender' => '郵件發送',
	'WriteMail' => '寫郵件',
	'To' => '到',
	'Send' => '發送',
//document
	'Document' => '文檔',
	'CreateFolder' => '創建目錄',
	'Folder' => '文件夾',
	'CreateFile' => '上傳文件',
	'Position' => '目錄位置',
	'Root' => '根目錄',
	'Filename' => '文件',
	'MajorRevision' => '主版本號',
	'MinorRevision' => '副版本號',
//order
	'Order' => '訂單',
	
	'StateHandling' => '處理中',
	'StateDelivery' => '已發貨',
	'StateCancel' => '已取消',
	'StateFinish' => '已完成',
	'StatePrepay' => '已預付',
	'StateWaitpay' => '等款到',

	'PaywayCash' => '現金',
	'PaywayWeek' => '周結',
	'PaywayMonth' => '月結',
	'PaywayQuarter' => '季度結',
	'PaywayYear' => '年結',

	'DeliverywayVisiting' => '上門提貨',
	'DeliverywayNetwork' => '通過網絡',
	'DeliverywayLand' => '陸運',
	'DeliverywayOcean' => '海運',
	'DeliverywayAir' => '空運',
	
	'Noid' => '編號',
	'Contactid' => '聯系人',
	'Discount' => '折扣(%)',
	'Payway' => '付款方式',
	'Deliveryway' => '交貨方式',
	'Deliverydatetime' => '交貨日期',
	'OrderCategory' => '訂單分類',
	'Userid' => '擁有者',
	'CreatedAt' => '創建日期',
//agreement
	'Agreement' => '合同',
	'Effectdate' => '生效日期',
	'Expireddate' => '失效日期',
	'Buyer' => '甲方',
	'Vender' => '乙方',
	'Buyersignature' => '甲方簽約人',
	'Vendersignature' => '乙方簽約人',

//afterService
	'AfterService' => '售後',
//Complaints
	'Complaints' => '投訴',
	'Complainanter' => '投訴人',
	'Reply' => '回復',
	'Handleman' => '處理人',
	'Handledate' => '處理日期',
//Refundment
	'Refundment' => '退貨',
	'Refundmenter' => '退貨人',
	'Reasons' => '退貨原因',
//Review
	'Review' => '回訪',
	'Linkman' => '接待人',
	'Reviewdate' => '回訪日期',
	
//Permit
	'NotPermit' => '權限不足',
	'NotPermitMessage' => '對不起，你的權限不足，無法進行此操作。',

	'Please check here' => '請檢查此處',
	'Your modifications have been saved' => '您的更改已保存',
);
$this->set($messages);

?>
