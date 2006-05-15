// AccountBookDoc.cpp : CAccountBookDoc 类的实现
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


// CAccountBookDoc 构造/析构

CAccountBookDoc::CAccountBookDoc()
{
	// TODO: 在此添加一次性构造代码

}

CAccountBookDoc::~CAccountBookDoc()
{
}

BOOL CAccountBookDoc::OnNewDocument()
{
	if (!CDocument::OnNewDocument())
		return FALSE;

	// TODO: 在此添加重新初始化代码
	// (SDI 文档将重用该文档)

	return TRUE;
}




// CAccountBookDoc 序列化

void CAccountBookDoc::Serialize(CArchive& ar)
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


// CAccountBookDoc 诊断

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


// CAccountBookDoc 命令
