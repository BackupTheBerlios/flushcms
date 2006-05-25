// VoucherInput.cpp : 实现文件
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
	_T("日期"),120,
	_T("凭证序号"),80,
	_T("科目"),120,
	_T("借贷"),40,
	_T("金额"),80,
	_T("描述"),120
};

// CVoucherInput 对话框

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


// CVoucherInput 消息处理程序

BOOL CVoucherInput::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  在此添加额外的初始化
	for (int i=0;i<VOUCHER_LEN;i++)
	{
		m_nVoucherList.InsertColumn(i,voucherHeaderLabel[i].title,LVCFMT_LEFT,voucherHeaderLabel[i].len);
	}


	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}

void CVoucherInput::OnBnClickedButton1()
{
	// 新增凭证
	CVoucherAdd *voucherAddDlg = new CVoucherAdd();
	voucherAddDlg->DoModal();
}
