// LeftView.cpp : CLeftView 类的实现
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"
#include "LeftView.h"
#include "TypeInputDlg.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CLeftView

IMPLEMENT_DYNCREATE(CLeftView, CTreeView)

BEGIN_MESSAGE_MAP(CLeftView, CTreeView)
	ON_NOTIFY_REFLECT(NM_RCLICK, &CLeftView::OnNMRclick)
	ON_COMMAND(ID_ID_32776, &CLeftView::OnId32776)
	ON_COMMAND(ID_ID_DEL_TYPE, &CLeftView::OnIdDelType)
	ON_COMMAND(ID_ID_32780, &CLeftView::OnId32780)
	ON_NOTIFY_REFLECT(NM_CLICK, &CLeftView::OnNMClick)
	ON_NOTIFY_REFLECT(TVN_SELCHANGED, &CLeftView::OnTvnSelchanged)
END_MESSAGE_MAP()


// CLeftView 构造/析构

CLeftView::CLeftView()
: m_nPID(0)
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
	mydata = theApp.mydata;

	drawTreeList();
	UpdateData(TRUE);

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

CAccountantDoc* CLeftView::GetDocument() // 非调试版本是内联的
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountantDoc)));
	return (CAccountantDoc*)m_pDocument;
}
#endif //_DEBUG


// CLeftView 消息处理程序

void CLeftView::OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult)
{
	*pResult = 0;
	CMenu *myMenu,*dispMenu;
	CPoint point;
	GetCursorPos(&point);

	myMenu = new CMenu();
	dispMenu = new CMenu();
	myMenu->LoadMenu(IDR_MENU1);
	dispMenu = myMenu->GetSubMenu(0);

	HTREEITEM hItem = m_nTreeList->GetSelectedItem();
	if (hItem==NULL)
	{
		dispMenu->EnableMenuItem(ID_ID_DEL_TYPE,MF_GRAYED);
	}

	dispMenu->TrackPopupMenu(TPM_LEFTALIGN |TPM_RIGHTBUTTON,point.x,point.y, this);

}

//添加分类
void CLeftView::OnId32776()
{
	CTypeInputDlg *dlg;
	dlg = new CTypeInputDlg();

	dlg->DoModal();

	if (dlg->m_nTypeName != "")
	{
		mydata->addTypeName(dlg->m_nTypeName,dlg->m_nPTypeVal);
		drawTreeList();
	}

}

//删除分类
void CLeftView::OnIdDelType()
{
	HTREEITEM hItem = m_nTreeList->GetSelectedItem();

	CString itemText;
	itemText=m_nTreeList->GetItemText(hItem);

	if (itemText != "")
	{
		CString str;
		str.Format(_T("确认删除分类 \"%s\""),itemText);

		if (AfxMessageBox((LPCTSTR) str,MB_YESNO)==IDYES)
		{
			mydata->delTypeName(itemText);
			m_nTreeList->DeleteItem(hItem);
		}
	}
	else
	{
		MessageBox(_T("请选择你要删除的分类"));
	}
}

void CLeftView::OnId32780()
{

}

void CLeftView::drawTreeList(void)
{
	//CMyDatabase *mydata;
	m_nTreeList = &GetTreeCtrl();

	long        lStyleOld;

	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= TVS_TRACKSELECT|TVS_RTLREADING |TVS_LINESATROOT|TVS_HASLINES|TVS_HASBUTTONS|TVS_INFOTIP  ;

	SetWindowLong(m_nTreeList->m_hWnd,GWL_STYLE,lStyleOld );

	CRecordset *m_pSet,*m_pSet2;
	CString typeName,pID,tempWhereis,subItem;
	CImageList *imageList;

	m_nTreeList->DeleteAllItems();

	imageList = new CImageList();
	imageList->Create(16,16,ILC_COLOR32,0,4);
	imageList->Add(AfxGetApp()->LoadIcon(IDI_ICON1));
	imageList->Add(AfxGetApp()->LoadIcon(IDI_ICON2));
	imageList->Add(AfxGetApp()->LoadIcon(IDI_ICON3));

	HTREEITEM hParentItem,hSubItem;

	m_nTreeList->SetImageList(imageList,TVSIL_NORMAL);

	m_pSet = mydata->getTableRecordset(_T("types"),_T(" WHERE PID = 0 "));
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("Name"),typeName);
			m_pSet->GetFieldValue(_T("CID"),pID);

			hParentItem = m_nTreeList->InsertItem(typeName,NULL,2);
			//处理下一级菜单
			tempWhereis.Format(_T(" WHERE PID = %s "), pID );
			m_pSet2 = mydata->getTableRecordset(_T("types"),tempWhereis);
			if (!m_pSet2->IsEOF())
			{
				m_pSet2->MoveFirst();
				while (!m_pSet2->IsEOF())
				{
					m_pSet2->GetFieldValue(_T("Name"),subItem);
					hSubItem = m_nTreeList->InsertItem(subItem,hParentItem,TVI_LAST);
					m_nTreeList->SetItemImage(hSubItem,1,1);
					m_pSet2->MoveNext();
				}
			}
			//处理下一级菜单结束
			m_pSet->MoveNext();
		}
	}
	m_pSet->Close();

}

void CLeftView::OnNMClick(NMHDR *pNMHDR, LRESULT *pResult)
{
	// TODO: 在此添加控件通知处理程序代码
	*pResult = 0;

}

void CLeftView::OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMTREEVIEW pNMTreeView = reinterpret_cast<LPNMTREEVIEW>(pNMHDR);
	*pResult = 0;
	

	HTREEITEM hItem = m_nTreeList->GetSelectedItem();
	HTREEITEM hParent = m_nTreeList->GetParentItem(hItem);
	if (hItem != NULL && hParent !=NULL )
	{

		CAccountantDoc *mainDoc=GetDocument();
		mainDoc->m_nCurrentItem=m_nTreeList->GetItemText(hItem);
		mainDoc->UpdateAllViews(this);
		//MessageBox(_T("是子分类"));
	}
}
