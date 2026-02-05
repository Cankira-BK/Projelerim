// en üste ekle

#ifdef _ITEM_SHOP_SYSTEM
	#include "item_shop.h"
#endif


// arat fonksiyonu

void CInputP2P::Transfer(const char * c_pData)
{
	TPacketGGTransfer * p = (TPacketGGTransfer *) c_pData;

	LPCHARACTER ch = CHARACTER_MANAGER::instance().FindPC(p->szName);

	if (ch)
		ch->WarpSet(p->lX, p->lY);
}

// altýna ekle 

#ifdef _ITEM_SHOP_SYSTEM
void CInputP2P::NesneMarket(const char * c_pData)
{
	TPacketGGNesne * p = (TPacketGGNesne *) c_pData;
	CItemShopManager::instance().LoadItemShopTable();
}
#endif