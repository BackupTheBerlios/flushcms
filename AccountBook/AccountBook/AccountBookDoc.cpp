// AccountBookDoc.cpp : CAccountBookDoc ���ʵ��
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountBookDoc

IMPLEMENT_DYNCREATE(CAccountBookDoc, CDocument)

BEGIN_MESSAGE_MAP(CAccountBookDoc, CDocument)
END_MESSAGE_MAP()


// CAccountBookDoc ����/����

CAccountBookDoc::CAccountBookDoc()
{
	// TODO: �ڴ����һ���Թ������

}

CAccountBookDoc::~CAccountBookDoc()
{
}

BOOL CAccountBookDoc::OnNewDocument()
{
	if (!CDocument::OnNewDocument())
		return FALSE;

	// TODO: �ڴ�������³�ʼ������
	// (SDI �ĵ������ø��ĵ�)

	return TRUE;
}




// CAccountBookDoc ���л�

void CAccountBookDoc::Serialize(CArchive& ar)
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


// CAccountBookDoc ���

#ifdef _DEBUG
void CAccountBookDoc::AssertValid() const
{
	CDocument::AssertValid();
}

void CAccountBookDoc::Dump(CDumpContext& dc) const
{
	CDocument::Dump(dc);
}
#endif //_DEBUG


// CAccountBookDoc ����
