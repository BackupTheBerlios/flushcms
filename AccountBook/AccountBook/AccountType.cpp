// AccountType.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountType.h"


// CAccountType

IMPLEMENT_DYNCREATE(CAccountType, CFormView)

CAccountType::CAccountType()
	: CFormView(CAccountType::IDD)
{

}

CAccountType::~CAccountType()
{
}

void CAccountType::DoDataExchange(CDataExchange* pDX)
{
	CFormView::DoDataExchange(pDX);
}

BEGIN_MESSAGE_MAP(CAccountType, CFormView)
END_MESSAGE_MAP()


// CAccountType ���

#ifdef _DEBUG
void CAccountType::AssertValid() const
{
	CFormView::AssertValid();
}

#ifndef _WIN32_WCE
void CAccountType::Dump(CDumpContext& dc) const
{
	CFormView::Dump(dc);
}
#endif
#endif //_DEBUG


// CAccountType ��Ϣ�������
