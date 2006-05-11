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
	ON_NOTIFY_REFLECT(NM_RCLICK, &CAccountantView::OnNMRclick)
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
	m_nList = & GetListCtrl();

	long        lStyleOld;
	lStyleOld = GetWindowLong(m_hWnd, GWL_STYLE);
	lStyleOld |= LVS_REPORT   ;
	SetWindowLong(m_nList->m_hWnd,GWL_STYLE,lStyleOld );

	m_nList->SetExtendedStyle(m_nList->GetExtendedStyle()|LVS_EX_TRACKSELECT|LVS_EX_FULLROWSELECT|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_MULTIWORKAREAS|LVS_EX_ONECLICKACTIVATE   );

	m_nList->InsertColumn(0,_T("����"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(1,_T("�Ա�"),LVCFMT_LEFT,40);
	m_nList->InsertColumn(2,_T("�绰"),LVCFMT_LEFT,120);
	m_nList->InsertColumn(3,_T("��ַ"),LVCFMT_LEFT,250);

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

void CAccountantView::OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult)
{
	//��Ӧ�Ҽ��¼�
	*pResult = 0;

	CMenu *myMenu,*dispMenu;
	CPoint point;
	GetCursorPos(&point);

	myMenu = new CMenu();
	dispMenu = new CMenu();
	myMenu->LoadMenu(IDR_MENU1);
	dispMenu = myMenu->GetSubMenu(1);

	dispMenu->TrackPopupMenu(TPM_LEFTALIGN |TPM_RIGHTBUTTON,point.x,point.y, this);

}
