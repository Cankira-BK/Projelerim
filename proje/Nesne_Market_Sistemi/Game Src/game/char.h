// arat 

bool				IsRiding() const;

// Altýna ekle


#ifdef _ITEM_SHOP_SYSTEM
public:
	DWORD			GetDragonCoin();
	DWORD			GetDragonMark();
	void			SetDragonCoin(DWORD amount);
	void			SetDragonMark(DWORD amount);
	void			RefreshDragonCoin();
#endif