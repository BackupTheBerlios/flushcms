// AccountTypes.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountTypes.h"

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

}

void CAccountTypes::OnDraw(CDC* /*pDC*/)
{
	// 画图

}
