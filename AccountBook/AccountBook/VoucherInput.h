#pragma once
#include "afxcmn.h"


// CVoucherInput �Ի���

class CVoucherInput : public CDialog
{
	DECLARE_DYNAMIC(CVoucherInput)

public:
	CVoucherInput(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CVoucherInput();

// �Ի�������
	enum { IDD = IDD_VOUCHKER };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
public:
	CListCtrl m_nVoucherList;
};
