#pragma once
#include "afxdb.h"

// CMyDatabase ÃüÁîÄ¿±ê

class CMyDatabase : public CDatabase
{
public:
	CMyDatabase();
	virtual ~CMyDatabase();
public:
	void ConnectDB(void);
public:
	CDatabase *m_nDatabase;
public:
	CRecordset * getTableRecordset(CString TableName);
public:
	void addTypeName(CString TypeName);
public:
	void delTypeName(CString TypeName);
public:
	CRecordset * getTableRecordset(CString TableName, CString Whereis);
};


