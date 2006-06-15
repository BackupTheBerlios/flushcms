// CompanyAdd.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "CompanyAdd.h"


// CCompanyAdd 对话框

IMPLEMENT_DYNAMIC(CCompanyAdd, CDialog)

CCompanyAdd::CCompanyAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CCompanyAdd::IDD, pParent)
	, m_nCompanyName(_T(""))
	, m_nPhone(_T(""))
	, m_nCompanyAddr(_T(""))
	, m_bIsSubmint(false)
	, m_bUpdateModel(false)
{

}

CCompanyAdd::~CCompanyAdd()
{
}

void CCompanyAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_EDIT1, m_nCompanyNameCtrl);
	DDX_Text(pDX, IDC_EDIT1, m_nCompanyName);
	DDX_Control(pDX, IDC_EDIT2, m_nPhoneCtrl);
	DDX_Text(pDX, IDC_EDIT2, m_nPhone);
	DDX_Control(pDX, IDC_EDIT4, m_nCompanyAddrCtrl);
	DDX_Text(pDX, IDC_EDIT4, m_nCompanyAddr);
}


BEGIN_MESSAGE_MAP(CCompanyAdd, CDialog)
	ON_BN_CLICKED(IDOK, &CCompanyAdd::OnBnClickedOk)
END_MESSAGE_MAP()


// CCompanyAdd 消息处理程序

void CCompanyAdd::OnBnClickedOk()
{
	// TODO: 在此添加控件通知处理程序代码
	UpdateData(true);
	CString please_input,shuldbe_fill;
	please_input = CLanguage::TranslateString(IDS_CHECK_YOUR_INPUT);
	shuldbe_fill = CLanguage::TranslateString(IDS_CHECK_PLEASE_INPUT);

	if (m_nCompanyName=="")
	{
		MessageBox(shuldbe_fill+CLanguage::TranslateString(IDS_COMPANY_HEAD1),please_input);
		m_nCompanyNameCtrl.SetFocus();
		return;
	}
	m_bIsSubmint=true;

	OnOK();
}

BOOL CCompanyAdd::OnInitDialog()
{
	CDialog::OnInitDialog();
	CLanguage::TranslateDialog(this->m_hWnd, MAKEINTRESOURCE(IDD_COMPANY_ADD));

	// TODO:  在此添加额外的初始化

	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}
