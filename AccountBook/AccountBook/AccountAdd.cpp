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
	, m_bIsSubmint(false)
	, m_nDisplay(_T(""))
	, m_bUpdateModel(false)
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
	DDX_CBString(pDX, IDC_COMBO1, m_nDisplay);
	DDX_Control(pDX, IDC_COMBO1, m_nDisplayCtrl);
}


BEGIN_MESSAGE_MAP(CAccountAdd, CDialog)
	ON_BN_CLICKED(IDOK, &CAccountAdd::OnBnClickedOk)
END_MESSAGE_MAP()


// CAccountAdd 消息处理程序

void CAccountAdd::OnBnClickedOk()
{
	// 点击确定事件处理
	UpdateData(true);
	CString please_input,shuldbe_fill;
	please_input = CLanguage::TranslateString(IDS_CHECK_YOUR_INPUT);
	shuldbe_fill = CLanguage::TranslateString(IDS_CHECK_PLEASE_INPUT);

	if (m_nNumberID=="")
	{
		MessageBox(shuldbe_fill+CLanguage::TranslateString(IDS_CATEGORY_CODE),please_input);
		m_nNumberIDCtrl.SetFocus();
		return;
	}
	if (m_nTitle=="")
	{
		MessageBox(shuldbe_fill+CLanguage::TranslateString(IDS_CATEGORY_NAME),please_input);
		m_nTitleCtrl.SetFocus();
		return;
	}
	m_bIsSubmint=true;
	OnOK();
}

BOOL CAccountAdd::OnInitDialog()
{
	CDialog::OnInitDialog();

	CLanguage::TranslateDialog(this->m_hWnd, MAKEINTRESOURCE(IDD_ADD_ACCOUNT_TYPE));
	// TODO:  在此添加额外的初始化
	CString str_yes,str_no;
	str_yes=CLanguage::TranslateString(IDS_STR_YES);
	str_no=CLanguage::TranslateString(IDS_STR_NO);
	m_nDisplayCtrl.InsertString(0,str_yes);
	m_nDisplayCtrl.InsertString(1,str_no);
	if (m_bUpdateModel)
	{
		m_nDisplayCtrl.SelectString(0,m_nDisplay);
	} 
	else
	{
		m_nDisplayCtrl.SelectString(0,str_yes);
	}

	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}
