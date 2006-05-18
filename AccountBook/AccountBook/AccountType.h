#pragma once



// CAccountType 窗体视图

class CAccountType : public CFormView
{
	DECLARE_DYNCREATE(CAccountType)

protected:
	CAccountType();           // 动态创建所使用的受保护的构造函数
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
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
};


