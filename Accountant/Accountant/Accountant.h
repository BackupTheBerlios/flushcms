// Accountant.h : Accountant Ӧ�ó������ͷ�ļ�
//
#pragma once

#ifndef __AFXWIN_H__
	#error "�ڰ������ļ�֮ǰ������stdafx.h�������� PCH �ļ�"
#endif

#include "resource.h"       // ������


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
};

extern CAccountantApp theApp;