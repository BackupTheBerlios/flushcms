// AccountantView.cpp : CAccountantView 类的实现
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"
#include "AccountantView.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountantView

IMPLEMENT_DYNCREATE(CAccountantView, CListView)

BEGIN_MESSAGE_MAP(CAccountantView, CListView)
	ON_WM_STYLECHANGED()
	ON_NOTIFY_REFLECT(NM_RCLICK, &CAccountantView::OnNMRclick)
END_MESSAGE_MAP()

// CAccountantView 构造/析构

CAccountantView::CAccountantView()
{
	// TODO: 在此处添加构造代码

}

CAccountantView::~CAccountantView()
{
}

BOOL CAccountantView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: 在此处通过修改
	//  CREATESTRUCT cs 来修改窗口类或样式

	return CListView::PreCreateWindow(cs);
}

void CAccountantView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: 调用 GetListCtrl() 直接访问 ListView 的列表控件，
	//  从而可以用项填充 ListView。
	m_nList = & GetListCtrl();

	long        lStyleOld;
	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= LVS_REPORT   ;
	SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );

	m_nList->SetExtendedStyle(m_nList->GetExtendedStyle()|LVS_EX_TRACKSELECT|LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_MULTIWORKAREAS|LVS_EX_ONECLICKACTIVATE   );

	m_nList->InsertColumn(0,_T("姓名"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(1,_T("性别"),LVCFMT_LEFT,40);
	m_nList->InsertColumn(2,_T("电话"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(3,_T("地址"),LVCFMT_LEFT,250);

}


// CAccountantView 诊断

#ifdef _DEBUG
void CAccountantView::AssertValid() const
{
	CListView::AssertValid();
}

void CAccountantView::Dump(CDumpContext& dc) const
{
	CListView::Dump(dc);
}

CAccountantDoc* CAccountantView::GetDocument() const // 非调试版本是内联的
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountantDoc)));
	return (CAccountantDoc*)m_pDocument;
}
#endif //_DEBUG


// CAccountantView 消息处理程序
void CAccountantView::OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct)
{
	//TODO: 添加代码以响应用户对窗口视图样式的更改	
	CListView::OnStyleChanged(nStyleType,lpStyleStruct);	
}

void CAccountantView::OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult)
{
	//响应右键事件
	*pResult = 0;

	CMenu *myMenu,*dispMenu;
	CPoint point;
	GetCursorPos(&point);

	myMenu = new CMenu();
	dispMenu = new CMenu();
	myMenu->LoadMenu(IDR_MENU1);
	dispMenu = myMenu->GetSubMenu(1);

	dispMenu->TrackPopupMenu(TPM_LEFTALIGN |TPM_RIGHTBUTTON,point.x,point.y, this);

}
