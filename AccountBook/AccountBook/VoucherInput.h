#pragma once
#include "afxcmn.h"


// CVoucherInput 对话框

class CVoucherInput : public CDialog
{
	DECLARE_DYNAMIC(CVoucherInput)

public:
	CVoucherInput(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CVoucherInput();

// 对话框数据
	enum { IDD = IDD_VOUCHKER };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
public:
	CListCtrl m_nVoucherList;
};
