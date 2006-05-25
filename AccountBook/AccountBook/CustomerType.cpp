// CustomerType.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "CustomerType.h"

#define MAX_LEN 2
typedef struct CustListHeaderLabel 
{
	CString title;
	int len;

}CustListLabel;

CustListLabel headerLabel[MAX_LEN]=
{
	_T("分类名称"),150,
	_T("显示"),80,
};


// CCustomerType 对话框

IMPLEMENT_DYNAMIC(CCustomerType, CDialog)

CCustomerType::CCustomerType(CWnd* pParent /*=NULL*/)
	: CDialog(CCustomerType::IDD, pParent)
{

}

CCustomerType::~CCustomerType()
{
}

void CCustomerType::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_DISPLAY_LIST, m_nList);
}


BEGIN_MESSAGE_MAP(CCustomerType, CDialog)
END_MESSAGE_MAP()


// CCustomerType 消息处理程序

BOOL CCustomerType::OnInitDialog()
{
	CDialog::OnInitDialog();

	for (int i=0;i<MAX_LEN;i++)
	{
		m_nList.InsertColumn(i,headerLabel[i].title,LVCFMT_LEFT,headerLabel[i].len);
	}

	return TRUE;  // return TRUE unless you set the focus to a control
}
