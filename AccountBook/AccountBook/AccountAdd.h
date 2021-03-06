#pragma once
#include "afxwin.h"


// CAccountAdd 对话框

class CAccountAdd : public CDialog
{
	DECLARE_DYNAMIC(CAccountAdd)

public:
	CAccountAdd(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CAccountAdd();

// 对话框数据
	enum { IDD = IDD_ADD_ACCOUNT_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	CString m_nNumberID;
public:
	CEdit m_nNumberIDCtrl;
public:
	CString m_nTitle;
public:
	CEdit m_nTitleCtrl;
public:
	CString m_nOrderID;
public:
	afx_msg void OnBnClickedOk();
public:
	bool m_bIsSubmint;
public:
	CString m_nDisplay;
public:
	CComboBox m_nDisplayCtrl;
public:
	virtual BOOL OnInitDialog();
public:
	bool m_bUpdateModel;
public:
	afx_msg void OnStnClickedStaticAccountTypeAdd3();
};
