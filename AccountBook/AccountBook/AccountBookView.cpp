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
	cs.style |=WS_MAXIMIZE;
	return CListView::PreCreateWindow(cs);
}

void CAccountBookView::OnInitialUpdate()
{
	CListView::OnInitialUpdate();


	// TODO: ���� GetListCtrl() ֱ�ӷ��� ListView ���б�ؼ���
	//  �Ӷ������������ ListView��
	//m_nList = & GetListCtrl();

	////�����б���
	//long        lStyleOld;
	//lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	//lStyleOld |= LVS_REPORT   ;
	//SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );
	//m_nList->SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE   );

	//m_nList->InsertColumn(0,_T("����"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(1,_T("�Ա�"),LVCFMT_LEFT,40);
	//m_nList->InsertColumn(2,_T("�绰"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(3,_T("�ֻ�����"),LVCFMT_LEFT,120);
	//m_nList->InsertColumn(4,_T("��ַ"),LVCFMT_LEFT,250);

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


void CAccountBookView::OnDraw(CDC* /*pDC*/)
{
	// TODO: �ڴ����ר�ô����/����û���
	//CAccountBookDoc *pDoc = GetDocument();
	//ASSERT_VALID(pDoc);
	//CDC *pDc = GetDC();

	//CBrush brush1;
	//brush1.CreateSolidBrush(RGB(0,0,255));
	//CRect rect1;
	//GetClientRect(&rect1);
	//
	//pDc->FillRect(rect1,&brush1);
	//pDc->TextOut(10, 10, _T("Hockey is Best!"));
}
