// AccountBook.h : AccountBook Ӧ�ó������ͷ�ļ�
//
#pragma once

#ifndef __AFXWIN_H__
	#error "�ڰ������ļ�֮ǰ������stdafx.h�������� PCH �ļ�"
#endif

#include "resource.h"       // ������


// CAccountBookApp:
// �йش����ʵ�֣������ AccountBook.cpp
//

class CAccountBookApp : public CWinApp
{
public:
	CAccountBookApp();


// ��д
public:
	virtual BOOL InitInstance();

// ʵ��
	afx_msg void OnAppAbout();
	DECLARE_MESSAGE_MAP()
public:
	void DisplayFormView(void);
};

extern CAccountBookApp theApp;