// MainFrm.h : CMainFrame ��Ľӿ�
//


#pragma once

#include "CustSplitterWnd.h"

class CAccountBookView;

class CMainFrame : public CFrameWnd
{
	
protected: // �������л�����
	CMainFrame();
	DECLARE_DYNCREATE(CMainFrame)

// ����
public:
	CCustSplitterWnd m_wndSplitter;
public:

// ����
public:

// ��д
public:
	virtual BOOL OnCreateClient(LPCREATESTRUCT lpcs, CCreateContext* pContext);
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);

// ʵ��
public:
	virtual ~CMainFrame();
	CAccountBookView* GetRightPane();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:  // �ؼ���Ƕ���Ա
	CStatusBar  m_wndStatusBar;
	CToolBar    m_wndToolBar;

// ���ɵ���Ϣӳ�亯��
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


