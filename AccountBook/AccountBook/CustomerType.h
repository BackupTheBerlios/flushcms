#pragma once
#include "afxcmn.h"


// CCustomerType �Ի���

class CCustomerType : public CDialog
{
	DECLARE_DYNAMIC(CCustomerType)

public:
	CCustomerType(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CCustomerType();

// �Ի�������
	enum { IDD = IDD_CUSTOMER_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
public:
	CListCtrl m_nList;
public:
	afx_msg void OnBnClickedButton1();
};
