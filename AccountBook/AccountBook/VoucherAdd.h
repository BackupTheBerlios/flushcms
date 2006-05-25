#pragma once


// CVoucherAdd 对话框

class CVoucherAdd : public CDialog
{
	DECLARE_DYNAMIC(CVoucherAdd)

public:
	CVoucherAdd(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CVoucherAdd();

// 对话框数据
	enum { IDD = IDD_VOUCHER_ADD };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
};
