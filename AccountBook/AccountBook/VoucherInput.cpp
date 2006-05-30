// VoucherInput.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "VoucherInput.h"
#include "VoucherAdd.h"

#define VOUCHER_LEN 7
typedef struct ListHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel voucherHeaderLabel[VOUCHER_LEN]=
{
	_T("����"),120,
	_T("ID"),20,
	_T("ƾ֤���"),80,
	_T("��Ŀ"),120,
	_T("���"),40,
	_T("���"),80,
	_T("����"),120
};

// CVoucherInput �Ի���

IMPLEMENT_DYNAMIC(CVoucherInput, CDialog)

CVoucherInput::CVoucherInput(CWnd* pParent /*=NULL*/)
	: CDialog(CVoucherInput::IDD, pParent)
	, m_nSelectDate(COleDateTime::GetCurrentTime())
	, m_bDateChange(false)
{

}

CVoucherInput::~CVoucherInput()
{
}

void CVoucherInput::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_nVoucherList);
	DDX_DateTimeCtrl(pDX, IDC_DATETIMEPICKER1, m_nSelectDate);
}


BEGIN_MESSAGE_MAP(CVoucherInput, CDialog)
	ON_BN_CLICKED(IDC_BUTTON1, &CVoucherInput::OnBnClickedButton1)
	ON_BN_CLICKED(IDC_BUTTON2, &CVoucherInput::OnBnClickedButton2)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_LIST1, &CVoucherInput::OnLvnItemActivateList1)
//	ON_NOTIFY(NM_THEMECHANGED, IDC_DATETIMEPICKER1, &CVoucherInput::OnNMThemeChangedDatetimepicker1)
ON_NOTIFY(DTN_DATETIMECHANGE, IDC_DATETIMEPICKER1, &CVoucherInput::OnDtnDatetimechangeDatetimepicker1)
END_MESSAGE_MAP()


// CVoucherInput ��Ϣ�������

BOOL CVoucherInput::OnInitDialog()
{
	CDialog::OnInitDialog();

	// TODO:  �ڴ���Ӷ���ĳ�ʼ��
	m_nVoucherList.SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_CHECKBOXES|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE);
	for (int i=0;i<VOUCHER_LEN;i++)
	{
		m_nVoucherList.InsertColumn(i,voucherHeaderLabel[i].title,LVCFMT_LEFT,voucherHeaderLabel[i].len);
	}
	m_nVoucherList.SetColumnHide(1, TRUE);

	DrawList();

	return TRUE;  // return TRUE unless you set the focus to a control
	// �쳣: OCX ����ҳӦ���� FALSE
}

void CVoucherInput::OnBnClickedButton1()
{
	// ����ƾ֤
	CVoucherAdd *voucherAddDlg = new CVoucherAdd();
	if (m_nSelectDate)
	{
		voucherAddDlg->m_nCreateDate=m_nSelectDate;
	}
	voucherAddDlg->DoModal();
	if (voucherAddDlg->m_bIsSubmit)
	{
		CString sql,dlgDate;
		dlgDate.Format(_T("%d-%d-%d"),voucherAddDlg->m_nCreateDate.GetYear(),voucherAddDlg->m_nCreateDate.GetMonth(),voucherAddDlg->m_nCreateDate.GetDay());
		sql.Format(_T(" INSERT INTO Voucher (AccountTypeID,CreateDate,Amount,Debit,Moneys,Memo) VALUES ('%s','%s',%d,'%s',%s,'%s') "),voucherAddDlg->m_nAccountTypeID,dlgDate,voucherAddDlg->m_iAmount,voucherAddDlg->m_nDebit,voucherAddDlg->m_nMoney,voucherAddDlg->m_nMemo );
		theApp.m_nDatabase->doActionQuery(sql);
		DrawList();
	}
}

void CVoucherInput::DrawList(void)
{
	//�����б�
	CRecordset *m_pSet;
	COleDateTime sourceDate;
	COleCurrency sourceMoney;
	CString sql,tmpStr,filedName[VOUCHER_LEN]={
		_T("CreateDate"),
		_T("VoucherID"),
		_T("Amount"),
		_T("AccountTypeID"),
		_T("Debit"),
		_T("Moneys"),
		_T("Memo")
	};
	if (m_nSelectDate && m_bDateChange )
	{
		sql.Format(_T(" WHERE CreateDate=cdate('%s') ORDER BY AddDate "),m_nSelectDate.Format(_T("%Y-%m-%d")));
	}
	else
	{
		sql.Format(_T(" ORDER BY AddDate "));
	}


	m_pSet=theApp.m_nDatabase->getTableRecordset(_T("Voucher"),sql);

	m_nVoucherList.DeleteAllItems();
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();
		int x=0;
		while (!m_pSet->IsEOF())
		{
			m_pSet->GetFieldValue(_T("CreateDate"),tmpStr);
			sourceDate.ParseDateTime(tmpStr);
			tmpStr = sourceDate.Format(_T("%Y-%m-%d"));

			m_nVoucherList.InsertItem(x,tmpStr);
			for (int i=1;i<VOUCHER_LEN;i++)
			{
				m_pSet->GetFieldValue(filedName[i],tmpStr);
				if (i==5)
				{
					sourceMoney.ParseCurrency(tmpStr);
					tmpStr = sourceMoney.Format(0, MAKELCID(MAKELANGID(LANG_CHINESE,
						SUBLANG_CHINESE_SIMPLIFIED), SORT_DEFAULT));
				}
				m_nVoucherList.SetItemText(x,i,tmpStr);

			}
			x++;
			m_pSet->MoveNext();
		}
	}
	m_pSet->Close();
}

void CVoucherInput::OnBnClickedButton2()
{
	// ɾ��ƾ֤
	int nCount = m_nVoucherList.GetItemCount();
	CString delItem,delString,str;
	str.Format(_T("ȷ��ɾ����ѡ? "));
	if (AfxMessageBox(str,MB_YESNO)==IDYES)
	{
		for (int i=0;i < nCount;i++)
		{
			if (m_nVoucherList.GetCheck(i))
			{
				delItem=m_nVoucherList.GetItemText(i,1);
				delString.Format(_T(" DELETE FROM Voucher WHERE VoucherID=%s "),delItem);
				theApp.m_nDatabase->doActionQuery(delString);
			}
		}
		// �ػ��б�
		DrawList();
	}
}

void CVoucherInput::OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// �޸Ŀ�Ŀ
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nVoucherList.GetItemText(pNMIA->iItem,1);

	CRecordset *m_pSet;
	CString sql,dlgDate,tmpStr,currentID;
	COleDateTime thisDate;

	CVoucherAdd *addDlg = new CVoucherAdd();

	sql.Format(_T(" WHERE VoucherID = %s "),selectItem);
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("Voucher"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();

		m_pSet->GetFieldValue(_T("AccountTypeID"),tmpStr);
		addDlg->m_nAccountTypeID=tmpStr;

		m_pSet->GetFieldValue(_T("CreateDate"),tmpStr);
		thisDate.ParseDateTime(tmpStr);
		addDlg->m_nCreateDate=thisDate;

		m_pSet->GetFieldValue(_T("Amount"),tmpStr);
		addDlg->m_iAmount=_ttoi(tmpStr);

		m_pSet->GetFieldValue(_T("Debit"),tmpStr);
		addDlg->m_nDebit=tmpStr;

		m_pSet->GetFieldValue(_T("Moneys"),tmpStr);
		addDlg->m_nMoney=tmpStr;

		m_pSet->GetFieldValue(_T("Memo"),tmpStr);
		addDlg->m_nMemo=tmpStr;

		m_pSet->GetFieldValue(_T("VoucherID"),tmpStr);
		currentID=tmpStr;

	}
	m_pSet->Close();
	addDlg->m_bUpdateModel=true;
	addDlg->DoModal();

	if (addDlg->m_bIsSubmit)
	{
		dlgDate.Format(_T("%d-%d-%d"),addDlg->m_nCreateDate.GetYear(),addDlg->m_nCreateDate.GetMonth(),addDlg->m_nCreateDate.GetDay());
		sql.Format(_T(" UPDATE Voucher SET AccountTypeID='%s',CreateDate='%s',Amount=%d,Debit='%s',Moneys=%s,Memo='%s' WHERE VoucherID=%s "),addDlg->m_nAccountTypeID,dlgDate,addDlg->m_iAmount,addDlg->m_nDebit,addDlg->m_nMoney,addDlg->m_nMemo,currentID);
		theApp.m_nDatabase->doActionQuery(sql);
	}
	DrawList();
}

//void CVoucherInput::OnNMThemeChangedDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult)
//{
//	*pResult = 0;
//	UpdateData(true);
//	MessageBox(m_nSelectDate.Format(_T("%Y-%m-%d")));
//}

void CVoucherInput::OnDtnDatetimechangeDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMDATETIMECHANGE pDTChange = reinterpret_cast<LPNMDATETIMECHANGE>(pNMHDR);
	*pResult = 0;
	UpdateData(true);
	m_bDateChange = true;
	DrawList();
	//MessageBox(m_nSelectDate.Format(_T("%Y-%m-%d")));

}
