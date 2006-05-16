// PersonInput.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "Accountant.h"
#include "PersonInput.h"


// CPersonInput �Ի���

IMPLEMENT_DYNAMIC(CPersonInput, CDialog)

CPersonInput::CPersonInput(CWnd* pParent /*=NULL*/)
	: CDialog(CPersonInput::IDD, pParent)
	, m_nUserName(_T(""))
	, m_nSex(_T(""))
	, m_nPID(_T(""))
	, m_nBirthDay(COleDateTime::GetCurrentTime())
	, m_nProvince(_T(""))
	, m_nCity(_T(""))
	, m_nTel(_T(""))
	, m_nMobile(_T(""))
	, m_nAddr(_T(""))
	, m_nIsSubmit(false)
	, m_nCompany(_T(""))
	, m_nMeno(_T(""))
	, m_nUpdateMode(false)
{

}

CPersonInput::~CPersonInput()
{
}

void CPersonInput::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Text(pDX, IDC_USERNAME, m_nUserName);
	DDX_CBString(pDX, IDC_SEX, m_nSex);
	DDX_CBString(pDX, IDC_PID, m_nPID);
	DDX_DateTimeCtrl(pDX, IDC_BIRTHDAY, m_nBirthDay);
	DDX_CBString(pDX, IDC_PEOVINCE, m_nProvince);
	DDX_CBString(pDX, IDC_CITY, m_nCity);
	DDX_Text(pDX, IDC_TEL, m_nTel);
	DDX_Text(pDX, IDC_PHONE, m_nMobile);
	DDX_Text(pDX, IDC_ADDR, m_nAddr);
	DDX_Control(pDX, IDC_USERNAME, m_nUserNameCtrl);
	DDX_Control(pDX, IDC_SEX, m_nSexCtrl);
	DDX_Control(pDX, IDC_TEL, m_nTelCtrl);
	DDX_Control(pDX, IDC_PHONE, m_nMobileCtrl);
	DDX_Control(pDX, IDC_ADDR, m_nAddrCtrl);
	DDX_Control(pDX, IDC_PID, m_nPIDCtrl);
	DDX_Control(pDX, IDC_PEOVINCE, m_nProvinceCtrl);
	DDX_Control(pDX, IDC_CITY, m_nCityCtrl);
	DDX_Text(pDX, IDC_COMPANY, m_nCompany);
	DDX_Text(pDX, IDC_MENO, m_nMeno);
	DDX_Control(pDX, IDOK, m_nSubmitButtonCtrl);
}


BEGIN_MESSAGE_MAP(CPersonInput, CDialog)
	ON_BN_CLICKED(IDOK, &CPersonInput::OnBnClickedOk)
	ON_CBN_SELCHANGE(IDC_PEOVINCE, &CPersonInput::OnCbnSelchangePeovince)
END_MESSAGE_MAP()


// CPersonInput ��Ϣ�������

void CPersonInput::OnBnClickedOk()
{
	// TODO: �ڴ���ӿؼ�֪ͨ����������
	UpdateData(true);

	if (m_nUserName=="")
	{
		MessageBox(_T("�������û���"),_T("�����������룡"));
		m_nUserNameCtrl.SetFocus();
		return;
	}
	if (m_nSex=="")
	{
		MessageBox(_T("��ѡ���Ա�"),_T("�����������룡"));
		m_nSexCtrl.SetFocus();
		return;
	}
	if (m_nTel=="" && m_nMobile=="")
	{
		MessageBox(_T("������绰���ֻ�����"),_T("�����������룡"));
		m_nTelCtrl.SetFocus();
		return;
	}
	if (m_nAddr=="")
	{
		MessageBox(_T("��������ϸ��ַ"),_T("�����������룡"));
		m_nAddrCtrl.SetFocus();
		return;
	}
	UpdateData(false);
	m_nIsSubmit=true;

	OnOK();
}

BOOL CPersonInput::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	//��ʼ���ϼ�����˵�
	m_nIsSubmit=false;

	if (m_nUpdateMode == true)
	{
		m_nSubmitButtonCtrl.SetWindowText(_T("�޸�"));
		m_nUserNameCtrl.SetReadOnly();
	}

	CMyDatabase *dlgDatabase;
	dlgDatabase = theApp.mydata;
	CRecordset *m_pSet;
	CString typeName;
	m_pSet = dlgDatabase->getTableRecordset(_T("types"),_T(" WHERE PID > 0 "));
	m_nPIDCtrl.InsertString(0,_T("��"));
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int i=1;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("Name"),typeName);
			m_nPIDCtrl.InsertString(i,typeName);
			m_pSet->MoveNext();
			i++;
		}
	}
	m_nPIDCtrl.SelectString(0,m_nPID);

	//װ��ʡ�ݼ�¼
	m_pSet = dlgDatabase->getTableRecordset(_T("Province"));
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int y=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("Province"),typeName);
			m_nProvinceCtrl.InsertString(y,typeName);
			m_pSet->MoveNext();
			y++;
		}
		m_nProvinceCtrl.SelectString(0,_T("�㶫ʡ"));
	}

	//װ��㶫���м�¼
	m_pSet = dlgDatabase->getTableRecordset(_T("City"),_T(" WHERE ProvinceID = 5 "));
	m_nCityCtrl.ResetContent();
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int y=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("City"),typeName);
			m_nCityCtrl.InsertString(y,typeName);
			m_pSet->MoveNext();
			y++;
		}
		m_nCityCtrl.SelectString(0,_T("����"));

	}
	

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

void CPersonInput::OnCbnSelchangePeovince()
{
	// ���ı�ʡ��ѡ��ʱ
	UpdateData(true);

	CMyDatabase *dlgDatabase;
	dlgDatabase = theApp.mydata;
	CRecordset *m_pSet;
	CString typeName;

	CString citySql;
	int ProvinceID;
	ProvinceID = dlgDatabase->getProvinceid(m_nProvince);

	citySql.Format(_T(" WHERE ProvinceID = %d "),ProvinceID);
	m_pSet = dlgDatabase->getTableRecordset(_T("City"),citySql);
	m_nCityCtrl.ResetContent();
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int y=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("City"),typeName);
			m_nCityCtrl.InsertString(y,typeName);
			m_pSet->MoveNext();
			y++;
		}
	}
}
