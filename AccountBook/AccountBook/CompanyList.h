#pragma once

#include "HHideListCtrl.h"
#include "afxcmn.h"
#include "afxwin.h"


// CCompanyList 窗体视图

class CCompanyList : public CFormView
{
	DECLARE_DYNCREATE(CCompanyList)

protected:
	CCompanyList();           // 动态创建所使用的受保护的构造函数
	virtual ~CCompanyList();

public:
	enum { IDD = IDD_COMPANY_LIST };
#ifdef _DEBUG
	virtual void AssertValid() const;
#ifndef _WIN32_WCE
	virtual void Dump(CDumpContext& dc) const;
#endif
#endif

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	afx_msg void OnBnClickedButtonAdd();
public:
	HHideListCtrl m_nCompanyList;
public:
	virtual void OnInitialUpdate();
public:
	void DrawList(void);
public:
	afx_msg void OnBnClickedButtonDel();
public:
	afx_msg void OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult);
public:
	CComboBox m_nCurrentCompanyCtrl;
public:
	CString m_nCurrentCompany;
public:
	afx_msg void OnBnClickedButtonCurrent();
};


