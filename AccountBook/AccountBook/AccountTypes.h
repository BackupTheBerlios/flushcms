#pragma once

#include "HHideListCtrl.h"

// CAccountTypes 窗体视图

class CAccountTypes : public CFormView
{
	DECLARE_DYNCREATE(CAccountTypes)

protected:
	CAccountTypes();           // 动态创建所使用的受保护的构造函数
	virtual ~CAccountTypes();

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
public:
	virtual void OnInitialUpdate();
public:
	HHideListCtrl m_nAccountTypeList;
protected:
	virtual void OnDraw(CDC* /*pDC*/);
};


