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
	cs.style |=WS_MAXIMIZE;
	return CListView::PreCreateWindow(cs);
}

void CAccountBookView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: 调用 GetListCtrl() 直接访问 ListView 的列表控件，
	//  从而可以用项填充 ListView。
	//m_nList = & GetListCtrl();

	////设置列表风格
	//long        lStyleOld;
	//lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	//lStyleOld |= LVS_REPORT   ;
	//SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );
	//m_nList->SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE   );

	//m_nList->InsertColumn(0,_T("姓名"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(1,_T("性别"),LVCFMT_LEFT,40);
	//m_nList->InsertColumn(2,_T("电话"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(3,_T("手机号码"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(4,_T("地址"),LVCFMT_LEFT,250);

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


void CAccountBookView::OnDraw(CDC* /*pDC*/)
{
	// TODO: 在此添加专用代码和/或调用基类
	//CAccountBookDoc *pDoc = GetDocument();
	//ASSERT_VALID(pDoc);
	//CDC *pDc = GetDC();

	//CBrush brush1;
	//brush1.CreateSolidBrush(RGB(0,0,255));
	//CRect rect1;
	//GetClientRect(&rect1);
	//
	//pDc->FillRect(rect1,&brush1);
	//pDc->TextOut(10, 10, _T("Hockey is Best!"));
}
