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
	_T("����"),80,
	_T("��Ŀ"),120,
	_T("��ʾ"),40,
	_T("����"),40
};

//ListLabel voucherHeaderLabel[VOUCHER_LEN]=
//{
//	_T("����"),120,
//	_T("ƾ֤���"),40,
//	_T("��Ŀ"),120,
//	_T("���"),40,
//	_T("���"),80,
//	_T("����"),120
//};

#endif