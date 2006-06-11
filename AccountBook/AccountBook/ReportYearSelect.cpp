// ReportYearSelect.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "ReportYearSelect.h"


// CReportYearSelect 对话框

IMPLEMENT_DYNAMIC(CReportYearSelect, CDialog)

CReportYearSelect::CReportYearSelect(CWnd* pParent /*=NULL*/)
	: CDialog(CReportYearSelect::IDD, pParent)
	, m_bIsMonth(false)
	, m_bIsSubmint(false)
	, m_nYearSelect(COleDateTime::GetCurrentTime())
{

}

CReportYearSelect::~CReportYearSelect()
{
}

void CReportYearSelect::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_DATETIMEPICKER1, m_nYearSelectCtrl);
	DDX_DateTimeCtrl(pDX, IDC_DATETIMEPICKER1, m_nYearSelect);
}


BEGIN_MESSAGE_MAP(CReportYearSelect, CDialog)
	ON_BN_CLICKED(IDOK, &CReportYearSelect::OnBnClickedOk)
END_MESSAGE_MAP()


// CReportYearSelect 消息处理程序

BOOL CReportYearSelect::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  在此添加额外的初始化
	if (m_bIsMonth)
	{
		m_nYearSelectCtrl.SetFormat(_T("yyyy-MM"));
	} 
	else
	{
		m_nYearSelectCtrl.SetFormat(_T("yyyy"));
	}

	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE

}

void CReportYearSelect::OnBnClickedOk()
{
	// TODO: 在此添加控件通知处理程序代码
	m_bIsSubmint=true;
	OnOK();
}
