// LeftView.h : CLeftView ��Ľӿ�
//


#pragma once
#include "afxcmn.h"
#include "mydatabase.h"

class CAccountantDoc;

class CLeftView : public CTreeView
{
protected: // �������л�����
	CLeftView();
	DECLARE_DYNCREATE(CLeftView)

// ����
public:
	CAccountantDoc* GetDocument();

// ����
public:

// ��д
	public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
	protected:
	virtual void OnInitialUpdate(); // ������һ�ε���

// ʵ��
public:
	virtual ~CLeftView();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// ���ɵ���Ϣӳ�亯��
protected:
	DECLARE_MESSAGE_MAP()
public:
	CTreeCtrl *m_nTreeList;
public:
	afx_msg void OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult);
public:
	afx_msg void OnId32776();
public:
	afx_msg void OnIdDelType();
public:
	CMyDatabase *mydata;
public:
	afx_msg void OnId32780();
public:
	void drawTreeList(void);
public:
	afx_msg void OnNMClick(NMHDR *pNMHDR, LRESULT *pResult);
};

#ifndef _DEBUG  // LeftView.cpp �еĵ��԰汾
inline CAccountantDoc* CLeftView::GetDocument()
   { return reinterpret_cast<CAccountantDoc*>(m_pDocument); }
#endif

