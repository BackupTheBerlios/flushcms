// Accountant.h : Accountant Ӧ�ó������ͷ�ļ�
//
#pragma once

#ifndef __AFXWIN_H__
	#error "�ڰ������ļ�֮ǰ������stdafx.h�������� PCH �ļ�"
#endif

#include "resource.h"       // ������
#include "mydatabase.h"


// CAccountantApp:
// �йش����ʵ�֣������ Accountant.cpp
//

class CAccountantApp : public CWinApp
{
public:
	CAccountantApp();


// ��д
public:
	virtual BOOL InitInstance();

// ʵ��
	afx_msg void OnAppAbout();
	DECLARE_MESSAGE_MAP()
public:
	CMyDatabase *mydata;
public:
	virtual BOOL PreTranslateMessage(MSG* pMsg);
};

extern CAccountantApp theApp;