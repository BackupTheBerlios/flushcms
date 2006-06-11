#pragma once
#include "afxdtctl.h"


// CReportYearSelect �Ի���

class CReportYearSelect : public CDialog
{
	DECLARE_DYNAMIC(CReportYearSelect)

public:
	CReportYearSelect(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CReportYearSelect();

// �Ի�������
	enum { IDD = IDD_REP_SELECT_YEAR };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	CDateTimeCtrl m_nYearSelectCtrl;
public:
	virtual BOOL OnInitDialog();
public:
	bool m_bIsMonth;
public:
	afx_msg void OnBnClickedOk();
public:
	bool m_bIsSubmint;
public:
	COleDateTime m_nYearSelect;
};
