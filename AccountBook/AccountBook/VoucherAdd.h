#pragma once


// CVoucherAdd �Ի���

class CVoucherAdd : public CDialog
{
	DECLARE_DYNAMIC(CVoucherAdd)

public:
	CVoucherAdd(CWnd* pParent = NULL);   // ��׼���캯��
	virtual ~CVoucherAdd();

// �Ի�������
	enum { IDD = IDD_VOUCHER_ADD };

protected:
	virtual void DoDataExchange(CDataExchange* pDX);    // DDX/DDV ֧��

	DECLARE_MESSAGE_MAP()
};
