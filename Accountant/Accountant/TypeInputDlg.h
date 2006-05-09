#pragma once
#include "afxwin.h"
#include "mydatabase.h"


// CTypeInputDlg �Ի���

class CTypeInputDlg : public CDialog
{
	DECLARE_DYNAMIC(CTypeInputDlg)

public:
	CTypeInputDlg(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CTypeInputDlg();

// �Ի�������
	enum { IDD = ID_ADD_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	CString m_nTypeName;
public:
	afx_msg void OnBnClickedOk();
protected:
	virtual void OnOK();
public:
	bool m_nClickButton;
public:
	virtual BOOL OnInitDialog();
public:
	CComboBox m_nPTypeCtl;
public:
	CString m_nPTypeVal;
public:
	CEdit m_nTypeNameCtl;
public:
	CMyDatabase *dlgDatabase;
};
