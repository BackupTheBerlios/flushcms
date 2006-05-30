// AccountSort.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountSort.h"

#include "CommonHeader.h"
#include "AccountAdd.h"


// CAccountSort �Ի���

IMPLEMENT_DYNAMIC(CAccountSort, CDialog)

CAccountSort::CAccountSort(CWnd* pParent /*=NULL*/)
	: CDialog(CAccountSort::IDD, pParent)
{

}

CAccountSort::~CAccountSort()
{
}

void CAccountSort::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_ACCOUNT_TYPE_LIST, m_nAccountTypeList);
}


BEGIN_MESSAGE_MAP(CAccountSort, CDialog)
	ON_BN_CLICKED(IDC_BUTTON1, &CAccountSort::OnBnClickedButton1)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_ACCOUNT_TYPE_LIST, &CAccountSort::OnLvnItemActivateAccountTypeList)
	ON_BN_CLICKED(IDC_BUTTON2, &CAccountSort::OnBnClickedButton2)
END_MESSAGE_MAP()


// CAccountSort ��Ϣ�������

BOOL CAccountSort::OnInitDialog()
{
	CDialog::OnInitDialog();

	m_nAccountTypeList.SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_CHECKBOXES|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE);
	for (int i=0;i<ACCOUNT_TYPE_LEN;i++)
	{
		m_nAccountTypeList.InsertColumn(i,accountTypeLabel[i].title,LVCFMT_LEFT,accountTypeLabel[i].len);
	}
	m_nAccountTypeList.SetColumnHide(1, TRUE);

	DrawList();
	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	//m_nToolBar.CreateEx(this, TBSTYLE_FLAT, WS_CHILD | WS_VISIBLE | CBRS_TOP
	//	| CBRS_GRIPPER | CBRS_TOOLTIPS | CBRS_FLYBY | CBRS_SIZE_DYNAMIC 
	//	);
	//HWND hDlg=GetSafeHwnd();
	//CWnd *wDlg = GetWindow(GW_CHILD);
	//HINSTANCE hInstance=AfxGetInstanceHandle();


	//TBBUTTON ptoolbar[30]={
	//{0,0,TBSTATE_ENABLED,TBSTYLE_SEP,0,0},
	//{STD_FILENEW, //ָ��Windows�ı�׼����ͼ��
	//ID_BUTTON32773, //��������ť��ID
	//TBSTATE_ENABLED, //����״̬
	//TBSTYLE_BUTTON, //ָ������һ�������°��İ�ť
	//0, //��������Ӧ�ó�����ò�������
	//0}, //��ť�ִ�����
	//	//����һ���ָť�õ�����
	//{0,0,TBSTATE_ENABLED,TBSTYLE_SEP,0,0},
	//{STD_FILESAVE,ID_BUTTON32773,TBSTATE_ENABLED,TBSTYLE_BUTTON,0,0}
	//};

	//HWND hToolsWindow=::CreateToolbarEx(hDlg, //ָ���Ի���Ϊ�����ڣ��������������ڶԻ�����
	//	WS_CHILD|WS_VISIBLE|TBSTYLE_WRAPABLE|TBSTYLE_TOOLTIPS|
	//	TBSTYLE_FLAT|CCS_ADJUSTABLE,//ָ���������Ĵ������
	//	IDR_ACCOUNT_TYPE_TOOLBAR,//Ԥ����Ĺ�������ԴID
	//	30,HINST_COMMCTRL, //����ͼƬ��Դ�Ŀ�ִ���ļ���ʵ�����
	//	IDB_STD_SMALL_COLOR,//ͼƬ����ԴID
	//	ptoolbar, //����ӵİ�ť
	//	6, //���뵽�������İ�ť�ĸ���
	//	0,0,0,0,sizeof(TBBUTTON));
	
	//m_nToolBar.CreateEx(wDlg,TBSTYLE_FLAT, WS_CHILD | WS_VISIBLE | CBRS_TOP
	//	| CBRS_GRIPPER | CBRS_TOOLTIPS | CBRS_FLYBY | CBRS_SIZE_DYNAMIC);
	//m_nToolBar.LoadToolBar(IDR_ACCOUNT_TYPE_TOOLBAR);
	//m_nToolBar.LoadBitmapW(IDR_ACCOUNT_TYPE_TOOLBAR);
	//CBitmap bitmap;
	//CImageList imageList;
	//TBBUTTON m_button[13];
	//bitmap.LoadBitmap(IDR_ACCOUNT_TYPE_TOOLBAR);
	//imageList.Create(16,16,ILC_COLORDDB|ILC_MASK,13,1);
	//imageList.Add(&bitmap,RGB(255,0,255));

	//RECT rect;
	//rect.top=0;
	//rect.left=0;
	//rect.right=20;
	//rect.bottom=20;
	//m_nToolBar.Create(WS_CHILD|WS_VISIBLE|CCS_TOP|TBSTYLE_TOOLTIPS|CCS_ADJUSTABLE ,rect,this,0);	
	//m_nToolBar.SendMessage(TB_SETIMAGELIST,0,(LPARAM)imageList.m_hImageList);
	//imageList.Detach();
	//bitmap.Detach();

	//int buttonbitmap=m_nToolBar.AddBitmap(3,IDR_ACCOUNT_TYPE_TOOLBAR);
	//int ncount=0;
	//for(ncount=0;ncount<3;ncount++)
	//{
	//	m_button[ncount].iBitmap=buttonbitmap+ncount;
	//	m_button[ncount].idCommand=ncount;
	//	m_button[ncount].fsState=TBSTATE_ENABLED;
	//	m_button[ncount].fsStyle=TBSTYLE_BUTTON;
	//	m_button[ncount].dwData=0;
	//}
	//m_nToolBar.AddButtons(ncount,m_button);



	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

void CAccountSort::OnBnClickedButton1()
{
	//��ӿ�Ŀ
	CAccountAdd *addDlg = new CAccountAdd();
	addDlg->DoModal();
	if (addDlg->m_bIsSubmint)
	{
		 CString sql;
		 sql.Format(_T(" INSERT INTO AccountType (NumberID,Title,Display,OrderID) VALUES (%s,'%s','%s',%s) "),addDlg->m_nNumberID,addDlg->m_nTitle,addDlg->m_nDisplay,addDlg->m_nOrderID );
		 theApp.m_nDatabase->doActionQuery(sql);
		 DrawList();
	}
}

void CAccountSort::DrawList(void)
{
	CRecordset *m_pSet;
	CString tmpStr,filedName[ACCOUNT_TYPE_LEN]={
		_T("NumberID"),
		_T("AccountTypeID"),
		_T("Title"),
		_T("Display"),
		_T("OrderID")
	};

	m_pSet=theApp.m_nDatabase->getTableRecordset(_T("AccountType"),_T(" ORDER BY OrderID "));
	m_nAccountTypeList.DeleteAllItems();

	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int x=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("NumberID"),tmpStr);
			m_nAccountTypeList.InsertItem(x,tmpStr);
			for (int i=1;i<ACCOUNT_TYPE_LEN;i++)
			{
				m_pSet->GetFieldValue(filedName[i],tmpStr);
				m_nAccountTypeList.SetItemText(x,i,tmpStr);

			}
			x++;
			m_pSet->MoveNext();
		}
	}
	m_pSet->Close();

}

void CAccountSort::OnLvnItemActivateAccountTypeList(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// �޸Ŀ�Ŀ
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nAccountTypeList.GetItemText(pNMIA->iItem,1);
	
	CRecordset *m_pSet;
	CString sql,tmpStr,currentID;

	CAccountAdd *addDlg = new CAccountAdd();

	sql.Format(_T(" WHERE AccountTypeID = %s "),selectItem);
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("AccountType"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();

		m_pSet->GetFieldValue(_T("NumberID"),tmpStr);
		addDlg->m_nNumberID=tmpStr;

		m_pSet->GetFieldValue(_T("Title"),tmpStr);
		addDlg->m_nTitle=tmpStr;

		m_pSet->GetFieldValue(_T("Display"),tmpStr);
		addDlg->m_nDisplay=tmpStr;

		m_pSet->GetFieldValue(_T("OrderID"),tmpStr);
		addDlg->m_nOrderID=tmpStr;

		m_pSet->GetFieldValue(_T("AccountTypeID"),currentID);

	}
	m_pSet->Close();
	addDlg->m_bUpdateModel=true;
	addDlg->DoModal();

	if (addDlg->m_bIsSubmint)
	{
		sql.Format(_T(" UPDATE AccountType SET NumberID=%s,Title='%s',Display='%s',OrderID=%s WHERE AccountTypeID=%s "),addDlg->m_nNumberID,addDlg->m_nTitle,addDlg->m_nDisplay,addDlg->m_nOrderID,currentID);
		theApp.m_nDatabase->doActionQuery(sql);
	}
	DrawList();




}

void CAccountSort::OnBnClickedButton2()
{
	// ɾ����ѡ
	int nCount = m_nAccountTypeList.GetItemCount();
	CString delItem,delString,str;
	str.Format(_T("ȷ��ɾ����ѡ? "));
	if (AfxMessageBox(str,MB_YESNO)==IDYES)
	{
		for (int i=0;i < nCount;i++)
		{
			if (m_nAccountTypeList.GetCheck(i))
			{
				delItem=m_nAccountTypeList.GetItemText(i,1);
				delString.Format(_T(" DELETE FROM AccountType WHERE AccountTypeID=%s "),delItem);
				theApp.m_nDatabase->doActionQuery(delString);
			}
		}
		// �ػ��б�
		DrawList();
	}
}
