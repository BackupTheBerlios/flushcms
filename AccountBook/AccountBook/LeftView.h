// LeftView.h : CLeftView ��Ľӿ�
//


#pragma once
#include "afxcmn.h"

class CAccountBookDoc;

class CLeftView : public CTreeView
{
protected: // �������л�����
	CLeftView();
	DECLARE_DYNCREATE(CLeftView)

// ����
public:
	CAccountBookDoc* GetDocument();

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
	void DrawTreeList(void);
public:
	afx_msg void OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult);
};

#ifndef _DEBUG  // LeftView.cpp �еĵ��԰汾
inline CAccountBookDoc* CLeftView::GetDocument()
   { return reinterpret_cast<CAccountBookDoc*>(m_pDocument); }
#endif

