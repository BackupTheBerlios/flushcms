// ReportYearSelect.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "ReportYearSelect.h"


// CReportYearSelect �Ի���

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


// CReportYearSelect ��Ϣ�������

BOOL CReportYearSelect::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	if (m_bIsMonth)
	{
		m_nYearSelectCtrl.SetFormat(_T("yyyy-MM"));
	} 
	else
	{
		m_nYearSelectCtrl.SetFormat(_T("yyyy"));
	}

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE

}

void CReportYearSelect::OnBnClickedOk()
{
	// TODO: �ڴ���ӿؼ�֪ͨ����������
	m_bIsSubmint=true;
	OnOK();
}
