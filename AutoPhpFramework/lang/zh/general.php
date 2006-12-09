<?php
/**
 *
 * general.php
 *
 * @package    core
 * @author     John.meng <arzen1013@gmail.com>
 * @author     ��Զ��
 * @author     QQ:3440895
 * @version    CVS: $Id: general.php,v 1.24 2006/12/09 14:31:35 arzen Exp $
 */
$this->setCharset('gb2312'); 
$messages = array(
	'site_title' => 'YCRM�ͻ���ϵ����ϵͳ',
	'Copyright' => '&copy; 2006 ��Ȩ���� AutoPHPFramework �Ŷӡ�',
	'Home' => '��ҳ',
	'Users' => '��˾Ա��',
	'News' => '��˾�',
	'NewsCategory' => '��˾����',
	'Product' => '��Ʒ',
	'ProductCategory' => '��Ʒ���',
	'Logout' => '�˳�',
	'Sale' => '����',
	'Costs' => '����',
	'Customer' => '�ͻ�',
	'Workbench' => '����̨',

	'PrevPage' => '��ҳ',
	'NextPage' => '��ҳ',
	'Page' => 'ҳ',
	'JumpTo' => '����',
	'Listing' => '�б�',
	'Parent Listing' => '�ϼ��б�',
	'Search' => '����',
	'Create' => '����',
	'MoveUp' => '����',
	'MoveDown' => '����',
	'Action' => '����',
	'Active' => '״̬',
	'Edit' => '�޸�',
	'Delete' => 'ɾ��',
	'Close' => '�ر�',
	'List' => '�����б�',
	'Save' => '����',
	'All' => '����',
	'New' => '����',
	'Live' => '�ѹ���',
	'Deleted' => '�ѳ���',
	'Access' => '����',
	'Public' => '����',
	'Private' => '˽��',
	'Rename' => '������',

	'Male' => '��',
	'Female' => 'Ů',
	'Category' => '���',
	'CategoryId' => '���',
	'CategoryName' => '�����',
	'ParentCategory' => '�����',
	'DeleteSelected' => 'ɾ����ѡ',
//news	
	'Content' => '����',

//contact
	'ExportAll' => '��������',
	'Export' => '����',
	'Import' => '����',
	'File' => '�ļ�',
	
//users
	'Name' => '����',
	'Gender' => '�Ա�',
	'Birthday' => '����',
	'Phone' => '�绰',
	'User' => '�û�',
	'UserName' => '�û���',
	'UserPwd' => '�û�����',
	'Password' => '����',
	'Addrees' => '��ַ',
	'Photo' => 'ͼƬ',
	'Phone' => '�绰',
	'Email' => '��������',

	'Remember' => '��ס',
	'Login' => '��¼',

	'EditInfo' => '�༭��Ϣ',
	'GeneralInfo' => '������Ϣ',
//group
	'GroupId' => 'ID',
	'GroupDefineName' => '����',
	'IsActive' => '��/�񼤻�',
	'Rights' => 'Ȩ��',
	'RightId' => 'ID',
	'RightDefineName' => 'Ȩ����',

	'Group' => '��',
	'Groups' => '��',
	'GroupUsers' => '���û�',
	'Rights' => 'Ȩ��',
	'GroupRights' => '��Ȩ��',
	'NotInGroup' => '��������',
	'InGroup' => '������',
	'Price' => '�۸�',
	'Title' => '����',

	'Result' => '����¼',

	'ALLOWDELETE' => '����ɾ��',
	'ALLOWUPDATE' => '�����޸�',
	'Memo' => '��ע',

// finance
	'Finance' => '����',
	'FinanceCategory' => '�������',
	'Amount' => '����',
	'Debit' => '��/��',
	'Money' => '���(Ԫ)',
	'CreateDate' => '����',
	'Income' => '����',
	'Payout' => '֧��',
	'DayMoneyRecord' => '�ֽ��ռ���',
//contact
	'Contact' => '��ϵ��',
	'CompanyId' => '��˾',
	'Id' => 'ID',
	'Mobile' => '�ֻ�',
	'OfficePhone' => '��˾�绰',
	'Fax' => '����',
	'Homepage' => '��ҳ',
	'ContactCategory' => '��ϵ�˷���',
//company
	'Company' => '��˾',
	'LinkMan' => '��ϵ��',
	'Employee' => '��Ա',
	'Bankroll' => '�̶��ʽ�',
	'Incorporator' => '���˴���',
	'Industry' => '������ҵ',
	'Products' => '��Ʒ',
	'DetailInfo' => '��ϸ��Ϣ',
	'Relationship' => '��ϵ',
	'Manage' => '����',
	'Company Contact Relation' => '��˾��ϵ�˹�ϵ����',
	'Company Products Relation' => '��˾��Ʒ��ϵ����',
//opportunity
	'Opportunity' => '����',
	'State' => '״̬',
	'Pending' => 'δ����',
	'Start' => '��ʼ',
//Schedule
	'Schedule' => '�ƻ��¼�',
	'CreateSchedule' => '�����ƻ��¼�',
	'Title' => '����',
	'PublishDate' => 'Ԥ������',
	'StartTime' => '��ʼʱ��',
	'EndTime' => '����ʱ��',
	'Description' => '����',
	'Status' => '״̬',
	'WarmTips' => '��ܰ��ʾ',
	'WarmTipsString' => '��������ϵ�ͼ��,���������ܵ��¼�.',
	'Today' => '����',
	'Time' => 'ʱ��',
	'Entry' => '��Ŀ',
	'Image' => 'ͼƬ',
	'YourScheduleFor' => '��ļƻ��¼���',
	'Sun' => '��',
	'Mon' => 'һ',
	'Tue' => '��',
	'Wed' => '��',
	'Thu' => '��',
	'Fri' => '��',
	'Sat' => '��',
	'wk' => '��',
//send mail
	'MailSender' => '�ʼ�����',
	'WriteMail' => 'д�ʼ�',
	'To' => '��',
	'Send' => '����',
//document
	'Document' => '�ĵ�',
	'CreateFolder' => '����Ŀ¼',
	'Folder' => '�ļ���',
	'CreateFile' => '�ϴ��ļ�',
	'Position' => 'Ŀ¼λ��',
	'Root' => '��Ŀ¼',
	'Filename' => '�ļ�',
	'MajorRevision' => '���汾��',
	'MinorRevision' => '���汾��',
//order
	'Order' => '����',
	
	'StateHandling' => '������',
	'StateDelivery' => '�ѷ���',
	'StateCancel' => '��ȡ��',
	'StateFinish' => '�����',
	'StatePrepay' => '��Ԥ��',
	'StateWaitpay' => '�ȿ',

	'PaywayCash' => '�ֽ�',
	'PaywayWeek' => '�ܽ�',
	'PaywayMonth' => '�½�',
	'PaywayQuarter' => '���Ƚ�',
	'PaywayYear' => '���',

	'DeliverywayVisiting' => '�������',
	'DeliverywayNetwork' => 'ͨ������',
	'DeliverywayLand' => '½��',
	'DeliverywayOcean' => '����',
	'DeliverywayAir' => '����',
	
	'Noid' => '���',
	'Contactid' => '��ϵ��',
	'Discount' => '�ۿ�(%)',
	'Payway' => '���ʽ',
	'Deliveryway' => '������ʽ',
	'Deliverydatetime' => '��������',
	'OrderCategory' => '��������',
	'Userid' => 'ӵ����',
	'CreatedAt' => '��������',
//agreement
	'Agreement' => '��ͬ',
	'Effectdate' => '��Ч����',
	'Expireddate' => 'ʧЧ����',
	'Buyer' => '�׷�',
	'Vender' => '�ҷ�',
	'Buyersignature' => '�׷�ǩԼ��',
	'Vendersignature' => '�ҷ�ǩԼ��',

//afterService
	'AfterService' => '�ۺ�',
//Complaints
	'Complaints' => 'Ͷ��',
	'Complainanter' => 'Ͷ����',
	'Reply' => '�ظ�',
	'Handleman' => '������',
	'Handledate' => '��������',
//Refundment
	'Refundment' => '�˻�',
	'Refundmenter' => '�˻���',
	'Reasons' => '�˻�ԭ��',
//Review
	'Review' => '�ط�',
	'Linkman' => '�Ӵ���',
	'Reviewdate' => '�ط�����',
	
//Permit
	'NotPermit' => 'Ȩ�޲���',
	'NotPermitMessage' => '�Բ������Ȩ�޲��㣬�޷����д˲�����',

	'Please check here' => '����˴�',
	'Your modifications have been saved' => '���ĸ����ѱ���',
);
$this->set($messages);

?>
