#pragma once
#include "afxwin.h"
#include "mydatabase.h"


// CPersonInput 对话框

class CPersonInput : public CDialog
{
	DECLARE_DYNAMIC(CPersonInput)

public:
	CPersonInput(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CPersonInput();

// 对话框数据
	enum { IDD = IDD_PERSON_DIALOG };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	afx_msg void OnBnClickedOk();
public:
	CString m_nUserName;
public:
	CString m_nSex;
public:
	CString m_nPID;
public:
	COleDateTime m_nBirthDay;
public:
	CString m_nProvince;
public:
	CString m_nCity;
public:
	CString m_nTel;
public:
	CString m_nMobile;
public:
	CString m_nAddr;
public:
	CEdit m_nUserNameCtrl;
public:
	CComboBox m_nSexCtrl;
public:
	CEdit m_nTelCtrl;
public:
	CEdit m_nMobileCtrl;
public:
	CEdit m_nAddrCtrl;
public:
	virtual BOOL OnInitDialog();
public:
	CComboBox m_nPIDCtrl;
public:
	CMyDatabase *m_nDataBase;
public:
	bool m_nIsSubmit;
public:
	CComboBox m_nProvinceCtrl;
public:
	CComboBox m_nCityCtrl;
public:
	afx_msg void OnCbnSelchangePeovince();
public:
	CString m_nCompany;
public:
	CString m_nMeno;
public:
	CButton m_nSubmitButtonCtrl;
public:
	bool m_nUpdateMode;
};
