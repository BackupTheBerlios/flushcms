#pragma once


// CSplashScreen �Ի���

class CSplashScreen : public CDialog
{
	DECLARE_DYNAMIC(CSplashScreen)

public:
	CSplashScreen(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CSplashScreen();

// �Ի�������
	enum { IDD = ID_DIALOG_SPLASH };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
protected:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
};
