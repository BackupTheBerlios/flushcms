// LeftView.cpp : CLeftView ���ʵ��
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"
#include "LeftView.h"

#include "AccountSort.h"
#include "VoucherInput.h"
#include "CustomerType.h"

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

	HTREEITEM rootItem,hParentItem,hSubItem;

	m_nTreeList->SetImageList(imageList,TVSIL_NORMAL);

	CString main_item[5]={
		_T("�������"),
		_T("�ͻ�����"),
		_T("��Ӧ�̹���"),
		_T("��Ʒ����"),
		_T("Ա������")
	};
	CString sub_item[5][3]={
		{_T("��Ŀ����"),_T("ƾ֤����"),_T("����")},
		{_T("�ͻ�����"),_T("�ͻ��б�"),_T("")},
		{_T("��Ӧ�̷���"),_T("��Ӧ���б�"),_T("")},
		{_T("��Ʒ����"),_T("��Ʒ�б�"),_T("")},
		{_T("��������"),_T("Ա���б�"),_T("")}
	};

	for (int i=0;i<5;i++)
	{
		if (i==0)
		{
			hParentItem= rootItem = m_nTreeList->InsertItem(main_item[i],0,1);
		}
		else
		{
			hParentItem = m_nTreeList->InsertItem(main_item[i],0,1);
		}
		for (int j=0;j<3;j++)
		{
			if (sub_item[i][j]!=_T(""))
			{
				hSubItem = m_nTreeList->InsertItem(sub_item[i][j],hParentItem,TVI_LAST);
				m_nTreeList->SetItemImage(hSubItem,2,2);
			}
		}
	}
	m_nTreeList->Expand(rootItem,TVE_EXPAND);
	m_nTreeList->SetBkColor(RGB(247,247,255));
	m_nTreeList->SetTextColor(RGB(0,0,255));


}

void CLeftView::OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMTREEVIEW pNMTreeView = reinterpret_cast<LPNMTREEVIEW>(pNMHDR);
	// ѡ���Ӳ˵�ʱ����
	UpdateData(true);
	CString node_name=m_nTreeList->GetItemText(pNMTreeView->itemNew.hItem);

	HTREEITEM hItem = m_nTreeList->GetSelectedItem();
	HTREEITEM hParent = m_nTreeList->GetParentItem(hItem);
	m_nTreeList->Expand(hParent,TVE_EXPAND);
	if (hItem != NULL && hParent !=NULL )
	{

		if (node_name==_T("��Ŀ����"))
		{
			CAccountSort *typeDlg = new CAccountSort();
			typeDlg->DoModal();
			//AfxGetApp()->m_pMainWnd->SendMessage(WM_COMMAND, ID_32771);
			//MessageBox(selectText);
		} 
		else if(node_name==_T("ƾ֤����"))
		{
			CVoucherInput *voucherDlg = new CVoucherInput();
			voucherDlg->DoModal();
			//AfxGetApp()->m_pMainWnd->SendMessage(WM_COMMAND, ID_32772);
			//MessageBox(selectText);

		}
		else if(node_name==_T("�ͻ�����"))
		{
			CCustomerType *custmerTypeDlg = new CCustomerType();
			custmerTypeDlg->DoModal();

		}

	}

	UpdateData(false);
	*pResult = 0;
}
