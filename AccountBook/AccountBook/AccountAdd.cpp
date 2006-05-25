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
	, m_bIsSubmint(false)
	, m_nDisplay(_T(""))
	, m_bUpdateModel(false)
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
	DDX_CBString(pDX, IDC_COMBO1, m_nDisplay);
	DDX_Control(pDX, IDC_COMBO1, m_nDisplayCtrl);
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
	m_bIsSubmint=true;
	OnOK();
}

BOOL CAccountAdd::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	m_nDisplayCtrl.InsertString(0,_T("��"));
	m_nDisplayCtrl.InsertString(1,_T("��"));
	if (m_bUpdateModel)
	{
		m_nDisplayCtrl.SelectString(0,m_nDisplay);
	} 
	else
	{
		m_nDisplayCtrl.SelectString(0,_T("��"));
	}

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}
