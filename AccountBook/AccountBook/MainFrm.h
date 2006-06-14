// MainFrm.h : CMainFrame 类的接口
//


#pragma once

#include "CustSplitterWnd.h"

class CAccountBookView;

class CMainFrame : public CFrameWnd
{
	
protected: // 仅从序列化创建
	CMainFrame();
	DECLARE_DYNCREATE(CMainFrame)

// 属性
public:
	CCustSplitterWnd m_wndSplitter;
public:

// 操作
public:

// 重写
public:
	virtual BOOL OnCreateClient(LPCREATESTRUCT lpcs, CCreateContext* pContext);
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);

// 实现
public:
	virtual ~CMainFrame();
	CAccountBookView* GetRightPane();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:  // 控件条嵌入成员
	CStatusBar  m_wndStatusBar;
	CToolBar    m_wndToolBar;

// 生成的消息映射函数
protected:
	afx_msg int OnCreate(LPCREATESTRUCT lpCreateStruct);
	afx_msg void OnUpdateViewStyles(CCmdUI* pCmdUI);
	afx_msg void OnViewStyle(UINT nCommandID);
	DECLARE_MESSAGE_MAP()
public:
	bool ReplaceView(int row, int col, CRuntimeClass *pViewClass, SIZE size);
public:
	bool m_bFormView;
public:
	void OnFormView(void);
public:
	void OnListView(void);
public:
	void OnUpdateFormView(CCmdUI *pCmdUI);
public:
	void OnUpdateListView(CCmdUI *pCmdUI);
public:
	afx_msg void OnFormDisplay();
public:
	afx_msg void OnListDisplay();
public:
	afx_msg void OnTimer(UINT_PTR nIDEvent);
	void OnViewLanguage(UINT uLang);
public:
	afx_msg void OnUpdateViewDefault(CCmdUI *pCmdUI);
public:
	virtual void GetMessageString(UINT nID, CString& rMessage) const;
protected:
	virtual BOOL OnCommand(WPARAM wParam, LPARAM lParam);
};


