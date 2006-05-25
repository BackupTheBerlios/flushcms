// VoucherAdd.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "VoucherAdd.h"


// CVoucherAdd 对话框

IMPLEMENT_DYNAMIC(CVoucherAdd, CDialog)

CVoucherAdd::CVoucherAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CVoucherAdd::IDD, pParent)
{

}

CVoucherAdd::~CVoucherAdd()
{
}

void CVoucherAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
}


BEGIN_MESSAGE_MAP(CVoucherAdd, CDialog)
END_MESSAGE_MAP()


// CVoucherAdd 消息处理程序
