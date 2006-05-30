#pragma once

#ifndef COMMON_HEADER_H_
#define COMMON_HEADER_H_

#define ACCOUNT_TYPE_LEN 5

typedef struct ListHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel accountTypeLabel[ACCOUNT_TYPE_LEN]=
{
	_T("����"),100,
	_T("ID"),20,
	_T("��Ŀ"),180,
	_T("��ʾ"),60,
	_T("����"),60
};

#endif
