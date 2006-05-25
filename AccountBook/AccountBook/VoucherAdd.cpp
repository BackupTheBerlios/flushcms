// VoucherAdd.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "VoucherAdd.h"


// CVoucherAdd �Ի���

IMPLEMENT_DYNAMIC(CVoucherAdd, CDialog)

CVoucherAdd::CVoucherAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CVoucherAdd::IDD, pParent)
	, m_nAccountTypeID(_T(""))
	, m_nCreateDate(COleDateTime::GetCurrentTime())
	, m_iAmount(0)
	, m_nDebit(_T(""))
	, m_nMoney(_T(""))
	, m_nMemo(_T(""))
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
}


BEGIN_MESSAGE_MAP(CVoucherAdd, CDialog)
END_MESSAGE_MAP()


// CVoucherAdd ��Ϣ�������

BOOL CVoucherAdd::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	m_nDebitCtrl.InsertString(0,_T("��"));
	m_nDebitCtrl.InsertString(1,_T("��"));
	m_nDebitCtrl.SelectString(0,_T("��"));
	if (m_iAmount==0)
	{
		m_iAmount=1;
	}
	//��ʼ����Ŀ����
	CRecordset *m_pSet;
	CString tmpStr;
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("AccountType"),_T(" WHERE Display='��' ORDER BY OrderID "));
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
	}
	m_pSet->Close();
	UpdateData(false);
	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}
