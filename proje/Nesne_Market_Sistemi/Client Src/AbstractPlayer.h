// arat

virtual DWORD	GetItemIndex(TItemPos itemPos) = 0;


// altýna ekle


#ifdef ENABLE_ITEM_SHOP_SYSTEM
		virtual void	SetDragonCoin(DWORD amount) = 0;
		virtual	void	SetDragonMark(DWORD amount) = 0;
#endif