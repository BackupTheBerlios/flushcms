#pragma once

// 计算机生成了由 Microsoft Visual C++ 创建的 IDispatch 包装类

// 注意: 不要修改此文件的内容。如果此类由
//  Microsoft Visual C++ 重新生成，您的修改将被改写。

/////////////////////////////////////////////////////////////////////////////
// CReportmanx1 包装类

class CReportmanx1 : public CWnd
{
protected:
	DECLARE_DYNCREATE(CReportmanx1)
public:
	CLSID const& GetClsid()
	{
		static CLSID const clsid
			= { 0xDC30E149, 0x4129, 0x450F, { 0xBD, 0xFE, 0xBD, 0x9E, 0x6F, 0x31, 0x14, 0x7E } };
		return clsid;
	}
	virtual BOOL Create(LPCTSTR lpszClassName, LPCTSTR lpszWindowName, DWORD dwStyle,
						const RECT& rect, CWnd* pParentWnd, UINT nID, 
						CCreateContext* pContext = NULL)
	{ 
		return CreateControl(GetClsid(), lpszWindowName, dwStyle, rect, pParentWnd, nID); 
	}

    BOOL Create(LPCTSTR lpszWindowName, DWORD dwStyle, const RECT& rect, CWnd* pParentWnd, 
				UINT nID, CFile* pPersist = NULL, BOOL bStorage = FALSE,
				BSTR bstrLicKey = NULL)
	{ 
		return CreateControl(GetClsid(), lpszWindowName, dwStyle, rect, pParentWnd, nID,
		pPersist, bStorage, bstrLicKey); 
	}

// 属性
public:
enum
{
    htKeyword = 0,
    htContext = 1
}TxHelpType;
enum
{
    rpParamString = 0,
    rpParamInteger = 1,
    rpParamDouble = 2,
    rpParamDate = 3,
    rpParamTime = 4,
    rpParamDateTime = 5,
    rpParamCurrency = 6,
    rpParamBool = 7,
    rpParamExpreB = 8,
    rpParamExpreA = 9,
    rpParamSubst = 10,
    rpParamList = 11,
    rpParamUnknown = 12
}TxParamType;
enum
{
    AScaleReal = 0,
    AScaleWide = 1,
    AScaleHeight = 2,
    AScaleEntirePage = 3,
    AScaleCustom = 4
}TxAutoScaleType;
enum
{
    bsNone = 0,
    bsSingle = 1
}TxBorderStyle;
enum
{
    dmManual = 0,
    dmAutomatic = 1
}TxDragMode;
enum
{
    mbLeft = 0,
    mbRight = 1,
    mbMiddle = 2
}TxMouseButton;
enum
{
    afbNone = 0,
    afbSingle = 1,
    afbSunken = 2,
    afbRaised = 3
}TxActiveFormBorderStyle;
enum
{
    poNone = 0,
    poProportional = 1,
    poPrintToFit = 2
}TxPrintScale;


// 操作
public:

// IReportManX

// Functions
//

	void SetDatasetSQL(LPCTSTR datasetname, LPCTSTR sqlsentence)
	{
		static BYTE parms[] = VTS_BSTR VTS_BSTR ;
		InvokeHelper(0x1, DISPATCH_METHOD, VT_EMPTY, NULL, parms, datasetname, sqlsentence);
	}
	void SetDatabaseConnectionString(LPCTSTR databasename, LPCTSTR connectionstring)
	{
		static BYTE parms[] = VTS_BSTR VTS_BSTR ;
		InvokeHelper(0x2, DISPATCH_METHOD, VT_EMPTY, NULL, parms, databasename, connectionstring);
	}
	CString GetDatasetSQL(LPCTSTR datasetname)
	{
		CString result;
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x3, DISPATCH_METHOD, VT_BSTR, (void*)&result, parms, datasetname);
		return result;
	}
	CString GetDatabaseConnectionString(LPCTSTR databasename)
	{
		CString result;
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x4, DISPATCH_METHOD, VT_BSTR, (void*)&result, parms, databasename);
		return result;
	}
	void SetParamValue(LPCTSTR paramname, VARIANT paramvalue)
	{
		static BYTE parms[] = VTS_BSTR VTS_VARIANT ;
		InvokeHelper(0x5, DISPATCH_METHOD, VT_EMPTY, NULL, parms, paramname, &paramvalue);
	}
	VARIANT GetParamValue(LPCTSTR paramname)
	{
		VARIANT result;
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x6, DISPATCH_METHOD, VT_VARIANT, (void*)&result, parms, paramname);
		return result;
	}
	BOOL Execute()
	{
		BOOL result;
		InvokeHelper(0x7, DISPATCH_METHOD, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void PrinterSetup()
	{
		InvokeHelper(0x8, DISPATCH_METHOD, VT_EMPTY, NULL, NULL);
	}
	BOOL ShowParams()
	{
		BOOL result;
		InvokeHelper(0x9, DISPATCH_METHOD, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void SaveToPDF(LPCTSTR filename, BOOL compressed)
	{
		static BYTE parms[] = VTS_BSTR VTS_BOOL ;
		InvokeHelper(0xa, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename, compressed);
	}
	BOOL PrintRange(long frompage, long topage, long copies, BOOL collate)
	{
		BOOL result;
		static BYTE parms[] = VTS_I4 VTS_I4 VTS_I4 VTS_BOOL ;
		InvokeHelper(0xb, DISPATCH_METHOD, VT_BOOL, (void*)&result, parms, frompage, topage, copies, collate);
		return result;
	}
	CString get_filename()
	{
		CString result;
		InvokeHelper(0xc, DISPATCH_PROPERTYGET, VT_BSTR, (void*)&result, NULL);
		return result;
	}
	void put_filename(LPCTSTR newValue)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0xc, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	BOOL get_Preview()
	{
		BOOL result;
		InvokeHelper(0xd, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_Preview(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0xd, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	BOOL get_ShowProgress()
	{
		BOOL result;
		InvokeHelper(0xe, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_ShowProgress(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0xe, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	BOOL get_ShowPrintDialog()
	{
		BOOL result;
		InvokeHelper(0xf, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_ShowPrintDialog(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0xf, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	CString get_Title()
	{
		CString result;
		InvokeHelper(0x10, DISPATCH_PROPERTYGET, VT_BSTR, (void*)&result, NULL);
		return result;
	}
	void put_Title(LPCTSTR newValue)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x10, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	long get_Language()
	{
		long result;
		InvokeHelper(0x11, DISPATCH_PROPERTYGET, VT_I4, (void*)&result, NULL);
		return result;
	}
	void put_Language(long newValue)
	{
		static BYTE parms[] = VTS_I4 ;
		InvokeHelper(0x11, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	BOOL get_DoubleBuffered()
	{
		BOOL result;
		InvokeHelper(0x12, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_DoubleBuffered(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0x12, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	BOOL get_AlignDisabled()
	{
		BOOL result;
		InvokeHelper(0x13, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	long get_VisibleDockClientCount()
	{
		long result;
		InvokeHelper(0x14, DISPATCH_PROPERTYGET, VT_I4, (void*)&result, NULL);
		return result;
	}
	long DrawTextBiDiModeFlagsReadingOnly()
	{
		long result;
		InvokeHelper(0x16, DISPATCH_METHOD, VT_I4, (void*)&result, NULL);
		return result;
	}
	BOOL get_Enabled()
	{
		BOOL result;
		InvokeHelper(DISPID_ENABLED, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_Enabled(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(DISPID_ENABLED, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	void InitiateAction()
	{
		InvokeHelper(0x17, DISPATCH_METHOD, VT_EMPTY, NULL, NULL);
	}
	BOOL IsRightToLeft()
	{
		BOOL result;
		InvokeHelper(0x18, DISPATCH_METHOD, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	BOOL UseRightToLeftReading()
	{
		BOOL result;
		InvokeHelper(0x1b, DISPATCH_METHOD, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	BOOL UseRightToLeftScrollBar()
	{
		BOOL result;
		InvokeHelper(0x1c, DISPATCH_METHOD, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	BOOL get_Visible()
	{
		BOOL result;
		InvokeHelper(0x1d, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_Visible(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0x1d, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	short get_Cursor()
	{
		short result;
		InvokeHelper(0x1e, DISPATCH_PROPERTYGET, VT_I2, (void*)&result, NULL);
		return result;
	}
	void put_Cursor(short newValue)
	{
		static BYTE parms[] = VTS_I2 ;
		InvokeHelper(0x1e, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	long get_HelpType()
	{
		long result;
		InvokeHelper(0x1f, DISPATCH_PROPERTYGET, VT_I4, (void*)&result, NULL);
		return result;
	}
	void put_HelpType(long newValue)
	{
		static BYTE parms[] = VTS_I4 ;
		InvokeHelper(0x1f, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	CString get_HelpKeyword()
	{
		CString result;
		InvokeHelper(0x20, DISPATCH_PROPERTYGET, VT_BSTR, (void*)&result, NULL);
		return result;
	}
	void put_HelpKeyword(LPCTSTR newValue)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x20, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	void SetSubComponent(BOOL IsSubComponent)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0x22, DISPATCH_METHOD, VT_EMPTY, NULL, parms, IsSubComponent);
	}
	void AboutBox()
	{
		InvokeHelper(DISPID_ABOUTBOX, DISPATCH_METHOD, VT_EMPTY, NULL, NULL);
	}
	void ExecuteRemote(LPCTSTR hostname, long port, LPCTSTR user, LPCTSTR password, LPCTSTR aliasname, LPCTSTR reportname)
	{
		static BYTE parms[] = VTS_BSTR VTS_I4 VTS_BSTR VTS_BSTR VTS_BSTR VTS_BSTR ;
		InvokeHelper(0xc9, DISPATCH_METHOD, VT_EMPTY, NULL, parms, hostname, port, user, password, aliasname, reportname);
	}
	void CalcReport(BOOL ShowProgress)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0xca, DISPATCH_METHOD, VT_EMPTY, NULL, parms, ShowProgress);
	}
	void Compose(LPDISPATCH Report, BOOL Execute)
	{
		static BYTE parms[] = VTS_DISPATCH VTS_BOOL ;
		InvokeHelper(0xcb, DISPATCH_METHOD, VT_EMPTY, NULL, parms, Report, Execute);
	}
	void SaveToText(LPCTSTR filename, LPCTSTR textdriver)
	{
		static BYTE parms[] = VTS_BSTR VTS_BSTR ;
		InvokeHelper(0xcc, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename, textdriver);
	}
	LPDISPATCH get_Report()
	{
		LPDISPATCH result;
		InvokeHelper(0x15, DISPATCH_PROPERTYGET, VT_DISPATCH, (void*)&result, NULL);
		return result;
	}
	void SaveToExcel(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x19, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SaveToHTML(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x1a, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SetRecordSet(LPCTSTR datasetname, LPDISPATCH Value)
	{
		static BYTE parms[] = VTS_BSTR VTS_DISPATCH ;
		InvokeHelper(0x21, DISPATCH_METHOD, VT_EMPTY, NULL, parms, datasetname, Value);
	}
	void SaveToCustomText(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x23, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SaveToCSV(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x24, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SaveToSVG(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x25, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SaveToMetafile(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x26, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	void SaveToExcel2(LPCTSTR filename)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x27, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename);
	}
	CString get_DefaultPrinter()
	{
		CString result;
		InvokeHelper(0x2a, DISPATCH_PROPERTYGET, VT_BSTR, (void*)&result, NULL);
		return result;
	}
	void put_DefaultPrinter(LPCTSTR newValue)
	{
		static BYTE parms[] = VTS_BSTR ;
		InvokeHelper(0x2a, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}
	CString get_PrintersAvailable()
	{
		CString result;
		InvokeHelper(0x2c, DISPATCH_PROPERTYGET, VT_BSTR, (void*)&result, NULL);
		return result;
	}
	void GetRemoteParams(LPCTSTR hostname, long port, LPCTSTR user, LPCTSTR password, LPCTSTR aliasname, LPCTSTR reportname)
	{
		static BYTE parms[] = VTS_BSTR VTS_I4 VTS_BSTR VTS_BSTR VTS_BSTR VTS_BSTR ;
		InvokeHelper(0x28, DISPATCH_METHOD, VT_EMPTY, NULL, parms, hostname, port, user, password, aliasname, reportname);
	}
	void SaveToCSV2(LPCTSTR filename, LPCTSTR separator)
	{
		static BYTE parms[] = VTS_BSTR VTS_BSTR ;
		InvokeHelper(0x29, DISPATCH_METHOD, VT_EMPTY, NULL, parms, filename, separator);
	}
	BOOL get_AsyncExecution()
	{
		BOOL result;
		InvokeHelper(0x2b, DISPATCH_PROPERTYGET, VT_BOOL, (void*)&result, NULL);
		return result;
	}
	void put_AsyncExecution(BOOL newValue)
	{
		static BYTE parms[] = VTS_BOOL ;
		InvokeHelper(0x2b, DISPATCH_PROPERTYPUT, VT_EMPTY, NULL, parms, newValue);
	}

// Properties
//



};
