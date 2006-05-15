// AccountBookView.cpp : CAccountBookView 类的实现
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"
#include "AccountBookView.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountBookView

IMPLEMENT_DYNCREATE(CAccountBookView, CListView)

BEGIN_MESSAGE_MAP(CAccountBookView, CListView)
	ON_WM_STYLECHANGED()
END_MESSAGE_MAP()

// CAccountBookView 构造/析构

CAccountBookView::CAccountBookView()
{
	// TODO: 在此处添加构造代码

}

CAccountBookView::~CAccountBookView()
{
}

BOOL CAccountBookView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: 在此处通过修改
	//  CREATESTRUCT cs 来修改窗口类或样式

	return CListView::PreCreateWindow(cs);
}

void CAccountBookView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: 调用 GetListCtrl() 直接访问 ListView 的列表控件，
	//  从而可以用项填充 ListView。
}


// CAccountBookView 诊断

#ifdef _DEBUG
void CAccountBookView::AssertValid() const
{
	CListView::AssertValid();
}

void CAccountBookView::Dump(CDumpContext& dc) const
{
	CListView::Dump(dc);
}

CAccountBookDoc* CAccountBookView::GetDocument() const // 非调试版本是内联的
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountBookDoc)));
	return (CAccountBookDoc*)m_pDocument;
}
#endif //_DEBUG


// CAccountBookView 消息处理程序
void CAccountBookView::OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct)
{
	//TODO: 添加代码以响应用户对窗口视图样式的更改	
	CListView::OnStyleChanged(nStyleType,lpStyleStruct);	
}
