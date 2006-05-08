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
