// AccountBookDoc.h : CAccountBookDoc ��Ľӿ�
//


#pragma once


class CAccountBookDoc : public CDocument
{
protected: // �������л�����
	CAccountBookDoc();
	DECLARE_DYNCREATE(CAccountBookDoc)

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
	virtual ~CAccountBookDoc();
#ifdef _DEBUG
	virtual void AssertValid() const;
	virtual void Dump(CDumpContext& dc) const;
#endif

protected:

// ���ɵ���Ϣӳ�亯��
protected:
	DECLARE_MESSAGE_MAP()
};


