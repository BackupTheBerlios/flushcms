// AccountantDoc.cpp : CAccountantDoc ���ʵ��
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountantDoc

IMPLEMENT_DYNCREATE(CAccountantDoc, CDocument)

BEGIN_MESSAGE_MAP(CAccountantDoc, CDocument)
END_MESSAGE_MAP()


// CAccountantDoc ����/����

CAccountantDoc::CAccountantDoc()
: m_nPID(0)
, m_nCurrentItem(_T(""))
{
	// TODO: �ڴ����һ���Թ������

}

CAccountantDoc::~CAccountantDoc()
{
}

BOOL CAccountantDoc::OnNewDocument()
{
	if (!CDocument::OnNewDocument())
		return FALSE;

	// TODO: �ڴ�������³�ʼ������
	// (SDI �ĵ������ø��ĵ�)

	return TRUE;
}




// CAccountantDoc ���л�

void CAccountantDoc::Serialize(CArchive& ar)
{
	if (ar.IsStoring())
	{
		// TODO: �ڴ���Ӵ洢����
	}
	else
	{
		// TODO: �ڴ���Ӽ��ش���
	}
}


// CAccountantDoc ���

#ifdef _DEBUG
void CAccountantDoc::AssertValid() const
{
	CDocument::AssertValid();
}

void CAccountantDoc::Dump(CDumpContext& dc) const
{
	CDocument::Dump(dc);
}
#endif //_DEBUG


// CAccountantDoc ����
