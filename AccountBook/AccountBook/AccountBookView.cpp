// AccountBookView.cpp : CAccountBookView ���ʵ��
//

#include "stdafx.h"
#include "AccountBook.h"

#include "AccountBookDoc.h"
#include "AccountBookView.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountBookView

IMPLEMENT_DYNCREATE(CAccountBookView, CListView)

BEGIN_MESSAGE_MAP(CAccountBookView, CListView)
	ON_WM_STYLECHANGED()
END_MESSAGE_MAP()

// CAccountBookView ����/����

CAccountBookView::CAccountBookView()
{
	// TODO: �ڴ˴���ӹ������

}

CAccountBookView::~CAccountBookView()
{
}

BOOL CAccountBookView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: �ڴ˴�ͨ���޸�
	//  CREATESTRUCT cs ���޸Ĵ��������ʽ

	return CListView::PreCreateWindow(cs);
}

void CAccountBookView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: ���� GetListCtrl() ֱ�ӷ��� ListView ���б�ؼ���
	//  �Ӷ������������ ListView��
}


// CAccountBookView ���

#ifdef _DEBUG
void CAccountBookView::AssertValid() const
{
	CListView::AssertValid();
}

void CAccountBookView::Dump(CDumpContext& dc) const
{
	CListView::Dump(dc);
}

CAccountBookDoc* CAccountBookView::GetDocument() const // �ǵ��԰汾��������
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountBookDoc)));
	return (CAccountBookDoc*)m_pDocument;
}
#endif //_DEBUG


// CAccountBookView ��Ϣ�������
void CAccountBookView::OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct)
{
	//TODO: ��Ӵ�������Ӧ�û��Դ�����ͼ��ʽ�ĸ���	
	CListView::OnStyleChanged(nStyleType,lpStyleStruct);	
}
