#pragma once
#include "afxwin.h"


// CAccountAdd �Ի���

class CAccountAdd : public CDialog
{
	DECLARE_DYNAMIC(CAccountAdd)

public:
	CAccountAdd(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CAccountAdd();

// �Ի�������
	enum { IDD = IDD_ADD_ACCOUNT_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

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
	BOOL m_nDisplay;
public:
	afx_msg void OnBnClickedOk();
};
