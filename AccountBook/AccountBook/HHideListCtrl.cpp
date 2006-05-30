// HHideListCtrl.cpp : implementation file
//

#include "stdafx.h"
#include "HHideListCtrl.h"

#ifdef _DEBUG
#define new DEBUG_NEW
#undef THIS_FILE
static char THIS_FILE[] = __FILE__;
#endif

/////////////////////////////////////////////////////////////////////////////
// HHideListCtrl

HHideListCtrl::HHideListCtrl()
{
}

HHideListCtrl::~HHideListCtrl()
{
}


BEGIN_MESSAGE_MAP(HHideListCtrl, CListCtrl)
	//{{AFX_MSG_MAP(HHideListCtrl)
	//}}AFX_MSG_MAP
END_MESSAGE_MAP()

/////////////////////////////////////////////////////////////////////////////
// HHideListCtrl message handlers

void HHideListCtrl::PreSubclassWindow() 
{
	ASSERT( GetStyle() & LVS_REPORT );
	
	CListCtrl::PreSubclassWindow();
	VERIFY( m_ctlHeader.SubclassWindow( GetHeaderCtrl()->GetSafeHwnd() ) );
}


int HHideListCtrl::InsertColumn(int nCol, const LVCOLUMN *pColumn)
{
	return InsertColumn(nCol, pColumn, FALSE);
}

int HHideListCtrl::InsertColumn(int nCol, const LVCOLUMN *pColumn, BOOL bHide)
{
	int nReturn = CListCtrl::InsertColumn(nCol, pColumn);
	if(nReturn>=0){
		SColumn sColumn;
		sColumn.bHide = bHide;
		sColumn.nItemWidth = pColumn->cx;
		m_ctlHeader.m_aColum.Add(sColumn);
	}
	return nReturn;
}

int HHideListCtrl::InsertColumn(int nCol, LPCTSTR lpszColumnHeading, int nFormat, int nWidth, int nSubItem)
{
	return InsertColumn(nCol,lpszColumnHeading, FALSE, nFormat, nWidth, nSubItem);
}

int HHideListCtrl::InsertColumn(int nCol, LPCTSTR lpszColumnHeading, BOOL bHide, 
								int nFormat, int nWidth, int nSubItem)
{
	int nReturn = CListCtrl::InsertColumn(nCol, lpszColumnHeading, nFormat, nWidth, nSubItem);
	if(nReturn>=0){
		SColumn sColumn;
		//sColumn.bHide = bHide;
		sColumn.nItemWidth = nWidth;
		m_ctlHeader.m_aColum.Add(sColumn);
		if(bHide){			//�����п������Ϊ 0
			SetColumnHide(nCol, TRUE);
		}
		m_ctlHeader.m_aColum[nCol].bHide = bHide;
		
	}
	return nReturn;
}

BOOL HHideListCtrl::DeleteColumn(int nCol)
{
	BOOL bReturn = CListCtrl::DeleteColumn(nCol);
	if(bReturn){
		m_ctlHeader.m_aColum.RemoveAt(nCol, 1);
	}
	return bReturn;
}
//����ĳ���Ƿ����ء�������óɹ�������>=0��==0:ԭ�������صģ� ==1:ԭ������ʾ��
int HHideListCtrl::SetColumnHide(int nCol, BOOL bHide)
{
	int nColumnCount = m_ctlHeader.GetItemCount();
	if(nCol<0 || nCol>=nColumnCount) return -1;
	int nHideReturn = m_ctlHeader.m_aColum[nCol].bHide;
	m_ctlHeader.m_aColum[nCol].bHide = bHide;
	if(bHide){		//������
		//if(m_ctlHeader.m_aColum[nCol].bHide) return nHideReturn;
		m_ctlHeader.m_aColum[nCol].nItemWidth = GetColumnWidth(nCol);
		SetColumnWidth(nCol, 0);
	} else {		//����ʾ
		SetColumnWidth(nCol, m_ctlHeader.m_aColum[nCol].nItemWidth);
	}
	return nHideReturn;
}
