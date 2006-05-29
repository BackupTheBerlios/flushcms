// MainFrm.cpp : CMainFrame ���ʵ��
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
	ID_SEPARATOR,           // ״̬��ָʾ��
	ID_SEPARATOR,           // ״̬��ָʾ��
	ID_INDICATOR_CAPS,
	ID_INDICATOR_NUM,
	ID_INDICATOR_SCRL,
};


// CMainFrame ����/����

CMainFrame::CMainFrame()
: m_bFormView(false)
{
	// TODO: �ڴ���ӳ�Ա��ʼ������

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
		TRACE0("δ�ܴ���������\n");
		return -1;      // δ�ܴ���
	}

	if (!m_wndStatusBar.Create(this) ||
		!m_wndStatusBar.SetIndicators(indicators,
		  sizeof(indicators)/sizeof(UINT)))
	{
		TRACE0("δ�ܴ���״̬��\n");
		return -1;      // δ�ܴ���
	}

	// TODO: �������Ҫ��������ͣ������ɾ��������
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
	// ������ִ���
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
	// TODO: �ڴ˴�ͨ���޸�
	//  CREATESTRUCT cs ���޸Ĵ��������ʽ
	cs.style=WS_TILEDWINDOW;
	return TRUE;
}


// CMainFrame ���

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


// CMainFrame ��Ϣ�������


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

	// TODO: �Զ������չ�˴����Դ�����ͼ���˵��е�ѡ��

	CAccountBookView* pView = GetRightPane(); 

	// ����Ҵ�����δ�������߲�����ͼ��
	// ���ڷ�Χ�ڽ�������

	if (pView == NULL)
		pCmdUI->Enable(FALSE);
	else
	{
		DWORD dwStyle = pView->GetStyle() & LVS_TYPEMASK;

		// ��������� ID_VIEW_LINEUP����ֻ���ڴ���
		// LVS_ICON �� LVS_SMALLICON ģʽʱ����������

		if (pCmdUI->m_nID == ID_VIEW_LINEUP)
		{
			if (dwStyle == LVS_ICON || dwStyle == LVS_SMALLICON)
				pCmdUI->Enable();
			else
				pCmdUI->Enable(FALSE);
		}
		else
		{
			// ����ʹ�õ�������ӳ��ͼ����ʽ
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
	// TODO: �Զ������չ�˴����Դ�����ͼ���˵��е�ѡ��
	CAccountBookView* pView = GetRightPane();

	// ����Ҵ����Ѵ��������� CAccountBookView��
	// ����˵�����...
	if (pView != NULL)
	{
		DWORD dwStyle = -1;

		switch (nCommandID)
		{
		case ID_VIEW_LINEUP:
			{
				// Ҫ���б�ؼ����������
				CListCtrl& refListCtrl = pView->GetListCtrl();
				refListCtrl.Arrange(LVA_SNAPTOGRID);
			}
			break;

		// ������������б�ؼ��ϵ���ʽ
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

		// ������ʽ�����ڽ��Զ����»���
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

	//��ȡ�ĵ������ָ�룬�Ա��ڴ�������ͼ�Ĺ������ܹ�ʹ����
	CDocument *pDoc = ((CView*)m_wndSplitter.GetPane(row, col))->GetDocument();

	CView *pActiveView = this->GetActiveView();
	if (pActiveView == NULL || pActiveView == m_wndSplitter.GetPane(row, col))
		bSetActive = TRUE;
	else
		bSetActive = FALSE;

	pDoc->m_bAutoDelete = FALSE; //���ñ�־����������ͼ����ʱ����ɾ���ĵ�
	((CView*)m_wndSplitter.GetPane(row, col))->DestroyWindow(); //ɾ�����ڵ���ͼ
	pDoc->m_bAutoDelete = TRUE; //���Ĭ�ϵı�־


	//��������ͼ
	context.m_pNewViewClass = pViewClass;
	context.m_pCurrentDoc = pDoc;
	context.m_pNewDocTemplate = NULL;
	context.m_pLastView = NULL;
	context.m_pCurrentFrame = NULL;
	m_wndSplitter.CreateView(row, col, pViewClass, size, &context);


	CView *pNewView = (CView*)m_wndSplitter.GetPane(row, col);

	if (bSetActive == TRUE)
		this->SetActiveView(pNewView);

	m_wndSplitter.RecalcLayout(); //���¼���λ��
	//m_wndSplitter.GetPane(row,col)->SendMessage(WM_PAINT);
	m_wndSplitter.GetPane(row,col)->SendMessage(WM_PAINT);
	pDoc->SendInitialUpdate();

	return TRUE;
}




void CMainFrame::OnTimer(UINT_PTR nIDEvent)
{
	// ��ʱ����
	switch(nIDEvent)
	{
		case 1:
			CTime theTime = CTime::GetCurrentTime();
			CString timeStr;
			timeStr.Format(_T("��ǰʱ��%d:%d:%d"),theTime.GetHour(),theTime.GetMinute(),theTime.GetSecond());
			m_wndStatusBar.SetPaneText(1,timeStr,true);
			break;
	}

	CFrameWnd::OnTimer(nIDEvent);
}
