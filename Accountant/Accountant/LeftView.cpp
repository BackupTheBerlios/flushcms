// LeftView.cpp : CLeftView 类的实现
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"
#include "LeftView.h"
#include "MyDatabase.h"
#include "TypeInputDlg.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CLeftView

IMPLEMENT_DYNCREATE(CLeftView, CTreeView)

BEGIN_MESSAGE_MAP(CLeftView, CTreeView)
	ON_NOTIFY_REFLECT(NM_RCLICK, &CLeftView::OnNMRclick)
	ON_COMMAND(ID_ID_32776, &CLeftView::OnId32776)
	ON_COMMAND(ID_ID_DEL_TYPE, &CLeftView::OnIdDelType)
	ON_COMMAND(ID_ID_32780, &CLeftView::OnId32780)
END_MESSAGE_MAP()


// CLeftView 构造/析构

CLeftView::CLeftView()
{
	// TODO: 在此处添加构造代码
}

CLeftView::~CLeftView()
{
	mydata->m_nDatabase->Close();
}

BOOL CLeftView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: 在此处