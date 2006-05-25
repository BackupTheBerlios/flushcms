#pragma once
#include "afxwin.h"
#include "afxdtctl.h"


// CVoucherAdd �Ի���

class CVoucherAdd : public CDialog
{
	DECLARE_DYNAMIC(CVoucherAdd)

public:
	CVoucherAdd(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CVoucherAdd();

// �Ի�������
	enum { IDD = IDD_VOUCHER_ADD };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	CString m_nAccountTypeID;
public:
	CComboBox m_nAccountTypeIDCtrl;
public:
	COleDateTime m_nCreateDate;
public:
	CDateTimeCtrl m_nCreateDateCtrl;
public:
	int m_iAmount;
public:
	CString m_nDebit;
public:
	CComboBox m_nDebitCtrl;
public:
	CString m_nMoney;
public:
	CString m_nMemo;
public:
	virtual BOOL OnInitDialog();
};
