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
	ON_NOTIFY_REFLECT(TVN_SELCHANGED, &CLeftView::OnTvnSelchanged)
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

	hParentItem = m_nTreeList->InsertItem(_T("����ϵͳ"),1,1);
	hSubItem = m_nTreeList->InsertItem(_T("��Ŀ����"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);
	hSubItem = m_nTreeList->InsertItem(_T("ƾ֤����"),hParentItem,TVI_LAST);
	m_nTreeList->SetItemImage(hSubItem,2,2);


}

void CLeftView::OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMTREEVIEW pNMTreeView = reinterpret_cast<LPNMTREEVIEW>(pNMHDR);
	// ѡ���Ӳ˵�ʱ����
	*pResult = 0;
	HTREEITEM hItem = m_nTreeList->GetSelectedItem();
	HTREEITEM hParent = m_nTreeList->GetParentItem(hItem);
	if (hItem != NULL && hParent !=NULL )
	{

		CString selectText = m_nTreeList->GetItemText(hItem);
		if (selectText==_T("��Ŀ����"))
		{
			MessageBox(selectText);
		} 
		else if(selectText==_T("ƾ֤����"))
		{
			MessageBox(selectText);

		}
	}
}
