// LeftView.cpp : CLeftView 类的实现
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"
#include "LeftView.h"
#include "MyDatabase.h"
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
END_MESSAGE_MAP()


// CLeftView 构造/析构

CLeftView::CLeftView()
{
	// TODO: 在此处添加构造代码
}

CLeftView::~CLeftView()
{
	mydata->m_nDatabase->Close();
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
	mydata = new CMyDatabase();

	drawTreeList();

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
		m_nTreeList->InsertItem(dlg->m_nTypeName,NULL,NULL);
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
	UpdateData(FALSE);
	UpdateWindow();
	drawTreeList();
}

void CLeftView::drawTreeList(void)
{
	//CMyDatabase *mydata;
	m_nTreeList = &GetTreeCtrl();

	CRecordset *m_pSet;
	CString typeName;
	CImageList *imageList;

	m_nTreeList->DeleteAllItems();

	imageList = new CImageList();
	imageList->Create(16,16,ILC_COLORDDB,0,4);
	imageList->Add(AfxGetApp()->LoadIcon(IDI_ICON2));

	m_nTreeList->SetImageList(imageList,TVSIL_NORMAL);

	m_pSet = mydata->getTableRecordset(_T("types"));
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("Name"),typeName);


			m_nTreeList->InsertItem(typeName,NULL,NULL);
			m_pSet->MoveNext();
		}
	}

}
