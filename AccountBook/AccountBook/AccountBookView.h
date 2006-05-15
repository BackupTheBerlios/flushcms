// AccountBookView.h : CAccountBookView ��Ľӿ�
//


#pragma once


class CAccountBookView : public CListView
{
protected: // �������л�����
	CAccountBookView();
	DECLARE_DYNCREATE(CAccountBookView)

// ����
public:
	CAccountBookDoc* GetDocument() const;

// ����
public:

// ��д
public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
protected:
	virtual void OnInitialUpdate(); // ������һ�ε���

// ʵ��
public:
	virtual ~CAccountBookView();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// ���ɵ���Ϣӳ�亯��
protected:
	afx_msg void OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct);
	DECLARE_MESSAGE_MAP()
};

#ifndef _DEBUG  // AccountBookView.cpp �еĵ��԰汾
inline CAccountBookDoc* CAccountBookView::GetDocument() const
   { return reinterpret_cast<CAccountBookDoc*>(m_pDocument); }
#endif

