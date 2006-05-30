#pragma once
#include "afxext.h"
#include "afxcmn.h"
#include "HHideListCtrl.h"


// CAccountSort 对话框

class CAccountSort : public CDialog
{
	DECLARE_DYNAMIC(CAccountSort)

public:
	CAccountSort(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CAccountSort();

// 对话框数据
	enum { IDD = IDD_ACCOUNT_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
public:
	CToolBarCtrl m_nToolBar;
public:
	HHideListCtrl m_nAccountTypeList;
public:
	afx_msg void OnBnClickedButton1();
public:
	void DrawList(void);
public:
	afx_msg void OnLvnItemActivateAccountTypeList(NMHDR *pNMHDR, LRESULT *pResult);
public:
	afx_msg void OnBnClickedButton2();
};
