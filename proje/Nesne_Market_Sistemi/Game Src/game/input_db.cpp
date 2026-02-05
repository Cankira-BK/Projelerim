// en üste ekle

#ifdef _ITEM_SHOP_SYSTEM
#include "item_shop.h"
#endif


// arat

	building::CManager::instance().FinalizeBoot();
	
// üstüne ekle !!!!!

#ifdef _ITEM_SHOP_SYSTEM
	CItemShopManager::instance().LoadItemShopTable();
#endif