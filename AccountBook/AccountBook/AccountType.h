#pragma once



// CAccountType ������ͼ

class CAccountType : public CFormView
{
	DECLARE_DYNCREATE(CAccountType)

protected:
	CAccountType();           // ��̬������ʹ�õ��ܱ����Ĺ��캯��
	virtual ~CAccountType();

public:
	enum { IDD = IDD_ACCOUNT_TYPE };
#ifdef _DEBUG
	virtual void AssertValid() const;
#ifndef _WIN32_WCE
	virtual void Dump(CDumpContext& dc) const;
#endif
#endif

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
};


