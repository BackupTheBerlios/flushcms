// AccountSort.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountSort.h"


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
}


BEGIN_MESSAGE_MAP(CAccountSort, CDialog)
END_MESSAGE_MAP()


// CAccountSort ��Ϣ�������

BOOL CAccountSort::OnInitDialog()
{
	CDialog::OnInitDialog();

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
