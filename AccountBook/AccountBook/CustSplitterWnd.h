#pragma once


// CCustSplitterWnd ���

class CCustSplitterWnd : public CSplitterWnd
{
	DECLARE_DYNCREATE(CCustSplitterWnd)
public:
	CCustSplitterWnd();           // ��̬������ʹ�õ��ܱ����Ĺ��캯��
	virtual ~CCustSplitterWnd();

protected:
	DECLARE_MESSAGE_MAP()
public:
	bool ReplaceView(int row, int col, CRuntimeClass *pViewClass, SIZE size);
};


