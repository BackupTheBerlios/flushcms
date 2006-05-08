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
	, m_nPTypeVal(_T(""))
{

}

CTypeInputDlg::~CTypeInputDlg()
{
}

void CTypeInputDlg::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_TYPE_NAME, m_nTypeName);
	DDX_Control(pDX, IDC_P_TYPE, m_nPTypeCtl);
	DDX_CBString(pDX, IDC_P_TYPE, m_nPTypeVal);
	DDX_Control(pDX, IDC_TYPE_NAME, m_nTypeNameCtl);
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

	if (m_nPTypeVal=="")
	{
		MessageBox(_T("请选择上级分类"),_T("请检查您的输入！"));
		m_nPTypeCtl.SetFocus();
		
		return;
		
	}
	if (m_nTypeName=="")
	{
		MessageBox(_T("分类名称不能为空"),_T("请检查您的输入！"));
		m_nTypeNameCtl.SetFocus();
		return;

	}
	CDialog::OnOK();
}

BOOL CTypeInputDlg::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  ÔÚ´ËÌí¼Ó¶îÍâµÄ³õÊ¼»¯
	//m_nPTypeCtl.InsertString(0,_T("无"));
	//m_nPTypeCtl.InsertString(1,_T("中华人民共和国"));

	return TRUE;  // return TRUE unless you set the focus to a control
	// Òì³£: OCX ÊôÐÔÒ³Ó¦·µ»Ø FALSE
}
