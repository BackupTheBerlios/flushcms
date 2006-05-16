// SearchWord.cpp : 实现文件
//

#include "stdafx.h"
#include "Accountant.h"
#include "SearchWord.h"


// CSearchWord 对话框

IMPLEMENT_DYNAMIC(CSearchWord, CDialog)

CSearchWord::CSearchWord(CWnd* pParent /*=NULL*/)
	: CDialog(CSearchWord::IDD, pParent)
	, m_nSearchWord(_T(""))
	, m_nIsSubmit(false)
{

}

CSearchWord::~CSearchWord()
{
}

void CSearchWord::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_SEARCH_WORD, m_nSearchWord);
	DDX_Control(pDX, IDC_SEARCH_WORD, m_nSearchWordCtrl);
}


BEGIN_MESSAGE_MAP(CSearchWord, CDialog)
	ON_BN_CLICKED(IDOK, &CSearchWord::OnBnClickedOk)
END_MESSAGE_MAP()


// CSearchWord 消息处理程序

BOOL CSearchWord::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  在此添加额外的初始化

	return TRUE;  // return TRUE unless you set the focus to a control
	// 异常: OCX 属性页应返回 FALSE
}

void CSearchWord::OnBnClickedOk()
{
	// TODO: 在此添加控件通知处理程序代码
	UpdateData(true);

	if (m_nSearchWord =="")
	{
		MessageBox(_T("请输入你要查找的词"),_T("请检查您的输入！"));
		m_nSearchWordCtrl.SetFocus();
		return;
	}
	m_nIsSubmit=true;

	OnOK();
}
