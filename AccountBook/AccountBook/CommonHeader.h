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
	_T("代码"),80,
	_T("科目"),120,
	_T("显示"),40,
	_T("排序"),40
};

#endif
