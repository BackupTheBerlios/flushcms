// MainView.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "MainView.h"


// CMainView

IMPLEMENT_DYNCREATE(CMainView, CView)

CMainView::CMainView()
{

}

CMainView::~CMainView()
{
}

BEGIN_MESSAGE_MAP(CMainView, CView)
END_MESSAGE_MAP()


// CMainView 绘图

void CMainView::OnDraw(CDC* pDC)
{
	CDocument* pDoc = GetDocument();
	// TODO: 在此添加绘制代码
	CBrush mybrush1;

	mybrush1.CreateSolidBrush(RGB(247,247,255));

	CRect myrect1;
	GetClientRect(&myrect1);

	pDC->FillRect(myrect1,&mybrush1);
	
	CFont font;
	VERIFY(font.CreateFont(
		24,                        // nHeight
		0,                         // nWidth
		0,                         // nEscapement
		0,                         // nOrientation
		FW_BOLD,                 // nWeight
		FALSE,                     // bItalic
		FALSE,                     // bUnderline
		0,                         // cStrikeOut
		ANSI_CHARSET,              // nCharSet
		OUT_DEFAULT_PRECIS,        // nOutPrecision
		CLIP_DEFAULT_PRECIS,       // nClipPrecision
		DEFAULT_QUALITY,           // nQuality
		DEFAULT_PITCH | FF_SWISS,  // nPitchAndFamily
		_T("Arial")));                 // lpszFacename

	pDC->SelectObject(&font);
	pDC->SetTextColor(RGB(0,0,255));
	pDC->SetBkMode(TRANSPARENT);
	pDC->TextOut(myrect1.Width()/2-150,myrect1.Height()/2-110,_T("会计助手2006"));

}


// CMainView 诊断

#ifdef _DEBUG
void CMainView::AssertValid() const
{
	CView::AssertValid();
}

#ifndef _WIN32_WCE
void CMainView::Dump(CDumpContext& dc) const
{
	CView::Dump(dc);
}
#endif
#endif //_DEBUG


// CMainView 消息处理程序
