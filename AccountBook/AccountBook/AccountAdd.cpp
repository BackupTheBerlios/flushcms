// AccountAdd.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountAdd.h"


// CAccountAdd �Ի���

IMPLEMENT_DYNAMIC(CAccountAdd, CDialog)

CAccountAdd::CAccountAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CAccountAdd::IDD, pParent)
	, m_nNumberID(_T(""))
	, m_nTitle(_T(""))
	, m_nOrderID(_T(""))
	, m_nDisplay(FALSE)
{

}

CAccountAdd::~CAccountAdd()
{
}

void CAccountAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_EDIT1, m_nNumberID);
	DDX_Control(pDX, IDC_EDIT1, m_nNumberIDCtrl);
	DDX_Text(pDX, IDC_EDIT2, m_nTitle);
	DDX_Control(pDX, IDC_EDIT2, m_nTitleCtrl);
	DDX_Text(pDX, IDC_EDIT3, m_nOrderID);
	DDX_Check(pDX, IDC_CHECK1, m_nDisplay);
}


BEGIN_MESSAGE_MAP(CAccountAdd, CDialog)
	ON_BN_CLICKED(IDOK, &CAccountAdd::OnBnClickedOk)
END_MESSAGE_MAP()


// CAccountAdd ��Ϣ�������

void CAccountAdd::OnBnClickedOk()
{
	// ���ȷ���¼�����
	UpdateData(true);

	if (m_nNumberID=="")
	{
		MessageBox(_T("�������Ŀ����"),_T("�����������룡"));
		m_nNumberIDCtrl.SetFocus();
		return;
	}
	if (m_nTitle=="")
	{
		MessageBox(_T("�������Ŀ����"),_T("�����������룡"));
		m_nTitleCtrl.SetFocus();
		return;
	}
	OnOK();
}
