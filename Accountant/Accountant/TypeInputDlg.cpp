// TypeInputDlg.cpp : 实现文件
//

#include "stdafx.h"
#include "Accountant.h"
#include "TypeInputDlg.h"


// CTypeInputDlg 对话框

IMPLEMENT_DYNAMIC(CTypeInputDlg, CDialog)

CTypeInputDlg::CTypeInputDlg(CWnd* pParent /*=NULL*/)
	: CDialog(CTypeInputDlg::IDD, pParent)
	, m_nTypeName(_T(""))
	, m_nClickButton(false)
{

}

CTypeInputDlg::~CTypeInputDlg()
{
}

void CTypeInputDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_TYPE_NAME, m_nTypeName);
}


BEGIN_MESSAGE_MAP(CTypeInputDlg, CDialog)
	ON_BN_CLICKED(IDOK, &CTypeInputDlg::OnBnClickedOk)
END_MESSAGE_MAP()


// CTypeInputDlg 消息处理程序

void CTypeInputDlg::OnBnClickedOk()
{
	// TODO: ÔÚ´ËÌí¼Ó¿Ø¼þÍ¨Öª´¦Àí³ÌÐò´úÂë
	m_nClickButton=true;
	OnOK();
}

void CTypeInputDlg::OnOK()
{
	// TODO: ÔÚ´ËÌí¼Ó×¨ÓÃ´úÂëºÍ/»òµ÷ÓÃ»ùÀà
	UpdateData(true);

	if (m_nTypeName=="")
	{
		MessageBox(_T("分类名称不能为空"),_T("请检查您的输入！"));
		return;
		
	}
	UpdateData(FALSE);
	CDialog::OnOK();
}
