#pragma once


// CTypeInputDlg 对话框

class CTypeInputDlg : public CDialog
{
	DECLARE_DYNAMIC(CTypeInputDlg)

public:
	CTypeInputDlg(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CTypeInputDlg();

// 对话框数据
	enum { IDD = ID_ADD_TYPE };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	CString m_nTypeName;
public:
	afx_msg void OnBnClickedOk();
protected:
	virtual void OnOK();
public:
	bool m_nClickButton;
};
