#pragma once
#include "afxwin.h"


// CCompanyAdd �Ի���

class CCompanyAdd : public CDialog
{
	DECLARE_DYNAMIC(CCompanyAdd)

public:
	CCompanyAdd(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CCompanyAdd();

// �Ի�������
	enum { IDD = IDD_COMPANY_ADD };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	CEdit m_nCompanyNameCtrl;
public:
	CString m_nCompanyName;
public:
	CEdit m_nPhoneCtrl;
public:
	CString m_nPhone;
public:
	CEdit m_nCompanyAddrCtrl;
public:
	CString m_nCompanyAddr;
public:
	bool m_bIsSubmint;
public:
	bool m_bUpdateModel;
public:
	afx_msg void OnBnClickedOk();
};
