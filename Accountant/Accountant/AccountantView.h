// AccountantView.h : CAccountantView ��Ľӿ�
//


#pragma once


class CAccountantView : public CListView
{
protected: // �������л�����
	CAccountantView();
	DECLARE_DYNCREATE(CAccountantView)

// ����
public:
	CAccountantDoc* GetDocument() const;

// ����
public:

// ��д
public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
protected:
	virtual void OnInitialUpdate(); // ������һ�ε���

// ʵ��
public:
	virtual ~CAccountantView();
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

#ifndef _DEBUG  // AccountantView.cpp �еĵ��԰汾
inline CAccountantDoc* CAccountantView::GetDocument() const
   { return reinterpret_cast<CAccountantDoc*>(m_pDocument); }
#endif

