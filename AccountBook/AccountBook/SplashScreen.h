#pragma once


// CSplashScreen 对话框

class CSplashScreen : public CDialog
{
	DECLARE_DYNAMIC(CSplashScreen)

public:
	CSplashScreen(CWnd* pParent = NULL);   // 标准构造函数
	virtual ~CSplashScreen();

// 对话框数据
	enum { IDD = ID_DIALOG_SPLASH };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV 支持

	DECLARE_MESSAGE_MAP()
public:
	virtual BOOL OnInitDialog();
protected:
	virtual BOOL PreCreateWindow(CREATESTRUCT& cs);
};
