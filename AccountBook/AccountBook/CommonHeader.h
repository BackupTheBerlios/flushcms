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
	_T("代码"),100,
	_T("ID"),20,
	_T("科目"),180,
	_T("显示"),60,
	_T("排序"),60
};

#endif
