// MainFrm.cpp : CMainFrame 类的实现
//

#include "stdafx.h"
#include "AccountBook.h"

#include "MainFrm.h"
#include "LeftView.h"
#include "AccountBookView.h"

#include "SplashScreen.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CMainFrame

IMPLEMENT_DYNCREATE(CMainFrame, CFrameWnd)

BEGIN_MESSAGE_MAP(CMainFrame, CFrameWnd)
	ON_WM_CREATE()
	ON_UPDATE_COMMAND_UI_RANGE(AFX_ID_VIEW_MINIMUM, AFX_ID_VIEW_MAXIMUM, &CMainFrame::OnUpdateViewStyles)
	ON_COMMAND_RANGE(AFX_ID_VIEW_MINIMUM, AFX_ID_VIEW_MAXIMUM, &CMainFrame::OnViewStyle)
	ON_WM_TIMER()
END_MESSAGE_MAP()

static UINT indicators[] =
{
	ID_SEPARATOR,           // 状态行指示器
	ID_SEPARATOR,           // 状态行指示器
	ID_INDICATOR_CAPS,
	ID_INDICATOR_NUM,
	ID_INDICATOR_SCRL,
};


// CMainFrame 构造/析构

CMainFrame::CMainFrame()
: m_bFormView(false)
{
	// TODO: 在此添加成员初始化代码

}

CMainFrame::~CMainFrame()
{
	KillTimer(1);
	theApp.m_nDatabase->m_nDatabase->Close();
}


int CMainFrame::OnCreate(LPCREATESTRUCT lpCreateStruct)
{
	CSplashScreen *splash = new CSplashScreen(this);
	splash->Create(CSplashScreen::IDD,this);
	splash->ShowWindow(SW_SHOW);
	splash->UpdateWindow();
	Sleep(3000);

	if (CFrameWnd::OnCreate(lpCreateStruct) == -1)
		return -1;
	
	if (!m_wndToolBar.CreateEx(this, TBSTYLE_FLAT, WS_CHILD | WS_VISIBLE | CBRS_TOP
		| CBRS_GRIPPER | CBRS_TOOLTIPS | CBRS_FLYBY | CBRS_SIZE_DYNAMIC) ||
		!m_wndToolBar.LoadToolBar(IDR_MAINFRAME))
	{
		TRACE0("未能创建工具栏\n");
		return -1;      // 未能创建
	}

	if (!m_wndStatusBar.Create(this) ||
		!m_wndStatusBar.SetIndicators(indicators,
		  sizeof(indicators)/sizeof(UINT)))
	{
		TRACE0("未能创建状态栏\n");
		return -1;      // 未能创建
	}

	// TODO: 如果不需要工具栏可停靠，则删除这三行
	m_wndToolBar.EnableDocking(CBRS_ALIGN_ANY);
	EnableDocking(CBRS_ALIGN_ANY);
	DockControlBar(&m_wndToolBar);
	
	m_wndStatusBar.SetPaneInfo(1,ID_SEPARATOR,SBPS_NORMAL,90);

	SetTimer(1,100,NULL);

	splash->DestroyWindow();
	return 0;
}

BOOL CMainFrame::OnCreateClient(LPCREATESTRUCT /*lpcs*/,
	CCreateContext* pContext)
{
	// 创建拆分窗口
	if (!m_wndSplitter.CreateStatic(this, 1, 2))
		return FALSE;

	if (!m_wndSplitter.CreateView(0, 0, RUNTIME_CLASS(CLeftView), CSize(200, 100), pContext) ||
		!m_wndSplitter.CreateView(0, 1, RUNTIME_CLASS(CAccountBookView), CSize(100, 100), pContext))//CAccountBookView
	{
		m_wndSplitter.DestroyWindow();
		return FALSE;
	}

	m_bFormView = true;
	return TRUE;
}

BOOL CMainFrame::PreCreateWindow(CREATESTRUCT& cs)
{
	if( !CFrameWnd::PreCreateWindow(cs) )
		return FALSE;
	// TODO: 在此处通过修改
	//  CREATESTRUCT cs 来修改窗口类或样式
	cs.style=WS_TILEDWINDOW;
	return TRUE;
}


// CMainFrame 诊断

#ifdef _DEBUG
void CMainFrame::AssertValid() const
{
	CFrameWnd::AssertValid();
}

void CMainFrame::Dump(CDumpContext& dc) const
{
	CFrameWnd::Dump(dc);
}

#endif //_DEBUG


// CMainFrame 消息处理程序


CAccountBookView* CMainFrame::GetRightPane()
{
	CWnd* pWnd = m_wndSplitter.GetPane(0, 1);
	CAccountBookView* pView = DYNAMIC_DOWNCAST(CAccountBookView, pWnd);
	return pView;
}

void CMainFrame::OnUpdateViewStyles(CCmdUI* pCmdUI)
{
	if (!pCmdUI)
		return;

	// TODO: 自定义或扩展此代码以处理“视图”菜单中的选项

	CAccountBookView* pView = GetRightPane(); 

	// 如果右窗格尚未创建或者不是视图，
	// 则在范围内禁用命令

	if (pView == NULL)
		pCmdUI->Enable(FALSE);
	else
	{
		DWORD dwStyle = pView->GetStyle() & LVS_TYPEMASK;

		// 如果命令是 ID_VIEW_LINEUP，则只有在处于
		// LVS_ICON 或 LVS_SMALLICON 模式时才启用命令

		if (pCmdUI->m_nID == ID_VIEW_LINEUP)
		{
			if (dwStyle == LVS_ICON || dwStyle == LVS_SMALLICON)
				pCmdUI->Enable();
			else
				pCmdUI->Enable(FALSE);
		}
		else
		{
			// 否则，使用点线来反映视图的样式
			pCmdUI->Enable();
			BOOL bChecked = FALSE;

			switch (pCmdUI->m_nID)
			{
			case ID_VIEW_DETAILS:
				bChecked = (dwStyle == LVS_REPORT);
				break;

			case ID_VIEW_SMALLICON:
				bChecked = (dwStyle == LVS_SMALLICON);
				break;

			case ID_VIEW_LARGEICON:
				bChecked = (dwStyle == LVS_ICON);
				break;

			case ID_VIEW_LIST:
				bChecked = (dwStyle == LVS_LIST);
				break;

			default:
				bChecked = FALSE;
				break;
			}

			pCmdUI->SetRadio(bChecked ? 1 : 0);
		}
	}
}


void CMainFrame::OnViewStyle(UINT nCommandID)
{
	// TODO: 自定义或扩展此代码以处理“视图”菜单中的选项
	CAccountBookView* pView = GetRightPane();

	// 如果右窗格已创建而且是 CAccountBookView，
	// 则处理菜单命令...
	if (pView != NULL)
	{
		DWORD dwStyle = -1;

		switch (nCommandID)
		{
		case ID_VIEW_LINEUP:
			{
				// 要求列表控件与网格对齐
				CListCtrl& refListCtrl = pView->GetListCtrl();
				refListCtrl.Arrange(LVA_SNAPTOGRID);
			}
			break;

		// 其他命令更改列表控件上的样式
		case ID_VIEW_DETAILS:
			dwStyle = LVS_REPORT;
			break;

		case ID_VIEW_SMALLICON:
			dwStyle = LVS_SMALLICON;
			break;

		case ID_VIEW_LARGEICON:
			dwStyle = LVS_ICON;
			break;

		case ID_VIEW_LIST:
			dwStyle = LVS_LIST;
			break;
		}

		// 更改样式；窗口将自动重新绘制
		if (dwStyle != -1)
			pView->ModifyStyle(LVS_TYPEMASK, dwStyle);
	}
}


bool CMainFrame::ReplaceView(int row, int col, CRuntimeClass *pViewClass, SIZE size)
{
	CCreateContext context;
	BOOL bSetActive;

	if ((this->m_wndSplitter.GetPane(row, col)->IsKindOf(pViewClass)) == TRUE)
		return FALSE;

	//获取文档对象的指针，以便在创建新视图的过程中能够使用它
	CDocument *pDoc = ((CView*)m_wndSplitter.GetPane(row, col))->GetDocument();

	CView *pActiveView = this->GetActiveView();
	if (pActiveView == NULL || pActiveView == m_wndSplitter.GetPane(row, col))
		bSetActive = TRUE;
	else
		bSetActive = FALSE;

	pDoc->m_bAutoDelete = FALSE; //设置标志，这样当视图销毁时不会删除文档
	((CView*)m_wndSplitter.GetPane(row, col))->DestroyWindow(); //删除存在的视图
	pDoc->m_bAutoDelete = TRUE; //设回默认的标志


	//创建新视图
	context.m_pNewViewClass = pViewClass;
	context.m_pCurrentDoc = pDoc;
	context.m_pNewDocTemplate = NULL;
	context.m_pLastView = NULL;
	context.m_pCurrentFrame = NULL;
	m_wndSplitter.CreateView(row, col, pViewClass, size, &context);


	CView *pNewView = (CView*)m_wndSplitter.GetPane(row, col);

	if (bSetActive == TRUE)
		this->SetActiveView(pNewView);

	m_wndSplitter.RecalcLayout(); //重新计算位置
	//m_wndSplitter.GetPane(row,col)->SendMessage(WM_PAINT);
	m_wndSplitter.GetPane(row,col)->SendMessage(WM_PAINT);
	pDoc->SendInitialUpdate();

	return TRUE;
}




void CMainFrame::OnTimer(UINT_PTR nIDEvent)
{
	// 定时处理
	switch(nIDEvent)
	{
		case 1:
			CTime theTime = CTime::GetCurrentTime();
			CString timeStr;
			timeStr.Format(_T("当前时间%d:%d:%d"),theTime.GetHour(),theTime.GetMinute(),theTime.GetSecond());
			m_wndStatusBar.SetPaneText(1,timeStr,true);
			break;
	}

	CFrameWnd::OnTimer(nIDEvent);
}
