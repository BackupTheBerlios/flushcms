// VoucherAdd.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "VoucherAdd.h"


// CVoucherAdd 对话框

IMPLEMENT_DYNAMIC(CVoucherAdd, CDialog)

CVoucherAdd::CVoucherAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CVoucherAdd::IDD, pParent)
	, m_nAccountTypeID(_T(""))
	, m_nCreateDate(COleDateTime::GetCurrentTime())
	, m_iAmount(0)
	, m_nDebit(_T(""))
	, m_nMoney(_T(""))
	, m_nMemo(_T(""))
	, m_bIsSubmit(false)
	, m_bUpdateModel(false)
{

}

CVoucherAdd::~CVoucherAdd()
{
}

void CVoucherAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_CBString(pDX, IDC_COMBO1, m_nAccountTypeID);
	DDX_Control(pDX, IDC_COMBO1, m_nAccountTypeIDCtrl);
	DDX_DateTimeCtrl(pDX, IDC_DATETIMEPICKER1, m_nCreateDate);
	DDX_Control(pDX, IDC_DATETIMEPICKER1, m_nCreateDateCtrl);
	DDX_Text(pDX, IDC_EDIT1, m_iAmount);
	DDX_CBString(pDX, IDC_COMBO2, m_nDebit);
	DDX_Control(pDX, IDC_COMBO2, m_nDebitCtrl);
	DDX_Text(pDX, IDC_EDIT2, m_nMoney);
	DDX_Text(pDX, IDC_EDIT3, m_nMemo);
	DDX_Control(pDX, IDC_EDIT2, m_nMoneyCtrl);
}


BEGIN_MESSAGE_MAP(CVoucherAdd, CDialog)
	ON_BN_CLICKED(IDOK, &CVoucherAdd::OnBnClickedOk)
END_MESSAGE_MAP()


// CVoucherAdd 消息处理程序

BOOL CVoucherAdd::OnInitDialog()
{
	CDialog::OnInitDialog();

	CLanguage::TranslateDialog(this->m_hWnd, MAKEINTRESOURCE(IDD_VOUCHER_ADD));

	// TODO:  在此添加额外的初始化
	m_nDebitCtrl.InsertString(0,_T("借"));
	m_nDebitCtrl.InsertString(1,_T("贷"));
	m_nDebitCtrl.SelectString(0,_T("借"));
	if (m_iAmount==0)
	{
		m_iAmount=1;
	}
	//初始化科目分类
	CRecordset *m_pSet;
	CString tmpStr;
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("AccountType"),_T(" WHERE Display='是' ORDER BY OrderID "));
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int i=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("Title"),tmpStr);
			m_nAccountTypeIDCtrl.InsertString(i,tmpStr);
			m_pSet->MoveNext();
			i++;
		}
		m_nAccountTypeIDCtrl.SetCurSel(0);
	}
	m_pSet->Close();
	UpdateData(false);
	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}

void CVoucherAdd::OnBnClickedOk()
{
	// 点击确定事件处理
	UpdateData(true);
	if (m_nMoney=="")
	{
		MessageBox(_T("请输入金额"),_T("请检查您的输入！"));
		m_nMoneyCtrl.SetFocus();
		return;
	}
	m_bIsSubmit=true;
	OnOK();
}
