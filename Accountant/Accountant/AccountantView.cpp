// AccountantView.cpp : CAccountantView 类的实现
//

#include "stdafx.h"
#include "Accountant.h"

#include "MainFrm.h"
#include "LeftView.h"

#include "AccountantDoc.h"
#include "AccountantView.h"

#include "PersonInput.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountantView

IMPLEMENT_DYNCREATE(CAccountantView, CListView)

BEGIN_MESSAGE_MAP(CAccountantView, CListView)
	ON_WM_STYLECHANGED()
	ON_NOTIFY_REFLECT(NM_RCLICK, &CAccountantView::OnNMRclick)
	ON_COMMAND(ID_ID2_32781, &CAccountantView::OnAddPerson)
	ON_NOTIFY_REFLECT(LVN_ITEMACTIVATE, &CAccountantView::OnLvnItemActivate)
	ON_COMMAND(ID_ID2_32782, &CAccountantView::OnDelSelectPerson)
	ON_WM_KEYDOWN()
END_MESSAGE_MAP()

// CAccountantView 构造/析构

CAccountantView::CAccountantView()
: m_nPID(0)
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
	m_nList = & GetListCtrl();


	m_nDataBase = theApp.mydata;

	//CMainFrame* MainFrame=(CMainFrame*)::AfxGetMainWnd();
	//CLeftView* postView=(CLeftView*)MainFrame->m_wndSplitter.GetPane(0,0);


	long        lStyleOld;
	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= LVS_REPORT   ;
	SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );

	m_nList->SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE   );

	m_nList->InsertColumn(0,_T("姓名"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(1,_T("性别"),LVCFMT_LEFT,40);
	m_nList->InsertColumn(2,_T("电话"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(3,_T("手机号码"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(4,_T("地址"),LVCFMT_LEFT,250);


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

void CAccountantView::OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult)
{
	//响应右键事件
	*pResult = 0;

	CMenu *myMenu,*dispMenu;
	CPoint point;
	GetCursorPos(&point);

	myMenu = new CMenu();
	dispMenu = new CMenu();
	myMenu->LoadMenu(IDR_MENU1);
	dispMenu = myMenu->GetSubMenu(1);

	int nCount = m_nList->GetItemCount();
	BOOL fCheck = false;
	for (int i=0;i < nCount;i++)
	{
		if (m_nList->GetCheck(i))
		{
			fCheck = true;
			break;
		}
	}
	if (!fCheck)
	{
		dispMenu->EnableMenuItem(ID_ID2_32782,MF_GRAYED);
	}

	dispMenu->TrackPopupMenu(TPM_LEFTALIGN |TPM_RIGHTBUTTON,point.x,point.y, this);

}

void CAccountantView::OnAddPerson()
{
	//新增联系人
	
	//取得左窗口的点击内容
	CAccountantDoc *mainDoc= GetDocument();
	m_nPID = mainDoc->m_nPID;

	//联系人输入对话框
	CPersonInput *personDlg=new CPersonInput();
	personDlg->m_nPID=mainDoc->m_nCurrentItem;
	personDlg->DoModal();
	if (personDlg->m_nUserName!="" && personDlg->m_nIsSubmit==true)
	{
		int pid = m_nDataBase->getTypesID(personDlg->m_nPID);
		CString sqlStr,tmpStr,dlgDate;
		dlgDate.Format(_T("%d-%d-%d"),personDlg->m_nBirthDay.GetYear(),personDlg->m_nBirthDay.GetMonth(),personDlg->m_nBirthDay.GetDay());
		sqlStr.Format(_T("INSERT INTO person (PID,Name,Sex,Phone,Mobile,Birthday,Province,City,Addr,Company,Memo) VALUES(%d,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')"),pid,personDlg->m_nUserName,personDlg->m_nSex,personDlg->m_nTel,personDlg->m_nMobile,dlgDate,personDlg->m_nProvince,personDlg->m_nCity,personDlg->m_nAddr,personDlg->m_nCompany,personDlg->m_nMeno);

		tmpStr=sqlStr;
		m_nDataBase->doActionQuery(tmpStr);
	}
	drawList();

}

void CAccountantView::OnDraw(CDC* /*pDC*/)
{

}

void CAccountantView::OnUpdate(CView* /*pSender*/, LPARAM /*lHint*/, CObject* /*pHint*/)
{
	// TODO: 在此添加专用代码和/或调用基类
	//列出分类的联系人
	drawList();

}

void CAccountantView::drawList(void)
{
	//取得左窗口的点击内容
	CAccountantDoc *mainDoc= GetDocument();
	CString pItem;
	pItem=	mainDoc->m_nCurrentItem;
	if (pItem!="")
	{
		m_nList->DeleteAllItems();
		int PID = m_nDataBase->getTypesID(pItem);
		CRecordset *m_pSet;
		CString whereIs,typeName;
		if (PID)
		{
			whereIs.Format(_T(" WHERE PID = %d "),PID);
		}
		else
		{
			whereIs=_T("");
		}

		m_pSet = m_nDataBase->getTableRecordset(_T("person"),whereIs);
		if (!m_pSet->IsEOF())
		{
			m_pSet->MoveFirst();
			int x=0;
			while (!m_pSet->IsEOF())
			{
				m_pSet->GetFieldValue(_T("Name"),typeName);
				m_nList->InsertItem(x,typeName);
				m_pSet->GetFieldValue(_T("Sex"),typeName);
				m_nList->SetItemText(x,1,typeName);
				m_pSet->GetFieldValue(_T("Phone"),typeName);
				m_nList->SetItemText(x,2,typeName);
				m_pSet->GetFieldValue(_T("Mobile"),typeName);
				m_nList->SetItemText(x,3,typeName);
				m_pSet->GetFieldValue(_T("Addr"),typeName);
				m_nList->SetItemText(x,4,typeName);
				x++;
				m_pSet->MoveNext();
			}
		}
	}
}

void CAccountantView::OnLvnItemActivate(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// 双点击列表弹出联系人详细信息
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nList->GetItemText(pNMIA->iItem,0);

	//取得左窗口的点击内容
	CAccountantDoc *mainDoc= GetDocument();
	CString pItem;
	pItem=	mainDoc->m_nCurrentItem;


	CPersonInput *personDlg=new CPersonInput();

	CRecordset *m_pSet;
	CString sql,typeStr;
	COleDateTime birthday;

	sql.Format(_T(" WHERE Name = '%s' "),selectItem);
	m_pSet = m_nDataBase->getTableRecordset(_T("person"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		m_pSet->GetFieldValue(_T("Name"),typeStr);
		personDlg->m_nUserName=typeStr;

		m_pSet->GetFieldValue(_T("Sex"),typeStr);
		personDlg->m_nSex=typeStr;

		personDlg->m_nPID=pItem;

		m_pSet->GetFieldValue(_T("Birthday"),typeStr);
		birthday.ParseDateTime(typeStr);
		personDlg->m_nBirthDay=birthday;


		m_pSet->GetFieldValue(_T("Phone"),typeStr);
		personDlg->m_nTel=typeStr;

		m_pSet->GetFieldValue(_T("Mobile"),typeStr);
		personDlg->m_nMobile=typeStr;

		m_pSet->GetFieldValue(_T("Province"),typeStr);
		personDlg->m_nProvince=typeStr;

		m_pSet->GetFieldValue(_T("City"),typeStr);
		personDlg->m_nCity=typeStr;

		m_pSet->GetFieldValue(_T("Addr"),typeStr);
		personDlg->m_nAddr=typeStr;

		m_pSet->GetFieldValue(_T("Company"),typeStr);
		personDlg->m_nCompany=typeStr;

		m_pSet->GetFieldValue(_T("Memo"),typeStr);
		personDlg->m_nMeno=typeStr;


	}

	personDlg->m_nUpdateMode=true;
	personDlg->DoModal();
	if (personDlg->m_nUserName!="" && personDlg->m_nIsSubmit==true)
	{
		int pid = m_nDataBase->getTypesID(personDlg->m_nPID);
		CString sqlStr,tmpStr,dlgDate;
		dlgDate.Format(_T("%d-%d-%d"),personDlg->m_nBirthDay.GetYear(),personDlg->m_nBirthDay.GetMonth(),personDlg->m_nBirthDay.GetDay());
		sqlStr.Format(_T(" UPDATE person SET PID=%d,Sex='%s',Phone='%s',Mobile='%s',Birthday='%s',Province='%s',City='%s',Addr='%s',Company='%s',Memo='%s' WHERE Name='%s' "),pid,personDlg->m_nSex,personDlg->m_nTel,personDlg->m_nMobile,dlgDate,personDlg->m_nProvince,personDlg->m_nCity,personDlg->m_nAddr,personDlg->m_nCompany,personDlg->m_nMeno,personDlg->m_nUserName);

		tmpStr=sqlStr;
		m_nDataBase->doActionQuery(tmpStr);
	}
	drawList();


}

void CAccountantView::OnDelSelectPerson()
{
	// 删除所选的联系人
	int nCount = m_nList->GetItemCount();
	CString delUserName,delString;
	for (int i=0;i < nCount;i++)
	{
		if (m_nList->GetCheck(i))
		{
			delUserName=m_nList->GetItemText(i,0);
			delString.Format(_T(" DELETE FROM person WHERE Name='%s' "),delUserName);
			m_nDataBase->doActionQuery(delString);
		}
	}
	// 重绘列表
	drawList();

}

void CAccountantView::OnKeyDown(UINT nChar, UINT nRepCnt, UINT nFlags)
{
	// 处理键盘按下delete键的响应
	if (nChar==VK_DELETE)
	{
		int nCount = m_nList->GetItemCount();
		BOOL fCheck = false;
		for (int i=0;i < nCount;i++)
		{
			if (m_nList->GetCheck(i))
			{
				fCheck = true;
				break;
			}
		}
		if (!fCheck)
		{
			MessageBox(_T("请选择你要删除的联系人"));
		}
		else
		{
			OnDelSelectPerson();
		}
	}

	CListView::OnKeyDown(nChar, nRepCnt, nFlags);
}
