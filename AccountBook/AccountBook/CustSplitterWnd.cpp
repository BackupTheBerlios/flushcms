// CustSplitterWnd.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "CustSplitterWnd.h"


// CCustSplitterWnd

IMPLEMENT_DYNCREATE(CCustSplitterWnd, CSplitterWnd)

CCustSplitterWnd::CCustSplitterWnd()
{

}

CCustSplitterWnd::~CCustSplitterWnd()
{
}


BEGIN_MESSAGE_MAP(CCustSplitterWnd, CSplitterWnd)
END_MESSAGE_MAP()


// CCustSplitterWnd 消息处理程序

bool CCustSplitterWnd::ReplaceView(int row, int col, CRuntimeClass *pViewClass, SIZE size)
{
	CCreateContext context;
	BOOL bSetActive;


	if ((GetPane(row,col)->IsKindOf(pViewClass))==TRUE)
		return FALSE;


	// Get pointer to CDocument object so that it can be used in the creation 
	// process of the new view
	CDocument * pDoc= ((CView *)GetPane(row,col))->GetDocument();
	CView * pActiveView=GetParentFrame()->GetActiveView();
	if (pActiveView==NULL || pActiveView==GetPane(row,col))
		bSetActive=TRUE;
	else
		bSetActive=FALSE;

	// set flag so that document will not be deleted when view is destroyed
	pDoc->m_bAutoDelete=FALSE;    
	// Delete existing view 
	((CView *) GetPane(row,col))->DestroyWindow();
	// set flag back to default 
	pDoc->m_bAutoDelete=TRUE;

	// Create new view                      

	context.m_pNewViewClass=pViewClass;
	context.m_pCurrentDoc=pDoc;
	context.m_pNewDocTemplate=NULL;
	context.m_pLastView=NULL;
	context.m_pCurrentFrame=NULL;

	CreateView(row,col,pViewClass,size, &context);

	CView * pNewView= (CView *)GetPane(row,col);

	if (bSetActive==TRUE)
		GetParentFrame()->SetActiveView(pNewView);

	RecalcLayout(); 
	GetPane(row,col)->SendMessage(WM_PAINT);
	pNewView->OnInitialUpdate();

	return TRUE;
}
