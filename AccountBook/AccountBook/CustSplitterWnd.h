#pragma once


// CCustSplitterWnd 框架

class CCustSplitterWnd : public CSplitterWnd
{
	DECLARE_DYNCREATE(CCustSplitterWnd)
public:
	CCustSplitterWnd();           // 动态创建所使用的受保护的构造函数
	virtual ~CCustSplitterWnd();

protected:
	DECLARE_MESSAGE_MAP()
public:
	bool ReplaceView(int row, int col, CRuntimeClass *pViewClass, SIZE size);
};


