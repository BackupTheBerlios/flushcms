// AccountTypes.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountTypes.h"
#include "AccountAdd.h"


#define ACCOUNT_TYPES_LEN 5

typedef struct ListHeaderLabels 
{
	CString title;
	int len;

}ListLabels;

ListLabels accountTypeLabels[ACCOUNT_TYPES_LEN]=
{
	_T("代码"),100,
	_T("ID"),20,
	_T("科目"),180,
	_T("显示"),60,
	_T("排序"),60
};

// CAccountTypes

IMPLEMENT_DYNCREATE(CAccountTypes, CFormView)

CAccountTypes::CAccountTypes()
	: CFormView(CAccountTypes::IDD)
{

}

CAccountTypes::~CAccountTypes()
{
}

void CAccountTypes::DoDataExchange(CDataExchange* pDX)
{
	CFormView::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_ACCOUNT_TYPE_LIST, m_nAccountTypeList);

}

BEGIN_MESSAGE_MAP(CAccountTypes, CFormView)
	ON_BN_CLICKED(IDC_BUTTON1, &CAccountTypes::OnBnClickedButton1)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_ACCOUNT_TYPE_LIST, &CAccountTypes::OnLvnItemActivateAccountTypeList)
	ON_BN_CLICKED(IDC_BUTTON2, &CAccountTypes::OnBnClickedButton2)
END_MESSAGE_MAP()


// CAccountTypes 诊断

#ifdef _DEBUG
void CAccountTypes::AssertValid() const
{
	CFormView::AssertValid();
}

#ifndef _WIN32_WCE
void CAccountTypes::Dump(CDumpContext& dc) const
{
	CFormView::Dump(dc);
}
#endif
#endif //_DEBUG


// CAccountTypes 消息处理程序

void CAccountTypes::OnInitialUpdate()
{
	CFormView::OnInitialUpdate();

	// 初始化
	m_nAccountTypeList.SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_CHECKBOXES|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE);
	for (int i=0;i<ACCOUNT_TYPES_LEN;i++)
	{
		m_nAccountTypeList.InsertColumn(i,accountTypeLabels[i].title,LVCFMT_LEFT,accountTypeLabels[i].len);
	}
	m_nAccountTypeList.SetColumnHide(1, TRUE);
	DrawList();
}

void CAccountTypes::OnBnClickedButton1()
{
	//添加科目
	CAccountAdd *addDlg = new CAccountAdd();
	addDlg->DoModal();
	if (addDlg->m_bIsSubmint)
	{
		CString sql;
		sql.Format(_T(" INSERT INTO AccountType (NumberID,Title,Display,OrderID) VALUES (%s,'%s','%s',%s) "),addDlg->m_nNumberID,addDlg->m_nTitle,addDlg->m_nDisplay,addDlg->m_nOrderID );
		theApp.m_nDatabase->doActionQuery(sql);
		DrawList();
	}
}

void CAccountTypes::DrawList(void)
{
	CRecordset *m_pSet;
	CString tmpStr,filedName[ACCOUNT_TYPES_LEN]={
		_T("NumberID"),
		_T("AccountTypeID"),
		_T("Title"),
		_T("Display"),
		_T("OrderID")
	};

	m_pSet=theApp.m_nDatabase->getTableRecordset(_T("AccountType"),_T(" ORDER BY OrderID "));
	m_nAccountTypeList.DeleteAllItems();

	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int x=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("NumberID"),tmpStr);
			m_nAccountTypeList.InsertItem(x,tmpStr);
			for (int i=1;i<ACCOUNT_TYPES_LEN;i++)
			{
				m_pSet->GetFieldValue(filedName[i],tmpStr);
				m_nAccountTypeList.SetItemText(x,i,tmpStr);

			}
			x++;
			m_pSet->MoveNext();
		}
	}
	m_pSet->Close();

}

void CAccountTypes::OnLvnItemActivateAccountTypeList(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// 修改科目
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nAccountTypeList.GetItemText(pNMIA->iItem,1);

	CRecordset *m_pSet;
	CString sql,tmpStr,currentID;

	CAccountAdd *addDlg = new CAccountAdd();

	sql.Format(_T(" WHERE AccountTypeID = %s "),selectItem);
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("AccountType"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();

		m_pSet->GetFieldValue(_T("NumberID"),tmpStr);
		addDlg->m_nNumberID=tmpStr;

		m_pSet->GetFieldValue(_T("Title"),tmpStr);
		addDlg->m_nTitle=tmpStr;

		m_pSet->GetFieldValue(_T("Display"),tmpStr);
		addDlg->m_nDisplay=tmpStr;

		m_pSet->GetFieldValue(_T("OrderID"),tmpStr);
		addDlg->m_nOrderID=tmpStr;

		m_pSet->GetFieldValue(_T("AccountTypeID"),currentID);

	}
	m_pSet->Close();
	addDlg->m_bUpdateModel=true;
	addDlg->DoModal();

	if (addDlg->m_bIsSubmint)
	{
		sql.Format(_T(" UPDATE AccountType SET NumberID=%s,Title='%s',Display='%s',OrderID=%s WHERE AccountTypeID=%s "),addDlg->m_nNumberID,addDlg->m_nTitle,addDlg->m_nDisplay,addDlg->m_nOrderID,currentID);
		theApp.m_nDatabase->doActionQuery(sql);
	}
	DrawList();




}

void CAccountTypes::OnBnClickedButton2()
{
	// 删除所选
	int nCount = m_nAccountTypeList.GetItemCount();
	CString delItem,delString,str;
	str.Format(_T("确认删除所选? "));
	if (AfxMessageBox(str,MB_YESNO)==IDYES)
	{
		for (int i=0;i < nCount;i++)
		{
			if (m_nAccountTypeList.GetCheck(i))
			{
				delItem=m_nAccountTypeList.GetItemText(i,1);
				delString.Format(_T(" DELETE FROM AccountType WHERE AccountTypeID=%s "),delItem);
				theApp.m_nDatabase->doActionQuery(delString);
			}
		}
		// 重绘列表
		DrawList();
	}
}


void CAccountTypes::OnDraw(CDC* /*pDC*/)
{
	// 画图

}
