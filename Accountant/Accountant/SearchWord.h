#pragma once
#include "afxwin.h"


// CSearchWord 对话框

class CSearchWord : public CDialog
{
	DECLARE_DYNAMIC(CSearchWord)

public:
	CSearchWord(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CSearchWord();

// 对话框数据
	enum { IDD = IDD_DIALOG1 };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

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
