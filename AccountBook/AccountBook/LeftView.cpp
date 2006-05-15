// LeftView.cpp : CLeftView 类的实现
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"
#include "LeftView.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CLeftView

IMPLEMENT_DYNCREATE(CLeftView, CTreeView)

BEGIN_MESSAGE_MAP(CLeftView, CTreeView)
END_MESSAGE_MAP()


// CLeftView 构造/析构

CLeftView::CLeftView()
{
	// TODO: 在此处添加构造代码
}

CLeftView::~CLeftView()
{
}

BOOL CLeftView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: 在此处通过修改 CREATESTRUCT cs 来修改窗口类或样式

	return CTreeView::PreCreateWindow(cs);
}

void CLeftView::OnInitialUpdate()
{
	CTreeView::OnInitialUpdate();

	// TODO: 调用 GetTreeCtrl() 直接访问 TreeView 的树控件，
	//  从而可以用项填充 TreeView。
	m_nTreeList = &GetTreeCtrl();
	this->DrawTreeList();
}


// CLeftView 诊断

#ifdef _DEBUG
void CLeftView::AssertValid() const
{
	CTreeView::AssertValid();
}

void CLeftView::Dump(CDumpContext& dc) const
{
	CTreeView::Dump(dc);
}

CAccountBookDoc* CLeftView::GetDocument() // 非调试版本是内联的
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountBookDoc)));
	return (CAccountBookDoc*)m_pDocument;
}
#endif //_DEBUG


// CLeftView 消息处理程序

void CLeftView::DrawTreeList(void)
{
	long        lStyleOld;

	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= TVS_TRACKSELECT|TVS_RTLREADING |TVS_LINESATROOT|TVS_HASLINES|TVS_HASBUTTONS|TVS_INFOTIP  ;

	SetWindowLong(m_nTreeList->m_hWnd,GWL_STYLE,lStyleOld );
	CImageList *imageList;

	m_nTreeList->DeleteAllItems();

	imageList = new CImageList();
	imageList->Create(16,16,ILC_COLOR32,0,4);
	imageList->Add(AfxGetApp()->LoadIcon(IDI_FOLDER));
	imageList->Add(AfxGetApp()->LoadIcon(IDI_FOLDER_OPEN));
	imageList->Add(AfxGetApp()->LoadIcon(IDI_PAGE));

	HTREEITEM hParentItem,hSubItem;

	m_nTreeList->SetImageList(imageList,TVSIL_NORMAL);

	hParentItem = m_nTreeList->InsertItem(_T("会计初始化"),1,1);
	hSubItem = m_nTreeList->InsertItem(_T("会计大类别"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);
	hSubItem = m_nTreeList->InsertItem(_T("会计中类别"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);
	hSubItem = m_nTreeList->InsertItem(_T("会计科目"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);

	hParentItem = m_nTreeList->InsertItem(_T("财务系统"),1,1);
	hSubItem = m_nTreeList->InsertItem(_T("凭证输入"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);


}
