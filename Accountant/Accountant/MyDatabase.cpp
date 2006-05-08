// MyDatabase.cpp : 实现文件
//

#include "stdafx.h"
#include "Accountant.h"
#include "MyDatabase.h"


// CMyDatabase

CMyDatabase::CMyDatabase()
{
	this->ConnectDB();
}

CMyDatabase::~CMyDatabase()
{
}


// CMyDatabase 成员函数

void CMyDatabase::ConnectDB(void)
{
	CString sDNS = _T("ODBC;DRIVER=Microsoft Access Driver (*.mdb);DSN='';DBQ=data.mdb");
	m_nDatabase = new CDatabase();
	m_nDatabase->Open(NULL,false,false,sDNS);
	
}

CRecordset * CMyDatabase::getTableRecordset(CString TableName)
{
	CString SqlString = _T("SELECT * FROM ")+TableName;
	CRecordset *record;
	record= new CRecordset(this->m_nDatabase);
	record->Open(CRecordset::dynaset,SqlString);
	return record;
}

void CMyDatabase::addTypeName(CString TypeName)
{
	CString SqlString = _T(" INSERT INTO types (Name) VALUES ('")+TypeName+_T("')");
	this->m_nDatabase->ExecuteSQL(SqlString);
}

void CMyDatabase::delTypeName(CString TypeName)
{
	CString SqlString = _T(" DELETE FROM types WHERE Name='")+TypeName+_T("'");
	this->m_nDatabase->ExecuteSQL(SqlString);
}

CRecordset * CMyDatabase::getTableRecordset(CString TableName, CString Whereis)
{
	CString SqlString = _T("SELECT * FROM ")+TableName+Whereis;
	CRecordset *record;
	record= new CRecordset(this->m_nDatabase);
	record->Open(CRecordset::dynaset,SqlString);
	return record;
}
