// AccountantView.cpp : CAccountantView ���ʵ��
//

#include "stdafx.h"
#include "Accountant.h"

#include "AccountantDoc.h"
#include "AccountantView.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#endif


// CAccountantView

IMPLEMENT_DYNCREATE(CAccountantView, CListView)

BEGIN_MESSAGE_MAP(CAccountantView, CListView)
	ON_WM_STYLECHANGED()
END_MESSAGE_MAP()

// CAccountantView ����/����

CAccountantView::CAccountantView()
{
	// TODO: �ڴ˴���ӹ������

}

CAccountantView::~CAccountantView()
{
}

BOOL CAccountantView::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: �ڴ˴�ͨ���޸�
	//  CREATESTRUCT cs ���޸Ĵ��������ʽ

	return CListView::PreCreateWindow(cs);
}

void CAccountantView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: ���� GetListCtrl() ֱ�ӷ��� ListView ���б�ؼ���
	//  �Ӷ������������ ListView��
}


// CAccountantView ���

#ifdef _DEBUG
void CAccountantView::AssertValid() const
{
	CListView::AssertValid();
}

void CAccountantView::Dump(CDumpContext& dc) const
{
	CListView::Dump(dc);
}

CAccountantDoc* CAccountantView::GetDocument() const // �ǵ��԰汾��������
{
	ASSERT(m_pDocument->IsKindOf(RUNTIME_CLASS(CAccountantDoc)));
	return (CAccountantDoc*)m_pDocument;
}
#endif //_DEBUG


// CAccountantView ��Ϣ�������
void CAccountantView::OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct)
{
	//TODO: ��Ӵ�������Ӧ�û��Դ�����ͼ��ʽ�ĸ���	
	CListView::OnStyleChanged(nStyleType,lpStyleStruct);	
}
