// AccountAdd.cpp : ʵ���ļ�
//

#include "stdafx.h"
#include "AccountBook.h"
#include "AccountAdd.h"


// CAccountAdd �Ի���

IMPLEMENT_DYNAMIC(CAccountAdd, CDialog)

CAccountAdd::CAccountAdd(CWnd* pParent /*=NULL*/)
	: CDialog(CAccountAdd::IDD, pParent)
{

}

CAccountAdd::~CAccountAdd()
{
}

void CAccountAdd::DoDataExchange(CDataExchange* pDX)
{
	CDialog::DoDataExchange(pDX);
}


BEGIN_MESSAGE_MAP(CAccountAdd, CDialog)
END_MESSAGE_MAP()


// CAccountAdd ��Ϣ�������
