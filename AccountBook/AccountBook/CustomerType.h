#pragma once
#include "afxcmn.h"


// CCustomerType 对话框

class CCustomerType : public CDialog
{
	DECLARE_DYNAMIC(CCustomerType)

public:
	CCustomerType(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CCustomerType();

// 对话框数据
	enum { IDD = IDD_CUSTOMER_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
public:
	CListCtrl m_nList;
public:
	afx_msg void OnBnClickedButton1();
};
