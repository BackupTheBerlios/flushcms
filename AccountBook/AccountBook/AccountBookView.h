// AccountBookView.h : CAccountBookView 类的接口
//


#pragma once


class CAccountBookView : public CListView
{
protected: // 仅从序列化创建
	CAccountBookView();
	DECLARE_DYNCREATE(CAccountBookView)

// 属性
public:
	CAccountBookDoc* GetDocument() const;

// 操作
public:

// 重写
public:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
protected:
	virtual void OnInitialUpdate(); // 构造后第一次调用

// 实现
public:
	virtual ~CAccountBookView();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// 生成的消息映射函数
protected:
	afx_msg void OnStyleChanged(int nStyleType, LPSTYLESTRUCT lpStyleStruct);
	DECLARE_MESSAGE_MAP()
};

#ifndef _DEBUG  // AccountBookView.cpp 中的调试版本
inline CAccountBookDoc* CAccountBookView::GetDocument() const
   { return reinterpret_cast<CAccountBookDoc*>(m_pDocument); }
#endif

