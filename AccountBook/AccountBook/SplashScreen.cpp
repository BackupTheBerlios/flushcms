// SplashScreen.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "SplashScreen.h"


// CSplashScreen 对话框

IMPLEMENT_DYNAMIC(CSplashScreen, CDialog)

CSplashScreen::CSplashScreen(CWnd* pParent /*=NULL*/)
	: CDialog(CSplashScreen::IDD, pParent)
{

}

CSplashScreen::~CSplashScreen()
{
}

void CSplashScreen::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
}


BEGIN_MESSAGE_MAP(CSplashScreen, CDialog)
END_MESSAGE_MAP()


// CSplashScreen 消息处理程序

BOOL CSplashScreen::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  在此添加额外的初始化

	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}

BOOL CSplashScreen::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: 在此添加专用代码和/或调用基类
	cs.dwExStyle|=WS_EX_TOPMOST|WS_EX_TRANSPARENT ;  //|WS_EX_TRANSPARENT

	return CDialog::PreCreateWindow(cs);

}
