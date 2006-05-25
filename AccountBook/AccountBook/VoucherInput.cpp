// VoucherInput.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "VoucherInput.h"
#include "VoucherAdd.h"

#define VOUCHER_LEN 6
typedef struct ListHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel voucherHeaderLabel[VOUCHER_LEN]=
{
	_T("����"),120,
	_T("ƾ֤���"),80,
	_T("��Ŀ"),120,
	_T("���"),40,
	_T("���"),80,
	_T("����"),120
};

// CVoucherInput �Ի���

IMPLEMENT_DYNAMIC(CVoucherInput, CDialog)

CVoucherInput::CVoucherInput(CWnd* pParent /*=NULL*/)
	: CDialog(CVoucherInput::IDD, pParent)
{

}

CVoucherInput::~CVoucherInput()
{
}

void CVoucherInput::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_nVoucherList);
}


BEGIN_MESSAGE_MAP(CVoucherInput, CDialog)
	ON_BN_CLICKED(IDC_BUTTON1, &CVoucherInput::OnBnClickedButton1)
END_MESSAGE_MAP()


// CVoucherInput ��Ϣ�������

BOOL CVoucherInput::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	for (int i=0;i<VOUCHER_LEN;i++)
	{
		m_nVoucherList.InsertColumn(i,voucherHeaderLabel[i].title,LVCFMT_LEFT,voucherHeaderLabel[i].len);
	}


	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

void CVoucherInput::OnBnClickedButton1()
{
	// ����ƾ֤
	CVoucherAdd *voucherAddDlg = new CVoucherAdd();
	voucherAddDlg->DoModal();
}
