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


