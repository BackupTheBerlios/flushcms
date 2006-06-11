// CompanyList.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "CompanyList.h"
#include "CompanyAdd.h"

#define ACCOUNT_TYPES_LEN 4

typedef struct CompanyHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel accountTypeLabel[ACCOUNT_TYPES_LEN]=
{
	_T("公司名称"),200,
	_T("ID"),20,
	_T("电话"),120,
	_T("地址"),200,
};

// CCompanyList

IMPLEMENT_DYNCREATE(CCompanyList, CFormView)

CCompanyList::CCompanyList()
	: CFormView(CCompanyList::IDD)
	, m_nCurrentCompany(_T(""))
{

}

CCompanyList::~CCompanyList()
{
}

void CCompanyList::DoDataExchange(CDataExchange* pDX)
{
	CFormView::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_nCompanyList);
	DDX_Control(pDX, IDC_COMBO1, m_nCurrentCompanyCtrl);
	DDX_CBString(pDX, IDC_COMBO1, m_nCurrentCompany);
}

BEGIN_MESSAGE_MAP(CCompanyList, CFormView)
	ON_BN_CLICKED(IDC_BUTTON_ADD, &CCompanyList::OnBnClickedButtonAdd)
	ON_BN_CLICKED(IDC_BUTTON_DEL, &CCompanyList::OnBnClickedButtonDel)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_LIST1, &CCompanyList::OnLvnItemActivateList1)
	ON_BN_CLICKED(IDC_BUTTON_CURRENT, &CCompanyList::OnBnClickedButtonCurrent)
END_MESSAGE_MAP()


// CCompanyList 诊断

#ifdef _DEBUG
void CCompanyList::AssertValid() const
{
	CFormView::AssertValid();
}

#ifndef _WIN32_WCE
void CCompanyList::Dump(CDumpContext& dc) const
{
	CFormView::Dump(dc);
}
#endif
#endif //_DEBUG


// CCompanyList 消息处理程序

void CCompanyList::OnBnClickedButtonAdd()
{
	// TODO: 在此添加控件通知处理程序代码
	//添加科目
	CCompanyAdd *addDlg = new CCompanyAdd();
	addDlg->DoModal();
	if (addDlg->m_bIsSubmint)
	{
		CString sql;
		sql.Format(_T(" INSERT INTO Company (CompanyName,Phone,Addr) VALUES ('%s','%s','%s') "),addDlg->m_nCompanyName,addDlg->m_nPhone,addDlg->m_nCompanyAddr);
		theApp.m_nDatabase->doActionQuery(sql);
		DrawList();
	}

}

void CCompanyList::OnInitialUpdate()
{
	CFormView::OnInitialUpdate();

	// TODO: 在此添加专用代码和/或调用基类
	// 初始化
	m_nCompanyList.SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_CHECKBOXES|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE);
	for (int i=0;i<ACCOUNT_TYPES_LEN;i++)
	{
		m_nCompanyList.InsertColumn(i,accountTypeLabel[i].title,LVCFMT_LEFT,accountTypeLabel[i].len);
	}
	m_nCompanyList.SetColumnHide(1, TRUE);

	LPCTSTR fileName=_T(".\\config.ini");
	CString str;
	GetPrivateProfileString(_T("data"),_T("current_company"),NULL,str.GetBuffer(254),254,fileName); 
	m_nCurrentCompany=str;

	DrawList();

}

void CCompanyList::DrawList(void)
{
	CRecordset *m_pSet;
	CString tmpStr,filedName[ACCOUNT_TYPES_LEN]={
		_T("CompanyName"),
		_T("CompanyID"),
		_T("Phone"),
		_T("Addr")
	};

	m_pSet=theApp.m_nDatabase->getTableRecordset(_T("Company"),_T(" ORDER BY CompanyID "));
	m_nCompanyList.DeleteAllItems();
	m_nCurrentCompanyCtrl.ResetContent();

	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int x=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("CompanyName"),tmpStr);
			m_nCompanyList.InsertItem(x,tmpStr);
			m_nCurrentCompanyCtrl.AddString(tmpStr);
			for (int i=1;i<ACCOUNT_TYPES_LEN;i++)
			{
				m_pSet->GetFieldValue(filedName[i],tmpStr);
				m_nCompanyList.SetItemText(x,i,tmpStr);

			}
			x++;
			m_pSet->MoveNext();
		}
	}
	m_nCurrentCompanyCtrl.SelectString(1,m_nCurrentCompany);
	m_pSet->Close();
}

void CCompanyList::OnBnClickedButtonDel()
{
	// TODO: 在此添加控件通知处理程序代码
	// 删除所选
	int nCount = m_nCompanyList.GetItemCount();
	CString delItem,delString,str;
	str.Format(_T("确认删除所选? "));
	if (AfxMessageBox(str,MB_YESNO)==IDYES)
	{
		for (int i=0;i < nCount;i++)
		{
			if (m_nCompanyList.GetCheck(i))
			{
				delItem=m_nCompanyList.GetItemText(i,1);
				delString.Format(_T(" DELETE FROM Company WHERE CompanyID=%s "),delItem);
				theApp.m_nDatabase->doActionQuery(delString);
			}
		}
		// 重绘列表
		DrawList();
	}

}

void CCompanyList::OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// TODO: 在此添加控件通知处理程序代码

	// 修改科目
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nCompanyList.GetItemText(pNMIA->iItem,1);

	CRecordset *m_pSet;
	CString sql,tmpStr,currentID;

	CCompanyAdd *addDlg = new CCompanyAdd();

	sql.Format(_T(" WHERE CompanyID = %s "),selectItem);
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("Company"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();

		m_pSet->GetFieldValue(_T("CompanyName"),tmpStr);
		addDlg->m_nCompanyName=tmpStr;

		m_pSet->GetFieldValue(_T("Phone"),tmpStr);
		addDlg->m_nPhone=tmpStr;

		m_pSet->GetFieldValue(_T("Addr"),tmpStr);
		addDlg->m_nCompanyAddr=tmpStr;

		m_pSet->GetFieldValue(_T("CompanyID"),currentID);

	}
	m_pSet->Close();
	addDlg->m_bUpdateModel=true;
	addDlg->DoModal();

	if (addDlg->m_bIsSubmint)
	{
		sql.Format(_T(" UPDATE Company SET CompanyName='%s',Phone='%s',Addr='%s' WHERE CompanyID=%s "),addDlg->m_nCompanyName,addDlg->m_nPhone,addDlg->m_nCompanyAddr,currentID);
		theApp.m_nDatabase->doActionQuery(sql);
	}
	DrawList();

}

void CCompanyList::OnBnClickedButtonCurrent()
{
	// TODO: 在此添加控件通知处理程序代码
	UpdateData(true);
	WritePrivateProfileString(_T("data"),_T("current_company"),m_nCurrentCompany,_T(".\\config.ini"));
}
