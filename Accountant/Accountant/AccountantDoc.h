// AccountantDoc.h : CAccountantDoc ��Ľӿ�
//


#pragma once


class CAccountantDoc : public CDocument
{
protected: // �������л�����
	CAccountantDoc();
	DECLARE_DYNCREATE(CAccountantDoc)

// ����
public:

// ����
public:

// ��д
public:
	virtual BOOL OnNewDocument();
	virtual void Serialize(CArchive& ar);

// ʵ��
public:
	virtual ~CAccountantDoc();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// ���ɵ���Ϣӳ�亯��
protected:
	DECLARE_MESSAGE_MAP()
public:
	int m_nPID;
public:
	CString m_nCurrentItem;
};


