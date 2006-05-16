// AccountantView.cpp : CAccountantView ���ʵ��
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

// CAccountantView ����/����

CAccountantView::CAccountantView()
: m_nPID(0)
{
	// TODO: �ڴ˴���ӹ������

}

CAccountantView::~CAccountantView()
{
}

BOOL CAccountantView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: �ڴ˴�ͨ���޸�
	//  CREATESTRUCT cs ���޸Ĵ��������ʽ

	return CListView::PreCreateWindow(cs);
}

void CAccountantView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: ���� GetListCtrl() ֱ�ӷ��� ListView ���б�ؼ���
	//  �Ӷ������������ ListView��
	m_nList = & GetListCtrl();


	m_nDataBase = theApp.mydata;

	//CMainFrame* MainFrame=(CMainFrame*)::AfxGetMainWnd();
	//CLeftView* postView=(CLeftView*)MainFrame->m_wndSplitter.GetPane(0,0);


	long        lStyleOld;
	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= LVS_REPORT   ;
	SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );

	m_nList->SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE   );

	m_nList->InsertColumn(0,_T("����"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(1,_T("�Ա�"),LVCFMT_LEFT,40);
	m_nList->InsertColumn(2,_T("�绰"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(3,_T("�ֻ�����"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(4,_T("��ַ"),LVCFMT_LEFT,250);


}


// CAccountantView ���

#ifdef _DEBUG
void CAccountantView::AssertValid() const
{
	CListView::AssertValid();
}

void CAccountantView::Dump(CDumpContext& dc) const
{
	CListView::Dump(dc);
}

CAccountantDoc* CAccountantView::GetDocument() const // �ǵ��԰汾��������
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountantDoc)));
	return (CAccountantDoc*)m_pDocument;
}
#endif //_DEBUG


// CAccountantView ��Ϣ�������
void CAccountantView::OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct)
{
	//TODO: ��Ӵ�������Ӧ�û��Դ�����ͼ��ʽ�ĸ���	
	CListView::OnStyleChanged(nStyleType,lpStyleStruct);	
}

void CAccountantView::OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult)
{
	//��Ӧ�Ҽ��¼�
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
	//������ϵ��
	
	//ȡ���󴰿ڵĵ������
	CAccountantDoc *mainDoc= GetDocument();
	m_nPID = mainDoc->m_nPID;

	//��ϵ������Ի���
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
	// TODO: �ڴ����ר�ô����/����û���
	//�г��������ϵ��
	drawList();

}

void CAccountantView::drawList(void)
{
	//ȡ���󴰿ڵĵ������
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
	// ˫����б�����ϵ����ϸ��Ϣ
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nList->GetItemText(pNMIA->iItem,0);

	//ȡ���󴰿ڵĵ������
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
	// ɾ����ѡ����ϵ��
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
	// �ػ��б�
	drawList();

}

void CAccountantView::OnKeyDown(UINT nChar, UINT nRepCnt, UINT nFlags)
{
	// ������̰���delete������Ӧ
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
			MessageBox(_T("��ѡ����Ҫɾ������ϵ��"));
		}
		else
		{
			OnDelSelectPerson();
		}
	}

	CListView::OnKeyDown(nChar, nRepCnt, nFlags);
}
