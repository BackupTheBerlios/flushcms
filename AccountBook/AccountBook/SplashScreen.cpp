// SplashScreen.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "SplashScreen.h"


// CSplashScreen �Ի���

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


// CSplashScreen ��Ϣ�������

BOOL CSplashScreen::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

BOOL CSplashScreen::PreCreateWindow(CREATESTRUCT& cs)
{
	// TODO: �ڴ����ר�ô����/����û���
	cs.dwExStyle|=WS_EX_TOPMOST|WS_EX_TRANSPARENT ;  //|WS_EX_TRANSPARENT

	return CDialog::PreCreateWindow(cs);

}
