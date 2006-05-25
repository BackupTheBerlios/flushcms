#pragma once
#include "afxdb.h"

// CMyDatabase ÃüÁîÄ¿±ê

class CMyDatabase : public CDatabase
{
public:
	CMyDatabase(CString dataFile);
	virtual ~CMyDatabase();
public:
	void ConnectDB(CString dataFile);
public:
	CDatabase *m_nDatabase;
public:
	CRecordset * getTableRecordset(CString TableName);
public:
	void addTypeName(CString TypeName,CString PTypeName);
public:
	void delTypeName(CString TypeName);
public:
	CRecordset * getTableRecordset(CString TableName, CString Whereis);
public:
	void doActionQuery(CString str);
public:
	int getTypesID(CString TypesName);
public:
	int getProvinceid(CString provinceName);
};


