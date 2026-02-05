// arat

void	SendClickItemPacket(DWORD dwIID);

// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
	DWORD	GetDragonCoin();
	DWORD	GetDragonMark();

	void	SetDragonCoin(DWORD amount);
	void	SetDragonMark(DWORD amount);
#endif

// arat

BOOL					m_sysIsLevelLimit;

// altýna ekle

#ifdef ENABLE_ITEM_SHOP_SYSTEM
	DWORD					m_dwDragonCoin;
	DWORD					m_dwDragonMark;
#endif