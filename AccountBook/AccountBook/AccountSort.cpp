// AccountSort.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountSort.h"


// CAccountSort 对话框

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


// CAccountSort 消息处理程序

BOOL CAccountSort::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  在此添加额外的初始化
	//m_nToolBar.CreateEx(this, TBSTYLE_FLAT, WS_CHILD | WS_VISIBLE | CBRS_TOP
	//	| CBRS_GRIPPER | CBRS_TOOLTIPS | CBRS_FLYBY | CBRS_SIZE_DYNAMIC 
	//	);
	//HWND hDlg=GetSafeHwnd();
	//CWnd *wDlg = GetWindow(GW_CHILD);
	//HINSTANCE hInstance=AfxGetInstanceHandle();


	//TBBUTTON ptoolbar[30]={
	//{0,0,TBSTATE_ENABLED,TBSTYLE_SEP,0,0},
	//{STD_FILENEW, //指定Windows的标准帮助图标
	//ID_BUTTON32773, //工具条按钮的ID
	//TBSTATE_ENABLED, //可用状态
	//TBSTYLE_BUTTON, //指定创建一个可以下按的按钮
	//0, //保留，由应用程序定义该参数意义
	//0}, //按钮字串索引
	//	//创建一个分割按钮用的竖线
	//{0,0,TBSTATE_ENABLED,TBSTYLE_SEP,0,0},
	//{STD_FILESAVE,ID_BUTTON32773,TBSTATE_ENABLED,TBSTYLE_BUTTON,0,0}
	//};

	//HWND hToolsWindow=::CreateToolbarEx(hDlg, //指定对话框为父窗口，将工具条创建在对话框上
	//	WS_CHILD|WS_VISIBLE|TBSTYLE_WRAPABLE|TBSTYLE_TOOLTIPS|
	//	TBSTYLE_FLAT|CCS_ADJUSTABLE,//指定工具条的创建风格
	//	IDR_ACCOUNT_TYPE_TOOLBAR,//预定义的工具条资源ID
	//	30,HINST_COMMCTRL, //包含图片资源的可执行文件的实例句柄
	//	IDB_STD_SMALL_COLOR,//图片的资源ID
	//	ptoolbar, //待添加的按钮
	//	6, //加入到工具条的按钮的个数
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
	// 异常: OCX 属性页应返回 FALSE
}
