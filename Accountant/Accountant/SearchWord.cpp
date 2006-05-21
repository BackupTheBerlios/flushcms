// SearchWord.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "Accountant.h"
#include "SearchWord.h"


// CSearchWord �Ի���

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
	ON_WM_NCHITTEST()
END_MESSAGE_MAP()


// CSearchWord ��Ϣ��������

BOOL CSearchWord::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ����Ӷ���ĳ�ʼ��
	//CRect rcDialog;
	//GetClientRect(rcDialog);


	//m_nRgn.CreateEllipticRgn(0,0,rcDialog.Width(),rcDialog.Height());
	//SetWindowRgn((HRGN)m_nRgn,TRUE);

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

void CSearchWord::OnBnClickedOk()
{
	// TODO: �ڴ����ӿؼ�֪ͨ�����������
	UpdateData(true);

	if (m_nSearchWord =="")
	{
		MessageBox(_T("��������Ҫ���ҵĴ�"),_T("�����������룡"));
		m_nSearchWordCtrl.SetFocus();
		return;
	}
	m_nIsSubmit=true;

	OnOK();
}

LRESULT CSearchWord::OnNcHitTest(CPoint point)
{
	//������κεط������ƶ�����
	LRESULT nHitTest = CDialog::OnNcHitTest(point);
	return (nHitTest == HTCLIENT)?HTCAPTION:nHitTest;
}