// Vouchers.cpp : 实现文件
//

#include "stdafx.h"
#include "AccountBook.h"
#include "Vouchers.h"
#include "VoucherAdd.h"
#include "ReportYearSelect.h"

#define VOUCHER_LEN 7
typedef struct ListHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel voucherHeaderLabel[VOUCHER_LEN]=
{
	_T("日期"),120,
	_T("ID"),20,
	_T("凭证序号"),80,
	_T("科目"),120,
	_T("借贷"),40,
	_T("金额"),80,
	_T("描述"),120
};

// CVouchers

IMPLEMENT_DYNCREATE(CVouchers, CFormView)

CVouchers::CVouchers()
	: CFormView(CVouchers::IDD)
	, m_nSelectDate(COleDateTime::GetCurrentTime())
	, m_bDateChange(false)

	, m_nCompanyID(_T(""))
	, m_nCurrentCompanyName(_T(""))
{

}

CVouchers::~CVouchers()
{
}

void CVouchers::DoDataExchange(CDataExchange* pDX)
{
	CFormView::DoDataExchange(pDX);
	DDX_Control(pDX, IDC_LIST1, m_nVoucherList);
	DDX_DateTimeCtrl(pDX, IDC_DATETIMEPICKER1, m_nSelectDate);
	DDX_Control(pDX, IDC_REPORTMANX1, m_nReport);
	DDX_Text(pDX, IDC_CURRENT_COMPANY, m_nCurrentCompanyName);
}

BEGIN_MESSAGE_MAP(CVouchers, CFormView)
	ON_BN_CLICKED(IDC_BUTTON1, &CVouchers::OnBnClickedButton1)
	ON_BN_CLICKED(IDC_BUTTON2, &CVouchers::OnBnClickedButton2)
	ON_NOTIFY(LVN_ITEMACTIVATE, IDC_LIST1, &CVouchers::OnLvnItemActivateList1)
	ON_NOTIFY(DTN_DATETIMECHANGE, IDC_DATETIMEPICKER1, &CVouchers::OnDtnDatetimechangeDatetimepicker1)
	ON_BN_CLICKED(IDC_REP_VOUCHER_DETAIL, &CVouchers::OnBnClickedRepVoucherDetail)
	ON_BN_CLICKED(IDC_REPORT_YEAR, &CVouchers::OnBnClickedReportYear)
	ON_BN_CLICKED(IDC_REPORT_MONTH, &CVouchers::OnBnClickedReportMonth)
END_MESSAGE_MAP()


// CVouchers 诊断

#ifdef _DEBUG
void CVouchers::AssertValid() const
{
	CFormView::AssertValid();
}

#ifndef _WIN32_WCE
void CVouchers::Dump(CDumpContext& dc) const
{
	CFormView::Dump(dc);
}
#endif
#endif //_DEBUG


// CVouchers 消息处理程序

void CVouchers::OnInitialUpdate()
{
	CFormView::OnInitialUpdate();

	// TODO: 在此添加专用代码和/或调用基类

	CLanguage::TranslateDialog(this->m_hWnd, MAKEINTRESOURCE(IDD_VOUCHKER));


	m_nVoucherList.SetExtendedStyle(LVS_EX_FULLROWSELECT|LVS_EX_CHECKBOXES|LVS_EX_HEADERDRAGDROP|LVS_EX_GRIDLINES|LVS_EX_TWOCLICKACTIVATE);
	for (int i=0;i<VOUCHER_LEN;i++)
	{
		m_nVoucherList.InsertColumn(i,voucherHeaderLabel[i].title,LVCFMT_LEFT,voucherHeaderLabel[i].len);
	}
	m_nVoucherList.SetColumnHide(1, TRUE);

	LPCTSTR fileName=_T(".\\config.ini");
	CString str,sql,tmpStr;
	GetPrivateProfileString(_T("data"),_T("current_company"),NULL,str.GetBuffer(254),254,fileName); 

	m_nCurrentCompanyName=str;
	UpdateData(false);

	CRecordset *m_pSet;
	sql.Format(_T(" WHERE CompanyName = '%s' "),str);
	m_pSet = theApp.m_nDatabase->getTableRecordset(_T("Company"),sql);
	if (!m_pSet->IsEOF())
	{
		m_pSet->MoveFirst();

		m_pSet->GetFieldValue(_T("CompanyID"),tmpStr);
		m_nCompanyID=tmpStr;

	}
	m_pSet->Close();

	DrawList();

	//GetParentFrame()->RecalcLayout();
	//ResizeParentToFit();

}

void CVouchers::OnBnClickedButton1()
{
	// 新增凭证
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
		sql.Format(_T(" INSERT INTO Voucher (AccountTypeID,CompanyID,CreateDate,Amount,Debit,Moneys,Memo) VALUES ('%s',%s,'%s',%d,'%s',%s,'%s') "),voucherAddDlg->m_nAccountTypeID,m_nCompanyID,dlgDate,voucherAddDlg->m_iAmount,voucherAddDlg->m_nDebit,voucherAddDlg->m_nMoney,voucherAddDlg->m_nMemo );
		theApp.m_nDatabase->doActionQuery(sql);
		DrawList();
	}
}

void CVouchers::DrawList(void)
{
	//绘制列表
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
		sql.Format(_T(" WHERE CreateDate=cdate('%s') AND CompanyID = %s ORDER BY AddDate "),m_nSelectDate.Format(_T("%Y-%m-%d")),m_nCompanyID);
	}
	else
	{
		sql.Format(_T(" WHERE CompanyID = %s ORDER BY AddDate "),m_nCompanyID);
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

void CVouchers::OnBnClickedButton2()
{
	// 删除凭证
	int nCount = m_nVoucherList.GetItemCount();
	CString delItem,delString,str;
	str.Format(_T("确认删除所选? "));
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
		// 重绘列表
		DrawList();
	}
}

void CVouchers::OnLvnItemActivateList1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMITEMACTIVATE pNMIA = reinterpret_cast<LPNMITEMACTIVATE>(pNMHDR);
	// 修改科目
	*pResult = 0;
	pNMIA->iItem;
	CString selectItem = m_nVoucherList.GetItemText(pNMIA->iItem,1);

	CRecordset *m_pSet;
	CString sql,dlgDate,tmpStr,currentID;
	COleDateTime thisDate;
	COleCurrency sourceMoney;

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
		sourceMoney.ParseCurrency(tmpStr);
		tmpStr = sourceMoney.Format(0, MAKELCID(MAKELANGID(LANG_CHINESE,
			SUBLANG_CHINESE_SIMPLIFIED), SORT_DEFAULT));
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

void CVouchers::OnDtnDatetimechangeDatetimepicker1(NMHDR *pNMHDR, LRESULT *pResult)
{
	LPNMDATETIMECHANGE pDTChange = reinterpret_cast<LPNMDATETIMECHANGE>(pNMHDR);
	*pResult = 0;
	UpdateData(true);
	m_bDateChange = true;
	DrawList();

}
void CVouchers::OnBnClickedRepVoucherDetail()
{
	// TODO: 在此添加控件通知处理程序代码
	CReportYearSelect *dlg = new CReportYearSelect();
	dlg->DoModal();
	if (dlg->m_bIsSubmint)
	{
		m_nReport.put_filename(_T("report\\voucher.rep"));
		m_nReport.put_Title(m_nCurrentCompanyName);

		COleVariant company_name = new COleVariant((CString)m_nCurrentCompanyName);
		m_nReport.SetParamValue(_T("COMPANYNAME"),company_name);
		
		int c_id = _ttoi(m_nCompanyID);
		COleVariant company_id = new COleVariant((short) c_id);
		m_nReport.SetParamValue(_T("COMPANYID"),company_id);

		CString year_month = dlg->m_nYearSelect.Format(_T("%Y-%m-%d"));
		COleVariant set_year = new COleVariant((CString)year_month);
		m_nReport.SetParamValue(_T("YEARMONTHDAY"),set_year);

		m_nReport.put_Preview(true);
		m_nReport.Execute();
	}

}

void CVouchers::OnBnClickedReportYear()
{
	// TODO: 在此添加控件通知处理程序代码
	CReportYearSelect *dlg = new CReportYearSelect();
	dlg->m_bIsMonth=1;
	UpdateData(FALSE);
	dlg->DoModal();
	if (dlg->m_bIsSubmint)
	{
		m_nReport.put_filename(_T("report\\VoucherYear.rep"));
		m_nReport.put_Title(m_nCurrentCompanyName);

		COleVariant company_name = new COleVariant((CString)m_nCurrentCompanyName);
		m_nReport.SetParamValue(_T("COMPANYNAME"),company_name);

		int c_id = _ttoi(m_nCompanyID);
		COleVariant company_id = new COleVariant((short) c_id);
		m_nReport.SetParamValue(_T("COMPANYID"),company_id);

		COleVariant set_year = new COleVariant((short)dlg->m_nYearSelect.GetYear());
		m_nReport.SetParamValue(_T("SETYEAR"),set_year);


		m_nReport.put_Preview(true);
		m_nReport.Execute();
	}
}

void CVouchers::OnBnClickedReportMonth()
{
	// TODO: 在此添加控件通知处理程序代码
	CReportYearSelect *dlg = new CReportYearSelect();
	dlg->m_bIsMonth=2;
	UpdateData(FALSE);
	dlg->DoModal();
	if (dlg->m_bIsSubmint)
	{
		m_nReport.put_filename(_T("report\\VoucherMonth.rep"));
		m_nReport.put_Title(m_nCurrentCompanyName);

		COleVariant company_name = new COleVariant((CString)m_nCurrentCompanyName);
		m_nReport.SetParamValue(_T("COMPANYNAME"),company_name);

		int c_id = _ttoi(m_nCompanyID);
		COleVariant company_id = new COleVariant((short) c_id);
		m_nReport.SetParamValue(_T("COMPANYID"),company_id);

		CString year_month = dlg->m_nYearSelect.Format(_T("%Y-%m"));
		COleVariant set_year = new COleVariant((CString)year_month);
		m_nReport.SetParamValue(_T("YEARMONTH"),set_year);


		m_nReport.put_Preview(true);
		m_nReport.Execute();

	}
}
