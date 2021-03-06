// LeftView.cpp : CLeftView 类的实现
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"
#include "LeftView.h"

#include "AccountSort.h"
#include "CustomerType.h"
#include "MainFrm.h"
#include "AccountTypes.h"
#include "Vouchers.h"
#include "CompanyList.h"
#include "Language.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CLeftView

IMPLEMENT_DYNCREATE(CLeftView, CTreeView)

BEGIN_MESSAGE_MAP(CLeftView, CTreeView)
	ON_NOTIFY_REFLECT(TVN_SELCHANGED, &CLeftView::OnTvnSelchanged)
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

	HTREEITEM rootItem,hParentItem,hSubItem;

	m_nTreeList->SetImageList(imageList,TVSIL_NORMAL);
	main_item_data1 = CLanguage::TranslateString(IDS_LEFT_VIEW_ACCOUT);
	main_item_data1_sub1=CLanguage::TranslateString(IDS_LEFT_VIEW_ACCOUT_SUB1);
	main_item_data1_sub2=CLanguage::TranslateString(IDS_LEFT_VIEW_ACCOUT_SUB2);
	main_item_data1_sub3=CLanguage::TranslateString(IDS_LEFT_VIEW_ACCOUT_SUB3);
	CString main_item[1]={
		main_item_data1//,
		//_T("客户管理"),
		//_T("供应商管理"),
		//_T("商品管理"),
		//_T("员工管理")
	};
	CString sub_item[1][3]={
		{main_item_data1_sub1,main_item_data1_sub2,main_item_data1_sub3}//,
		//{_T("客户分类"),_T("客户列表"),_T("")},
		//{_T("供应商分类"),_T("供应商列表"),_T("")},
		//{_T("商品分类"),_T("商品列表"),_T("")},
		//{_T("部门设置"),_T("员工列表"),_T("")}
	};

	for (int i=0;i<1;i++)
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
	CString tempstr;

}

void CLeftView::OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMTREEVIEW pNMTreeView = reinterpret_cast<LPNMTREEVIEW>(pNMHDR);
	// 选择子菜单时处理
	UpdateData(true);
	CString node_name=m_nTreeList->GetItemText(pNMTreeView->itemNew.hItem);

	HTREEITEM hItem = m_nTreeList->GetSelectedItem();
	HTREEITEM hParent = m_nTreeList->GetParentItem(hItem);
	m_nTreeList->Expand(hParent,TVE_EXPAND);
	if (hItem != NULL && hParent !=NULL )
	{
		CMainFrame *pMainFrame = (CMainFrame*)AfxGetMainWnd();

		if (node_name==main_item_data1_sub1)
		{
			//CAccountSort *typeDlg = new CAccountSort();
			pMainFrame->m_wndSplitter.ReplaceView(0,1,RUNTIME_CLASS(CAccountTypes),CSize(100,100));
			//typeDlg->DoModal();
			//AfxGetApp()->m_pMainWnd->SendMessage(WM_COMMAND, ID_32771);
			//MessageBox(selectText);
		} 
		else if(node_name==main_item_data1_sub2)
		{
			pMainFrame->m_wndSplitter.ReplaceView(0,1,RUNTIME_CLASS(CVouchers),CSize(100,100));
			//CVoucherInput *voucherDlg = new CVoucherInput();
			//voucherDlg->DoModal();
			//AfxGetApp()->m_pMainWnd->SendMessage(WM_COMMAND, ID_32772);
			//MessageBox(selectText);

		}
		else if(node_name==main_item_data1_sub3)
		{
			pMainFrame->m_wndSplitter.ReplaceView(0,1,RUNTIME_CLASS(CCompanyList),CSize(100,100));

		}

	}

	UpdateData(false);
	*pResult = 0;
}
