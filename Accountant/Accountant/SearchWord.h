#pragma once
#include "afxwin.h"


// CSearchWord �Ի���

class CSearchWord : public CDialog
{
	DECLARE_DYNAMIC(CSearchWord)

public:
	CSearchWord(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CSearchWord();

// �Ի�������
	enum { IDD = IDD_DIALOG1 };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	CString m_nSearchWord;
public:
	bool m_nIsSubmit;
public:
	virtual BOOL OnInitDialog();
public:
	CEdit m_nSearchWordCtrl;
public:
	afx_msg void OnBnClickedOk();
};
