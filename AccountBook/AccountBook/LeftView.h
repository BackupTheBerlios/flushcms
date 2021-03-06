// LeftView.h : CLeftView 类的接口
//


#pragma once
#include "afxcmn.h"

class CAccountBookDoc;

class CLeftView : public CTreeView
{
protected: // 仅从序列化创建
	CLeftView();
	DECLARE_DYNCREATE(CLeftView)

// 属性
public:
	CAccountBookDoc* GetDocument();

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
	CString main_item_data1,main_item_data1_sub1,main_item_data1_sub2,main_item_data1_sub3;

public:
	void DrawTreeList(void);
public:
	afx_msg void OnTvnSelchanged(NMHDR *pNMHDR, LRESULT *pResult);
};

#ifndef _DEBUG  // LeftView.cpp 中的调试版本
inline CAccountBookDoc* CLeftView::GetDocument()
   { return reinterpret_cast<CAccountBookDoc*>(m_pDocument); }
#endif

