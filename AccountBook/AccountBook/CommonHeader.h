#ifndef COMMON_HEADER_H
#define	 COMMON_HEADER_H

#define ACCOUNT_TYPE_LEN 4
//#define VOUCHER_LEN 6

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

//ListLabel voucherHeaderLabel[VOUCHER_LEN]=
//{
//	_T("日期"),120,
//	_T("凭证序号"),40,
//	_T("科目"),120,
//	_T("借贷"),40,
//	_T("金额"),80,
//	_T("描述"),120
//};

#endif