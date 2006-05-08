// AccountantView.h : CAccountantView 类的接口
//


#pragma once


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
};

#ifndef _DEBUG  // AccountantView.cpp 中的调试版本
inline CAccountantDoc* CAccountantView::GetDocument() const
   { return reinterpret_cast<CAccountantDoc*>(m_pDocument); }
#endif

