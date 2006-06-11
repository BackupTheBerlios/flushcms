#pragma once

#include "HHideListCtrl.h"
#include "reportmanx1.h"



// CVouchers 窗体视图

class CVouchers : public CFormView
{
	DECLARE_DYNCREATE(CVouchers)

protected:
	CVouchers();           // 动态创建所使用的受保护的构造函数
	virtual ~CVouchers();

public:
	enum { IDD = IDD_VOUCHKER };
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
	HHideListCtrl m_nVoucherList;
public:
	virtual void OnInitialUpdate();
public:
	afx_msg void OnBnClickedButton1();
public:
	void DrawList(void);
public:
	afx_msg void OnBnClickedButton2();
public:
	afx_msg void OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult);
public:
	COleDateTime m_nSelectDate;
public:
	afx_msg void OnDtnDatetimechangeDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult);
public:
	bool m_bDateChange;

public:
	afx_msg void OnBnClickedRepVoucherDetail();
public:
	CReportmanx1 m_nReport;
public:
	CString m_nCompanyID;
public:
	afx_msg void OnBnClickedReportYear();
public:
	afx_msg void OnBnClickedReportMonth();
public:
	CString m_nCurrentCompanyName;
};


