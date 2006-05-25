// AccountAdd.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountAdd.h"


// CAccountAdd 对话框

IMPLEMENT_DYNAMIC(CAccountAdd, CDialog)

CAccountAdd::CAccountAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CAccountAdd::IDD, pParent)
	, m_nNumberID(_T(""))
	, m_nTitle(_T(""))
	, m_nOrderID(_T(""))
	, m_nDisplay(FALSE)
{

}

CAccountAdd::~CAccountAdd()
{
}

void CAccountAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_EDIT1, m_nNumberID);
	DDX_Control(pDX, IDC_EDIT1, m_nNumberIDCtrl);
	DDX_Text(pDX, IDC_EDIT2, m_nTitle);
	DDX_Control(pDX, IDC_EDIT2, m_nTitleCtrl);
	DDX_Text(pDX, IDC_EDIT3, m_nOrderID);
	DDX_Check(pDX, IDC_CHECK1, m_nDisplay);
}


BEGIN_MESSAGE_MAP(CAccountAdd, CDialog)
	ON_BN_CLICKED(IDOK, &CAccountAdd::OnBnClickedOk)
END_MESSAGE_MAP()


// CAccountAdd 消息处理程序

void CAccountAdd::OnBnClickedOk()
{
	// 点击确定事件处理
	UpdateData(true);

	if (m_nNumberID=="")
	{
		MessageBox(_T("请输入科目代码"),_T("请检查您的输入！"));
		m_nNumberIDCtrl.SetFocus();
		return;
	}
	if (m_nTitle=="")
	{
		MessageBox(_T("请输入科目名称"),_T("请检查您的输入！"));
		m_nTitleCtrl.SetFocus();
		return;
	}
	OnOK();
}
