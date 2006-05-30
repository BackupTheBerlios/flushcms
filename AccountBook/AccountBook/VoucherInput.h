#pragma once
#include "afxcmn.h"
#include "HHideListCtrl.h"


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
	HHideListCtrl m_nVoucherList;
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
//	afx_msg void OnNMThemeChangedDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult);
public:
	afx_msg void OnDtnDatetimechangeDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult);
public:
	bool m_bDateChange;
};
