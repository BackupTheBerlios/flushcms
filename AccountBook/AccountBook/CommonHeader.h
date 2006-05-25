#pragma once

#ifndef COMMON_HEADER_H_
#define COMMON_HEADER_H_

#define ACCOUNT_TYPE_LEN 4

typedef struct ListHeaderLabel 
{
	CString title;
	int len;

}ListLabel;

ListLabel accountTypeLabel[ACCOUNT_TYPE_LEN]=
{
	_T("����"),80,
	_T("��Ŀ"),120,
	_T("��ʾ"),40,
	_T("����"),40
};

#endif
