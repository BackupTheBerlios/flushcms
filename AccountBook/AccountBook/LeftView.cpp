// LeftView.cpp : CLeftView ���ʵ��
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


// CLeftView ����/����

CLeftView::CLeftView()
{
	// TODO: �ڴ˴���ӹ������
}

CLeftView::~CLeftView()
{
}

BOOL CLeftView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: �ڴ˴�ͨ���޸� CREATESTRUCT cs ���޸Ĵ��������ʽ

	return CTreeView::PreCreateWindow(cs);
}

void CLeftView::OnInitialUpdate()
{
	CTreeView::OnInitialUpdate();

	// TODO: ���� GetTreeCtrl() ֱ�ӷ��� TreeView �����ؼ���
	//  �Ӷ������������ TreeView��
	m_nTreeList = &GetTreeCtrl();
	this->DrawTreeList();
}


// CLeftView ���

#ifdef _DEBUG
void CLeftView::AssertValid() const
{
	CTreeView::AssertValid();
}

void CLeftView::Dump(CDumpContext& dc) const
{
	CTreeView::Dump(dc);
}

CAccountBookDoc* CLeftView::GetDocument() // �ǵ��԰汾��������
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountBookDoc)));
	return (CAccountBookDoc*)m_pDocument;
}
#endif //_DEBUG


// CLeftView ��Ϣ�������

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

	hParentItem = m_nTreeList->InsertItem(_T("��Ƴ�ʼ��"),1,1);
	hSubItem = m_nTreeList->InsertItem(_T("��ƴ����"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);
	hSubItem = m_nTreeList->InsertItem(_T("��������"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);
	hSubItem = m_nTreeList->InsertItem(_T("��ƿ�Ŀ"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);

	hParentItem = m_nTreeList->InsertItem(_T("����ϵͳ"),1,1);
	hSubItem = m_nTreeList->InsertItem(_T("ƾ֤����"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);


}
