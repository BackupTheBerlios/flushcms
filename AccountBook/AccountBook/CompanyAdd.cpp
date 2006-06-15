// CompanyAdd.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "CompanyAdd.h"


// CCompanyAdd �Ի���

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


// CCompanyAdd ��Ϣ�������

void CCompanyAdd::OnBnClickedOk()
{
	// TODO: �ڴ���ӿؼ�֪ͨ����������
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

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}
