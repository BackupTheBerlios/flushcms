// LeftView.h : CLeftView 类的接口
//


#pragma once
#include "afxcmn.h"
#include "mydatabase.h"

class CAccountantDoc;

class CLeftView : public CTreeView
{
protected: // 仅从序列化创建
	CLeftView();
	DECLARE_DYNCREATE(CLeftView)

// 属性
public:
	CAccountantDoc* GetDocument();

// 操作
public:

// 重写
	public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
	protected:
	virtual void OnInitialUpdate(); // 构造后第一次调用

// 实现
public:
	virtual ~CLeftView();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// 生成的消息映射函数
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

#ifndef _DEBUG  // LeftView.cpp 中的调试版本
inline CAccountantDoc* CLeftView::GetDocument()
   { return reinterpret_cast<CAccountantDoc*>(m_pDocument); }
#endif

