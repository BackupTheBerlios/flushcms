// AccountantDoc.cpp : CAccountantDoc 类的实现
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


// CAccountantDoc 构造/析构

CAccountantDoc::CAccountantDoc()
: m_nPID(0)
, m_nCurrentItem(_T(""))
{
	// TODO: 在此添加一次性构造代码

}

CAccountantDoc::~CAccountantDoc()
{
}

BOOL CAccountantDoc::OnNewDocument()
{
	if (!CDocument::OnNewDocument())
		return FALSE;

	// TODO: 在此添加重新初始化代码
	// (SDI 文档将重用该文档)

	return TRUE;
}




// CAccountantDoc 序列化

void CAccountantDoc::Serialize(CArchive& ar)
{
	if (ar.IsStoring())
	{
		// TODO: 在此添加存储代码
	}
	else
	{
		// TODO: 在此添加加载代码
	}
}


// CAccountantDoc 诊断

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


// CAccountantDoc 命令
