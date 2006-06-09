#pragma once

#include "HHideListCtrl.h"

// CAccountTypes ������ͼ

class CAccountTypes : public CFormView
{
	DECLARE_DYNCREATE(CAccountTypes)

protected:
	CAccountTypes();           // ��̬������ʹ�õ��ܱ����Ĺ��캯��
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
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	virtual void OnInitialUpdate();
public:
	HHideListCtrl m_nAccountTypeList;
protected:
	virtual void OnDraw(CDC* /*pDC*/);
};


