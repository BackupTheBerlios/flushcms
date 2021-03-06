// AccountantView.h : CAccountantView 类的接口
//


#pragma once
#include "afxcmn.h"
#include "mydatabase.h"


class CAccountantView : public CListView
{
protected: // 仅从序列化创建
	CAccountantView();
	DECLARE_DYNCREATE(CAccountantView)

// 属性
public:
	CAccountantDoc* GetDocument() const;

// 操作
public:

// 重写
public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
protected:
	virtual void OnInitialUpdate(); // 构造后第一次调用

// 实现
public:
	virtual ~CAccountantView();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// 生成的消息映射函数
protected:
	afx_msg void OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct);
	DECLARE_MESSAGE_MAP()
public:
	CListCtrl *m_nList;
public:
	afx_msg void OnNMRclick(NMHDR *pNMHDR, LRESULT *pResult);
public:
	afx_msg void OnAddPerson();
public:
	int m_nPID;
protected:
	virtual void OnDraw(CDC* /*pDC*/);
public:
	CMyDatabase *m_nDataBase;
protected:
	virtual void OnUpdate(CView* /*pSender*/, LPARAM /*lHint*/, CObject* /*pHint*/);
public:
	void drawList(void);
public:
	afx_msg void OnLvnItemActivate(NMHDR *pNMHDR, LRESULT *pResult);
public:
	afx_msg void OnDelSelectPerson();
public:
	afx_msg void OnKeyDown(UINT nChar, UINT nRepCnt, UINT nFlags);
};

#ifndef _DEBUG  // AccountantView.cpp 中的调试版本
inline CAccountantDoc* CAccountantView::GetDocument() const
   { return reinterpret_cast<CAccountantDoc*>(m_pDocument); }
#endif

