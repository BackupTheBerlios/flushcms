#pragma once


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
};
